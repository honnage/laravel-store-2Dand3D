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
        // ตรวจสอบข้อมูล
        $request->validate(
            [
                // 'display_name' => 'required|max:191',
                // 'description' => 'required|max:191',
                // 'price' => 'required',
                // 'category_id' => 'required',
                // 'typefile_id' => 'required',
                // 'license_id' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png',
                // 'asset' => 'required'
            ],
            [
                // 'display_name.required' => "กรุณาป้อนชื่อชิ้นงาน",
                // 'display_name.max' => "ห้ามป้อนชื่อชิ้นงานเกิน 191 ตัวอักษร",
                // 'description.required' => "กรุณาป้อนคำอธิบาย",
                // 'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",
                // 'price.required' => "กรุณาป้อนราคา",
                // 'category_id.required' => "กรุณาเลือกหมวดหมู่",
                // 'typefile_id.required' => "กรุณาเลือกประนามสกุลไฟล์",
                // 'license_id.required' => "กรุณาเลือกประเภทเผยแพร่",
                'image.required' => "กรุณาอัพโหลดรูปภาพ",
                'image.mimes' => "นามสกุลรูปภาพต้องเป็น jpg jpeg png",
                'asset.required' => "กรุณาอัพโหลดชิ้นงาน",
              
            ]
        );
        $image = $request->file('image'); //เข้ารหัสรูปภาพ ฐาน10
        $image_gen = hexdec(uniqid()); //Generate ชื่อภาพ
        $image_ext = strtolower($image->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ
        $img_name = $image_gen.'.'.$image_ext;

        // $asset = $request->file('asset'); //เข้ารหัส ฐาน10
        // $asset_gen = hexdec(uniqid()); //Generate ชื่อภาพ
        // $asset_ext = strtolower($asset->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ
        // $asset_name = $asset_gen.'.'.$asset_ext;
        // dd($request->path_model);
  
       
      

        $asset = new AssetModel;
        // $asset->user_id = Auth::user()->id;
        // $asset->display_name = $request->display_name;
        // $asset->description = $request->description;
        // $asset->price = $request->price;
        // $asset->category_id = $request->category_id;
        // $asset->typefile_id = $request->typefile_id;
        // $asset->license_id = $request->license_id;
        $asset->image = $img_name;
        // $asset->asset = $asset_name;

        if($request->path_model != null){
            $path_model = $request->file('path_model'); //เข้ารหัส ฐาน10
            $model_gen = hexdec(uniqid()); //Generate ชื่อ
            $model_ext = strtolower($path_model->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ
            $model_name = $model_gen.'.'.$model_ext;
          
            $asset->model_type = $request->file('path_model')->getClientOriginalExtension();
            $asset->model_size = $request->file('path_model')->getSize();
            $asset->model_path = "models/user".Auth::user()->id."/".$model_name;

            $location = "models/user".Auth::user()->id."/";
            $request->file('path_model')->move(public_path( $location ), $model_name); //เก็บไฟล์ลง storage
            dd($model_name);
            // dd($model_name);
           
        }
    

        dd($asset);
        
        // $asset->save();
       
        // session()->flash("success", "เพิ่มข้อมูลเรียนร้อย!");
        // return redirect('/license');
    }
}
