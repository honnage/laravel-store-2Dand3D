<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseModel extends Model
{
    protected $table = "license";
    protected $fillable = [
        'name_th',
        'name_en'
    ];

    public function asset(){
        return $this->hasMany(AssetModel::class, 'license_id');     
    }
}
