<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {       
        $users = DB::table('users')->paginate(10);
        return view('admin.users.index', compact('users'));
        dd($users);
    }
}
