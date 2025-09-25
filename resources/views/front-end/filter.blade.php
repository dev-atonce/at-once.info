  <div class="cover-top">
    <div class="cover-img" style="background-image: url(images/logistic/banner-logistic.jpg); background-color: rgb(27, 160, 226);">
      <div class="cover-text"><h1 class="_29HYP">@lang('phrase.logistic.caption')</h1></div>

    </div>
    
  </div>

<!-- 
 <section>
  <div class="container">
    <div class="row">

      <div class="col-lg-12">
        <div class="card-profile">
         <div class="row">
          <div class="col-lg-4">
            <div class="pd-0 pd-lg-2">
              <center>
                <img src="images/icon/search-company02.svg"  style="width: 30%; height: 100%;">
                <p class="mt-2 mt-lg-4">@lang('phrase.concept.1')</p>
              </center>
            </div>
          </div>
          <div class="col-lg-4">
           <div class="pd-0 pd-lg-2">
             <center>
              <img src="images/icon/check-mail02.svg"  style="width: 30%; height: 100%;">
              <p class="mt-2 mt-lg-4">@lang('phrase.concept.2')</p>
            </center>
          </div>
        </div>
        <div class="col-lg-4">
         <div class="pd-0 pd-lg-2">
          <center>
            <img src="images/icon/profile.svg" style="width: 30%; height: 100%;">
            <p class="mt-2 mt-lg-4">@lang('phrase.concept.3')
            </p>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section> -->

<div class="container" id="filter">

 <div class="promote-box3">
   <div class="row">
    <div class="col-lg-4">
      <div class="pd-0 pd-lg-2">
        <center>
          <img src="images/icon/search-company02.svg"  style="width: 20%; height: 100%;">
          <p class="mt-2 mt-lg-2">@lang('phrase.concept.1')</p>
        </center>
      </div>
    </div>
    <div class="col-lg-4">
     <div class="pd-0 pd-lg-2">
       <center>
        <img src="images/icon/check-mail02.svg"  style="width: 20%; height: 100%;">
        <p class="mt-2 mt-lg-2">@lang('phrase.concept.2')</p>
      </center>
    </div>
  </div>
  <div class="col-lg-4">
   <div class="pd-0 pd-lg-2">
    <center>
      <img src="images/icon/profile.svg" style="width: 20%; height: 100%;">
      <p class="mt-2 mt-lg-2">@lang('phrase.concept.3')
      </p>
    </center>
  </div>
</div>
</div>
</div>

<div class="filter-box">


  <div class="header bold"><img src="images/icon/delivery-box.svg"> @lang('phrase.logistic.search-title')</div>


  <div class="filter-form">

    <form action="" method="get">
      <div class="row">

       <div class="col-lg-12">
         <div class="row">

          <div class="col-lg-4">
            <div class="input-group mb-3 mr-sm-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><img src="images/icon/delivery-truck.svg"></div>
              </div>
              <label for="inlineCheckbox1" class="form-control">                          
                @lang('phrase.domestic')
                <input type="checkbox" id="inlineCheckbox1" name="domestic" value="1" title="@lang('phrase.domestic')" @if(Request::get('domestic')==1)checked @endif>
              </label>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3 mr-sm-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><img src="images/icon/exchange.svg"></div>
              </div>
              <span class="form-control" id="international" title="@lang('phrase.international')">@lang('phrase.international')</span>
              <input type="hidden" name="international" value="{{Request::get('international')}}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3 mr-sm-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><img src="images/icon/cargo-ship.svg"></div>
              </div>
              <span class="form-control" id="methods" title="@lang('phrase.transport')">@lang('phrase.transport')</span>
              <input type="hidden" name="methods" value="{{Request::get('methods')}}">
            </div>
          </div>


          <div class="col-lg-4">
            <div class="input-group mb-3 mr-sm-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><img src="images/icon/box.svg"></div>
              </div>
              <span class="form-control" id="item" title="@lang('phrase.items')">@lang('phrase.items')</span>
              <input type="hidden" name="item" value="{{Request::get('item')}}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3 mr-sm-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><img src="images/icon/customer-service.svg"></div>
              </div>
              <span class="form-control" id="services" title="@lang('phrase.services')">@lang('phrase.services')</span>
              <input type="hidden" name="services" value="{{Request::get('services')}}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3 mr-sm-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><img src="images/icon/warehouse2.svg"></div>
              </div>
              <span class="form-control" id="warehouse" title="@lang('phrase.warehouse')">@lang('phrase.warehouse')</span>
              <input type="hidden" name="warehouse" value="{{Request::get('warehouse')}}">
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-9"></div>
      <div class="col-lg-3">
        <button type="submit" name="submit" class="btn btn-search" value="search"><i class="icofont-search-2"></i> @lang('phrase.search')</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>


<!-- <section>
  <div class="container">
    <div class="">
      <div class="bookmark-promotion">
        <div class="row">
          <div class="col-lg-1">
            <div class="circle-promotion">
              <img src="upload/celebration.svg" width="80" class="mb-2 mb-lg-0">
            </div>
          </div>
          <div class="col-lg-8">
            <div class="vertical-align-wrap">
              <div class="vertical-align--middle pl-0 pl-lg-3">
                <h5 class="bold mb-1">ฉลองเปิดเว็บ at once ลงประกาศฟรี ไม่ต้องสมัครสมาชิก</h5>
                <p class="mb-2 mb-lg-0"> สนใจติดต่อลงประกาศได้ที่นี่</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
           <div class="vertical-align-wrap">
            <div class="vertical-align--middle">
             <a href="" class="btn btn-orange">ติดต่อลงประกาศ ฟรี!</a>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</section> -->
@php
$lang = Session('lang');
$langPro = (Session('lang')=='jp')?'en':'th';
$yes_or_no = \App\Models\ChoiceMd::where('type','YesNo')->select('id','key',"name_$lang as name")->get();
$two = \App\Models\ChoiceMd::where('type','transport')->select('id','key',"name_$lang as name")->get();;
$methods = \App\Models\ChoiceMd::where('type','methods')->select('key',"name_$lang as name")->get();
$three = \App\Models\ChoiceMd::where('type','warehouse')->select('id','key',"name_$lang as name")->get();
$services = \App\Models\ChoiceMd::where('type','services')->select('id','key',"name_$lang as name")->get();
$province = \App\Models\ProvinceMd::select('province_id as id',"province_name_$langPro as name")->orderBy('name')->get();
$get['demestic'] = Request::get('demestic');
$get['inter'] = explode(',',Request::get('international'));
$get['methods'] = explode(',',Request::get('methods'));
$get['warehouse'] = explode(',',Request::get('warehouse'));
$get['services'] = explode(',',Request::get('services'));
$get['packing'] = Request::get('packing');
$get['item'] =  explode(',',Request::get('item'));
@endphp
<div id="tableTwo" style="display:none">
  <div class="row scroll-y"><br>
    @foreach($two as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="two{{$k}}">
          <input type="checkbox" id="two{{$k}}" class="two_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['inter'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
    <div class="clearfix"></div><br>
  </div>
  <br>
  <div class="row"><div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div></div>
</div>
<div id="tableWarehouse" style="display:none">
  <div class="row scroll-y"><br>
    @foreach($province as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <input type="checkbox" class="six_" id="six_{{$k}}" name="province" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['warehouse'])) checked @endif>
        <label for="six_{{$k}}">{!!$v->name!!}</label>       
      </div>
    </div>
    @endforeach
    <div class="clearfix"></div><br>
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger btn-sm clear-list"><i class="fas fa-angle-double-right"></i> @lang('phrase.reset')</a></div>
  </div>
</div>
<div id="tableItems" style="display:none">
  <div class="row scroll-y"><br>
    @foreach($three as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="four{{$k}}">
          <input type="checkbox" id="four{{$k}}" class="four_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['item'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
    <div class="clearfix"></div><br>
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div>
  </div>
</div>
<div id="tableMethods" style="display:none">
  <div class="row scroll-y"><br>
    <div class="clearfix"></div><br>
    @foreach($methods as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="three{{$k}}">
          <input type="checkbox" id="three{{$k}}" class="three_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['methods'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div>
  </div>
</div>
<div id="tableService" style="display:none">
  <div class="row scroll-y"><br>
    <div class="clearfix"></div><br>
    @foreach($services as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="five{{$k}}">
          <input type="checkbox" id="five{{$k}}" class="five_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['services'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div>
  </div>
</div>