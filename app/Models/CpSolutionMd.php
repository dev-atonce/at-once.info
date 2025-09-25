<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpSolutionMd extends Model
{
    use HasFactory;
    protected $table = 'cp_solution';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','solution','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}
