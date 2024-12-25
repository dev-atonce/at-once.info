<style>
    .img-preview {
        width: 100%;
        max-height: 145px;
        overflow: hidden;
    }

    .img-preview>img {
        height: 100%;
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

    .search-content {
        position: absolute;
        width: calc(100% - 30px);
        background-color: #fff;
        display: block;
        border: 1px solid #dedede;
        height: auto;
        max-height: 400px;
        overflow-y: scroll;
        z-index: 989;
        display: none;
        box-shadow: 0 1px 10px -3px #b7b7;
    }

    .search-text {
        text-align: left;
        z-index: 989;
        cursor: default;
        width: calc(100%);

    }

    ul.search-text {
        margin: 0;
        padding: 0;
    }

    ul.search-text li {
        list-style-type: none;

    }

    ul.search-text li a {
        text-decoration: none;
        display: block;
        padding: 5px 10px;
        color: #000;
    }

    ul.search-text li a:hover {
        background-color: #ededed;
    }

    .text-center {
        width: 100%;
        position: relative;
        height: 100%;
    }

    .spinner-border {
        display: block;
        position: fixed;
        top: calc(50% - (58px / 2));
        right: calc(50% - (58px / 2));
        color: red;
    }

    #backdrop {
        position: absolute;
        top: 0;
        width: 100vw;
        height: 100vh;
        z-index: 999;
        background-color: rgb(0, 0, 0, 0.2);
    }

    .user-alert {
        margin-top: 20px;
    }

    .valid {
        border-color: #28a745 !important;
    }

    .valid:focus {

        color: #28a745 !important;
        border-color: rgb(40, 167, 69) !important;
        ;
        outline: 0 !important;
        box-shadow: 0 0 0 0.2rem rgb(40 167 69 / 25%) !important;
    }

    .company-name-duplicate .col-lg-3 {
        text-overflow: ellipsis;
        overflow: hidden;
        width: 160px;
        white-space: nowrap;
    }

    .hover-zoom {
        transition: transform .4s;
        color: #3c4b64;
    }

    .hover-zoom:hover {
        transform: scale(1.2);
        color: #3c4b64;
    }

    .user-name-alert {
        max-height: 400px;
        overflow-y: scroll;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 900px;
        }
    }
</style>
<link rel="stylesheet" href="css/validate.css">
<div class="fade-in">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="card @if (!Request::get('step')) bg-success text-white @endif">
                <div class="card-body ">
                    <strong>STEP1 :</strong> Input & Validate
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="card @if (Request::get('step') == 2) bg-success text-white @endif">
                <div class="card-body">
                    <strong>STEP2 :</strong> Confirm
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            {{-- <form id="form" method="post" action="" enctype="multipart/form-data" autocomplete="off">  --}}
            {{-- @csrf --}}
            {{-- @method('PUT') --}}
            @if (Request::get('step') == 2)
                <form id="createForm" method="post" enctype="multipart/form-data" autocomplete="false">
                    @csrf
                    @method('PUT')
                @else
                    <form id="inputForm" action="" method="get" autocomplete="false">
                        <input type="hidden" name="step" value="2">
            @endif
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Member</a></span>
                    <span class="breadcrumb-item active">Add Form</span>
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pb-2">
                                <div class="float-right">
                                    @if (Request::get('step') == 2)
                                        <button class="btn btn-primary btn-sm" id="btn-submit" type="submit"
                                            name="signup">Create</button>
                                    @else<button type="submit" class="btn btn-outline-info btn-sm">Next</button>
                                    @endif
                                    <a class="btn btn-outline-secondary btn-sm"
                                        href="{{ url("$prefix$segment") }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (Request::get('step') == 2)
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <h6>Profile Image</h6>
                                                <img src="" class="img-thumbnail" id="preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <small class="help-block">*รองรับไฟล์ <strong class="text-danger">(jpg, jpeg,
                                                png)</strong> เท่านั้น</small>
                                        <small class="text-danger">Auto Resize : Pixel</small>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6>Name (TH)<strong class="text-danger ml-1">*</strong></h6>
                                        <input type="text" class="form-control" name="name_th" placeholder="TH"
                                            autocomplete="false"
                                            @if (Request::get('step') == 2) value="{{ Request::get('name_th') }}" readonly @endif>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6>Name (EN)<strong class="text-danger ml-1">*</strong></h6>
                                        <input type="text" class="form-control" name="name_en" placeholder="EN"
                                            autocomplete="false"
                                            @if (Request::get('step') == 2) value="{{ Request::get('name_en') }}" readonly @endif>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6>Name (JP)<strong class="text-danger ml-1">*</strong></h6>
                                        <input type="text" class="form-control" name="name_jp" placeholder="JP"
                                            autocomplete="false"
                                            @if (Request::get('step') == 2) value="{{ Request::get('name_jp') }}" readonly @endif>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6>Name (ZH)<strong class="text-danger ml-1">*</strong></h6>
                                        <input type="text" class="form-control" name="name_zh" placeholder="ZH"
                                            autocomplete="false"
                                            @if (Request::get('step') == 2) value="{{ Request::get('name_zh') }}" readonly @endif>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h6>Email<strong class="text-danger ml-1">*</strong></h6>
                                    <input type="email" name="email" class="form-control" id="email" required
                                        autocomplete="new-email"
                                        @if (Request::get('step') == 2) value="{{ Request::get('email') }}" readonly @endif />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h6>Password<strong class="text-danger ml-1">*</strong></h6>
                                    <input type="password" name="password" class="form-control" id="password" required
                                        autocomplete="new-password"
                                        @if (Request::get('step') == 2) value="{{ Request::get('password') }}" readonly @endif />
                                </div>
                                <div class="form-group col-lg-6">
                                    <h6>Confirm Password<strong class="text-danger ml-1">*</strong></h6>
                                    <input type="password" name="cpassword" class="form-control" id="cpassword"
                                        required autocomplete="new-cpassword"
                                        @if (Request::get('step') == 2) value="{{ Request::get('password') }}" readonly @endif />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            @if (!Request::get('step'))
                                <div class="user-name-alert d-none">

                                </div>
                                <div class="row user-alert d-none">

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        @if (Request::get('step') == 2)
                            <button class="btn btn-primary btn-sm" id="btn-submit" type="submit"
                                name="signup">Create</button>
                        @else
                            <button type="submit" class="btn btn-outline-info btn-sm">Next</button>
                        @endif
                        <a class="btn btn-outline-secondary btn-sm" href="{{ url("$prefix$segment") }}">Cancel</a>
                    </div>
                </div>
            </div>
            @if (Request::get('step') == 2)
                <div class="card">
                    <div class="card-header">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="insert" value="1" class="custom-control-input"
                                id="insert">
                            <label class="custom-control-label" for="insert">Insert into company and category</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 company-alert">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="">Company Name(TH)</label>
                                        <input type="text" name="company_th" class="form-control into"
                                            autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="">Company Name(EN)</label>
                                        <input type="text" name="company_en" class="form-control into"
                                            autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="">Company Name(JP)</label>
                                        <input type="text" name="company_jp" class="form-control into"
                                            autocomplete="off" disabled>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="">Company Name(ZH)</label>
                                        <input type="text" name="company_zh" class="form-control into"
                                            autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label>Main Category</label>
                                        <select name="maincategory" class="form-control into" id="maincategory"
                                            disabled>
                                            <option hidden>Please Select</option>
                                            @foreach (\App\Models\CategoryMainMd::all() as $i => $rs)
                                                <option value="{{ $rs->id }}">{{ $rs->name_jp }} /
                                                    {{ $rs->name_th }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Sub Category</label>
                                        <select name="subcategory" class="form-control" id="subcategory" disabled>
                                            <option hidden>Please Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Category</label>
                                        <select name="category" class="form-control" id="category" disabled>
                                            <option hidden>Please Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 company-name-duplicate"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button class="btn btn-primary btn-sm" id="btn-submit" type="submit"
                                name="signup">Create</button>
                            <a class="btn btn-secondary btn-sm" href="{{ url("$prefix$segment") }}">Cancel</a>
                        </div>
                    </div>
                </div>
            @endif
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalcompany" tabindex="-1" role="dialog" aria-labelledby="modalcompany"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalcompany">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="">Company Name(TH)</label>
                            <input type="text" name="company_th" class="form-control into" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="">Company Name(JP)</label>
                            <input type="text" name="company_jp" class="form-control into" autocomplete="off">
                        </div>
                        <input type="hidden" name="id">
                        <input type="hidden" name="emailCompany">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Main Category</label>
                            <select name="maincategory" class="form-control into" id="maincategory">
                                <option hidden>Please Select</option>
                                @foreach (\App\Models\CategoryMainMd::all() as $i => $rs)
                                    <option value="{{ $rs->id }}">{{ $rs->name_jp }} /
                                        {{ $rs->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Sub Category</label>
                            <select name="subcategory" class="form-control" id="subcategory">
                                <option hidden>Please Select</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Category</label>
                            <select name="category" class="form-control" id="category">
                                <option hidden>Please Select</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="duplicate-name">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary Addcompany">Create</button>
            </div>
        </div>
    </div>
</div>
<script src="js/axios.min.js"></script>
<script>
    $("#image").change(function() {
        readCover(this);
    });
    var token = "{{ csrf_token() }}"
    // Source: http://stackoverflow.com/a/4459419/6396981
    function readCover(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(function() {
        $('#inputForm').validate({
            validClass: "valid",
            rules: {
                name_th: {
                    required: true,
                    remote: {
                        url: "{{ url('webpanel/members/check/name/duplicate') }}",
                        data: {
                            _token: token
                        },
                        type: "post"
                    }
                },
                name_jp: {
                    required: true,
                    remote: {
                        url: "{{ url('webpanel/members/check/name/duplicate') }}",
                        data: {
                            _token: token
                        },
                        type: 'post'
                    }
                },
                password: {
                    required: true,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    minlength: 6,
                    equalTo: '#password'
                },
                email: {
                    required: true,
                    remote: {
                        url: "{{ url('webpanel/members/check/email/duplicate') }}",
                        data: {
                            _token: token
                        },
                        type: "post"
                    }
                },
            },
            messages: {
                name_th: {
                    required: 'Please enter company name!',
                    remote: 'This name has already been used!'
                },
                name_jp: {
                    required: 'Please enter company name!',
                    remote: 'This name has already been used!'
                },
                email: {
                    required: 'Please enter your email address!',
                    email: 'Invalid email',
                    remote: 'Email aleady in use!',
                },
                password: {
                    required: 'Please enter your password!',
                    minlength: 'Please enter at least 6 charecters!'
                },
                cpassword: {
                    required: 'Please enter your password!',
                    minlength: 'Please enter at least 6 charecters!',
                    equalTo: 'Password mismatch!'
                },
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                $("#btn-submit").attr("disabled", true);
                $('.recaptcha-checkbox-border').addClass('recaptcha-error');
                form.submit();
            }
        });
    });
    $('#createForm').validate({
        ignore: [],
        rules: {
            company_th: {
                required: true
            },
            company_en: {
                required: true
            },
            company_jp: {
                required: true
            },
            company_zh: {
                required: true
            }
        },
        messages: {
            company_th: {
                required: 'Please enter company name'
            },
            company_en: {
                required: 'Please enter company name'
            },
            company_jp: {
                required: 'Please enter company name'
            },
            company_zh: {
                required: 'Please enter company name'
            }
        },
        errorPlacement: function(er, ele) {
            er.insertAfter(el);
        },
        submitHandler: function(form) {
            $("#btn-submit").attr("disabled", true);
            $('.recaptcha-checkbox-border').addClass('recaptcha-error');
            form.submit();
        }
    })
    var backdrop = $('<div id="backdrop">\
            <div class="text-center loading">\
                <div class="spinner-border" role="status">\
                    <span class="sr-only">Loading...</span>\
                </div>\
            </div>\
        </div>');
    var typingTimer; //timer identifier
    var doneTypingInterval = 750; //time in ms, 0.75 seconds for example
    var $input = $('input[name="name_th"]');

    $(document).on('keyup', 'input[name="name_th"]', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchText, doneTypingInterval);
        if ($('#backdrop').length < 1) {
            $('body').append(backdrop)
        }
    });
    $(document).on('keyup', 'input[name="name_en"]', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchText, doneTypingInterval);
        if ($('#backdrop').length < 1) {
            $('body').append(backdrop)
        }
    });
    $(document).on('keyup', 'input[name="name_jp"]', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchText, doneTypingInterval);
        if ($('#backdrop').length < 1) {
            $('body').append(backdrop)
        }
    });
    $(document).on('keyup', 'input[name="name_zh"]', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchText, doneTypingInterval);
        if ($('#backdrop').length < 1) {
            $('body').append(backdrop)
        }
    });
    $(document).on('keyup', 'input[name="email"]', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(searchEmail, doneTypingInterval);
        if ($('#backdrop').length < 1) {
            $('body').append(backdrop)
        }
    });
    $(document).on('keydown', 'input[name="name_th"]', function() {
        clearTimeout(typingTimer);
    });
    $(document).on('keydown', 'input[name="name_en"]', function() {
        clearTimeout(typingTimer);
    });
    $(document).on('keydown', 'input[name="name_jp"]', function() {
        clearTimeout(typingTimer);
    });
    $(document).on('keydown', 'input[name="name_zh"]', function() {
        clearTimeout(typingTimer);
    });
    $(document).on('keydown', 'input[name="email"]', function() {
        clearTimeout(typingTimer);
    });

    function searchText() {

        name_th = $('input[name="name_th"]').val();
        name_en = $('input[name="name_en"]').val();
        name_jp = $('input[name="name_jp"]').val();
        name_zh = $('input[name="name_zh"]').val();

        let ul = $('<ul class="search-text"></ul>');
        let data = {};
        if (name_th != '') {
            data.name_th = name_th;
        }
        if (name_en != '') {
            data.name_en = name_en;
        }
        if (name_jp != '') {
            data.name_jp = name_jp;
        }
        if (name_zh != '') {
            data.name_zh = name_zh;
        }
        $.ajax({
            method: 'get',
            url: '/webpanel/members/name/check',
            data: data,
            success: function(res) {
                let userAlert = $('.user-name-alert');
                if (res.length > 0) {
                    userAlert.removeClass('d-none')
                    userAlert.html('');
                    userAlert.css('display','block');
                    res.forEach(function(v, i) {
                        let li = $('<li><a class="text-danger" href="webpanel/members/' + v.id +
                            '" target="_blank"><span>' + v.name_th + '</span>,&nbsp;' + v
                            .email + ' <i class="fas fa-link"></i></a></li>');
                        ul.append(li);
                    });
                    userAlert.append(ul);
                } else {
                    userAlert.addClass('d-none');
                }
                $('#backdrop').remove();
            },
            error: function(err) {
                console.log(err)
            }
        })
    }

    function searchEmail() {
        let email = $('input[name="email"]').val();
        let data = {};
        if (email != '') {
            data.email = email;
        }
        $.ajax({
            method: 'get',
            url: '/webpanel/members/email/check',
            data: data,
            success: function(res) {
                let userAlert = $('.user-alert');
                if (res.length > 0) {
                    userAlert.removeClass('d-none')
                    userAlert.html('');
                    let addcom = $(
                        '<div class="col-4 mb-4">\
                            <div class="card bg-light h-100 m-0">\
                                <div class="card-body d-flex justify-content-center align-items-center">\
                                    <a href="javascript:0" class="hover-zoom clickAdd" id="clickAdd" data-id="' + res[0].id + '" data-email="'+res[0].memberEmail+'">\
                                        <i class="fas fa-plus fa-2x"></i>\
                                        </a>\
                                        </div>\
                                        </div>\
                                        </div>');
                        res.forEach(function(v, i) {
                        let blacklish = (v.deleted) ? '<a  href="javascript:" class="badge badge-danger font-weight-bold ml-1" style="font-size:12px;"><i class="fas fa-exclamation-triangle"></i> Blacklist</a>' :'';
                        let li = $('<div class="col-4 mb-4">\
                                        <div class="card bg-light h-100 m-0">\
                                            <div class="card-body d-flex">\
                                                <div>\
                                                    <img src="' + v.logo +
                            '" class="img-thumbnail" style="width:95px; border-radius: 50% !important;">\
                                                </div>\
                                                <div class="ml-4">\
                                                    <div>\
                                                        <span class="badge badge-secondary mr-1"><i class="fas fa-language fa-lg text-primary"></i> Thai</span>' +
                            v.companyNameth +
                            '\
                                                    </div>\
                                                    <div>\
                                                        <span class="badge badge-secondary mr-1"><i class="fas fa-language fa-lg text-primary"></i> Japanese</span>' +
                            v.companyNamejp +
                            '\
                                                    </div>\
                                                    <div>\
                                                        <span class="badge badge-secondary mr-1"><i class="fas fa-envelope-square fa-lg text-primary"></i> Member Email</span>' +
                            v.memberEmail + '\
                                                    </div>\
                                                    <div>\
                                                        <a class="badge badge-secondary">Created_by: ' + v.created_by +
                            '</a>\
                                                    </div>\
                                                    <div>\
                                                        <a class="badge badge-primary font-weight-bold text-white" style="font-size: 12px;"># ' +
                            v.categoryName + '</a>' + blacklish +'\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>');
                        userAlert.append(li);
                    });
                    userAlert.append(addcom);
                } else {
                    userAlert.addClass('d-none');
                }
                $('#backdrop').remove();

                $(".clickAdd").on('click', function() {
                    let modal = $('#modalcompany');
                    modal.find('input[name="id"]').val($(this).attr('data-id'));
                    modal.find('input[name="emailCompany"]').val($(this).attr('data-email'));
                    modal.modal('show');
                })
            },
            error: function(err) {
                console.log(err)
            }
        })
    }

    $('.Addcompany').on('click', function() {
        let modal = $('#modalcompany');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/members/addmember-company',
            data: {
                memberId: modal.find('input[name="id"]').val(),
                email: modal.find('input[name="emailCompany"]').val(),
                category: modal.find('select[name="category"]').val(),
                company_th: $('input[name="company_th"]').val(),
                company_jp: $('input[name="company_jp"]').val(),
            },
            success: function(res) {
                modal.modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Create Success !',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.replace(res.url);
                })
            },
            error: function (error){
                modal.modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.replace(res.url);
                })
            }
        })
    })

    $('#insert').on('click', function() {
        let $this = $(this);
        let into = $(this).closest('.card').find('.into');
        const company_th = $('input[name="company_th"]');
        const company_en = $('input[name="company_en"]');
        const company_jp = $('input[name="company_jp"]');
        const company_zh = $('input[name="company_zh"]');

        if ($this.is(':checked')) {
            company_th.val($('input[name="name_th"]').val())
            company_en.val($('input[name="name_en"]').val())
            company_jp.val($('input[name="name_jp"]').val())
            company_zh.val($('input[name="name_zh"]').val())
            into.each(function() {
                $(this).removeAttr('disabled');
            });
            $.ajax({
                method: 'get',
                url: 'webpanel/members/check/company-name/duplicate',
                data: {
                    name_th: $('input[name="company_th"]').val(),
                    name_en: $('input[name="company_en"]').val(),
                    name_jp: $('input[name="company_jp"]').val(),
                    name_zh: $('input[name="company_zh"]').val()
                },
                success: function(res) {
                    let rows = $(
                        '<div class="alert alert-danger company-name-duplicate" style="font-weight:normal;"></div>'
                    );
                    if (res.length > 0) {
                        $.each(res, function(i, v) {
                            let col = $('<div class="row">\
                                        <div class="col-lg-4">\
                                            ' + (i + 1) + '. <span class="badge badge-danger">TH</span> ' + v.name.th + '\
                                        </div>\
                                        <div class="col-lg-4">\
                                            <span class="badge badge-danger">JP</span> ' + v.name.jp + ' \
                                        </div>\
                                        <div class="col-lg-4">\
                                            <span class="badge badge-danger">EMAIL</span> ' + v.email + '\
                                        </div>\
                                        <div class="col-lg-4">\
                                            <span class="badge badge-danger">MAIN CATEGORY</span> ' + v.main_category + '\
                                        </div>\
                                    </div>');
                            rows.append(col);
                        })
                        $('.company-alert').append(rows);
                    }
                }
            });
        } else {
            into.each(function() {
                $(this).attr('disabled', 'disabled');
            })
            company_th.val('');
            company_en.val('');
            company_jp.val('');
            company_zh.val('');
            $('.company-name-duplicate').remove();
        }

    })

    $('#maincategory').on('change', function() {
        let main = $(this).find(":selected").val();
        $.ajax({
            method: 'get',
            url: 'webpanel/members/getcategorysub',
            data: {
                main: main
            },
            success: function(res) {
                $('#subcategory').find('option[value]').remove();
                $('#category').find('option[value]').remove();
                $.each(res, function(k, v) {
                    $('#subcategory').append(`<option value="${v.id}">${v.name_th}</option>`);
                })
                $('#subcategory').removeAttr('disabled');
            }
        });
    })

    $('#subcategory').on('change', function() {
        let sub = $(this).find(":selected").val();
        $.ajax({
            method: 'get',
            url: 'webpanel/members/getcategory',
            data: {
                sub: sub
            },
            success: function(res) {
                $('#category').find('option[value]').remove();
                $.each(res, function(k, v) {
                    $('#category').append(`<option value="${v.id}">${v.name_th}</option>`);
                })
                $('#category').removeAttr('disabled');
            }
        });
    })
</script>
