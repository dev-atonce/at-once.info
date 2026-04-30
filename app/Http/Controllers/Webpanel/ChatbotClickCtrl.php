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
}
