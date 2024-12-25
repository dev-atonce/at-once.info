<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

    <title>Web Panel - Job Progress</title>

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
        .pagination {
            justify-content: center;
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
    @php
        $data=\App\Models\CompanyMd::leftJoin('category','company.category','=','category.id')->where('type','full')->select(['company.id','company.type','company.detail_th','company.detail_en','company.detail_jp','company.detail_jp','company.name_th','company.name_jp','company.name_en','company.name_zh','company.more_th','company.more_en','company.more_jp','company.more_zh','category.name_jp as categoryName'])->paginate(100);
    @endphp
    <div class="c-wrapper">
        @include('back-end.layout.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @php( $item = $data->firstItem())
                                    @foreach($data as $k => $v)
                                    @php($saveClass=($v->more_th=='')?'btn-danger':'btn-outline-dark')
                                    @php($saveClass=($v->detail_th!='')?'btn-success':$saveClass)
                                    @php($disabledBtn=($v->detail_th!='') ? 'disabled':'')
                                    @php($textBtn=($v->more_th=='')?'No detail':'Save')
                           
                                    <div class="row" data-id="{{$v->id}}">
                                        <div class="col-lg-12">                             
                                            <div class="input-group input-group-sm mb-3 form-inline">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn {{$saveClass}}" {{$disabledBtn}} data-id="{{$v->id}}" data-detail-th='{{$v->detail_th}}' data-more-th='{{$v->more_th}}' data-more-en="{{$v->more_en}}" data-more-jp="{{$v->more_jp}}" data-detail-ch="{{$v->more_zh}}">{{number_format($item+$k)}}. @if($v->detail_th!='')Saved @else {{$textBtn}} @endif</button>
                                                </div>
                                                <input tye="text" class="form-control @if($v->detail_th !='')is-valid @endif" name="name" value="{{$v->name_th}} - [{{$v->categoryName}}]">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="row"><div class="col-lg-12">{{$data->links()}}</div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <footer class="c-footer">
            <div><a href="https://coreui.io">CoreUI</a> © 2019 creativeLabs.</div>
            <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
        </footer>
    </div>
</body>
</html>
<script src="back-end/vendors/pace-progress/js/pace.min.js"></script>
<script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script>
<script>
    var tooltipEl = document.getElementById('header-tooltip');
    var tootltip = new coreui.Tooltip(tooltipEl);
</script>
<script src="back-end/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="back-end/sweetalert2/sweetalert2.all.js"></script>
<script src="js/axios.min.js"></script>
<script>
    $(document).on('click','.btn-outline-dark',function(){

        cur = $(this);
        id = cur.attr('data-id');
        detail_th = $(cur.attr('data-more-th')).text();
        detail_en = $(cur.attr('data-more-en')).text();
        detail_jp = $(cur.attr('data-more-jp')).text();
        detail_zh = $(cur.attr('data-more-ch')).text();

        axios.post(`/webpanel/detail/generate/save-or-edit`,
        {
            id: id,
            detail_th: detail_th,
            detail_en: detail_en,
            detail_jp: detail_jp,
            detail_zh: detail_zh,
            'csrf_token': '{{csrf_token()}}'
        })
        .then((res) => {
            if(res.data.status === true){
                cur.closest('.row').find('input[name="name"]').addClass('is-valid');
                text = cur.closest('.row').find('.btn-outline-dark').text();
                cur.closest('.row').find('.btn-outline-dark').toggleClass('btn-outline-dark btn-success').prop('disabled',true).html(text.trim()+'d');
            }
            Swal.fire({
                icon: res.data.icon,
                title: res.data.text,
                toast: true,
                timer: 2000,
                position:'top',
                showConfirmButton: false,
                timerProgressBar: true
            });
        })
        .catch(error => console.error());

    })
</script>