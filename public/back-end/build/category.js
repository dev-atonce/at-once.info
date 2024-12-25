var fullUrl = window.location.origin+'/webpanel/category/insurance';
if($('#sort_table').length>0)
{
    var el = document.getElementById('sort_table');
    var dragger = tableDragger(el, { mode:'row', dragHandler:'.handle', onlyBody: true, animation: 300, });
    dragger.on('drop',function(from,to){
        const id = $('tr[data-row="'+from+'"]').data('id'), position = $('tr[data-row="'+from+'"]').data('position'), _id = $('tr[data-row="'+from+'"]').data('relate');
        dragsort(id,position,_id,from,to);
    });    
    
}
function dragsort(id,position,_id,from,to){
    $.ajax({
        url:fullUrl+'/dragsort', type:'post', data:{id:id, position:position, _id:_id, from:from, to:to, _token:$('input[name="_token"]').val()}, dataType:'json',
        success:function(data){ /*if(data==true){ if(confirm('Refresh to change the display effect.')==true){ location.reload();} } */ }
    })
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
    })

    $('#tree').treeview({debug:false, data:null, disable:true});
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

    $('input[name="subcategory"]').on('click',function(){
        const tree = $('.tree');
        if($(this).is(':checked')){ 
            tree.prop('disabled',false); 
        }else{ 
            tree.prop('disabled',true);
        }
    });
    function evTree(position,_id)
    {
        $('input[name="position"]').val(position[position.length-1]);
        $('input[name="_id"]').val(_id[_id.length-1]);
    }

    $('.tree').click(function(){
        if($(this).is(':checked'))
        {
            $('input[name="content"]').val($(this).parent().data('content'))
        }
    })
   

}
// form Edit
if($('#formEdit').length>0){
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
    const collapsed = 'fa-angle-right', expanded = 'fa-angle-down';
    $('.btn-link').on('click',function(){
        const current = $(this), 
            child = int(current.parent().children()[2]),
            $this = child.parent(),
            childID = child.attr('id'),
            position = child.data('child');
            // console.log($this);
        current.find('i').toggleClass(collapsed+' '+expanded);
        if(current.hasClass('collapsed')){
            $this.children().find('div.collapse').toggleClass('show');
            $this.children().not(this).find('i').toggleClass(collapsed+' '+expanded);
        }
    })

    var int = function(selector,context) {
        return new jQuery.fn.init( selector, context );
    }

    $('.deleteCat').on('click',function(){
        const $this = $(this); id = [$this.data('id')], position = $this.data('position'), _id=$this.data('relate'),type = $('input[name="type"]').val();
        if(id.length>0){ destroyCat(id,position,_id,type) }
    })
    function destroyCat(id,position,_id,type)
    {
        Swal.fire({
            title:"คุณต้องการลบข้อมูลใช่หรือไม่?",text:"Subcategory จะถูกลบไปด้วย และเมื่อลบข้อมูลแล้วไม่สามารถกู้คืนข้อมูลได้",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(fullUrl+'/destroy-cat?id='+id+'&position='+position+'&_id='+_id+'&type='+type)
                .then(response => response.json())
                .then(data => location.reload())
                .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
            }
        });
    }
    
}
if($('#sort_category').length>0){
    var el = document.getElementById('sort_category');
    var dragger = tableDragger(el, { mode:'row', dragHandler:'.handle', onlyBody: true, animation: 300, });
    dragger.on('drop',function(from,to){
        const id = $('tr[data-row="'+from+'"]').data('id'), position = $('tr[data-row="'+from+'"]').data('position'), _id = $('tr[data-row="'+from+'"]').data('relate');
        dragsort(id,position,_id,from,to);
    });    

}


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
    const id =[$(this).data('id')]; if(id.length>0){ destroy(id) }
})
$('#delSelect').on('click',function(){
    const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ destroy(id) }
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



