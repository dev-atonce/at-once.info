<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCategoryMd extends Model
{
    use HasFactory;
    protected $table = 'package_category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public function package()
    {
        return $this->hasMany(\App\Models\PackageMd::class,'package');
    }
    public function price()
    {
        return $this->hasOne(\App\Models\PackageMd::class,'package');
    }
}
