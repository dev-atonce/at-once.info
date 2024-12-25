<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortMd extends Model
{
    use HasFactory;
    protected $table = 'short_link';
    protected $primaryKey = 'id';
    protected $fillable = ['url','short','created'];
    public $timestamps = false;
}
