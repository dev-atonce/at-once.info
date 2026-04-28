<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotLog;

class ChatbotLogCtrl extends Controller
{
    public function __construct()
    {
        $this->urlPrefix = 'webpanel';
        $this->prefix = 'back-end';
        $this->module = 'chatbot-logs';
    }

    public function index()
    {
        // Fetch logs, ordered by newest first, paginated
        $rows = ChatbotLog::orderBy('created_at', 'desc')->paginate(50);

        return view("{$this->prefix}.modules.{$this->module}.index", [
            'prefix' => $this->urlPrefix,
            'folder' => 'chatbot-logs',
            'page' => 'index',
            'rows' => $rows,
        ]);
    }
}
