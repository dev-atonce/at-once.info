<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsMd extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = true;

    function gallery()
    {
        return $this->belongsTo(\App\Models\GalleryMd::class,'_id','id');
    }
}
