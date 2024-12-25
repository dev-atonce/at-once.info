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
                    <div class="float-right">
                        <a class="btn btn-primary" href='{{ url("$prefix/customers/create") }}'>Create</a>
                    </div>
                    {{-- <h6>Filters : @if (@$rows->total() > 0)<span>{{$rows->total()}} Record.</span>@endif</h6>         --}}

                    <form action="" method="get" class="form-inline mb-4">
                        <div class="row">
                            <div class="form-group ml-3 mr-1">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                    value="{{ Request::get('keyword') }}" style="width:350px;">
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
                                        <th width="10%" style="text-align:center">Logo</th>
                                        <th width="30%">Company</th>
                                        <th class="text-center">CS</th>
                                        <th>Category</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $k => $v)
                                        <tr>
                                            <td>{{ $k + 1 }}</td>
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
                                                <a href="{{ $prefix }}/company/{{ $v->key }}/sms/{{ $v->cid }}"
                                                    class="badge badge-warning"><i class="fas fa-sms pr-1"></i>SMS</a>
                                                <a href="{{ $prefix }}/company/{{ $v->key }}/banner/{{ $v->cid }}"
                                                    class="badge badge-info"><i class="fas fa-flag"></i> Banner</a>
                                                @if ($v->packageName)
                                                    <span class="badge badge-dark"><i class="fas fa-star mr-1"
                                                            style="color: {!! $v->color !!} !important;"></i>{{ $v->packageName }}
                                                        Package</span>
                                                @endif
                                            </td>
                                            @php
                                                $cs_name = \App\Models\UsersMd::select('name')
                                                    ->where('id', $v->cs)
                                                    ->first();
                                            @endphp
                                            <td class="text-center">
                                                @if ($v->cs)
                                                    <div>
                                                        <i class="fas fa-user-circle"></i> : {{ @$cs_name->name }}
                                                    </div>
                                                    <div>
                                                        <i class="fas fa-envelope"></i> : {{ @$v->cs_mail }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td><span class="badge badge-primary"># {{ $v->category_jp }}</span></td>
                                            <td>{{ $v->created }}</td>
                                            <td>
                                                <a href="{{ url("$prefix$segment") }}/edit/{{ $v->id }}"
                                                    class="badge badge-warning mr-1">Edit</a>
                                                <a href="javascript:" class="badge badge-danger deleteItem"
                                                    data-id="{{ $v->id }}">Delete</a>
                                            </td>
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
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-sm" type="submit" name="signup">Create</button>
                    <a class="btn btn-danger btn-sm" href="{{ url("$prefix$segment") }}">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var fullUrl = window.location.origin + '/webpanel/customers';
    $('.ChkBox').click(function() {
        const checked = [];
        const $this = $(this).prop("checked");
        $('.ChkBox').each(function() {
            if ($(this).is(':checked')) {
                checked.push($this)
            }
        })
        if (checked.length > 0) {
            $('#delSelect').prop('disabled', false);
        } else {
            $('#delSelect').prop('disabled', true);
        }
    })
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
    $('.status').on('click', function() {
        const cur = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: 'webpanel/members/company/status',
            method: 'post',
            async: false,
            data: {
                id: cur.data('id')
            },
            success: function(res) {
                console.log(res)
            }
        });
    })
</script>
