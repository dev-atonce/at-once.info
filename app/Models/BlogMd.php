<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BlogMd extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $fillable = ['id','images','name_th','name_jp','description_jp','description_th','detial_jp','detail_th','sort','status'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
