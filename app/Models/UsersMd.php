<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersMd extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['image', 'role', 'position','username', 'email', 'name', 'password'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;
}
