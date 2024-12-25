let upTime = true;
var timer = true;
var lang = $(document).find('html').attr('lang');
var validate = {
    message: {
        th:{
            name:'กรุณากรอกชื่อ',
            telephone:'กรุณากรอกเบอร์โทรศัพท์',
            companyName:'กรุณากรอกชื่อบริษัท',
            letteronly:'กรุณากรอกตัวอักษร',
            numberonly:'กรุณากรอกตัวเลข'
        },
        jp:{
            name:'Please enter your name',
            telephone:'Please enter your telephone number',
            companyName:'Please enter you company name'
        },
        en:{
            name:'Please enter your name',
            telephone:'Please enter your telephone number',
            companyName:'Please enter you company name'
        },
    }
}
var Alert = {
    success: '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">\
    <strong>สำเร็จ!</strong> ทางเราได้รับข้อความของคุณเรียบร้อยแล้ว และจะมีพนักงานติดต่อกลับหาคุณ.\
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
      <span aria-hidden="true">&times;</span>\
    </button>\
  </div>',
    danger:'<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\
        <strong>Opps!</strong> an error occurred.\
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
          <span aria-hidden="true">&times;</span>\
        </button>\
      </div>'
}

// const ThreeTimes = () =>
// {
//     $.ajax({
//         method:'get',
//         url:'api/get/counter/times',
//         data:{
//             page: 'promotion-package'
//         },
//         success:function(res){
//             if(res>=3){
//                 PopupCard(true)
//             }
//         },
//         error:function(err){ console.log(err) }
//     })
// }

function Pop(){
    pop = JSON.parse(localStorage.getItem("PopupCard"));
    return pop;
}

jQuery.validator.addMethod("letteronly", function(value, element, param) {
    return value.match(new RegExp("." + param + "$"));
});

var reRender = function() {
    grecaptcha.reset();
};

const PopupCard = (action) => {

    const pop = Pop();
    const caption = 'ขอบคุณที่สนใจในบริษัทของเรา หากต้องการสอบถามข้อมูลเพิ่มเติม สามารถกรอกรายละเอียดด้านล่าง  หลังจากนั้นจะมีเจ้าหน้าที่ติดต่อกลับค่ะ';
    contentToggleClass = (pop?.toggle=='bar')?'d-none':'d-block';
    barToggleClass = (pop?.toggle=='bar')?'d-block':'d-none';

    var popup = $('<div class="popup-dialog dialog-backdrop">\
        <div class="dialog-bar '+barToggleClass+'">\
            <a class="dialog-toggle contact-circle" toggle-show="'+action+'">\
                <div class="button-circle">\
                        <div class="img-circle">\
                            <img src="images/page-package/patznun.jpg" class="img-fluid">\
                        </div>\
                        <div class="button-messenger alert alert-dismissible fade show" role="alert"> ติดต่อเรา คลิก\
                            <span class="close-icon-wrapper" aria-hidden="true"><i class="fas fa-times fa-1x"></i></span>\
                            <div class="drawer"><div class="speech_bubble_arrow"></div>\
                        </div>\
                    </div>\
                </div>\
                <span class="tawk-badge tawk-flex tawk-flex-center tawk-flex-middle tawk-min-badge heartBeat" style="inset: auto auto 145px 40px;"><i class="icofont-ui-touch-phone"></i></span>\
            </a>\
        </div>\
        <div class="dialog-content popup_contact  '+contentToggleClass+'" style=" ">\
            <div class="card-bussiness ">\
            <div class="card-bussiness-body">\
            <a href="javascript:" class="dialog-minimize"">\
                <span><i class="fas fa-times"></i></span>\
            </a>\
              <div class="dialog-header">\
            <div class="card-cover" style="background-image: url(https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80)"></div>\
          </div>\
           <div class="dialog-body mt-4">\
              <div class="grid-card">\
             <div class="photo"><img src="images/page-package/patznun.jpg" class="img-fluid card-avatar"></div>\
              <div class="content dialog-content">\
                <div class="card-fullname">Patznun Somnam</div>'+caption+'</div>\
            </div>\
            <form id="popupCard" onsubmit="return false;">\
                    <div class="row">\
                        <div class="col-12">\
                            <label for="cardNumber" class="card-input__label">Name</label>\
                            <input type="text" name="name" class="form-control" placeholder="ชื่อ" autocomplete="off"/>\
                            <input type="hidden" name="type" value="atonce"/>\
                        </div>\
                        <div class="col-12">\
                            <label for="cardNumber" class="card-input__label">Telephone</label>\
                            <input type="text" name="telephone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off"/>\
                        </div>\
                        <div class="col-12">\
                            <label for="cardNumber" class="card-input__label">CompanyName</label>\
                            <input type="text" name="companyName" class="form-control" placeholder="ชื่อบริษัท" autocomplete="off"/>\
                        </div>\
                    </div>\
                    <div style="display:flex; justify-content:center; margin:0 0 10px 0;">\
                        <div id="captcha_container"></div>\
                    </div>\
                    <div class="dialog-footer mt-4">\
                        <div style="display: flex;align-items: flex-start;flex-wrap: wrap;">\
                              <div class="card-input__input"><button type="submit" class="btn btn-confirm" disabled>Confirm</button></div>\
                              <div class="card-input__input"><button type="button" class="btn btn-secondary">Cancel</button></div>\
                        </div>\
                    </div>\
                 </form>\
            </div>\
             </div>\
              </div>\
        </div>\
    </div>');
    // <div class="d-flex justify-content-center mb-3">\
    //     <div class="form-check ">\
    //         <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" '+checked+' />\
    //         <label class="form-check-label" htmlFor="flexCheckDefault">\
    //             ไม่ต้องแสดงอีก\
    //         </label>\
    //     </div>\
    // </div>\

    if ($(document).find('.popup-dialog').length==0){
        if(pop?.show===true) {
            $(document).find('body').append(popup);
            var loadCaptcha = function() {
                captchaContainer = grecaptcha.render('captcha_container', {
                    'sitekey' : '6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB',
                    'callback' : function(response) {
                        document.querySelector('#popupCard').querySelector('.btn-confirm').removeAttribute('disabled');
                    }
                });
            };
            loadCaptcha()
        }
    }


    const sendTo = async () =>
    {
        
        // const name = popup.find('input[name="name"]').val();
        // const telephone = popup.find('input[name="telephone"]').val();
        // const companyName = popup.find('input[name="companyName"]').val();
        let inputs = $('#popupCard').serialize();
        axios({
            method: 'post',
            url: `api/send/sms-to-sale`,
            data: inputs
        })
        .then((res) => {
            let code = 'danger';
            if(res.data.status=='success') code = 'success';      
            popup.find('.alert')?.remove();
            $(Alert[code]).insertBefore(popup.find('#popupCard'));
            setTimeout(function(){
                reRender();
                document.getElementById('popupCard').querySelectorAll('.form-control').forEach(el => el.value = '');
                document.getElementById('popupCard').querySelectorAll('.form-control').forEach(el => el.classList.remove('valid'));
            },1000);
        })
        .catch(err => console.log(err));

    }

    
    $('#popupCard').validate({
        ignore: [],
        errorElement: "span",
        rules: {
            name:{  required: true,
                    letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"},
            telephone:{ required: true,
                        letteronly: "[0-9]+" },
            companyName:{ required: true }
        },
        messages: {
            name:{  required: validate.message[lang].name,
                    letteronly:validate.message[lang].letteronly },
            telephone:{ required: validate.message[lang].telephone,
                        letteronly:validate.message[lang].numberonly },
            companyName:{ required: validate.message[lang].companyName }
        },
        submitHandler: function (form) {
            sendTo();
            document.getElementById('popupCard').querySelector('.btn-confirm').setAttribute('disabled',true);
        }
    })
    popup.on('click','.close-icon-wrapper',function(){
        $(this).parent().remove();
    });
    popup.on('click','button.btn-secondary',function(){
        let pop = JSON.parse(localStorage.getItem("PopupCard"));
        var currentBtn = $(this);
        minimizeBtn = currentBtn.closest('.dialog-content').find('a.dialog-minimize');
        minimizeBtn.closest('.dialog-content').toggleClass('d-block d-none');
        minimizeBtn.closest('.popup-dialog').find('.dialog-bar').toggleClass('d-block d-none')
        minimizeBtn.closest('.popup-dialog').removeClass('dialog-backdrop');
        pop = {
            show: true,
            toggle: 'content'
        };
        localStorage.setItem("PopupCard",JSON.stringify(pop));
    })
    popup.on('click','#flexCheckDefault',function(){
        if($(this).is(':checked')){
            localStorage.setItem('dontShowAgain',true);
        }else{
            localStorage.setItem('dontShowAgain',false);
        }
    })
}

function toogle(e) {
    dialog = localStorage.getItem("PopupCard");
    toggle = JSON.parse(dialog);
    
    var currentBtn = $(e);
    if(currentBtn.hasClass('dialog-minimize')){
        currentBtn.closest('.dialog-content').toggleClass('d-block d-none');
        currentBtn.closest('.popup-dialog').find('.dialog-bar').toggleClass('d-block d-none');
        currentBtn.closest('.popup-dialog').removeClass('dialog-backdrop');
        pop = {
            show: true,
            toggle: 'bar'
        }
    }else{
        currentBtn.closest('.dialog-bar').toggleClass('d-block d-none');
        currentBtn.closest('.popup-dialog').find('.dialog-content').toggleClass('d-none d-block')
        currentBtn.closest('.popup-dialog').addClass('dialog-backdrop');
        pop = {
            show: true,
            toggle: 'content'
        }
    }
    localStorage.setItem("PopupCard",JSON.stringify(pop));
}

$(document).on('click','a.dialog-toggle', function(){
    toogle(this)
})
$(document).on('click','a.dialog-minimize',function(){
    toogle(this);
    close();
})

localStorage.setItem('popupLeft',15);

$(window).focus(function(){
    timer = true;   
    if(upTime===true) countdown();
})
$(window).blur(function(){
    timer = false;
    
})
const close = async () => {
    const data = await axios.get("api/statistics/close-popup");
}
function countdown() {
    let pop = JSON.parse(localStorage.getItem("PopupCard"));
    if(upTime===true && $(document).find('.popup-dialog').length==0){
        let popupLeft = localStorage.getItem('popupLeft');
        setInterval(function(){
            if(timer===true){
                if (popupLeft == -1) {
                    // clearTimeout(timerId);
                    localStorage.removeItem('popupLeft');
                    if(pop?.show === false){
                        PopupCard(true);
                        localStorage.setItem("PopupCard",JSON.stringify({show:true,toggle:'content'}));
                    }else{
                        PopupCard(false);
                        localStorage.setItem("PopupCard",JSON.stringify({show:false,toggle:'content'}));
                    }
                } else {
                    popupLeft--;
                    localStorage.setItem('popupLeft',popupLeft);
                    console.log(popupLeft);
                }
                
            }
        },1000);    
    }
}
// ThreeTimes()
countdown()