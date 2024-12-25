
var module = window.location.pathname.split('/')[2];
var fullUrl = window.location.origin+'/webpanel/'+module;
$("#image").on('change',function(){
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        const fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
});
$('.url-auto').on('change',function(){
    const checked = ($(this).is(':checked'))?true:false;
    $('input[type="text"][name="url"]')
    $('input[type="text"][name="url"]').prop('disabled',checked);
})
if($('#_id').length>0){

    var typeSelect = new SlimSelect({select:'#type'});
    var _idSelect = new SlimSelect({select:'#_id'});
    var url = $('input[name="url"]');

}
// $('input[name="home"]').on('click',function(){
//     if($(this).is(':checked')){
        
//     }else{
//         typeSelect.enable();
//         _idSelect.enable();
//     }
// })
$(document).on('change','input[name="_type"]',function(){
    const val = $(this).val();
    switch (val) {
        case 'home':
            typeSelect.disable();
            _idSelect.disable();
            url.prop('disabled',true);
            break;
        case 'home+link':
            typeSelect.disable();
            _idSelect.disable();
            url.prop('disabled',false);
            break;
        case 'company':
            typeSelect.enable();
            _idSelect.enable();
            url.prop('disabled',true);
            break;
        case 'home+company':
            typeSelect.enable();
            _idSelect.enable();
            url.prop('disabled',true);
            break;
        default:
            typeSelect.disable();
            _idSelect.disable();
            url.prop('disabled',false);
        break;
    }
})

if($('#page-index').length>0)
{

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
        const id = [$(this).data('id')]; if(id.length>0){ deleted(id) }
    })
    $('#delSelect').on('click',function(){
        const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ deleted(id) }
    })
}
$('input[name="title"]').on('keyup',function(){
    $(this).prev().find('span').html($(this).val())
    $('h6[for="img"]').find('span').html($(this).val());
})
$('input[name="caption"]').on('keyup',function(){
    $(this).prev().find('span').html($(this).val())
    $('h6[for="img"]').find('alt').html($(this).val());
})
$('select[name="type"]').on('change',function(){
    categoryId = $(this).val();
    $.ajax({
        url: 'api/getCompanyFromCategory',
        method: 'get',
        data:{'category':categoryId},
        success: (res) => {
            // _idSelect.destroy();
            $("#_id").find('option').remove();
            let option = '';
            $.each(res,function(k,v){
                option = `<option value="${v.id}">${v.name_th} / ${v.name_jp}</option>`;
                $("#_id").append(option);
            });
        },
        error: (res) => { console.log(res); }
    })
});
function deleted(id)
{
    Swal.fire({
        title:"Delete data",text:"Do you want to delete the data?",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(fullUrl+'/delete?id='+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}