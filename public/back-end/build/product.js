var fullUrl = window.location.origin+'/webpanel/insurance';
if($('#sort_table').length>0)
{
    var el = document.getElementById('sort_table');
    var dragger = tableDragger(el, { mode:'row', dragHandler:'.handle', onlyBody: true, animation: 300, });
    dragger.on('drop',function(from,to){
        const id = $('tr[data-row="'+from+'"]').data('id'), position = $('tr[data-row="'+from+'"]').data('position'), _id = $('tr[data-row="'+from+'"]').data('relate');
        dragsort(id,position,_id,from,to);
    });    
    
}

// form Add-
if($('#formAdd').length>0){

    $('#formAdd').validate({
        ignore:[],
        rules:{
            image:{required:function(){ if($('#cover').is(':checked')){ return true }else{ return false } }},
            //image:{required:true},
            name_th:{required:true},
            _id:{required:function(){ if($('#subcategory').is(':checked')){ return true }else{ return false } }}
        },
        errorPlacement : function(error,element){
            if(element.parent().hasClass('custom-file'))
            { 
                error.insertAfter(element.parent()) 
            }else{ 
                error.insertAfter(element) 
            }
        },
        messages:{
            image:{required:'Please choose a cover image'},
            name_th:{required:'Please enter name'},
            _id:{required:'Please choose one'}
        }
    });
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
}
// form Edit
if($('#formEdit').length>0){
    tinymce.init({
        selector: 'textarea.tiny',
        menubar : false,
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
        height: 300, 
        //width : 1100,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
        toolbar: 'insertfile undo redo | table | styleselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',
        
    });
    $('#tree').treeview({debug:false, data:[$('input[name="position_id"]').val()], disable:false});
    var position=[], _id=[];
    $('.tree').on('click',function(){
        var current = $(this);
        const collapsed = 'fa-angle-right', expanded = 'fa-angle-down';
        if(current.is(':checked')){ 
            $('.tree').not(this).prop('checked',false);
            $('i.fa-angle-down').not(this).removeClass(expanded).addClass(collapsed);
            $('ul.show').not(this).removeClass('show').addClass('hide');
            position.push(current.data('position'));
            _id.push(current.data('id'));
        }else{
            position.splice($.inArray(current.data('position'), position),1);
            _id.splice($.inArray(current.data('id'), _id),1);
        }
        evTree(position,_id)
    })

    // $('input[name="subcategory"]').on('click',function(){
    //     const tree = $('.tree');
    //     if($(this).is(':checked')){ 
    //         tree.prop('disabled',false); 
    //     }else{ 
    //         tree.prop('disabled',true);
    //     }
    // });
    function evTree(position,_id)
    {
        $('input[name="position"]').val(position[position.length-1]);
        $('input[name="position_id"]').val(_id[_id.length-1]);
    }
    $('#formEdit').validate({
        ignore:[],
        rulse:{name_th:{required:true},},
        errorPlacement : function(error,element){
            if(element.parent().hasClass('custom-file'))
            { 
                error.insertAfter(element.parent()) 
            }else{ 
                error.insertAfter(element) 
            }
        },
        messages:{name_th:{required:'Please enter name'},}
    })
    $("#image").on('change',function(){
        var $this = $(this);
        const input = $this[0];
        const fileName = $this.val().split("\\").pop();
        $this.siblings(".custom-file-label").addClass("selected").html(fileName);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
    $(function(){ checkOption($('#option')) })
    $('#option').on('click',function(){
        checkOption($(this))
    })
    checkOption = function(el)
    {
        if(!el.is(':checked')){
            $('p.option').addClass('text-secondary');
            $('input[name="value[]"]').prop('disabled',true);            
        }else{
            $('p.option').removeClass('text-secondary');
            $('input[name="value[]"]').removeAttr('disabled');            
        }
    }
}
//
// ==> Create Page
//
if($('#page-index').length>0)
{
    $('#sort').on('click',function(){
        const $this = $(this), text = $this.html(); 
        if(text=='Sort'){ $this.html('Cancel'); }else{ $this.html($this.data('text')) }
        $('.handle').toggleClass('d-none'); 
        $('.no').toggleClass('d-none');
    })
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
        const id =[$(this).data('id')]; if(id.length>0){ deleted(id) }
    })
    $('#delSelect').on('click',function(){
        const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ deleted(id) }
    })
}
//
// ==> Trash Page
//
if($('#page-trash').length>0)
{
    $('#selectAll').on('click',function(){
        if($(this).is(':checked')){ 
            $('#resSelect').prop('disabled',false);
            $('#delSelect').prop('disabled',false);
            $('.ChkBox').prop('checked',true) 
        }else{ 
            $('#resSelect').prop('disabled',true);
            $('#delSelect').prop('disabled',true); 
            $('.ChkBox').prop('checked',false) 
        }
    })
    $('.ChkBox').click(function(){
        const checked = []; const $this = $(this).prop("checked");
        $('.ChkBox').each(function(){ if($(this).is(':checked')){ checked.push($this) } })
        if(checked.length>0){
            $('#resSelect').prop('disabled',false);
            $('#delSelect').prop('disabled',false);
        }else{ 
            $('#resSelect').prop('disabled',true);
            $('#delSelect').prop('disabled',true); 
        }
    })

    $('.restoreItem').on('click',function(){
        const id =[$(this).data('id')]; console.log(id); if(id.length>0){ restore(id) }
    })
    $('.destroyItem').on('click',function(){
        const id =[$(this).data('id')]; if(id.length>0){ destroy(id) }
    })
    $('#resSelect').on('click',function(){
        const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ restore(id) }
    })
    $('#delSelect').on('click',function(){
        const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ destroy(id) }
    })
}

function dragsort(id,position,_id,from,to)
{
    $.ajax({url:fullUrl+'/dragsort',type:'post',data:{id:id,position:position,_id:_id,from:from,to:to, _token:$('input[name="_token"]').val()},dataType:'json',success:function(data){/*if(data==true){ if(confirm('Refresh to change the display effect.')==true){ location.reload();}}*/}})
}
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
function restore(id)
{
    Swal.fire({
        title:"Restore data",text:"Do you want to restore the data?",icon:"info",showCancelButton:true,showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(fullUrl+'/restore?id='+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}
function destroy(id)
{
    Swal.fire({
        title:"Delete data?",text:"Once the data has been deleted from the trash, You will not be able to recover it.",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(fullUrl+'/destroy?id='+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}
