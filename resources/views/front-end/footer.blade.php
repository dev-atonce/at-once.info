<a href="#" id="back-to-top" title="Back to top"><i class="icofont-thin-up"></i></a>


@php
$lang = Session('lang') ? Session('lang') : 'th';
$hbtn = @$categoryId == '' ? $lang : $lang . "/$module";
$condition_path = @$categoryId == '' ? 'condition' : "$module/condition";
$policy_path = @$categoryId == '' ? 'privacy-policy' : "$module/privacy-policy";
$blog_path = @$categoryId == '' ? $lang . '/blog' : $lang . "/$module/blog";
@endphp

@if (Request()->segment(3) == 'cp')
<section id="footer" @if (@$err === 404) style="bottom:0;width:100%;" @endif>
    <div class="container footer-cp">
        <div class="detail">
            <div class="row" style="align-items: center;">

                <style>
                    .btn-back{
                        padding: 8px 30px;
                        border-radius: 30px;
                        background-color: var(--v1-blue);
                        border: solid 1px var(--v1-blue);
                    }
                </style>
                <div class="col-4 col-md-6 col-lg-6 pr-1">
                    <ul class="sitemap mb-0">
                        <li class="list-item">
                            <a href="{{ url($lang) }}" target="_self" class="btn btn-back link link--primary" aria-label="กลับไปหน้าแรก">
                                <span class="link__title"><i class="icofont-arrow-left"></i> @lang('phrase.home')</span>
                            </a>
                        </li>
                        @if (@!$customerStatus)
                        <li class="list-item">
                            <a href="{{ url($lang) }}/about-us" target="_self" class="link link--primary" aria-label="เกี่ยวกับเรา">
                                <span class="link__title">@lang('phrase.header.about')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ $blog_path }}" target="_self" class="link link--primary" aria-label="บล็อก">
                                <span class="link__title">@lang('phrase.header.blog')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ url($lang) }}/news" target="_self" class="link link--primary" aria-label="ข่าวสาร">
                                <span class="link__title">@lang('phrase.header.news')</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-8 col-md-6 col-lg-6">
                    <div class="row @if (@!$customerStatus) '' @else justify-content-end @endif">
                        @if (@!$customerStatus)
                        <div class="col-12 col-md-12 col-lg-6 mb-3 mb-lg-0">
                            <a href="{{ url($lang) }}/category" class="btn btn-border d-block" aria-label="ค้นหาธุรกิจอื่นๆ"><i
                                class="icofont-search-2"></i> ค้นหาธุรกิจอื่นๆ</a>
                            </div>
                            @endif
                            <div class="col-12 col-md-12 col-lg-6">
                                <a href="{{ url($lang . '/promotion-package') }}" class="btn btn-orange d-block" aria-label="สนใจลงโฆษณากับเรา">
                                    <span class="link__title">สนใจลงโฆษณากับเรา</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 1px solid rgb(255 255 255 / 10%);">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <!-- <span>@lang('phrase.footer.copyright') {{ date('Y') }} {{ env('APP_NAME') }} | @lang('phrase.footer.reserved')</span> -->
                    <span> Copyright 2022 1-CE WIND CO., LTD. | All rights reserved.</span><a
                    href="http://www.trustmarkthai.com/callbackData/popup.php?data=9a2-18-6-253d529d70a8c51101033f0566fe7d4165dd1cfbbf4&markID=firstmar"
                    class="ml-2" aria-label="DBD Trust Mark"><img src="img/dbd-logo.svg" alt="DBD Trust Mark" loading="lazy" width="50" height="50"></a>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <ul class="list-menu">
                        <li class="list-item">
                        <a href="{{ url($lang) }}/{{ $condition_path }}" target="_self"
                        class="link link--primary" aria-label="ข้อกำหนดและเงื่อนไข">
                        <span class="link__title">ข้อกำหนดและเงื่อนไข</span>
                    </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ url($lang) }}/{{ $policy_path }}" target="_self"
                        class="link link--primary" aria-label="นโยบายความเป็นส่วนตัว">
                        <span class="link__title">นโยบายความเป็นส่วนตัว</span>
                    </a>
                </li>
                <!-- <a href="javascript:" onclick="destroy()">Clear</a> -->
            </ul>
        </div>
    </div>
</div>
</section>
@else
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="mb-1"><img src="img/at-once-tw.png" width="150" height="50" alt="{{ env('APP_NAME') }}" loading="lazy"></div>
            </div>
            <div class="col-md-5 col-lg-4">
                <p class="mb-0"><strong class="v1-orange" style="font-size: 24px;">At-Once </strong>- แอท วันซ์
                </p>
                <p> เพิ่มโอกาสในการขายสินค้าและบริการของคุณ <br class="d-none d-lg-block">
                ด้วย เครื่องมือและแผนการตลาดออนไลน์ โดยทีมงานมืออาชีพ</p>
            </div>
            <div class="d-md-none d-lg-block col-lg-1"></div>
            <div class="col-5 col-md-3 col-lg-2 pl-md-4">
                <ul class="sitemap mb-0 mb-lg-2">
                    <li class="list-item">
                        <a href="{{ url($lang) }}" target="_self" class="link link--primary" aria-label="หน้าแรก">
                            <span class="link__title">@lang('phrase.home')</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ url($lang) }}/about-us" target="_self" class="link link--primary" aria-label="เกี่ยวกับเรา">
                            <span class="link__title">@lang('phrase.header.about')</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ $blog_path }}" target="_self" class="link link--primary" aria-label="บล็อก">
                            <span class="link__title">@lang('phrase.header.blog')</span>
                        </a>
                    </li>
                    {{-- <li class="list-item">
                      <a href="{{url($lang)}}/news" target="_self" class="link link--primary">
                        <span class="link__title">@lang('phrase.header.news')</span>
                    </a>
                </li> --}}
                <li class="list-item">
                    <a href="{{ url($lang) }}/contact" class="link link--primary" aria-label="ติดต่อเรา">
                        <span class="link__title">@lang('phrase.footer.contact-us')</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-7 col-md-4 col-lg-3">
            <div class="vertical-table disp-p none-absolute">
                <div class="vertical-align-middle-xs">
                    <ul class="sitemap">
                        <li class="list-item">
                            <a href="{{ url($lang) }}#section-categories" class="btn btn-border d-block" aria-label="ค้นหาธุรกิจ"><i
                                class="icofont-search-2"></i> @lang('phrase.search-business')</a>
                            </li>
                        </ul>
                        <a href="{{ url($lang . '/promotion-package') }}#ContactForm" class="btn btn-orange mt-3 d-block" aria-label="ลงโฆษณา">
                            <span class="link__title">@lang('phrase.advertise')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border-top: 1px solid rgb(255 255 255 / 10%);">
        <div class="row">
            <div class="col-12 col-lg-6">
                {{-- <span>@lang('phrase.footer.copyright') {{date('Y')}} {{env('APP_NAME')}} | @lang('phrase.footer.reserved')</span> --}}

                <span> Copyright 2022 1-CE WIND CO., LTD. | All rights reserved.</span>
                <a href="http://www.trustmarkthai.com/callbackData/popup.php?data=9a2-18-6-253d529d70a8c51101033f0566fe7d4165dd1cfbbf4&markID=firstmar"
                class="ml-2" aria-label="DBD Trust Mark"><img src="img/dbd-logo.svg" alt="DBD Trust Mark" loading="lazy" width="50" height="50"></a>
            </div>

            <div class="col-12 col-lg-6">
                <ul class="list-menu">
                    <li class="list-item">
                    <a href="{{ url($lang) }}/{{ $condition_path }}" target="_self"
                    class="link link--primary" aria-label="ข้อกำหนดและเงื่อนไข">
                    <span class="link__title">@lang('phrase.footer.terms-conditions')</span>
                </a>
                </li>
                <li class="list-item">
                    <a href="{{ url($lang) }}/{{ $policy_path }}" target="_self"
                    class="link link--primary" aria-label="นโยบายความเป็นส่วนตัว">
                    <span class="link__title">@lang('phrase.footer.privacy-policy')</span>
                </a>
            </li>
            <!-- <a href="javascript:" onclick="destroy()">Clear</a> -->
        </ul>
    </div>
</div>
</div>
</section>

@endif

{{-- <section class="footer-cory">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <center>
          <h2 class="bold mb-1"><img src="img/at-once-tw.png" width="150"></h2> 
          <small>@lang('phrase.footer.copyright') {{date('Y')}} {{env('APP_NAME')}} | @lang('phrase.footer.reserved')</small><a href="javascript:" onclick="destroy()">Clear</a>
      </center>
  </div>
</div>
</div>
</section> --}}


<!-- Modal Conditions-->
<div class="modal fade" id="conditions-th" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold" id="exampleModalLabel">เงื่อนไขการให้บริการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                แม้ว่าเราจะดำเนินการตรวจสอบบริษัทจดทะเบียนของเราเอง แต่เราจะไม่รับผิดชอบต่อความเสียหายใดๆ
                ที่เกิดจากการทำธุรกรรมจริง เช่น คุณภาพของเนื้อหา บริการ และผลการดำเนินงานของแต่ละบริษัท
                โปรดจัดการเครดิตของคุณด้วยตัวเอง
                <br><br>
                เราใช้ความระมัดระวังเป็นอย่างยิ่งเมื่อโพสต์เนื้อหาบนไซต์นี้ แต่เราไม่รับประกันเนื้อหา
                โปรดตรวจสอบกับเจ้าหน้าที่ด้วยตนเองหากจำเป็น เนื้อหาอาจมีการเปลี่ยนแปลง
                หรือยกเลิกโดยไม่ต้องแจ้งให้ทราบล่วงหน้า


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="conditions-jp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bold" id="exampleModalLabel">利用規約</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                掲載されている企業に関しまして、独自の審査は実施しておりますが、各企業におけるサービスの質や履行有無について生じた損害等、一切免責とさせて頂きます。御自身で与信管理お願い致します。
                <br><br>
                当サイト内にありますコンテンツは、掲載時には細心の注意を払っておりますが、その内容については保証するものではありません。必要に応じて御自身で当局へご確認下さい。また内容は予告なく変更、取り消しする場合がございます。

            </div>
        </div>
    </div>
</div>
@php(\App\Helpers\Clicks::__index())
