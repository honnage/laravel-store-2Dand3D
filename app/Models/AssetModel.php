<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    protected $table = "asset";
    protected $fillable = [
        'user_id',
        'display_name',
        'description',
        'image',
        'asset',
        'model_path',
        'model_type',
        'model_size',
        'price',
        'category_id',
        'typefile_id',
        'license_id',
    ];

    public function category(){
        return $this->belongsTo(CategoryModel::class);
    }

    public function typefile(){
        return $this->belongsToMany(TypefileModel::class);
    }

    public function license(){
        return $this->belongsTo(LicenseModel::class);
    }
}
