var URL = window.location.origin+'/webpanel/partner';
if($('#sort_table').length>0)
{
    var el = document.getElementById('sort_table');
    var dragger = tableDragger(el, { mode:'row', dragHandler:'.handle', onlyBody: true, animation: 300, });
    dragger.on('drop',function(from,to){
        const id = $('tr[data-row="'+from+'"]').data('id'), position = $('tr[data-row="'+from+'"]').data('position'), _id = $('tr[data-row="'+from+'"]').data('relate');
        dragsort(id,position,_id,from,to);
    });    
    
}
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
        // const id =[$(this).data('id')]; if(id.length>0){ deleted(id) }
        const id =[$(this).data('id')]; if(id.length>0){ destroy(id) }
    })
    $('#delSelect').on('click',function(){
        // const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ deleted(id) }
        const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ destroy(id) }
    })
}
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

function destroy(id)
{
    Swal.fire({
        title:"ลบข้อมูล",text:"คุณต้องการลบข้อมูลใช่หรือไม่?",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(URL+'/destroy?id[]='+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}
$('#position').on('change',function(){
    if($('option:selected',this).val()=='secondary'){ $('#_id').prop('selectedIndex',0).prop('disabled',false) }else{ $('#_id').prop('disabled',true) }
})
function dragsort(id,position,_id,from,to)
{
    $.ajax({url:fullUrl+'/dragsort',type:'post',data:{id:id,position:position,_id:_id,from:from,to:to, _token:$('input[name="_token"]').val()},dataType:'json',success:function(data){/*if(data==true){ if(confirm('Refresh to change the display effect.')==true){ location.reload();}}*/}})
}