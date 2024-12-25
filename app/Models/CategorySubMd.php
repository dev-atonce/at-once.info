<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubMd extends Model
{
    use HasFactory;
    protected $table = 'category_sub';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function category()
    {
        return $this->hasMany(\App\Models\CategoryMd::class,'category_sub','id');
    }
}
