<link href="slider/animate.min.css" rel="stylesheet" media="all">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


<div id="main-page-cover">
    <div class="bg-cover"></div>
    {{-- <div class="content mt-5 d-none" style="top: 80px; position: absolute; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="aos-init" data-aos="fade-down" data-aos-delay="100">
                        <div class="box-title">
                            <div>
                                <strong class="d-block mb-2">At-Once</strong><br>
                                <h5>เว็บไซต์รวบรวมรายชื่อบริษัทในประเทศไทยและทำการตลาดออนไลน์</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="content">
        <div class="my-4">
            <h1 class="d-flex justify-content-center align-items-center text-center">
                <b>@lang('phrase.caption')</b>
            </h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter">
                        <div class="card" style="border:1px solid #efefef; border-radius: 15px; box-shadow: 0px 2px 3px 1px rgb(207 207 207 / 35%); background-color: #f7f7f7;">
                            <div class="card-body p-3">
                                <h4 class="ml-2 font-weight-bold">@lang('phrase.search')@lang('phrase.companies') <strong style="color:#ff7700 ">@lang('phrase.free')</strong></h4>
                                <form action="{{ Session('lang') }}/search">
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-xs-12">
                                            <div class="form-group my-3">
                                                <div class="input-group">
                                                    <input type="text" name="keywords" id="keywords"
                                                        class="form-control"
                                                        placeholder="@lang('phrase.placeholder')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-12">
                                            <div class="input-group-append my-3">
                                                <button type="submit" class="input-group-text">
                                                    <i class="icofont-search-2 mr-2"></i>@lang('phrase.search')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include("$prefix.sponsor") --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
