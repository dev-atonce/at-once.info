<?php

namespace App\Models\Webpanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLogMd extends Model
{
    use HasFactory;
    protected $table = 'job_log';
    public $timestamps = true;
}
