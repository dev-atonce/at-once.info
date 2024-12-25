<?php
use Illuminate\Support\Facades\Route;

Route::prefix('demo')->group(function(){

    Route::get('/',function(){ return 'Demo'; });
    Route::get('company/profile/{url}',[\App\Http\Controllers\Demo\CompanyCtrl::class,'profile'])->where(['url'=>'[A-Za-z0-9,.()-]+']);
    Route::get('p/u/{url}',[\App\Http\Controllers\Demo\CompanyCtrl::class,'detailHtml'])->where(['url'=>'[A-Za-z0-9,.()-]+']);

    // <MA BLOG>
    Route::get('blog/detail/{id}/{cid}/{url}',[\App\Http\Controllers\Demo\CompanyCtrl::class,'blog'])->where(['id'=>'[0-9]+','cid'=>'[0-9]+']);
    // ============================ //

})

?>
