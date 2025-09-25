<style>
    .img-preview{
        width: 100%;
        max-height:145px;
        overflow: hidden;
    }
    .img-preview>img{
        height: 100%;
    }
    #tree{
        width:auto;
        height:350px;
        overflow-x:auto;
        overflow-y:auto;
    }
    #tree>ul{
        padding-top:10px;
    }
    .weekDays-selector .weekday {
        display: none!important;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .weekDays-selector input[type=checkbox] + label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        min-width: 50px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .weekDays-selector input[type=checkbox]:checked + label {
        background: #26B99A;
        color: #ffffff;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }

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
        list-style-type: none;
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
    .fw-500{
        font-weight: 500;
    }
    .this-package{
        cursor: pointer;
    }
    .card.selected{
        box-shadow:
        0 0px 1px 2px rgb(37 138 255 / 70%),
        0 2px 6px 0 rgb(37 138 255 / 70%),
        0 0px 0px 0 rgb(37 138 255 / 70%) !important;
    }
    .selected .card-header{
        color: #258aff !important;
    }
    .more-package-detail{
        cursor: pointer;
        margin-bottom: 2px;
    }
  </style>
  @php
        $day = DB::table('working_hours')->select('id','name_th')->get();
  @endphp
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="breadcrumb-item "><a href='{{url("$prefix$segment")}}'>Customers</a></span>
                        <span class="breadcrumb-item active">Create Form</span>
                        <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                    </div>
                    <div class="card-body">
                        @php
                            $category = \App\Models\CategoryMd::get()
                        @endphp
                        <form id="" method="post" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row text-right mb-3">
                                                <div class="col-lg-12">
                                                    <div id="areaAlert"></div>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <select name="cs" id="cs" class="form-control">
                                                            <option hidden>Choose CS</option>
                                                            @foreach(\App\Models\UsersMd::whereIn('name',['BUM','PAIR','FUJII','Banana','Ball','Yoyo', 'TAKAGI'])->get() as $k =>$v)
                                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="email" class="form-control" name="email_cs" id="email_cs" placeholder="Email CS">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>ประเภทธุรกิจ:</label>
                                                        <select name="category" class="form-control">
                                                            <option hidden>เลือกประเภทธุรกิจ</option>
                                                            @foreach($category as $k => $v)
                                                            <option value="{{$v->id}}">{{$v->name_jp}} / {{$v->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>บริษัท:</label>
                                                        <select name="company" id="company" disabled>
                                                            <option>เลือกบริษัท</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <h5 class="mt-2 mb-2">Package :</h5>
                                            <div class="row">
                                                @foreach(\App\Models\PackageCategoryMd::
                                                    where(['package_category.type' => 'main', 'package_category.visible' => 1])
                                                    ->leftJoin('package_detail', 'package_detail.category', 'package_category.id')
                                                    ->select(
                                                        'package_category.id',
                                                        "package_category.name_th",
                                                        "package_category.name_en",
                                                        'package_detail.detail_th',
                                                        'package_detail.detail_en',
                                                        'package_detail.html_th',
                                                        'package_detail.html_en'
                                                    )
                                                    ->get() as $k => $v
                                                )
                                                <div class="col-lg-3">
                                                    <div class="card">
                                                        <div class="card-header this-package bg-secondary text-center">
                                                            <h6 class="mb-0">
                                                                <div class="form-check form-check-inline">
                                                                    {{-- <input class="form-check-input" type="radio" id="package_{{$k}}" name="package" value="{{$v->packageId}}"> --}}
                                                                    <input class="form-check-input" type="checkbox" id="package_{{$k}}" name="package_in[]" value="{{$v->id}}">
                                                                    <label class="form-check-label" for="package_{{$k}}">{{$v->name_th}}</label>
                                                                </div>
                                                            </h6>
                                                        </div>
                                                        <div class="card-body bg-light" style="max-height:250px; overflow: hidden;">
                                                            {!! $v->html_th !!}
                                                            {{-- <ul class="pl-3">
                                                            @if(count($v->items)>0)
                                                            @foreach($v->items as $l)
                                                                <li data-id="{{$l->id}}">
                                                                    <strong>{{$l->listName}}</strong><br>
                                                                    <span>
                                                                        @if($l->list == 9){{$l->value}} @endif
                                                                        {{$l->listDescription}}
                                                                        <input type="hidden" name="key[]" value="{{$l->key}}">
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                            @else
                                                                <li>No package option.</li>
                                                            @endif
                                                            </ul> --}}
                                                        </div>
                                                        <div class="text-center position-absolute w-100 bg-light" style="bottom: 0;">
                                                            <span class="badge badge-secondary more-package-detail"><i class="fas fa-chevron-up"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    var select = new SlimSelect({select:'#company'});
    $('select[name="category"]').on('change',function(e){
        const category = $(this,'option:selected').val();
        let data = [];
        data.push({value:"",text:'กรุณาเลือกบริษัท'})
        const company = $.ajax({
            method: 'get',
            url: '/webpanel/customers/get-company',
            data: { category: category },
            async: false
        }).responseJSON
        let op;
        company.map(function(v,k){
            data.push({value:v.id,text: v.name_th+' / '+v.name_jp})
        });
        data.length > 0 ? select.enable() : select.disable();
        select.setData(data);
    })
    maxHeight = 250;
    const packages = $('.this-package');
    packages.map(function(k,v){
        thisHeight = $(v).next().innerHeight();
        if(thisHeight >= maxHeight){
            $(v).closest('.card').find('.card-body').next().removeClass('d-none');
        }else{
            $(v).closest('.card').find('.card-body').next().addClass('d-none')
        }
    })
    $(document).on('click','.this-package',function(){
        packages.closest('.card').removeClass('selected');
        packages.closest('.card').find('input[name="package"]').prop('checked',false);
        keys = [];

        this.closest('.card').classList.add('selected');
        $(this).closest('.card').find('input[name="package"]').prop('checked',true);
        $(this).closest('.card').find('input[name^="key"]').map(function(){
            keys.push(this.value);
        })
        if(keys.indexOf('popup-contact') > -1 || keys.indexOf('popup-blog')){
            $('.special-service').removeClass('d-none');
            $('.special-service').removeClass('d-none');
        }else{
            $('.special-service').addClass('d-none');
            $('.special-service').addClass('d-none');

        }
    })
    $(document).on('click','.more-package-detail',function(){
        $this = $(this);
        style = $this.closest('.card').find('.card-body').attr('style');
        if(style == undefined){
            $this.closest('.card').find('.card-body').css({'max-height':`${maxHeight}px`,'overflow':'hidden'});
        }else{
            $this.closest('.card').find('.card-body').removeAttr('style');
        }
        $this.children().toggleClass('fa-chevron-down fa-chevron-up')
    })
    $('.special-option').on('change',function(){
        if($(this).is(':checked')){
            $(this).parent().next().children().prop('disabled',false);
        }else{
            $(this).parent().next().children().prop('disabled',true);
        }
    })
</script>
