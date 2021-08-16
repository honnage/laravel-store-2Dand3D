<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use App\Models\LicenseModel;

class AssetController extends Controller
{
    public function index()
    {
        $asset = AssetModel::all();
        return view('asset.index', compact('asset'));
    }

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
                // 'image' => 'required|mimes:jpg,jpeg,png',
                'asset' => 'required'
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
                // 'image.required' => "กรุณาอัพโหลดรูปภาพ",
                // 'image.mimes' => "นามสกุลรูปภาพต้องเป็น jpg jpeg png",
                'asset.required' => "กรุณาอัพโหลดชิ้นงาน",
            ]
        );
        // $image = $request->file('image'); //เข้ารหัสรูปภาพ ฐาน10
        // $image_gen = "u".Auth::user()->id."_".hexdec(uniqid()); //Generate ชื่อภาพ
        // $image_ext = strtolower($image->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ
        // $image_name = $image_gen.'.'.$image_ext;
        // $image_location = "images/";
        // $request->file('image')->move(public_path( $image_location ), $image_name); //เก็บไฟล์ลง storag

       

        
        // $asset_location = "assets/";
        // $request->file('asset')->move(public_path( $asset_location ), $asset_name); //เก็บไฟล์ลง storag

        $asset = new AssetModel;
        // $asset->user_id = Auth::user()->id;
        // $asset->display_name = $request->display_name;
        // $asset->description = $request->description;
        // $asset->price = $request->price;
        // $asset->category_id = $request->category_id;
        // $asset->typefile_id = $request->typefile_id;
        // $asset->license_id = $request->license_id;
        // $asset->image = $image_name;
        

        // if($request->path_model != null){
        //     $path_model = $request->file('path_model'); //เข้ารหัส ฐาน10
        //     $model_gen = hexdec(uniqid()); //Generate ชื่อ
        //     $model_ext = strtolower($path_model->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ
        //     $model_name = $model_gen.'.'.$model_ext;
          
        //     $asset->model_type = $request->file('path_model')->getClientOriginalExtension();
        //     $asset->model_size = $request->file('path_model')->getSize();
        //     $asset->model_path = "models/user".Auth::user()->id."/".$model_name;

        //     $location = "models/user".Auth::user()->id."/";
        //     $request->file('path_model')->move(public_path( $location ), $model_name); //เก็บไฟล์ลง storage
     
           
        // }

     
        if($request->hasFile(('asset'))){

            $asset = $request->file('asset'); 
            $asset_ext = strtolower($asset->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ

            if($asset_ext  == "jpg" || $asset_ext== "jpeg" ||  $asset_ext== "png"){
                $asset_gen = "u".Auth::user()->id."_".hexdec(uniqid()); //Generate ชื่อภาพ
                $asset_name = $asset_gen.'.'.$asset_ext;
            }
    
            if($asset_ext  == "zip" || $asset_ext== "rar"){
                $asset_gen = "u".Auth::user()->id."_".hexdec(uniqid()); //Generate ชื่อภาพ
                $asset->model_size = $asset->getSize(); //ขนาด file
                $asset->model_type = $asset_ext ; //นามสกุลไฟล์ภาพ
                $asset_name = $asset_gen.'.'.$asset_ext;; //set name
    
    
                $asset_location = "asset/user".Auth::user()->id;
                $model_path  = $asset_location."/".$asset_gen;

                $asset->model_path = $model_path;
                $asset->asset = $asset_name;

                $asset_upload = $request->asset->store($model_path);
                

    
                // $asset->open(public_path( $model_path ), $asset_name); 
                // $asset->extract(public_path( $model_path ), $asset_name); //เก็บไฟล์ลง storage
    
               
              
         
            }
            
          
            dd($asset);
    
        
    
            // dd($asset);
            
            $asset->save();
           
        }
       
        session()->flash("success", "เพิ่มข้อมูลเรียนร้อย!");
        return redirect('/');
    }
}
