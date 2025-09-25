<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobReject extends Model
{
    use HasFactory;
    protected $table = 'job_reject';
    public $timestamps = false;
}
