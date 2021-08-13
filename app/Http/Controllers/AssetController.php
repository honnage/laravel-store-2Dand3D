<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;

class AssetController extends Controller
{
    public function upload()
    {       
        // $users = DB::table('users')->paginate(10);
        $user = Auth::user();
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        // dd($category);
        return view('asset.upload', compact('user','categories','typefiles'));
    }


}
