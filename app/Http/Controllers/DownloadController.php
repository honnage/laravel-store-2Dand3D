<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DownloadModel;
use App\Models\AssetModel;
use Illuminate\Support\Facades\DB;
class DownloadController extends Controller
{
    public function download($id){
        $asset = AssetModel::find($id);
        $download = new DownloadModel;
        $download->user_id = Auth::user()->id;
        $download->asset_id = $asset->id;
        $download->save();

        $path = $asset->asset_path;
        return response()->download($path);
    }
}
