<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AssetModel;
use App\Models\CategoryModel;
use App\Models\TypefileModel;

class TestController extends Controller
{
    public function test_show_model(){
        return view('testpage.showmodel_test');
    }

    public function test_uploadfile(){
        $user = Auth::user();
        $categories = CategoryModel::all();
        $typefiles = TypefileModel::all();
        return view('testpage.test', compact('user','categories','typefiles'));
    }

    public function single_upload(Request $request){
        $data['fileName'] = $request->file('photo')->getClientOriginalName();
        $data['fileType'] = $request->file('photo')->getClientOriginalExtension();
        $data['fileSize'] = $request->file('photo')->getSize();
        $request->file('photo')->move(public_path('images'), $request->file('photo')->getClientOriginalName());
        return view('testpage.success1')->with($data);
    }

    public function multiple_upload(Request $request){
        $photoInfos = array();
        if($request->hasFile('photos')){
            $photos = $request->file('photos');
            foreach($photos as $photo){
                array_push($photoInfos, array(
                    'fileName' => $photo->getClientOriginalName(),
                    'fileType' => $photo->getClientOriginalExtension(),
                    'fileSize' => $photo->getSize(),
                ));
                $photo->move(public_path('images'),  $photo->getClientOriginalName());
            }
        }
        $data = array(
            'photos' => $photoInfos
        );
        return view('testpage.success2')->with($data);
    }

}
