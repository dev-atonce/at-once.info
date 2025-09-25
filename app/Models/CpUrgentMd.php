<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpUrgentMd extends Model
{
    use HasFactory;
    protected $table = 'cp_urgent';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','urgent','created'];
    public $timestamps = false;
}
