<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;
use App\Models\LicenseModel;

class WelcomeController extends Controller
{
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


}
