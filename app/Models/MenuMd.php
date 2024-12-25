<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMd extends Model
{
    protected $table = 'tb_menu';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','position','name','icon','url','status','sort'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamp = false;


    
}
