<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {       
        // $users = DB::table('users')->paginate(10);
        $user = Auth::user();
        return view('asset.upload', compact('user'));
    }


}
