<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomesticMd extends Model
{
    protected $table ='domestic';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','transport','created'];
    public $timestamps = false;
}