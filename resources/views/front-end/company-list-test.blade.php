<style>
  .localtion{
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
</style>
<div class="col-md-12 col-lg-7 pr-lg-0 scrolling">
  <div class="title-company-list text-white">
    <div class="custom-checkbox">
      <div class="row">
        <div class="col-lg-12">
          <div class="float-left">
            <h2>@lang("phrase.$module.allCompany")<span class="position-absolute text-yellow ml-2">{{$online}}</span></h2></div>
            <div class="float-right">
              <i class="icofont-info-circle"></i> @lang('phrase.click') 
              <span class="bold exp-select">
                @lang('phrase.select') 
                <i class="far fa-square"></i>
              </span>&nbsp;&nbsp; @lang("phrase.$module.click-concept")
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="company-list" style="height:100%">
    <div class="row">
      @foreach($company as $k => $row)
      @php
        $position = strpos($row->line,"@");
        if($position>-1){
            $hrefLine = "https://line.me/ti/p/".str_replace('@','%40',$row->line);
        }else{
            $hrefLine = "https://line.me/ti/p/~".$row->line;
        }
      @endphp
      <div class="col-md-12 col-md-6 col-lg-12"> 
        <div class="card-profile" data-id="{{$row->id}}">
          @if($row->email!='' && $row->email!='No' && $row->type!='basic')
          <div class="toggle">
            <div class="rkmd-checkbox checkbox-ripple">
              <label for="com_{{$k}}" class="label">@lang('phrase.select')</label>
              <label class="input-checkbox checkbox-lightBlue">
                <input type="checkbox" id="com_{{$k}}" class="mr-1 comp-select" value="{{$row->id}}" tag="{{$row->id}}" text="{{$row->name}}">
                <span class="checkbox"></span>
              </label>
            </div>
          </div>
          @endif
          <div class="card-top row" style="align-items: center; visibility: visible;">
        
            <div class="col-12 col-lg-9 pl-2 pr-2 pl-lg-3 pr-lg-3">
              <div class="row">
                @if($row->type!='basic')
                <div class="col-4 col-lg-3 pr-lg-0">
                  
                    <a href="{{Session('lang')}}/{{$module}}/cp/{{$row->profile_url}}" target="_blank" >
                      <img src="{{str_replace('.','-xs.',$row->logo)}}" src-xs="{{str_replace('.','-xs.',$row->logo)}}" alt="{{$row->name}} - {{$categoryName}}" class="img-fluid logo-company" {{--data-cp="{{$row->id}}" data-toggle="modal" data-id="{{$row->id}}" capture="index" data-target="#exampleModal"--}}> 
                    </a>
                    <div class="box-nation">
                      <small class="nation"><img src="https://www.at-once.info/flags/{{strtolower($row->alpha2)}}.png"> {{$row->nationality}} Company</small>
                    </div>
                  
                <!--   <div class="box-nation d-block d-lg-none">
                    <small class="nation"><img src="https://www.at-once.info/flags/{{strtolower($row->alpha2)}}.png"></small>
                  </div> -->
                  
                  <div class="social d-none d-lg-block">  
                    <a class="aicon @if($row->website=='')none-info @endif" @if($row->website!='')href="{!!$row->website!!}"@endif target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="Website">
                      <span class="boxicon website"></span>
                    </a>                              
                    <a class="aicon @if($row->facebook=='')none-info @endif"  @if($row->facebook!='')href="{!!$row->facebook!!}"@endif target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="facebook">
                      <span class="boxicon facebook"></span>
                    </a>
                    <a class="aicon @if($row->line=='')none-info @endif" @if($row->line!='')href="{{$hrefLine}}"@endif target="_blank"  rel="noopener" data-toggle="tooltip" data-placement="top" title="Line">
                      <span class="boxicon line-card"></span>
                    </a>
                  </div>
                  
                </div>
                @endif
                <div class="@if($row->type!='basic')col-8 col-lg-9 @else col-lg-12 @endif pl-0 pl-lg-4">
                  <h3 class="title bold">
                    <a @if($row->profile_url!='' && $row->profile_url!='No')href="{{url(Session('lang'))}}/{{$module}}/cp/{{$row->profile_url}}"@endif {{--data-cp="{{$row->id}}" data-toggle="modal" data-id="{{$row->id}}" capture="index" data-target="#exampleModal"--}} href="{{Session('lang')}}/{{$module}}/cp/{{$row->profile_url}}" target="_blank" class="skiptranslate">{{$row->name}}</a>
                  </h3>
                  @php $langP=(Session('lang')=='th')?'th':'en'; @endphp
                  <div class="localtion">
                    @foreach($row->location()->select("pv.province_name_$langP as province")->leftJoin('provinces as pv','cp_location.location','=','pv.province_id')->where('cp_location._id',$row->id)->get() as $k => $v)
                    <span class="badge-location"><i class="fas fa-map-marker-alt fa-fw"></i>{{$v->province}}</span>
                    @endforeach
                  </div>
                  <div class="content">
                    <p class="highlight"> {!!$row->description!!}</p> 
                  </div>
                </div>
              </div>
            </div>



            <div class="col-lg-3 pl-2 pr-2 pl-lg-3 pr-lg-3"> 
              @php 
              // $galleryRaw = $row->gallery()->where('_id',$row->id);
              // $count = $galleryRaw->get()->count();
              @endphp
              {{-- @if($row->type=='full')
                <div class="light-g d-none d-lg-block">                                
                  <div class="gallery-flex relative-gall" id="lightg{{$k}}">
                    @foreach($galleryRaw->get() as $kg => $vg)
                    <a href="{{$vg->image}}" style="background-image:url({{str_replace('.','-sm.',$vg->image)}});background-position:center;background-size:cover;border-radius:4px; @if($kg>=4) position:relative;display:none; @endif">
                      <img src="{{str_replace('.','-sm.',$vg->image)}}" class="cWzaZM" style="display: none;">
                      @if($kg==3)<div class="overlay-see-all"><span class="backdrop-gallery" style="text-align:center;vertical-align:middle;height:100%;vertical-align:-webkit-baseline-middle;">ดูภาพทั้งหมด</span></div>@endif
                    </a>                        
                    @endforeach
                  </div>   
                </div> 
              @endif --}}

              <div class="card-footer-cp ">
                <a target="_blank" 
                    @if($row->profile_url!='')href="{{url(Session('lang'))}}/{{$module}}/cp/{{$row->profile_url}}"@endif 
                    class="search-buttons skiptranslate" capture="index" 
                    @if($row->profile_url!='')data-full="{{Session('lang')}}/{{$module}}/cp/{{$row->profile_url}}"@endif 
                >
                    @lang('phrase.see-details')
                </a>
              </div>                  
            </div>
            
          </div> <!-- card-top row -->
        </div>
      </div>

      @endforeach
      <div class="col-md-12 col-md-6 col-lg-12 load-more-content d-none" style="margin-top:-12px;"> 
        <div class="d-flex justify-content-sm-center">
          <a id="more-company" data-category="{{$categoryId}}" data-more="20">
              <i class="fas fa-spinner fa-lg fa-pulse text-light"></i><span class="ml-2 text-light">Load more</span>
            </a>
        </div>
      </div>
      @if($company->count()<1)
      <div class="col-md-12 col-md-6 col-lg-12">
        <p class="text-white text-center">Company not found !</p>
      </div>
      @endif

    </div>
  </div>
</div>
