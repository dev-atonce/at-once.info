<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMd extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $fillable = ['id','alpha2','alpha3','country','nationality'];
    public $timestamps = false;
}
