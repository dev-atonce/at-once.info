/** Logo **/

var d = $.fn.deviceDetector,width = $(window).width();
if(d.isIpad()){
    PreWidth = 300;
}else if(!d.isIpad() && width>=768){
    PreWidth = 400;
}else{
    PreWidth = width-62;
}

var logoUrl = 'images/untitled.png';
var UploadTheme = $('\
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\
        <div class="modal-dialog modal-lg">\
            <div class="modal-content">\
                <div class="modal-body">\
                    <div class="row"><div class="col-lg-12"><i class="fas fa-times close" data-dismiss="modal"></i></div></div>\
                    <div class="row"><div class="col-lg-12">\
                        <h5 class="modal-title text-center mb-5" id="exampleModalLabel">Update logo picture</h5>\
                        <center><img class="img-thumbnail upload-preview" src="'+logoUrl+'" style="width:300px;"></center>\
                        <div id="demo-basic" class="hide"></div>\
                        <h6 class="text-center text-primary my-3">รูปภาพจะปรับขนาดอัตโนมัติ 500x500 Pixel</h6>\
                    </div></div>\
                    <div class="row">\
                        <div class="col-lg-2"></div><div class="col-lg-8 col-xs-12 col-md-12"><div class="input-group mb-3">\
                            <div class="custom-file">\
                                <input type="file" class="custom-file-input" id="inputLogo">\
                                <label class="custom-file-label" for="inputLogo">Choose file</label>\
                            </div>\
                        </div></div>\
                    </div></div>\
                </div>\
            </div>\
        </div>\
    </div>'),
    actionButton = $('\
        <div class="row"><div class="col-lg-2"></div><div class="col-lg-8 col-xs-12"><div class="btn-group btn-block mb-3">\
            <button type="button" class="btn btn-secondary logo-cancel">Cancel</button>\
            <button type="button" class="btn btn-primary logo-upload">Save</button>\
        </div></div></div>');

$('figure.snip1566').on('click',function(){
    UploadTheme.modal('show');
});

$(document).on('change','#inputLogo',function(){
    if (this.files && this.files[0]) {
        $(this).next().html(this.files[0].name);

        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                var height = this.height;
                var width = this.width;
            }
            $('.upload-preview').attr('src', e.target.result);
            UploadTheme.find('.modal-body').append(actionButton);
        };
    }
})
$(document).on('click','.logo-upload',function(){
    uploadLogo($('#inputLogo'))
})
$(document).on('click',".logo-cancel",function(){
    $('img.upload-preview').attr('src',logoUrl);
    $('#inputLogo').next().html('Choose file');
    UploadTheme.modal('hide');
    document.getElementById('inputLogo').value = null;
    
})
function uploadLogo(el) {
    var fd = new FormData();
    var files = $('#inputLogo')[0].files;
    fd.append('image',files[0]);
    $.ajax({
        headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: lang+'/member/upload/logo',
        type: "POST",
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            if(data.status==='success') {
                // setTimeout(function(){  location.reload(); },500);
                $('figure.snip1566').find('img').attr("src",data.image);
                UploadTheme.modal('hide');
            }else{
                if (el.parent().parent().parent().find('.alert').length==0) {
                    el.parent().parent().parent().prepend('<div class="alert alert-danger"><strong class="bold">Opps!,</strong> Something went wrong please try again later.</div>');
                }
            }
        }
    })
}

/*
*       Cover
*/
var cover = $('.cover-bg-profile'),
    original = cover.attr('style');
    if(original!=null) { oCss = original.split(';') };
var actionBtn = $('<div class="cover-action"><button class="btn btn-secondary btn-sm mr-2 cover-cancel">Cancel</button><button class="btn btn-primary btn-sm cover-upload">Save</button></div>'),
    oImageUrl = null,
    lang = $('html').attr('lang'),
    url = window.location;
    // category = url.pathname.split('/')[2];
    if(original!=null){ $.each(oCss,function(k,v){if(!v.indexOf('background-image')){oImageUrl=v.split("'")[1];}}); }
     

function coverURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            cover.css('background-image', 'url('+e.target.result +')');
            cover.hide();
            cover.fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);

        cover.append(actionBtn);
    }
}
$(document).on('change',"#coverUpload",function() {

    coverURL(this);
});
$(document).on('click','.cover-action .cover-cancel',function(){

    cover.css('background-image', 'url('+oImageUrl+')');
    cover.hide();
    cover.fadeIn(650);
    cover.find('.cover-action').remove();
    document.getElementById('coverUpload').value = null;

});
$(document).on('click','.cover-action .cover-upload',function(){
    upload($('#coverUpload'))
})
function upload(el)
{
    const alertSuccess = '\
    <div class="alert alert-success alert-dismissible fade show" role="alert">\
      <strong>Success!</strong> cover image has been uploaded.\
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
      </button>\
    </div>';
    const alertDanger = '\
    <div class="alert alert-danger alert-dismissible fade show" role="alert">\
      <strong>Error!</strong> an error occurred.\
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
      </button>\
    </div>';

    var formData = new FormData();
    var file = el[0].files;

    formData.append('image',file[0]);
    formData.append('_method','put');

    $.ajax({
        headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
        url : lang +'/member/upload/cover',
        method : 'post',
        contentType: false,
        processData: false,
        data : formData,
        success : function(data) {
            if(data.status==='success') {
                cover.find('.cover-action').remove();
                $('.my-cover').children().find('.alert').remove();
                $('.my-cover').children().append(alertSuccess)
            }else{
                $('.my-cover').children().find('.alert').remove()
                $('.my-cover').children().append(alertDanger)
            }
        },
        error : function() {

        }
    })
}
/*
*           Gallery         *
*/
var zone = $('.gallery-upload');
var newUl = [];
$('.gallery-upload .btn-dark').click(function(){
    document.getElementById('gallery').click()
})
$('#gallery').on('change',function(){
    newUl = [];
    zone.find('.row').not('#gallery-upload').remove('');
    let row = $('<div class="row px-3"></div>');
 
    $.each(this.files,function(i,v){
        newUl.push(v);
        let thumbanil = $('<div class="col-lg-6 p-0"><div class="gu-preview gu-item bg-light rounded"><div class="gu-image rounded-left"></div><div class="gu-details"><div class="gu-progress"></div></div><div class="gu-action"><button class="btn btn-warning btn-sm">Remove</button></div></div></div>');
        var reader = new FileReader();
        reader.readAsDataURL(v);
        let size = v.size;
        let name = v.name;
        let imgSize = (size/(1024*1024)).toFixed(2);
        if (imgSize > 2)  thumbanil.find('.gu-preview').addClass('gu-danger text-danger');
        thumbanil.find('.gu-details').append('<div class="gu-size text-left"><span>'+imgSize+' MB</span></div>');
        thumbanil.find('.gu-details').append('<div class="gu-name text-left"><span alt="'+name+'">'+name+'</span></div>');
        reader.onload = function(e) {
            let image = new Image();
            image.src = e.target.result;
            let img = $('<div style="min-width:120px"></div>');
            img.css({
                'background-image' : 'url('+e.target.result+')',
                'height' : '120px',
                'display' : 'block',
                'background-position': 'center',
                'background-size': 'cover',
            });
            thumbanil.find('.gu-image').append(img);
        }
        row.append(thumbanil);
        zone.append(row);
        
    });
    setTimeout(()=>{
        autoDelete($('.gu-danger'))
    },1500);
});

$(document).on('click','.gu-action button',function(){
    const remove = $(this).parent().parent().find('.gu-name span').html();
    if(newUl.length>0) {
        $.each(newUl,function(i,v){
            if(typeof v !== typeof undefined){
                if(v.name==remove){
                    newUl.splice(i,1);
                }
            }
        })
        $(this).parent().parent().parent().remove();
    }
    // console.log(newUl)
});
// var upload = document.getElementsByClassName("gu-upload");
// document.querySelector(".gu-upload").addEventListener("click", function(){
//     guUpload(newUl)
// })
$(document).on('click','.gu-upload',function(el){
    let overSize = $('.gu-danger');
    overSize.remove();
    setTimeout(()=>{
        if($('.gu-image').length > 0){    
            $(this).prop('disabled',true);
            $('.gu-image').each(function(){
    
                $(this).next().next().find('button').css('display','none');
                let progreeBar = $('<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>');
                if($(this).next().find('.progress-bar').length==0){ $(this).next().append(progreeBar); }
            })
            
            $('.gu-image').each(function(i,ev){
                let glImage = $('<div class="col-lg-3 col-md-6 col-xs-6 mb-3">\
                    <figure><div class="gl" title="">\
                        <div class="gl-backdrop"><span class="gl-times float-right"><a href="javascript:" class="fas fa-times text-white gl-remove" data-id="43"></a></span></div>\
                        <div class="gl-img"></div>\
                        <div class="gl-caption"><small></small></div></div>\
                    </figure>\
                </div>');
                var curr = $(this);
                let progress = curr.next().find('.progress-bar');
                let row = curr.children().attr('style'),
                    find = row.split('"'),
                    block = find[1].split(";"),
                    contentType = block[0].split(":")[1],
                    realData = block[1].split(",")[1];
                    blob = b64toBlob(realData, contentType);
                    var fd = new FormData();
                    fd.append("image",blob);
                    fd.append("_method",'put');
                $.ajax({
                    headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                progress.css('width',percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    method : 'post',
                    url: lang +'/member/upload/gallery',
                    contentType:false,
                    processData:false,
                    cache:false,
                    data: fd,
                    success:function(res){ 
                        curr.next().find('.progress-bar').html('Uploaded');
                        glImage.find('.gl').attr('title','Item type: '+res.image.type+'&#013;Dimension: '+res.image.dimension+'&#013;Size: '+res.image.size);
                        glImage.find('.gl-img').css({
                            'background-image':"url('"+res.image.image+"')",
                            'background-position':'center',
                            'background-size':'cover',
                            'display':'flex'
                        });
                        glImage.find('small').html(res.image.name);
                        setTimeout(function(){
                            curr.parent().parent().remove();
                            $('.my-gl').prepend(glImage);
                        },1000);
                    },
                    error:function(){
                        curr.next().find('.progress-bar').html('Failed').toggleClass('bg-success bg-danger');
                    },
                    // complete:function(){ curr.next().find('.progress-bar').html('Uploaded.'); }
                })
                
            })
            $(this).prop('disabled',false);
        }
    },1000)
});
var service = $('.service-bg-profile'),
servImg = $('.service-bg-profile').find('img'),
ogServImg = servImg.attr('src'),
serviceAcButton = $('<div class="service-action"><button class="btn-sm btn btn-dark mr-2 service-cancel">Cancel</button><button class="btn-sm btn btn-primary service-upload">Save</button></div>');

function readServiceImg(input)
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            servImg.attr('src',e.target.result);
            servImg.hide();
            servImg.fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
        if(service.find('.service-action').length==0)serviceAcButton.insertAfter(servImg);
    }
}
function uploadServImg(el)
{
    var formData = new FormData();
    var file = el[0].files;

    formData.append('image',file[0]);
    formData.append('_method','put');

    $.ajax({
        headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
        url : lang +'//member/upload/service',
        method : 'post',
        contentType: false,
        processData: false,
        data : formData,
        success : function(data) {
            if(data.status==='success') {
                service.find('.service-action').remove();
                // setTimeout(function(){  location.reload(); },500);
            }else{

            }
        },
        error : function() {

        }
    })
}
$(document).on('change','#serviceUpload',function(){
    readServiceImg(this)
})
$(document).on('click','.service-upload',function(){
    uploadServImg($('#serviceUpload'))
})

$(document).on('click','.service-cancel',function(){
    $('.service-bg-profile img').attr('src',ogServImg);
    service.find('.service-action').remove();
})
$(document).on('click','.gl-remove',function(){
    let cur = $(this);
    let id = $(this).attr('data-id');
    axios.get(lang+'/member/remove/gallery-image',{
        params: { id:id }
    }).then(function (res) {
        cur.parent().parent().parent().parent().parent().remove();
    }).catch(function (error) {
        cur.parent().parent().parent().parent().parent().remove();
    })
});
function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }

        var byteArray = new Uint8Array(byteNumbers);

        byteArrays.push(byteArray);
    }

  var blob = new Blob(byteArrays, {type: contentType});
  return blob;
}
const autoDelete = (e) => {
    console.log(e)
    $(e).remove();
}