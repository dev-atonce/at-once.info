<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotProfileClickMd extends Model
{
    protected $table = 'chatbot_profile_clicks';
    public $timestamps = false;

    protected $fillable = [
        'company_id',
        'profile_url',
        'category',
        'lang',
        'ip',
        'user_agent',
    ];
}
