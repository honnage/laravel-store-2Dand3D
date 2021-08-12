<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypefileModel;

class TypefileController extends Controller
{
    public function index(){
        $path = "category";
        $typefile = TypefileModel::orderBy('updated_at','desc')->paginate(10);
        return view('admin.typefile.index',compact('typefile','path'));
    }

    public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name'=>'required|unique:typefile|max:191',
                'description'=>'required|max:191',
            ],
            [
                'name.required'=>"กรุณาป้อนประเภทนามสกุลไฟล์",
                'name.max' => "ห้ามป้อนประเภทนามสกุลไฟล์เกิน 191 ตัวอักษร",
                'name.unique'=>"มีข้อมูลประเภทนามสกุลไฟล์นี้ในฐานข้อมูลแล้ว",

                'description.required'=>"กรุณาป้อนคำอธิบาย",
                'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",
            ]
        );
        $typefile = new TypefileModel;
        $typefile->name = $request->name;
        $typefile->description = $request->description;

        $typefile->save();
        // dd($request);
        session()->flash("success","เพิ่มข้อมูลเรียนร้อย!");
        return redirect('/typefile');
    }

    public function edit($id){
        $typefile = TypefileModel::orderBy('updated_at','desc')->paginate(10);
        $typefile_edit = TypefileModel::find($id);
        return view('admin.typefile.edit',compact('typefile','typefile_edit'));
    }

    public function update(Request $request, $id) {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name'=>'required|max:191',
                'name'=>'required|max:191',
            ],
            [
                'name.required'=>"กรุณาป้อนประเภทนามสกุลไฟล์",
                'name.max' => "ห้ามป้อนประเภทนามสกุลไฟล์เกิน 191 ตัวอักษร",

                'description.required'=>"กรุณาป้อนคำอธิบาย",
                'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",
            ]
        );
        TypefileModel::find($id)->update($request->all());
        Session()->flash('success','อัพเดทข้อมูลเรียบร้อยแล้ว');

        // dd($request->all());
        return redirect('/typefile');
    }

    public function destroy($id) {
        // $category = Category::find($id);
        // if($category->posts->count() > 0){
        //     Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีชื่อบทความใช้งานอยู่');
        //     return redirect()->back();
        // }
        TypefileModel::find($id)->delete();
        Session()->flash('success','ลบข้อมูลเรียบร้อยแล้ว');
        return redirect('/typefile');
    }

}
