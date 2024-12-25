<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMd extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['name_jp','name_th','key','image','controller','created','updated','seo_keyword_th', 'seo_description_th'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';


    public function company()
    {
        return $this->hasMany(CompanyMd::class,'category','id');
    }

    // public function newCollection(array $models = [])
    // {
    //     return new \App\Collections\OnlineCollection($models);
    // }


}
