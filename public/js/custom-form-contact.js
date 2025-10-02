var ipUrl = "https://get.geojs.io/v1/ip/geo.js",
    geoIp = null;

// Load geo IP asynchronously
axios.get(ipUrl).then(function(response) {
    geoIp = response.data;
    console.log(geoIp);
}).catch(function(error) {
    console.log('Geo IP error:', error);
});


$('.light-g').each(function () { $(this).children().lightGallery({ thumbnail: true, download: false }) });
$(document).on('click', '[data-target="#exampleModal"]', function () {
    const element = $(this);
    staticsCapture(element);
    
    axios.get($('html').attr('lang') + '/' + category + '/cp/d/' + element.attr('data-cp'))
        .then(function(response) {
            $('#exampleModal').find('.col-lg-12').append(response.data);
            $('#exampleModal').find('.new-tab').attr({
                'target': '_blank',
                'href': element.attr('data-full')
            });
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            console.log('Modal content error:', error);
        });
})
$(document).on('click', 'a.new-tab', function () {
    $('#exampleModal').modal('hide');
})
$('#exampleModal').on('hide.bs.modal', function () {
    $(this).find('.col-lg-12').html('');
})

jQuery.validator.addMethod("letteronly", function (value, element, param) {
    return value.match(new RegExp("." + param + "$"));
});
// $(document).on('click','.mail',function(){
//     const id = $(this).attr('tag');
//     $('.comp-select[value="'+id+'"]').prop('checked',true);
//     actionAd($(this));
//     $('#exampleModal').modal('toggle');
//     $('html,body').animate({
//         scrollTop: $('.company-form').offset().top - 200
//     },500);
// });

// $(document).on('click','a.tel',function(){ 
//     $('.tel-com').parent().toggleClass('d-none d-block');
//     if($('.tel-com').parent().hasClass('d-block')){
//       axios({
//         method:'post',
//         url:'api/store/statistics/click',
//         data:{_method:'PUT',company:$(this).attr('href').split(':')[1],c:'t',locate:converseToJson(geoIp)}
//       });
//     }
// });

/**========= Form contact validate =========*/
$('#formContact').validate({
    ignor: [],
    errorElement: "em",
    errorClass: "invalid",
    rules: {
        company: { required: true },
        name: {
            required: true,
            letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"
        },
        department: { required: true },
        telephone: { required: true, digits: true },
        email: { required: true, email: true },
        message: { required: true },
    },
    messages: {
        company: { required: 'Required' },
        name: {
            required: 'Required',
            letteronly: 'Letter Only',
        },
        department: { required: 'Required' },
        telephone: { required: 'Required', digits: 'Numbers only' },
        email: { required: 'Required', email: 'Invalid email' },
        message: { required: 'Required' },
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },
    highlight: function (element, errorClass) {
        if (errorClass == 'invalid') {
            $(element).addClass(errorClass).removeClass('valid');
            $(element).next().addClass(errorClass).removeClass('valid');
            $(element).next().next().addClass(errorClass).removeClass('valid');
        } else {
            $(element).removeClass(errorClass);
            $(element).next().removeClass(errorClass);
            $(element).next().next().removeClass(errorClass);
        }
    },
    submitHandler: function (form, event) {
        const errorCom = `<em id="company-error" class="invalid" style="display: table;">กรุณาเลือกบริษัทที่ต้องการติดต่อ</em>`;
        companySelect = $('#companyList');
        if (companySelect.html() == '') {
            companySelect.addClass('invalid');
            $(errorCom).insertAfter(companySelect);
        } else {
            companySelect.removeClass('invalid');
            companySelect.parent().find('em.invalid').remove();
            event.preventDefault();
            var getS = JSON.parse(localStorage.getItem(category));
            var saveMy = {
                company: $('input[name="company"]').val(),
                telephone: $('input[name="telephone"]').val(),
                position: $('input[name="position"]').val(),
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                content: $('textarea[name="message"]').val(),
                sendTo: getS.sendTo
            };
            localStorage.setItem(category, JSON.stringify(saveMy));
            form.submit();
        }
    }
})
var reRender = function() {
    grecaptcha.reset();
};

$('#formContactPackage').validate({
    ignore: [],
    errorElement: "span",
    rules: {
        company: { required: true },
        name: {
            required: true,
            letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"
        },
        department: { required: true },
        telephone: { required: true, digits: true },
        email: { required: true, email: true },
        detail: { required: true },
    },
    messages: {
        company: { required: 'กรุณากรอกชื่อบริษัท' },
        name: {
            required: 'กรุณากรอกชื่อของคุณ',
            letteronly: 'ตัวอักษรเท่านั้น',
        },
        department: { required: 'กรุณากรอกแผนกของคุณ' },
        telephone: { required: 'กรุณากรอกหมายเลขโทรศัพท์', digits: 'ตัวเลขเท่านั้น' },
        email: { required: 'กรุณากรอกอีเมล', email: 'กรุณากรอกอีเมลให้ถูกต้อง' },
        detail: { required: 'กรุณากรอกรายละเอียดการติดต่อ' },
    },
    submitHandler: function (form) {
        inputs = $('#formContactPackage').serialize();
        // fd = new FormData();
        // fd.append('g-recaptcha',$())
        // fd.append('company', $('input[name="company"]').val());
        // fd.append('name', $('input[name="name"]').val());
        // fd.append('telephone', $('input[name="telephone"]').val());
        // fd.append('email', $('input[name="email"]').val());
        // fd.append('department', $('input[name="department"]').val());
        // fd.append('detail', $('textarea[name="detail"]').val());
        // fd.append('page', $('input[name="page"]').val());
        // fd.append('package', $('input[name="package"]').val());
        // fd.append('type', 'atonce');
        axios.post('api/package/sendmail', inputs, {
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).then(function(result) {
            Swal.fire({
                icon: 'success',
                title: 'ส่งอีเมลสำเร็จแล้ว',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                reRender();
                document.querySelectorAll('.form-control').forEach(el=> el.classList.remove('valid'));
                document.querySelectorAll('.form-control').forEach(el=> el.value = '');
            });
        }).catch(function(err) {
            Swal.fire({
                icon: 'danger',
                title: 'ไม่สามารถส่งได้ กรุณาลองใหม่อีกครั้ง',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }
})
/**========= Mobile Form contact validate =========*/
$('#mobileFormContact').validate({
    ignor: [],
    errorElement: "em",
    errorClass: "invalid",
    rules: {
        company: { required: true },
        name: {
            required: true,
            letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"
        },
        department: { required: true },
        telephone: { required: true, digits: true },
        email: { required: true, email: true },
        message: { required: true },
    },
    messages: {
        company: { required: 'Required' },
        name: {
            required: 'Required',
            letteronly: 'Letter Only'
        },
        department: { required: 'Required' },
        telephone: {
            required: 'Required', digits
                : 'Number only'
        },
        email: { required: 'Required', email: 'Invalid email' },
        message: { required: 'Required' },
    },
    errorPlacement: function (error, element) {
        error.insertAfter(element);
        console.log(element)
    },
    highlight: function (element, errorClass) {
        $(element).addClass(errorClass);
        $(element).next().addClass(errorClass);
        $(element).next().next().addClass(errorClass);
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        var getS = JSON.parse(localStorage.getItem(category));
        var saveMy = {
            company: $('input[name="company"]').val(),
            telephone: $('input[name="telephone"]').val(),
            position: $('input[name="position"]').val(),
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            content: $('textarea[name="message"]').val(),
            sendTo: getS.sendTo
        };
        localStorage.setItem(category, JSON.stringify(saveMy));
        form.submit();
    }
})

var NumberOnly = parseFloat($('input[name="telephone"]').val());
if (isNaN(NumberOnly) || NumberOnly < 150) {
    $('input[name="telephone"]').fadeIn(600);
}
function converseToJson(data) {
    if (geoIp != null && typeof data === 'string') {
        geoIp = data.replace('geoip', '');
        geoIp = geoIp.replace('(', '');
        geoIp = geoIp.replace(')', '');
        geoIp = JSON.parse(geoIp);
        return geoIp;
    } else {
        return geoIp;
    }
}

function staticsCapture(el) {
    if (el.attr('capture') == 'banner') {
        axios.post('api/store/statistics/detail', {
            _method: 'PUT',
            company: el.attr('data-id'),
            category: el.attr('category'),
            capture: el.attr('capture'),
            locate: converseToJson(geoIp)
        }).catch(function(error) {
            console.log('Statistics capture error:', error);
        });
    }
}