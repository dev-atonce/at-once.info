<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

    <title>Web Panel</title>

    <base href="{{url('/')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <link rel="stylesheet" href="back-end/fontawesome-5.15.4/css/all.css">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <link href="back-end/css/style.css" rel="stylesheet">
    {{-- <link href="back-end/bootstrap-4.3.1/css/bootstrap.css" rel="stylesheet"> --}}
    <link href="back-end/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    @if(@$css)
    @foreach($css as $css)
    <link href="{{$css}}" rel="stylesheet">
    @endforeach
    @endif
    @if(@$js)
    @foreach($js as $js)
    <script src="{{$js}}"></script>
    @endforeach
    @endif
    <style>
        .text-roange{

        }
        .custom-control-input:checked~.custom-control-label.switch-success::before {
            border-color:#2eb85c !important;
            background-color:#2eb85c !important;
        }
        .custom-control-input:checked~.switch-success{
            color:#2eb85c !important;
        }
        .form-control.input-invalid{
            border-color: #e55353;
        }
        .form-control.input-invalid:focus {
            border-color: #e55353;
            box-shadow: 0 0 0 0.2rem rgba(229, 83, 83, .25);
        }
        .form-control.input-valid{
            border-color: #2eb85c;
        }
        .form-control.input-warning{
            border-color: #f9b115;
        }
        .fs-12-px{
            font-size: 12px;
        }
        .fs-16-px{
            font-size: 16px;
        }
        .page-next,
        .page-prev{
            text-decoration: none;
        }
        .input-group.input-invalid .input-group-text{
            border-color: #e55353 !important;
            color: #e55353 !important;
        }
        .custom-control.input-invalid{
            color:#e55353;
        }
    </style>
</head>

<body class="c-app flex-row">
    <script>
        let c = localStorage.getItem("theme"),
            tag = document.getElementsByTagName('body').item(0);
        if (c != '' && c != null) tag.classList.add(c);
    </script>
    <div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        @include('back-end.layout.left-menu')
    </div>
    <div class="c-wrapper">
        @include('back-end.layout.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    @php
                        $take = 100;
                        $skip = Request::get('skip') ? Request::get('skip') : 0;

                        $category = Request::get('category');
                        $check = Request::get('check');
                        $public = Request::get('public');
                        $offline = Request::get('offline');
                        $detail = Request::get('detail');
                        $design = Request::get('design');
                        $query = \App\Models\CompanyMd::leftJoin('category','company.category','=','category.id')
                        ->select([
                            'company.id',
                            'company.website',
                            'company.created',
                            'company.created_by',
                            'company.name_th',
                            'company.name_en',
                            'company.name_jp',
                            'company.checked',
                            'company.public',
                            'company.more_th',
                            'job_progress.step3',
                            'category.name_jp as categoryName'
                        ])
                        ->leftJoin('job_progress','company.id','job_progress.company')
                        ->when(Request::get('category'),function($query)use($category){
                            return $query->where('company.category',$category);
                        })
                        ->when(Request::get('check'),function($query)use($check){
                            if($check == 'true') {
                                return $query->where('company.checked','checked');
                            }else{
                                return $query->whereNull('company.checked');
                            }
                        })
                        ->when(Request::get('public'),function($query)use($public){
                            $query->where('public',1);
                        })
                        ->when(Request::get('offline'),function($query)use($offline){
                            $query->where('public',0);
                        })
                        ->when(Request::get('detail'),function($query)use($detail){
                            $query->where(function($query){
                                $query->whereNotNull('company.more_th')->where('company.type','full');
                            });
                        })
                        ->when(Request::get('design'),function($query)use($design){
                            $query->whereNotNull('job_progress.step3')->where('company.type','full');
                        })
                        ->when(Request::get('nodetail'),function($query)use($detail){
                            $query->where(function($query){
                                $query->whereNull('company.more_th')->where('company.type','full');
                            });
                        })
                        ->when(Request::get('nodesign'),function($query)use($design){
                            $query->whereNull('job_progress.step3')->where('company.type','full');
                        })
                        ->whereNotIn('company.id',[64]);
                        // ->whereNotNull('company.website');

                        $allPage = $query->count();
                        echo  $allPage;
                        $allPage = ceil(($allPage / $take));

                        $data = $query->skip($skip)
                            ->take($take)
                            ->get();

                        // ==============================================================
                        $checkedCount=\App\Models\CompanyMd::
                        when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->whereNotIn('company.id',[64])
                        ->whereNotNull('checked')
                        ->count();
                        // ==============================================================
                        $uncheckedCount=\App\Models\CompanyMd::
                        when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->whereNotIn('company.id',[64])
                        ->whereNull('checked')
                        ->count();

                        // ==============================================================
                        $onlineCount=\App\Models\CompanyMd::when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->when(Request::get('check'),function($query)use($check){
                            if($check == 'true') {
                                return $query->where('company.checked','checked');
                            }else{
                                return $query->whereNull('company.checked');
                            }
                        })
                        ->whereNotIn('company.id',[64])
                        // ->whereNotNull('company.website')
                        ->where('public',1)
                        ->count();
                         // ==============================================================
                        $offlineCount=\App\Models\CompanyMd::when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->when(Request::get('check'),function($query)use($check){
                            if($check == 'true') {
                                return $query->where('company.checked','checked');
                            }else{
                                return $query->whereNull('company.checked');
                            }
                        })
                        ->whereNotIn('company.id',[64])
                        // ->whereNotNull('company.website')
                        ->where('public',0)
                        ->count();
                        $trashed = \App\Models\CompanyMd::onlyTrashed()->where('category',$category)
                        ->when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })->count();
                        $details = \App\Models\CompanyMd::where(function($query){
                            $query->whereNotNull('company.more_th');
                        })
                        ->where('company.type','full')
                        ->when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->count();
                        $designs = \App\Models\CompanyMd::where('job_progress.step3',1)
                        ->where('company.type','full')
                        ->when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->leftJoin('job_progress','company.id','job_progress.company')
                        ->count();
                        $Nodetails = \App\Models\CompanyMd::where(function($query){
                        $query->whereNull('company.more_th')
                            ->where('company.type','full');
                        })
                        ->when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->count();
                        $Nodesigns = \App\Models\CompanyMd::whereNull('job_progress.step3')
                        ->leftJoin('job_progress','company.id','job_progress.company')
                        ->where('company.type','full')
                        ->when(Request::get('category'),function($query)use($category){
                            $query->where('category',$category);
                        })
                        ->count();
                    @endphp
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="get" class="form-inline">
                                        <select class="form-control" name="category">
                                            <option value="">Category</option>
                                            @foreach(\App\Models\CategoryMd::where('status',1)->get() as $k => $v)
                                                <option value="{{$v->id}}" @if(Request::get('category')==$v->id) selected=""@endif>{{$v->name_jp}} / {{$v->name_th}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="public" class="custom-control-input" id="cp_public" value="1" @if(Request::get('public')==1) checked=""@endif>
                                            <label for="cp_public" class="custom-control-label ml-2">Online <span class="text-success ml-1">{{number_format($onlineCount)}}</label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="offline" class="custom-control-input" id="cp_offline" value="1" @if(Request::get('offline')==1) checked=""@endif>
                                            <label for="cp_offline" class="custom-control-label ml-2">Offline <span class="text-warning ml-1">{{number_format($offlineCount)}}</label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="detail" class="custom-control-input" id="cp_detail" value="1" @if(Request::get('detail')==1) checked=""@endif>
                                            <label for="cp_detail" class="custom-control-label ml-2">Detail <span class="text-success ml-1">{{number_format($details)}}</label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="design" class="custom-control-input" id="cp_design" value="1" @if(Request::get('design')==1) checked=""@endif>
                                            <label for="cp_design" class="custom-control-label ml-2">Design <span class="text-success ml-1">{{number_format($designs)}}</label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="nodetail" class="custom-control-input" id="cp_nodetail" value="1" @if(Request::get('nodetail')==1) checked=""@endif>
                                            <label for="cp_nodetail" class="custom-control-label ml-2">No Detail <span class="text-danger ml-1">{{number_format($Nodetails)}}</label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="nodesign" class="custom-control-input" id="cp_nodesign" value="1" @if(Request::get('nodesign')==1) checked=""@endif>
                                            <label for="cp_nodesign" class="custom-control-label ml-2">No Design <span class="text-danger ml-1">{{number_format($Nodesigns)}}</label>
                                        </label>
                                        <label class="form-control ml-1">
                                            <label class="text-danger">Trashed <span class="ml-1">{{number_format($trashed)}}</label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="check" class="custom-control-input" id="checked" value="true" @if(Request::get('check')=='true') checked=""@endif>
                                            <label class="custom-control-label ml-2" for="checked">Checked <span class="text-success ml-1">{{number_format($checkedCount)}}</span></label>
                                        </label>
                                        <label class="form-control custom-control custom-checkbox ml-1">
                                            <input type="checkbox" name="check" class="custom-control-input" id="unchecked" value="false" @if(Request::get('check')=='false') checked="" @endif>
                                            <label class="custom-control-label ml-2" for="unchecked">Unchecked <span class="text-warning ml-1">{{number_format($uncheckedCount)}}</span></label>
                                        </label>
                                        <button type="submit" class="btn btn-primary ml-1"><i class="fas fa-search mr-1"></i> Search</button>
                                    </form>
                                    <div class="form-inline d-flex justify-content-center">
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">
                                                    <a class="prev-page" href="javascript:">&lt; Prev</a>
                                                </label>
                                            </div>
                                            <select class="custom-select text-center paginate" all-page="{{$allPage}}">
                                                @for($i=0; $i<$allPage; $i++)
                                                    @php($val=($i==0)?0:$i*$take)
                                                    <option value="{{$val}}" @if(Request::get('skip')==$val) selected @endif>{{$i+1}}</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="inputGroupSelect01">
                                                    <a class="next-page" href="javascript:">Next &gt;</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->name=='TUM' || Auth::user()->name=='RYO' || Auth::user()->name=='HOCKY' || Auth::user()->name=='BANK')
                        <div class="row" >
                            @foreach($data as $k => $v)
                            @php($countname = \App\Models\CompanyMd::leftJoin("category","company.category","=","category.id")
                                ->leftJoin("members as mem", "company._id" ,"=" ,"mem.id")
                                ->select("company.name_th",'company.name_en',"company.name_jp","company.id","category.name_jp as categoryName","mem.id as membersId",'company.website','company.public','company.category')
                                ->where("company.name_jp",$v->name_jp)
                                ->whereNotNull("company.name_jp")
                                ->when(Request::get('category'),function($query)use($category){
                                    $query->where('company.category',$category);
                                })
                                ->where('company.id','!=',$v->id)
                                ->get()
                            )
                            <div class="col-lg-6 col-xs-12 col-md-12" data-id="{{$v->id}}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="position-relative">
                                            <div class="mb-2 form-inline">
                                                <div class="form-control mb-0">
                                                    <strong>{{$k+1}}. {{$v->categoryName}}</strong>
                                                </div>
                                                @php($text=($v->checked=='checked')?'Checked':'Unchecked')
                                                @php($status=($v->public == 1)?'Online':'Offline')
                                                @php($statusDT=($v->more_th != ''|| $v->more_jp != '')?'Detail':'No Detail')
                                                @php($statusDS=($v->step3 == 1)?'Design':'No Design')

                                                @php($statusIcon=($v->public == 1)?'fa-check-circle':'fa-times-circle')
                                                @php($statusClass=($v->public == 1)?'success':'secondary')

                                                @php($statusDetail=($v->more_th != ''|| $v->more_jp != '') ? 'success' : 'secondary')
                                                @php($statusDetailIcon=($v->more_th != ''|| $v->more_jp != '') ? 'fa-check-circle':'fa-times-circle')
                                                @php($statusDesign=($v->step3 == 1) ? 'success' : 'secondary')
                                                @php($statusDesignIcon=($v->step3 == 1) ? 'fa-check-circle':'fa-times-circle')

                                                @php($checkedClass=($v->checked=='checked')?'input-valid':'input-warning')
                                                <div class="form-control status-label @if($v->public == 1)input-valid @endif ml-1 mb-0" title="Publishing status">
                                                    <strong class="text-{{$statusClass}}">
                                                        <i class="fas {{$statusIcon}}"></i>
                                                        <span class="ml-1">{{$status}}</span>
                                                    </strong>
                                                </div>
                                                <div class="form-control detail-label @if($v->more_th != ''|| $v->more_jp != '')input-valid @endif ml-1 mb-0" title="Publishing status">
                                                    <strong class="text-{{$statusDetail}}">
                                                        <i class="fas {{$statusDetailIcon}}"></i>
                                                        <span class="ml-1">{{$statusDT}}</span>
                                                    </strong>
                                                </div>
                                                <div class="form-control design-label @if($v->step3 == 1)input-valid @endif ml-1 mb-0" title="Publishing status">
                                                    <strong class="text-{{$statusDesign}}">
                                                        <i class="fas {{$statusDesignIcon}}"></i>
                                                        <span class="ml-1">{{$statusDS}}</span>
                                                    </strong>
                                                </div>
                                                <div class="form-control check-label {{$checkedClass}} ml-1" title="Currect data">
                                                    <strong class="@if($v->checked=='checked')text-success @else text-warning @endif">
                                                        <i class="@if($v->checked=='checked')fas fa-check-circle @else far fa-circle @endif"></i>
                                                        <span class="ml-1">{{$text}}</span>
                                                    </strong>
                                                </div>
                                                @if($countname->count() > 0 )<a href="javascript:" class="ml-1 badge badge-primary Modalindustry" data-category="{{$countname->toJson()}}">{{$countname->count()}}</a>  @endif
                                                <button
                                                    class="btn btn-outline-danger trashed"
                                                    href="javascript:"
                                                    data-id="{{$v->id}}"
                                                    style="position:absolute;right:0;"
                                                    title="Move to trash"
                                                ><i class="fas fa-trash m-1"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend"><span class="input-group-text">URL</span></div>
                                                    <input tye="text" class="form-control @if($v->checked)is-valid @endif" placeholder="URL" name="website" value="{{$v->website}}">
                                                    <div class="input-group-append">
                                                        <a href="{!!$v->website!!}" target="_blank" class="input-group-text text-primary" style="text-decoration: none;">
                                                            <i class="fas fa-globe-asia fa-lg ml-1"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-sm mt-1">
                                                    <div class="input-group-prepend"><span class="input-group-text">Name (TH)</span></div>
                                                    <input tye="text" class="form-control @if($v->checked == 'checked')is-valid @endif" name="name_th" value="{{$v->name_th}}">
                                                </div>
                                                <div class="input-group input-group-sm mt-1">
                                                    <div class="input-group-prepend"><span class="input-group-text">Name (EN)</span></div>
                                                    <input tye="text" class="form-control @if($v->checked == 'checked')is-valid @endif" name="name_en" @if($v->name_en!='')value="{{$v->name_en}}"@else value="{{$v->name_jp}}"@endif>
                                                </div>
                                                <div class="input-group input-group-sm mt-1">
                                                    <div class="input-group-prepend"><span class="input-group-text">Reason</span></div>
                                                    <input tye="text" class="form-control" name="reason">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-2">
                                                <button class="btn btn-outline-primary ml-1 float-right -save-change" data-company-id="{{$v->id}}">Save &amp; Change</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card">
                            <div class="car-body">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12">
                                        <p class="text-center mb-0">Page loding({{ round(microtime(true) - LARAVEL_START,2) }}s)</p>
                                        <div class="form-inline d-flex justify-content-center">
                                            <div class="input-group my-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">
                                                        <a class="prev-page" href="javascript:">&lt; Prev</a>
                                                    </label>
                                                </div>
                                                <select class="custom-select text-center paginate" all-page="{{$allPage}}">
                                                    @for($i=0; $i<$allPage; $i++)
                                                        @php($val=($i==0)?0:$i*$take)
                                                        <option value="{{$val}}" @if(Request::get('skip')==$val) selected @endif>{{$i+1}}</option>
                                                    @endfor
                                                </select>
                                                <div class="input-group-append">
                                                    <label class="input-group-text" for="inputGroupSelect01">
                                                        <a class="next-page" href="javascript:">Next &gt;</a>
                                                    </label>
                                                </div>
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
        <footer class="c-footer">
            <div><a href="https://coreui.io">CoreUI</a> © 2019 creativeLabs.</div>
            <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
        </footer>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit">
                        <ul class="list-group">
                            <label class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input log-of-modi" id="allCorrect" value="All Currect">
                                    <label class="custom-control-label" for="allCorrect">All Correct</label>
                                </div>
                            </label>
                            <label class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input log-of-modi" id="editUrl" value="Edit URL">
                                    <label class="custom-control-label" for="editUrl">Edit URL</label>
                                </div>
                            </label>
                            <label class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input log-of-modi" id="editNameTH" value="Edit Name TH">
                                    <label class="custom-control-label" for="editNameTH">Edit Name TH</label>
                                </div>
                            </label>
                            <label class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input log-of-modi" id="editNameEN" value="Edit Name EN">
                                    <label class="custom-control-label" for="editNameEN">Edit Name EN</label>
                                </div>
                            </label>
                            <label class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input log-of-modi" id="UrlClose" value="URL Close">
                                    <label class="custom-control-label" for="UrlClose">URL Close</label>
                                </div>
                            </label>
                        </ul>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary save-change">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="moreEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script src="back-end/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="back-end/sweetalert2/sweetalert2.all.js"></script>
<script src="back-end/vendors/pace-progress/js/pace.min.js"></script>
<script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script>
<script>
    var tooltipEl = document.getElementById('header-tooltip');
    var tootltip = new coreui.Tooltip(tooltipEl);
</script>

<script src="js/axios.min.js"></script>
<script>
    $(document).on('click','button.-save-change',function(){
        const Modal = $('#exampleModal');
        const cur = $(this);

        thisCard = cur.closest('.card');
        companyId = cur.attr('data-company-id');
        id = cur.attr('data-id');
        Modal.find('input[type="checkbox"]').prop('checked',false);
        btnSave = Modal.find('button.save-change');
        btnSave.attr('data-id',companyId);
        btnSave.attr('website',thisCard.find('input[name="website"]').val());
        btnSave.attr('name_th',thisCard.find('input[name="name_th"]').val());
        btnSave.attr('name_en',thisCard.find('input[name="name_en"]').val());
        Modal.modal('show');
    })
    $(document).on('click','button.save-change',function(){

        let action = [];
        cur = $(this);
        Modal = $('#exampleModal');
        companyId = cur.attr('data-id');
        thisCard = $(`[data-company-id="${companyId}"]`).closest('.card');

        website = cur.attr('website');
        name_th = cur.attr('name_th');
        name_en = cur.attr('name_en');

        if($('#allCorrect').is(':checked')) action.push($('#allCorrect').val())
        if($('#editUrl').is(':checked')) action.push($('#editUrl').val())
        if($('#editNameTH').is(':checked')) action.push($('#editNameTH').val())
        if($('#editNameEN').is(':checked')) action.push($('#editNameEN').val())
        if($('#UrlClose').is(':checked')) action.push($('#UrlClose').val())

        if(action.length>0){
            let fd = new FormData();
            fd.append('_token','{{csrf_token()}}');
            fd.append('id',companyId);
            fd.append('website',website);
            fd.append('name_th',name_th);
            fd.append('name_en',name_en);
            fd.append('action',action);

            $.ajax({
                method:'post',
                url:'webpanel/http/checking/save',
                processData: false,
                contentType: false,
                data: fd,
                success:function(res){
                    if(res.statusCode == 200){
                        thisCard.find('input[name="website"]').addClass('is-valid');
                        thisCard.find('input[name="name_th"]').addClass('is-valid');
                        thisCard.find('input[name="name_en"]').addClass('is-valid');
                        thisCard.find('.btn-outline-primary').prop('disabled',true).toggleClass('btn-outline-primary btn-outline-secondary');
                        thisCard.find('.check-label').toggleClass('input-warning input-valid')
                            .find('strong').toggleClass('text-warning text-success')
                            .find('i').removeClass('far fa-circle').addClass('fas fa-check-circle').parent()
                            .find('span').html('Checked');
                        Modal.find('input[type="checkbox"]').prop('checked',false);
                        Modal.modal('hide');
                        setTimeout(() => {
                            Swal.fire({
                                icon: res.icon,
                                title: res.title,
                                text: res.text,
                            });
                        }, 300);
                    }else{
                        Swal.fire({
                            icon: res.icon,
                            title: res.title,
                            text: res.text,
                        });

                    }
                }
            }).catch(er => console.log(er))
        }

    });
    $(document).on('click','.trashed',function(){
        id = $(this).attr('data-id');
        thisCard = $(this).closest('.card');
        reason = thisCard.find('input[name="reason"]');
        if(reason.val() == ''){
            reason.addClass('input-invalid');
            reason.closest('.input-group').addClass('input-invalid');
        }else{
            reason.removeClass('input-invalid');
            reason.focus();
            reason.closest('.input-group').removeClass('input-invalid');
            Swal.fire({
                title: 'Confirm, Move to trash.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes',
                showLoaderOnConfirm: true,
                preConfirm: (res) => {
                    return fetch(`webpanel/http/checking/move-to-trash`,{
                        method: 'post',
                        headers: {
                            // 'Content-type': 'application/json; charset=UTF-8',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: JSON.stringify({
                            id:id,
                            msg: reason.val(),
                            '_token': '{{csrf_token()}}'
                        })
                    })
                    .then(response => {
                        if (!response.ok) { throw new Error(response.statusText) }
                        return response.json();
                    })
                    .catch(error => Swal.showValidationMessage(`Request failed: ${error}`) )
                }
            }).then((res)=>{
                console.log(res);
                if(res.value.statusCode == 200){ location.reload(); }
            })
        }

    })
    var thisUrl = 'webpanel/http/checking';
    var take = Number("{{$take}}");
    var allPage = Number($('.paginate').attr('all-page'));
    var currentPage = Number('{{Request::get("skip")}}');
    let action = '';

    function pagination()
    {

        $(document).on('change','.paginate',function(){
            skip = $(this).val()
            adjust(skip)
        })
        $(document).on('click','.prev-page',function(){
            action = 'prev';
            adjust();
        })

        $(document).on('click','.next-page',function(){
            action = 'next';
            adjust()
        })
        queryString = window.location.search;
        queryString = queryString.replace('?','');
        queryString = queryString.split('&');
        //======================================//
        objQuery = {'skip' : 0};
        b = [];
        for(i in queryString){
            a = queryString[i].split('=');
            objQuery[a[0]] = a[1];
        }
        //======================================//

        const adjust = (skip) => {

            $this = $('.paginate').find('option[selected]');

            if(action == 'next' && skip == null){
               next = $('.paginate').find('option[selected]').next();
               if(next.html() <= allPage)  skip = next.val();
            }
            if(action == 'prev' && skip == null){
                prev = $('.paginate').find('option[selected]').prev();
                if(prev.html() >= 1)  skip = prev.val();
            }
            skip = Number(skip);
            console.log(skip)
            //======================================//
            newQueryString = '';
            $.each(objQuery,function(k,v){
                if(v!=undefined){
                    newQueryString += (k=='skip') ? `&${k}=${skip}` : `&${k}=${v}` ;
                }
            })
            n = newQueryString.replace('&','?');
            window.location.href = `${thisUrl}${n}`
        }



    }
    pagination()
    $(document).on('click','a.Modalindustry',function(){
        Modal = $('#moreEdit');
        category = $(this).attr('data-category');
        category = JSON.parse(category);
        console.log(category);
        Modal.find('.modal-body').html('');
        for(i in category){
            mb = (i==0)?'mb-0':'mb-0 mt-3';
            Card = $(`<div class="card ${mb}"><div class="card-body"></div></div>`);
            name_en = (category[i].name_en != '')?category[i].name_en:category[i].name_jp;
            status = (category[i].public == 1)?'Online':'Offline';
            statusInput = (category[i].public == 1)?'input-valid':'';
            statusClass = (category[i].public == 1)?'text-success':'text-secondary';
            statusIcon = (category[i].public == 1)?'fas fa-check-circle':'fas fa-times-circle';
            checked = (category[i].checked =='checked')?'Checked':'Unchecked';
            checkedInput = (category[i].checked =='checked')?'input-valid':'input-warning';
            checkedClass = (category[i].checked =='checked')?'text-success':'text-warning';
            checkedIcon = (category[i].checked == 'checked')?'fas fa-check-circle':'far fa-circle';
            no = Number(i) + 1;
            item = $(`<div class="position-relative">\
                <div class="form-inline mb-2">\
                    <div class="form-control mb-0">
                        <strong>${no}. ${category[i].categoryName}</strong>\
                    </div>\
                    <div class="form-control status-label ml-1 mb-0 ${statusInput}" title="Public status">\
                        <strong class="${statusClass}"><i class="${statusIcon} mr-1"></i>${status}</strong>\
                    </div>\
                    <div class="form-control check-label ml-1 mb-0 ${checkedInput}" title="Currect data">\
                        <strong class="${checkedClass}"><i class="${checkedIcon} mr-1"></i><span>${checked}</span></strong>\
                    </div>\
                    <button class="btn btn-outline-danger trashed" href="javascript:" data-id="206" style="position:absolute;right:0;" title="Move to trash"><i class="fas fa-trash m-1"></i></button>
                </div>\
                <div class="row">\
                    <div class="col-lg-12">\
                        <div class="form-group mb-1">\
                            <div class="input-group input-group-sm">\
                                <div class="input-group-prepend"><span class="input-group-text">URL<span></div>\
                                <input type="text" class="form-control" name="website" value="${category[i].website}">\
                                <div class="input-group-append"><a href="${category[i].website}" class="text-primary input-group-text" style="text-decoration:none;" target="_blank"><i class="fas fa-globe-asia fa-lg ml-1"></i></a></div>\
                            </div>\
                        </div>\
                        <div class="form-group mb-1">\
                            <div class="input-group input-group-sm">\
                                <div class="input-group-prepend"><span class="input-group-text">Name (TH)<span></div>\
                                <input type="text" class="form-control" name="name_th" value="${category[i].name_th}">\
                            </div>\
                        </div>\
                        <div class="form-group mb-1">\
                            <div class="input-group input-group-sm">\
                                <div class="input-group-prepend"><span class="input-group-text">Name (EN)<span></div>\
                                <input type="text" class="form-control" name="name_en" value="${name_en}">\
                            </div>\
                        </div>\
                        <div class="form-group mb-1">\
                            <div class="input-group input-group-sm">\
                                <div class="input-group-prepend"><span class="input-group-text">Reason<span></div>\
                                <input type="text" class="form-control" name="reason">\
                            </div>\
                        </div>\
                    </div>\
                </div>\
                <div class="form-inline mt-3">\
                    <div class="custom-control custom-checkbox mr-3">\
                        <input type="checkbox" class="custom-control-input log-of-modi" id="all-currect" value="All Currect">\
                        <label class="custom-control-label" for="all-currect">All Correct</label>\
                    </div>\
                    <div class="custom-control custom-checkbox mr-3">\
                        <input type="checkbox" class="custom-control-input log-of-modi" id="edit-url" value="Edit URL">\
                        <label class="custom-control-label" for="edit-url">Edit URL</label>\
                    </div>\
                    <div class="custom-control custom-checkbox mr-3">\
                        <input type="checkbox" class="custom-control-input log-of-modi" id="edit-name-th" value="Edit Name EN">\
                        <label class="custom-control-label" for="edit-name-th">Edit Name EN</label>\
                    </div>\
                    <div class="custom-control custom-checkbox mr-3">
                        <input type="checkbox" class="custom-control-input log-of-modi" id="edit-name-en" value="Edit Name EN">
                        <label class="custom-control-label" for="edit-name-en">Edit Name EN</label>
                    </div>
                    <div class="custom-control custom-checkbox">\
                        <input type="checkbox" class="custom-control-input log-of-modi" id="url-close" value="URL Close">\
                        <label class="custom-control-label" for="url-close">URL Close</label>\
                    </div>\
                    <button class="btn btn-outline-primary ml-1" style="position:absolute;right:0;" data-id="${category[i].id}">Save &amp; Change</button>\
                </div>\
            </div>`);
            Card.find('.card-body').append(item);
            Modal.find('.modal-body').append(Card);
        }

        Modal.modal('show');
        Modal.find('button.btn-outline-primary').on('click',function(){
            thisCard = $(this).closest('.card');
            companyId = $(this).attr('data-id');

            if(Modal.find('.log-of-modi:checked').length>0)
            {
                Modal.find('.log-of-modi').parent().removeClass('input-invalid');
                action = [];
                website = thisCard.find('input[name="website"]').val();
                name_th = thisCard.find('input[name="name_th"]').val();
                name_en = thisCard.find('input[name="name_en"]').val();

                Modal.find('.log-of-modi:checked').map(function(k,v){
                    action.push($(v).val())
                })

                const fd = new FormData();
                fd.append('_token','{{csrf_token()}}');
                fd.append('id',companyId);
                fd.append('website',website);
                fd.append('name_th',name_th);
                fd.append('name_en',name_en);
                fd.append('action',action);
                $.ajax({
                    method:'post',
                    url:'webpanel/http/checking/save',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success:function(res){
                        if(res.statusCode == 200){
                            Modal.find('input[name="website"]').addClass('is-valid');
                            Modal.find('input[name="name_th"]').addClass('is-valid');
                            Modal.find('input[name="name_en"]').addClass('is-valid');
                            Modal.find('.btn-outline-primary').prop('disabled',true).toggleClass('btn-outline-primary btn-outline-secondary');
                            Modal.find('.check-label').toggleClass('input-warning input-valid')
                                .find('strong').toggleClass('text-warning text-success')
                                .find('i').removeClass('far fa-circle').addClass('fas fa-check-circle').parent().find('span').html('Checked');
                            Modal.find('.log-of-modi').prop('checked',false).prop('disabled',true);
                        }else{
                            Swal.fire({
                                icon: res.icon,
                                title: res.title,
                                text: res.text,
                            });

                        }
                    }
                }).catch(er => console.log(er))
            }else{
                Modal.find('.log-of-modi').parent().addClass('input-invalid');


            }

        })
    })

    const moreCompanyCategory = (name) => {
        const data = $.ajax({
            method: 'get',
            url: `webpanel/company/get-company/more-category?name=${name}`,
            cache: false,
            async: false
        }).responseJSON;
        console.log(data)
        return data;
    }
</script>
