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

    public function export()
    {
        $data = ChatbotLog::orderBy('created_at', 'desc')->get();

        $fileName = 'chatbot-logs_' . date('d-m-Y') . '.csv';

        $headers = [
            'Charset'             => 'utf-8',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $columns = ['No.', 'Conversation ID', 'User ID', 'User Input', 'Timestamp'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM for Thai
            fputcsv($file, $columns);
            foreach ($data as $k => $row) {
                fputcsv($file, [
                    $k + 1,
                    $row->conversation_id,
                    $row->user_id,
                    $row->user_input,
                    $row->created_at,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->send();
    }
}
