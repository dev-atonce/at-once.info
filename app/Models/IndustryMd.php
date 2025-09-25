<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IndustryMd extends Model
{
    use HasFactory;
    protected $table = 'industry';
    protected $primaryKey = 'id';
    protected $fillable = ['name_jp','name_th','key','image','controller','created','updated','seo_keyword_th', 'seo_description_th'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public function company()
    {
        return $this->belongsTo(CompanyMd::class,'id','industry');
    }

    // public function newCollection(array $models = [])
    // {   
    //     return new \App\Collections\OnlineCollection($models);
    // }


}
