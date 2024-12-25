<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMd extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
