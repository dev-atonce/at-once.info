<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmailLogMd extends Model
{
    use HasFactory;
    protected $table = 'contact_email_log';
    public $timestamps = false;
}
