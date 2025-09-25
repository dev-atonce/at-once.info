<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpStatusMd extends Model
{
    use HasFactory;
    protected $table ='cp_status';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','status','created'];
    public $timestamps = false;
}
