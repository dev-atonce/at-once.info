<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaTypeMd extends Model
{
    protected $table = 'visa';
    protected $primaryKey = 'id';
    protected $fillalbe = ['id','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}