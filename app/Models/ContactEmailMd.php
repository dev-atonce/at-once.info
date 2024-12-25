<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmailMd extends Model
{
    use HasFactory;
    protected $table = 'contact_email';
    protected $fillable = ['id','_id','category','company_name','department','email','telephone'];
    public $timestamps = false;
}
