<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotLog extends Model
{
    protected $table = 'chatbot_logs';
    protected $fillable = ['conversation_id', 'user_id', 'user_input'];
}
