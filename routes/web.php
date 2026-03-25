<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeCtrl;
use \App\Http\Controllers\DemoCtrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$lang = ['th','en' , 'jp' , 'zh'];


Route::get('clear/cache',function(){
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});

Route::get('/my-ip',function(){
    $ipaddress = '';
    if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else
        $ipaddress = 'UNKNOWN';

    echo  '<h1>'.$ipaddress.'</h1>';
});
//Redirect 301 Redirect 301 Redirect 301
//Redirect 301 Redirect 301 Redirect 301
Route::redirect('th/contractor-service/blog/5-maintain-the-copyright-of-thailand-as-well','th/blog',301);
Route::redirect('th/conveyor-shelter-rack-construction/cp/cre-form','th',301);
Route::redirect('th/designer/cp/saaithorn-interfurnish','th/interior-decoration/cp/saaithorn-interfurnish',301);
Route::redirect('/jp/logistics/cp/pornvatana-group','/th/logistics/cp/pornvatana-group',301);
Route::redirect("/th/blog/เปรียบเทียบบริษัทขนส่งแต่ละเจ้าในไทย",'compare-transport-companies-in-thailand',301);
Route::redirect(
    "/th/construction/blog/a-collection-of-10-techniques-for-choosing-a-contractor",
    '/th/contractor-service/blog/a-collection-of-10-techniques-for-choosing-a-contractor',
    301
);
Route::get('th/contractor/blog/5-maintain-the-copyright-of-thailand-as-well',function(){
    $fullUrl = str_replace('contractor','contractor-service',request()->fullUrl());
    return redirect($fullUrl,301);
});


Route::redirect("/",App::getLocale(),301);
Route::redirect("/th/logistics","/th/logistics-warehouse-delivery",301);
Route::redirect("/th/company-register","/th/company-registration",301);
Route::redirect("/th/translater","/th/translation-interpreter",301);
Route::redirect("/th/broker","/th/agent-for-land",301);
Route::redirect("/th/recruitment","/th/recruitment-agency",301);
Route::redirect("/th/security-system","/th/security",301);
Route::redirect("/th/interior","/th/office-design-and-renovation",301);
Route::redirect("/th/office-appliance-industry","/th/office-appliance",301);
Route::redirect("/th/web-system","/th/website-development",301);
Route::redirect("/th/car-rental","/th/car-rental-leasing",301);
Route::redirect("/th/it","/th/it-computer-hardware",301);
Route::redirect("/th/online-marketing","/th/web-marketing",301);
Route::redirect("/th/credit-loan","/th/leasing",301);
Route::redirect("/th/machine-parts","/th/machine-maintennance-spare-part",301);
Route::redirect("/th/packaging","/th/special-machine-product-designed-line",301);
Route::redirect("/th/automotive-spareparts","/th/automotive-motorcycle-industrial",301);
Route::redirect("/th/chemicals","/th/chemical-industrial",301);
Route::redirect("/th/electrical-appliance","/th/electric-product-part-industrial",301);
Route::redirect("/th/home-appliance","/th/home-appliance-industrial",301);
Route::redirect("/th/textiles-clothing","/th/textile-silk",301);
Route::redirect("/th/forklift","/th/forklift-stocker",301);
Route::redirect("/th/solar-cell","/th/solar-windmilling-construction",301);
Route::redirect("/th/automotive-repair","/th/engineering-maintenance",301);
Route::redirect("/th/contractor","/th/contractor-service",301);
Route::redirect("/th/contractor/cp/narong-rich-asset","/th/contractor-service/cp/narong-rich-asset",301);
Route::redirect("/th/prefabricate-office","/th/prefabricated-office",301);



Route::get('/th/construction/blog/{url}',function(){
    $blogUrl = Request::segment(4);
    return redirect("/th/contractor/blog/$blogUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/designer/cp/{url}',function(){
    $profileUrl = Request::segment(4);
    return redirect("/th/interior-decoration/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/logistics/cp/{url}',function(){ ///logistics
    $profileUrl = Request::segment(4); return redirect("/th/logistics-warehouse-delivery/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/warehouse/cp/{url}',function(){ ///warehouse
    $profileUrl = Request::segment(4); return redirect("/th/logistics-warehouse-delivery/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/company-register/cp/{url}',function(){ ///company-register
    $profileUrl = Request::segment(4); return redirect("/th/company-registration/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/translater/cp/{url}',function(){ ///translater
    $profileUrl = Request::segment(4); return redirect("/th/translation-interpreter/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/broker/cp/{url}',function(){ ///broker
    $profileUrl = Request::segment(4); return redirect("/th/agent-for-land/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/recruitment/cp/{url}',function(){ ///recruitment
    $profileUrl = Request::segment(4); return redirect("/th/recruitment-agency/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/security-system/cp/{url}',function(){ ///security-system
    $profileUrl = Request::segment(4); return redirect("/th/security/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/interior/cp/{url}',function(){ ///interior
    $profileUrl = Request::segment(4); return redirect("/th/office-design-and-renovation/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/office-appliance-industry/cp/{url}',function(){ ///office-appliance-industry
    $profileUrl = Request::segment(4); return redirect("/th/office-appliance/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/web-system/cp/{url}',function(){ ///web-system
    $profileUrl = Request::segment(4); return redirect("/th/website-development/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/car-rental/cp/{url}',function(){ ///car-rental
    $profileUrl = Request::segment(4); return redirect("/th/car-rental-leasing/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/it/cp/{url}',function(){ ///it
    $profileUrl = Request::segment(4); return redirect("/th/it-computer-hardware/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/online-marketing/cp/{url}',function(){ ///online-marketing
    $profileUrl = Request::segment(4); return redirect("/th/web-marketing/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/credit-loan/cp/{url}',function(){ ///credit-loan
    $profileUrl = Request::segment(4); return redirect("/th/leasing/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/machine-parts/cp/{url}',function(){ ///machine-parts
    $profileUrl = Request::segment(4); return redirect("/th/machine-maintennance-spare-part/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/packaging/cp/{url}',function(){ ///packaging
    $profileUrl = Request::segment(4); return redirect("/th/special-machine-product-designed-line/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/automotive-spareparts/cp/{url}',function(){ ///automotive-spareparts
    $profileUrl = Request::segment(4); return redirect("/th/automotive-motorcycle-industrial/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/chemicals/cp/{url}',function(){ ///chemicals
    $profileUrl = Request::segment(4); return redirect("/th/chemical-industrial/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/electrical-appliance/cp/{url}',function(){ ///electrical-appliance
    $profileUrl = Request::segment(4); return redirect("/th/electric-product-part-industrial/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/home-appliance/cp/{url}',function(){ ///home-appliance
    $profileUrl = Request::segment(4); return redirect("/th/home-appliance-industrial/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/textiles-clothing/cp/{url}',function(){ ///textiles-clothing
    $profileUrl = Request::segment(4); return redirect("/th/textile-silk/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/forklift/cp/{url}',function(){ ///forklift
    $profileUrl = Request::segment(4); return redirect("/th/forklift-stocker/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/solar-cell/cp/{url}',function(){ ///solar-cell
    $profileUrl = Request::segment(4); return redirect("/th/solar-windmilling-construction/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/automotive-repair/cp/{url}',function(){ ///automotive-repair
    $profileUrl = Request::segment(4); return redirect("/th/engineering-maintenance/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);
Route::get('/th/contractor/cp/{url}',function(){ ///contractor
    $profileUrl = Request::segment(4); return redirect("/th/contractor-service/cp/$profileUrl",301);
})->where(['url' => '[0-9A-Za-zก-๙,.()!?"“”_-]+']);

Route::get('/{lang}/real-estate-agent',function(){
    $lang = Request::segment(1);
    return redirect("/$lang/broker",301);
})->where(['lang'=>'[a-z]+']);
Route::get('/{lang}/real-estate-agent/{seg3}',function(){
    $lang = Request::segment(1);
    $seg3 = Request::segment(3);
    return redirect("/$lang/broker/$seg3",301);
})->where([''=>'[0-9A-Za-zก-๙,.()!?"“”_-]']);
Route::get('{lang}/logistics/{seg3}',function(){
    $lang = Request::segment(1);
    $seg3 = Request::segment(3);
    return redirec('{lang}/logistics-werehouse-delivery/{seg3}',301);
});
Route::get('{lang}/logistics/blog/{url}',function(){
    $lang = Request::segment(1);
    $url = Request::segment(4);
    return redirect("$lang/blog/$url",301);
});
Route::get('{lang}/warehouse/blog/{url}',function(){
    $lang = Request::segment(1);
    $url = Request::segment(4);
    return redirect("$lang/blog/$url",301);
});

Route::get('robots.txt',function(){
    echo "User-agent: *\n\r";
    echo "Disallow: /webpanel";
});

Route::get('/llms.txt', function () {
    return response(file_get_contents(base_path('resources/llms.txt')), 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
});


// Short URL Short URL Short URL
// Short URL Short URL Short URL
Route::prefix('surl')->group(function(){
    Route::get('/',[\App\Http\Controllers\ShortCtrl::class,'index']);
    Route::post('/',[\App\Http\Controllers\ShortCtrl::class,'generate']);
    Route::get('/{short}',[\App\Http\Controllers\ShortCtrl::class,'goTo'])->where(['short'=>'[0-9A-z]+']);
});
Route::prefix('my/service')->group(function(){
    Route::post('/request/quotation',[\App\Http\Controllers\MyServiceCtrl::class,'quotation']);
    Route::get('/email/read',[\App\Http\Controllers\MyServiceCtrl::class,'readEmail']);
    // e=email r=read c=company {company}=company Id u=url {url}=url profile
    Route::get('/e/r/c/{company}/u/{url}',[\App\Http\Controllers\MyServiceCtrl::class,'readUrl'])->where(['company'=>'[0-9]+','url'=>'[A-Za-z0-9,.()-]+']);

});

Route::prefix('read')->group(function(){
    Route::get('pdf',[\App\Http\Controllers\ReadCtrl::class,'pdfRead']);
});

/**
 *
 * DEMO
 *
*/
Route::get('th/logistic-demo',[DemoCtrl::class,'logistic']);
Route::get('jp/logistic-demo',[DemoCtrl::class,'logistic']);
Route::get('mail/design',function(){
    return view("front-end.mail-design");
});


$textUrl = Request::fullUrl();
$segment = explode('/',Request::fullUrl());
$segment = array_filter($segment);
$category = @$segment[4];

if( Request::segment(4) =='a-collection-of-5-popular-construction-companies-in-thailand'){
    return redirect('th/contractor-service/blog/a-collection-of-5-popular-construction-companies-in-thailand?industry=42',301);
}

if($category=='logistic'){

    $rmQueryString = explode('?',Request::fullUrl(),2)[0];
    $rmQueryString = explode('/',$rmQueryString);
    if(@$rmQueryString[0]) unset($rmQueryString[0]);
    if(@$rmQueryString[2]) unset($rmQueryString[2]);
    $rmQueryString = implode('/',$rmQueryString);

    $segment = explode('/',Request::fullUrl());
    $segment = array_filter($segment);
    if(@$segment[0]) unset($segment[0]);
    if(@$segment[2]) unset($segment[2]);
    $segment = implode('/',$segment);
    $newUrl = str_replace('/logistic','/logistics',$segment);


    Route::redirect("/$rmQueryString", "/$newUrl", 301);
}
Route::get('under-construction',[HomeCtrl::class,'underConstruction']);
Route::get('under-construction/authentication',[HomeCtrl::class,'under']);
Route::post('under-construction/authentication',[HomeCtrl::class,'underAuthen']);

$category = Config::get('category.category');

Route::get('/set/lang/{lang}',[HomeCtrl::class,'setLanguage'])->where(['lang'=>'[a-z]+']);
//UnderConstruction

Route::post("th/member/profile/translate/save",[\App\Http\Controllers\MemberCtrl::class,'translate']);
Route::middleware(['Language'])->group(function()use($category,$lang)
{
    foreach ($lang as $k => $v)
    {
        Route::prefix($v)->group(function()use($category,$v)
        {
            foreach ($category as $i => $c)
            {
                // Route::prefix($c)->group(function()use($c)
                // {
                    Route::get("/$c/condition",[HomeCtrl::class,'condition']);
                    Route::get("/$c/privacy-policy",[HomeCtrl::class,'privacy']);
                    Route::get("/$c/faq",[HomeCtrl::class,'faq']);
                    Route::get("/$c/confirmation",[HomeCtrl::class,'confirmation']);
                    Route::get("/$c/about-us",[\App\Http\Controllers\AboutCtrl::class,'index']);
                    Route::get("/$c/promotion-package",[HomeCtrl::class,'newPackage']);
                    Route::get("/$c/new-promotion-package",[HomeCtrl::class,'newPackage']);
                    Route::get("/$c/company/{id}",[\App\Http\Controllers\CompanyCtrl::class,'detail'])->where('id','[0-9]+');

                    Route::get("/$c/blog",[\App\Http\Controllers\BlogCtrl::class,'index']);
                    Route::get("/$c/blog/tag/{tag}",[\App\Http\Controllers\BlogCtrl::class,'index'])->where(['tag','[A-Za-zก-๙,.()-]+']);
                    Route::get("/$c/blog/{id}",[\App\Http\Controllers\BlogCtrl::class,'detail'])->where(['id','[A-Za-zก-๙,.()-]+']);
                    Route::get("/$c/blog-company/{id}",[\App\Http\Controllers\BlogCtrl::class,'detail'])->where(['id','[A-Za-zก-๙,.()-]+']);

                    Route::put("/$c/member/register",[\App\Http\Controllers\MemberCtrl::class,'store']);
                    Route::post("/$c/sendmail/to",[\App\Http\Controllers\ContactCtrl::class,'Approve']);

                    Route::get("/$c/cp/{url}",[\App\Http\Controllers\CompanyCtrl::class,'fullDetail'])->where(['url'=>'[A-Za-z0-9,.()-]+']);

                    // Route::get("/cp/d/{id}",[$c,'cp'])->where(['id'=>'[0-9]+']);

                    Route::get("/$c/register",[\App\Http\Controllers\AuthCtrl::class,'memberRegister']);
                    Route::put("/$c/register",[\App\Http\Controllers\AuthCtrl::class,'store']);

                    Route::get("/$c/login",[\App\Http\Controllers\AuthCtrl::class,'index']);
                    Route::post("/$c/login",[\App\Http\Controllers\AuthCtrl::class,'authen']);

                    Route::post("/$c/capture",[\App\Http\Controllers\VisitorCtrl::class,'index']);
                    Route::get("/",[HomeCtrl::class,'index']);
                    Route::get("/$c",[\App\Http\Controllers\CenterCtrl::class,'index']);
                // });

                // Route::get("/",[\App\Http\Controllers\CenterCtrl::class,'index']);
                // Route::get('/test-query',[$v,'testQuery']);

            }


            Route::get('/shareBlog',function(){ return view('email.shareBlog'); });

            // Route::get('/',function(){ return view('under-construction'); });


            Route::get('/test/cookie',[\App\Http\Controllers\MyServiceCtrl::class,'testCookie']);

            Route::get('/company/generate',function(){ return view("front-end/gen"); });


            Route::get('/our-business',[HomeCtrl::class,'ourBusiness']);
            Route::get('/landing-page',[HomeCtrl::class,'landingPage']);
            Route::get('/coin',[HomeCtrl::class,'coin']);
            Route::get('/search',[HomeCtrl::class,'search']);
            Route::get('/category',[HomeCtrl::class,'category']);
            Route::get('/condition',[HomeCtrl::class,'condition']);
            Route::get('/privacy-policy',[HomeCtrl::class,'privacy']);
            Route::get('/faq',[HomeCtrl::class,'faq']);
            Route::get('/about-us',[HomeCtrl::class,'about']);
            Route::get('/contact',[HomeCtrl::class,'contact']);
            Route::put('/contact',[HomeCtrl::class,'contactStore']);
            // Route::get('/',function(){ return redirect("/logistic"); });
            Route::get('/manual',function(){ return view('front-end.comming-soon'); });
            Route::get('/promotion-package',[HomeCtrl::class,'newPackage']);
            // Route::get("/new-promotion-package",[HomeCtrl::class,'newPackage']);
            Route::get('/blog',[\App\Http\Controllers\BlogCtrl::class,'index']);
            Route::get('/blog-package',[\App\Http\Controllers\BlogCtrl::class,'packageBlog']);
            Route::get('/blog-company',[\App\Http\Controllers\BlogCtrl::class,'companyBlog']);
            Route::get('/blog-review',[\App\Http\Controllers\BlogCtrl::class,'reviewBlog']);
            Route::get('/blog-promotion',[\App\Http\Controllers\BlogCtrl::class,'promotionBlog']);
            Route::get('/blog-recruitment',[\App\Http\Controllers\BlogCtrl::class,'jobSearch']);
            Route::get('/blog-wts',[\App\Http\Controllers\BlogCtrl::class,'wtsBlog']);
            Route::get('/blog-wtb',[\App\Http\Controllers\BlogCtrl::class,'wtbBlog']);
            Route::get('/blog-customer',[\App\Http\Controllers\BlogCtrl::class,'customerBlog']);
            Route::get('/blog-customer-company/{id}/{name}',[\App\Http\Controllers\BlogCtrl::class,'companyBlogCustomer']);
            // blog tag
            Route::get('/blog/tag/{tag}',[\App\Http\Controllers\BlogCtrl::class,'index'])->where(['tag','[A-Za-zก-๙,.()-]+']);
            Route::get('/blog-company/blog/tag/{tag}',[\App\Http\Controllers\BlogCtrl::class,'index'])->where(['tag','[A-Za-zก-๙,.()-]+']);
            // blog tag
            Route::get('/blog/{id}',[\App\Http\Controllers\BlogCtrl::class,'detail'])->where(['id'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+']);
            Route::get('/blog-company/{id}',[\App\Http\Controllers\BlogCtrl::class,'detail'])->where(['id'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+']);
            Route::get('/news',[\App\Http\Controllers\NewsCtrl::class,'index']);
            Route::get('/job-search',[\App\Http\Controllers\BlogCtrl::class,'jobSearch']);
            Route::get('/job-search/{name}',[\App\Http\Controllers\BlogCtrl::class,'jobDetail'])->where(['name'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+']);

            Route::get("/login",[\App\Http\Controllers\AuthCtrl::class,'index']);
            Route::post("/login",[\App\Http\Controllers\AuthCtrl::class,'authen']);

            Route::get("/password/forgot",[\App\Http\Controllers\AuthCtrl::class,'forgot']);
            Route::post("/password/forgot",[\App\Http\Controllers\AuthCtrl::class,'forgotSendToEmail']);
            Route::get("/password/reset",[\App\Http\Controllers\AuthCtrl::class,'resetPassowrd']);
            Route::post("/password/reset",[\App\Http\Controllers\AuthCtrl::class,'newResetPassword']);

            Route::middleware(['Members'])->group(function(){

                Route::prefix("member")->group(function(){

                    Route::get('logout',[\App\Http\Controllers\AuthCtrl::class,'logout']);
                    Route::get('setting/password/{category}/{id}',[\App\Http\Controllers\AuthCtrl::class,'changePassword'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('setting/password',[\App\Http\Controllers\AuthCtrl::class,'updatePassword']);
                    Route::get('statistics/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'statistics'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('category',[\App\Http\Controllers\MemberCtrl::class,'selectCategory']);
                    Route::get('activity/{category}/{id}',[\App\Http\Controllers\ActivityCPC::class,'index'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('activity/create/{category}/{id}',[\App\Http\Controllers\ActivityCPC::class,'create'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('activity/create/{category}/{id}',[\App\Http\Controllers\ActivityCPC::class,'store'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('activity/{category}/{cid}/{id}',[\App\Http\Controllers\ActivityCPC::class,'edit'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','cid'=>'[0-9]+','id'=>'[0-9]+']);
                    Route::get('activity-share/{category}/{cid}/{id}/{url}',[\App\Http\Controllers\ActivityCPC::class,'share'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','cid'=>'[0-9]+','id'=>'[0-9]+']);
                    Route::get('activity-stat/{category}/{cid}/{id}',[\App\Http\Controllers\ActivityCPC::class,'activityStat'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','cid'=>'[0-9]+','id'=>'[0-9]+']);
                    Route::post('activity-share/blog',[\App\Http\Controllers\ActivityCPC::class,'shareBlog']);
                    Route::put('activity/{category}/{cid}/{id}',[\App\Http\Controllers\ActivityCPC::class,'update'])->where(['id'=>'[0-9]+']);
                    Route::get('activity/delete',[\App\Http\Controllers\ActivityCPC::class,'destroy']);
                    Route::get('activity/delete/image',[\App\Http\Controllers\ActivityCPC::class,'deleteImage']);
                    Route::get('activity/status',[\App\Http\Controllers\ActivityCPC::class,'status']);

                    Route::get('create/{step}',[\App\Http\Controllers\MemberCtrl::class,'createStep'])->where(['step'=>'[0-9]+']);
                    // Route::put('create/{step}',[\App\Http\Controllers\MemberCtrl::class,'storeStep'])->where(['step'=>'[0-9]+']);
                    Route::post('create/{step}',[\App\Http\Controllers\MemberCtrl::class,'storeStep'])->where(['step'=>'[0-9]+']);

                    Route::get('profile/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'profile'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('profile/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'profileUpdate'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('information/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'information'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('information/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'informationUpdate'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('contact/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'contact'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('contact/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'contactUpdate'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);

                    //contact-email selfedit
                    Route::get('contact-email/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'contactEmail'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('contact-email/create/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'createContactEmail'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('contact-email/create/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'storeContactEmail'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('contact-email/{category}/{cid}/{id}',[\App\Http\Controllers\MemberCtrl::class,'editContactEmail'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','cid'=>'[0-9]+','id'=>'[0-9]+']);
                    Route::put('contact-email/{category}/{cid}/{id}',[\App\Http\Controllers\MemberCtrl::class,'updateContactEmail'])->where(['id'=>'[0-9]+']);
                    Route::get('contact-email/delete',[\App\Http\Controllers\MemberCtrl::class,'deleteContactEmail']);
                    Route::get('contact-email/stat/{category}/{cid}/{id}',[\App\Http\Controllers\MemberCtrl::class,'contactEmailStat'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::get('contact-email/get-clicks',[\App\Http\Controllers\MemberCtrl::class,'contactEmailLog']);
                    //----------------------

                    Route::post('upload/logo',[\App\Http\Controllers\MemberCtrl::class,'uploadLogo']);
                    Route::put('upload/cover',[\App\Http\Controllers\MemberCtrl::class,'uploadCover']);
                    Route::put('upload/service',[\App\Http\Controllers\MemberCtrl::class,'uploadService']);
                    Route::put('upload/gallery',[\App\Http\Controllers\MemberCtrl::class,'uploadGallery']);
                    Route::put('upload/profile-images',[\App\Http\Controllers\MemberCtrl::class,'uploadImage']);
                    Route::get('delete/profile-image',[\App\Http\Controllers\MemberCtrl::class,'deleteImage']);
                    Route::get('profile-images',[\App\Http\Controllers\MemberCtrl::class,'profileImages']);
                    Route::get('remove/gallery-image',[\App\Http\Controllers\MemberCtrl::class,'removeGallery']);
                    Route::get('gallery/image',[\App\Http\Controllers\MemberCtrl::class,'getImgGallery']);
                    Route::get('setting/name/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'changeName'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('setting/name',[\App\Http\Controllers\MemberCtrl::class,'updateName']);
                    Route::get('setting/email/{category}/{id}',[\App\Http\Controllers\MemberCtrl::class,'changeEmail'])->where(['category'=>'[0-9A-Za-zก-๙,.()!?"“”_-]+','id'=>'[0-9]+']);
                    Route::post('setting/email',[\App\Http\Controllers\MemberCtrl::class,'updateEmail']);
                    Route::get('sms-history',[\App\Http\Controllers\MemberCtrl::class,'SMSHistory']);
                });
            });



            Route::prefix("preview")->group(function(){
                Route::get('/blog/{id}',[\App\Http\Controllers\BlogCtrl::class,'preview'])->where(['id'=>'[0-9]+']);
                Route::get('/company-profile/{id}',[\App\Http\Controllers\CompanyCtrl::class,'preview'])->where(['id'=>'[0-9]+']);
                Route::get('/email',[\App\Http\Controllers\AuthCtrl::class,'emailPreview']);
            });



        });


        Route::middleware(['Members'])->group(function()use($v,$category){
            // foreach($category as $i => $v) {
            //     Route::prefix("$v/member")->group(function(){
            //         Route::get('logout',[\App\Http\Controllers\Authindustry::class,'logout']);
            //         Route::get('setting/password',[\App\Http\Controllers\AuthCtrl::class,'changePassword']);
            //         Route::post('setting/password',[\App\Http\Controllers\AuthCtrl::class,'updatePassword']);
            //     });
            // }
            foreach($category as $i => $v) {
                Route::prefix("$v/member")->group(function(){
                    Route::get('statistics',[\App\Http\Controllers\MemberCtrl::class,'statistics']);
                    Route::get('activity',[\App\Http\Controllers\ActivityCPC::class,'index']);
                    Route::get('activity/create',[\App\Http\Controllers\ActivityCPC::class,'create']);
                    Route::put('activity/create',[\App\Http\Controllers\ActivityCPC::class,'store']);
                    Route::get('activity/{id}',[\App\Http\Controllers\ActivityCPC::class,'edit']);
                    Route::post('activity/{id}',[\App\Http\Controllers\ActivityCPC::class,'update']);
                    Route::get('activity/delete',[\App\Http\Controllers\ActivityCPC::class,'delete']);
                    Route::get('activity/delete/image',[\App\Http\Controllers\ActivityCPC::class,'deleteImage']);
                    Route::get('activity/status',[\App\Http\Controllers\ActivityCPC::class,'status']);
                    Route::get('create',[\App\Http\Controllers\MemberCtrl::class,'create']);
                    Route::post('create',[\App\Http\Controllers\MemberCtrl::class,'store']);
                    Route::get('profile',[\App\Http\Controllers\MemberCtrl::class,'profile']);
                    Route::post('profile',[\App\Http\Controllers\MemberCtrl::class,'profileUpdate']);
                    Route::get('information',[\App\Http\Controllers\MemberCtrl::class,'information']);
                    Route::post('information',[\App\Http\Controllers\MemberCtrl::class,'informationUpdate']);
                    Route::get('contact',[\App\Http\Controllers\MemberCtrl::class,'contact']);
                    Route::post('contact',[\App\Http\Controllers\MemberCtrl::class,'contactUpdate']);
                    Route::post('upload/logo',[\App\Http\Controllers\MemberCtrl::class,'uploadLogo']);
                    Route::put('upload/cover',[\App\Http\Controllers\MemberCtrl::class,'uploadCover']);
                    Route::put('upload/service',[\App\Http\Controllers\MemberCtrl::class,'uploadService']);
                    Route::put('upload/gallery',[\App\Http\Controllers\MemberCtrl::class,'uploadGallery']);
                    Route::put('upload/profile-images',[\App\Http\Controllers\MemberCtrl::class,'uploadImage']);
                    Route::get('profile-images',[\App\Http\Controllers\MemberCtrl::class,'profileImage']);
                    Route::get('remove/gallery-image',[\App\Http\Controllers\MemberCtrl::class,'removeGallery']);
                    Route::get('gallery/image',[\App\Http\Controllers\MemberCtrl::class,'getImgGallery']);
                    Route::get('setting/name',[\App\Http\Controllers\MemberCtrl::class,'changeName']);
                    Route::post('setting/name',[\App\Http\Controllers\MemberCtrl::class,'updateName']);
                    // Route::get('setting/email',[\App\Http\Controllers\MemberCtrl::class,'changeEmail']);
                    // Route::post('setting/email',[\App\Http\Controllers\MemberCtrl::class,'updateEmail']);
                    Route::get('sms-history',[\App\Http\Controllers\MemberCtrl::class,'SMSHistory']);
                });
            }
        });
    }
});

Route::prefix('address/get')->group(function(){
    Route::get('postcode',[\App\Http\Controllers\AddressAutoCtrl::class,'postcode']);
});

Route::get('insert/handle',[\App\Http\Controllers\HandleCtrl::class,'handle']);
Route::post('authentication/request',[\App\Http\Controllers\AuthCtrl::class,'attempt']);
Route::get('check/email',[\App\Http\Controllers\AuthCtrl::class,'checkEmail']);
Route::get('check/name',[\App\Http\Controllers\AuthCtrl::class,'checkName']);
Route::post('check/old-password',[\App\Http\Controllers\AuthCtrl::class,'oldPassword']);
Route::get('counter/getThreeTimes',[\App\Http\Controllers\CounterCtrl::class,'getThreeTimes']);

Route::get('css/generate/svg/image.svg',[\App\Http\Controllers\GenerateCtrl::class,'image']);
Route::get('css/generate/svg/text.webp',[\App\Http\Controllers\GenerateCtrl::class,'text']);

Route::fallback(function () {
    $path = request()->path();

    if (str_starts_with($path, 'th/')) {
        $parts = explode('/', $path);

        if (!empty($parts[1]) && !empty($parts[2])) {
            return redirect('/th/' . $parts[1], 301);
        }
    }
    
    return redirect('/th', 301);
});