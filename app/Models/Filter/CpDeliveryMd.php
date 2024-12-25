<?php
namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpDeliveryMd extends Model
{
    protected $table = 'delivery';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','delivery','created','updated'];
    public $timestamps = false;

}