<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDiMd extends Model
{
    use HasFactory;
    protected $table = 'job_di';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
