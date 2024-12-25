<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CompanyMd extends Model
{
    use SoftDeletes;
    
    // use HasFactory;
    protected $table = 'company';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','_id','business','category','name_th','name_jp','nationality','email','address','province','district','srubdistrict','postcode','phone','mobile','fax','logo','cover','service','website','gmap','map_url',
        'description_jp','description_th','detial_jp','detail_th','created','updated'
    ];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';

    public function moreCategory()
    {
        return $this;
    }

    public function gallery()
    {
        return $this->hasMany(\App\Models\Filter\CpGalleryMd::class,'_id');
    }
    public function location()
    {
        return $this->hasMany(\App\Models\Filter\CpLocationMd::class,'_id','id');
    }
    public function warehouse()
    {
        return $this->hasMany(\App\Models\Filter\CpWarehouseMd::class,'_id','id');
    }
    public function category()
    {
        return $this->hasOne(\App\Models\CategoryMd::class,'id','category');
    }
    public function thisCategory()
    {
        //('foreign_key','local_key')
        return $this->hasOne(\App\Models\CategoryMd::class,'id');
    }


    //////////////// Filter ////////////////
    public function other()
    {
        return $this->hasMany(\App\Models\Filter\CpOtherMd::class,'_id','id');
    }

}
