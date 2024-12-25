<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMd extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $primaryKey = 'id';
    public $timestamps = false;
    const CREATED_AT = 'created';

}
