<?php

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpConditionMd extends Model
{
    use HasFactory;
    protected $table = 'cp_condition';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','condition','created'];
    public $timestamps = false;
}
