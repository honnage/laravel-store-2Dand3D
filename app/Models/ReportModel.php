<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    protected $table = "report";
    protected $fillable = [
        'user_id',
        'asset_id',
        'description'
    ];

    public function asset(){
        return $this->belongsTo(AssetModelser::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
