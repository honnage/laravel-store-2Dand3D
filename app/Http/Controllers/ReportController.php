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
        return view('report.details', 
            compact('categories','typefiles','formats','licenses','asset'));
    }

}
