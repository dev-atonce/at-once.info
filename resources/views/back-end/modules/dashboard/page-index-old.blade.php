<style>
select[name="st-country_length"]{
  width: 100% !important;
}
.fs-2 {
    font-size: 1rem !important;
}
.fs-3 {
    font-size: 1.25rem !important;
}
.fs-4 {
    font-size: 1.5rem !important;
}
.fs-5 {
    font-size: 1.75rem !important;
}
.fa-maximize{
  background-image: url('img/maximize.svg');
}
.fa-minimize{
  background-image: url('img/minimize.svg');
}
.text-uppercase {
    text-transform: uppercase !important;
}
.fw-semibold {
    font-weight: 600 !important;
}
small, .small {
    font-size: 0.775em;
}
.card-body{
    /* overflow: hidden; */
    display:inline-block;
    text-overflow: ellipsis;
    /*overflow: hidden; */
    white-space: nowrap;
}
.progress-thin {
    height: 4px;
}
.tab-today-activity,
.tab-blog-activity
{
  cursor: pointer;
}

.scroll-y {
    /* padding: 1rem; */
    max-height: 523px;
    overflow-y: scroll;
    scrollbar-gutter: stable;
}

.scroll-y::-webkit-scrollbar {
    width: 12px;
    
}
.scroll-y::-webkit-scrollbar-track {
    background-color: rgb(237,237,237,0.3);
}
.scroll-y::-webkit-scrollbar-thumb {
    background-color: #c1c1c1;
}
.badge-yellow{
    background-color: yellow;
}
span.dot{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: calc(100%);
    display: block;
}
ol.pl-4{
  border-bottom:1px solid #c1c1c1;
}
.fas.fa-sync-alt.rotate {  
    -webkit-animation:spin 0.65s linear infinite;
    -moz-animation:spin 0.65s linear infinite;
    animation:spin 0.65s linear infinite;
}
.fas.fa-sync-alt {
     transition: transform 0.5s ease 0s;
}
.bg-lightgrey{
    background-color: #ebedef;
}
.bg-lightgrey .progress{
    background-color: #fff !important;
}
@-moz-keyframes spin { 
    100% { -moz-transform: rotate(360deg); } 
}
@-webkit-keyframes spin { 
    100% { -webkit-transform: rotate(360deg); } 
}
@keyframes spin { 
    100% { 
        -webkit-transform: rotate(360deg); 
        transform:rotate(360deg); 
    } 
}
ol li div.list-item span,
ol li div.list-item a
{
  padding-left: 5px;
  text-overflow: ellipsis;
  overflow: hidden;
}
/* [class^='col-lg'] ol li div.list-item span{
  width: 520px;
} */

/* [class^='col-sm'] .list-item-right{
  position: unset !important;
} */
.list-item-right{
    position: absolute;
    right: 15px;
}
/* .thead-sticky thead tr th{
    position: sticky;
    top: 20px;
} */
option[disabled]{
  color:#dedede !important;
}
.bg-ultra-light{
  background-color: #fbfbfb;
}
.today-body,
.blog-body{
    white-space: initial;
}
ol.activity-list li{
    white-space: nowrap;
}

.table-industry {
    display: block;
    width: 100%;
    overflow-x: visible;
    border-radius: 0px;
    background-color: transparent;
    -webkit-overflow-scrolling: touch;
}

/* Fixed Headers */
.table-industry thead {
  vertical-align: bottom;
background-color: #ffffff;
box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 1px;
}

.table-industry thead {
  position: sticky;
  top: 55px;
  z-index: 2;
}

.table-industry thead[scope=row] {
  position: sticky;
  left: 0;
  z-index: 1;
}

.table-industry thead[scope=row] {
  vertical-align: top;
  color: inherit;
  background-color: inherit;
}

table:nth-of-type(2) th:not([scope=row]):first-child {
  left: 0;
  z-index: 3;
}

/* Strictly for making the scrolling happen. */

.table-industry thead[scope=row] + td {
  min-width: 24em;
}

.table-industry thead[scope=row] {
  min-width: 20em;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 0px solid;
    border-bottom-color: #d8dbe0;
}

@media (max-width: 768px){
  .table-industry thead {
    position: relative;
    top: 55px;
    z-index: 2;
  }

  .table-industry thead[scope=row] {
    position: relative;
  }
}

@media (max-width: 820px){
  .table-industry thead {
    position: relative;
    top: 55px;
    z-index: 2;
  }

  .table-industry thead[scope=row] {
    position: relative;
  }
}

</style>
<div>
    <link href="back-end/vendors/@coreui/coreui-chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <div class="fade-in">
        <div class="row">
            @php

              $goalCreated = 46;
              $goal = 46;
              $goalBlog = 5;
              $now = date('Y-m-d');
              $progressMd = \App\Models\JobProgressMd::class;
              $BlogMd = \App\Models\BlogMd::class;
              // Company Profile
              $created = $progressMd::where(db::raw('DATE(step1_on)'),'like',$now)->count();
              $per_created=round((($created*100)/$goalCreated),2);

              $edited = $progressMd::where(db::raw('DATE(step2_on)'),'like',$now)->count();
              $per_edited=round((($edited*100)/$goal),2);

              $design = $progressMd::where(db::raw('DATE(step3_on)'),'like',$now)->count();
              $per_design =round((($design*100)/$goal),2);
              
              $online = $progressMd::where(db::raw('DATE(step4_on)'),'like',$now)->count();
              $per_online=round((($online*100)/$goal),2);
              // Blog
              $blogCreated = $BlogMd::where(db::raw('DATE(created)'),'like',$now)->count();
              $blog_per_created = round((($blogCreated*100)/$goalBlog),2);
              $blogOnline = $BlogMd::where(db::raw('DATE(publish)'),'like',$now)->count();
              $blog_per_online=round((($blogOnline*100)/$goalBlog),2);
              
             
              $lastday = date('d',strtotime('last day of this month',strtotime(date('Y-m-d'))));

              $myIndustry = \App\Models\CompanyMd::select([
                  'industry.id',
                  'industry.name_jp as name',
                  'industry.key',
                  db::raw('count(company.industry) as company'),
                  db::raw('count(IF(company.public = 1 AND company.type = "full", 1, NULL)) as online'),
                  db::raw('count(IF(company.public = 0 AND company.type = "full", 1, NULL)) as offline'),
                  db::raw('count(IF(company.more_th IS NULL AND company.more_jp IS NULL AND company.type = "full", 1, NULL)) as no_detail'),
                  db::raw('count(IF(job_progress.step3 IS NULL AND company.type = "full", 1, NULL)) as no_design'),
              ])
              ->leftJoin('industry','company.industry','=','industry.id')
              ->leftJoin('job_progress','company.id','job_progress.company')
              ->groupBy('company.industry')
              ->orderBy('id')
              ->get();

              // $copyRight = \App\Models\CompanyMd::whereNotNull('copy_right')->get();

            @endphp
            
            <div class="col-sm-12 col-lg-12">
              
              {{-- <div class="card">
                <div class="card-body"> --}}

                  <div class="row p1">
                    <div class="col-sm-12 col-lg-8 pl-2 pr-2" id="todayActivity">
                      <h5 class="font-weight-bold">Company Profile</h5>
                      <div class="card bg-secondary-gradient">
                        <div class="card-body today-body">
                          <div class="row">
                            <div class="col-12 d-flex">
                              <h6>Today's activity</h6>
                              <a href="javascript:" class="today text-dark ml-2" title="Refresh"><i class="fas fa-sync-alt"></i></a>       
                              <a href="javascript:" class="print-today text-dark ml-2" title="Print today"><i class="fas fa-print"></i></a>
                            </div>
                            <div class="position-absolute mr-3" style="right:0;">
                              <a href="javascript:" class="text-dark today-more"><i class="fas fa-angle-down fa-lg"></i></a>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity" data-tab="step1">                                                           
                              <div class="fs-4 fw-semibold"><span>{{$created}}</span>/{{$goalCreated}}</div>
                              <small class="text-medium-emphasis text-uppercase fw-semibold">Created</small> <small>(1)</small>
                              <small class="float-right">{{$per_created}}%</small> 
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$per_created}}%" aria-valuenow="{{$per_created}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>                          
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity" data-tab="step2">                          
                              <div class="fs-4 fw-semibold"><span>{{$edited}}</span>/{{$goal}}</div>
                              <small class="text-medium-emphasis text-uppercase fw-semibold">Edited</small> <small>(2)</small>
                              <small class="float-right">{{$per_edited}}%</small> 
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$per_edited}}%" aria-valuenow="{{$per_edited}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>                              
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity" data-tab="step3">
                              <div class="fs-4 fw-semibold"><span>{{$design}}</span>/{{$goal}}</div>
                              <small class="text-medium-emphasis text-uppercase fw-semibold">Design</small> <small>(3)</small>
                              <small class="float-right">{{$per_design}}%</small> 
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$per_design}}%" aria-valuenow="{{$per_edited}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity" data-tab="step4">                          
                              <div class="fs-4 fw-semibold"><span>{{$online}}</span>/{{$goal}}</div>
                              <small class="text-medium-emphasis text-uppercase fw-semibold">Online</small> <small>(4)</small>
                              <small class="float-right">{{$per_online}}%</small> 
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$per_online}}%" aria-valuenow="{{$per_online}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>                            
                            </div>
                          </div>

                          <div class="row d-none">
                            <div class="col-lg-12 pt-3" tab="step1" tab-toggle="today-activity">
                              <ol class="pl-4 mb-1 profile-list">
                                @if($step1->count()>0)
                                  @foreach($step1 as $k1 => $rs1)
                                  <li id="{{$rs1->industry_id}}" job="{{$rs1->id}}" industry="{{$rs1->industry}}"><div class="list-item d-flex position-relative"><strong>{{$rs1->industry}}</strong> <span>@if($rs1->name_jp!=''){{$rs1->name_jp}}@else{{$rs1->name_th}}@endif</span> @if($rs1->by!='')<small class="list-item-right" by="{{$rs1->by}}"><strong>By:</strong> {{$rs1->by}}</small>@endif</div></li>
                                  @endforeach
                                @else
                                  <li style="list-style:none;" class="text-center" no-record="">No Record.</li>
                                @endif
                              </ol>
                            </div>
                            <div class="col-lg-12 pt-3 d-none" tab="step2" tab-toggle="today-activity">
                              <ol class="pl-4 mb-1 activity-list profile-list">
                                @if($step2->count()>0)
                                  @foreach($step2 as $k2 => $rs2)
                                  <li id="{{$rs2->industry_id}}" job="{{$rs2->id}}" industry="{{$rs2->industry}}"><div class="list-item d-flex position-relative"><strong>{{$rs2->industry}}</strong> <span>@if($rs2->name_jp!=''){{$rs2->name_jp}}@else{{$rs2->name_th}}@endif</span> @if($rs2->by!='')<small class="list-item-right" by="{{$rs2->by}}"><strong>By:</strong> {{$rs2->by}}</small>@endif</div></li>
                                  @endforeach
                                @else
                                  <li style="list-style:none;" class="text-center" no-record="">No Record.</li>
                                @endif
                              </ol>
                            </div>
                            <div class="col-lg-12 pt-3 d-none" tab="step3" tab-toggle="today-activity">
                              <ol class="pl-4 mb-1 activity-list profile-list">
                                @if($step3->count()>0)
                                  @foreach($step3 as $k3 => $rs3)
                                  <li id="{{$rs3->industry_id}}" job="{{$rs3->id}}" industry="{{$rs3->industry}}"><div class="list-item d-flex position-relative"><strong>{{$rs3->industry}}</strong> <span>@if($rs3->name_jp!=''){{$rs3->name_jp}}@else{{$rs3->name_th}}@endif</span> @if($rs3->by!='')<small class="list-item-right" by="{{$rs3->by}}"><strong>By:</strong> {{$rs3->by}}</small>@endif</div></li>
                                  @endforeach
                                @else
                                  <li style="list-style:none;" class="text-center" no-record="">No Record.</li>
                                @endif
                              </ol>
                            </div>
                            <div class="col-lg-12 pt-3 d-none" tab="step4" tab-toggle="today-activity">
                              <ol class="pl-4 mb-1 activity-list profile-list">
                                @if($step4->count()>0)
                                  @foreach($step4 as $k4 => $rs4)
                                  <li id="{{$rs4->industry_id}}" industry="{{$rs4->industry}}"><div class="list-item d-flex position-relative"><strong>{{$rs4->industry}}</strong> <a href="{{url('/th')}}/{{$rs4->key}}/cp/{{$rs4->profile_url}}" target="_blank">@if($rs4->name_jp!=''){{$rs4->name_jp}}@else{{$rs4->name_th}}@endif </a>@if($rs4->by!='')<small class="list-item-right" by="{{$rs4->by}}"><strong>By:</strong> {{$rs4->by}}</small>@endif</div></li>
                                  @endforeach
                                @else
                                  <li style="list-style:none;" class="text-center" no-record="">No Record.</li>
                                @endif
                              </ol>
                            </div>
                            <div class="col-lg-12 py-1">
                              <p class="text-black profile-total mb-2">Total: </p>
                              <p class="text-black profile-by mb-0 pb-0">By: </p>
                            </div>
                          </div>
                          @php($CompanyMd = \App\Models\CompanyMd::class)
                          @php($noDesign = $CompanyMd::whereNull('more_th')->whereNull('more_jp')->count())
                          @php($remain = $CompanyMd::whereNull('logo')->count())
                          @php($public = $CompanyMd::where('public',1)->count())
                          @php($lastStep = $CompanyMd::whereNotNull('edited')->where('public',0)->count())
                          @php($allCompany = $CompanyMd::count())
                          @php($remainning = $remain)
                          <div class="row profile-remainning" style="margin-top: 12px;">
                            <div class="col-lg-6 col-xs-12">
                              <strong>Remaining to be detail data (2):</strong> <span>{{number_format($noDesign)}}</span>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                              <strong>Remaining to be design (3):</strong> <span>{{number_format($remainning)}}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4 col-xs-12 col-md-12 pl-2 pr-2" id="blogActivity">
                      <h5 class="font-weight-bold">Blog</h5>
                      <div class="card bg-secondary">
                        <div class="card-body blog-body">
                          <div class="row">
                            <div class="col-12 d-flex">
                              <h6>Today's activity</h6>
                              <a href="javascript:" class="blog-today text-dark ml-2" title="Refresh"><i class="fas fa-sync-alt"></i></a>       
                              {{-- <a href="javascript:" class="print-today text-dark ml-2" title="Print today"><i class="fas fa-print"></i></a> --}}
                            </div>
                            <div class="position-absolute mr-3" style="right:0;">
                              <a href="javascript:" class="text-dark blog-more"><i class="fas fa-angle-down fa-lg"></i></a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-6 tab-blog-activity" data-tab="blog-created">                                                           
                              <div class="fs-4 fw-semibold"><span>{{$blogCreated}}</span>/{{$goalBlog}}</div>
                              <small class="text-medium-emphasis text-uppercase fw-semibold">Created</small>
                              <small class="float-right">{{$blog_per_created}}%</small> 
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$blog_per_created}}%" aria-valuenow="{{$blog_per_created}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>                          
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-6 tab-blog-activity" data-tab="blog-online">                          
                              <div class="fs-4 fw-semibold"><span>{{$blogOnline}}</span>/{{$goalBlog}}</div>
                              <small class="text-medium-emphasis text-uppercase fw-semibold">Online</small>
                              <small class="float-right">{{$blog_per_online}}%</small> 
                              <div class="progress progress-thin">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$blog_per_online}}%" aria-valuenow="{{$blog_per_online}}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>                            
                            </div>
                          </div>
                          @php($blogSelect = ['blog.id','ind.name_jp as industryName','ind.key','ind.id as industryId','blog.name_th','blog.created','blog.created_by','blog.publish','blog.published_by'])
                          @php($query = $BlogMd::select($blogSelect)->leftJoin('industry as ind','blog.type','=','ind.id'))
                          <div class="row d-none">
                            <div class="col-lg-12 pt-3" tab="blog-created" tab-toggle="blog-activity">
                              <ol class="pl-4 mb-1 activity-list">
                                @foreach($query->where(db::raw('DATE(blog.created)'),'like',$now)->get() as $k => $rs)
                                <li id="{{$rs->industryId}}" industry="{{$rs->industryName}}"><div class="list-item d-flex position-relative"><strong>{{$rs->industryName}}</strong><span>{{$rs->name_th}}</span> @if($rs->created_by!='')<small class="list-item-right" blog-by="{{$rs->created_by}}"><strong>By:</strong> {{$rs->created_by}}</small>@endif</div></li>
                                @endforeach
                              </ol>
                            </div>
                            <div class="col-lg-12 pt-3 d-none" tab="blog-online" tab-toggle="blog-activity">
                              <ol class="pl-4 mb-1 activity-list">
                                @foreach($query->where(db::raw('DATE(blog.publish)'),'like',$now)->get() as $k => $rs)
                                <li id="{{$rs->industryId}}" industry="{{$rs->industryName}}"><div class="list-item d-flex position-relative"><strong>{{$rs->industryName}}</strong><a href="{{url('/th/blog')}}" target="_blank">{{$rs->name_th}} </a>@if($rs->published_by!='')<small class="list-item-right" blog-by="{{$rs->published_by}}"><strong>By:</strong> {{$rs->published_by}}</small>@endif</div></li>
                                @endforeach
                              </ol>
                            </div>
                            <div class="col-lg-12 py-1">
                              <p class="text-black blog-total mb-2">Total: </p>
                              <p class="text-black blog-by mb-0 pb-0">By: </p>
                            </div>
                          </div>
                          <div class="row blog-remainning" style="margin-top: 12px;">
                            <div class="col-lg-12">
                              <strong>All Blog :</strong> <span>{{$blog}}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <div class="col-sm-6 col-lg-2 pl-2 pr-2">
                      <div class="card text-white bg-gradient-primary">
                          <div class="card-body d-flex justify-content-between align-items-start">
                              <div class="text-value-lg">{{$member}}</div>
                              <div>Members</div>
                          </div>
                      </div>
                    </div> --}}

                    {{-- <div class="col-lg-2">
                      <h5>&nbsp;</h5>
                      <div class="row">
                        <div class="col-xs-12 col-lg-12 pl-2 pr-2">
                          <div class="card text-white bg-gradient-info mb-3">
                              <div class="card-body d-flex justify-content-between align-items-start">
                                  <div class="text-value-lg">{{$count_mail}}</div>
                                  <div>Mail</div>
                              </div>
                          </div>
                        </div>      

                        <div class="col-xs-12 col-lg-12 pl-2 pr-2">
                          <div class="card text-white bg-gradient-warning">
                              <div class="card-body d-flex justify-content-between align-items-start">
                                  <div class="text-value-lg">{{$blog}}</div>
                                  <div>Blog</div>
                              </div> 
                          </div>
                        </div>

                      </div>
                    </div>
                    --}}
                  </div>
                  @php($CompanyMd=\App\Models\CompanyMd::class)
                  @php($online = $CompanyMd::where('public',1)->count())
                  @php($onlineFull = $CompanyMd::where(['public'=>1,'type'=>'full'])->count())
                  @php($onlineBasic = $CompanyMd::where(['type'=>'basic','public'=>1])->count())
                  @php($completedOn = $CompanyMd::leftJoin('job_progress','company.id','job_progress.company')->where(['company.type'=>'full','company.public'=> 1,'job_progress.step1'=>1,'job_progress.step2'=>1,'job_progress.step3'=>1])->count())
                    @php($completedOff = $CompanyMd::leftJoin('job_progress','company.id','job_progress.company')->where(['company.type'=>'full','company.public'=> 0,'job_progress.step1'=>1,'job_progress.step2'=>1,'job_progress.step3'=>1])->count())
                  @php($completedTotal = $completedOn + $completedOff)
                  @php($delisted = \App\Models\CompanyMd::onlyTrashed()->count())
                  @php($grandTotal = ($completedTotal + $delisted))
                      
                  @php($month = ['January','February','March','April','May','June','July','August','September','October','November','December'])
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-12 pl-2 pr-2 summary-industry">
                      <div class="card bg-success bg-success-gradient">
                          <div class="card-body p-3">
                              {{-- <div class="text-white fs-4 fw-semibold">
                                <span>{{$public}}</span><small class="fs-2">/{{$allCompany}}</small>
                              </div> --}}
                              <div class="row">
                                  <div class="col-lg-3 col-xs-12 col-md-3 text-white text-center">
                                      <h6>Online</h6>
                                      <h6>{{number_format($online)}}</h6>
                                      <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">Full<br/>{{number_format($onlineFull)}}</div>
                                        <div class="col-lg-6 col-md-6 col-6">Basic<br/>{{number_format($onlineBasic)}}</div>
                                      </div>
                                  </div>
                                  <div class="col-lg-4 col-xs-12 col-md-4 text-white text-center mb-1 border-left">
                                    <div class="border-top w-100 my-1 d-block d-sm-none"></div>
                                      <h6>Completed</h6>
                                      <div class="row">
                                        <div class="col-lg-12 col-xs-12"><span class="float-left">Full Online</span> <span class="float-right">{{number_format($completedOn)}}</span></div>
                                        <div class="col-lg-12 col-xs-12"><span class="float-left">Full Offline</span> <span class="float-right">{{number_format($completedOff)}}</span></div>
                                        <div class="col-lg-12 col-xs-12"><span class="float-left">Total</span> <span class="float-right">{{number_format($completedTotal)}}</span></div>
                                      </div>
                                  </div>
                                  <div class="col-lg-5 col-xs-12 col-md-5 text-white text-center border-left mb-1">
                                    <div class="border-top w-100 my-1 d-block d-sm-none"></div>
                                      <h6>All Company</h6>
                                      <h6>{{number_format($CompanyMd::count())}}</h6>
                                      <div class="row">
                                        <div class="col-4 col-lg-4 col-md-4"><span>Basic</span><br/>{{number_format($CompanyMd::where('type','basic')->count())}}</div>
                                        <div class="col-4 col-lg-4 col-md-4"><span>Full</span><br/>{{number_format($CompanyMd::leftJoin('job_progress','company.id','job_progress.company')->where(['company.type'=>'full','job_progress.step1'=>1,'job_progress.step2'=>1,'job_progress.step3'=>1])->count())}}</div>
                                        <div class="col-4 col-lg-4 col-md-4"><span>Progress</span><br/>{{number_format($CompanyMd::leftJoin('job_progress','company.id','job_progress.company')
                                                                                                                                  ->where('company.type','full')
                                                                                                                                  ->where(function($query){
                                                                                                                                    $query->where(['job_progress.step1' => 1,'job_progress.step2'=> 1 ])
                                                                                                                                          ->orWhere(['job_progress.step1' => 1]);
                                                                                                                                  })
                                                                                                                                  ->whereNull(['step3'])
                                                                                                                                  ->count())}}
                                                                                                                                  </div>
                                      </div>
                                  </div>
                                  
                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="border-top w-100 my-1"></div>
                                  <div class="row">
                                    <div class="col-lg-7 col-md-7 col-xs-12 mt-1">
                                      <div class="row">
                                        <div class="col-lg-5 col-md-5 d-none d-sm-block">
                                          <p class="mb-0 text-white">Completed total </p>
                                          <p class="mb-0 text-white">Delisted company </p>
                                        </div>
                                        <div class="col-lg-7 col-md-7 d-none d-sm-block">
                                          <p class="mb-0 text-white">{{number_format($completedTotal)}}</p>
                                          <p class="mb-0 text-white">{{number_format($delisted)}}</p>
                                        </div>
                                      </div>
                                      <div class="row d-block d-sm-none">
                                        <div class="col-sm-12">
                                          <p class="mb-0 text-white">Completed total : {{number_format($completedTotal)}}</p>
                                        </div>
                                        <div class="col-sm-12">
                                          <p class="mb-0 text-white">Delisted company : {{number_format($delisted)}}</p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-xs-12 border-left mt-1">
                                      <span class="text-white">Grand Total : </span>
                                      <span class="text-white">{{number_format($grandTotal)}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              {{-- <small class="text-white text-medium-emphasis text-uppercase fw-semibold dot">All Company</small> --}}
                          </div>
                      </div>                        
                    </div>    
                    @foreach($myIndustry as $k => $item)
                        <div class="col-lg-2 col-sm-6 col-md-4 pl-2 pr-2 industry-item">
                            <div class="card mb-3 bg-light-gradient">
                                <div class="card-body">
                                    <div class="row">
                                      <div class="col-12"><span class="dot" style="font-size: 17px;">{{($k+1)}}. {{$item->name}}</span></div>
                                      <div class="col-left col-lg-12 col-xs-12">                                      
                                        <div class="font-weight-bold fs-4 fw-semibold text-success">{{number_format($item->online)}}
                                          <small class="fs-2 fw-semibold text-dark">/{{number_format($item->company)}}</small>
                                        </div>
                                      </div>
                                      <div class="col-right mt-2 col-lg-12 col-xs-12">          
                                          <a href="{{url('webpanel/company')}}/{{$item->key}}?offline=1" class="text-dark">
                                            <p class="mb-1">
                                              <span class="badge badge-dark">{{$item->offline}}</span> Offline
                                            </p>
                                          </a>
                                          <a href="{{url('webpanel/company')}}/{{$item->key}}?no_detail=1" class="text-dark">
                                            <p class="mb-1">
                                              <span class="badge badge-info">{{$item->no_detail}}</span> No Detail
                                            </p>
                                          </a>
                                          <a href="{{url('webpanel/company')}}/{{$item->key}}?no_logo=1" class="text-dark">
                                            <p class="mb-1">
                                              <span class="badge badge-primary">{{$item->no_design}}</span> No Design
                                            </p>
                                          </a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    @endforeach     
                   
                  </div>  
                  <div class="row online-section" id="onlineTable">
                    <div class="col-lg-12 px-2">
                      <hr>
                      <div class="row">
                        <div class="col-lg-6">
                          <button class="btn btn-primary font-weight-bold">KPI <i class="fas fa-caret-right ml-2"></i></button>
                        </div>
                        <div class="col-lg-6">
                          <div class="d-flex align-items-end">
                            @php($m=date('m'))
                            @php($lastYear=date('Y'))
                            <div class="ml-auto">
                              <form action="" class="form-inline d-none">                        
                                <div class="form-group">
                                  <select name="year" class="custom-select">
                                    <option value="" hidden>Year</option>
                                    <option value="2023" selected>2023</option>            
                                    <option value="2022">2022</option>
                                  </select>
                                  <select name="month" class="custom-select ml-1" id="inputGroupSelect02">
                                    <option hidden>Choose...</option>
                                    @for($i=0; $i<12; $i++)
                                      <option value="{{$i+1}}" @if(date('m')==($i+1)) selected @endif>{{$month[$i]}}</option>
                                    @endfor
                                  </select>
                                  <button type="button" class="btn btn-success ml-1 online-search" for="inputGroupSelect02">Search</button>
                                  <button type="button" class="btn btn-success ml-2 online-print"><i class="fas fa-print"></i></button>
                                </div>                        
                              </form>
                              <button class="btn btn-outline-defaut"></button>
                            </div>
                          </div>
                        </div>
                      </div>     
                      @php($ym=date('Y-m'))
                      <div class="table-responsive table-industry bg-white d-none">
                        <table class="table table-bordered thead-sticky"> 
                          <thead>
                            <tr><th rowspan="2" style="text-align:center; vertical-align:middle;">Industry</th><th class="online-title" colspan="32" style="text-align:center; background-color: #ced2d8;">{{date('F Y')}}</th></tr>
                            <tr class="dayOfMonth">
                              @for($h=1; $h<=31; $h++)
                              <th class="text-center" style="font-weight:500; text-align:conter; border-left:1px solid #dedede; -webkit-print-color-adjust:exact !important;">@if($h<=$lastday){{$h}}@endif</th>
                              @endfor
                              <th>Sum</th>
                            </tr>
                          </thead>
                          @php($industry=\App\Models\IndustryMd::select('id','name_jp','key')->where('status',1)->whereNull('coming_soon')->get())
                          <tbody>
                              @foreach($industry as $key => $row)
                              <tr class="row-industry" key="{{$row->key}}" id="row{{$key+1}}">
                                  <td>{{$row->name_jp}}</td>
                                  @for($j=1; $j<=31; $j++)
                                      <td class="online-number text-center" style="-webkit-print-color-adjust:exact !important; color: rgb(214, 214, 214);">0</td>                            
                                  @endfor
                                  <td class="sum text-center"></td>
                              </tr>
                              @endforeach
                              <tr class="row-sum">
                                  <td style="text-align:right;"><strong>Sum</strong></td>
                                  @for($k=1;$k<=31;$k++)
                                  <td class="sum-bottom text-center" style="color: rgb(214, 214, 214);">0</td>
                                  @endfor
                                  <td class="sum-bottom text-center" style="font-weight:bold; text-decoration:underline;"></td>
                              </tr>
                              <tr class="text-primary">
                                  <td style="text-align:right;"><strong>Designed</strong></td>
                                  @for($k=1; $k<=31; $k++)
                                      @php($d = ($k<10)?"0$k":"$k")
                                      <td class="sum-design text-center" style="border-top:2px;">0</td>
                                  @endfor
                                  <td class="sum-design text-center" style="font-weight:bold; text-decoration:underline;"></td>
                              </tr>
                          </tbody>
                          <tfoot></tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                  
                  {{-- <div class="row online-section" id="onlineTable">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                          @php($m=date('m'))
                          @php($lastYear=date('Y'))
                          <form action="" class="form-inline mb-4">                        
                            <div class="form-group">
                              <select name="year" class="custom-select">
                                <option value="">Year</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>                   
                              </select>
                              <select name="month" class="custom-select ml-1" id="inputGroupSelect02">
                                <option hidden>Choose...</option>
                                @for($i=0; $i<12; $i++)
                                  <option value="{{$i+1}}" @if(date('m')==($i+1)) selected @endif>{{$month[$i]}}</option>
                                @endfor
                              </select>
                              <button type="button" class="btn btn-outline-success ml-1 online-search" for="inputGroupSelect02">Search</button>
                              <button type="button" class="btn btn-outline-success ml-2 online-print"><i class="fas fa-print"></i></button>
                            </div>                        
                          </form>
                          <button class="btn btn-outline-defaut"></button>
                        </div>
                      </div>     
                      @php($ym=date('Y-m'))
                      <div class="table-responsive table-industry">
                        <table class="table table-bordered thead-sticky"> 
                          <thead>
                            <tr><th rowspan="2" style="text-align:center; vertical-align:middle;">Industry</th><th class="online-title" colspan="32" style="text-align:center; background-color: #ced2d8;">{{date('F Y')}}</th></tr>
                            <tr class="dayOfMonth">
                              @for($h=1; $h<=31; $h++)
                              @php($day=date('D',strtotime($ym.'-'.sprintf("%02d",$h))))
                              <th class="text-center" style="font-weight:500; text-align:conter;@if($day=='Sun' || $day=='Sat')background-color:rgb(243,243,243);@endif -webkit-print-color-adjust:exact !important;">@if($h<=$lastday){{$h}}@endif</th>
                              @endfor
                              <th>Sum</th>
                            </tr>
                          </thead>
                          @php($data=\App\Models\IndustryMd::select('id','name_jp','key')->where('status',1)->whereNull('coming_soon')->get())
                          <tbody>
                            @foreach($data as $key => $row)
                            <tr class="row-industry" key="{{$row->key}}" id="row{{$key+1}}">
                              <td>{{$row->name_jp}}</td>
                              @for($j=1; $j<=31; $j++)
                              @php($day=date('D',strtotime($ym.'-'.sprintf("%02d",$j))))                            
                              @php($count=\App\Models\CompanyMd::where('industry',$row->id)->where(db::raw('DATE(published_on)'),'like',date('Y-m-d',strtotime($ym.'-'.sprintf("%02d",$j))))->count())                            
                              <td class="online-number text-center" style="@if($day=='Sun' || $day=='Sat')background-color:rgb(243,243,243);@endif @if($count==0)color:rgb(214,214,214);@endif -webkit-print-color-adjust:exact !important;">
                                @if($j<=$lastday){{$count}}@endif
                              </td>                            
                              @endfor
                              <td class="sum text-center"></td>
                            </tr>
                            @endforeach
                            <tr class="row-sum">
                              <td style="text-align:right;"><strong>Sum</strong></td>
                              @for($k=1;$k<=31;$k++)
                              <td class="sum-bottom text-center"></td>
                              @endfor
                              <td class="sum-bottom text-center" style="font-weight:bold; text-decoration:underline;"></td>
                            </tr>
                            <tr class="text-primary">
                              <td style="text-align:right;"><strong>Designed</strong></td>
                              @for($k=1; $k<=31; $k++)
                              @php($d = ($k<10)?"0$k":"$k")
                              <td class="sum-design text-center" style="border-top:2px;">{{\App\Models\JobProgressMd::where('step3',1)->where(DB::raw('(DATE_FORMAT(step3_on,"%Y-%m-%d"))'),date("Y-m-$d"))->count()}}</td>
                              @endfor
                              <td class="sum-design text-center" style="font-weight:bold; text-decoration:underline;"></td>
                            </tr>
                          </tbody>
                          <tfoot></tfoot>
                        </table>
                      </div>
                    </div>
                  </div> --}}
{{-- 
                </div> 
              </div> --}}

            </div>
            
            
        </div>
                    {{--
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    Email History
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <div class="table-responsive">
                                                <table class="table table-striped no-footer table-res" id="sort_table" role="grid" style="border-collapse: collapse !important">
                                                    <thead>
                                                        <tr role="">
                                                            <th width="5%">#</th>
                                                            <th width="15%">To</th>
                                                            <th width="10%">Name</th>
                                                            <th width="40%">Messages</th>
                                                            <th width="10%">Email,Telephone</th>                                                            
                                                            <th width="10%">Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($history_mail))
                                                            @foreach($history_mail as $key => $mail)
                                                                <tr role="row" class="odd">
                                                                    <td data-label="No."><span class="no">{{$key+1}}</span> <i class="fas fa-bars handle d-none"></i></td>
                                                                    <td data-label="Sender, Company">
                                                                        {{$mail->to}},<br>
                                                                        {{$mail->company}}
                                                                    </td>
                                                                    <td data-label="Sender name">{{$mail->name}}</td>
                                                                    <td data-label="Message">{{$mail->content}}</td>
                                                                    <td data-label="Receiver, Company">{{$mail->email}}, {{$mail->telephone}}</td>
                                                                    <td data-label="Created :">{{date('d-m-Y H:i:s',strtotime($mail->created))}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">{{$history_mail->links()}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}

                    

    </div></div>
{{-- <script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script> --}}
<script src="back-end/build/loading-overlay.js"></script>
<script>
  var loaded = {};

  const setSummaryHeight = () => 
  {
      summaryItem = document.querySelector('.summary-industry');
      const items = document.querySelectorAll('.industry-item');
      const last = items.length - 1;
      cal = Math.floor(items.length / 12);
      if(cal <= 3){ 
        summaryItem.classList.add('col-lg-6')
        summaryItem.querySelector('.bg-success').style.height = (items[last].clientHeight+12)+'px';
      }
  }
  
  onlineMore = (el) => {

      icon = {
        minimize:"fa-compress-alt", maximize: 'fa-expand-alt'
      };
      el.find('i').toggleClass(icon.maximize+' '+icon.minimize);
      onlineSection = $('.online-section');    
      onlineSection.toggleClass('d-none d-block');
      table = onlineSection.find('table');

  }
  $(document).on('click','.online-more',function(){ onlineMore($(this)); });
  function printDiv(divName,css) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      head = document.head || document.getElementsByTagName('head')[0],
      style = document.createElement('style');
      head.appendChild(style);
      style.type = 'text/css';
      if (style.styleSheet) style.styleSheet.cssText = css; /* This is required for IE8 and below.*/ 
      else style.appendChild(document.createTextNode(css));
      
      document.body.innerHTML = printContents;
      window.print();   
      document.body.innerHTML = originalContents;
  }

  $(document).on('click','.online-search',function(){
    $('.loading-overlay').fadeIn(300);
    setTimeout(() => {
        let m = $('select[name="month"]').val();
        let y = $('select[name="year"]').val();
        let my = m+'-'+y;
        let title = my;
        
        loaded.first = getOnlineOfMonth(my);
        loaded.designed = getDesignedOfMonth(my);
    
        fetchData(loaded.first,title,my);
        fetchDesigned(loaded.designed );
        
        if(Object.keys(loaded).length==2){
            $(".loading-overlay").fadeOut(300);
            loaded = {};
        }
        
      }, 500);
  })
  const getOnlineOfMonth = (my) => {
    let data = $.ajax({
      url: '/api/getOnlineOfMonth',
      method: 'get',
      async: false,
      data:{ my: my },
      success:(res)=>{
        
      }
    }).responseJSON;


    return data;
  }
  const getDesignedOfMonth = (my) => {
    let data = $.ajax({
      url: '/api/getDesignedOfMonth',
      method: 'get',
      async: false,
      data:{ my: my }
    }).responseJSON;

    return data;
  }
  const fetchData = (data,title,my) => {
  
    const industryOnce = $('.row-industry:first').attr('key');
    const currLength = $('.dayOfMonth').find('th:not(:last-child)').length;
    const newLength = data[industryOnce].length;
    const dayOfMonth = $('.dayOfMonth').find('th:not(:last-child)');

    my = my.split('-');
    y = my[1];
    m = my[0];

    const LastDayOfMonth = new Date(y, m , 0).getDate(); 
    $('.online-title').html(title);
    const holiday = (y,m,d) => {
        var theDate = new Date(y+'-'+m+'-'+d);
        var myNewDate = new Date(theDate);
        return (myNewDate.getDay()==0 || myNewDate.getDay()==6)? 'rgb(243,243,243)' : 'rgb(255,255,255)' ;
    }

    dayOfMonth.each(function(k,v){
        $(v).css('background-color',holiday(y,m,k+1));
        if(k>=newLength){ 
          $(v).html('');
        }else{
          $(v).html(k+1)
        }
    }); 
    $('.row-industry').each(function(){
        $(this).find('td:not(:last-child)').each(function(k,v){            
            if(k>0 && k>LastDayOfMonth){  
              $(v).html(''); 
            }
            if(k>0){
              $(v).css('background-color',holiday(y,m,k));
            }
        })
    });
    $('.online-section').find('tbody tr:last-child').find('td:not(:last-child)').each(function(k,v){ 
        if (k>0 && k>LastDayOfMonth) { 
          $(v).css('background-color',holiday(y,m,k+1));
          $(v).html(''); 
        }
    })

    const newCalculateTheSum = () => {
        $('.row-industry').each(function(key,value){
            let number  = [];
            $(value).find('.online-number').each(function(){
                n = ( $(this).html()== ' ' )?0:parseInt($(this).html());
                if(!isNaN(n)) number.push(n);
            });
            sum = 0;
            sum = number.reduce(function(a, b) { return a + b; }, 0)
            last = $(value).find('td:last');
            last.css('color','rgb(0,0,0)');
            last.html(sum);  
        });
        $('.sum-bottom').each(function(i,v){
            $(this).html(0);
            number2 = [];
            $('.row-industry').each(function(){
                n = ( $(this).find('td').eq(i+1).html()== ' ' )?0:parseInt($(this).find('td').eq(i+1).html());
                if(!isNaN(n)) number2.push(n);
            });
 
            sum2 = number2.reduce(function(a, b) { return a + b; }, 0)
            if(sum2>0) $(v).css({'color':'rgb(0,0,0)'}); else $(v).css({color:'rgb(214, 214, 214)'});
            if(sum2!=' ') $(v).css({'color':'rgb(0,0,0)'}).html(sum2);
        })
    }
    

    $('.row-industry').each(function(key,value){
        industry = $(value).attr('key');
        $(value).find('td').each(function(k,v){
          if(k>0){
            td = $(v);
            if(data[industry][k-1]>0){
              color = 'rgb(0,0,0)';
            }else{
              color = 'rgb(214,214,214)';
            }
            td.css('color',color);
            td.html(data[industry][k-1]);
          }
        })      
    })
    newCalculateTheSum();

}

const fetchDesigned = (data) => {
  $('.sum-design:not(:last-child)').each(function(k,e){ $(e).html(data[k]) });
  let sum = data.reduce((a, b) => a + b, 0);
  $('.sum-design:last-child').html(sum);
}

$.each($('.row-sum').find('td'),function(k,e){
  $(e).css('border-bottom','3px solid #d8dbe0');
})
let sumDesign = 0;
$.each($('.sum-design').not(':last-child'),function(k,e){
  sumDesign = sumDesign + Number($(e).html());
})
$('.sum-design:last-child').html(sumDesign);

const onlineTable = $('#onlineTable');
const onlineForm = $('form.form-inline');

const onlineTableOffset = $('#onlineTable').offset();
const onlineTableSection = document.getElementById('onlineTable');

onlineTable.on('click','.btn-primary',function(){
  cur = $(this);
  cur.toggleClass('show');
  cur.find('.fas').toggleClass('fa-caret-right fa-caret-down');
  onlineTable.find('.table-industry').toggleClass('d-none');
  onlineForm.toggleClass('d-none');
  if (cur.hasClass('show')) {
      window.scroll({
        top: onlineTableOffset.top - 42,
        behavior: 'smooth'
      });
  }

})
industryItem = document.querySelector('.industry-item');
console.log(industryItem);
const itemWidth = industryItem.offsetWidth;
console.log(itemWidth)
if(itemWidth<=220){
  const items = document.querySelectorAll('.industry-item');
  // setSummaryHeight()
  for(i in items)
  {
   const left = items[i].querySelector('.col-left');
   const right = items[i].querySelector('.col-right');
   left.classList.add('col-lg-12');
   right.classList.add('col-lg-12');
  }
  
}

</script>
<script src="back-end/build/profile-activity.js"></script>
<script src="back-end/build/blog-activity.js?v=01"></script>