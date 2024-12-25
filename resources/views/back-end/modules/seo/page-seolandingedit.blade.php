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
        border-radius: .25rem;
    }

    #tree>ul {
        padding-top: 10px;
    }

    #preview {
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;

    }

    #preview:after {
        font-family: 'Font Awesome 5 Free';
        font-size: 9em !important;
        content: "\f03e";
        color: #999;
        display: block;
        margin: 30px;
    }

    .img-thumbnail {
        text-align: center;
    }

    a.previous-page,
    a.next-page {
        font-weight: bold;
    }

    .previous-page:hover,
    .next-page:hover {
        color: white;
        background-color: #321fdb;
        text-decoration: none;
    }
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Landing Page</a></span>
                    @if ($rows->page != '')
                        <span class="breadcrumb-item active"><a href="{{ url("th/$rows->path") }}">{{ $rows->page }}</a></span>
                    @endif
                </div>
                <div class="card-body">
                    <h3 class="mb-3">SEO KEYWORD</h3>
                    {{-- @foreach($rows as $key => $row) --}}
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header d-flex">
                                <h5>{{$rows->page}}</h6><a href="https://at-once.info/th/{{$rows->path}}"> <span class="badge badge-info ml-1 p-1"><i class="fas fa-link"></i> LINK</span></a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab4" >
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH4-tab" data-toggle="tab" href="#TH4" role="tab" aria-controls="TH4" aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN4-tab" data-toggle="tab" href="#EN4" role="tab" aria-controls="EN4" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP4-tab" data-toggle="tab" href="#JP4" role="tab" aria-controls="JP4" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH4-tab" data-toggle="tab" href="#CH4" role="tab" aria-controls="CH4" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab4Content">
                                    <div class="tab-pane fade show active" id="TH4" role="tabpanel" aria-labelledby="TH4-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Title :</label>
                                                <input type="text" name="title_th" class="form-control form-storage" value="{{$rows->title_th}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN4" role="tabpanel" aria-labelledby="EN4-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Title :</label>
                                                <input type="text" name="title_en" class="form-control form-storage" value="{{$rows->title_en}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP4" role="tabpanel" aria-labelledby="JP4-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Title :</label>
                                                <input type="text" name="title_jp" class="form-control form-storage" value="{{$rows->title_jp}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH4" role="tabpanel" aria-labelledby="CH4-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Title :</label>
                                                <input type="text" name="title_zh" class="form-control form-storage" value="{{$rows->title_zh}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab5" >
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH5-tab" data-toggle="tab" href="#TH5" role="tab" aria-controls="TH5" aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN5-tab" data-toggle="tab" href="#EN5" role="tab" aria-controls="EN5" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP5-tab" data-toggle="tab" href="#JP5" role="tab" aria-controls="JP5" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH5-tab" data-toggle="tab" href="#CH5" role="tab" aria-controls="CH5" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab5Content">
                                    <div class="tab-pane fade show active" id="TH5" role="tabpanel" aria-labelledby="TH5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seokeyword_th" class="form-control form-storage" value="{{$rows->seo_keyword_th}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN5" role="tabpanel" aria-labelledby="EN5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seokeyword_en" class="form-control form-storage" value="{{$rows->seo_keyword_en}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP5" role="tabpanel" aria-labelledby="JP5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seokeyword_jp" class="form-control form-storage" value="{{$rows->seo_keyword_jp}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH5" role="tabpanel" aria-labelledby="CH5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seokeyword_zh" class="form-control form-storage" value="{{$rows->seo_keyword_zh}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab6" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH6-tab" data-toggle="tab" href="#TH6" role="tab" aria-controls="TH6" aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN6-tab" data-toggle="tab" href="#EN6" role="tab" aria-controls="EN6" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP6-tab" data-toggle="tab" href="#JP6" role="tab" aria-controls="JP6" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH6-tab" data-toggle="tab" href="#CH6" role="tab" aria-controls="CH6" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab6Content">
                                    <div class="tab-pane fade show active" id="TH6" role="tabpanel" aria-labelledby="TH6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seodescription_th" rows="8" class="form-control form-storage">{{$rows->seo_description_th}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN6" role="tabpanel" aria-labelledby="EN6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seodescription_en" rows="8" class="form-control form-storage">{{$rows->seo_description_en}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP6" role="tabpanel" aria-labelledby="JP6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seodescription_jp" rows="8" class="form-control form-storage">{{$rows->seo_description_zh}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH6" role="tabpanel" aria-labelledby="CH6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seodescription_zh" rows="8" class="form-control form-storage">{{$rows->seo_description_zh}}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input class="btn btn-primary float-right" type="submit" value="Save">
                            </div>
                        </div>
                    </form>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
