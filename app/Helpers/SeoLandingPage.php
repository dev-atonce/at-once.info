<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class SeoLandingPage
{
    public static function getLandingSeoKeyword($lang)
    {
        $lang = $lang ? $lang : 'th';
        $path = @$_SERVER['REQUEST_URI'];

        if (preg_match("/about-us/i", $path) == true) {
            $pattern = 'about-us';
        }
        if (preg_match("/category/i", $path) == true) {
            $pattern = 'category';
        }
        if (preg_match("/blog/i", $path) == true) {
            $pattern = 'blog';
        }
        if (preg_match("/blog-company/i", $path) == true) {
            $pattern = 'blog-company';
        }
        if (preg_match("/job-search/i", $path) == true) {
            $pattern = 'job-search';
        }
        if (preg_match("/promotion-package/i", $path) == true) {
            $pattern = 'promotion-package';
        }
        if (preg_match("/contact/i", $path) == true) {
            $pattern = 'contact';
        }
        if (preg_match("/condition/i", $path) == true) {
            $pattern = 'condition';
        }
        if (preg_match("/privacy-policy/i", $path) == true) {
            $pattern = 'privacy-policy';
        }
        if (preg_match("/faq/i", $path) == true) {
            $pattern = 'faq';
        }

        $data = \App\Models\SeoLandingMd::select([
            "seo_keyword_$lang as seo_keyword",
            "seo_keyword_th",
            "seo_description_$lang as seo_description",
            "seo_description_th",
            "title_$lang as title",
            "title_th"
        ]);

        if (@$pattern != '') {
            $query = $data->where('path', $pattern);
            $rows = $query->first();
        } else {
            $query = $data->where('page', 'HomePage');
            $rows = $query->first();
        }

        return $rows;
    }

    public static function getCategorySeoKeyword($id = null, $lang)
    {
        $lang = $lang ? $lang : 'th';
        $data = \App\Models\CategoryMd::select([
            "seo_keyword_$lang as seo_keyword",
            "seo_keyword_th",
            "seo_description_$lang as seo_description",
            "seo_description_th",
            "title_$lang as title",
            "title_th"
        ])
        ->find($id);

        if ($data && $data->title) {
            $data->title = str_replace(" - ", " | ค้นหาพันธมิตร B2B | ", $data->title);
        }

        return $data;
    }
}

