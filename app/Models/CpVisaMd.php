<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpVisaMd extends Model
{
    use HasFactory;
    protected $table = 'cp_visa';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','visa','created'];
    public $timestamps = false;
}
