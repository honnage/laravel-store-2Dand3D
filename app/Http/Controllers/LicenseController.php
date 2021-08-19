<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LicenseModel;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    public function index()
    {
        $license = LicenseModel::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('admin.license.index', 
            compact('license','categories','typefiles','formats','licenses'));
    }

    public function store(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name_th' => 'required|unique:license|max:191',
                'name_en' => 'required|unique:license|max:191',
            ],
            [
                'name_th.required' => "กรุณาป้อนประเภทเผยเเพร่ สำหรับภาษาไทย",
                'name_th.max' => "ห้ามป้อนประเภทเผยเเพร่ สำหรับภาษาไทยเกิน 191 ตัวอักษร",
                'name_th.unique' => "มีข้อมูลประเภทเผยเเพร่ สำหรับภาษาไทย นี้ในฐานข้อมูลแล้ว",

                'name_en.required' => "กรุณาป้อนประเภทเผยเเพร่ สำหรับภาษาอังกฤษ",
                'name_en.max' => "ห้ามป้อนประเภทเผยเเพร่ สำหรับภาษาอังกฤษเกิน 191 ตัวอักษร",
                'name_en.unique' => "มีข้อมูลประเภทเผยเเพร่ สำหรับภาษาอังกฤษ นี้ในฐานข้อมูลแล้ว",
            ]
        );
        $license = new LicenseModel;
        $license->name_th = $request->name_th;
        $license->name_en = Str::of($request->name_en)->lower(); //request string to upper
        $license->save();
        // dd($request);
        session()->flash("success", "เพิ่มข้อมูลเรียนร้อย!");
        return redirect('/license');
    }

    public function edit($id)
    {
        $license = LicenseModel::orderBy('updated_at', 'desc')->paginate(10);
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $license_edit = LicenseModel::find($id);
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        return view('admin.license.edit', 
            compact('license', 'license_edit','categories','typefiles','formats','licenses'));
    }

    public function update(Request $request, $id)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name_th' => 'required|max:191',
                'name_en' => 'required|max:191',
            ],
            [
                'name_th.required' => "กรุณาป้อนประเภทเผยเเพร่ สำหรับภาษาไทย",
                'name_th.max' => "ห้ามป้อนประเภทเผยเเพร่ สำหรับภาษาไทยเกิน 191 ตัวอักษร",

                'name_en.required' => "กรุณาป้อนประเภทเผยเเพร่ สำหรับภาษาอังกฤษ",
                'name_en.max' => "ห้ามป้อนประเภทเผยเเพร่ สำหรับภาษาอังกฤษเกิน 191 ตัวอักษร",
            ]
        );
        $license = new LicenseModel;
        $license->name_th = $request->name_th;
        $license->name_en = Str::of($request->name_en)->lower(); //request string to upper
        
        DB::table('license')
            ->where('id', '=', $id)
            ->update([
                'name_th' => $request->name_th,
                'name_en' =>  $license->name_en,
                'updated_at' => now(),
            ]);
        // dd($request->all());
        Session()->flash('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
        return redirect('/license');
    }

    public function destroy($id)
    {
        $license = LicenseModel::find($id);
        if($license->asset->count() > 0){
            Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีชื่อชิ้นงานใช้งานอยู่');
            return redirect()->back();
        }
        LicenseModel::find($id)->delete();
        Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
        return redirect('/license');
    }

    public function search_datatable(Request $request)
    {
        $search = $request->get('search');
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $query = LicenseModel::query();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $columns = ['name_th', 'name_en'];

        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }

        $license = $query->paginate(10);
        return view('admin.license.search', 
            compact('license', 'search','categories','typefiles','formats','licenses'));
    }
}
