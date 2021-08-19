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
    public function dashboard_admin(){
        $asset = AssetModel::orderBy('updated_at', 'desc')->paginate(10);  
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('admin.asset.dashboard',
            compact('asset','categories','typefiles','formats','licenses'));
    }

    public function dashboard_user($id){
        $data = $id;
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $asset = AssetModel::where('user_id',$id)->paginate(10);  
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('asset.dashboard', 
            compact('asset','categories','typefiles','formats','licenses','data'));
    }

    public function upload(){
        $user = Auth::user();
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        $licenses = LicenseModel::all();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('asset.upload', 
            compact('user','categories','typefiles','formats','licenses'));
    }

    public function store(Request $request){
        // ตรวจสอบข้อมูล
        $request->validate(
            [
                'display_name' => 'required|max:191',
                'description' => 'required|max:191',
                'price' => 'required',
                'category_id' => 'required',
                'typefile_id' => 'required',
                'license_id' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png',
                'asset' => 'required|mimes:jpg,jpeg,png,zip,rar'
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
                'image.required' => "กรุณาอัพโหลดรูปภาพ",
                'image.mimes' => "นามสกุลรูปภาพต้องเป็น jpg jpeg png",
                'asset.required' => "กรุณาอัพโหลดชิ้นงาน",
                'asset.mimes' => "นามสกุลต้องเป็น jpg jpeg png zip rar",
            ]
        );
        // upload image
        $image = $request->file('image'); //เข้ารหัสรูปภาพ ฐาน10
        $image_ext = strtolower($image->getClientOriginalExtension()); 
        $image_gen = "u".Auth::user()->id."_".hexdec(uniqid()); //Generate ชื่อภาพ
        $image_location = "upload/images/";
        $image_path = $image_location.$image_gen;

        // upload asset
        $asset = $request->file('asset'); 
        $asset_ext = strtolower($asset->getClientOriginalExtension()); // ดึงนามสกุลไฟล์ภาพ
        $asset_gen = hexdec(uniqid()); //Generate ชื่อภาพ
        $asset_location = "upload/assets/";
        $asset_path  = $asset_location."u".Auth::user()->id."_".$asset_gen;
        $asset_size = $asset->getSize();
  
        $asset = new AssetModel;
        // $asset->asset_id = "U".Auth::user()->id."A".$asset_gen;
        $asset->user_id = Auth::user()->id;
        $asset->display_name = $request->display_name;
        $asset->description = $request->description;
        $asset->price = $request->price;
        $asset->category_id = $request->category_id;
        $asset->typefile_id = $request->typefile_id;
        $asset->license_id = $request->license_id;
        $asset->image = $image_path.".".$image_ext;
        $asset->asset_size  =  $asset_size;
        $asset->asset_type  =  $asset_ext;
        $asset->asset_path = $asset_path.".".$asset_ext;

         //upload show model 
         if($request->model != null){
            $model = $request->file('model');
            $model_ext = strtolower($model->getClientOriginalExtension()); //ดึงนามสกุลไฟล์ภาพ

            if( $model_ext == "gltf" || $model_ext == "glb"){
                $model_gen = "u".Auth::user()->id."_".hexdec(uniqid()); //Generate ชื่อ
                $model_location = "upload/models/";
                $model_path  = $model_location.$model_gen; 
          
                $model_size = $model->getSize();
                $asset->model_size = $model_size;
                $asset->model_type = $model_ext;
                $asset->model_path = $model_path.".".$model_ext;
                $request->file('model')->move(public_path($model_location), $model_path.".".$model_ext);
            }
        }
        $asset->save();
        $request->file('image')->move(public_path($image_location), $image_path.".".$image_ext);
        $request->file('asset')->move(public_path($asset_location), $asset_path.".".$asset_ext);
        return redirect('/');
    }

    public function edit($id){
        $user = Auth::user();
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        $licenses = LicenseModel::all();
        $asset = AssetModel::all();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('asset.upload', compact('user','categories','typefiles','formats','licenses'));
    }
}
