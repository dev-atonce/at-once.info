<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpInternationalMd extends Model
{
    protected $table = 'international';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','transport','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}