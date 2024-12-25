<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictMd extends Model
{
    use HasFactory;
    protected $table = 'district';
    protected $primaryuKey = 'district_id';
    public $timestamps = false;
}
