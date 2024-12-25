<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberMd extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = ['id','email','email_verified_at','password','remember_token','status'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}