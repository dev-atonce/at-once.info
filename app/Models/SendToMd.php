<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendToMd extends Model
{
    use HasFactory;
    protected $table = 'send_to';
    protected $primaryKey = 'id';
    protected $fillable = ['to','company','telephone','branch','name','email','content','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
