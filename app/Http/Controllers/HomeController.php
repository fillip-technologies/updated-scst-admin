<?php

namespace App\Http\Controllers;

use App\Helpers\ManageCrud;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    // Home page
    public function homePage()
    {
        // User::create([
        //     'name'=>'Admin',
        //     'username'=>'admin@gmail.com',
        //     'password'=>Hash::make('admin@123'),
        //     'role'=>'admin'
        // ]);
        return view('auth.login');

    }

    public function schoolMonitoring()
    {
        return view('modules.school-monitoring.index');
    }

    public function schoolManagement()
    {
         $schools = ManageCrud::getAll(School::class);
        return view('modules.school-management.index',compact('schools'));
    }

    public function performance()
    {
        return view('modules.performance-management.index');
    }
}
