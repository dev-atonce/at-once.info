<!DOCTYPE html>
<html lang="en">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Confirmation - At-Once</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link
        href="https://fonts.googleapis.com/css2?family=Monoton&family=Noto+Sans+JP:wght@100;300;500;700;900&family=Roboto:ital,wght@0,100;0,300;1,500&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <style>
        body {
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            top: 0;
            bottom: 0;
        }

        .container {
            box-shadow: 0 0 5px 2px rgba(225, 225, 225);
        }

        .tag:last-child {
            margin: unset;
        }

        .tag {
            display: inline-block;
            background-color: #f3f3f3;
            padding: 5px 10px 7px 10px;
            ;
            border-radius: 5px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .tag a {
            margin-right: 3px;
            padding-left: 5px;
            border-left: 1px solid #007bff;
        }

        button[data-action="submit"]:disabled {
            cursor: not-allowed;
            pointer-events: all !important;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <section>
        <div class="container bg-white">
            <div class="panel">
                <div class="panel-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-center">@lang('phrase.confirmation')</h4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-warning">
                                <span><i class="fas fa-exclamation-triangle"></i> @lang('phrase.check')</span>
                            </div>
                        </div>
                    </div>
                    <form id="contact" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.to') :</label>
                                    <div id="tag-input">
                                        {{-- <span class="tag" data-tag="really">Really&nbsp;<a class="fas fa-times fa-xs"></a></span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.your-company') :</label>
                                    <input type="hidden" name="cid" value="">
                                    <input type="hidden" name="type" value="email">
                                    <input type="text" class="form-control" id="company" name="company"
                                        value="{{ Request::get('company') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.your-mobile') :</label>
                                    <input type="text" class="form-control" name="telephone"
                                        value="{{ Request::get('telephone') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.your-department') :</label>
                                    <input type="text" class="form-control" name="department"
                                        value="{{ Request::get('department') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.your-name') :</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Request::get('name') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.your-email') :</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ Request::get('email') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">@lang('phrase.form.cc') :</label>
                                    <input type="text" class="form-control" name="cc"
                                        value="{{ Request::get('cc') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">@lang('phrase.email.attachment') :</label>
                                    <div class="custom-file">
                                        <input type="file" name="attachment" class="custom-file-input"
                                            id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">@lang('phrase.contact-detail') :</label>
                                    <textarea type="text" class="form-control" name="content" rows="20">{{ Request::get('message') }}</textarea>
                                    <input type="hidden" name="page" id="page" value="{{ Request::get('page') }}"> 
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-success float-right" data-action='next'>
                                    @lang('phrase.next')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate-v1.18.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
</body>

</html>
<div class="modal" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <a class="close" data-dismiss="modal" aria-label="Close" href="javascript:"><span
                        aria-hidden="true">&times;</span></a>
                <span class="modal-title" id="ModalTitle">&nbsp;</span>
                <div class="md-alert"></div>
                <div class="md-list"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div style="display:flex; justify-content: center; margin:15px 0 10px 0;">
                            <div id="g-recaptcha" class="g-recaptcha" data-sitekey="6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB" data-callback="onSubmit"></div>
                        </div>
                    </div>
                </div>
                <div class="md-footer border-top mt-2"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var reRender = function(){
        grecaptcha.reset();
    }
    function onSubmit(token) {
        if(token){
            document.getElementById('Modal').querySelector('[data-action="submit"]').removeAttribute('disabled');
        }
    }

    var form = $("#contact");
    form.validate();

    var url = window.location,
        category = url.pathname.split('/')[2];
    var saveMy = JSON.parse(localStorage.getItem(category));
    var emailObject = {
        alert: {
            success: '{{ __('phrase.email_alert.success') }}',
            error: '{{ __('phrase.email_alert.error') }}'
        },
        class: {
            success: 'alert-success',
            error: 'alert-danger'
        },
        icon: {
            success: 'far fa-check-circle text-success mr-2',
            error: 'fas fa-exclamation-triangle text-danger mr-2'
        }
    };
    if (saveMy != null) {
        // $('input[name="cid"]').val(saveMy.sendTo.id);
        // $('input[name="company"]').val(saveMy.company);
        // $('input[name="telephone"]').val(saveMy.telephone);
        // $('input[name="branch"]').val(saveMy.position);
        // $('input[name="name"]').val(saveMy.name);
        // $('input[name="email"]').val(saveMy.email);
        // $('input[name="cc"]').val(saveMy.cc);
        // $('textarea[name="content"]').val(saveMy.content);
        var lang = '{{ Session('lang') }}',
            hl = (lang == 'th') ? 0 : 1;
        var text = ['ยินยันส่งอีเมล์', 'Confirm sent the email'];

        fetchItem();

        function fetchItem() {
            $('#tag-input').html('');
            $.each(saveMy.sendTo.id, function(k, v) {
                var item = $('<span class="tag"><a class="fas fa-times fa-xs removeItem"></a></span>');
                var company = $('<input type="hidden" name="sendTo[' + k + ']">');
                var to_company = $('<input type="hidden" name="to_company[' + k + ']" value="' + saveMy.sendTo.text[k] + '">');

                $(item, '.tag').attr('data-tag', v);
                $(item, '.tag').prepend(saveMy.sendTo.text[k] + '&nbsp;');
                company.val(v);

                $('#tag-input').append(item, company, to_company);
            })
        }
        $(document).on('click', '.removeItem', function() {
            removeItem($(this).parent())
        })

        function removeItem(el) {
            saveMy.sendTo.id.splice($.inArray(el.val(), saveMy.sendTo.id), 1);
            saveMy.sendTo.text.splice($.inArray(el.data('tag'), saveMy.sendTo.text), 1);
            localStorage.setItem(category, JSON.stringify(saveMy));
            fetchItem();
        }

        $(document).on('click', 'button[data-action="next"]', function() {
            if (form.valid()) {
                if (saveMy.sendTo.id?.length > 0) {

                    const dialog = $('#Modal');
                    const error = '<i class="fas fa-exclamation-triangle text-danger"></i>';
                    const success = '<i class="fas fa-check-circle text-success"></i>';
                    const footer = $(
                        '<div class="md-footer-content d-flex justify-content-end mt-3"><button type="button" class="btn btn-success" data-action="submit" disabled="">Send <i class="far fa-paper-plane"></i></div>'
                        );
                    dialog.modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    });
                    if (dialog.find('.md-footer-content').length == 0) dialog.find('.md-footer').append(footer);
                    const group = $('<div class="list-group mt-3"></div>');

                    if (dialog.find('.list-group').length == 0) {
                        $.each(saveMy.sendTo.id, function(k, v) {
                            const list = $(
                                '<a href="javascript:" class="list-group-item list-group-item-action" data-id="' +
                                saveMy.sendTo.id[k] + '"></a>');
                            list.html((k + 1) + '. ' + saveMy.sendTo.text[k]);
                            group.append(list);
                        })
                    }
                    dialog.find('.md-list').append(group);
                } else {
                    $('button[data-action="submit"]').attr('disabled', 'disabled');
                }
            } else {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน')
            }

        });
        $(document).on('click', 'button[data-action="submit"]', function() {
            const dialog = $('#Modal');
            const companyId = $('.list-group-item').map(function() {
                return $(this).data('id')
            }).get();
            console.log(companyId)
            console.log(document.querySelector('input[name="cid"]'))
            document.querySelector('input[name="cid"]').value = companyId;

            let inputs = form.serialize();
            const alert = {
                error: $('<div class="alert alert-danger mt-3 text-center" role="alert"><i class="' +
                    emailObject.icon.error + '"></i>' + emailObject.alert.error +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    ),
                success: $('<div class="alert alert-success mt-3 text-center" role="alert"><i class="' +
                    emailObject.icon.success + '"></i>' + emailObject.alert.success +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    )
            };
            const footer = dialog.find('.md-footer-content');    



            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `${lang}/${category}/sendmail/to`,
                method: 'post',
                processData: false,
                async: false,
                data: inputs,
                dataType: 'json',
                success: (send) => {
                    footer.prepend(
                        '<button type="button" class="btn btn-success" data-action="success">{{ __('phrase.ok') }}</button>'
                        );
                    footer.find('button[data-action="submit"]').attr('disabled', 'disabled')
                        .toggleClass('btn-success btn-default');
                    if (send === true || send === false) {
                        if (send === true) {
                            dialog.find('.md-alert').append(alert.success);
                            localStorage.removeItem(category);
                            reRender();
                            document.querySelectorAll('.form-control').forEach(el=> el?.classList.remove('valid'));
                            document.querySelectorAll('.form-control').forEach(el=> el.value = '');
                        } else {
                            dialog.find('.md-alert').append(alert.error);
                        }
                    } else {
                        dialog.find('.spinner').remove();
                        dialog.find('.md-alert').append(alert.danger);
                        return false;
                    }
                }
            });
        });
        $(document).on('click', 'button[data-action="success"]', function() {
            window.location.href = lang + '/' + category;
        });

        function sendTo(el) {
            el.removeClass('fa-question-circle');
            el.addClass('fa-check-circle text-success');
            if (el.hasClass('text-success')) {
                return true;
            } else {
                return false;
            }
        }
        $('#Modal').on('hidden.bs.modal', function(e) {
            // localStorage.removeItem(category);
            // window.location.href=lang+'/'+category;
        })
        document.getElementById('inputGroupFile01').addEventListener('change', function() {
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                // var reader = new FileReader();
                // reader.onload = function (e) {
                //     $('#preview').attr('src', e.target.result).fadeIn('slow');
                // }
                // reader.readAsDataURL(input.files[0]);
                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
            }
        });
    }
</script>
