<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpApplianceMd extends Model
{
    use HasFactory;
    protected $table = 'cp_appliance';
    public $timestamps = false;
}
