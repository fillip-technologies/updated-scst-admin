<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $loginUser = Auth::user();

            if ($loginUser->role === 'super_admin') {
                return redirect()->route('super-admin.dashboard');
            } elseif ($loginUser->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function store(Request $request)
    {

        $user = User::create([
            'name' => 'Abhishek',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'phone' => '9923546784',
            'role_id' => 1,
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin');
    }

    public function update_password()
    {

        return view('admin.include.change_password');

    }

    public function update(Request $request)
    {

        $request->validate([
            'current_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $admin = auth('admin')->user();

        if (! $admin) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access']);
        }
        if (! Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Current password does not match',
            ]);
        }
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()
            ->route('admin')
            ->with('status', 'Password changed successfully');
    }

    // public function SystemLogin(Request $request)
    // {
    //     // SCHOOL LOGIN
    //     if ($request->login_type === 'school') {

    //         $request->validate([
    //             'schoolCode' => 'required',
    //             'password' => 'required',
    //         ]);

    //         if (Auth::attempt(['schoolCode' => $request->schoolCode, 'password' => $request->password])) {

    //             $loginUser = Auth::user();

    //             if ($loginUser->role === 'school_admin') {
    //                 return redirect()->route('school.dashboard');
    //             }

    //         } else {
    //             return redirect()->back()->with('error', 'Invalid School Credentials');
    //         }
    //     }

    //     // STAFF LOGIN
    //     elseif ($request->login_type === 'staff') {

    //         $request->validate([
    //             'username' => 'required',
    //             'password' => 'required',
    //         ]);

    //         if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {

    //             $loginUser = Auth::user();

    //             if ($loginUser->role === 'staff') {

    //                 return redirect()->route('staff.dashboard');
    //             }

    //         } else {
    //             return redirect()->back()->with('error', 'Invalid Staff Credentials');
    //         }
    //     }
    //     else {

    //         $request->validate([
    //             'username' => 'required',
    //             'password' => 'required',
    //         ]);

    //         if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {

    //             $loginUser = Auth::user();

    //             if ($loginUser->role === 'admin') {
    //                 return redirect()->route('admin.dashboard');
    //             }

    //         } else {
    //             return redirect()->back()->with('error', 'Invalid Admin Credentials');
    //         }
    //     }

    //     return redirect()->back()->with('error', 'Unauthorized Access');
    // }

    public function SystemLogin(Request $request)
    {

        if ($request->login_type === 'school') {

            $request->validate([
                'schoolCode' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('schoolCode', $request->schoolCode)->first();

            if (! $user || $user->role !== 'school_admin') {
                return back()->with('error', 'Invalid School Credentials');
            }

            return checkLoginAttempt(
                $user,
                ['schoolCode' => $request->schoolCode, 'password' => $request->password],
                'school.dashboard'
            );
        } elseif ($request->login_type === 'staff') {

            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('username', $request->username)->first();

            if (! $user || $user->role !== 'staff') {
                return back()->with('error', 'Invalid Staff Credentials');
            }

            return checkLoginAttempt(
                $user,
                ['username' => $request->username, 'password' => $request->password],
                'staff.dashboard'
            );
        } else {

            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('username', $request->username)->first();

            if (! $user || $user->role !== 'admin') {
                return back()->with('error', 'Invalid Admin Credentials');
            }

            return checkLoginAttempt(
                $user,
                ['username' => $request->username, 'password' => $request->password],
                'admin.dashboard'
            );
        }
    }

    public function SchoolLogout()
    {
        Auth::guard('school')->logout();

        return redirect()->route('login');
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login');
    }

    public function StaffLogout()
    {
        Auth::guard('staff')->logout();

        return redirect()->route('teacher.singup');
    }

    public function adminforgetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'id' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($request->password === $request->password_confirmation) {
            $getdata = User::findOrFail($request->id);
            if ($getdata->username === $request->email) {

                $data = [
                    'password' => Hash::make($request->password),
                ];

                $getdata->update($data);

                return back()->with('success', 'Password Reset SuccessFul');
            } else {
                return back()->with('error', 'Data not found');
            }
        } else {
            return back()->with('error', 'Something went wrong');
        }

    }

    public function schoolforgetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'id' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($request->password === $request->password_confirmation) {
            $getdata = User::where('school_id', $request->id);
            $schooldata = School::findOrFail($request->id);
                $data = [
                    'password' => Hash::make($request->password),
                ];
                $getdata->update($data);
                $schooldata->update($data);
                return back()->with('success', 'Password Reset SuccessFul');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
}
