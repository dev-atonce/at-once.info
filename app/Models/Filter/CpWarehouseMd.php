<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpWarehouseMd extends Model
{
    protected $table = 'cp_warehouse';
    protected $primaryKey = 'id';
    protected $fillable = ['id','type','_id','warehouse','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}