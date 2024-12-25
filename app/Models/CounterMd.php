<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterMd extends Model
{
    use HasFactory;
    protected $table = 'counter';
    public $timestamps = false;
}
