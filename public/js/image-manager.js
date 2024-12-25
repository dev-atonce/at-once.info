var im = $('#imageManager');
var tf = im.find('.im-f');
var tu = im.find('.im-u');

$('.rounded-lg.bg-light').click(function(){
    $('#template').modal('show');
})  
$(document).on('click','.template-item',function(){
    $(this).addClass('border-selected');
    $('.template-item').not(this).removeClass('border-selected');      
})
$(document).on('click','.select-template',function(){

    var template = $('.border-selected').clone();
    template.removeClass('template-item active');
    // $('.detail-area').prepend().html();
    template.insertBefore($('.rounded-lg')).html();
    template.find('.img').removeClass('img').addClass('col-img').children().addClass('bg-light');
    template.find('.txt').removeClass('txt').addClass('col-txt');
    template.removeClass('card');
    template.find('.col-txt').find('h5').replaceWith('<iframe id="data">');
    
    $('.border-selected').removeClass('border-selected');
    $('#template').modal('hide');
    // MakeEditable(template.find('.col-txt').children())
})
 

//   function MakeEditable(el) {

//       $("#data").remove();
    
//       var tag1 = document.createElement("iframe");
//           tag1.id = "data";
//           tag1.className = "iframe";
//           tag1.style.width = '100%';
//           tag1.style.height = '100%';
//           tag1.style.backgroundColor = 'white';
//           tag1.style.border = '1px dashed #dedede';
//           tag1.style.overflow = 'auto';
//           // tag1.classList.add('i-resize');
//           el.append(tag1); 
    
//       var frameElement = document.getElementById("data"); 
//       var doc = frameElement?.contentDocument;

//       doc?.body.contentEditable = true;
//       frameElement.removeAttribute('id');
      
//       // $('<div class="i-resize"></div>').insertAfter(frameElement);
 
//   }
let img = null;
$(document).on('click','.col-img',function(){
    $('#imageManager').modal({backdrop: false, keyboard: false, show:true});
    // $('#myModal').modal({backdrop: 'static', keyboard: false})

    myFolder();
    img = $(this);
});

$('.im-upload').on('click',function(){
    tf.hide();
    tu.show();
});
$('.im-cancel').on('click',function(){
    tf.show();
    tu.hide();
});
$('.im-btn-choose').on('click',function(){
    $(this).find('[type="file"]')[0].click();
});

var choose = tu.find('.choose').clone();

$(document).on('change','input[name="im_upload"]',function(){
    im.find('.im-content-upload').removeAttr('style');
    newIM = [];
    // tu.find('.row').remove('');
    let row = $('<div class="row px-3"></div>');
    
    
    $.each(this.files,function(i,v){    
        newIM.push(v);

        tu.find('.im-content-upload').html('')
        let thumbanil = $('<div class="col-lg-12 p-0"><div class="im-preview im-item bg-light rounded"><div class="im-image rounded-left"></div><div class="im-details"><div class="im-progress progress"><div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div></div><div class="im-action"><button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></div></div></div>');
        var reader = new FileReader();
        reader.readAsDataURL(v);
        let size = v.size;
        let name = v.name;
        // thumbanil.find('.gu-details').append('<div class="text-left"><span>'+(size/(1024*1024)).toFixed(2)+' MB</span></div>');
        thumbanil.find('.im-details').prepend('<div class="im-name text-left"><span alt="'+name+'">'+name+'</span></div>');
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
            thumbanil.find('.im-image').append(img);
        }
        row.append(thumbanil);
        tu.find('.im-content-upload').append(row);
    });
    if(this.files.length==0) tu.find('.im-content-upload').append(choose);

});
$(document).on('click','.im-action .btn-danger',function(){
    $(this).parent().parent().parent().remove();
    $(this).parent().parent().parent().remove();
    if(tu.find('.im-item').length==0){
        tu.find('.im-content-upload').find('.row').remove();
        tu.find('.im-content-upload').css('display','grid');
        tu.find('.im-content-upload').append(choose);
    }
});
$(document).on('click','.im-upload',function(){
    let images = $('.im-image');
    images.each(function(i,ev){
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
            url: lang +'/'+ category +'/member/upload/profile-images',
            contentType:false,
            processData:false,
            cache:false,
            data: fd,
            success:function(res){
                curr.next().find('.progress-bar').html('Uploaded').addClass('bg-success');
                // setTimeout(function(){
                //     curr.parent().parent().remove();
                //     $('.my-gl').prepend(glImage);
                // },1000);
            },
            error:function(){
                curr.next().find('.progress-bar').html('Failed').toggleClass('bg-success bg-danger');
            },
            // complete:function(){ curr.next().find('.progress-bar').html('Uploaded.'); }
        });
    });
    myFolder()
});
function myFolder()
{
    var folder = 'images/company/';
    $.ajax({
        url : lang +'/'+ category +'/member/profile-images',
        success: function (data) {
            $.each(data,function(i, val) {
                tf.find('.im-content-image').append('<div class="im-image-grid"><img src="'+val+'" title="'+val.split('/')[4]+'"><div class="im-info" title="'+val.split('/')[4]+'">'+val.split('/')[4]+'</div></div>');
            });
        }
    });
    tf.find('.im-content-image').html('');
}
$(document).on('click','.im-view',function(){
    if($(this).hasClass('-grid')){
        $('.im-image-list').toggleClass('im-image-list im-image-grid');
    }else{
        $('.im-image-grid').toggleClass('im-image-grid im-image-list');
    }
    
})
$(document).on('click','.im-image-grid',function(){
    selected($(this))
})
$(document).on('click','.im-image-list',function(){
    selected($(this))
})
function selected(el)
{
    if (el.hasClass('im-image-grid')) {
        $(el).addClass('im-checked');
        $('.im-image-grid').not(el).removeClass('im-checked');
    } else{
        $(el).addClass('im-checked');
        $('.im-image-list').not(el).removeClass('im-checked');
    }
}
$(document).on('click','.im-select',function(){
    const select = $('.im-checked').find('img');
    const area = img.find('.bg-light')
    area.append('<img src="'+select.attr('src')+'" class="img-fluid">');
    area.find('h5').remove();
    $('#imageManager').modal('hide');
})
$('form').on('submit',function(e){
    var context = $(this).find('.detail-area');
    const lang = context.attr('data-lang');
    let text = context.find('iframe').contents().find('body').clone().html();
    let html = context.clone();
    console.log(text);
    
    html.find('.rounded-lg').remove();      
    html.find('.bg-light').removeClass('bg-light').removeAttr('style');
    html.find('.col-txt').html(text);

    $('textarea[name="more_'+lang+'"]').html(html.html());
    // return false;
    
    
});
// function update(){ $('form').submit() }