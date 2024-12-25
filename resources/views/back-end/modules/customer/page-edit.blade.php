<style>
    .img-preview {
        width: 100%;
        max-height: 145px;
        overflow: hidden;
    }

    .img-preview>img {
        height: 100%;
    }

    #tree {
        width: auto;
        height: 350px;
        overflow-x: auto;
        overflow-y: auto;
    }

    #tree>ul {
        padding-top: 10px;
    }

    .weekDays-selector .weekday {
        display: none !important;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -o-user-select: none;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        min-width: 50px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -o-user-select: none;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #26B99A;
        color: #ffffff;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -o-user-select: none;
    }

    .ad-auto {
        position: absolute;
        padding: 0;
        background: #fff;
        border: 1px solid;
        border-top: none;
        border-color: #ccc;
        margin-top: 1px;
    }

    .ad-auto ul {
        font-size: 14px;
        margin-left: 0;
    }

    ul.ad-auto li {
        list-style-type: none;
        color: #000;
        font-size: 14px;
        padding: 5px 5px 5px 12px;
    }

    ul.ad-auto li>span {
        color: #555;
    }

    ul.ad-auto li:hover>span {
        color: #fff;
    }

    ul.ad-auto li:hover {
        cursor: pointer;
        background-color: #258aff;
        color: #fff;
    }

    .fw-500 {
        font-weight: 500;
    }

    .this-package {
        cursor: pointer;
    }

    .card.selected {
        box-shadow:
            0 0px 1px 2px rgb(37 138 255 / 70%),
            0 2px 6px 0 rgb(37 138 255 / 70%),
            0 0px 0px 0 rgb(37 138 255 / 70%) !important;
    }

    .selected .card-header {
        color: #258aff !important;
    }

    .more-package-detail {
        cursor: pointer;
        margin-bottom: 2px;
    }
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href='{{ url("$prefix$segment") }}'>Customers</a></span>
                    <span class="breadcrumb-item active">Edit Form</span>
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $category = \App\Models\CategoryMd::get();
                    @endphp
                    <form id="" method="post" action="" enctype="multipart/form-data">
                        @csrf
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
                                                @foreach(\App\Models\UsersMd::whereIn('name',['BUM','PAIR','FUJII','Banana','Ball','Yoyo'])->get() as $k =>$v)
                                                <option value="{{$v->id}}" @if ($row->cs == $v->id)selected @endif>{{$v->name}}</option>
                                                @endforeach
                                                <!-- <option value="11"@if ($row->cs == '11') selected @endif>BUM</option>
                                                <option value="18"@if ($row->cs == '18') selected @endif>CHANYA</option>
                                                <option value="42"@if ($row->cs == '42') selected @endif>LUKMAII</option> -->
                                            </select>
                                        </div>
                                        <input type="email" class="form-control" name="cs_mail" id="cs_mail" placeholder="Email CS" @if ($row->cs_mail) value="{{$row->cs_mail}}" @endif>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <h6>ประเภทธุรกิจ</h6>
                                        <div class="form-group">
                                            <select name="category" class="form-control">
                                                <option hidden>เลือกประเภทธุรกิจ</option>
                                                @foreach ($category as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if ($row->categoryId == $v->id) selected @endif>
                                                        {{ $v->name_jp }} / {{ $v->name_th }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <h6>บริษัท</h6>
                                        <div class="form-group">
                                            <select name="company" id="company"
                                                @if (!$company) disabled @endif>
                                                @if (!$company)
                                                    <option>เลือกบริษัท</option>
                                                @else
                                                    <option hidden>กรุณาเลือกบริษัท</option>
                                                @endif
                                                @foreach ($company as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if ($row->companyId == $v->id) selected @endif>
                                                        {{ $v->name_th }} / {{ $v->name_jp }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-lg-12 special-service @if ($row->package == 1) d-none @endif">
                                        <h5>Special Service</h5>
                                        <div class="card">
                                            <div class="card-body bg-light">
                                                <div class="row">
                                                    <div
                                                        class="col-xs-12 col-lg-4 sms">
                                                        <label><input type="checkbox" name="sms_nofity"
                                                                class="special-option"
                                                                @if ($row->smsnoti) checked @endif> SMS
                                                            Limit (e.g. 200)</label>
                                                        <div class="form-group">
                                                            <input type="text" name="sms" id="sms"
                                                                class="form-control" value="{{ $row->sms }}"
                                                                placeholder="SMS Limit"
                                                                @if (!$row->sms) disabled @endif>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">Mobile.</div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                value="{{ $row->mobile }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-4 line">
                                                        <label><input type="checkbox" name="line_notifiy"
                                                                class="special-option"
                                                                @if ($row->line != false) checked @endif> Line
                                                            Notification (if have token place it below)</label>
                                                        <div class="form-group">
                                                            <textarea name="lat" id="lat" cols="30" rows="3" class="form-control"
                                                                @if ($row->lat == '' && $row->line == false) disabled @endif>{{ $row->lat }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-12">
                                                        @php
                                                            $popupBlog=(@$row['popup-blog'] == 1)?1:0;
                                                            $popupContact=(@$row['popup-contact'] == 1)?1:0;
                                                        @endphp
                                                        <label for="popup-blog">
                                                            <input 
                                                                type="checkbox" class="popup"
                                                                id="popup-blog"
                                                                @if($row['popup-blog'] == 1) checked="" @endif
                                                            >
                                                            <input type="hidden" name="popup-blog" value="{{$popupBlog}}">
                                                            Popup Blog
                                                        </label>
                                                        <label for="popup-contact" class="ml-3">
                                                            <input type="checkbox" class="popup"
                                                                @if($row['popup-contact'] == 1) checked="" @endif
                                                            >
                                                            <input type="hidden" name="popup-contact" value="{{$popupContact}}">
                                                            Popup Contact
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row text-right">
                                            <div class="col-lg-12">
                                                <div id="areaAlert"></div>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h5 class="mt-2 mb-2">Package :</h5>
                                        
                                        <div class="row">
                                            {{-- @php
                                                $package = [];
                                                foreach (\App\Models\PackageCategoryMd::where('visible', 1)->get() as $k => $v) {
                                                    $package[$k] = (object) [
                                                        'packageId' => $v->id,
                                                        'packageName' => $v->name_en,
                                                        'items' => (object) \App\Models\PackageMd::leftJoin('package_list as l', 'package.list', '=', 'l.id')
                                                            ->where('package.package', $v->id)
                                                            ->select(['package.id', 'package.list', 'package.value', 'l.name as listName', 'l.description as listDescription', 'l.key', 'package.value'])
                                                            ->orderBy('l.sort')
                                                            ->get(),
                                                    ];
                                                }
                                            @endphp --}}
                                            @foreach(
                                                \App\Models\PackageCategoryMd::
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
                                                @php    
                                                    $in=explode(',',$row->package_in);
                                                    $selected = in_array($v->id,$in) === true ? 'selected' : '';
                                                @endphp
                                                <div class="col-lg-3">
                                                    <div class="card {{ $selected }}">
                                                        <div class="card-header this-package bg-secondary text-center">
                                                            <h6 class="mb-0">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="package_{{$k}}"
                                                                        name="package_in[]" value="{{$v->id}}"
                                                                        
                                                                        @if(in_array($v->id, $in)) checked="" @endif
                                                                    >
                                                                    <label class="form-check-label"
                                                                    for="package_{{$k}}">{{$v->name_en}}</label>
                                                                </div>
                                                            </h6>
                                                        </div>
                                                        <div class="card-body bg-light" style="max-height:250px; overflow: hidden;">
                                                            {!! $v->html_th !!}
                                                            
                                                            {{-- <ul class="pl-3">
                                                                @if (count($v->items) > 0)
                                                                    @foreach ($v->items as $l)
                                                                        <li data-id="{{ $l->id }}">
                                                                            <strong>{{ $l->listName }}</strong><br>
                                                                            <span>
                                                                                @if ($l->list == 9)
                                                                                    {{ $l->value }}
                                                                                @endif
                                                                                {{ $l->listDescription }}
                                                                                <input type="hidden"
                                                                                    name="key[{{ $v->packageId }}][]"
                                                                                    value="{{ $l->key }}">
                                                                            </span>
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li>No package option.</li>
                                                                @endif
                                                            </ul> --}}

                                                        </div>
                                                        <div class="text-center position-absolute w-100 bg-light"
                                                            style="bottom: 0;">
                                                            <span class="badge badge-secondary more-package-detail"><i
                                                                    class="fas fa-chevron-up"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-lg-12">
                                        <div id="areaAlert"></div>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
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
    var select = new SlimSelect({
        select: '#company'
    });
    $('select[name="category"]').on('change', function(e) {
        const category = $(this, 'option:selected').val();
        let data = [];
        data.push({
            value: "",
            text: 'กรุณาเลือกบริษัท'
        })
        const company = $.ajax({
            method: 'get',
            url: '/webpanel/customers/get-company',
            data: {
                category: category
            },
            async: false
        }).responseJSON
        let op;
        company.map(function(v, k) {
            data.push({
                value: v.id,
                text: v.name_th + ' / ' + v.name_jp
            })
        });
        data.length > 0 ? select.enable() : select.disable();
        select.setData(data);
    })
    maxHeight = 250;
    const packages = $('.this-package');
    console.log(packages);
    packages.map(function(k, v) {
        thisHeight = $(v).next().innerHeight();
        if (thisHeight >= maxHeight) {
            $(v).closest('.card').find('.card-body').next().removeClass('d-none');
        } else {
            $(v).closest('.card').find('.card-body').next().addClass('d-none')
        }
    })
    document.addEventListener('click',function(e){
        const popUp = e.target.closest('.popup');
        if(popUp){
            let change = (popUp.checked) ? 1 : 0;
            popUp.nextElementSibling.value = change;
        }
    })
    $(document).on('click', '.this-package', function() {
        packages.closest('.card').removeClass('selected');
        packages.closest('.card').find('input[name="package"]').prop('checked', false);
        keys = [];

        this.closest('.card').classList.add('selected');
        $(this).closest('.card').find('input[name="package"]').prop('checked', true);
        $(this).closest('.card').find('input[name^="key"]').map(function() {
            keys.push(this.value);
        })
        if (keys.indexOf('popup-contact') > -1 || keys.indexOf('popup-blog') > -1) {
            $('.special-service').removeClass('d-none');
        } else {
            $('.special-service').addClass('d-none');
        }
        if ($(this).find('label.form-check-label').html() != 'Gold') {
            $('.sms').addClass('d-none');
        } else {
            $('.sms').removeClass('d-none');
        }
    })
    $(document).on('click', '.more-package-detail', function() {
        $this = $(this);
        style = $this.closest('.card').find('.card-body').attr('style');
        if (style == undefined) {
            $this.closest('.card').find('.card-body').css({
                'max-height': `${maxHeight}px`,
                'overflow': 'hidden'
            });
        } else {
            $this.closest('.card').find('.card-body').removeAttr('style');
        }
        $this.children().toggleClass('fa-chevron-down fa-chevron-up')
    })
    $('.special-option').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).parent().next().children().prop('disabled', false);
        } else {
            $(this).parent().next().children().prop('disabled', true);
        }
    })
</script>
