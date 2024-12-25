<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMailLogMd extends Model
{
    use HasFactory;
    protected $table = 'customer_mail_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
