<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BlogCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCustomerResource;
use App\Models\BlogMd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class BlogCtrl extends Controller
{
    public function count()
    {
        $count = 0;

        switch ($case) {

            case 'all':
                $count = \App\Models\BlogMd::count();
                break;

            case 'online':
                $count = \App\Models\BlogMd::whereNotNull('publish')->count();
                break;

            case 'offline':
                $count = \App\Models\BlogMd::whereNull('publish')->count();
                break;

            default;
        }

        return response()->json([
            'count' => $count
        ]);
    }
    public function todayActivity($goal = null)
    {
        try {
            $BlogMd = \App\Models\BlogMd::class;
            $now = date('Y-m-d');

            $created = $BlogMd::where(db::raw('DATE(created)'), 'like', $now)->count();
            $per_created = (($created * 100) / $goal);

            $online = $BlogMd::where(db::raw('DATE(publish)'), 'like', $now)->count();
            $per_online = (($online * 100) / $goal);

            $todaySelect = ['blog.id', 'category.name_jp as categoryName', 'category.key', 'category.id as categoryId', 'blog.name_th', 'blog.created', 'blog.created_by', 'blog.publish', 'blog.published_by'];
            $query = $BlogMd::select($todaySelect)->leftJoin('category', 'blog.category', '=', 'category.id');

            return response()->json([
                'blog-created' => [
                    'data' => $query->where(db::raw('DATE(blog.created)'), 'like', $now)->get(),
                    'count' => $created,
                    'percent' => $per_created
                ],
                'blog-online' => [
                    'data' => $query->where(db::raw('DATE(blog.publish)'), 'like', $now)->get(),
                    'count' => $online,
                    'percent' => $per_online
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json($e);

        }
    }

    public function getAllBlog(Request $request, $type = null, $tag = null)
    {
        try {
            // $lang = Session('lang') ? Session('lang') : 'th';
            $lang = $request->lang ? $request->lang : 'th';
            $category = $request->category;
            $keywords = $request->keywords;

            $by = $request->by ? $request->by : 'publish';
            $sort = $request->sort ? $request->sort : 'desc';
            $perPage = $request->perPage ? $request->perPage : 24;
            $page = $request->page ? $request->page : 1;
            $skip = ($page < 2) ? 0 : ($page - 1) * $perPage;

            $url = url("$lang/");
            $path = url('/');

            $query = BlogMd::leftJoin('category as c', 'blog.category', '=', 'c.id')
                ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
                ->select([
                    "blog.id",
                    "blog.name_$lang as name",
                    "blog.name_th",
                    "c.key",
                    "c.name_$lang as categoryName",
                    "blog.more_$lang as description",
                    "blog.more_th",
                    "blog.type as blogType",
                    "blog.view",
                    "cp.name_$lang as by",
                    db::raw("CONCAT('$path/',blog.images) as cover"),
                    db::raw("CONCAT('$url/',cp.profile_url) as by_url"),
                    db::raw("CONCAT('$path/',cp.logo) as by_logo"),
                    db::raw("CONCAT('$url/blog/',blog.url_th) as url"),
                    db::raw('DATE_FORMAT(blog.publish, "%Y-%m-%d, %H:%i") as publish'),
                ])
                ->where('blog.status', 1)
                ->where(function ($query) use ($type) {
                    if ($type == 'company') {
                        $query->whereIn('blog.type', [
                            'job-search',
                            'want-to-sale',
                            'want-to-buy',
                            'promotion',
                            'customer',
                            'selfedit',
                            'review'
                        ]);
                    } else if ($type == 'customer') {
                        $query->where('blog.type', 'customer')->orwhere('blog.type', 'selfedit');
                    } else {
                        $query->where('blog.type', $type);
                    }
                })
                ->when($tag, function ($query) use ($tag) {
                    $query->leftJoin('blog_join_tag as join', 'blog.id', 'join.blog_id')
                        ->leftJoin('tag', 'join.tag_id', 'tag.id');
                    return $query->where(function ($query) use ($tag) {
                        return $query->whereRaw('REPLACE(tag.tag," ","") LIKE ?', ["%" . str_replace(' ', '', $tag) . "%"]);
                    });
                })
                ->when($request->keywords, function ($query) use ($keywords) {
                    $query->where(function ($query) use ($keywords) {
                        $query
                            ->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                    });
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('blog.category', $category);
                })
                ->groupBy('blog.id')
                ->when($request->sort, function ($query) use ($by, $sort) {
                    $query->orderBy("blog.$by", $sort);
                });

            $allPage = ceil($query->get()->count() / $perPage);

            $queryString = "?by=$by&sort=$sort&page=$page";

            $response = [
                'data' => $query->skip($skip)->take($perPage)->get(),
                'links' => [
                    'allPage' => $allPage,
                    'perPage' => $perPage,
                    'by' => $by,
                    'sort' => $sort,
                    'page' => $page,
                    'lang' => $lang,
                    'query_string' => $queryString
                ]
            ];

            return new BlogCollection($response);
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
        }
    }

    public function blogCompany(Request $request, $id = null, $comName = null)
    {
        try {

            $lang = (Session('lang') == 'th') ? 1 : 2;
            $hl = Session('lang') ? Session('lang') : 'th';
            $category = $request->catgory;
            $keywords = $request->keywords;

            $by = $request->by ? $request->by : 'publish';
            $sort = $request->sort ? $request->sort : 'desc';
            $perPage = $request->perPage ? $request->perPage : 24;
            $page = $request->page ? $request->page : 1;
            $skip = ($page < 2) ? 0 : ($page - 1) * $perPage;

            $url = url('th/');
            $path = url('/');

            $query = \App\Models\BlogMd::leftJoin('category as c', 'blog.category', '=', 'c.id')
                ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')

                ->when($request->keywords, function ($query) use ($keywords) {
                    $query->where(function ($query) use ($keywords) {
                        $query
                            ->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                    });
                })
                ->where('blog.status', 1)
                ->where(function ($query) {

                    $query->where('blog.type', 'job-search')
                        ->orwhere('blog.type', 'want-to-sale')
                        ->orwhere('blog.type', 'want-to-buy')
                        ->orwhere('blog.type', 'promotion')
                        ->orwhere('blog.type', 'customer')
                        ->orwhere('blog.type', 'selfedit')
                        ->orwhere('blog.type', 'review');

                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('blog.category', $category);
                })
                ->select([
                    "blog.id",
                    "blog.name_$hl as name",
                    "c.key",
                    "c.name_$hl as categoryName",
                    "blog.more_$hl as description",
                    "blog.view",
                    "blog.type as blogType",
                    "cp.name_$hl as by",
                    db::raw("CONCAT('$path/',blog.images) as cover"),
                    db::raw("CONCAT('$url/',cp.profile_url) as by_url"),
                    db::raw("CONCAT('$path/',cp.logo) as by_logo"),
                    db::raw("CONCAT('$url/blog/',blog.url_th) as url"),
                    db::raw('DATE_FORMAT(blog.publish, "%Y-%m-%d, %H:%i") as publish'),
                ])
                ->groupBy('blog.id')
                ->when($request->sort, function ($query) use ($by, $sort) {
                    $query->orderBy("blog.$by", $sort);
                });

            $allPage = ceil($query->get()->count() / $perPage);
            $queryString = "?by=$by&sort=$sort&page=$page";
            $queryString = ($category != '') ? "$queryString&category=$category" : $queryString;
            $queryString = ($keywords != '') ? "$queryString&keywords=$keywords" : $queryString;

            $response = [
                'data' => $query->skip($skip)->take($perPage)->get(),
                'links' => [
                    'allPage' => $allPage,
                    'perPage' => $perPage,
                    'by' => $by,
                    'sort' => $sort,
                    'page' => $page,
                    'query_string' => $queryString
                ]
            ];

            return new BlogCollection($response);
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
        }
    }

    public function blogPackage(Request $request, $tag = null)
    {
        try {

            $lang = (Session('lang') == 'th') ? 1 : 2;
            $hl = Session('lang') ? Session('lang') : 'th';
            $category = $request->catgory;
            $keywords = $request->keywords;

            $by = $request->by ? $request->by : 'publish';
            $sort = $request->sort ? $request->sort : 'desc';
            $perPage = $request->perPage ? $request->perPage : 20;
            $page = $request->page ? $request->page : 1;
            $skip = ($page < 2) ? 0 : ($page - 1) * $perPage;

            $url = url('th/');
            $path = url('/');

            $query = \App\Models\BlogMd::leftJoin('category as c', 'blog.category', '=', 'c.id')
                ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
                ->where('blog.type', 'marketing-blog')
                ->when($tag, function ($query) use ($tag) {
                    $query->leftJoin('blog_join_tag as join', 'join.blog_id', '=', 'blog.id')
                        ->leftJoin('tag', 'tag.id', '=', 'join.tag_id')
                        ->where('tag.tag', 'like', '%' . $tag . '%');
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('category.id', $category);
                })
                ->when($request->keywords, function ($query) use ($keywords) {
                    $query->where(function ($query) use ($keywords) {
                        $query
                            ->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                    });
                })
                ->where('blog.status', 1)
                ->select([
                    "blog.id",
                    "blog.name_$hl as name",
                    "c.key",
                    "c.name_$hl as categoryName",
                    "blog.more_$hl as description",
                    "blog.type as blogType",
                    "blog.view",
                    "cp.name_$hl as by",
                    db::raw("CONCAT('$path/',blog.images) as cover"),
                    db::raw("CONCAT('$url/',cp.profile_url) as by_url"),
                    db::raw("CONCAT('$path/',cp.logo) as by_logo"),
                    db::raw("CONCAT('$url/blog/',blog.url_th) as url"),
                    db::raw('DATE_FORMAT(blog.publish, "%Y-%m-%d, %H:%i") as publish'),
                ])
                ->groupBy('blog.id')
                ->when($request->sort, function ($query) use ($by, $sort) {
                    $query->orderBy("blog.$by", $sort);
                });


            $allPage = ceil($query->get()->count() / $perPage);
            $queryString = "?by=$by&sort=$sort&page=$page";
            $response = [
                'data' => $query->skip($skip)->take($perPage)->get(),
                'links' => [
                    'allPage' => $allPage,
                    'perPage' => $perPage,
                    'by' => $by,
                    'sort' => $sort,
                    'page' => $page,
                    'query_string' => $queryString
                ]
            ];
            return new BlogCollection($response);

        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
        }
    }

    // template function //

    public function blogForCustomer(Request $request)
    {
        try {
            $hl = $request->lang ? $request->lang : 'th';
            $min = $request->min;
            $max = $request->max;

            $industry = $request->industry;
            $products = $request->products;
            $search = $request->search;
            $opportunity = $request->opportunity;
            $type = $request->type;
            $by = $request->by ? $request->by : 'publish';
            $sort = $request->sort ? $request->sort : 'desc';
            $perPage = $request->perPage ? $request->perPage : 24;
            $page = $request->page ? $request->page : 1;
            $skip = ($page < 2) ? 0 : ($page - 1) * $perPage;

            $url = url('th/');
            $path = url('/');

            $query = BlogMd::leftJoin('category', 'blog.category', '=', 'category.id')
                ->leftJoin('company', 'blog.company', '=', 'company.id')
                ->leftJoin('blog_tcf', 'blog.id', 'blog_tcf.blog_id')
                ->select([
                    "blog.id",
                    "blog.name_$hl as name",
                    "blog.name_th",
                    "category.key",
                    "category.name_$hl as categoryName",
                    "category.name_th as categoryNameTH",
                    "blog.more_$hl as description",
                    "blog.more_th as description_th",
                    "blog.view",
                    "blog.opportunity",
                    "blog.price",
                    "blog_tcf._id as industry",
                    db::raw("CONCAT('$path/',blog.images) as cover"),
                    db::raw("CONCAT('$url/blog-company/',blog.url_th) as url"),
                    db::raw('DATE_FORMAT(blog.publish, "%Y-%m-%d, %H:%i") as publish'),
                ])
                ->where(['blog.status' => 1, 'blog.company' => $request->id, 'blog_tcf.type' => 'industry'])
                ->whereIn('blog.type', $type)
                ->where(function ($query) use ($min, $max) {
                    if ($min && !$max) {
                        $query->where('price', '>', $min);
                    } else if ($max && !$min) {
                        $query->where('price', '<', $max);
                    } elseif ($min && $max) {
                        $query->whereBetween('price', [$min, $max]);
                    }
                })
                ->when($request->search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"]);
                    });
                })
                ->when($request->industry, function ($query) use ($industry) {
                    $query->leftJoin('blog_tcf as ind', 'blog.id', 'ind.blog_id')
                        ->where(['ind._id' => $industry, 'ind.type' => 'industry']);
                })
                ->when($request->products, function ($query) use ($products) {
                    $query->leftJoin('blog_tcf as prod', 'blog.id', 'prod.blog_id')
                        ->whereIn('prod._id', $products)->where(['prod.type' => 'product']);
                })
                ->when($request->opportunity, function ($query) use ($opportunity) {
                    $query->where('blog.opportunity', $opportunity);
                })
                ->groupBy('blog.id')
                ->orderBy('blog.publish', 'desc');

            $allPage = ceil($query->get()->count() / $perPage);

            $queryString = "?by=$by&sort=$sort&page=$page";

            $response = [
                'data' => $query->skip($skip)->take($perPage)->get(),
                'links' => [
                    'allPage' => $allPage,
                    'perPage' => $perPage,
                    'by' => $by,
                    'sort' => $sort,
                    'page' => $page,
                    'query_string' => $queryString
                ]
            ];

            return new BlogCollection($response);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function allBlogForCustomer(Request $request)
    {
        try {
            $hl = $request->lang ? $request->lang : 'th';
            $min = $request->min;
            $max = $request->max;

            $industry = $request->industry;
            $products = $request->products;
            $search = $request->search;
            $opportunity = $request->opportunity;
            $type = $request->type;
            $by = $request->by ? $request->by : 'publish';
            $sort = $request->sort ? $request->sort : 'desc';
            $perPage = $request->perPage ? $request->perPage : 24;
            $page = $request->page ? $request->page : 1;
            $skip = ($page < 2) ? 0 : ($page - 1) * $perPage;

            $url = url('th/');
            $path = url('/');

            $query = BlogMd::leftJoin('category', 'blog.category', '=', 'category.id')
                ->leftJoin('company', 'blog.company', '=', 'company.id')
                ->select([
                    "blog.id",
                    "blog.name_$hl as name",
                    "blog.name_en",
                    "blog.name_th",
                    "category.key",
                    "category.name_$hl as categoryName",
                    "category.name_th as categoryNameTH",
                    "blog.more_$hl as description",
                    "blog.more_th as description_th",
                    "blog.more_en as description_en",
                    "blog.view",
                    "blog.opportunity",
                    "blog.price",
                    db::raw("CONCAT('$path/',blog.images) as cover"),
                    db::raw("CONCAT('$url/blog-company/',blog.url_th) as url"),
                    db::raw('DATE_FORMAT(blog.publish, "%Y-%m-%d, %H:%i") as publish'),
                ])
                ->where(['blog.status' => 1, 'blog.company' => $request->id])
                ->whereIn('blog.type', $type)
                ->where(function ($query) use ($min, $max) {
                    if ($min && !$max) {
                        $query->where('price', '>', $min);
                    } else if ($max && !$min) {
                        $query->where('price', '<', $max);
                    } elseif ($min && $max) {
                        $query->whereBetween('price', [$min, $max]);
                    }
                })
                ->when($request->search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $search) . "%"]);
                    });
                })
                ->when($request->industry, function ($query) use ($industry) {
                    $query->leftJoin('blog_tcf as ind', 'blog.id', 'ind.blog_id')
                        ->where(['ind._id' => $industry, 'ind.type' => 'industry']);
                })
                ->when($request->products, function ($query) use ($products) {
                    $query->leftJoin('blog_tcf as prod', 'blog.id', 'prod.blog_id')
                        ->whereIn('prod._id', $products)->where(['prod.type' => 'product']);
                })
                ->when($request->opportunity, function ($query) use ($opportunity) {
                    $query->where('blog.opportunity', $opportunity);
                })
                ->groupBy('blog.id')
                ->orderBy('blog.publish', 'desc');

            $allPage = ceil($query->get()->count() / $perPage);

            $queryString = "?by=$by&sort=$sort&page=$page";

            $response = [
                'data' => $query->skip($skip)->take($perPage)->get(),
                'links' => [
                    'allPage' => $allPage,
                    'perPage' => $perPage,
                    'by' => $by,
                    'sort' => $sort,
                    'page' => $page,
                    'query_string' => $queryString
                ]
            ];

            return new BlogCollection($response);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function HankyuBlog(Request $request)
    {
        $type = explode(",", $request->type);
        $skip = $request->skip;
        $limit = $request->limit;
        $location = $request->location;
        $position = $request->position;
        $keyword = $request->keyword;
        $url = url('th/');
        $path = url('/');

        try {
            $query = BlogMd::select(
                'name_th as titleTH',
                'name_en as titleEN',
                'more_th as descriptionTH',
                'more_en as descriptionEN',
                db::raw("CONCAT('$path/',blog.images) as thumbnail"),
                db::raw("CONCAT('$url/blog-company/',blog.url_th) as url"),
                'provinces.province_name_en as location'
            )
                ->leftJoin('provinces', 'blog.location', 'provinces.province_id')
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        $query->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->when($request->location, function ($query) use ($location) {
                    return $query->where(function ($query) use ($location) {
                        $query->where('blog.location', $location);
                    });
                })
                ->when($request->position, function ($query) use ($position) {
                    return $query->where(function ($query) use ($position) {
                        $query->where('blog.position', $position);
                    });
                })
                ->whereIn('blog.type', $type)
                ->where(['status' => 1, 'blog.company' => env('HANKYU_ID')])
                ->orderBy('blog.publish', 'desc');

            $response = [
                'total' => $query->count(),
                'data' => $query->skip($skip)->limit($limit)->get(),
                'skip' => $skip,
                'limit' => $limit
            ];

            return new BlogCustomerResource($response);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function RentBlog(Request $request)
    {
        $type = explode(",", $request->type);
        $skip = $request->skip;
        $limit = $request->limit;
        $location = $request->location;
        $position = $request->position;
        $keyword = $request->keyword;
        $url = url('th/');
        $path = url('/');

        try {
            $query = BlogMd::select(
                'name_th as titleTH',
                'name_en as titleEN',
                'more_th as descriptionTH',
                'more_en as descriptionEN',
                db::raw("CONCAT('$path/',blog.images) as thumbnail"),
                db::raw("CONCAT('$url/blog-company/',blog.url_th) as url"),
                'provinces.province_name_en as location',
                'blog.publish'
            )
                ->leftJoin('provinces', 'blog.location', 'provinces.province_id')
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        $query->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->when($request->location, function ($query) use ($location) {
                    return $query->where(function ($query) use ($location) {
                        $query->where('blog.location', $location);
                    });
                })
                ->when($request->position, function ($query) use ($position) {
                    return $query->where(function ($query) use ($position) {
                        $query->where('blog.position', $position);
                    });
                })
                ->whereIn('blog.type', $type)
                ->where(['status' => 1, 'blog.company' => env('RENT_ID')])
                ->orderBy('blog.publish', 'desc');

            $response = [
                'total' => $query->count(),
                'data' => $query->skip($skip)->limit($limit)->get(),
                'skip' => $skip,
                'limit' => $limit
            ];

            return new BlogCustomerResource($response);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function SpeedMoveBlog(Request $request)
    {
        $type = explode(",", $request->type);
        $skip = $request->skip;
        $limit = $request->limit;
        $location = $request->location;
        $position = $request->position;
        $keyword = $request->keyword;
        $url = url('th/');
        $path = url('/');

        try {
            $query = BlogMd::select(
                'name_th as titleTH',
                'name_en as titleEN',
                'more_th as descriptionTH',
                'more_en as descriptionEN',
                db::raw("CONCAT('$path/',blog.images) as thumbnail"),
                db::raw("CONCAT('$url/blog-company/',blog.url_th) as url"),
                'provinces.province_name_en as location',
                'blog.publish'
            )
                ->leftJoin('provinces', 'blog.location', 'provinces.province_id')
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        $query->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->when($request->location, function ($query) use ($location) {
                    return $query->where(function ($query) use ($location) {
                        $query->where('blog.location', $location);
                    });
                })
                ->when($request->position, function ($query) use ($position) {
                    return $query->where(function ($query) use ($position) {
                        $query->where('blog.position', $position);
                    });
                })
                ->whereIn('blog.type', $type)
                ->where(['status' => 1, 'blog.company' => env('SPEEDMOVE_ID')])
                ->orderBy('blog.publish', 'desc');

            $response = [
                'total' => $query->count(),
                'data' => $query->skip($skip)->limit($limit)->get(),
                'skip' => $skip,
                'limit' => $limit
            ];

            return new BlogCustomerResource($response);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function airconBlog(Request $request)
    {
        $type = explode(",", $request->type);
        $skip = $request->skip;
        $limit = $request->limit;
        $location = $request->location;
        $position = $request->position;
        $keyword = $request->keyword;
        $url = url('th/');
        $path = url('/');

        try {
            $query = BlogMd::select(
                'name_th as titleTH',
                'name_en as titleEN',
                'more_th as descriptionTH',
                'more_en as descriptionEN',
                db::raw("CONCAT('$path/',blog.images) as thumbnail"),
                db::raw("CONCAT('$url/blog-company/',blog.url_th) as url"),
                'provinces.province_name_en as location',
                'blog.publish'
            )
                ->leftJoin('provinces', 'blog.location', 'provinces.province_id')
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        $query->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(blog.detail_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->when($request->location, function ($query) use ($location) {
                    return $query->where(function ($query) use ($location) {
                        $query->where('blog.location', $location);
                    });
                })
                ->when($request->position, function ($query) use ($position) {
                    return $query->where(function ($query) use ($position) {
                        $query->where('blog.position', $position);
                    });
                })
                ->whereIn('blog.type', $type)
                ->where(['status' => 1, 'blog.company' => env('AIRCON_ID')])
                ->orderBy('blog.publish', 'desc');

            $response = [
                'total' => $query->count(),
                'data' => $query->skip($skip)->limit($limit)->get(),
                'skip' => $skip,
                'limit' => $limit
            ];

            return new BlogCustomerResource($response);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}
