<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpConsultingMd extends Model
{
    use HasFactory;
    protected $table = 'cp_consulting';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','consulting','created'];
    public $timestamps = false;
}
