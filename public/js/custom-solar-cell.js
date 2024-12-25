$('.light-g').each(function(){$(this).children().lightGallery({thumbnail:true,download:false})});
$(document).on('click','[data-target="#exampleModal"]',function(){
    const html = $.ajax({method:'get',url:$('html').attr('lang')+'/'+category+'/cp/d/'+$(this).attr('href').replace('javascript:',''),async:false});
    // console.log(html);
    $('#exampleModal').find('.col-lg-12').append(html.responseText); 
})
$('#exampleModal').on('hide.bs.modal',function(){
    $(this).find('.col-lg-12').html('');
})
$(document).on('click','.mail',function(){
    const id = $(this).data('id');
    $('.comp-select[value="'+id+'"]').prop('checked',true);
    actionAd();
    $('#exampleModal').modal('toggle');
});

var positionContentRight = document.getElementById('formContact');
// console.log(positionContentRight.childNodes)
x = positionContentRight.children;
l = x.length;


/**========= Form contact validate =========*/
$('#formContact').validate({
    ignor:[],
    errorElement: "em",
    errorClass: "invalid",
    rules:{
        company:{required:true},
        name:{required:true},
        department:{required:true},
        telephone:{required:true},
        email:{required:true},
        message:{required:true},
    },
    errorPlacement: function(error,element) {
        return true;
    },
    highlight: function(element, errorClass) {
        $(element).addClass(errorClass);
        $(element).next().addClass(errorClass);
        $(element).next().next().addClass(errorClass);
    }
})