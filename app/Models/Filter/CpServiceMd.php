<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpServiceMd extends Model
{
    protected $table = 'cp_service';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','service','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}