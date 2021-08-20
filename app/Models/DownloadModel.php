<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadModel extends Model
{
    protected $table = "download";
    protected $fillable = [
        'user_id',
        'asset_id'
    ];

    public function asset(){
        return $this->belongsTo(AssetModelser::class);
    }
}
