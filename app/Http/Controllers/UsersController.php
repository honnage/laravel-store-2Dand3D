<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use App\Models\LicenseModel;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){       
        $users = User::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('admin.users.index', compact('users','categories','typefiles','formats','licenses'));
    }

    public function edit($id){
        $license = LicenseModel::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $users = User::find($id);
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('users.edit', 
            compact('license', 'users','categories','typefiles','formats','licenses'));
    }

    public function update(Request $request, $id){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'firstname' => 'required|max:191',
                'lastname' => 'required|max:191',
            ],
            [
                'firstname.required' => "กรุณาป้อนชื่อจริง",
                'firstname.max' => "ห้ามป้อนชื่อจริงเกิน 191 ตัวอักษร",

                'lastname.required' => "กรุณาป้อนนามสกุล",
                'lastname.max' => "ห้ามป้อนนามสกุลเกิน 191 ตัวอักษร",
            ]
        );

        if($request->image != null){
            $users = User::find($id);
            File::delete(public_path($users->image));

            $image = $request->file('image'); //เข้ารหัสรูปภาพ ฐาน10
            $image_ext = strtolower($image->getClientOriginalExtension()); 
            $image_gen = "u".Auth::user()->id."_".hexdec(uniqid()); //Generate ชื่อภาพ
            $image_location = "upload/users/";
            $image_path = $image_location.$image_gen.".".$image_ext;

            DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->update([
                'image' =>   $image_path,
                'updated_at' => now(),
            ]);
            $request->file('image')->move(public_path($image_location), $image_path);
        }
     
        DB::table('users')
        ->where('id', '=', Auth::user()->id)
        ->update([
            'firstname' => $request->firstname,
            'lastname' =>  $request->lastname,
            'updated_at' => now(),
        ]);
        $license = LicenseModel::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $users = User::find($id);
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();

        Session()->flash('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
        // return redirect('/');
        return view('users.edit', 
            compact('license', 'users','categories','typefiles','formats','licenses'));
    }

    public function edit_status($id){
        $license = LicenseModel::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $users = User::find($id);
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('.admin.users.edit', 
            compact('license','users','categories','typefiles','formats','licenses'));
    }

    public function update_status(Request $request, $id){
        DB::table('users')
        ->where('id', '=', $id)
        ->update([
            'isStatus' => $request->isStatus,
            'updated_at' => now(),
        ]);
        Session()->flash('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
        return redirect('/users');
    }
    
    public function search_datatable(Request $request){
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();

        $query = User::query();
        $search = $request->get('search');
        $columns = ['firstname', 'lastname','email'];
        foreach ($columns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }

        $users = $query->paginate(10);
        return view('admin.users.search', 
            compact('users', 'search','categories','typefiles','formats','licenses'));
    }
}
