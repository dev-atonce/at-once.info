<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerClickMd extends Model
{
    use HasFactory;
    protected $table = 'banner_click';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
