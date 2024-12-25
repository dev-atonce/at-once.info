<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLogTimeMd extends Model
{
    use HasFactory;
    protected $table = 'visitor_log_time';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
