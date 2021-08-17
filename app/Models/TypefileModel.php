<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypefileModel extends Model
{
    protected $table = "typefile";
    protected $fillable = [
        'name',
        'formats',
        'description'
    ];

    public function asset(){
        return $this->hasMany(AssetModel::class, 'typefile_id');   
    }
}
