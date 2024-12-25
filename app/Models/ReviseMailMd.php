<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviseMailMd extends Model
{
    use HasFactory;
    protected $table = 'revise_email';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
