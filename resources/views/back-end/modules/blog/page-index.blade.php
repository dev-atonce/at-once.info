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

    .ss-single-selected{
        height: 35px !important;
    }
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment-type") }}">Blog</a></span>
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ url("$prefix$segment/add") }}">Create</a>
                    </div>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 position-relative">
                                <div class="form-group row">
                                    <div class="col-3 p-0">
                                        <input type="text" class="form-control" name="keyword" placeholder="Keywords"
                                            value="{{ Request::get('keyword') }}" style="min-width:300px;">
                                    </div>
                                    <div class="col-1 pr-1 pl-1">
                                        <select name="createdby" id="createdby" class="form-control">
                                            <option value="">Create By</option>
                                            @if ($created_by)
                                                @foreach ($created_by as $create)
                                                    <option @if (Request::get('createdby') === $create->created_by) selected @endif
                                                        value="{{ $create->created_by }}">{{ $create->created_by }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-1 p-0">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">Blog type</option>
                                            <option value="general" @if (Request::get('type') == 'general') selected @endif>
                                                General</option>
                                            <option value="customer" @if (Request::get('type') == 'customer') selected @endif>
                                                Customer</option>
                                            <option value="review" @if (Request::get('type') == 'review') selected @endif>
                                                Review</option>
                                            <option value="promotion" @if (Request::get('type') == 'promotion') selected @endif>
                                                Promotion</option>
                                            <option value="job-search" @if (Request::get('type') == 'job-search') selected @endif>
                                                Recruitment</option>
                                            <option value="want-to-sale" @if (Request::get('type') == 'want-to-sale') selected @endif>
                                                Want to Sale</option>
                                            <option value="want-to-buy" @if (Request::get('type') == 'want-to-buy') selected @endif>
                                                Want to buy</option>
                                            <option value="marketing-blog" @if (Request::get('type') == 'marketing-blog') selected @endif>
                                                Marketing Blog</option>
                                            <option value="selfedit" @if (Request::get('type') == 'selfedit') selected @endif>
                                                Self-Edit Blog</option>
                                        </select>
                                    </div>
                                    <div class="col-2 pl-1 pr-2">
                                        <select name="category" id="category">
                                            <option value="">Category</option>
                                            @if ($category)
                                                @foreach ($category as $cat)
                                                    <option @if (Request::get('category') == $cat->id) selected @endif
                                                        value="{{ $cat->id }}">{{ $cat->name_jp }} /
                                                        {{ $cat->name_th }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-info ml-2">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="5%">#</th>
                                        <th width="10%">Image</th>
                                        <th width="20%">Title</th>
                                        <th class="text-center" width="7%">Category</th>
                                        <th class="text-center" width="7%">Type</th>
                                        <th class="text-center" width="10%">Create By</th>
                                        <th width="10%">Created</th>
                                        <th width="5%">Status</th>
                                        <th width="7%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows)
                                        @php
                                            $item = $rows->firstItem();
                                        @endphp
                                        @foreach ($rows as $key => $row)
                                            <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                                data-id="{{ $row->id }}">
                                                <td data-label="No."><span class="no">{{ $item + $key }}</span> <i
                                                        class="fas fa-bars handle d-none"></i></td>
                                                <td class="text-center">
                                                    @php
                                                        $image = !empty($row->images) ? $row->images : 'img/no_image.webp';
                                                    @endphp
                                                    <img src="{{ $image }}" class="img-thumbnail">
                                                </td>
                                                <td class="text-left">
                                                    {{ $row->name_th }}<br>
                                                    @if ($row->facebook_url !== null)
                                                        <div>Share On : <i
                                                                class="fab fa-facebook-square text-primary"></i></div>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $row->categoryName }}</td>
                                                {{-- <td > <input type="checkbox"  class="interest" data-id="{{$row->id}}" @if ($row->interesting == 1) checked @endif > </td> --}}
                                                <td class="text-center"> {{ $row->type }} </td>
                                                <td class="text-center"> {{ $row->created_by }}</td>
                                                <td data-label="Created :">
                                                    {{ date_format($row->created, 'd-m-Y H:i:s') }}</td>
                                                <td data-label="Status :">
                                                    <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                        <input class="c-switch-input status" type="checkbox"
                                                            data-id="{{ $row->id }}"
                                                            @if ($row->status == 1) checked @endif><span
                                                            class="c-switch-slider" data-checked="On"
                                                            data-unchecked="Off"></span>
                                                    </label>
                                                </td>
                                                <td data-label="Actions :">
                                                    <a href="{{ url("$prefix$segment/statistics/$row->id") }}"
                                                        class="btn btn-info btn-sm" title="Statistics"><i
                                                            class="fas fa-chart-bar"></i></a>
                                                    <a href="{{ url("$prefix$segment/$row->id") }}"
                                                        class="btn btn-warning btn-sm" title="Edit"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="javascript:" class="btn btn-danger btn-sm deleteItem"
                                                        data-id="{{ $row->id }}" title="Delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-center mb-3">
                        <div>
                            @if (!empty($rows))
                                พบข้อมูลมูลทั้งหมด
                                {{ $rows->total() }} รายการ หน้า {{ $rows->currentPage() }} / {{ $rows->lastPage() }}
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div>
                            @if (Request::get('view') != 'all' && !empty($rows))
                                {{ $rows->links() }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-sm" type="submit" name="signup">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    new SlimSelect({select:'#category'});

    var fullUrl = window.location.origin + '/webpanel/blog';
    // $('.ChkBox').click(function(){
    //     const checked = []; const $this = $(this).prop("checked");
    // $('.ChkBox').each(function(){ if($(this).is(':checked')){ checked.push($this) } })
    //     if(checked.length>0){ $('#delSelect').prop('disabled',false); }else{ $('#delSelect').prop('disabled',true); }
    // })
    $('#delSelect').on('click', function() {
        const id = $('.ChkBox:checked').map(function() {
            return $(this).val()
        }).get();
        if (id.length > 0) {
            deleted(id)
        }
    })
    $('.deleteItem').on('click', function() {
        const id = [$(this).data('id')];
        if (id.length > 0) {
            deleted(id)
        }
    })

    function deleted(id) {
        Swal.fire({
            title: "Delete data",
            text: "Do you want to delete the data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(fullUrl + '/delete?id=' + id)
                    .then(response => response.json())
                    .then(data => location.reload())
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`)
                    })
            }
        });
    }
    $(".status").change(function() {
        var ID = $(this).data("id");
        var token = "{{ csrf_token() }}";
        $.ajax({
            url: fullUrl + '/status',
            type: 'post',
            data: {
                id: ID,
                _token: token
            },
            success: function(data) {
                //alert(data);
                // location.reload();
            }
        });
    });
    $(".interest").change(function() {
        var ID = $(this).data("id");
        var token = "{{ csrf_token() }}";
        $.ajax({
            url: fullUrl + '/interesting',
            type: 'post',
            data: {
                id: ID,
                _token: token
            },
            success: function(data) {
                //alert(data);
                // location.reload();
            }
        });
    });
</script>
