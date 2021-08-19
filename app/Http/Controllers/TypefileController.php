<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypefileModel;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\LicenseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypefileController extends Controller
{
    public function index()
    {
        $typefile = TypefileModel::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('admin.typefile.index', 
            compact('typefile','categories','typefiles','formats','licenses'));
    }

    public function store(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name' => 'required|unique:typefile|max:10',
                'description' => 'required|max:191',
                'formats' => 'required',
            ],
            [
                'name.required' => "กรุณาป้อนประเภทนามสกุลไฟล์",
                'name.max' => "ห้ามป้อนประเภทนามสกุลไฟล์เกิน 10 ตัวอักษร",
                'name.unique' => "มีข้อมูลประเภทนามสกุลไฟล์นี้ในฐานข้อมูลแล้ว",

                'description.required' => "กรุณาป้อนคำอธิบาย",
                'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",

                'formats.required' => "กรุณาเลือกรูปแบบ",
            ]
        );
        $typefile = new TypefileModel;
        $typefile->name = Str::of($request->name)->upper(); //request string to upper
        $typefile->description = $request->description;
        $typefile->formats = $request->formats;
        $typefile->save();
        // dd($request);
        session()->flash("success", "เพิ่มข้อมูลเรียนร้อย!");
        return redirect('/typefile');
    }

    public function edit($id)
    {
        $typefile = TypefileModel::orderBy('updated_at', 'desc')->paginate(10);
        $typefile_edit = TypefileModel::find($id);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('admin.typefile.edit', 
            compact('typefile', 'typefile_edit','categories','typefiles','formats','licenses'));
    }

    public function update(Request $request, $id)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name' => 'required|max:10',
                'description' => 'required|max:191',
                'formats' => 'required',
            ],
            [
                'name.required' => "กรุณาป้อนประเภทนามสกุลไฟล์",
                'name.max' => "ห้ามป้อนประเภทนามสกุลไฟล์เกิน 10 ตัวอักษร",

                'description.required' => "กรุณาป้อนคำอธิบาย",
                'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",

                'formats.required' => "กรุณาป้อนคำอธิบาย",
            ]
        );
        $typefile = new TypefileModel;
        $typefile->name = Str::of($request->name)->upper(); //request string to upper
        $typefile->description = $request->description;
        $typefile->formats = $request->formats;

        DB::table('typefile')
            ->where('id', '=', $id)
            ->update([
                'name' =>  $typefile->name,
                'description' => $request->description,
                'formats' => $request->formats,
                'updated_at' => now(),
            ]);
        // dd($request->all());
        Session()->flash('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
        return redirect('/typefile');
    }

    public function destroy($id)
    {
        $typefile = TypefileModel::find($id);
        if($typefile->asset->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีชื่อชิ้นงานใช้งานอยู่');
            return redirect()->back();
        }
        TypefileModel::find($id)->delete();
        Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
        return redirect('/typefile');
    }

    public function search_datatable(Request $request)
    {
        $data = TypefileModel::orderBy('updated_at', 'desc')->paginate(10);
        $search = $request->get('search');
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $typefile = DB::table('typefile')->where('name', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.typefile.search', 
            compact('data','search','categories','typefiles','formats','licenses'));
    }
}
