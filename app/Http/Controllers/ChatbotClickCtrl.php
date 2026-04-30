<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotProfileClickMd;
use App\Models\CompanyMd;

class ChatbotClickCtrl extends Controller
{
    /**
     * Record a chatbot click and redirect to the actual company profile page.
     *
     * URL format: /chatbot/{lang}/{category}/cp/{url}
     * Example:    /chatbot/th/logistics-warehouse-delivery/cp/siamnistrans
     */
    public function track(Request $request, $lang, $category, $url)
    {
        // Lookup company_id from profile_url + category key
        $company = CompanyMd::select('company.id')
            ->join('category', 'company.category', '=', 'category.id')
            ->where('company.profile_url', $url)
            ->where('category.key', $category)
            ->first();

        // Record the click
        ChatbotProfileClickMd::create([
            'company_id'  => $company?->id,
            'profile_url' => $url,
            'category'    => $category,
            'lang'        => $lang,
            'ip'          => $request->ip(),
            'user_agent'  => $request->userAgent(),
        ]);

        // Redirect to the original company profile URL
        return redirect("/{$lang}/{$category}/cp/{$url}");
    }
}
