<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = "category";
    protected $fillable = [
        'name_th',
        'name_en'
    ];

    public function asset(){
        return $this->hasMany(AssetModel::class, 'category_id');      
    }
}
