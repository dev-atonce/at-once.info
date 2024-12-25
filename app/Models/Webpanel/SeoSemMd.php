<?php

namespace App\Models\Webpanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSemMd extends Model
{
    use HasFactory;
    protected $table = 'seo_sem';
    protected  $primaryKey  = 'id';
    public $timestamps = false;
}
