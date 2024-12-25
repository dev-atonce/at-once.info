<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToCompanyIp extends Model
{
    use HasFactory;

    protected $table = 'to_company_ip';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
