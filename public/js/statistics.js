var d = $.fn.deviceDetector;
var lang = $(document).find('html').attr('lang');
let upTime = localStorage.getItem('upTime');
if(upTime == null) localStorage.setItem('upTime',false);

var timer = true;
// var stopTimer = localStorage.getItem('stopTimer');
var ipUrl = "https://get.geojs.io/v1/ip/geo.js",
    pageUrl = window.location.pathname.split('/'),
    geoIp = $.ajax({url:ipUrl,async:false,success:function(res){console.log(res)}}).responseText;
    category = pageUrl[2];
var validate = {
    message: {
        th:{
            name:'กรุณากรอกชื่อ',
            telephone:'กรุณากรอกเบอร์โทรศัพท์',
            companyName:'กรุณากรอกชื่อบริษัท',
            numberonly:'กรุณากรอกตัวเลข',
            letteronly:'กรุณากรอกตัวอักษร'
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

jQuery.validator.addMethod("letteronly", function(value, element, param) {
    return value.match(new RegExp("." + param + "$"));
});
// localStorage.removeItem('stopTimer')

function getPackage(){
    const response = $.ajax({
        url:'api/get/package?cp='+$('a.mail').attr('tag')+'&lang='+$(document).find('html').attr('lang'),
        async:false,
    }).responseJSON
    return response;
}
function converseToJson(data){

    if (data!=null && typeof data === 'string') {
        if(typeof data ==='string') {
            geoIp = data.replace('geoip','');
            geoIp = geoIp.replace('(','');
            geoIp = geoIp.replace(')','');
            geoIp = JSON.parse(geoIp);  
            return geoIp;
        }else{
            return geoIp;
        }
    }else{
        return null;
    }
}
function storeCounter(geoIp){

    axios({
        method: 'post',
        url: 'api/'+category+'/store/counter',
        data: {
            _method: 'PUT',
            company: $('a.mail').attr('tag'),
            locate: converseToJson(geoIp),
            device: d.getInfo(),
            currentUrl: window.location.pathname
        }
    })
    .catch(err=>console.log(err));
}



storeCounter(geoIp); //เก็บสถิติ เข้า company profile

Countdown();

function PopupBusinessCard(action)
{
    let url = window.location.pathname.split("/").find((element) => element == "cp");
    if (url) {
        page = 'Pop-up from CP';
    } else {
        page = 'Pop-up from Blog';
    }
    upTime = Boolean(localStorage.getItem('upTime'));
    pop = JSON.parse(localStorage.getItem('PopupBUsinessCard'));
    
    if(upTime===true)
    {
        let companyLogo = $('.profile-img').attr('src');
        let companyName = $('.company-detail').find('h1').find('a').find('strong').html();
        const caption = 'ขอบคุณสำหรับความสนใจในบริษัทของเราหากลูกค้าต้องการสอบถามข้อมูลเพิ่มเติม สามารถกรอกรายละเอียดด้านล่าง จากนั้นจะมีเจ้าหน้าที่ติดต่อกลับภายใน 10 นาทีค่ะ';
        let companyId = $('a.mail').attr('tag');
        const popup = $(
        `<div class="popup-dialog dialog-centered dialog-backdrop">    
            <div style="display:${pop?.minimize==true?'block':'none'}">
                <a class="dialog-toggle contact-circle" toggle-show="'+action+'">
                    <div class="button-circle">
                            <div class="img-circle" onclick="PopupMinimize(false)">
                                <img src="${companyLogo}" class="img-fluid">
                            </div>
                            <div class="button-messenger alert alert-dismissible fade show" role="alert"> ติดต่อบริษัท คลิก
                                <span class="close-icon-wrapper" aria-hidden="true"><i class="fas fa-times fa-1x"></i></span>
                                <div class="drawer"><div class="speech_bubble_arrow"></div>
                            </div>
                        </div>
                    </div>
                    <span class="tawk-badge tawk-flex tawk-flex-center tawk-flex-middle tawk-min-badge heartBeat" style="inset: auto auto 145px 40px;"><i class="icofont-ui-touch-phone"></i></span>
                </a>
            </div>
            <div class="card-bussiness dialog-content${pop?.minimize==true?' d-none':''}" style="border-radius:8px; display:flex; flex-direction:column; -webkit-transition:opacity 400ms ease-in; -moz-transition:opacity 400ms ease-in; transition: opacity 400ms ease-in;">
                <a href="javascript:" class="dialog-minimize" onclick="PopupMinimize(true)">
                    <span><i class="fas fa-times"></i></span>
                </a>
                    <input type="hidden" name="company" value="${companyId}">
                    <div class="dialog-header">
                            <div class="card-cover" style="background-image: url(https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80)"></div>
                        </div>
                        <div class="dialog-body mt-4">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="${companyLogo}" class="img-fluid card-avatar">
                                </div>
                                <div class="col-lg-9">
                                    <div class="dialog-content">
                                    <div class="card-fullname">${companyName}</div>${caption}</div>
                                </div>
                            </div>
                            <form id="businessCard" onsubmit="return false;">
                                <input type="hidden" name="thisCompany" value="${companyName}">
                                <input type="hidden" name="lang" value="${lang}">
                                <input type="hidden" name="type" value="customer">
                                <input type="hidden" name="page" value="${page}">
                                <input type="hidden" name="companyId" value="${companyId}">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="cardNumber" class="card-input__label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="ชื่อ" autocomplete="off"/>
                                    </div>
                                    <div class="col-12">
                                        <label for="cardNumber" class="card-input__label">Telephone</label>
                                        <input type="text" name="telephone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off"/>
                                    </div>
                                    <div class="col-12">
                                        <label for="cardNumber" class="card-input__label">Company Name</label>
                                        <input type="text" name="companyName" class="form-control" placeholder="ชื่อบริษัท" autocomplete="off"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <div style="display:flex;justify-content: center;margin:15px 0 10px 0;">
                                            <div id="captcha_container"></div>
                                        </div>
                                    </div>
                                </div>
                            <div class="dialog-footer mt-3">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-confirm" style="minWidth:100;margin:0 5px 0 0" disabled="">Confirm</button>
                                    <button type="button" class="btn btn-secondary" onclick="PopupMinimize(true)" style="minWidth:100; margin:0 0 0 5px">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>`);
       
        if ($(document).find('.popup-dialog').length==0) 
        {
            $(document).find('body').append(popup);

            var loadCaptcha = function() {
                captchaContainer = grecaptcha.render('captcha_container', {
                    'sitekey' : '6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB',
                    'callback' : function(response) {
                        document.querySelector('#businessCard').querySelector('[type="submit"]').removeAttribute('disabled');
                    }
                });
            };
            loadCaptcha();
            let companyId = $('a.mail').attr('tag');
            axios({
                method: 'post',
                url: `api/statistics/show-popup`,
                data: {
                    companyId: companyId,
                }
            }).then((res => {
                if(res.data == false){
                    console.log(res.status)
                }
            }))
        }

        const messageResponse = (code, msg) => 
        {
            popup.find('.alert').remove();
            let alert = $('<label class="alert alert-'+code+' text-center" style="width:100%">'+msg+'</alert>');
            popup.find('form').prepend(alert);
        }
        const sendTo = async () => 
        {
            let inputs = $("#businessCard").serialize();

            await axios({
                method: 'post',
                url: `api/send/sms`,
                data: inputs
            })
            .then((res) => {
                grecaptcha.reset(captchaContainer);
                let code = 'danger';
                if(res.data.status=='success'){
                    code = 'success';
                }
                messageResponse(code, res.data.message);
                popup.find('input[name="name"]').val('');
                popup.find('input[name="telephone"]').val('');
                popup.find('input[name="companyName"]').val('');
                popup.find('input').removeClass('valid');
                $('.btn-confirm').attr("disabled", false);
            })
            .catch(err => console.log(err));
        }

        
        $('#businessCard').validate({
            ignore: [],
            errorElement: "span",
            rules: {
                name:{ required:function(){
                    return ($('#flexCheckDefault').is(':checked'))? false : true;
                },
                letteronly: '[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+'},
                telephone:{ required:function(){
                    return ($('#flexCheckDefault').is(':checked'))? false : true;
                },
                letteronly:'[0-9]+'},
                companyName:{ required:function(){
                    return ($('#flexCheckDefault').is(':checked'))? false : true;
                }}
            },
            messages: {
                name:{ required: validate.message[lang].name,
                        letteronly: validate.message[lang].letteronly },
                telephone:{ required: validate.message[lang].telephone,
                        letteronly: validate.message[lang].numberonly },
                companyName:{ required: validate.message[lang].companyName }
            },
            submitHandler: function (form) {
                
                if(!$('#flexCheckDefault').is(':checked')){
                    sendTo();
                    $('.btn-confirm').attr("disabled", true);
                }
            }
        })

        popup.on('click','.close-icon-wrapper',function(){
            $(this).parent().remove();
        });

        popup.on('click','button[type="submit"]',function(){
            if($('#flexCheckDefault').is(':checked')){
                PopupMinimize(true)
            }
        })

        popup.on('click','#flexCheckDefault',function(){
            if($(this).is(':checked')){
                localStorage.setItem('dontShowAgain',true);
            }else{
                localStorage.setItem('dontShowAgain',false);
            }
        })
    }
}

function Countdown() {
    const popup = $('.popup-dialog');
    res = getPackage();
    let timeLeft = 7;
    if (res?.popupContact == 1 && popup.length==0) {
        const interval = setInterval(function(){
            if (timeLeft == 0){
                clearInterval(interval);
                PopupBusinessCard(true)
            }else{
                timeLeft--;
                console.log(timeLeft);
            }
        },1000)
    }
}
function PopupMinimize(e)
{
    const popup = $('.popup-dialog');
    if(Boolean(e)===true){
        popup.removeClass('dialog-backdrop');
        popup.find('.dialog-content').removeClass('d-block').addClass('d-none');
        popup.find('.dialog-toggle').parent().css('display','block');
        popup.find('.dialog-toggle').attr('toggle-show','false')
        localStorage.setItem("PopupBusinessCard",JSON.stringify({minimize: Boolean(e)}));
    }else{
        popup.addClass('dialog-backdrop');
        popup.find('.dialog-content').removeClass('d-none');
        popup.find('.dialog-toggle').parent().css('display','none');
        popup.find('.dialog-toggle').attr('toggle-show','true')
        localStorage.setItem("PopupBusinessCard",JSON.stringify({minimize: Boolean(e)}));
    }
}