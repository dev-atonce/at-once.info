<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorMd extends Model
{
    use HasFactory;
    protected $table = 'sponsor';
    protected $primaryKey = 'id';
    protected $fillable = ['_id','package','start','end','created'];
    public $timestamps = false;
}
