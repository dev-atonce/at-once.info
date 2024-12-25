<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsMd extends Model
{
    use HasFactory;
    protected $table = 'ads';
    public $timestamp = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
