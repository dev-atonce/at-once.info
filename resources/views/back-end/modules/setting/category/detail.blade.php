<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <meta name="keyword" content="">

            <title>{{Config::get('app.name')}} | Webpanel</title>

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
            <link rel="stylesheet" href="back-end/css/skEditor.css" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 detail-content">
                    <div class="card border-radius-2x">
                        <div class="card-body">
                            <form method="post" action="" id="formEdit">
                                <input type="hidden" name="id" value="{{Request::get('id')}}">
                                @php($row=\App\Models\CategoryMd::find(Request::get('id')))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>No Style</strong>
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <h4>{{@$row->name_th}}</h4>
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="TH-tab" data-toggle="tab"
                                            href="#TH" role="tab" aria-controls="TH"
                                            aria-selected="true">TH</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="EN-tab" data-toggle="tab" href="#EN"
                                            role="tab" aria-controls="EN" aria-selected="false">EN</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="JP-tab" data-toggle="tab" href="#JP"
                                            role="tab" aria-controls="JP" aria-selected="false">JP</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ZH-tab" data-toggle="tab" href="#ZH"
                                            role="tab" aria-controls="ZH" aria-selected="false">CH</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="TH" role="tabpanel" aria-labelledby="TH-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="sk-area" data-lang="th">
                                                    <textarea name="detail_th" id="detail_th" class="sk-editor" hidden="">{{ $row->detail_th }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="EN" role="tabpanel" aria-labelledby="EN-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="sk-area" data-lang="en">
                                                    <textarea name="detail_en" id="detail_en" class="sk-editor" hidden="">{{ $row->detail_en }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="JP" role="tabpanel" aria-labelledby="JP-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="sk-area" data-lang="jp">
                                                    <textarea name="detail_jp" id="detail_jp" class="sk-editor" hidden="">{{ $row->detail_jp }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ZH" role="tabpanel" aria-labelledby="ZH-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="sk-area" data-lang="ch">
                                                    <textarea name="detail_zh" id="detail_zh" class="sk-editor" hidden="">{{ $row->detail_zh }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center mt-2">
                                            <button type="submit" class="btn btn-secondary">Cancel</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="back-end/vendors/pace-progress/js/pace.min.js"></script>
<script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script>
<script src="js/b64toBlob.js"></script>
<script src="js/jquery.selection.js"></script>
<script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
<script src="back-end/build/skEditor.js?v=i"></script>
<script src="js/jquery.validate-v1.18.js"></script>
<script>
    $('#detail_th').skEditor({height:'800px'});
    $('#detail_en').skEditor({height:'800px'});
    $('#detail_jp').skEditor({height:'800px'});
    $('#detail_zh').skEditor({height:'800px'});
</script>