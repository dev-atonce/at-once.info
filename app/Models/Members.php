<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Members extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'members';
    // members has no created_at/updated_at; Laravel 11+ saves the model when it rehashes a password on login
    public $timestamps = false;
    protected $fillable = ['name','email','password'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];
}
