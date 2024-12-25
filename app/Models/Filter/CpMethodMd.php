<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpMethodMd extends Model
{
    protected $table = 'cp_method';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','method','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}