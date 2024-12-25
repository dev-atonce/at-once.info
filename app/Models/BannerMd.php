<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerMd extends Model
{
    use HasFactory;
    protected $table = 'banner';
    public $timestamps = true;
}
