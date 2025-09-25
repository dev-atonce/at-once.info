<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpPrintingMd extends Model
{
    use HasFactory;
    protected $table = 'cp_printing';
    protected $fillable = ['_id','type','printing','created'];
}
