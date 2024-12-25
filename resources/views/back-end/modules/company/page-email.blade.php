<style>
    [contenteditable="true"]{
        overflow-x: hidden;
        overflow-y: scroll;
        padding: 10px;
        height: calc(100vh - 374px);
    }
    [contenteditable="true"]:focus
    {
        color: #768192;
        background-color: #fff;
        border-color: #958bef;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgb(50 31 219 / 25%);
    }
    

    @media (min-width: 992px) { 
        .modal-full-screen{
            max-width: 100% !important;
            
        }
    }
    .modal-content,
    .modal-full-screen{
        height: 100%;
    }
    .modal-content{
        border-radius: unset !important;
    }
    .fbtn{
        display: inline-flex;
        align-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        flex-direction: column;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;

    }
    .fbtn.dropdown-toggle{
        color: #4f5d73 !important;
    }
    .fbtn:hover {
        color: #4f5d73;
        background-color: #d6dade;
        border-color: #cfd4d8;
    }
    .fbtn:focus, .fbtn.focus {
        box-shadow: 0 0 0 0.2rem rgb(212 215 220 / 50%);
    }
    .fbtn:focus{
        outline: none;
    }
    .he75{
        height: 75px
    }
    .border-left{
        border-left: 1px solid #dedede;
    }
    .fbtn-group{
        float: left;
        margin-right: 5px
    }
    .fbtn-group:not(:first-child){
        border-left: 1px solid #dedede;
        padding-left: 5px
    }
    .fbtn-group .frow{
        display: flex;
    }
    .fbtn-flex{
        display: flex !important;
        flex-wrap: wrap;
        flex-direction: row;
        align-items: flex-start;
    }
    .fbtn-flex .fbtn{
        margin: 0 4px 0 0;
    }
    .frow:not(:first-child){
        margin-top: 5px;
    }
    .frow .fbtn:not(:first-child){
        margin-left: 5px;
    }
    .fbtn-divider{
        border-left: 1px solid #dedede;
        margin-left: 5px;
    }
    .f-select:first-child{
        margin-right:5px;
    }
    .bullets.dropdown-toggle::after,
    .attach.dropdown-toggle::after{
        content: unset !important;

    }
    .list-group-item.active{
        color:#fff !important;
    }
    .btn i,
    .btn .c-icon {
        height: unset !important;
        margin: unset !important;
    }
    
    .im-image-grid {
        margin: 4px;
        display: inline-block;
        width: 100px;
        height: 100px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        border: 2px solid #AAA;
        opacity: 70;
        filter: alpha(opacity=7000);
        zoom: 1;
        vertical-align: middle;
        line-height: 100px;
        text-align: center;
        float: left;
    }
    .im-image-grid img {
        vertical-align: middle;
        max-height: 77px;
        max-width: 100px;
        margin-top: -24px;
    }
    .im-info {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: #AAA;
        color: #FFF;
        padding: 3px;
        opacity: 80;
        filter: alpha(opacity=8000);
        zoom: 1;
        line-height: normal;
    }
    .p-bottom{
        position: absolute;
        bottom: 15px;
        left: 0;
    }
    .im-image-grid:hover, .im-image-grid.im-checked {
        opacity: 100;
        filter: alpha(opacity=10000);
        zoom: 1;
        -webkit-box-shadow: 0 0 5px rgb(255 255 255 / 75%);
        -moz-box-shadow: 0 0 5px rgba(255,255,255,0.75);
        box-shadow: 0 0 5px rgb(255 255 255 / 75%);
    }
    .im-image-grid:hover, .im-image-grid.im-checked {
        border: 2px solid #007bff;
    }
    .im-image-grid.im-checked::after {
        font-family: "Font Awesome 5 Free";
        content: "\f058";
        color: #007bff;
        font-size: 17px;
        font-weight: bold;
        position: absolute;
        top: 3px;
        right: 3px;
        line-height: normal;
    }
    .im-tools {
        padding-top: 7px;
        padding-bottom: 7px;
        padding: 5px;
        border-bottom: 1px solid #dedede;
    }
    .picture-content {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        vertical-align: top;
        background: transparent;
        text-decoration: none;
        color: #000;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 14px;
        text-shadow: none;
        float: none;
        position: static;
        width: auto;
        height: auto;
        white-space: nowrap;
        cursor: inherit;
        -webkit-tap-highlight-color: transparent;
        line-height: normal;
        font-weight: normal;
        text-align: left;
        min-height: 470px;
        max-height: 480px;
    }
    .is-invalid{
        background-image: unset !important;
    }
    .ui-wrapper {
        display: inline-block;
        margin-right: 5px !important;
    }
    .ui-wrapper img {
        width: 10px;
        height: 10px;
        background-color: #ffffff;
        border: 1px solid #43a4c1;
        resize: both;
    }
    .ui-wrapper img{
        cursor: pointer;
    }
    .color-preview {
        display: block;
        position: absolute;
        background: gray;
        width: 13px;
        height: 2px;
        overflow: hidden;
    }
    

</style>
@php($created=date('Y-m-d_H:i:s'))
<link rel="stylesheet" href="plugin/jquery-ui-1.13.2/jquery-ui.css">
<div class="card">
    <div class="card-body">
        <div class="row"> 
            <div class="col-lg-12 mb-2">                
                @php($font = ['Angsana New','Angsana UPC','Arial','Browallia New','Browallia UPC','Cordia New','Cordia UPC','EucrosiaUPC','FreesiaUPC','Tahoma','TH SarabunPSK'])
                @php($fontSize = [8,9,10,11,12,14,18,20,22,24,26,28,36,48,72])
                <div class="fbtn-group">
                    <div class="frow">
                        <button class="fbtn undo btn-light" title="Undo"><i class="fas fa-undo-alt"></i><br>Undo</button>
                        <button class="fbtn redo btn-light" title="Redo"><i class="fas fa-redo-alt"></i><br>Redo</button>
                    </div>
                </div>
                <div class="fbtn-group">
                    <div class="frow">
                        <select name="font-family" class="custom-select custom-select-sm f-select">
                            <option value="">Font Family</option>
                            @for($i=0; $i<count($font); $i++)
                                <option value="{{$font[$i]}}">{{$font[$i]}}</option>
                            @endfor
                        </select>
                        <select name="font-size" class="custom-select custom-select-sm f-select ml-1">
                            <option value="">Font Size</option>
                            @for($i=0; $i<count($fontSize); $i++)
                                <option value="{{$fontSize[$i]}}">{{$fontSize[$i]}}</option>
                            @endfor
                        </select>     
                    </div>
                    <div class="frow">
                        <div class="dropdown ml-1">
                            <button class="fbtn font-color dropdown-toggle" type="button" id="dropdownColorPicker" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Font Color" style="display: flow-root;">
                                <i class="fas fa-font"></i>
                                <span class="color-preview" style="background-color: grey"></span>
                            </button>
                            <div class="dropdown-menu color-picker" aria-labelledby="dropdownColorPicker" style="padding:0;"></div>
                        </div>
                        
                        <button class="fbtn bold btn-light" style="display: flow-root;" title="Bold"><i class="fas fa-bold"></i></button>
                        <button class="fbtn italic btn-light" style="display: flow-root;" title="Italic"><i class="fas fa-italic"></i></button>
                        <button class="fbtn underline btn-light" style="display: flow-root;" title="Underline"><i class="fas fa-underline"></i></button>
                        <div class="fbtn-divider"></div>
                        <button class="fbtn align-left btn-light" style="display: flow-root;" title="Align left"><i class="fas fa-align-left"></i></button>
                        <button class="fbtn align-center btn-light" style="display: flow-root;" title="Align center"><i class="fas fa-align-center"></i></button>
                        <button class="fbtn align-right btn-light" style="display: flow-root;" title="Align right"><i class="fas fa-align-right"></i></button>
                        <div class="fbtn-divider"></div>
                        <button class="fbtn outdent btn-light" style="display: flow-root;" title="Text outdent"><i class="fas fa-outdent"></i></button>
                        <button class="fbtn indent btn-light" style="display: flow-root;" title="Text indent"><i class="fas fa-indent"></i></button>
                        {{-- <button class="fbtn bullets btn-light" title="bullets"><i class="fas fa-list"></i></button> --}}
                        <div class="dropdown ml-1">
                            <button class="fbtn bullets dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flow-root;"><i class="fas fa-list"></i></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item bullet" href="javascript:" bullet="disc">Default</a>
                              <a class="dropdown-item bullet" href="javascript:" bullet="circle">Circle</a>
                              <a class="dropdown-item bullet" href="javascript:" bullet="square">Square</a>
                              <a class="dropdown-item bullet" href="javascript:" bullet="number">Number</a>
                            </div>
                        </div>
                        {{-- <div class="fbtn-divider"></div> --}}
                        {{-- <button class="fbtn remove-style btn-outline-warning" title="Remove style" style="display: flow-root;"><i class="fas fa-remove-format"></i></button> --}}
                    </div>
                </div>
                <div class="fbtn-group">
                    <div class="frow">
                        {{-- <button class="fbtn btn-light attach" title="Attach files"><i class="fas fa-paperclip"></i><br>Attach file</button> --}}
                        <div class="dropdown ml-1">
                            <button class="fbtn attach dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-paperclip"></i><br>Attach file
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item attach-choose-file" href="javascript:">Choose file</a>
                              <a class="dropdown-item attach-new-upload" href="javascript:">New upload</a>
                            </div>
                          </div>
                        <button class="fbtn btn-light link" title="Hyperlink"><i class="fas fa-globe"></i><br>Link</button>
                        <button class="fbtn btn-light pictures" title="Pictures"><i class="far fa-image"></i><br>Pictures</button>
                    </div>
                </div>
{{--          
                @if(Request::get('company'))
                    <div class="position-absolute" style="right:15px;">
                        <strong style="font-size:16px;">บริษัท {{Request::get('company')}}</strong>
                    </div>
                @endif --}}
              
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 pb-3">
                <button class="btn btn-outline-primary btn-send-email btn-block mt-0" style="height: 100%"><i class="far fa-paper-plane fa-lg"></i> Send</button>
            </div>
            <div class="col-lg-11 pl-0">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend" style="min-width:70px;">
                                <span class="input-group-text" style="width:100%">From</span>
                            </div>
                            <select name="from" class="custom-select" id="inputGroupSelect01">
                                <option value="" selected>Choose...</option>
                                <option value="account@at-once.info">account@at-once.info</option>
                                <option value="account2@at-once.info">account2@at-once.info</option>
                                <option value="cs@at-once.info" @if(Auth::user()->name == 'CHANYA') selected @endif>cs@at-once.info (Chanya)</option>
                                <option value="cs2@at-once.info">cs2@at-once.info</option>
                                <option value="cs3@at-once.info">cs3@at-once.info</option>
                                <option value="cs4@at-once.info">cs4@at-once.info</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend" style="min-width:70px;">
                                <span class="input-group-text" style="width:100%">To...</span>
                            </div>
                            <input type="text" name="to" class="form-control" value="{{Request::get('email')}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend" style="min-width:70px;">
                                <span class="input-group-text" style="width:100%">Cc...</span>
                            </div>
                            <input type="text" name="cc" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend" style="min-width:70px;">
                                <span class="input-group-text" style="width:100%">Subject</span>
                            </div>
                            <input type="text" name="subject" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row row-attached d-none">
                    <div class="col-lg-12 col-xs-12">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend" style="min-width:70px;">
                                <span class="input-group-text" style="width:100%">attacthed</span>
                            </div>
                            <label class="form-control" id="attach_preview"></label>
                            <input type="file" name="attach" class="d-none" accept="image/png, image/jpg, image/gif, image/webp, application/pdf ">
                        </div>
                    </div>
                    <input type="hidden" name="company" value="{{Request::get('id')}}">
                    <input type="hidden" name="created" value="{{$created}}">
                </div>            
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="border rounded" contenteditable="true" id="editor" style="min-height: 300px;">
                            {{--  --}}
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">เรียน คุณ.....และผู้ที่เกี่ยวข้อง,</p>
                                <p><br></p>

                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    สวัสดีค่ะ ดาวขอนำส่งเอกสาร “ขออนุญาตใช้ข้อมูล”
                                    ของทาง {{$row->name_th}}
                                    มาให้ตามไฟล์แนบค่ะ
                                </p>                                
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    Link ด้านล่างคือหน้าเว็บที่ทางเราใช้ online ข้อมูลทั้งหมดทางเราอ้างอิงมาจากหน้าเว็บไซต์ของทางบริษัท นาซ่า
                                    ทรานสปอร์ต คอร์ปอเรชั่น จำกัด ค่ะ
                                </p>                                
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    ทางเราทำการ เปิด Online ในหน้าเว็บไซต์เพื่อให้ทาง
                                    {{$row->name_th}} ทำการตรวจสอบ ข้อมูล
                                    หากต้องการเปลี่ยนแปลงข้อมูลสามารถแจ้งกลับ เพื่อทำการแก้ไขให้ได้เลยนะคะ<br>
                                </p>
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    <a href="https://www.at-once.info/my/service/email/read?id={{Request::get('id')}}&created={{$created}}&re={{url('th')}}/{{$row->categoryName}}/cp/{{$row->profile_url}}">
                                        {{$row->name_th}} - At Once (at-once.info)
                                    </a>
                                </p>
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    หากเซ็นเอกสารเรียบร้อยแล้ว สามารถตอบกลับผ่านทางอีเมลนี้ได้เลยนะคะ
                                </p>
                                <p><br></p>
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    ในขณะนี้ทางเว็บไซต์ <a href="https://www.at-once.info/my/service/email/read?id={{Request::get('id')}}&created={{$created}}&re=http://www.at-once.info/th">www.at-once.info</a>
                                    &nbsp;กำลังรวบรวมรายชื่อบริษัทโลจิสติกส์ในไทย เข้าสู่เว็บไซต์
                                    เพื่อทำการโปรโมทบริษัทให้&nbsp;<b>ซึ่งทางเราไม่ได้เก็บค่าบริการใดๆ</b>
                                </p>                                
                                <p style="font-size:14.0pt;font-family:TH SarabunPSK,sans-serif; color:black">
                                    เพื่อเป็นการสนับสนุนการทำธุรกิจแบบ B2B ให้ทางบริษัทของคุณและลูกค้าที่ใช้งานในหน้าเว็บไซต์เรา ได้เข้าถึงกันได้อย่างง่ายและรวดเร็ว
                                </p>                                
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif;  color:black">
                                    ในอนาคตหากทางเรามีบริการเพิ่มเติม ทางเราขออนุญาตติดต่ออีกครั้งนะคะ
                                </p>
                                
                                <p style="font-size:14.0pt;font-family: TH SarabunPSK ,sans-serif; color:black">
                                    และหากบริษัทต้องการข้อมูลเพิ่มเติมสามารถแจ้งกลับได้เลยค่ะ
                                </p>
                                <p style="font-size:14.0pt;font-family:TH SarabunPSK, sans-serif; color:black">
                                    <a href="https://www.at-once.info/my/service/email/read?id={{Request::get('id')}}&created={{$created}}&re=https://www.at-once.info/th/promotion-package">
                                        <b>&gt;&gt;&gt;&gt; </b>
                                        <b>สนใจรายละเอียดโปรโมชั่น เพิ่มเติม คลิ๊ก !!</b>&nbsp; 
                                        <b>&lt;&lt;&lt;&lt;</b>
                                    </a>
                                </p>
                                <p><br></p>
                                <p style="font-size:14.0pt;font-family:TH SarabunPSK, sans-serif; color:black">
                                    <b>** หมายเหตุ **</b>
                                </p>
                                <p style="font-size:14.0pt;font-family:TH SarabunPSK, sans-serif; color:black">
                                    <b>หากท่านยังไม่สะดวกเซ็นเอกสารกลับ </b>
                                </p>
                                <p style="font-size:14.0pt;font-family:TH SarabunPSK, sans-serif; color:black">
                                    <b>ทางเราขออนุญาตออนไลน์โปรไฟล์บริษัทฯของท่านบนหน้าเว็บไซต์ </b>
                                    <a href="https://www.at-once.info/my/service/email/read?id={{Request::get('id')}}&created={{$created}}&re=http://www.at-once.info/"><b>www.at-once.info</b></a>
                                    <b> จนกว่าทางเราจะได้รับการตอบกลับ “เอกสารขออนุญาตใช้ข้อมูล”
                                เพื่อให้ทางบริษัทฯ ได้สามารถทำการตรวจสอบข้อมูลที่ทางเราอ้างอิงมานะคะ</b>&nbsp;
                                </p>
                                <br>
                                <p>
                                    <img src="email/picture/pro1.jpg" title="pro1.jpg">&nbsp;&nbsp;
                                    <img src="email/picture/pro2.jpg" title="pro2.jpg">
                                </p>
                                <p>If you have any question, Please
                                feel free contact us.</p>
                                
                                <p>Best regards.</p>                                
                                <p>Suchanya (Dao)</p>                                
                                <p>
                                    E : <a href="mailto:cs@at-once.info">cs@at-once.info</a><br>
                                    M : +66(0)94-567-5563
                                </p>                                
                                <p>1-CE WIND CO., LTD.<br>
                                    <img src="email/picture/logo.png" title="logo.png">
                                </p>
                            {{--  --}}
                     
                        </div>
                    </div>
                </div>
            <input type="hidden" name="content">
        </div>
        
    </div>
</div>

<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row image-url-form d-none">
                    <div class="col-lg-12">
                        <label for="">Source :</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Url" name="source">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary image-search" type="button">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </div>
                          </div>
                    </div>
                    <div class="col-12">
                        <hr/>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-link-dismiss">Cancel</button>
                            <button type="button" class="btn btn-warning btn-link-save">Save change</button>
                        </div>
                    </div>
                </div>
                <div class="row link-form d-none">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Link</label>
                            <textarea name="hyperlink" class="form-control" ></textarea>
                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="linkto">
                                <input type="checkbox" name="linkto" id="linkto"> Link for recipients to read</label>
                            <p class="d-none">https://www.at-once.info/my/service/email/read?id={{Request::get('id')}}&created={{$created}}<p>
                            </div>
                            
                    </div>
                    <div class="col-12">
                        <hr/>
                        <div class="float-left">
                            <button class="btn btn-danger btn-unlink">Unlink</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-link-dismiss">Cancel</button>
                            <button type="button" class="btn btn-warning btn-link-save">Save change</button>
                        </div>
                    </div>
                </div>
                <div class="row attach-form d-none">
                    <div class="col-12 attach-files-content"></div>
                    <div class="col-12">
                        <hr/>
                        <div class="float-left">
                            <button class="btn btn-light btn-attach-refresh">Refresh</button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-attach-dismiss">Cancel</button>
                            <button type="button" class="btn btn-warning btn-attach-select">Select</button>
                        </div>
                    </div>
                </div>
                <div class="row picture-form d-none">
                    <div class="col-lg-12">
                        <div class="im-tools">
                            <button class="btn btn-sm btn-outline-dark btn-picture-refresh text-left"><i class="fas fa-sync-alt fa-lg"></i>&nbsp;Refresh</button>
                            <button class="btn btn-sm btn-outline-danger btn-picture-trash float-right" disabled><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="picture-content"></div>
                    </div>
                    <div class="col-lg-12 p-bottom">
                        <hr/>
                        <div class="float-left">
                            <button class="btn btn-outline-primary btn-picture-upload">Upload<input type="file" name="picture-upload" multiple="" accept="image/png, image/jpg, image/jpeg, image/webp, image/png" style="display:none;"></button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-picture-dismiss">Cancel</button>
                            <button type="button" class="btn btn-warning btn-picture-select">Select</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="plugin/sweetalert2/sweetalert2.js"></script>
<script src="plugin/jquery-ui-1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
<script>
    var box = $('div[contenteditable="true"]');
    var tab = null;
    var linkClone =  null;

    var convertStyleToObject = (string) => {
        var array = [];
        var obj = {}
        console.log(string);
        array = string.split(';');
        var filtered = array.filter(function (el) {
            return el != '';
        });
        for(let i=0; i<filtered.length; i++){
            let a = filtered[i].split(':'); obj[a[0].trim()] = a[1];
        };
        return obj;
    }

    var checkKeyOfObject = (obj,key) => {
        var c = obj.key;
        return c == undefined ? false : true ;
    }
    var toStlyeText = (e) => {
        let text = '';
        $.each(e,function(k,v){
            text += k+': '+v+'; ';
        });
        return text.trim();
    }

    function getSelected() {
        if(window.getSelection) { return window.getSelection(); }
        else if(document.getSelection) { return document.getSelection(); }
        else {
            var selection = document.selection && document.selection.createRange();
            if(selection.text) { return selection.text; }
            console.log(selection);
            return false;
        }
        return false;
    }

    function expand(range) {
        if (range.collapsed) {
            return;
        }

        while (range.toString()[0].match(/\w/)) {
            range.setStart(range.startContainer, range.startOffset - 1);   
        }

        while (range.toString()[range.toString().length - 1].match(/\w/)) {
            range.setEnd(range.endContainer, range.endOffset + 1);
        }
    }


    var addLink = () => {
        let sText = document.getSelection();
        const re = $('textarea[name="hyperlink"]').val();
        const link = $('#linkto').is(':checked') ? $('#linkto').parent().next().html():'';
        link = link.replace('&amp;','&');

        const newLink = link!='' ? link+'&re='+re : re ;
        
    }
    var TextIndent = (e) => {

        var selection = document.getSelection();
        var newEl = document.createElement('div');
        for(let i = 0; i < selection.rangeCount; i++)
        {
            var range = window.getSelection().getRangeAt(i);
            var fragment = range.cloneContents();
            newEl.appendChild(fragment.cloneNode(true));
        }
        let current = $(selection.focusNode.parentElement);
        if( $(newEl).children().length == 0 )
        {
            tag = selection.anchorNode.parentElement.nodeName;
            if(tag=="P")
            {
                const style = $(selection.anchorNode.parentElement).attr('style');
                const ar = style == undefined ? {} : styleToJSON(style);
                let n = stepUp40(ar['text-indent']);
                ar['text-indent'] = n+'px';

                if(selection.type == 'Caret'){
                    $(selection.anchorNode.parentElement).css({...ar});
                }else{
                    $(selection.anchorNode.parentElement).removeAttr('style');
                    $(selection.anchorNode.parentElement).css({...ar});
                }
            } 
            else if(tag=='A'){
                const style = $(selection.anchorNode.parentElement).closest('p').attr('style');
                const ar = style == undefined ? {} : styleToJSON(style);
                let n = stepUp40(ar['text-indent']);
                ar['text-indent'] = n+'px';

                if(selection.type == 'Caret'){
                    $(selection.anchorNode.parentElement).css({...ar});
                }else{
                    $(selection.anchorNode.parentElement).css({...ar});
                    $(selection.anchorNode.parentElement).removeAttr('style');;
                }
            }else{
                var pTag = $('<p/>', {  'text': selection }).css('text-indent','20px').prop('outerHTML');
                document.execCommand('insertHTML', false, pTag);
            }
        }else{
            for(let i=0; i<$(newEl).children().length; i++)
            {
                const style = $(current).attr('style');
                const ar = style == undefined ? {} : styleToJSON(style);
                let n = stepUp40(ar['text-indent']);           
                ar['text-indent'] = n+'px';
                $(current).removeAttr('style');
                $(current).css({...ar});
                current = current.next(); 
            }
        }        
    }

    var TextOutdent = () => {
        var selection = document.getSelection();
        var newEl = document.createElement('div');
        for (let i = 0; i < selection.rangeCount; i++)
        {
            var range = window.getSelection().getRangeAt(i);
            var text = window.getSelection();
            var fragment = range.cloneContents();
            newEl.appendChild(fragment.cloneNode(true));
        }
        let current = $(selection.focusNode.parentElement);
        if( $(newEl).children().length == 0 )
        {
            tag = selection.anchorNode.parentElement.nodeName;
            if(tag == 'P'){
                const style = $(selection.anchorNode.parentElement).attr('style');
                const ar = style == undefined ? {} : styleToJSON(style);
                let n = stepDown40(ar['text-indent']);
                if(n==0){ 
                    delete ar['text-indent'];
                }else{ 
                    ar['text-indent'] = n+'px';
                }
                $(selection.anchorNode.parentElement).removeAttr('style');
                $(selection.anchorNode.parentElement).css({...ar});
            }
            else if(tag == 'A'){
                const style = $(selection.anchorNode.parentElement).closest('p').attr('style');
                const ar = style == undefined ? {} : styleToJSON(style);
                let n = stepDown40(ar['text-indent']);
                if(n==0){ 
                    delete ar['text-indent'];
                }else{ 
                    ar['text-indent'] = n+'px';
                }
                $(selection.anchorNode.parentElement).closest('p').removeAttr('style');
                $(selection.anchorNode.parentElement).closest('p').css({...ar});
            }
            else {
                var pTag = $('<p/>', {  'text': selection }).prop('outerHTML');
                document.execCommand('insertHTML', false, pTag);
            }
        }else{
            for(let i=0; i<$(newEl).children().length; i++){
                const style = $(current).attr('style');
                const ar = style == undefined ? {} : styleToJSON(style);
                let n = stepDown40(ar['text-indent']);
                if(n==0){ 
                    delete ar['text-indent'];
                }else{ 
                    ar['text-indent'] = n+'px';
                }
                $(current).removeAttr('style');
                $(current).css({...ar});

                current = current.next(); 
            }

        }
    }
    var stepUp40 = (string) => {
        let search = string== undefined ? 0 :string.replace('px','');
        const number = Number(search);
        if(number==0){
            return 40;
        }else{
            return number + 40;
        }
    }
    var stepDown40 = (string) => {
        let search = string== undefined ? 0 : string.replace('px','');
        const number = Number(search);
        return (number == 0) ? 0 : number - 40;        
    }
    var fontFamily = function(font) {
        var curSelect = document.getSelection();
        tag = curSelect.anchorNode.parentElement.nodeName;

        if(tag=="P" || tag=='A'){
            const style = $(curSelect.anchorNode.parentElement).attr('style');
            const ar = style == undefined ? {} : styleToJSON(style);
            ar['font-family'] = font;         
            $(curSelect.anchorNode.parentElement).css({...ar});
        }else{
            var pTag = $('<p/>', {  'text': curSelect }).css('font-family', font).prop('outerHTML');
            document.execCommand('insertHTML', false, pTag);
        }
    }
    var fontSize = function (size, unit) {
        var curSelect = document.getSelection();      
        tag = curSelect.anchorNode.parentElement.nodeName;
        const style = $(curSelect.anchorNode.parentElement).attr('style');
        const ar = style == undefined ? {} : styleToJSON(style);

        if(tag=="P" || tag=='A'){
            ar['font-size'] = size + unit;         
            $(curSelect.anchorNode.parentElement).css({...ar});
        }else{
            document.execCommand('insertHTML', false, pString);
            var pString = $('<p/>', {
                'text': curSelect
            }).css('font-size', size + unit).prop('outerHTML');
        }
    };

    var styleToJSON = (string) => {
        string = string.trim();
        // string = string.replace(';',"");
        const arr = string.split(';');
        var filtered = arr.filter(elm => elm);
        const res = [];
        Array.from(filtered).map((val,key) => {
            v = val.replace('"','');
            v = v.replace('"','');
            sub = v.split(':');       
            res[sub[0].trim()] = sub[1].trim();
        })
        return res;
    }
    var editLink = (e) => {
        curr = $(e);
        var re = $('#modal').find('textarea[name="hyperlink"]').val();
        // newLink = '';
        // $(document).on('change','input[name="linkto"]',function(){
        //     let link = $('textarea[name="hyperlink"]').val();
        //     link = link.split('re=');
        //     if($(this).is(':checked'){ newLink = link[1]; }
        // });

        let link = $('#modal').find('#linkto').is(':checked') === true ? $('#modal').find('#linkto').parent().next().html() : '' ;
        link = link.replace('&amp;','&');
        link = link.replace('&amp;','&');

        var newLink = link=='' ? re : link + '&re=' + re;
    
        curr.attr({
            'href': newLink,
            'target': '_blank',
            'title': $('#modal').find('textarea[name="hyperlink"]').val(),
            'back': link
        }); 
       
    }
    var attachPath = () => {
        $('#modal').find('.attach-form').removeClass('d-none');
        $('#modal').find('.modal-title').html('Choose file');
        $('#modal').modal({show:true,keyboard:false,backdrop:'static'});
        $.ajax({
            method:'get',
            url:'webpanel/company/send-email/attach-paht',
            success:function(res){
                $('.attach-files-content').html('');
                listGroup = $('<div class="list-group" />');
                Array.from(res).map((v,k)=>{
                    let item = $('<a />');
                    item.addClass('list-group-item list-group-item-action');
                    item.attr('url',v);
                    item.attr('title',v.replace('email/attach/',''));
                    item.html(v.replace('email/attach/',''));
                    listGroup.append(item);
                })

                if(res.length>0)
                    $('.attach-files-content').append(listGroup);
                else
                    $('.attach-files-content').html('<p>No file.</p>');
            },
            error:function(err){
                console.log(err.responseJSON);
            }

        });
    }
    var picturesPath = () => {
        $('#modal').find('.pictures-form').removeClass('d-none');
        $('#modal').find('.modal-title').html('Choose picture');
        $('#modal').modal({show:true,keyboard:false,backdrop:'static'});
        $.ajax({
            method: 'get',
            url: 'webpanel/company/send-email/picture-path',
            success:function(res){
                $('.picture-content').html('');
                Array.from(res).map((v,k)=>{
                    let item = $('<div />');
                    item.addClass('im-image-grid');
                    let img = $('<img/>');
                    let name = v.replace('email/picture/','');
                    img.attr({'src':v,'title':name});
                    item.append(img);
                    item.append('<div class="im-info" title="'+name+'">'+name+'</div>');
                    $('.picture-content').append(item);
                });
                if(res.length==0) $('.picture-content').html('<p>No file.</p>');
            },
            error:function(err){
                console.log(err.responseJSON);
            }
        })
    }
    function formHide()
    {
        $('#modal').modal('hide');
        $('#modal').find('.attach-form').addClass('d-none');
        $('#modal').find('.link-form').addClass('d-none');
        $('#modal').find('.picture-form').addClass('d-none');
        $('#modal').find('.image-url-form').addClass('d-none');
    }

    $('.fbtn.undo').click(function(){document.getSelection();document.execCommand("undo",false,null)});
    $('.fbtn.redo').click(function(){document.getSelection();document.execCommand("redo",false,null)});
    $(document).on('click','.link',function(e){
        formHide();
        current = null;
        sText = document.getSelection();

        if(sText.baseNode.nodeName=='#text' && sText!=''){

            if($(sText.anchorNode?.parentNode).attr('href')==undefined){

                document.execCommand('insertHTML', false, '<a href="https://www.example.com" target="_self" title="" back="">' + sText + '</a>')
            }
            
            current = sText.anchorNode?.parentNode;
            $('#modal').find('textarea[name="hyperlink"]').val($(sText.anchorNode?.parentNode).attr('href'))
            $('#modal').modal({show:true,keyboard:false,backdrop:'static'});
            $('#modal').find('.modal-title').html('Link');
            $('#modal').find('.link-form').removeClass('d-none');
            tab = 'link-form';
            $(document).on('click','button.btn-link-save',function(){
                editLink(current); 
                current = null;
                formHide()
            });
            $(document).on('click','button.btn-unlink',function(){
                text = $(current).html();
                $(current).replaceWith(text);
                formHide()
            });
            $(document).on('click','button.btn-link-dismiss',function(){    
                formHide()
                Modal.find('textarea[name="hyperlink"]').val('');
                Modal.find('#linkto').prop('checked',false);
            });       

        }else{
            current = sText.anchorNode?.parentNode;
            $('#modal').modal({show:true,keyboard:false,backdrop:'static'});
            $(document).on('click','button.btn-link-save',function(){
                editLink(current);
                current = null;
            });
        }        
    })
    AColorPicker.from('.color-picker').on('change', (picker, color) => {
        $('.color-preview').css('background-color',color);
        let curSelect = document.getSelection();
        tag = curSelect.anchorNode.parentElement.nodeName;
        // if(tag=='P'){
            const style = $(curSelect.anchorNode.parentElement).attr('style');
            const ar = style == undefined ? {} : styleToJSON(style);
            ar['color'] = color;
            $(curSelect.anchorNode.parentElement).removeAttr('style');
            $(curSelect.anchorNode.parentElement).css({...ar});
        // }
        // document.body.style.backgroundColor = color;
    })
    $('.fbtn.bold').click(function(){
        document.getSelection();
        document.execCommand("bold",false,null);
    });
    $('.fbtn.underline').click(function(){
        document.getSelection();
        document.execCommand("underline",false,null);
    });
    $('.fbtn.italic').click(function(){
        document.getSelection();
        document.execCommand("italic",false,null);
    });
    $('.fbtn.align-left').click(function(){
        document.getSelection();
        document.execCommand('justifyLeft',false,null);
    });
    $('.fbtn.align-center').click(function(){
        document.getSelection();
        document.execCommand('justifyCenter',false,null);
    });
    $('.fbtn.align-right').click(function(){
        document.getSelection();
        document.execCommand('justifyRight',false,null);
    });
    $('.fbtn.indent').click(function(){
        TextIndent() 
    });
    $('.fbtn.outdent').click(function(){
        TextOutdent() 
        // document.getSelection();
        // document.execCommand('outdent',false,null);
    });

    $('.dropdown-item.bullet').click(function(){
        if($(this).attr('bullet')=='number'){
            document.getSelection();
            document.execCommand('insertOrderedList',false,null)
        }else{
            const select = document.getSelection();
            // console.log($(select.baseNode.parentNode).closest('ul'))
            if($(select.baseNode.parentNode).closest('ul').length>0){
                $(select.baseNode.parentNode).closest('ul').css('list-style-type',$(this).attr('bullet'));
            }else{
                document.execCommand('insertUnorderedList',false,null);
                $(select.baseNode.parentNode).closest('ul').css('list-style-type',$(this).attr('bullet'));
            }
        }
    });

    

    $(document).on('change','#linkto',function(){

        if($(this).is(':checked')){
            $(this).parent().next().removeClass('d-none');
        }else{
            $(this).parent().next().addClass('d-none');
        }
    })
    $(document).on('change','textarea[name="link"]',function(){
        if($('#linkto').is(':checked')){
            $('#linkto').parent().next().html()
        }
    })
    $(document).on('change','select[name="font-family"]',function(){
        fontFamily($(this).val(),'px');
    });
    $(document).on('change','select[name="font-size"]',function(){
        fontSize($(this).val(),'px');
    });
    $(document).on('click','button.remove-style',function(){
        document.getSelection();
        document.getSelection('removeFormat',false, "");
    })
    $('.attach-new-upload').click(function(){
        var input = $('input[name="attach"]');
        input.click();
    });
    $('input[name="attach"]').on('change',function(){
        var $this = $(this);
        var input = $(this)[0];
        if (input.files && input.files[0]){
            var fd = new FormData();
            var files = $(this)[0].files[0];
                fd.append('_token','{{csrf_token()}}')
                fd.append('file', files);
                $.ajax({
                    url: 'webpanel/company/send-email/attach-file',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(res){
                        if(res?.url){ 
                            $('.row-attached').removeClass('d-none');
                            $('#attach_preview').html(res?.url);
                        }
                        else{
                            alert('file not uploaded');
                        }
                    },
                    error:function(err){
                        console.log('Error: ' + err.status)
                    }
                });

            $('#attach_preview').html();
        }
    });
    $(document).on('click','.attach-choose-file',function(){
        attachPath();
    });
    $(document).on('click','a.list-group-item',function(){
        $(this).addClass('active');
        $('.list-group-item').not(this).removeClass('active');
    })
    $(document).on('click','.btn-attach-select',function(){
        const itemSelect = {};
        const removeBtn = $('<div class="input-group-append"><button class="btn btn-outline-danger btn-attach-remove" type="button" ><i class="fas fa-times"></i></button></div>');
        $('.list-group-item').map(function(){
            if($(this).hasClass('active')){
                itemSelect.url = $(this).attr('url');
                itemSelect.name = $(this).html();
            }
        });
        if(itemSelect?.url!=''){
            const attached = $('#attach_preview');
            attached.html(itemSelect.name);
            if(attached.closest('.input-group').find('.btn-attach-remove').length== 0) attached.closest('.input-group').append(removeBtn);
            $('.row-attached').removeClass('d-none');
            formHide()
        }
    });
    $(document).on('click','.btn-attach-remove',function(){
        const attached = $('#attach_preview');
        attached.html('');
        $(this).parent().remove();
        $('.row-attached').addClass('d-none');
    })
    $('.btn-attach-refresh').click(function(){attachPath()});
    $(document).on('click','.btn-attach-dismiss',function(){formHide()});
    $(document).on('click','button.pictures',function(){
        pictureForm()
        $(document).on('click','.im-image-grid',function(){
            // $('.im-image-grid').not(this).removeClass('im-checked');
            if(!$(this).hasClass('im-checked')) $(this).addClass('im-checked');
            else $(this).removeClass('im-checked');
    
            if($('.im-checked').length>0) $('.btn-picture-trash').prop('disabled',false);
            else $('.btn-picture-trash').prop('disabled',true);
            
        });
        $(document).on('click','.btn-picture-select',function(){
        const select = document.getSelection();

        let b = $(select.anchorNode).closest('div[contenteditable="true"]');
        images = [];
        $.each($('.im-checked'),function(i,el){
            images.push($(el).find('img').attr('src'));
        });
        if(images.length>0){
            let img = '';
            for(let i = 0; i<images.length; i++){
                img += '<img src="'+images[i]+'" title="'+images[i].replace('email/picture/','')+'" />';
            }
            if(b.hasClass('rounded')){
                document.execCommand( "insertHTML", false, img);    
            }else{         
                box.append($(img));
            }

        }
        $('div[contenteditable="true"]').find('img').resizable({
            aspectRatio:true,
            handles: 'n, e, s, w, ne, se, sw, nw'
            
        });
        formHide();
    })
    })
    function pictureForm(){
        formHide();
        $('#modal').find('.picture-form').removeClass('d-none');
        $('#modal').find('.modal-title').html('Pictures');
        $('#modal').modal({show:true,keyboard:false,backdrop:'static'});
        picturesPath();
    }
    $(document).on('click','.btn-picture-trash',function(){
        data = [];
        $.each($('.im-checked'), function(key, el){ data.push($(el).find('img').attr('src')) });
        if(data.length>0){
            $.ajax({
                url:'webpanel/company/send-email/delete-picture',
                method:"post",
                data:{
                    _token:'{{csrf_token()}}',
                    _method:'DELETE',
                    'images[]':data
                },
                success:function(){ picturesPath() },
                error:function(err){ console.log(err.status) }
            })
            $(this).prop('disabled',true);
        }
    })
    $(document).on('click','.btn-picture-refresh',function(){picturesPath()});
    $(document).on('click','.btn-picture-upload',function(){$('input[name="picture-upload"]')[0].click()})
    $('input[name="picture-upload"]').on('change',function(){
        var input = $(this)[0];
        if (input.files && input.files[0]){
            var fd = new FormData();
            fd.append('_token','{{csrf_token()}}')
            $.each($(this)[0].files,function(i,file){fd.append('file[]',file)});
            $.ajax({
                url:'webpanel/company/send-email/picture-upload',
                method:'post',
                data:fd,
                cache:false,
                contentType:false,
                processData:false,
                success:function(res){ picturesPath() },
                error:function(err){ console.log('Error: ' + err.status) }         
            });
        }
    })


    $(document).on('click','.btn-picture-dismiss',function(){formHide()});
    $('button[data-dismiss="modal"]').on('click',function(){formHide()});
    $(document).on('hidden.bs.modal','#modal',function(){formHide()});

    function ObjectLength( object ) {
        var length = 0;
        for( var key in object ) {
            if( object.hasOwnProperty(key) ) {
                ++length;
            }
        }
        return length;
    };

    $('button.btn-send-email').on('click',function(){
        var url_prefix = window.location.href;
        var fd = new FormData();
        let errors = {};
        errors.from = $('select[name="from"]').val() == '' ? 'required' : null;
        errors.to = $('input[name="to"]').val() == '' ? 'required' : null;
        errors.subject = $('input[name="subject"]').val() == '' ? 'required': null;
        
        $.each(errors, (k,v) => {
            $('input[name="'+k+'"]').on('keyup keydown',function(){
                if($(this).val()!=''){
                    $(this).removeClass('is-invalid');
                    delete errors[k];
                }else{
                    $(this).addClass('is-invalid');
                    errors[k] = 'required';
                }
            });
            if (v!=null){ 
                if(k=='from') $('select[name="'+k+'"]').addClass('is-invalid');
                else $('input[name="'+k+'"]').addClass('is-invalid');
            }else{ 
                if(k=='from') $('select[name="'+k+'"]').removeClass('is-invalid');
                else $('input[name="'+k+'"]').removeClass('is-invalid'); 
                delete errors[k];
            }
        })
        if(ObjectLength(errors)==0){;
            let created = $('input[name="created"]').val();
            var URL = window.location;
            const baseUrl = URL.protocol+'//'+URL.hostname+'/';
            created = created.replace('_',' ');
            fd.append('_token','{{csrf_token()}}');
            fd.append('from',$('select[name="from"]').val());
            fd.append('to',$('input[name="to"]').val());
            fd.append('company',$('input[name="company"]').val());
            fd.append('created',created);
            if($('input[name="attach"]').val()!=''){
                fd.append('attach',$('input[name="attach"]').val());
            }
            if($('input[name="cc"]').val()!=''){
                fd.append('cc',$('input[name="cc"]').val());
            }
            fd.append('subject',$('input[name="subject"]').val());
            $.each($('div[contenteditable="true"]').find('img'),function(k,el){
                let src = $(el).attr('src');
                $(el).attr('src',baseUrl+src.replace(baseUrl,''));
            })

            fd.append('content',$('div[contenteditable="true"]').html());
            $.ajax({
                url:'webpanel/company/send-email',
                method:'post',
                data:fd,
                cache:false,
                contentType:false,
                processData:false,
                success:function(res){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Email has been sent.'
                    })
                },
                error:function(err){           
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops..',
                        text: 'An error occurred.'
                    });             
                }
            })
        }
    });
    $('div[contenteditable="true"]').find('img').resizable({
        aspectRatio: true,
        handles: 'n, e, s, w, ne, se, sw, nw'
    });

    $(document).on('click','.ui-wrapper img',function(){
        let src = $(this).attr('src');
        let form = $('#modal').find('.image-url-form');
        const imgEl = $(this);
        picturesPath()
        $('#modal').modal({show:true,keyboard:false,backdrop:'static'});
        form.removeClass('d-none');
        form.find('input[name="source"]').val(src);
        $('.image-search').click(function(){ 
            pictureForm()
            $(document).on('click','.im-image-grid',function(){
                $(this).addClass('im-checked');
                $('.im-image-grid').not(this).removeClass('im-checked');
         

                if($('.im-checked').length>0) $('.btn-picture-trash').prop('disabled',false);
                else $('.btn-picture-trash').prop('disabled',true);
                
            })
            $('.btn-picture-select').on('click',function(){ 
                let select = $('.im-checked').find('img');
                imgEl.attr('src',select.attr('src'));
                formHide();
            });
        })
        $('.btn-link-dismiss').on('click',function(){ 
            formHide();
        })
    })
 
    
    // editableDivNode = $('div[contenteditable="true"]');

    // editableDivNode.on('DOMAttrModified',function(e){
    //     if(e.target.tagName=='IMG'
    //         && e.target.getAttribute('_moz_resizing')  
    //         && e.attrName=='style' 
    //         && e.newValue.match(/width|height/))
    //     {
    //         console.log(e)
    //     }
    // },false);
 

</script>