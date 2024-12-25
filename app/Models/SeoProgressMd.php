<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoProgressMd extends Model
{
    use HasFactory;
    protected $table = 'seo_progress';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
