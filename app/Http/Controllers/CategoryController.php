<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = CategoryModel::orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.category.index', compact('category'));
    }

    public function store(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'name_th' => 'required|unique:category|max:191',
                'name_en' => 'required|unique:category|max:191',
            ],
            [
                'name_th.required' => "กรุณาป้อนหมวดหมู่ สำหรับภาษาไทย",
                'name_th.max' => "ห้ามป้อนหมวดหมู่ สำหรับภาษาไทยเกิน 191 ตัวอักษร",
                'name_th.unique' => "มีข้อมูลหมวดหมู่ สำหรับภาษาไทย นี้ในฐานข้อมูลแล้ว",

                'name_en.required' => "กรุณาป้อนหมวดหมู่ สำหรับภาษาอังกฤษ",
                'name_en.max' => "ห้ามป้อนหมวดหมู่ สำหรับภาษาอังกฤษเกิน 191 ตัวอักษร",
                'name_en.unique' => "มีข้อมูลหมวดหมู่ สำหรับภาษาอังกฤษ นี้ในฐานข้อมูลแล้ว",
            ]
        );
        $category = new CategoryModel;
        $category->name_th = $request->name_th;
        $category->name_en = Str::of($request->name_en)->lower(); //request string to upper
        $category->save();
        // dd($request);
        session()->flash("success", "เพิ่มข้อมูลเรียนร้อย!");
        return redirect('/category');
    }

    public function edit($id)
    {
        $category = CategoryModel::orderBy('updated_at', 'desc')->paginate(10);
        $category_edit = CategoryModel::find($id);
        return view('admin.category.edit', compact('category', 'category_edit'));
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
                'name_th.required' => "กรุณาป้อนหมวดหมู่ สำหรับภาษาไทย",
                'name_th.max' => "ห้ามป้อนหมวดหมู่ สำหรับภาษาไทยเกิน 191 ตัวอักษร",

                'name_en.required' => "กรุณาป้อนหมวดหมู่ สำหรับภาษาอังกฤษ",
                'name_en.max' => "ห้ามป้อนหมวดหมู่ สำหรับภาษาอังกฤษเกิน 191 ตัวอักษร",
            ]
        );
        $category = new CategoryModel;
        $category->name_th = $request->name_th;
        $category->name_en = Str::of($request->name_en)->lower(); //request string to upper

        DB::table('category')
            ->where('id', '=', $id)
            ->update([
                'name_th' => $request->name_th,
                'name_en' =>  $category->name_en,
                'updated_at' => now(),
            ]);

        // dd($request->all());
        Session()->flash('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
        return redirect('/category');
    }

    public function destroy($id)
    {
        // $category = Category::find($id);
        // if($category->posts->count() > 0){
        //     Session()->flash('error','ไม่สามารถลบได้เนื่องจากมีชื่อบทความใช้งานอยู่');
        //     return redirect()->back();
        // }
        CategoryModel::find($id)->delete();
        Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
        return redirect('/category');
    }

    public function search_datatable(Request $request)
    {
        $search = $request->get('search');
        $query = CategoryModel::query();
        $columns = ['name_th', 'name_en'];

        foreach ($columns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        }

        $category = $query->paginate(10);
        return view('admin.category.search', compact('category', 'search'));
    }
}
