<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRejectMd extends Model
{
    use HasFactory;
    protected $table = 'job_reject';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
