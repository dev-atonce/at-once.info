<!doctype html>
<html lang="{{Session('lang')}}">
<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="csrf-token" content="{{csrf_token()}}">
 <title>{{ENV("AP_NAME")}}</title>

 <base href="{{url('/')}}">
 <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
 <link rel="stylesheet" href="css/bootstrap.css">
 <link rel="stylesheet" href="fonts/icofont.css">
 <link rel="stylesheet" href="css/fontawesome.css">
 <link href="css/style.css" rel="stylesheet">
 <link href="css/header-footer.css" rel="stylesheet">
 <link href="css/member-company.css?v=002" rel="stylesheet">
 <link rel="stylesheet" href="css/gallery.css?v=0001">

 <style>
   .ad-auto{
     position: absolute;
     padding: 0;
     background: #fff;
     border: 1px solid;
     border-top: none;
     border-color: #ccc;
     margin-top:1px;
   }
   .ad-auto ul{
     font-size:14px; 
     margin-left: 0;
   }
   ul.ad-auto li{
     color:#000;
     font-size: 14px;
     padding:5px 5px 5px 12px;
   }
   ul.ad-auto li>span{
     color:#555;
   }
   ul.ad-auto li:hover>span{
     color:#fff;
   }
   ul.ad-auto li:hover{
     cursor: pointer;
     background-color: #258aff;
     color:#fff;      
   }
 </style>

</head>
<body>

  @if($module!='member')
    @include("$prefix.$module.header")
  @else
    @include("$prefix.header")
  @endif

<section class="page">
    <div class="container">    
        <div class="col-lg-12">
            <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
                <div class="left">
                    @include("$prefix.member.member-menu")
                </div>
                <div class="right">
                    <div class="group-box-right">
                        <h5 class="bold border-bottom mb-5">SMS History</h5>
                        @php
                            $data = \App\Models\SMSHistoryMd::where('company',$row->id)->get()
                        @endphp
                        <div class="row">
                            <div class="col-lg-12">
                                <ol>
                                @foreach($data as $k => $v)
                                    <li>{{$v->message}} <span class="badge badge-success">{{date('D, d F Y, H:i')}}</span></li>
                                @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>