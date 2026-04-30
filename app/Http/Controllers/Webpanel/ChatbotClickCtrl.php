<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use App\Models\ChatbotProfileClickMd;
use Illuminate\Support\Facades\DB;

class ChatbotClickCtrl extends Controller
{
    public function __construct()
    {
        $this->urlPrefix = 'webpanel';
        $this->prefix = 'back-end';
        $this->module = 'chatbot-clicks';
    }

    /**
     * Display click summary — grouped by company, ordered by total clicks desc.
     */
    public function index()
    {
        $rows = DB::table('chatbot_profile_clicks as c')
            ->select([
                'c.company_id',
                'c.profile_url',
                'c.category',
                DB::raw('COUNT(c.id) as total_clicks'),
                DB::raw('MAX(c.created_at) as last_click'),
                DB::raw("COALESCE(co.name_th, c.profile_url) as company_name"),
            ])
            ->leftJoin('company as co', 'c.company_id', '=', 'co.id')
            ->groupBy('c.company_id', 'c.profile_url', 'c.category', 'co.name_th')
            ->orderByDesc('total_clicks')
            ->paginate(50);

        return view("{$this->prefix}.modules.{$this->module}.index", [
            'prefix' => $this->urlPrefix,
            'folder' => $this->module,
            'page'   => 'index',
            'rows'   => $rows,
        ]);
    }

    /**
     * Show detailed click log for a specific profile URL.
     */
    public function show($profileUrl)
    {
        $logs = ChatbotProfileClickMd::where('profile_url', $profileUrl)
            ->orderByDesc('created_at')
            ->paginate(100);

        $summary = ChatbotProfileClickMd::where('profile_url', $profileUrl)
            ->selectRaw('lang, COUNT(id) as cnt')
            ->groupBy('lang')
            ->get();

        return view("{$this->prefix}.modules.{$this->module}.index", [
            'prefix'      => $this->urlPrefix,
            'folder'      => $this->module,
            'page'        => 'show',
            'profileUrl'  => $profileUrl,
            'logs'        => $logs,
            'summary'     => $summary,
        ]);
    }
    /**
     * Export click summary as CSV.
     */
    public function export()
    {
        $data = DB::table('chatbot_profile_clicks as c')
            ->select([
                'c.company_id',
                'c.profile_url',
                'c.category',
                DB::raw('COUNT(c.id) as total_clicks'),
                DB::raw('MAX(c.created_at) as last_click'),
                DB::raw("COALESCE(co.name_th, c.profile_url) as company_name"),
            ])
            ->leftJoin('company as co', 'c.company_id', '=', 'co.id')
            ->groupBy('c.company_id', 'c.profile_url', 'c.category', 'co.name_th')
            ->orderByDesc('total_clicks')
            ->get();

        $fileName = 'chatbot-clicks_' . date('d-m-Y') . '.csv';

        $headers = [
            'Charset'             => 'utf-8',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $columns = ['No.', 'Company Name', 'Category', 'Profile URL', 'Total Clicks', 'Last Click'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM for Thai
            fputcsv($file, $columns);
            foreach ($data as $k => $row) {
                fputcsv($file, [
                    $k + 1,
                    $row->company_name,
                    $row->category,
                    $row->profile_url,
                    $row->total_clicks,
                    $row->last_click,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->send();
    }

    /**
     * Export detailed click log for a specific profile URL as CSV.
     */
    public function exportDetail($profileUrl)
    {
        $data = ChatbotProfileClickMd::where('profile_url', $profileUrl)
            ->orderByDesc('created_at')
            ->get();

        $fileName = 'chatbot-clicks_' . $profileUrl . '_' . date('d-m-Y') . '.csv';

        $headers = [
            'Charset'             => 'utf-8',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $columns = ['No.', 'Lang', 'IP Address', 'User Agent', 'Clicked At'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $columns);
            foreach ($data as $k => $row) {
                fputcsv($file, [
                    $k + 1,
                    strtoupper($row->lang ?? '-'),
                    $row->ip,
                    $row->user_agent,
                    $row->created_at,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->send();
    }
}
