<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurPackageMd extends Model
{
    use HasFactory;
    protected $table = 'our_package';
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
