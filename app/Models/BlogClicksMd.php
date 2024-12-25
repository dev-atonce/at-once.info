<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogClicksMd extends Model
{
    use HasFactory;
    protected $table = 'blog_clicks';
    protected $fillable = ['id','blogId','contactId','read_email'];
    public $timestamps = false;
}
