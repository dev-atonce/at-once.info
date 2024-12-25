<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class BlogCtrl extends Controller
{
    public function __construct(Request $request)
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
        $this->perPage = 24;
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$get->id)
            return $get->id;
        else
            return '';
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $get = \App\Models\CategoryMd::select('id', "name_$lang as name")->where('key', $this->category)->first();
        if (@$get->id)
            return $get->name;
        else
            return '';
    }
    public function index(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog');
        $lang = Session('lang');
        $blog_path = (request()->segment(2) == 'blog') ? 'blog' : request()->segment(2) . "/blog";

        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-skyblue',
            '_border'=>'--border-skyblue',
            'seo' => $seo
        ]);

    }

    public function companyBlogCustomer(Request $request, $id = null, $comName = null)
    {
        $head = __('phrase.blog.blog');
        $lang = Session('lang');

        $blog_path = (request()->segment(2) == 'blog') ? 'blog' : request()->segment(2) . "/blog";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $comName,
            'blog_path' => $blog_path,
            '_color'=>'--c-skyblue',
            '_border'=>'--border-skyblue',
            'seo' => $seo
        ]);

    }

    public function companyBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-company');
        $lang = Session('lang');
        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => __('phrase.blog.other'),
            'segment' => request()->segment(2),
            'categoryId' => $this->categoryId(),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-blue',
            '_border'=>'--border-blue',
            'seo' => $seo
        ]);
    }

    public function reviewBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-review');
        $lang = Session('lang');

        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-blue',
            '_border'=>'--border-blue',
            'seo' => $seo
        ]);
    }

    public function customerBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-customer');
        $lang = Session('lang');

        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-blue',
            '_border'=>'--border-blue',
            'seo' => $seo
        ]);
    }

    public function promotionBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-promotion');
        $lang = Session('lang');

        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-skyblue',
            '_border'=>'--border-skyblue',
            'seo' => $seo
        ]);
    }

    public function wtsBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-wts');
        $lang = Session('lang');

        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-blue',
            '_border'=>'--border-blue',
            'seo' => $seo
        ]);
    }

    public function wtbBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-wtb');
        $lang = Session('lang');

        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-blue',
            '_border'=>'--border-blue',
            'seo' => $seo
        ]);
    }

    public function packageBlog(Request $request, $tag = null)
    {
        $head = __('phrase.blog.blog-marketing');
        $lang = Session('lang');
        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            '_color'=>'--c-orange',
            '_border'=>'--border-orange',
            'seo' => $seo
        ]);
    }

    public function detail(Request $request, $id = null)
    {
        $lang = Session('lang');

        $searchUrl = $lang . '/' . $request->segment(2);

        $get_blog = \App\Models\BlogMd::select([
            'blog.id',
            "blog.name_$lang as name",
            "blog.name_th",
            "blog.detail_$lang as detail",
            "blog.detail_th",
            'blog.created',
            'blog.publish',
            'blog.images',
            'blog.view',
            "blog.seo_keyword_$lang as seo_keyword",
            "blog.seo_description_$lang as seo_description",
            'blog.url_th as url',
            "blog.company as companyId",
            "category.key",
            "category.name_$lang as categoryName",
            "cp.name_$lang as company",
            "cp.name_en as companyEN",
            "cp.name_jp as companyJP",
            "cp.logo",
            'cp.profile_url',
            'cp.website',
            "blog.recommend",
            "blog.reference",
            "blog.company as comid",
            "blog.for_company as forid",
            "blog.type",
            "blog.language",
            "our_customer.id as customerId",
            "our_customer.deleted as customerStatus",
        ])
            ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
            ->leftJoin('our_customer', 'cp.id', 'our_customer.company')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->where(function ($query) use ($id) {
                $query->where('blog.url_th', $id)
                    ->orWhere('blog.name_th', str_replace('-', ' ', $id));
            })
            ->where('blog.status', 1)
            ->first();

        if (@$get_blog->type == 'marketing-blog') {
            $blogReccommend = \App\Models\BlogMd::where('type', 'marketing-blog')->where('status', 1)->whereNotIn('id', [$get_blog->id])->get();
        }
        if (@$get_blog->type == 'customer') {
            $blogReccommend = \App\Models\BlogMd::select('blog.id', 'blog.url_th', 'blog.images', "blog.name_$lang as name", "blog.name_th", 'blog.created', 'blog.view')
                ->join('our_customer', 'blog.company', 'our_customer.company')
                ->where(['blog.type' => 'customer', 'blog.status' => 1, 'blog.company' => $get_blog->comid, 'our_customer.deleted' => NULL])
                ->whereNotIn('blog.id', [$get_blog->id])
                ->limit(6)
                ->get();
        }

        if (!empty($get_blog)) {
            \App\Models\BlogMd::where(['id' => $get_blog->id])->increment('view');
            $st = new \App\Models\BlogStMd;
            $st->ip = \App\Helpers\BaseHp::get_client_ip();
            $st->blog = $get_blog->id;
            $st->company = $get_blog->companyId;
            $st->created = date('Y-m-d H:i:s');
            $st->save();
            return view("$this->prefix.blog-detail", [
                'prefix' => $this->prefix,
                'module' => $this->category,
                'moduleName' => $this->categoryName(),
                'row' => $get_blog,
                'tags' => DB::table('blog_join_tag as join')->select('tag.tag')->leftJoin('tag', 'tag.id', '=', 'join.tag_id')->where('join.blog_id', $get_blog->id)->get(),
                'blog_path' => ($this->category == 'blog') ? 'blog' : $this->category . "/blog",
                'searchUrl' => $searchUrl,
                'blogReccommend' => @$blogReccommend,
                'lang' => $lang
            ]);
        } else {
            abort(404);
            return view("error.404", ['prefix' => $this->prefix]);
        }
    }

    public function preview(Request $request, $id = null)
    {
        $lang = Session('lang');
        $get = \App\Models\BlogMd::select([
            'blog.id',
            "blog.name_$lang as name",
            "blog.detail_$lang as detail",
            'blog.created',
            'blog.images',
            'blog.view',
            "blog.seo_keyword_$lang as seo_keyword",
            "blog.seo_description_$lang as seo_description",
            'blog.url_th as url',
            "blog.language",
            "blog.company as comid",
            "blog.for_company as forid",
            "cp.name_$lang as company",
            "cp.name_en as companyEN",
            "cp.name_jp as companyJP",
            "cp.logo",
            'cp.profile_url',
            "blog.recommend",
            "blog.reference"
        ])
            ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
            ->where('blog.id', $id)
            ->first();

        $get_blog_menu = \App\Models\BlogMd::select('id', 'name_th as name', 'created', 'images', 'view', 'url_th as url')->where(['type' => $this->categoryId(), 'status' => 1])->where('url_th', '!=', $id)->limit(5)->inRandomOrder()->get();

        if (@$get->id) {
            $get_tag = DB::table('blog_join_tag as join')->select('tag.tag')->leftJoin('tag', 'tag.id', '=', 'join.tag_id')->where('join.blog_id', $get->id)->get();
            $blog_path = ($this->category == 'blog') ? 'blog' : $this->category . "/blog";
            return view("$this->prefix.blog-preview", [
                'prefix' => $this->prefix,
                'module' => $this->category,
                'moduleName' => $this->categoryName(),
                'row' => $get,
                'blog_menu' => $get_blog_menu,
                'tags' => $get_tag,
                'blog_path' => $blog_path
            ]);
        } else {
            return view('errors/404', [
                'prefix' => $this->prefix
            ]);
            // abort(404);
        }
    }

    public function jobSearch(Request $request, $tag = null)
    {
        $lang = Session('lang');

        $head = 'หางาน';

        $blog_path = (request()->segment(2) == 'jobs-search') ? 'job-search' : request()->segment(2) . "/job-search";
        // $rows->appends(['category' => $request->category, 'keywords' => $request->keyword, 'page' => $request->page]);
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.blog", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => $this->categoryName(),
            'categoryId' => $this->categoryId(),
            'segment' => request()->segment(2),
            'head' => $head,
            'perPage' => $this->perPage,
            'tag' => $tag,
            'blog_path' => $blog_path,
            'seo' => $seo,
            '_color'=>'--c-blue',
            '_border'=>'--border-blue',
        ]);
    }

    public function jobDetail($url = null)
    {
        $lang = Session('lang');
        $data = \App\Models\BlogMd::select([
            'blog.id',
            'blog.name_th as name',
            'blog.detail_th as detail',
            'blog.created',
            'blog.images',
            'blog.view',
            'blog.seo_keyword',
            'blog.seo_description',
            'blog.url_th as url',
            "cp.id as companyId",
            "cp.category",
            "cp.name_$lang as company",
            "cp.logo",
            'cp.profile_url',
            "blog.recommend",
            "blog.reference",
            "blog.gForJob"
        ])
            ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
            ->where("blog.url_$lang", $url)
            ->first();

        $get_blog_menu = \App\Models\BlogMd::select('id', 'name_th as name', 'created', 'images', 'view', 'url_th as url')->where(['language' => $lang, 'status' => 1])->where('url_th', '!=', $url)->limit(5)->inRandomOrder()->get();

        if (@$data->id) {
            $get_tag = DB::table('blog_join_tag as join')->select('tag.tag')->leftJoin('tag', 'tag.id', '=', 'join.tag_id')->where('join.blog_id', $data->id)->get();
            $blog_path = ($this->category == 'blog') ? 'blog' : $this->category . "/blog";
            return view("$this->prefix.job-detail", [
                'prefix' => $this->prefix,
                'module' => $this->category,
                'moduleName' => $this->categoryName(),
                'categoryId' => $this->categoryId(),
                'row' => $data,
                'blog_menu' => $get_blog_menu,
                'tags' => $get_tag,
                'blog_path' => $blog_path
            ]);
        } else {
            return view("errors.404", ['prefix' => $this->prefix]);
        }
    }


    public static function inMainPage($type, $limit = null)
    {
        $hl = Session('lang');
        $langBlog = (Session('lang') == 'th') ? 1 : 2;
        $data = \App\Models\BlogMd::select([
            'blog.id',
            "blog.name_$hl as name",
            "category.key",
            "category.name_$hl as categoryName",
            'blog.created',
            'blog.images',
            'blog.view',
            'blog.url_th as url',
            'blog.publish',
            'blog.type',
            'blog.more_th as detail',
            'cp.logo as by_logo',
            "cp.name_$hl as by",
            'cp.profile_url as by_url'
        ])
            ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
            ->leftJoin('category', 'blog.category', '=', 'category.id')
            ->where([
                'blog.category' => $type,
                'blog.language' => $langBlog,
                'blog.status' => 1,
                'blog.type' => 'general'
            ])
            ->orderBy('blog.publish', 'desc');
        if ($limit != null)
            $data->limit($limit);
        return $data->get();
    }

    public static function inMainPageCompany($type, $limit = null)
    {
        $hl = Session('lang');
        $langBlog = (Session('lang') == 'th') ? 1 : 2;
        $data = \App\Models\BlogMd::select([
            'blog.id',
            "blog.name_$hl as name",
            "category.key",
            "category.name_$hl as categoryName",
            'blog.created',
            'blog.images',
            'blog.view',
            'blog.url_th as url',
            'blog.publish',
            'blog.type',
            'blog.more_th as detail',
            'cp.logo as by_logo',
            "cp.name_$hl as by",
            'cp.profile_url as by_url'
        ])
            ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
            ->leftJoin('category', 'blog.category', '=', 'category.id')
            ->whereIn('blog.type', ['review', 'promotion', 'job-search', 'want-to-sale', 'want-to-buy', 'customer'])
            ->where([
                'blog.category' => $type,
                'blog.language' => $langBlog,
                'blog.status' => 1,
            ])
            ->orderBy('blog.publish', 'desc');
        if ($limit != null)
            $data->limit($limit);
        return $data->get();
    }

}