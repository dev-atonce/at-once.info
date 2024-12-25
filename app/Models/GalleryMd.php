<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryMd extends Model
{
    use HasFactory;

    protected $table = 'cp_gallery';
    public $timestamps = false;
}
