<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurCustomerMd extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'our_customer';
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    const DELETED_AT = 'deleted';
}
