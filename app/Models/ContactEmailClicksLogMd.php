<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmailClicksLogMd extends Model
{
    use HasFactory;
    protected $table = 'contact_email_clicks_log';
    public $timestamps = false;

}
