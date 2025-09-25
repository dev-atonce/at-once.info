<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpRentalMd extends Model
{
    use HasFactory;
    protected $table = 'cp_rental';
    public $timestamps = false;
}
