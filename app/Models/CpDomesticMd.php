<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpDomesticMd extends Model
{
    protected $table = 'domestic';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','transport','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}