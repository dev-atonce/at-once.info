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
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Dashboard</a></span>
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Customers</a></span>
                    {{-- <span class="breadcrumb-item active">Create Form</span> --}}
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="get" class="form-inline mb-4">
                        <div class="row">
                            <div class="form-group ml-3 mr-1">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                    value="{{ Request::get('keyword') }}" style="width:350px;">
                            </div>
                            <div class="form-group mr-1">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Category</option>
                                    @if ($category)
                                        @foreach ($category as $cat)
                                            <option @if (Request::get('category') == $cat->id) selected @endif
                                                value="{{ $cat->id }}">{{ $cat->name_jp }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <input type="submit" class="btn btn-info input-sm" value="Search">
                        </div>
                    </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="3%">#</th>
                                        <th width="10%" style="text-align:center"></th>
                                        <th width="77%">Company</th>
                                        <th width="10%">Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $k => $v)
                                        <tr>
                                            <td>{{ $rows->firstItem() + $k }}</td>
                                            <td align="center"><img src="{{ $v->logo }}" class="img-thumbnail"
                                                    style="border-radius: 50%; width: 80px;" /></td>
                                            <td>
                                                <span class="badge badge-secondary mr-1"><i
                                                        class="fas fa-language fa-lg text-primary"></i>
                                                    Thai</span>{{ $v->name_th }}<br>
                                                <span class="badge badge-secondary mr-1"><i
                                                        class="fas fa-language fa-lg text-primary"></i>
                                                    Japanese</span>{{ $v->name_jp }}<br>
                                                <a href="{{ $prefix }}/company/{{ $v->key }}/statistics/{{ $v->cid }}"
                                                    class="badge badge-primary"><i
                                                        class="fas fa-chart-line pr-1"></i>Statistics</a>
                                                @if ($v->packageName)
                                                    <a href="{{ $prefix }}/company/{{ $v->key }}/sms/{{ $v->cid }}"
                                                        class="badge badge-warning"><i
                                                            class="fas fa-sms pr-1"></i>SMS</a>
                                                    <a href="{{ $prefix }}/company/{{ $v->key }}/banner/{{ $v->cid }}"
                                                        class="badge badge-info"><i class="fas fa-flag"></i> Banner</a>
                                                    <span class="badge badge-dark"><i class="fas fa-star mr-1"
                                                            style="color: {!! $v->color !!} !important;"></i>{{ $v->packageName }}
                                                        Package</span>
                                                @endif
                                            </td>
                                            <td><span class="badge badge-primary"># {{ $v->category_jp }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center align-items-center">
                                {{ $rows->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
