<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAppointmentMd extends Model
{
    use HasFactory;
    protected $table = 'job_appointment';
    protected $primaryKey = 'id';
} 
