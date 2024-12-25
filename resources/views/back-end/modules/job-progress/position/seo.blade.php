@php
    $seoToday = \App\Models\SeoProgressMd::whereDate('created',date('Y-m-d'))->count();
    $seo = \App\Models\SeoProgressMd::select([
        'cp.id as company',
        'cp.name_th',
        'cp.name_en',
        'category.key',
        'category.name_jp as categoryName',
        'cp.seo_keyword_th',
        'cp.seo_keyword_en',
        'cp.seo_keyword_jp',
        'cp.seo_keyword_zh',
        'use.name as by',
        'seo_progress.created'
    ])
    ->leftJoin('company as cp','seo_progress.company','=','cp.id')
    ->leftJoin('category','cp.category','=','category.id')
    ->leftJoin('users as use','seo_progress.by','=','use.id')
    ->orderBy('seo_progress.created','desc')
    ->limit(40)
    ->get()
@endphp
<div class="row" id="seo-content">
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">SEO Keyword</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{$seoToday}}</div>
                </div>
            </div>
        </div>
    </div>

    <!--  list -->
    <div class="col-lg-12 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Company <strong class="text-info">45</strong></h5>
                <div class="ms-auto text-end mt-n1 col-auto">
                    <button class="btn btn-falcon-default"><i class="far fa-calendar-alt"></i>&nbsp;  Date</button><!-- เลือกวันดูย้อนหลัง -->
                </div>
            </div>
            <div class="card-body p-0 tranfer-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                {{-- <th class="text-center"></th> --}}
                                <th>Company Name</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">SEO</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seo as $k => $v)
                            <tr class="align-middle">
                                <td class="text-center">{{$k+1}}</td>
                                {{-- <td class="text-center">
                                    <img src="images/company/109/logo_29072021-13361907-xs.jpeg" class="file-thumbnail border">
                                </td> --}}
                                <td class="text-left">
                                    <a class="text-dark" href="th/preview/company-profile/{{$v->company}}" target="_blank">
                                        <p class="cp-name mb-0">{{$v->name_jp}}</p>
                                        <p class="cp-name mb-0">{{$v->name_th}}</p>   <!-- ใส่ link preview -->
                                    </a>
                                </td>
                                <td class="text-center">{{$v->categoryName}}</td>

                                <td class="text-center">
                                    <div class="row p-0">
                                        <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step1">
                                            <div class="box-step">
                                                <div class="@if($v->seo_keyword_th)progress-success @else progress-none @endif">@if($v->seo_keyword_th)<i class="fas fa-check-circle"></i>@endif TH</div>              
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step2">
                                            <div class="box-step">
                                                <div class="@if($v->seo_keyword_en)progress-success @else progress-none @endif">@if($v->seo_keyword_en)<i class="fas fa-check-circle"></i>@endif EN</div>             
                                            </div>
                                        </div>  
                                        <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step3">  <!-- ถ้าไม่มีข้อมูล ให้ใส่ progress-none -->
                                            <div class="box-step">
                                                <div class="@if($v->seo_keyword_jp)progress-success @else progress-none @endif">@if($v->seo_keyword_jp)<i class="fas fa-check-circle"></i>@endif JP</div>                 
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step4">
                                            <div class="box-step">
                                                <div class="@if($v->seo_keyword_zh)progress-none @else progress-none @endif">@if($v->seo_keyword_zh)<i class="fas fa-check-circle"></i>@endif CH</div>               
                                            </div>
                                        </div>
                                    </div>
                                </td> 
                                <td class="text-center"><div>{{date('d M Y H:i',strtotime($v->created))}}</div></td> <!-- วันที่กด save seo -->
                                <td class="text-center"><a href="http://127.0.0.1:8000/webpanel/members/100/109" class="badge bg-light text-dark"><i class="fas fa-pen"></i> Edit</a></td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div>
</div><!-- row -->