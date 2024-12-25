<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogOfModifiedMd extends Model
{
    use HasFactory;
    protected $table = 'company_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
