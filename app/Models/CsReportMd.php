<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsReportMd extends Model
{
    use HasFactory;
    protected $table = 'report_cs';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
