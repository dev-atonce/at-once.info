    const profileType = "{{$row->type}}";
    // if (profileType == 'semi') {
        // document.querySelector('.cover').querySelector('img')?.remove();
        // document.querySelector('.profile-img').closest('[class^="col-"]')?.remove();
        // const companyDetail = document.querySelector('.company-detail');
        // companyDetail.closest('[class^="col-"]').classList.add('col-lg-12');
        // companyDetail.closest('[class^="col-"]').classList.remove('col-lg-9');
        // const detailCotnent = document.querySelector('.detail-content');
        // detailCotnent.querySelectorAll('img').forEach((el) => el.remove());
        // detailCotnent.querySelectorAll('img').forEach((el) => {
        //     el.style.filter = 'blur(16px) grayscale(70%)';
        // });
    // }
    modal = $('#popupBasic');
    timeout = 5000;
    customer = '{{ @$customerStatus->id }}';
    setTimeout(() => {
        if (modal.length > 0) modal.modal('show');
    }, timeout);
    document.addEventListener('click', function(e) {
        click = e.target.closest('.information');
        if (click) {
            modal.modal('show')
        }
        clickHere = e.target.closest('.click-here');
        if (clickHere) {
            modal.modal('hide')
            document.getElementById("name").focus();
            $('html,body').animate({
                scrollTop: $(".contact-full").offset().top
            }, 'slow');
            // ads = clickHere.closest('.modal-body').querySelector('.ads');
            // form = clickHere.closest('.modal-body').querySelector('.form');
            // if (ads.classList.contains('d-none')) {
            //     ads.classList.remove('d-none');
            //     form.classList.add('d-none');
            // } else {
            //     ads.classList.add('d-none');
            //     form.classList.remove('d-none');
            // }
        }
        Cancel = e.target.closest('.btn-cancel');
        if (Cancel) {
            ads = Cancel.closest('.modal-body').querySelector('.ads');
            form = Cancel.closest('.modal-body').querySelector('.form');
            if (ads.classList.contains('d-none')) {
                ads.classList.remove('d-none');
                form.classList.add('d-none');
            } else {
                ads.classList.add('d-none');
                form.classList.remove('d-none');
            }
        }
        Send = e.target.closest('.btn-send');
        if (Send) {
            ads = Send.closest('.modal-body').querySelector('.ads');
            form = Send.closest('.modal-body').querySelector('.form');
            request = [];
            const fd = new FormData();

            $(form.querySelector('form')).validate({
                ignore: [],
                rules: {
                    name: {
                        required: true
                    },
                    telephone: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    detail: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: '*'
                    },
                    telephone: {
                        required: '*',
                        number: '*'
                    },
                    email: {
                        required: '*',
                        email: '*'
                    },
                    detail: {
                        required: '*'
                    },
                },
                errorPlacement: function(er, el) {
                    er.addClass('mb-0 ml-1');
                    el.closest('.form-group').find('label').append(er);
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    Send.setAttribute("disabled", "");
                    if ($(form).find('[role="alert"]').length == 0) {
                        alert = $('<div class="alert alert-dismissible text-center fade show" role="alert">\
                            <strong>Holy guacamole!</strong> <span>You should check in on some of those fields below.</span>\
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                            </button>\
                            </div>');
                    } else {
                        alert = $(form).find('.alert');
                    }
                    fd.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    fd.append('company', $('.card-basic').find('h1').text())
                    fd.append("name", modal.find('input[name="name"]').val());
                    fd.append("telephone", modal.find('input[name="telephone"]').val());
                    fd.append("email", modal.find('input[name="email"]').val());
                    fd.append("detail", modal.find('textarea[name="detail"]').val());
                    store = $.ajax({
                        method: 'POST',
                        url: 'api/contact/s/basic',
                        async: false,
                        processData: false,
                        contentType: false,
                        data: fd
                    }).responseJSON;

                    if (store.statusCode == 200) {
                        alert.removeClass('alert-danger');
                        alert.addClass('alert-success');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);

                        modal.find('input[name="name"]').val('');
                        modal.find('input[name="telephone"]').val('');
                        modal.find('input[name="email"]').val('');
                        modal.find('textarea[name="detail"]').val('');

                        Send.removeAttribute("disabled", "");
                    } else {
                        alert.removeClass('alert-success');
                        alert.addClass('alert-danger');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);

                        Send.removeAttribute("disabled", "");
                    }
                    alert.appendTo($(form).find('.form-title'));
                }
            })
        }
        SendForm = e.target.closest('.send-form');
        if (SendForm) {
            form = SendForm.closest('.contact-full').querySelector('form');
            const fd = new FormData();

            $(form).validate({
                ignore: [],
                rules: {
                    name: {
                        required: true
                    },
                    telephone: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    detail: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: '*'
                    },
                    telephone: {
                        required: '*',
                        number: '*'
                    },
                    email: {
                        required: '*',
                        email: '*'
                    },
                    detail: {
                        required: '*'
                    },
                },
                errorPlacement: function(er, el) {
                    er.addClass('mb-0 ml-1');
                    el.closest('.form-group').find('label').append(er);
                },
                submitHandler: function(form, e) {
                    SendForm.setAttribute("disabled", "");
                    e.preventDefault();
                    if ($(form).find('[role="alert"]').length == 0) {
                        alert = $('<div class="alert alert-dismissible text-center fade show" role="alert">\
                            <strong>Holy guacamole!</strong> <span>You should check in on some of those fields below.</span>\
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                            </button>\
                            </div>');
                    } else {
                        alert = $(form).find('.alert');
                    }
                    fd.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    fd.append('company', $('.card-basic').find('h1').text())
                    fd.append("name", $('input[name="name"]').val());
                    fd.append("telephone", $('input[name="telephone"]').val());
                    fd.append("email", $('input[name="email"]').val());
                    fd.append("detail", $('textarea[name="detail"]').val());
                    store = $.ajax({
                        method: 'POST',
                        url: 'api/contact/s/basic',
                        async: false,
                        processData: false,
                        contentType: false,
                        data: fd
                    }).responseJSON;

                    if (store.statusCode == 200) {
                        alert.removeClass('alert-danger');
                        alert.addClass('alert-success');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);

                        $('input[name="name"]').val('');
                        $('input[name="telephone"]').val('');
                        $('input[name="email"]').val('');
                        $('textarea[name="detail"]').val('');

                        SendForm.removeAttribute("disabled", "");
                    } else {
                        alert.removeClass('alert-success');
                        alert.addClass('alert-danger');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);
                        SendForm.removeAttribute("disabled", "");
                    }
                    alert.appendTo($(form).find('.form-title'));
                }
            })
        }
    })

    if (customer) {
        $(function() {
            const backlink = document.querySelectorAll('a[href="{{ $row->website }}"]')
            for (let i = 0; i < backlink.length; i++) {
                $('a[href="{{ $row->website }}"]').addClass('countOfClick').css('text-decoration', 'none');
            }
        })
    }

    $(function() {
        $('.chatbox-top').click(function() {
            $(this).closest('.chatbox').toggleClass('chatbox-min');
        });
        $('.fa-close').click(function() {
            $(this).closest('.chatbox').hide();
        });
    });

    var d = $.fn.deviceDetector,
        _id = '{{ $row->id }}',
        categoryId = '{{ $categoryId }}';
    var pageUrl = window.location.pathname.split('/');
    category = pageUrl[2];
    var ipUrl = "https://get.geojs.io/v1/ip/geo.js";
    var geoIp = $.ajax({
        url: ipUrl,
        async: false,
        dataType: 'jsonp',
        success: function(json) {
            return json.ip;
        }
    });

    $(function() {
        $('a.countOfClick').click(function() {
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 'w',
                    category: categoryId,
                    locate: geoIp
                }
            });
        });
    });

    $(function() {
        $('a.tel-com-top').click(function() {
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 't',
                    category: categoryId,
                    locate: geoIp
                }
            });
        });
    });

    $(function() {
        $('a.mailtop').click(function() {
            if (!customer) {
                actionAd($(this));
                $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            }
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 'm',
                    category: categoryId,
                    locate: geoIp
                }
            });
        });
    });

    if ($('.wharehose li').length > 2) {
        $('.see-all').click(function() {
            $(this).toggleText("{{ __('phrase.see - more') }}", '{{ __('phrase.see - less ') }}');
            $('.see-all').prev().find('[class]').toggleClass('d-none d-block');
        });
    }
    if ($('.company-logo').length > 0) {
        $('.company-logo').each(function() {
            var intials = $(this).data('name').charAt(0) + $(this).data('name').charAt(1);
            $(this).html('<span>' + intials + '</span>');

        })
    }

    function scrollNav() {
        $('.contact-company-top a.service-pos').click(function() {
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 160
            }, 300);
            return false;
        });
        $('.info-update a').click(function() {
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 160
            }, 300);
            return false;
        });
        if (customer) {
            $('.contact-company-top a.mailtop').click(function() {
                var formQuotation = document.getElementById('formQuotation');
                formQuotation.style.height = null;
                $('html, body').stop().animate({
                    scrollTop: $($(this).attr('href')).offset().top - 160
                }, 300);
                return false;
            });
        }
    }

    scrollNav();
    blog = document.getElementById('blog');
    services = document.getElementById('services');

    blogBtn = document.getElementsByClassName('blog-pos');
    serviceBtn = document.getElementsByClassName('service-pos');

    if (blog == null) blogBtn[0]?.setAttribute('href', 'javascript:');
    if (services == null) serviceBtn[0]?.setAttribute('href', 'javascript:');

    function highlight(text) {
        var highlight = window.location.search;
        if (highlight != '') {
            highlight = highlight.replace('?', '');
            highlight = decodeURIComponent(highlight);
            highlight = highlight.split('&');
            const ar = [];
            for (i = 0; i < highlight.length; i++) {
                let name = highlight[i].split('=')[0].toString();
                ar.push({
                    name: highlight[i].split('=')[0],
                    value: highlight[i].split('=')[1]
                });
            }
            let CKH = false;
            let searchTerm = null;
            for (j = 0; j < ar.length; j++) {
                if (ar[j].name == 'highlight') searchTerm = ar[j].value;
                CKH = true;
            }

            if (CKH === true) {
                $(".detail-content").unmark().mark(searchTerm, {
                    "acrossElements": true,
                    "separateWordSearch": false
                });
                $(".highlight").unmark().mark(searchTerm, {
                    "acrossElements": true,
                    "separateWordSearch": false
                });
            }
        }
        // var inputText = document.getElementsByClass("highlight");
        // var innerHTML = inputText.innerHTML;
        // var index = innerHTML.indexOf(text);
        // if (index >= 0) {
        // innerHTML = innerHTML.substring(0,index) + "<span class='text-highlight'>" + innerHTML.substring(index,index+text.length) + "</span>" + innerHTML.substring(index + text.length);
        // inputText.innerHTML = innerHTML;
        // }
    }

@if (!$customerStatus)
<script src="js/contact-function.js?v=001"></script>
@else
<script>
    var formQuotation = document.getElementById('formQuotation');
    document.addEventListener('click', function(e) {
        const buttonQuotation = e.target.closest('.mail');
        if (buttonQuotation) {
            formQuotation.style.height = null;
        }
    });
</script>
@endif
<script type="text/javascript" src="js/custom-form-contact.js"></script>
<script src="js/statistics.js?v=000033"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    var reRender = function() {
        grecaptcha.reset();
    };

    var History = history;
    if (History.length == 1 && window.location.search == '') {
        // highlight();
        $('a.message-send').click(function() {
            let ac = actionAd($(this));
            let re = localStorage.getItem('re');
            if (re != null) {
                window.open(`${window.location.origin}${re}`, '_self');
            }
            else {
                if (ac != false) {
                    window.open('', '_self').close();
                }
            }
        });
    } else {
        $('a.message-send').on('click', function() {
            let ac = actionAd($(this));
            if (ac != false) {
                let path = window.location.pathname.split("/");
                window.location.replace(`${window.location.origin}/${path[1]}/${path[2]}?search`);
            }
        });
    }

    function onSubmit(token) {
        if (token) {
            document.getElementById('quotationForm').querySelector('[type="submit"]').removeAttribute('disabled');
        }
    }

    $('#quotationForm').submit(function(e) {
        e.preventDefault();
    }).validate({
        validClass: "valid",
        errorClass: "invalid",
        errorElement: "small",
        rules: {
            company: {
                required: true
            },
            name: {
                required: true
            },
            telephone: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            department: {
                required: true
            },
            detail: {
                required: true
            },
        },
        messages: {
            company: {
                required: "{{ __('phrase.contact.validate.company') }}"
            },
            name: {
                required: "{{ __('phrase.contact.validate.name') }}"
            },
            telephone: {
                required: "{{ __('phrase.contact.validate.telephone') }}",
                number: "{{ __('phrase.contact.validate.numberonly') }}"
            },
            email: {
                required: "{{ __('phrase.contact.validate.email') }}",
                email: "{{ __('phrase.contact.validate.email-pattern') }}"
            },
            department: {
                required: "{{ __('phrase.contact.validate.department') }}"
            },
            detail: {
                required: "{{ __('phrase.contact.validate.detail') }}"
            },
        },
        submitHandler: function(form) {
            inputs = $('#quotationForm').serialize();
            const res = $.ajax({
                method: 'post',
                url: 'my/service/request/quotation',
                data: inputs,
                async: false,
            }).responseJSON;
            alert = document.createElement('div');
            alert.setAttribute('class',
                `alert${res.statusCode == 200 ?' alert-success': ' alert-danger'} text-center w-100`);
            alert.innerHTML = `${res.message.replace('ที่','ที่ <br/>')}`;
            $('#quotationForm').find('.alert')?.remove();
            document.getElementById('quotationForm').querySelector('.row').prepend(alert);
            document.getElementById('quotationForm').querySelector('[type="submit"]').setAttribute(
                'disabled', true);
            reRender();
            if (res.statusCode == 200) {
                $('#quotationForm').find("input[name='company']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='name']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='telephone']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='email']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='department']").val('').removeClass('valid');
                $('#quotationForm').find("textarea[name='detail']").val('').removeClass('valid');
            }
        }
    })

    function getLanguageFromCookie() {
        let name = 'googtrans=';
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
    }

    function setCompapnayName() {
        let lng = getLanguageFromCookie();
        lng = lng.replace('/auto/', '');
        let Heading = document.querySelector('.countOfClick');
        if (lng != 'th') {
            Heading.innerHTML = Heading.getAttribute('data-en')
        } else {
            Heading.innerHTML = Heading.getAttribute('data-th')
        }
        let more_jp = Heading.getAttribute('more-jp');
        if (more_jp == 'true') {
            more = document.createElement('div');
            more.innerHTML = '{!!$row->more_jp!!}'
            document.querySelector('.detail-content').innerHTML = '';
            document.querySelector('.detail-content').append(more);
        }
    }
    setCompapnayName()

    document.addEventListener('change', function(e) {
        const languageSwitch = e.target.closest('.goog-te-combo');
        if (languageSwitch) setCompapnayName();
    })


