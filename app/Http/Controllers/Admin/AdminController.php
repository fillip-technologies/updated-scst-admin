<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login_admin()
    {

        return view('admin.login.signin');
    }

    public function admin_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password, ])) {

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Invalid credentials.');

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function dashboard()
    {

        return view('admin.dashboard');
    }

    public function searchMissionAspire(Request $request)
    {
        $request->validate([]);

    }
}
