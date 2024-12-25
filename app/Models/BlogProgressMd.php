<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogProgressMd extends Model
{
    use HasFactory;
    protected $table = 'blog_progress';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
