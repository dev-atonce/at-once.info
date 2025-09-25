<style>
    .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        border-color: #31b335 !important;
        background-color: #31b335 !important;
    }

    .custom-switch .custom-control-input~.custom-control-label::before,
    .custom-switch .custom-control-input~.custom-control-label::after {
        cursor: pointer;
    }

    .custom-switch .custom-control-input:disabled:checked~.custom-control-label::before {
        border-color: #93ce95 !important;
        background-color: #93ce95 !important;
        cursor: inherit;
    }

    .custom-switch .custom-control-input:disabled~.custom-control-label::before,
    .custom-switch .custom-control-input:disabled~.custom-control-label::after {
        cursor: inherit;
    }

    .fs-12 {
        font-size: 12px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="row nav nav-tabs" id="myTab" role="tablist">
            @foreach($rows as $key => $row)
            <div class="col-lg-2 col-xs-12 col-md-4 rounded-lg" data-toggle="tab" data-target="#category{{$row->id}}" role="tab">
                <div class="card">
                    <div class="card-body">
                        <div class="m-auto">
                            <div class="text-center" style="margin:0 auto; border-radius:50%; width:60px; height:60px; background-color:{!!$row->color!!}; display:flex; justify-content:center;">
                                <i class="fas fa-crown fa-2x m-3 color-white"></i>
                            </div>
                        </div>
                        <h4 class="card-title text-center mt-2 package-name">{{$row->name_th}}</h4>
                        <div class="d-flex justify-content-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input package-status" id="package_id_{{$row->id}}" data-id="{{$row->id}}" value="1" @if($row->status == 1) checked="" @endif>
                                <label class="custom-control-label" for="package_id_{{$row->id}}"></label>
                            </div>
                            <a href="javascript:" class="badge badge-secondary align-self-center package-edit" data-id="{{$row->id}}" data-color="{{$row->color}}" data-name-th="{{$row->name_th}}" data-name-en="{{$row->name_en}}"><i class="fas fa-pen"></i></a>
                        </div>
                        <p class="card-text">{{$row->description_th}}</p>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-secondary">&nbsp;</div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            @foreach($rows as $k => $v)
                            <div class="tab-pane fade @if($k==0)show active @endif" id="category{{$v->id}}" role="tabpanel" aria-labelledby="category{{$v->id}}">
                                {!!$v->html_th!!}
                            </div>
                            @endforeach
                        </div>
                        {{--
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="50%">Package</th>
                                    @foreach($rows as $key => $row)
                                    <th class="text-center border-left package_col_{{$row->id}}@if($row->status==0)text-secondary @endif " width="10%">{{$row->name_th}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\PackageListMd::orderBy('sort')->get() as $k => $v)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input option-status" id="customSwitch{{$k}}" data-id="{{$v->id}}" @if($v->status == 1) checked @endif>
                                            <label class="custom-control-label" for="customSwitch{{$k}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{$v->name}}</strong><br>
                                        {{$v->description}}
                                    </td>
                                    @foreach($rows as $key => $row)
                                    <td class="text-center border-left package_col_{{$row->id}}" width="10%" style="vertical-align: middle;">
                                        @if($v->input_type == 'checkbox')
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input adjust package_col_{{$row->id}}" id="customSwitch{{$k}}{{$key}}" data-id="" package="{{$row->id}}" list="{{$v->id}}" @if($row->status == 0) disabled=""@endif>
                                            <label class="custom-control-label" for="customSwitch{{$k}}{{$key}}"></label>
                                        </div>
                                        @else
                                        <div>
                                            <textarea type="textarea" class="form-control package_col_{{$row->id}}" package="{{$row->id}}" list="{{$v->id}}" readonly @if($row->status == 0) disabled=""@endif></textarea>
                                            <div class="mt-1">
                                                <a href="javascript:" class="badge badge-secondary fs-12 btn-edit">Edit</a>
                                                <div class="save-cancel d-none">
                                                    <a href="javascript:" class="badge badge-success fs-12 btn-save" data-id="">Save</a>
                                                    <a href="javascript:" class="badge badge-light fs-12 btn-cancel">Cancel</a>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-package">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">Edit</div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" name="id">
                                <label for="">Color</label>
                                <input type="text" name="color" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Name (TH)</label>
                                <input type="text" name="name_th" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Name (EN)</label>
                                <input type="text" name="name_en" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Save & Change</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    const PackageData = () => {
        const data = $.ajax({
            method: 'get',
            url: 'webpanel/package/get',
            async: false
        }).responseText;
        return JSON.parse(data);
    }
    const fetchData = () => {
        const data = PackageData();

        data.map((val, key) => {
            packClass = `package_col_${val.id}`;

            options = $(`.${packClass}`);
            val.package.map((v, k) => {
                $(`.${packClass}`).map((i, j) => {
                    $this = $(j).find(`input[list="${v.list}"]`);
                    textarea = $(j).find('textarea');
                    if ($this.length > 0) {
                        checked = (v.package == $this.attr('package') && v.list == $this.attr('list') && v.value == '1') ? true : false;
                        $this.prop('checked', checked);
                    }
                    if (textarea.length > 0) {
                        if (v.package == textarea.attr('package') && v.list == textarea.attr('list')) {
                            textarea.attr('data-id', v.package)
                            textarea.html(v.value);
                        }
                    }
                })
            })
        })
    }
    fetchData();

    $(document).on('change', '.adjust', function() {
        cur = $(this);
        const thisId = cur.attr('data-id');
        const package = cur.attr('package');
        const list = cur.attr('list');
        const thisValue = (cur.is(':checked')) ? 1 : 0;
        $.ajax({
            url: "webpanel/package/adjust",
            data: {
                package: package,
                list: list,
                id: thisId,
                value: thisValue
            },
            success: function(res) {
                Swal.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.status,
                    toast: true,
                    timer: 2000,
                    position: 'top-end',
                    showConfirmButton: false
                })
            },
            error: function(error) {
                console.log(error)
            }
        }).then((res) => {
            console.log(res);
        }).catch(() => {
            console.error()
        });
    });
    // $(document).on('keypress',function(event)
    // {
    //     console.log(event.keyCode)
    //     console.log(event.ctrlKey)
    //     if (event.keyCode == 115 && event.ctrlKey){
    //         myfunction();

    //         return false;

    //     }
    // });
    function myfunction(package, list, value) {
        // alert("Key pressed Ctrl+s");
        Swal.fire({
            icon: 'info',
            title: 'Do you want to save the changes?',
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: "#DD6B55",
            preConfirm: () => {
                return fetch(`webpanel/package/adjust?package=${package}&list=${list}&value=${value}`)
                    .then(response => response.json())
                    .then(data =>
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.status,
                            toast: true,
                            timer: 2000,
                            position: 'top-end',
                            showConfirmButton: false
                        })
                    )
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`)
                    })
            }
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    document.addEventListener('keydown', function(event) {
        var S = 83,
            activeElement = document.activeElement;

        if ((event.key === S || event.keyCode === S) && (event.metaKey || event.ctrlKey) && activeElement.nodeName === 'INPUT') {
            const package = activeElement.getAttribute('package');
            const list = activeElement.getAttribute('list');
            const value = activeElement.value;
            myfunction(package, list, value);
            event.preventDefault();
        }
    });
    $(document).on('change', '.package-status', function() {
        cur = $(this);
        status = $(this).is(':checked') ? 1 : 0;
        d = (!$(this).is(':checked')) ? true : false;
        id = $(this).attr('data-id');
        $.ajax({
            method: 'post',
            url: 'webpanel/package/status',
            data: {
                status: status,
                id: id
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            success: function(res) {
                Swal.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.status,
                    toast: true,
                    timer: 2000,
                    position: 'top-end',
                    showConfirmButton: false
                })

                $(`.package_col_${id}`).map(function(k, v) {
                    type = $(v).attr('type');
                    option = $(v).closest('tr').find('td:nth-child(1)').find('input.status');
                    $(v).prop('disabled', d);

                    //     option = $(v).closest('tr').find('td:nth-child(1)').find('input.status');
                    //     if(status == 0){
                    //         $(v).prop('disabled',true);
                    //     }else{
                    //         $(v).prop('disabled',false);
                    //     }
                })
            }
        })
    })
    $(document).on('click', '.package-edit', function() {
        cur = $(this);
        id = cur.attr('data-id');
        name_th = cur.attr('data-name-th');
        name_en = cur.attr('data-name-en');
        color = cur.attr('data-color');
        Modal = $('.modal-package');
        Modal.find('input[name="id"]').val(id);
        Modal.find('input[name="name_th"]').val(name_th);
        Modal.find('input[name="name_en"]').val(name_en);
        Modal.find('input[name="color"]').val(color);
        Modal.find('.alert').remove();
        Modal.modal('show');
        Modal.find('.btn-success').on('click', function() {
            data = {};
            data.id = Modal.find('input[name="id"]').val();
            data.name_th = Modal.find('input[name="name_th"]').val();
            data.name_en = Modal.find('input[name="name_en"]').val();
            data.color = Modal.find('input[name="color"]').val();
            $.ajax({
                url: `webpanel/package/${id}`,
                method: 'post',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: {
                    id: data.id,
                    name_th: data.name_th,
                    name_en: data.name_en,
                    color: data.color
                },
                success: function(res) {
                    alert = res.status == 'success' ? 'success' : 'danger';
                    Modal.find('.col-lg-12').prepend(`\
                    <div class="alert alert-${alert}" role="alert">\
                        <h5 class="alert-heading mb-1">${res.title}</h5>\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                        </button>\
                        <p class="mb-0">${res.message}</p>
                    </div>`)
                    if (res.status == 'success') {
                        cur.attr('data-name-th', data.name_th);
                        cur.attr('data-name-en', data.name_en);
                        cur.attr('data-color', data.color);
                        cur.closest('.card-body').find('.card-title').html(data.name_th)
                        cur.closest('.card-body').find('.fa-crown').parent().css('background-color', `${data.color}`);
                        setTimeout(() => {
                            Modal.find('.btn-secondary').click();
                        }, 3000);
                    }
                }
            })
        })
    });
    $(document).on('click', '.option-status', function() {
        cur = $(this);
        id = cur.attr('data-id');
        $.ajax({
            method: 'post',
            url: 'webpanel/package/option/status',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            data: {
                id: id
            },
            success: function(res) {
                Swal.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.status,
                    toast: true,
                    timer: 2000,
                    position: 'top-end',
                    showConfirmButton: false
                })
            }
        })
    })
    $(document).on('click', '.save-or-edit', function() {
        cur = $(this);
        curIcon = 'fa-edit';
        cur.find('i').toggleClass('fa-edit fa-save');
        if (cur.find('i').hasClass('fa-save')) {
            cur.closest('.input-group').find('textarea').prop('readonly', false);
            $.ajax({
                method: `post`,
                url: `webpanel/package/option/${id}`,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function(res) {
                    Swal.fire({
                        title: res.title,
                        text: res.message,
                        icon: res.status,
                        toast: true,
                        timer: 2000,
                        position: 'top-end',
                        showConfirmButton: false
                    });
                }
            }).then((err) => console.log(err))
        } else {
            cur.closest('.input-group').find('textarea').prop('readonly', true);
        }

    });
    let currentVal;
    $(document).on('click', '.btn-edit', function() {
        cur = $(this);
        cur.toggleClass('d-none');
        cur.next().toggleClass('d-none');
        cur.parent().prev().prop('readonly', false);
        currentVal = cur.parent().prev().val();

    })
    $(document).on('click', '.btn-cancel', function() {
        cur = $(this);

        input = cur.closest('td').find('textarea');
        cur.parent().toggleClass('d-none');
        cur.closest('td').find('textarea').prop('readonly', true);
        cur.parent().prev().toggleClass('d-none')
        input.val(currentVal);
    })
    $(document).on('click', '.btn-save', function() {
        cur = $(this);
        textarea = cur.closest('td').find('textarea');
        data = {};

        data.value = textarea.val();
        if (textarea.attr('data-id')) {
            data.id = id;
        }
        if (textarea.attr('package')) {
            data.package = textarea.attr('package');
        }
        if (textarea.attr('list')) {
            data.list = textarea.attr('list');
        }

        $.ajax({
            method: 'post',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: `webpanel/package/option`,
            data: data,
            success: function(res) {
                Swal.fire({
                    icon: res.status,
                    title: res.title,
                    text: res.message,
                    toast: true,
                    timer: 2000,
                    showConfirmButton: false,
                    position: 'top-end'
                })
                setTimeout(() => {
                    cur.parent().toggleClass('d-none');
                    cur.parent().prev().toggleClass('d-none');
                    cur.closest('td').find('textarea').prop('readonly', true);
                }, 2100)
            }
        })
    })
</script>