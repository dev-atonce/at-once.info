<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

$category = Config::get('category.category');
Route::get('webpanel/login', [\App\Http\Controllers\Webpanel\AuthCtrl::class, 'index']);
Route::post('webpanel/login', [\App\Http\Controllers\Webpanel\AuthCtrl::class, 'authentication']);
Route::get('webpanel/logout', [\App\Http\Controllers\Webpanel\AuthCtrl::class, 'logout']);



Route::middleware(['Webpanel'])->group(function () use ($category) {

    Route::prefix('webpanel')->group(function () use ($category) {

        Route::prefix('config')->group(function () {
            Route::get('/set/category', [\App\Http\Controllers\Webpanel\ConfigCtrl::class, 'configCategoryUpdate']);
            Route::get('/set/color', [\App\Http\Controllers\Webpanel\CssCtrl::class, 'configColorUpdate']);
        });

        Route::prefix('settings')->group(function () {
            Route::get('/category', [\App\Http\Controllers\Webpanel\SettingsCtrl::class, 'category']);
            Route::get('/category/detail', [\App\Http\Controllers\Webpanel\SettingsCtrl::class, 'categoryDetail']);
            Route::post('/category/detail', [\App\Http\Controllers\Webpanel\SettingsCtrl::class, 'categoryDetailUpdate']);
        });


        Route::get('company-in-category', [\App\Http\Controllers\Webpanel\SqlCtrl::class, 'companyInCategory']);

        Route::get('cancel-refuse', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'cancelRefuse']);
        Route::get('cancel-cannotcontact', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'cancelCannot_contact']);
        Route::get('cancel-follow', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'cancelFollow']);
        Route::get('cancel-noresponse', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'cancelNo_response']);

        Route::get('sql/custom', [\App\Http\Controllers\Webpanel\SqlCtrl::class, 'custom']);
        Route::get('sql/custom/cs-row/to-company', [\App\Http\Controllers\Webpanel\SqlCtrl::class, 'csRowToBasicCompany']);
        Route::get('sql/custom/filter', [\App\Http\Controllers\Webpanel\SqlCtrl::class, 'filter']);
        Route::get('sql/custom/deleteImportDataDuplicate', [\App\Http\Controllers\Webpanel\SqlCtrl::class, 'deleteImportDataDuplicate']);

        Route::prefix('import')->group(function () {
            Route::get('to/company', [\App\Http\Controllers\Webpanel\ImportCtrl::class, 'toCompany']);
        });

        Route::prefix('export')->group(function () {
            Route::get('all', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'index']);
            Route::get('all-company', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'allCompany']);
            Route::get('onlineCategory', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportOnlineCategory']);
            Route::get('onSiteCategory', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportOnSiteCategory']);
            Route::get('category-in-website', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportCategory']);
            Route::get('all-category', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'allCategory']);
            Route::get('category/{id}', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'category'])->where(['id' => '[0-9]+']);
            Route::get('copyright/{id}', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'copyright'])->where(['id' => '[0-9]+']);
            Route::get('refuse/{id}', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'refuseOnly'])->where(['id' => '[0-9]+']);
            Route::get('company/to/txt-file/{id}', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'companyToTxt'])->where(['id' => '[0-9]+']);
            Route::get('company-in-category', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'CompanyInCategory']);
            Route::get('email-database', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'emailDatabase']);
            Route::get('real-basic', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportRealBasic']);
            Route::get('jp-online-license', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'jpOnlineAndLicense']);
            Route::get('basic-company-no-refuse/{r}', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'basicNoRefuse'])->where(['r' => '[0-9-]+']);
            Route::get('company-all/{r}', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'companyAll'])->where(['r' => '[0-9-]+']);

            Route::get('sms-popup', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportSmsPopup']);
            Route::get('package-form', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportPackageForm']);
            Route::get('contactus-form', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportContactUsForm']);
            Route::get('basic-form', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'exportBasicForm']);

            Route::get('duplicateCompany', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'mergeCompany']);
        });

        Route::get('', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'index']);
        Route::get('/dashboard', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'index']);
        Route::get('/copyright', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'copyright']);
        Route::get('/copyright-all', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'copyright_export_all']);
        Route::get('/allcategory', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'allcategory']);
        Route::get('/refuse-log', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'refuseLog'])->name('refuseLog');
        Route::post('/copyright/upload', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'copyrightUpload']);
        Route::delete('/copyright/delete', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'DeleteFile']);
        Route::get('/kpi', [\App\Http\Controllers\Webpanel\KpiCtrl::class, 'index']);
        Route::get('/web-traffic', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'webTraffic']);
        Route::post('/web-traffic/save-comment', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'saveComment']);
        Route::get('/web-traffic/del-comment', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'delComment']);
        Route::get('/ma-clicks', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'MarketingAutomationClick']);
        Route::get('/ma-date', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'MarketingAutomationDate']);
        Route::get('/ma-blog', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'MarketingAutomationBlog']);
        Route::get('/web-traffic/get-clicks', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'getClicks']);
        Route::get('/web-traffic/get-clicks-blog', [\App\Http\Controllers\Webpanel\DashboardCtrl::class, 'getClicksBlog']);
        Route::get('/email-approve', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'emailApprove']);
        Route::get('/popup-approve', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'popupApprove']);
        Route::post('/popup-approve/update', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'popupApproveUpdate']);
        Route::get('/email-reject', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'emailReject']);
        Route::post('/sendmail/cs', [\App\Http\Controllers\ContactCtrl::class, 'SendtoCustomer']);
        Route::post('/revisemail/cs', [\App\Http\Controllers\ContactCtrl::class, 'ReviseMail']);
        Route::post('/rejectmail/cs', [\App\Http\Controllers\ContactCtrl::class, 'rejectEmail']);
        Route::get('/rejectAllmail/cs', [\App\Http\Controllers\ContactCtrl::class, 'rejectAllEmail']);
        Route::post('/update-status/cs', [\App\Http\Controllers\ContactCtrl::class, 'statusEmail']);
        Route::post('/get-remark/cs', [\App\Http\Controllers\ContactCtrl::class, 'getRemarkEmail']);
        Route::post('/detailrevise/cs', [\App\Http\Controllers\ContactCtrl::class, 'getDetailRevise']);
        Route::post('/update-revise/cs', [\App\Http\Controllers\ContactCtrl::class, 'UpdateReviseMail']);
        Route::post('/restoremail/cs', [\App\Http\Controllers\ContactCtrl::class, 'RestoreMail']);
        Route::get('/all-company-report', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'companyReportList']);

        Route::prefix('customers')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'create']);
            Route::put('/create', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'store']);
            Route::get('/edit/{id}', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'edit'])->where(['id' => '[0-9]+']);
            Route::post('/edit/{id}', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'update'])->where(['id' => '[0-9]+']);
            Route::get('/delete', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'delete'])->where(['id' => '[0-9]+']);
            Route::get('/get-company', [\App\Http\Controllers\Webpanel\CustomerCtrl::class, 'getCompany']);
        });

        Route::post('/company/license', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'license']);
        Route::post('/company/semi', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'semi']);

        Route::get('/menu', [\App\Http\Controllers\Webpanel\Setting::class, 'index']);
        Route::get('/menu/status/{id}', [\App\Http\Controllers\Webpanel\Setting::class, 'status']);
        Route::get('/menu/create', [\App\Http\Controllers\Webpanel\Setting::class, 'create']);
        Route::put('/menu/create', [\App\Http\Controllers\Webpanel\Setting::class, 'store']);
        Route::get('/menu/{id}', [\App\Http\Controllers\Webpanel\Setting::class, 'edit'])->where('id', '[0-9]+');
        Route::post('/menu/{id}', [\App\Http\Controllers\Webpanel\Setting::class, 'update'])->where('id', '[0-9]+');
        Route::get('/menu/destroy/{id}', [\App\Http\Controllers\Webpanel\Setting::class, 'destroy'])->where('id', '[0-9]+');
        Route::get('/menu/update/permission', [\App\Http\Controllers\Webpanel\Setting::class, 'updatePermission']);
        Route::post('/menu/sort', [\App\Http\Controllers\Webpanel\Setting::class, 'sort']);

        Route::get('/members/filter', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'filter']);

        Route::get('/members', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'index']);

        Route::get('members/make/directory', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'makeDirectory']);

        Route::get('/members/create', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'add']);
        Route::put('/members/create', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'insert']);
        Route::post('/members/addmember-company', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'addMemberCompany']);
        Route::get('/members/edit/{id}', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'editMember']);
        Route::put('/members/edit/{id}', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'updateMember']);
        Route::post('/members/check/email/duplicate', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'email_duplicate']);
        Route::post('/members/check/name/duplicate', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'name_duplicate']);
        Route::post('/members/check/profile-url/duplicate', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'profileUrlDuplicate']);
        // Route::post('/members/check/company-name/duplicate',[\App\Http\Controllers\Webpanel\MemberCtrl::class,'companyNameDuplicate']);
        Route::get('/members/check/company-name/duplicate', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'companyNameDuplicate']);
        Route::get('/members/delete', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'delete']);
        Route::get('/members/name/check', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'nameCheck']);
        Route::get('/members/email/check', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'emailCheck']);
        Route::get('/members/getcategorysub', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'getOptionCategorySub']);
        Route::get('/members/getcategory', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'getOptionCategory']);

        Route::get('/members/{id}', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'showCompany'])->where('id', '[0-9]+');
        Route::get('/members/{id}/add', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'addCompany']);
        Route::post('/members/{id}/insert', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'insertCompany']);
        Route::post('/members/{id}/deleteItemGallery', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'deleteItemGallery']);
        Route::post('/members/{id}/deleteItemTime', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'deleteItemTime']);
        Route::get('/members/{id}/{company}', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'edit'])->where('id', '[0-9]+');
        Route::post('/members/{id}/{company}', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'updateCompany'])->where('id', '[0-9]+');
        Route::get('/members/{id}/{company}/translate', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'translate'])->where(['id' => '[0-9]+', 'company' => '[0-9]+']);
        Route::post('/members/company/status', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'statusCompany']);
        Route::post('/members/company/refuse-handler', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'refuseCompanyHandle']);
        Route::post('/members/company/statusBasic', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'statusCompanyBasic']);
        Route::post('/members/company/toRefuse', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'ChangeToRefuse']);
        Route::post('/members/company/refuse', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'refuse']);
        Route::post('/members/deleteCompany', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'SoftdeleteCompany']);
        Route::get('/members/profile-images', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'profileImages']);
        Route::get('/members/profile-videos', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'profileVideos']);
        Route::put('/members/upload/profile-videos', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'uploadVideos']);
        Route::put('/members/upload/profile-images', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'uploadImage']);
        Route::get('/members/delete/profile-image', [\App\Http\Controllers\Webpanel\MemberCtrl::class, 'deleteImage']);

        Route::prefix('statistics')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'index']);
            Route::get('/packagesms', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'sms']);
            Route::get('/packagemail', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'email']);
            Route::get('/contactusemail', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'email']);
            Route::get('/contact-from-basic', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'email']);
            Route::get('/{id}', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'view'])->where(['id' => '[0-9]+']);

            Route::get('/di', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'getDi']);
            Route::put('/di', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'storeDi']);
            Route::post('/di/update', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'updateDi']);
            Route::delete('/di/delete', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'deleteDi']);

            Route::put('/pv', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'storePv']);
            Route::get('/pv', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'getPv']);
            Route::post('/pv/update', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'updatePv']);
            Route::delete('/pv/delete', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'deletePv']);

            Route::put('/cr', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'storeCr']);
            Route::post('/cr/update', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'updateCr']);
            Route::delete('/cr/delete', [\App\Http\Controllers\Webpanel\StatisticsCtrl::class, 'deleteCr']);
        });

        // Blog Blog Blog Blog Blog Blog Blog
        Route::get('/blog-type', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'index']);
        Route::prefix('blog')->group(function () {
            Route::get('/statistics/{id}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'statistic'])->where('id', '[0-9]+');
            Route::get('/add/{category}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'add'])->where('category', '[a-z_-]+');
            Route::get('/add', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'add']);
            Route::post('/insert/{category}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'insert'])->where('category', '[a-z_-]+');
            Route::post('/insert', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'insert']);
            Route::get('/{id}/{category}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'edit'])->where(['id' => '[0-9]+', 'category' => '[a-z_-]+']);
            Route::get('/{id}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'edit'])->where('id', '[0-9]+');
            Route::post('/status', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'status']);
            Route::post('/interesting', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'interesting']);
            Route::post('/{id}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'update'])->where('id', '[0-9]+');
            Route::post('/{id}/{category}', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'update'])->where(['id' => '[0-9]+', 'category' => '[a-z_-]+']);
            Route::get('/delete', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'delete']);
            Route::get('/profile-images', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'profileImages']);
            Route::put('/upload/profile-images', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'uploadImage']);
            Route::get('/delete/profile-image', [\App\Http\Controllers\Webpanel\BlogCtrl::class, 'deleteImage']);
        });

        Route::prefix('mail')->group(function () {
            Route::get('/history-mail', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'index']);
            Route::get('/history-mail/export', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'export']);
            Route::get('/history-mail/{id}', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'viewdata']);
            Route::prefix('cs')->group(function () {
                Route::get('/', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'cs']);
                Route::get('/read', [\App\Http\Controllers\Webpanel\HistoryMailCtrl::class, 'read']);
            });
        });

        Route::prefix('sms-history')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\SMSHistoryCtrl::class, 'index']);
        });

        Route::prefix('activity')->group(function () {
            Route::get('/star', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'star']);
            Route::get('/star/create', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starCreate']);
            Route::put('/star/create', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starStore']);
            Route::get('/star/{id}', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starEdit'])->where(['id' => '[0-9]+']);
            Route::post('/star/{id}', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starUpdate'])->where(['id' => '[0-9]+']);
            Route::get('/star/trash/{id}', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starDestroy'])->where(['id' => '[0-9]+']);
            Route::get('/star/restore/{id}', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starRestore'])->where(['id' => '[0-9]+']);
            Route::get('/star/delete/{id}', [\App\Http\Controllers\Webpanel\ActivityCtrl::class, 'starForceDelete'])->where(['id' => '[0-9]+']);
        });
        Route::get('problem-report', [\App\Http\Controllers\Webpanel\ProblemReportCtrl::class, 'index']);
        Route::get('problem-report/create', [\App\Http\Controllers\Webpanel\ProblemReportCtrl::class, 'create']);

        Route::prefix('report')->group(function () {
            Route::get('inquiry', [\App\Http\Controllers\Webpanel\ReportCtrl::class, 'inquiryCustomer']);
            Route::get('inquiry/customer', [\App\Http\Controllers\Webpanel\ReportCtrl::class, 'inquiryCustomer']);
            Route::get('inquiry/popup', [\App\Http\Controllers\Webpanel\ReportCtrl::class, 'inquiryPopup']);
            Route::get('inquiry/popup/export', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'inquiryPopup']);
            Route::get('inquiry/customer/export', [\App\Http\Controllers\Webpanel\ExportCtrl::class, 'inquiryCustomer']);
        });

        Route::prefix('banner')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'create']);
            Route::put('/create', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'store']);
            Route::get('/edit/{id}', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'edit'])->where(['id' => '[0-9]+']);
            Route::post('/edit/{id}', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'update'])->where(['id' => '[0-9]+']);
            Route::get('/status/{id}', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'status']);
            Route::get('/delete', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'delete']);
            Route::post('/sort', [\App\Http\Controllers\Webpanel\BannerCtrl::class, 'sort']);
        });

        Route::get('advertise', [\App\Http\Controllers\Webpanel\AdsCtrl::class, 'index']);
        Route::post('advertise', [\App\Http\Controllers\Webpanel\AdsCtrl::class, 'update']);
        Route::get('advertise/status', [\App\Http\Controllers\Webpanel\AdsCtrl::class, 'status']);

        Route::prefix('package')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'index']);
            Route::post('/{id}', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'update'])->where(['id' => '[0-9]+']);
            Route::get('/get', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'get']);
            Route::get('/adjust', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'adjust']);
            Route::post('/status', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'status']);
            Route::post('/option', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'updateOption']);
            Route::post('/option/status', [\App\Http\Controllers\Webpanel\PackageCtrl::class, 'optionStatus']);
        });

        Route::prefix('email-database')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\EmailDatabaseCtrl::class, 'index']);
        });

        Route::prefix('our-customer')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'index']);
            Route::get('/create', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'create']);
            Route::put('/create', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'store']);
            Route::get('/edit/{id}', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'edit']);
            Route::post('/edit/{id}', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'updated']);
            Route::get('/status/{id}', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'status']);
            Route::get('/delete/{id}', [\App\Http\Controllers\Webpanel\OurCustomerCtrl::class, 'delete'])->where(['id' => '[0-9]+']);
        });

        Route::prefix('/task')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\TaskCtrl::class, 'index']);
            Route::get('/activity/all', [\App\Http\Controllers\Webpanel\TaskCtrl::class, 'allActivity']);
        });

        Route::get('/seo', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'seo']);
        Route::get('/seolanding', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'seolanding']);
        Route::get('/seoedit/{id}', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'seoedit'])->where(['id' => '[0-9]+']);
        Route::get('/seolandingedit/{id}', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'seolandingedit'])->where(['id' => '[0-9]+']);
        Route::post('/seoedit/{id}', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'seoupdate'])->where(['id' => '[0-9]+']);
        Route::post('/seolandingedit/{id}', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'seolandingupdate'])->where(['id' => '[0-9]+']);

        Route::prefix('company')->group(function () use ($category) {

            Route::post('send-email/attach-file', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'uploadAttach']);
            Route::get('send-email/attach-paht', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'attachPath']);
            Route::get('send-email/picture-path', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'picturePath']);
            Route::post('send-email/picture-upload ', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'pictureUpload']);
            Route::delete('send-email/delete-picture', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'deletePicture']);
            Route::post('send-email', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'sendEmailToCompany']);
            Route::get("copyUrlAndStorageData", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'copyUrlAndStorageData']);
            Route::get("/lastcontact", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'getContact']);

            Route::get('/', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'index']);

            foreach ($category as $i => $v) {
                Route::get($v, [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'index']);
                Route::get("$v/statistics/{id}", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'statistic'])->where(['id' => '[0-9]+']);
                Route::get("$v/sms/{id}", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'statistic'])->where(['id' => '[0-9]+']);
                Route::get("$v/banner/{id}", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'statistic'])->where(['id' => '[0-9]+']);
                Route::get("$v/sms/{id}/report", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'reportsms'])->where(['id' => '[0-9]+']);
                Route::get("$v/{id}", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'edit'])->where(['id' => '[0-9]+']);
                Route::get("$v/send-email", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'sendEmail']);
                Route::get("$v/log-of-modified", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'logOfModified']);
                Route::get("$v/log-of-contact", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'getContact']);
                Route::post("$v/updateContact", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'updateContact']);

                Route::get("$v/stat-email/{id}", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'EmailDetail'])->where(['id' => '[0-9]+']);
                Route::get("$v/stat-popup/{id}", [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'PopupDetail'])->where(['id' => '[0-9]+']);
            }
            Route::get('/refuse', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'refuse']);
            Route::get('/refuse/report', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'refuseReport']);
            Route::get('/delisted', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'delisted']);
            Route::post('/restore', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'restore']);
            Route::get('/forceDelete', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'forceDeleted']);
            Route::get('/revise', [\App\Http\Controllers\Webpanel\CompanyCtrl::class, 'reviseJob']);
        });
        Route::prefix('my-job')->group(function () {

            Route::get('/', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'myJob']);

            Route::prefix('cs')->group(function () {

                Route::get('booking', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csBooking']);
                Route::get('license/return', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csLicenseReturn']);
                Route::get('filter/check', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csFilterCheck']);
                Route::post('refuse', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csRefuse']);

                Route::get('cannot-contact', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csCannotContact']);
                Route::get('follow', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csFollow']);
                Route::get('no-response', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csNoResponse']);
                Route::get('check-filter', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csCheckFilter']);

                Route::get('cancel/cannot-contact', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'cancelCannotContact']);
                Route::get('cancel/follow', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'cancelFollow']);
                Route::get('cancel/no-response', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'cancelNoResponse']);
                Route::get('cancel/check-filter', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'cancelCheckFilter']);

                Route::put('new/report', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csNewReport']);
                Route::post('{type}/return/reject', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'returnReject'])->where(['type' => '[a-z]+']);
                Route::get('report', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csReportDaily']);

                Route::get('all', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getAllRow']);

                Route::put('add-row', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'addRow']);
                Route::post('row/delete/{id}', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'deleteRow'])->where(['id' => '[0-9]+']);

                Route::post('rows/import', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'importToDatabase']);

                Route::prefix('on-process')->group(function () {
                    Route::get('/{type}/{id}', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'updateOnProcess'])->where(['type' => '[a-z-]+', 'id' => '[0-9]+']);
                    Route::get('/assignment', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'assignment']);
                    Route::get('/assignment/remove', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeAssignment']);
                });

                Route::post('comment/new', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'storeComment']);
                Route::get('comment/delete', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'deleteComment']);
                Route::get('comments', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'comments']);
                Route::get('pin-a-comment', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'pinAComment']);
                Route::get('comment/remove-pin', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'deletePin']);
                Route::post('attach-file', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'attactFile']);
                Route::get('attach-file/delete', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'attachFileDelete']);
                Route::post('contact/update', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csUpdateContact']);
                Route::post('contact/update-customer', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'csUpdateContactCustomer']);

                Route::get('remark-color/add', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'addRemarkColor']);
                Route::get('remark-color/remove', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeRemarkColor']);
                Route::get('remark-color/all-reset', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeRemarkColor']);
            });


            Route::prefix('stock')->group(function () {
                Route::post('/confirm', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'confirmCreate']);
                Route::get('/confirm/cancel', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeConfirm']);
            });

            Route::prefix('waiting-for-create')->group(function () {

                Route::get('{id}', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getRow'])->where(['id' => '[0-9]+']);
                Route::post('{id}', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'updateRow'])->where(['id' => '[0-9]+']);
                Route::post('confirm', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'confirmCreate']);
                Route::get('confirm/concel', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'confirmCreate']);
                Route::get('/booking', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'bookingForCreate']);
                Route::get('/cancel', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'cancelForCreate']);
                Route::get('/created', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'createdFor']);
                Route::get('/not-created', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'notCreatedFor']);
                Route::get('/designed', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'updateDesigned']);
                Route::get('/designed/remove', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeDesigned']);
                Route::get('/update/company', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'updateCompanyId']);
                Route::get('/remove/company', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeCompanyId']);
                Route::get('/avg', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'updateAVG']);
            });

            Route::get('/refuse', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'refuseCreate']);

            Route::get('ranking', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'ranking']);
            Route::get('ranking/reset', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'rankingReset']);
            Route::post('add-apppointment-date', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'addAppointmentDate']);
            Route::prefix('appointment')->group(function () {
                Route::get('/process', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'appointmentProcess']);
                Route::get('/remove-date', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeDateAppoint']);
                Route::get('/assignment', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'appointmentAssign']);
            });
            Route::prefix('presentation')->group(function () {
                Route::get('/process', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'presentationProgress']);
                Route::get('/package', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'presentationPackage']);
                Route::post('/attach-file', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'AttachFile']);
                Route::get('/attach-file/delete', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'DeleteAttachedFile']);
                Route::post('/new-package', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'newPackage']);
            });
            Route::prefix('customer-list')->group(function () {
                Route::post('/attach-file', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'documentAttach']);
                Route::get('/attach-file/delete', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'DeleteAttachedFile']);
                Route::get('/contract/update', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'contractUpdate']);
            });
            Route::prefix('not-interest')->group(function () {
                Route::get('return-record', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'notInterestReturn']);
            });

            Route::get('designer/booking', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'bookingJobs']);
            Route::get('forward/to/designer', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'forwardToDesigner']);
            Route::get('forward/to/qc', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'forwardToQc']);
            Route::get('forward/blog/to/designer', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'forwardBlogToDesigner']);
            Route::get('forward/blog/to/qc', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'forwardBlogToQc']);
            Route::get('remove-from-stock/step3', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'removeStep3']);
            Route::post('reject', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'reject']);
            Route::post('revise', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'reject']);

            Route::post('blog/return/to/qc', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'returnBlogToQc']);

            Route::get('qc/finished/{bool}/{id}', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'jobFinished'])->where(['bool' => '[a-z]+', 'id' => '[0-9]+']);
            Route::get('qc/check-user-duplicate', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'checkUsernameDuplicate']);
            Route::post('qc/new-user', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'newUser']);
            Route::post('qc/update/user', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'updateUser']);
            Route::delete('qc/delete/user', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'deleteUser']);
            Route::get('/qc/get/job-progress', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getJobProgress']);
            Route::get('/qc/get/blog', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getBlog']);
            Route::get('qc/get/activity', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getActivity']);
            Route::get('qc/get/company/online', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getCompanyOnline']);
            Route::post('qc/reject/blog', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'blogReject']);

            Route::post('qc/blog/finished', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'blogFinished']);

            Route::get('/get/users', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'getUsers']);
        });
        Route::get('http/checking', function () {
            return view('back-end/modules/http-checking/index', ['prefix' => 'webpanel']);
        });
        Route::post('http/checking/save', function () {


            $data = \App\Models\CompanyMd::find(request()->id);
            if (@$data->id) {
                $now = date('Y-m-d H:i:s');
                $data->name_th = request()->name_th;
                $data->name_en = request()->name_en;
                $data->name_jp = request()->name_en;
                $data->name_zh = request()->name_en;
                $data->website = request()->website;
                $data->checked = 'checked';

                if ($data->save()) {
                    $action  = explode(',', request()->action);
                    for ($i = 0; $i < count($action); $i++) {
                        $new = new \App\Models\LogOfModifiedMd;
                        $new->company = $data->id;
                        $new->user = Auth::user()->id;
                        $new->action = @$action[$i];
                        $new->created = $now;
                        $new->save();
                    }
                    $res = [
                        'status' => true,
                        'statusCode' => 200,
                        'icon' => 'success',
                        'title' => 'Good job',
                        'text' => 'Your request is successfully.'
                    ];
                } else {
                    $res = [
                        'status' => false,
                        'statusCode' => 500,
                        'icon' => 'error',
                        'title' => 'Oops',
                        'text' => 'An error has occurred.'
                    ];
                }
            } else {
                $res = [
                    'status' => false,
                    'statusCode' => 500,
                    'icon' => 'error',
                    'title' => 'Oops',
                    'text' => 'An error has occurred.'
                ];
            }
            return  response()->json($res);
        });
        Route::post('http/checking/move-to-trash', function () {
            $data = \App\Models\CompanyMd::find(request()->id);
            $res = [
                'status' => false,
                'statusCode' => 500,
                'icon' => 'error',
                'title' => 'Oops',
                'text' => 'An error has occurred.'
            ];
            if ($data->id) {
                \App\Models\CompanyMd::where('id', $data->id)->update(['reason' => request()->reason]);
                $data->delete();
                $log = new \App\Models\LogOfModifiedMd;
                $log->company = $data->id;
                $log->user = Auth::user()->id;
                $log->action = "Move $data->name_th to trash";
                $log->created = date("Y-m-d H:i:s");
                $log->save();
                $res = [
                    'status' => true,
                    'statusCode' => 200,
                    'icon' => 'success',
                    'title' => 'Good job',
                    'text' => 'Your request is successfully.'
                ];
            }
            return response()->json($res);
        });

        Route::get('detail/generate', function () {
            return view("back-end/modules/custom/detail-generate", ['prefix' => 'webpanel']);
        });
        Route::post('detail/generate/save-or-edit', function () {
            $data = \App\Models\CompanyMd::find(request()->id);
            $data->detail_th = request()->detail_th;
            $data->detail_en = request()->detail_en;
            $data->detail_jp = request()->detail_jp;
            $data->detail_zh = request()->detail_zh;
            if ($data->save()) {
                $res = [
                    'status' => true,
                    'statusCode' => 201,
                    'icon' => 'success',
                    'title' => 'Good job',
                    'text' => 'Your request is successfully.'
                ];
            } else {
                $res = [
                    'status' => false,
                    'statusCode' => 500,
                    'icon' => 'error',
                    'title' => 'Oops',
                    'text' => 'An error has occurred.'
                ];
            }
            return  response()->json($res);
        });

        Route::prefix('job-progress')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'index']);
            Route::get('/booking', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'booking']);
            Route::get('/delete', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'delete']);
            Route::get('/delete-booking', [\App\Http\Controllers\Webpanel\JobProgressCtrl::class, 'deleteBooking']);
        });


        Route::prefix('users')->group(function () {
            // Route::get('/get/access-token',[\App\Http\Controllers\Webpanel\AuthCtrl::class,'getAccessToken']);

            // JSON
            Route::get('all', [\App\Http\Controllers\Api\UsersCtrl::class, 'all']);

            Route::get('/', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'index']);
            Route::get('create', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'create']);
            Route::put('create', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'store']);

            Route::get('login-with-id', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'loginWithId']);
            Route::post('login-with-id', [\App\Http\Controllers\Webpanel\AuthCtrl::class, 'loginWithId']);


            Route::get('change-password', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'changePassword']);
            Route::post('change-password', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'updatePassword']);


            Route::get('edit/{id}', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'edit'])->where(['id' => '[0-9]+']);
            Route::post('edit/{id}', [\App\Http\Controllers\Webpanel\UsersCtrl::class, 'update'])->where(['id' => '[0-9]+']);
        });
        Route::prefix('get')->group(function () {
            Route::get('/category/{position}/{id}', [\App\Http\Controllers\Webpanel\Setting::class, 'getMenuPosition'])->where(['position' => '[a-z]+', 'id' => '[0-9]+']);
        });

        Route::prefix('business-category')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\Setting::class, 'BusinessCategory']);
            Route::post('/store/category', [\App\Http\Controllers\Webpanel\Setting::class, 'storeCategory']);
            Route::post('/update/category', [\App\Http\Controllers\Webpanel\Setting::class, 'updateCategory']);
            Route::delete('/delete/category', [\App\Http\Controllers\Webpanel\Setting::class, 'deleteCategory']);
        });
        Route::get('rov-random-player', function () {
            return view("back-end.modules.custom.rov", ['prefix' => 'webpanel']);
        });


        Route::prefix('to-do-list')->group(function () {
            Route::get('/', [\App\Http\Controllers\Webpanel\TodolistCtrl::class, 'index']);
            Route::post('/description', [\App\Http\Controllers\Webpanel\TodolistCtrl::class, 'updateDescription']);
        });
    });
});
