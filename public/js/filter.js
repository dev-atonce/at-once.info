// var local = [];
$('#formFilters').submit(function(e){
    // e.preventDefault();
    var local = [];
    window.localStorage.removeItem('filters');
    var thisForm = $(this);
    var btnSearch = $(this).find('button.btn-search');
    var message = $('<span class="fade-out text-danger">โปรดระบุในสิ่งที่คุณต้องการค้นหา!</span>');
    var alertEl = btnSearch.closest('form').find('.form-alert');
    btnSearch.attr('disabled','disabled');

    // if($('#keywords').val()!=''){
    //     local.push({'title':$('#keywords').attr('placeholder'),'words':$('#keywords').val()});
    //     $('#keywords').removeClass('invalid');
    // }else{
    //     local = [];
    //     $('#keywords').addClass('invalid');
    // }
    // console.log(local);

    $('.filter-form').find('.form-control').each(function(k,v){
        
        let curr = $(v), type = curr[0].nodeName;
        if (type == 'INPUT') {
            if(curr.val()!= ""){

                local.push({
                    'title':curr.attr('placeholder').trim(),
                    'words':curr.val().trim()
                });
                curr.removeClass('invalid')
            }else{
                local = [];
                curr.addClass('invalid');
            }
        }
        if (type == "LABEL") {
            if(curr.find('input').is(':checked')){
                local.push({
                    'title':curr.find('input').attr('title').trim(),
                    'words':curr.find('input').attr('title').trim()
                });
                curr.removeClass('invalid');
            }else{
                curr.addClass('invalid');
            }
        }
        if (type == "SPAN") {
            words = curr.html();
            if(curr.attr('title') != curr.html().trim()){
                local.push({
                    'title':curr.attr('title').trim(),
                    'words':words.trim()
                });
                curr.removeClass('invalid');
            }else{
                curr.addClass('invalid');
            }
        }

    }); 

    if(local.length>0){
        window.localStorage.setItem('filters',JSON.stringify(local));         
        $('.filter-form').find('.form-control').each(function(){
            $(this).removeClass('invalid');
        })
        alertEl.find('.text-danger').remove();
        return true;
    }else{
        alertEl.find('.text-danger').remove();
        alertEl.append(message);     
        btnSearch.removeAttr('disabled');
        return false;
    }

});
// $('form.bg-fluid').on('submit',function(e){
//     $('button.btn-search').attr('disabled',true);
//     // e.preventDefault();
//     if($('#keywords').val()!=''){
//         local.push({'title':$('#keywords').attr('placeholder'),'words':$('#keywords').val()});
//     }
    
//     // console.log($('#keywords').val())
//     // return false;
//     $('.filter-form').find('.form-control').each(function(){
        
//         let curr = $(this), type = curr[0].nodeName;
//         // console.log($(this));
//         if (type == "LABEL") {            
//             if(curr.find('input').is(':checked'))
//                 local.push({'title':curr.find('input').attr('title').trim(),'words':curr.find('input').attr('title').trim()});
//         }
//         if (type == "SPAN") {
//             words = curr.html();
//             if(curr.attr('title') != curr.html().trim())
//                 local.push({'title':curr.attr('title').trim(),'words':words.trim()});
//         }
//         if(local.length>0){
//             window.localStorage.setItem('filters',JSON.stringify(local)); 
//             $('button.btn-search').attr('disabled',true);
//         }
//     }); 

 
// })

if($('.company-form').length>0){
    filters = window.location.search;
    if(filters!=""){
        array = JSON.parse(window.localStorage.getItem('filters'));
        words='<strong class="text-danger" style="font-size:17px;">ผลการค้นหา :</strong> ';
        for(x in array){
            if (x>=1) words+=', ';
            if (array[x].title == array[x].words) words+='<strong>'+array[x].title+'</strong>';
            else words+='<strong>'+array[x].title+'</strong>('+array[x].words+')';
        }

        $('.company-form').find('.card-profile-company').parent().prepend('<div class="row"><div class="col-md-12 col-lg-12"><h6>'+words+'</h6></div></div>');
    }
}
$('button[data-toggle="collapse"]').on('click',function(){
    // if($(this).attr('aria-expanded')=='false'){
      $(this).find('i').toggleClass('fa-caret-left fa-caret-down');
    // }
    
    // $('.row-2')
})
$(document).on('click','.search-advance',function(){
    if($('.row-1').hasClass('d-none')){
        $('.row-1').removeClass('d-none d-md-none d-sm-block');
    }else{
        $('.row-1').addClass('d-none d-md-none d-sm-block')
    }
    if($('.row-2').attr('toggle-show')=='true'){
        $('.row-2').slideUp('fast');
        $('.row-2').removeAttr('toggle-show','false');
    }else{
        $('.row-2').slideDown('fast');
        $('.row-2').attr('toggle-show','true');          
    }
})