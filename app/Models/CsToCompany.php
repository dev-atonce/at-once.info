<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsToCompany extends Model
{
    use HasFactory;
    protected $table = 'to_company';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
