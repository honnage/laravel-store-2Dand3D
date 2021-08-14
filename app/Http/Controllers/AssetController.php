<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use App\Models\LicenseModel;

class AssetController extends Controller
{
    public function upload()
    {
        // $users = DB::table('users')->paginate(10);
        $user = Auth::user();
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        $licenses = LicenseModel::all();
        // dd($category);
        return view('asset.upload', compact('user', 'categories', 'typefiles', 'licenses'));
    }

    public function store(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'display_name' => 'required|max:191',
                'description' => 'required|max:191',
                'price' => 'required',
                'category_id' => 'required',
                'typefile_id' => 'required',
                'license_id' => 'required',
            ],
            [
                'display_name.required' => "กรุณาป้อนชื่อชิ้นงาน",
                'display_name.max' => "ห้ามป้อนชื่อชิ้นงานเกิน 191 ตัวอักษร",
                'description.required' => "กรุณาป้อนคำอธิบาย",
                'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",
                'price.required' => "กรุณาป้อนราคา",
                'category_id.required' => "กรุณาเลือกหมวดหมู่",
                'typefile_id.required' => "กรุณาเลือกประนามสกุลไฟล์",
                'license_id.required' => "กรุณาเลือกประเภทเผยแพร่",
            ]
        );
        $asset = new AssetModel;
        $asset->user_id = Auth::user()->id;
        $asset->display_name = $request->display_name;
        $asset->description = $request->description;
        $asset->price = $request->price;
        $asset->category_id = $request->category_id;
        $asset->typefile_id = $request->typefile_id;
        $asset->license_id = $request->license_id;


        // $asset->image = $request->image;
        // $asset->asset = $request->asset;
        // $asset->save();
        dd($asset);
        // session()->flash("success", "เพิ่มข้อมูลเรียนร้อย!");
        // return redirect('/license');
    }
}
