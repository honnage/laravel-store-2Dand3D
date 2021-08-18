<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    protected $table = "asset";
    protected $fillable = [
        'user_id',
        // 'asset_id',
        'display_name',
        'description',
        'image',
        'asset_path',
        'asset_type',
        'asset_size',
        'model_path',
        'model_type',
        'model_size',
        'price',
        'status_show',
        'category_id',
        'typefile_id',
        'license_id',
    ];

    public function category(){
        return $this->belongsTo(CategoryModel::class);
    }

    public function typefile(){
        return $this->belongsTo(TypefileModel::class);
    }

    public function license(){
        return $this->belongsTo(LicenseModel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
