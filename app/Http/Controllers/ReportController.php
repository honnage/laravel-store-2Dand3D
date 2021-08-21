<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use App\Models\LicenseModel;
use App\Models\ReportModel;

class ReportController extends Controller
{
    public function report($id){
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        $licenses = LicenseModel::all();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $asset = AssetModel::find($id);
        return view('report.index', 
            compact('categories','typefiles','formats','licenses','asset'));
    }

    public function store(Request $request, $id){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'description' => 'required|max:191',
            ],
            [
                'description.required' => "กรุณาป้อนคำอธิบาย",
                'description.max' => "ห้ามป้อนคำอธิบายเกิน 191 ตัวอักษร",
            ]
        );
        $report = new ReportModel;
        $report->user_id = Auth::user()->id;
        $report->asset_id = $id;
        $report->description = $request->description;
        $report->save();
        session()->flash("success", "รายงานเรียนร้อย!");
        return redirect('/');
    }

    public function datails($id){
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        $licenses = LicenseModel::all();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $asset = AssetModel::find($id);
        $report = ReportModel::where('asset_id', $id)->paginate(10);
        return view('report.details', 
            compact('categories','typefiles','formats','licenses','asset','report'));
    }

    public function edit($id){
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        $licenses = LicenseModel::all();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $asset = AssetModel::find($id);
        return view('admin.report.edit', 
            compact('categories','typefiles','formats','licenses','asset'));
    }

    
    public function edit_show_asset(Request $request, $id){
        //ตรวจสอบข้อมูล
        $request->status_show;
        $asset = AssetModel::find($id);

        if($request->status_show == 99){ 
            $report = new ReportModel;
            $report->user_id = Auth::user()->id;
            $report->asset_id = $id;
            $report->description = "แอดมินได้ดำเนินการตรวจสอบ ชิ้นงานของคุณได้รับการรายที่ไม่เหมาะ จึงปิดการแสดงชิ้นงาน";
            $report->save(); 
        }

        if($request->status_show == 1){
            $report = new ReportModel;
            $report->user_id = Auth::user()->id;
            $report->asset_id = $id;
            $report->description = "แอดมินได้การแก้ไขการแสดงชิ้นงานของคุณเป็นรูปแบบ โมเดล";
            $report->save();
        }
        
        if($request->status_show == 0){
            $report = new ReportModel;
            $report->user_id = Auth::user()->id;
            $report->asset_id = $id;
            $report->description = "แอดมินได้การแก้ไขการแสดงชิ้นงานของคุณเป็นรูปแบบ รูปภาพ";
            $report->save();
        }

        DB::table('asset')
        ->where('id', '=', $asset->id)
        ->update([
            'status_show' => $request->status_show,
            'updated_at' => now(),
        ]);

        session()->flash("success", "แก้ไขเรียบร้อบ!");
        return redirect('/asset/dashboard');
    }

}
