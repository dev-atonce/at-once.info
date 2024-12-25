<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileCounterMd extends Model
{
    use HasFactory;
    protected $table = 'profile_counter';
    public $timestamps = false;
}
