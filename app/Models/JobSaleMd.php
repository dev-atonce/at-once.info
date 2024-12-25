<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSaleMd extends Model
{
    use HasFactory;
    protected $table = 'job_sale';
    protected $primaryKey = 'id';
}
