<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpLocationMd extends Model
{
    use HasFactory;
    protected $table = 'cp_location';
    protected $primaryKey = 'id';
    protected $fillable = ['type','_id','location','created'];
    public $timestamps = false;
}
