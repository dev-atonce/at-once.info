<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClicksMd extends Model
{
    use HasFactory;
    protected $table = 'clicks';
    public $timestamps = false;
}
