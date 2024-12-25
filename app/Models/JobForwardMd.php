<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobForwardMd extends Model
{
    use HasFactory;
    protected $table = 'job_forward';
    public $timestamps = false;
}
