<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use App\Models\LicenseModel;
use App\Models\User;

class WelcomeController extends Controller{
    public function index(Request $request){
        $query = AssetModel::query();
        $search = $request->get('search');
        if($search){
            $columns = ['display_name'];
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }
            $asset = $query->paginate(16);
        }else{
            $asset = AssetModel::orderBy('updated_at', 'desc')->paginate(16);  
        }
    
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();

        return view('welcome', compact('asset','categories','typefiles','licenses','formats'));
    }

    public function search_category(Request $request, $id){
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $asset = AssetModel::where('category_id', $id)->orderBy('updated_at', 'desc')->paginate(16);
        return view('welcome', 
            compact('asset','categories','typefiles','formats','licenses'));
    }

    public function search_formats(Request $request, $id){
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $asset = AssetModel::where('formats', $id)->orderBy('updated_at', 'desc')->paginate(16);
        return view('welcome', 
            compact('asset','categories','typefiles','formats','licenses'));
    }

    public function search_typefile(Request $request, $id){
        $categories = CategoryModel::get();
        $typefiles = TypefileModel::get();
        $licenses = LicenseModel::get();
        $formats = TypefileModel::select('formats')->groupBy('formats')->orderBy('formats', 'desc')->get();
        $asset = AssetModel::where('typefile_id', $id)->orderBy('updated_at', 'desc')->paginate(16);
        return view('welcome', 
            compact('asset','categories','typefiles','formats','licenses'));
    }

}
