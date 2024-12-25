<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>{{$row->name}} - {{ENV('APP_NAME')}}</title>

	<base href="{{url('/')}}">
	<link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
	<link href="https://fonts.googleapis.com/css2?family=Monoton&family=Noto+Sans+JP:wght@100;300;500;700;900&family=Roboto:ital,wght@0,100;0,300;1,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="fonts/icofont.css">

	<link rel="stylesheet" href="css/gallery.css?v=0001">

	<style>
		body{
			background-color: #f3f3f3;
			margin:0;
			padding:0;
			top:0;
			bottom:0;
		}
		.bg-gradient{
			background: #4bbacb;
			background-image: url('./images/24595.png');
			background-size: contain;
			background-repeat: no-repeat;
			background-position-x: center;
			border-radius: 4px;
			box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
			margin-bottom: 16px;
		}
		.company-name{
			padding: 100px 0 120px 0;
			text-shadow: 1px 1px 5px black;
		}
		.profile-image{
			width: 150px;
			margin: -50px 15px 0 10px;
			border: 10px solid rgba(255,255,255);
			box-shadow: 0 0 1px 1px rgba(200,200,200);
		}
		.company-title{
			margin: 10px 0 0 0;
		}
		.bg-white{
			min-height:1080px;
		}
		/*.container{
			box-shadow: 0 0 5px 2px rgba(225,225,225);
		}*/

		.box-pro {
			display: block;
			position: relative;
			padding: 16px;
			margin-bottom: 16px;
			color: rgb(35, 39, 41);
			background-color: rgb(255, 255, 255);
			border-radius: 4px;
			box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
		}



		.profile-img{
			border: 10px solid rgba(255,255,255);
			box-shadow: 0 0 1px 1px rgba(200,200,200);
			border-radius: 4px;
		}

		/*Company-Detail*/
		/*===============================================*/
		.btn-top{
			word-break: initial;
			font-size: 14px;
			height: 24px;
			width: auto;
			display: inline-flex;
			-webkit-box-align: center;
			align-items: center;
			-webkit-box-pack: center;
			justify-content: center;
			border-radius: 4px;
			border-style: solid;
			border-width: 1px;
			padding: 0px 8px;
			transition: all 0.2s ease-in-out 0s;
			cursor: pointer;
			text-decoration: none;
			color: rgb(35, 39, 41);
			background: transparent;
			border-color: rgb(153, 156, 158);
		}

		.btn-top i{
			color: #e21a00;
		}

		.vertical-table {
			position: absolute;
			width: 100%;
			height: 100%;
			display: table;
		}

		.vertical-align-middle {
			display: table-cell;
			vertical-align: middle;
		}


		.box-pro .company-detail h1{
			word-break: initial;
			font-size: 24px;
			font-weight: bold;
			margin: 0px;
			line-height: 36px;
			margin-bottom: 10px;
		}

		.box-pro .border-line-bottom{
			padding-bottom: 10px;
			border-bottom: 1px solid rgb(220, 223, 224);
			margin-bottom: 20px;
		}

		.bqeNFp button {
			min-width: 88px;
		}



		/*Gallery*/
		/*===============================================*/

		/*	.gallery {
			background: linear-gradient(rgba(0, 0, 0, 0) 60%, rgba(0, 0, 0, 0.6) 100%);
		}*/

		.gallery img{
			border-radius: 4px;
		}



		/*Address*/
		/*===============================================*/

		.btn-pro {
			word-break: initial;
			font-size: 14px;
			height: 32px;
			width: auto;
			display: inline-flex;
			-webkit-box-align: center;
			align-items: center;
			-webkit-box-pack: center;
			justify-content: center;
			border-radius: 4px;
			border-style: solid;
			border-width: 1px;
			padding: 0px 8px;
			transition: all 0.2s ease-in-out 0s;
			cursor: pointer;
			text-decoration: none;
			color: rgb(35, 39, 41);
			background: transparent;
			border-color: rgb(153, 156, 158);
			white-space: nowrap;
			width: 88px;
		}


		.box-pro i {
			color: rgb(153, 156, 158);
			padding-right: 8px;
			width: 24px;
			line-height: 1.42857;
			fill: none;
		}

		.box-pro .flex-contact {
			display: flex;
			cursor: pointer;
		}

		.box-pro .flex-contact.tel-1 {
			display: flex;
			-webkit-box-pack: justify;
			justify-content: space-between;
			cursor: pointer;
		}

		.box-pro .address {
			width: 100%;
			padding-right: 12px;
			margin-bottom: 0;
		}


		.box-pro .company-map {
			position: relative;
			cursor: pointer;
			width: 100%;
			height: 100%;
			overflow: hidden;
			display: flex;
			-webkit-box-pack: center;
			justify-content: center;
			-webkit-box-align: center;
			align-items: center;
			border-radius: 4px;
		}

		.box-pro .flex-contact {
			border-bottom: 1px solid rgb(220, 223, 224);
			padding: 12px 0px;
		}


		.box-pro .flex-contact:last-child {
			border-bottom: 0px solid rgb(220, 223, 224);
			padding: 12px 0px;
		}

		.flex-contact > * {
			vertical-align: middle;
		}


		/*type*/
		/*===============================================*/

		.box-pro .type ul{
			padding: 0;
			margin: 0;
			list-style: none;
		}
		.box-pro .type .check-box {
			background-repeat: no-repeat;
			background-size: cover;
			display: inline-block;
			vertical-align: middle;
			line-height: 0;
			width: 16px;
			height: 16px;
			background-image: url(https://static2.wongnai.com/static2/images/28iY7BX.png);
		}

		.box-pro .type .check-none {
			background-repeat: no-repeat;
			background-size: cover;
			display: inline-block;
			vertical-align: middle;
			line-height: 0;
			width: 16px;
			height: 16px;
			background-image: url(https://static2.wongnai.com/static2/images/1HSTT9E.png);
		}

		.box-pro .type .forwarder {
			margin: 0 0 5px 0;
			display: table;
			width: 100%;
		}

		.box-pro .type .forwarder-check {
			padding-right: 5px;
			display: table-cell;
			text-align: center;
			/*vertical-align: middle;*/
		}

		.box-pro .type .forwarder-container {
			display: table-cell;
			text-align: left;
			vertical-align: middle;
		}

		.box-pro .type .country{
			color: rgb(118, 121, 122);
			margin-bottom: 0;
		}

		.box-pro .type .list{
			color: rgb(118, 121, 122);
		}

		.see-all {
			cursor: pointer;
			color: rgb(83, 146, 249);
			text-align: center;
		}



		/*Open*/
		/*===============================================*/


		.box-pro .table-open {
			color: rgb(118, 121, 122);
			width: 100%;
		}

		.box-pro .table-open td {
			width: 50%;
		}



		/*social*/
		/*===============================================*/

		.box-pro .social{
			width: 100%;
			display: flex;
			flex-wrap: wrap;
		}

		.box-pro .social > a {
			vertical-align: middle;
			width: 50%;
			margin: 8px 0px;
			color: rgb(118, 121, 122);
		}

		.box-pro .social .boxicon {
			background-repeat: no-repeat;
			background-size: cover;
			display: inline-block;
			vertical-align: middle;
			line-height: 15px;
			width: 24px;
			height: 24px;
			color: #fff;
			border-radius: 50%;
			padding: 5px;
			margin-right: 8px;
			vertical-align: middle;
		}

		.box-pro .social span{
			font-family: icofont!important;
			speak: none;
			font-style: normal;
			font-weight: 400;
			color: #fff;
		}

		.box-pro .social .facebook {
			background-color: #3B5998;	
		}

		.box-pro .social .facebook:before{
			content: "\ed37";
		}

		.box-pro .social .line {
			background-color: #00c300;	
		}

		.box-pro .social .line:before{
			content: "\ed4c";
		}


		.box-pro .social .website {
			background-color: #9e9e9e;	
		}

		.box-pro .social .website:before{
			content: "\f02c";

		}
		.company-logo{
			display:table;
			width: 150px;
			height: 150px;
			background-color:#fc593b;   
			text-align: center;    
			vertical-align: middle; 
			border-radius: 3px;
        	/* box-shadow: 0 0 4px 0px #aaa; */
      	}
		.company-logo span{
			display: table-cell;
			vertical-align: middle;
			height: 100%;
			color: white;
			font-size: 34px;        
			
		}

	</style>
</head>
<body>
	<br>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 ">
					<div class="bg-gradient text-center">
						<h3 class="text-white align-middle company-name">{{$row->name}}</h3>
					</div>
				</div>

				<div class="col-lg-8">
					<div class="box-pro">

						<div class="row">
							<div class="col-lg-3">
								{{-- <img src="{{url($row->logo)}}" class="profile-img img-fluid mb-3" style="width:100%;"> --}}
								@if($row->public==1)<img src="{{url($row->logo)}}" class="profile-img img-fluid mb-3" style="width:100%;">@else<div class="company-logo profile-img img-fluid mb-3" data-name="{{$row->name}}"></div>@endif
							</div>
							<div class="col-lg-9">	
								<div class="company-detail">
									<div class="vertical-table">
										<div class="vertical-align-middle">
											<h1 class="">{{$row->name}}</h1>
											<button class="btn-top"><i class="icofont-share"></i> @lang('phrase.share')</button>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="company-detail">
							<p>{!!$row->description!!}</p>
							<h5>@lang('phrase.history')</h5><br>
							<p class="align-justify">{!!$row->detail!!}</p>
						</div>
					</div>

					<div class="box-pro">
						<h5 class="border-line-bottom">@lang('phrase.gallery')</h5>

						<div class="gallery-section">


							<div class="gallery-box">
								<div class="box big">
									<a href="https://image.freepik.com/free-photo/industrial-port-container-yard_1112-1200.jpg" data-fancybox="gallery1">
										<img src="https://image.freepik.com/free-photo/industrial-port-container-yard_1112-1200.jpg" class="img-fluid">
									</a>
								</div>
								<div class="box ">
									<a href="https://image.freepik.com/free-photo/crane-hook-with-cargo-container-text-3d-render_35761-368.jpg" data-fancybox="gallery1">
										<img src="https://image.freepik.com/free-photo/crane-hook-with-cargo-container-text-3d-render_35761-368.jpg" class="img-fluid">
									</a>
								</div>
								<div class="box">
									<a href="https://image.freepik.com/free-photo/container-ship-arriving-commercial-port_35024-886.jpg" data-fancybox="gallery1">
										<img src="https://image.freepik.com/free-photo/container-ship-arriving-commercial-port_35024-886.jpg" class="img-fluid">
									</a>
								</div>
								<div class="box ">
									<a href="https://image.freepik.com/free-photo/cargo-white-container-truck-ship-port-logistics_42493-228.jpg" data-fancybox="gallery1">
										<img src="https://image.freepik.com/free-photo/cargo-white-container-truck-ship-port-logistics_42493-228.jpg" class="img-fluid">
									</a>
								</div>
								<div class="box">
									<a href="https://image.freepik.com/free-photo/industrial-port-container-yard_1112-1200.jpg" data-fancybox="gallery1">
										<img src="https://image.freepik.com/free-photo/industrial-port-container-yard_1112-1200.jpg" class="img-fluid">
									</a>
								</div>


							</div>

						</div>

					</div>

					<div class="box-pro">
						<h5 class="titel">@lang('phrase.locate$route')</h5>
						<div class="row">
							<div class="col-lg-3">
								<div class="company-map">
									{!!$row->gmap!!}
								</div>
							</div>
							<div class="col-lg-9">
								<div class="flex-contact">
									<i class="icofont-location-pin"></i> 
									<p class="address"> {{@$row->address}} @if(@$row->subdistrict){!!@$row->subdistrict!!}@endif @if(@$row->district){!!@$row->district!!}@endif @if(@$row->province){{$row->province}}@endif @lang('phrase.thailand') {{$row->postcode}}</p>
									<button class="btn-pro"><span class="sc-AxjAm czzYMP">@lang('phrase.route')</span></button>								
								</div>
								<div class="flex-contact tel-1 ">
									<i class="icofont-phone"></i>
									<p class="address">{{@$row->phone}}</p>
									<button class="btn-pro"><span class="sc-AxjAm czzYMP">@lang('phrase.calling')</span></button>	
								</div>
								<div class="flex-contact">
									<i class="icofont-email"></i>
									<p class="address">{{@$row->email}}</p>
									<a href="mailTo:{{@$row->email}}" class="btn-pro"><span class="sc-AxjAm czzYMP">@lang('phrase.sent-email')</span></a>	
								</div>
							</div>
						</div>
					</div>



				</div> <!-- col-left -->

			@php
				$lang = Session('lang');
				$langP = (Session('lang')=='th')?'th':'en';
				$logistic = \App\Models\Filter\CpDeliveryMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','delivery.delivery','=','ch.key')->where(['_id'=>$row->id,'type'=>'transport'])->get();
				$packing = \App\Models\PackingMd::where('_id',$row->id)->count();
				$warehouse = \App\Models\Filter\CpWarehouseMd::select("pro.province_name_$langP as province")->leftJoin('provinces as pro','warehouse.warehouse','=','pro.province_id')->where(['_id'=>$row->id])->get();
				$items = \App\Models\Filter\CpItemMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','cp_item.item','=','ch.key')->where(['_id'=>$row->id,'ch.type'=>'warehouse'])->get();
				$workingHrs = \App\Models\Filter\CpWorkingHoursMd::select('cp_working_hours.id',"wh.name_$lang as day",'cp_working_hours.time')->leftJoin('working_hours as wh','cp_working_hours.day','=','wh.id')->where('_id',$row->id)->get();
			@endphp
				<div class="col-lg-4">
					<div class="box-pro ">
						<h5 class="titel">@lang('phrase.transportation')</h5>
						<div class="type">
							<ul>
								<li>
									<span class="check-box"></span>
									<span class="">@lang('phrase.domestic')</span>
								</li>
								<li>
									<div class="ph-item">
										<div class="forwarder-check" aria-hidden="true">
											<span class="check-box"></span>
										</div>
										<div class="forwarder-container">
											@lang('phrase.international')
											@foreach($logistic as $log)
											<p class="country">{{$log->name}}</p>
											@endforeach
										</div>
									</div>
								</li>
								<li>
									@if($packing==0)<span class="check-none"></span>@else<span class="check-box"></span>@endif
									<span class="">@lang('phrase.packing')</span>
								</li>
							</ul>
						</div>
						<hr>
						<h5 class="titel">@lang('phrase.warehouse')</h5>
						<div class="type">
							<ul class="list wharehose">
								@foreach(@$warehouse as $kw => $wh)
								<li @if($kw>=2)class="d-none"@endif>{{$wh->province}}</li>
								@endforeach
							</ul>
							@if(count(@$warehouse)>2)
							<div class="see-all">@lang('phrase.see-more')</div>
							@endif
						</div>
						<hr>
						<h5 class="titel">@lang('phrase.items')</h5>
						<div class="type">
							<ul class="list">
								@foreach($items as $i)
								<li>{{$i->name}}</li>
								@endforeach
							</ul>
						</div>
					</div>


					<div class="box-pro">
						<h5 class="titel">@lang('phrase.working_hours')</h5>
						@foreach($workingHrs as $kwh => $wh)
						<table class="table-open"><tr><td>{{$wh->day}}</td><td>{{$wh->time}}</td></tr></table>
						@endforeach
						<hr>


						<div>
							<div class="social">

								<a target="blank" class="aicon" href="#"><span class="boxicon facebook"></span>Facebook</a>
								<a target="blank" class="aicon" href="#"><span class="boxicon line"></span>Line@</a>
								<a target="blank" class="aicon" href="{{$row->website}}"><span class="boxicon website"></span>เว็บไซต์</a>
							</div>
						</div>
					</div>  <!-- col-right -->
				</div>
			</div>
		</section>


	</body>
	</html>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script> --}}
	{{-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script> --}}
	{{-- <script src='js/fancybox.js'></script> --}}
	<script>
		$.fn.extend({
			toggleText: function (a, b){
				var that = this;
					if (that.text() != a && that.text() != b){
						that.text(a);
					}
					else
					if (that.text() == a){
						that.text(b);
					}
					else
					if (that.text() == b){
						that.text(a);
					}
				return this;
			}
		});
		if($('.wharehose li').length>2){
			$('.see-all').click(function(){
				$(this).toggleText('{{__('phrase.see-more')}}','{{__('phrase.see-less')}}');
				$('.see-all').prev().find('[class]').toggleClass('d-none d-block');
			});
		}
		if($('.company-logo').length>0) {
          $('.company-logo').each(function(){
              var intials = $(this).data('name').charAt(0) + $(this).data('name').charAt(1);
              $(this).html('<span>'+intials+'</span>');

          })
		}
	</script>