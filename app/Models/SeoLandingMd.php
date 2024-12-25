<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeoLandingMd extends Model
{
    use HasFactory;
    protected $table = 'seo_landing_page';
    protected $primaryKey ='id';
    public $timestamps = false;
}