var fullUrl = window.location.origin+'/webpanel/news';
$("#image").on('change',function(){
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
});
$('.status').on('click',function(){
    const $this = $(this), id = $(this).data('id');
    $.ajax({type:'get',url:fullUrl+'/status/'+id,success:function(res){if(res==false){$(this).prop('checked',false)}}});
})
$('#selectAll').on('click',function(){
    if($(this).is(':checked')){ $('#delSelect').prop('disabled',false);$('.ChkBox').prop('checked',true) }else{ $('#delSelect').prop('disabled',true); $('.ChkBox').prop('checked',false) }
})
$('.ChkBox').click(function(){
    const checked = []; const $this = $(this).prop("checked");
    $('.ChkBox').each(function(){ if($(this).is(':checked')){ checked.push($this) } })
    if(checked.length>0){ $('#delSelect').prop('disabled',false); }else{ $('#delSelect').prop('disabled',true); }
})
$('.deleteItem').on('click',function(){
    const id =[$(this).data('id')];
    if(id.length>0){ destroy(id) }
})
function destroy(id)
{
    Swal.fire({
        title:"ลบข้อมูล",text:"คุณต้องการลบข้อมูลใช่หรือไม่?",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(fullUrl+'/destroy?id[]='+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}
$('#position').on('change',function(){
    if($('option:selected',this).val()=='secondary'){ $('#_id').prop('selectedIndex',0).prop('disabled',false) }else{ $('#_id').prop('disabled',true) }
})
tinymce.init({
    selector: 'textarea.tiny',
    menubar : false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : '',
    height: 600, 
    //width : 1100,
    plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
    toolbar: 'insertfile undo redo | table | styleselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',
    
});
/* ========== Gallery ========== */

$('#add_gallery').click(function(){ $("#gallery").toggle() })
$('.reset-upload').click(function(){
    $(this).parent().find('input[type="file"]').val(null);
    $(this).parent().find('input[type="text"]').val(null);
    $('#galleryPreview').find('.preview-item').remove();
})
function readGallery() 
{
    const target = $('#galleryPreview');
    var total_file=document.getElementById("galleryUpload").files.length;
    target.find('.new-pre').remove();
    for(var i=0;i<total_file;i++)
    {
        target.append("<div class='col-lg-2 col-md-2 col-xs-6 p-2 preview-item'><div class='img-thumbnail'><div class='img-preview'><img class='img-fluid' src='"+URL.createObjectURL(event.target.files[i])+"'/></div><div class='caption' style='margin-top:5px;'><i class='fas fa-upload'></i></div></div></div>");
    }
}
$('input[name="gallerImg"]').click(function(){
    const checked = $('input[name="gallerImg"]:checked').map(function(){ return $(this).val() }).get();
    (checked.length>0)?$('.deleteGallerys').removeAttr('disabled'):$('.deleteGallerys').attr('disabled','');
})
$('.deleteGallerys').click(function(){
    const id = $('input[name="gallerImg"]:checked').map(function(){ return $(this).val() }).get(), row = $(this).data('row');
    if(id.length>0){ deleteGallery(id,row); }
})
$('.deleteGallery').click(function(){
    const id = [$(this).data('id')], row = $(this).data('row');
    deleteGallery(id,row);
})
function deleteGallery(id,row)
{
    Swal.fire({
        title:'ยืนยันลบ?',
        text:'คุณแน่ใจใช่หรือไม่!',
        icon:'warning',
        confirmButtonText:'Confirm',
        confirmButtonColor:'#fb483a',
        showCancelButton:true,
        cancelButtonColor:'#eee',
        cancelButtonText:'ยกเลิก',
        showLoaderOnConfirm:true
    },function(){
        $.ajax({
            url:fullUrl+'destroy/gallery', type:'post', dataType:'json', data:{id:id,_method:'DELETE',_token:$('input[name="_token"]').val()},
            success:function(res){
                if(res==true){swal('สำเร็จ!','รูปถูกลบแล้ว.','success');$.each(id,function(i,v){$('#'+row+v).fadeOut(500).remove()});}
                else{swal('ล้มเหลว!','มีบางอย่างผิดพลาด กรุณาทำรายการใหม่ภายหลัง.','error')}
            },
            error:function(){swal('ล้มเหลว!','มีบางอย่างผิดพลาดกรุณาทำรายการใหมภายหลัง.','error');}
        });
    })
}
/* ========== Videos ========== */
const videoId = [];
$('#add_video').click(function(){
    $('#video_product').append( videoContent() );
})
function videoContent(id,key)
{
    if(id==undefined){id=Date.now()}
    var theme='<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-2" data-row="videoRow" id="videoRow'+id+'">\
        <div class="img-thumbnail p-2">\
        <a href="javascript:" class="float-right deleteVideo" data-row="videoRow" data-id="'+id+'" data-timing="add" style="margin-bottom:5px;"><i class="fas fa-times fa-lg"></i></a>\
            <iframe width="100%" height="250" id="myIframe'+id+'" name="myIframe" src="//www.youtube.com/embed/?feature=player_detailpage"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>\
            <div class="caption">\
                <div class="form-group"><h6>Video ID :</h6>\
                    <div class="form-line">\
                        <input type="text" name="vid[]" class="form-control" onkeyup="vChange($(this))" data-row="videoRow" data-id="'+id+'" value="">\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    return theme;
}
function vChange(el) {
    const val = el.val();
    var id = el.data('id');
    $("#myIframe"+id).attr("src","//www.youtube.com/embed/"+val+"?feature=player_detailpage");
    // sitesgohere.src = "//www.youtube.com/embed/"+val+"?feature=player_detailpage";
}
$('input[name="youtube"]').on('click',function(){
    if($(this).is(':checked')){ videoId.push($(this).val()) }else{ videoId.splice( $.inArray($(this).val(), videoId), 1 ); }
    (videoId.length>0)? $('.deleteVideos').removeAttr('disabled') : $('.deleteVideos').attr('disabled','disabled') ;
})
$('.deleteVideos').click(function(){
    const val = $('input[name="youtube"]:checked').map(function(){ return $(this).val() }).get(),
    row = $(this).data('row');
    if(val.length>0){ deleteVideo(val,row) }
});
$(document).on('click','.deleteVideo',function(){
    const id=[$(this).data('id')], row=$(this).data('row'), timing=$(this).data('timing'); 
    if(id.length>0){ deleteVideo(id,row,timing) }
});
function deleteVideo(id,row,timing)
{
    Swal.fire({
        title:'ยืนยันลบ?',
        text:'คุณแน่ใจใช่หรือไม่!',
        icon:'warning',
        confirmButtonText:'ใช่. ลบเลย!',
        confirmButtonColor:'#fb483a',
        showCancelButton:true,
        cancelButtonText:'ยกเลิก',
    }).then((res)=>{
        if(timing=='add'){$.each(id,function(i,v){$('#'+row+v).fadeOut(500).remove()})}
        else{
            $.ajax({
                url:fullUrl+'/destroy/videos',type:'post',dataType:'json',data:{'id[]':id,_method:'DELETE',_token:$('input[name="_token"]').val()},
                success:function(res){
                    if(res==true){
                        Swal.fire('สำเร็จ!','ไฟล์ถูกลบแล้ว.','success');$.each(id,function(i,v){$('#'+row+v).fadeOut(500).remove()});
                    }else{
                        Swal.fire('ล้มเหลว!','มีบางอย่างผิดพลาด กรุณาทำรายการใหม่ภายหลัง.','error')
                    }
                },
                error:function(){swal('ล้มเหลว!','มีบางอย่างผิดพลาด กรุณาทำรายการใหม่ภายหลัง.','error');}
            });
        }
    })
}
/* ========== SEO ========== */
$('.seo').keyup(function(){
    seoPreview($(this))
})
$(function(){
    $('.seo').each(function(){
        if($(this).val()!=''){ seoPreview($(this)) }
    })
})
function seoPreview(el)
{
    var name = el.attr('name'),
        type = el.data('tag'),
        tag = [{
            'title' : '&#60;title&#62;&#60;/title&#62;',
            'description' : '&#60;meta name="description" content="" /&#62;',
            'keywords' : '&#60;meta name="keywords" content="" /&#62;'
        }];
    let newTag='';
    if(type=='title'){
        // console.log(tag[0][type])
        newTag = tag[0]['title'].replace('&#60;/',el.val()+'&#60;/');
    }
    if(type=='description'||type=='keywords'){
        newTag = tag[0][type].replace('""','"'+el.val()+'"');
    }
    el.parent().find('span').html(newTag);
}