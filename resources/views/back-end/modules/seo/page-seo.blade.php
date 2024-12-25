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
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Category</a></span>
                    @if (@$category != '')
                        <span class="breadcrumb-item active"><a
                                href="{{ url("$prefix$segment") }}/{{ $category }}">{{ $category }}</a></span>
                    @endif
                </div>
                <div class="card-body">
                    <form action="" method="get" class="form-inline mb-4">
                        <div class="row">
                            <div class="form-group ml-3 mr-1">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                    value="{{ Request::get('keyword') }}" style="width:350px;">
                            </div>
                            <input type="hidden" value="{{ Request::get('start') }}">
                            <input type="submit" class="btn btn-info input-sm" value="Search">
                        </div>
                    </form>
                    <h3>SEO KEYWORD</h3>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="5%">#</th>
                                        <th width="65%">Category</th>
                                        <th width="15%" style="text-align:center;">Updated</th>
                                        <th width="15%" style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($rows as $key => $row)
                                    @php $item = $rows->firstItem(); @endphp
                                    <tbody>
                                        <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                            data-id="{{ $row->id }}">
                                            <td>{{ $item + $key }}</td>
                                            <td>
                                                <div>
                                                    <h5>{{ $row->name_jp }}</h6>
                                                </div>
                                                <div>Keyword : {{ $row->seo_keyword_th }}</div>
                                                <div>Description : {{ $row->seo_description_th }}</div>
                                            </td>
                                            <td style="text-align:center;">{{ $row->updated }}</td>
                                            <td style="text-align:center;"><a
                                                    href="{{ $prefix }}/seoedit/{{ $row->id }}"
                                                    class="btn btn-primary">EDIT</a></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <div class="d-flex justify-content-center align-items-center">
                                <div>{{ $rows->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
