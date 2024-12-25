<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// $category = \App\Models\IndustryMd::select('key')->get();


$category = Config::get('category.category');

Route::prefix('my-job')->group(function () {
    Route::prefix('cs')->group(function () {
        Route::get('/all', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'getAllRow']);
        Route::get('/{id}', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'getRow'])->where(['id' => '[0-9]+']);
        // Route::get('/on-process', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'onProcess']);
        Route::get('get/copyright', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'csGetCopyright']);
    });
    Route::get('/stock', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_stock']);
    Route::get('/complete', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_stock']);
    Route::get('/waiting-for-create', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_waiting']);
    Route::get('/waiting-for-revise', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_revise']);
    Route::get('/on-process', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'onProcess']);
    Route::get('/appointment ', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_appointment']);
    Route::get('/appointment/get-date ', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'getAppointmentDate']);
    Route::get('/get-comments', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'getComments']);
    Route::get('/assignment', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'assignmentFromRecord']);
    Route::get('/presentation ', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_presentation']);
    Route::get('/customer-list', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_customerList']);
    Route::get('/not-interest', [\App\Http\Controllers\Api\JobProgressCtrl::class, '_notInterest']);
    Route::get('/customer-package', [\App\Http\Controllers\Api\JobProgressCtrl::class, 'customerPackage']);
});
// s = store
Route::prefix('contact/s')->group(function () {
    Route::post('/basic', [\App\Http\Controllers\ContactCtrl::class, 'storeContactFormBasic']);
});

// ============================ //
// <Read email from our customer>
// ============================ //
Route::get('my/service/email/read', [\App\Http\Controllers\Api\MyServiceCtrl::class, 'readEmail']);
Route::get('my/service/e/r/c/{company}/u/{url}', [\App\Http\Controllers\Api\MyServiceCtrl::class, 'readUrl'])->where(['company' => '[0-9]+', 'url' => '[A-Za-z0-9,.()-]+']);
Route::get('my/services/cp/{u}', [\App\Http\Controllers\Api\MyServiceCtrl::class, 'previewFullDetail'])->where(['u' => '[A-Za-z0-9,.()-]+']);
Route::post('company/allow-to-use-infomation', [\App\Http\Controllers\Api\MyServiceCtrl::class, 'AllowToUseInfomation']);
Route::get('my/services/company/profile/{url}', [\App\Http\Controllers\Demo\CompanyCtrl::class, 'profile'])->where(['url' => '[A-Za-z0-9,.()-]+']);

// ============================ //
// </Read email from our customer>
// ============================ //




Route::get('ads/blog', [\App\Http\Controllers\Api\AdsCtrl::class, 'once']);
Route::get('ads/bytype', [\App\Http\Controllers\Api\AdsCtrl::class, 'type']);
Route::get('statistics/locate', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'locate']);
Route::get('statistics/device', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'device']);
Route::get('statistics/device/line-graph', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'lineGraphVisited']);
Route::get('statistics/close-popup', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'closePopup']);
Route::post('statistics/show-popup', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'countPopupshow']);
Route::get('statistics/click-custom', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'clickCustom']);
Route::get('statistics/send-form', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'sendForm']);
Route::post('package/sendmail', [\App\Http\Controllers\ContactCtrl::class, 'sendmailFromPackage']);
Route::post('count-of-click', [\App\Http\Controllers\PageCounterCtrl::class, 'CoutOfClick']);
Route::post('count-of-click-banner', [\App\Http\Controllers\PageCounterCtrl::class, 'CoutOfClickBanner']);
Route::get('statistics/length', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'length']);
Route::put('store/statistics/detail', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'storeDetail']);
Route::get('dashboard/today-activity/{goal}/{goalCreated}/{goalDesign}', [\App\Http\Controllers\Api\DashboardCtrl::class, 'todayActivity'])->where(['goal' => '[0-9]+', 'goalCreated' => '[0-9]+', 'goalDesign' => '[0-9]+']);
Route::get('dashboard/blog-activity/{goal}', [\App\Http\Controllers\Api\BlogCtrl::class, 'todayActivity']);

Route::get('task/activity/{id}', [\App\Http\Controllers\Api\TaskCtrl::class, 'activity']);
Route::post('company/more', [\App\Http\Controllers\Api\CompanyCtrl::class, 'moreAndMore']);
Route::get('getCompanyFromCategory', [\App\Http\Controllers\Api\CompanyCtrl::class, 'getCompanyFromCategory']);
Route::post('send/sms', [\App\Http\Controllers\CompanyCtrl::class, 'sendSMS']);
Route::post('send/sms-to-sale', [\App\Http\Controllers\HomeCtrl::class, 'sendSMS']);

Route::prefix('blog')->group(function () {
    Route::get('/all', [\App\Http\Controllers\Api\BlogCtrl::class, 'getAllBlog']);
    Route::get('/all/{type}', [\App\Http\Controllers\Api\BlogCtrl::class, 'getAllBlog'])->where(['type' => '[a-z-]+']);
    Route::get('/company', [\App\Http\Controllers\Api\BlogCtrl::class, 'blogCompany']);
    Route::get('/package', [\App\Http\Controllers\Api\BlogCtrl::class, 'blogPackage']);
    Route::get('/count/{case}', [\App\Http\Controllers\BlogCtrl::class, 'count'])->where(['case' => '[a-z]+']);
    Route::get('/store/count', [\App\Http\Controllers\BlogCtrl::class, 'count'])->where(['case' => '[a-z]+']);

    // template api //
    Route::get('/c', [\App\Http\Controllers\Api\BlogCtrl::class, 'blogForCustomer']);
    Route::get('/c/all', [\App\Http\Controllers\Api\BlogCtrl::class, 'allBlogForCustomer']);
    Route::get('/c/hankyu', [\App\Http\Controllers\Api\BlogCtrl::class, 'HankyuBlog']);
    Route::get('/c/rent', [\App\Http\Controllers\Api\BlogCtrl::class, 'RentBlog']);
    Route::get('/c/speedmove', [\App\Http\Controllers\Api\BlogCtrl::class, 'SpeedMoveBlog']);
    Route::get('/c/aircon', [\App\Http\Controllers\Api\BlogCtrl::class, 'airconBlog']);
    // template api //
});
// Route::get('image/size',[\App\Http\Controlers\]);
Route::prefix('get')->group(function () {
    Route::get('/package', [\App\Http\Controllers\Api\PackageCtrl::class, 'getPackage']);
    Route::get('/counter/times', [\App\Http\Controllers\PageCounterCtrl::class, 'times']);
    Route::get('/sub-category', [\App\Http\Controllers\Api\CategoryCtrl::class, 'getSubCategory']);
    Route::get('/category/{type}/{id}', [\App\Http\Controllers\Api\CategoryCtrl::class, 'get'])->where(['type' => '[A-Za-z]+', 'id' => '[0-9]+']);
    Route::get('category/search', [\App\Http\Controllers\Api\CategoryCtrl::class, 'getCategoryFromKeyword']);
    Route::get('category/all', [\App\Http\Controllers\Api\CategoryCtrl::class, 'all']);
    Route::get('category/detail', [\App\Http\Controllers\Api\CategoryCtrl::class, 'getDetail']);
    Route::get('to-do-list', [\App\Http\Controllers\Api\TodolistCtrl::class, 'get']);
    Route::get('to-do-list/{id}', [\App\Http\Controllers\Api\TodolistCtrl::class, 'get'])->where(['id' => '[0-9]+']);

    Route::prefix('users')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\UsersCtrl::class, 'index']);
        Route::get('/all', [\App\Http\Controllers\Api\UsersCtrl::class, 'all']);
    });
});

Route::prefix('to-do-list')->group(function () {
    Route::post('/checklist/update', [\App\Http\Controllers\Api\TodolistCtrl::class, 'updateChecklist']);
    Route::post('/checklist/item/update', [\App\Http\Controllers\Api\TodolistCtrl::class, 'updateChecklistItem']);
    Route::put('/checklist/item', [\App\Http\Controllers\Api\TodolistCtrl::class, 'storeChecklistItem']);
    Route::post('/checklist/item', [\App\Http\Controllers\Api\TodolistCtrl::class, 'updateChecklistItem']);
    Route::post('/checklist/item/memeber', [\App\Http\Controllers\Api\TodolistCtrl::class, 'updateChecklistItemMember']);
    Route::delete('/checklist/item/{id}', [\App\Http\Controllers\Api\TodolistCtrl::class, 'deleteChecklistItem'])->where(['id' => '[0-9]+']);
    Route::get('/{id}/member', [\App\Http\Controllers\Api\TodolistCtrl::class, 'getMemberInTodolist']);
    Route::post('/member', [\App\Http\Controllers\Api\TodolistCtrl::class, 'updateMemberInTodolist']);
    Route::post('/member-and-return', [\App\Http\Controllers\Api\TodolistCtrl::class, 'updateMemberInTodolistAndReturn']);
});

Route::get('/category/{id}', [\App\Http\Controllers\Api\CategoryCtrl::class, 'getCategory']);

Route::prefix('category')->group(function () {
    Route::prefix('get')->group(function () {
        Route::get('countTheNumberOfJob', [\App\Http\Controllers\Api\CategoryCtrl::class, 'countTheNumberOfJob']);
        Route::get('sub-category', [\App\Http\Controllers\Api\CategoryCtrl::class, 'subCategory']);
    });
});

Route::put('blog/store/counter', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'storeCounter']);

foreach ($category as $key => $v) {
    Route::prefix($v)->group(function () {
        Route::get('cp/{url}', [\App\Http\Controllers\Api\MyServiceCtrl::class, 'previewFullDetail'])->where(['url' => '[A-Za-z0-9,.()-]+']);
        // Route::get('{id}/statistics', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'statistics'])->where('id', '[0-9]+');
        Route::get('{id}/statistics/locate', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'locate'])->where('id', '[0-9]+');
        Route::get('{id}/statistics/all-blog', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'allBlog'])->where('id', '[0-9]+');
        Route::get('{id}/statistics/click', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'click'])->where('id', '[0-9]+');
        Route::get('{id}/statistics/popup', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'popup'])->where('id', '[0-9]+');
        Route::get('{id}/statistics/banner', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'banner'])->where('id', '[0-9]+');
        Route::put('store/statistics', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'store']);
        Route::put('store/statistics/click', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'storeClick']);
        Route::put('store/counter', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'storeCounter']);

        Route::get('{id}/statistics/dataGraph', [\App\Http\Controllers\Api\StatisticsCtrl::class, 'chartReport'])->where('id', '[0-9]+');
        Route::get("{id}/statistics/report", [\App\Http\Controllers\Api\StatisticsCtrl::class, 'reportStatistics'])->where(['id' => '[0-9]+']);
    });
}

// Route::group(['middleware'=>['auth:api', 'Webpanel']],function(){
//     Route::prefix('my-job')->group(function(){
//         Route::get('get/users',[\App\Http\Controllers\Api\UsersCtrl::class,'getUsers']);
//     });
// });

Route::get('/line/noti', [\App\Http\Controllers\Api\LineNotiCtrl::class, 'notification']);
Route::get('/getOnlineOfMonth', [\App\Http\Controllers\Api\DashboardCtrl::class, 'getOnlineOfMonth']);
Route::get('/getDesignedOfMonth', [\App\Http\Controllers\Api\DashboardCtrl::class, 'getDesignedOfMonth']);
