<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionMd extends Model
{
    use HasFactory;
    protected $table = 'menu_permission';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
