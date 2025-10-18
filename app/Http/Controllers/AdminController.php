<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users.index');
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function rapport()
    {
        return view('admin.statistiques');
    }
}
