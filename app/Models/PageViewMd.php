<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageViewMd extends Model
{
    use HasFactory;
    protected $table = 'page_view';
    public $timestamps = false;
}
