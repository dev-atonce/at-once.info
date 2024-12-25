var shareUrl = window.location,
    box = $('\
    <div class="modal" id="share-page">\
        <div class="modal-dialog" role="document">\
            <div class="modal-content">\
                <div class="modal-body">\
                    <h4 class="bold">Share</h4>\
                    <div class="row">\
                        <div class="col-lg-12">\
                            <div class="form-group">\
                                <input type="text" id="link" class="form-control" value="'+shareUrl.href+'">\
                            </div>\
                        </div>\
                    </div>\
                    <div class="row">\
                        <div class="col-lg-12">\
                            <div class="share-item float-left text-center"><a href="javascript:" class="btn btn-copy btn-share rounded-circle" data-target="#copy" title="Copy"><img class="img-fluid" src="images/icon/img/copy.png" alt="copy"></a><span>Copy</span></div>\
                            <div class="share-item float-left text-center"><a href="javascript:" class="btn btn-line btn-share rounded-circle" data-target="#line" title="Line"><img class="img-fluid" src="images/icon/img/line.png" alt="line"></a><span>Line</span></div>\
                            <div class="share-item float-left text-center"><a href="javascript:" class="btn btn-facebook btn-share rounded-circle" data-target="#facebook" title="facebook"><img class="img-fluid" src="images/icon/img/facebook.png" alt="facebook"></a><span>Facebook</span></div>\
                            <div class="share-item float-left text-center"><a href="javascript:" class="btn btn-x-twitter btn-share rounded-circle" data-target="#twitter" title="x-twitter"><img class="img-fluid" src="images/icon/img/x-twitter.png" alt="x-twitter"></a><span>Twitter</span></div>\
                            <div class="share-item float-left text-center"><a href="javascript:" class="btn btn-email btn-share rounded-circle" data-target="#email" title="email"><img class="img-fluid" src="images/icon/img/mail.png" alt="email"></a><span>Email</span></div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>\
    ');
$(document).on('click','.share-this-page',function(){
    box.modal('show');
})
function Notifications(title) {
    var template = $('<div class="notifications" id="notifications"><div class="float-right"><i class="icofont-close text-light"></i></div></div>');
    template.append('<h5 class="text-light">'+title+'</h5>').addClass("noti--active");
    $('body').append(template);
    $('body').find('.notifications').addClass('noti--active');
    setTimeout(function(){ 
        template.removeClass('noti--active');
        template.remove();
    },5000);		
}
function share(ev){
    // line - https://line.me/R/msg/text/?
    const link = $('#link').val();
    switch (ev.data('target')) {
        case '#line': window.open('https://line.me/R/msg/text/?Company : '+$('.company-detail').find('h1').text()+'\n '+shareUrl.href);	
            break;
        case '#facebook': window.open('https://www.facebook.com/dialog/share?app_id=460112164753782&href='+shareUrl.href);
            break;
        case '#twitter': window.open('https://twitter.com/intent/tweet?url='+shareUrl.href);
            break;
        case '#email': window.open('mailto:?subject=Company : '+$('.company-detail').find('h1').text()+'&body='+shareUrl.href);
            break;
        case '#copy':
            var dummy = $('<input id="copy-link">');
            $('body').append(dummy);
            $('#copy-link').val($('#link').val());
            $('#copy-link').select();
            document.execCommand('copy');
            $('#copy-link').remove();
            Notifications('Copied to clipboard');
            break;
        default:
            break;
    }
}

$(document).on('click','[data-target="#copy"]',function(){share($(this))});
$(document).on('click','[data-target="#line"]',function(){share($(this))});
$(document).on('click','[data-target="#facebook"]',function(){share($(this))});
$(document).on('click','[data-target="#twitter"]',function(){share($(this))});
$(document).on('click','[data-target="#email"]',function(){share($(this))});