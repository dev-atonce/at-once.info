<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpItemMd extends Model
{
    protected $table = 'cp_item';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','item','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}