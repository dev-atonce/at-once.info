var fullUrl = window.location.origin+'/webpanel';
var module = window.location.href.replace('//','/');
    module = module.split('/')[3];

$('#sort').on('click',function(){
    const $this = $(this), text = $this.html(); 
    if(text=='Sort'){ $this.html('Cancel'); }else{ $this.html($this.data('text')) }
    $('.handle').toggle(); $('.no').toggle();
})
if($('#sorted_table').length>0){
    var el = document.getElementById('sorted_table');
    var dragger = tableDragger(el, { mode:'row', dragHandler:'.handle', onlyBody: true, animation: 300, });
    dragger.on('drop',function(from,to){
        const id = $('tr[data-row="'+from+'"]').data('id');
        dragsort(id,from,to);
    });
}
function dragsort(id,from,to){
    $.ajax({
        url:fullUrl+'/menu/dragsort', type:'post', data:{id:id, from:from, to:to, _token:$('input[name="_token"]').val()}, dataType:'json',
        success:function(data){ if(data==true){ if(confirm('Refresh to change the display effect.')==true){ location.reload();} } }
    })
}
if($('#menuForm').length>0){
    $('#menuForm').validate({
        ignore:[],
        rules:{
            position:{ required: true },
            _id:{ required: function(){ const val = $('#position option:selected').val(); if(val=='secondary'){ return true }else{ return false }}},
            icon:{ required: function(){ const val = $('#position option:selected').val(); if(val=='main'|| val==''){ return true }else{ return false } } },
            name:{ required: true },
            url:{ required: true },
        },
        errorPlacement : function(error,element){
            if(element.parent().hasClass('input-group')){ 
                error.insertAfter(element.parent());
            }else{ 
                error.insertAfter(element);
            }
        },
    });
}
$(document).on('change','#position',function(){
    val = $('option:selected',this).val();
    disabled = {};
    switch (val) {
        case 'main':
            disabled.icon = false;
            disabled.st = true;
            disabled.nd = true;
            disabled.rd = true;
        break;
        case 'secondary': 
            iconDisabled = true;
            disabled.st = false;
            disabled.nd = true;
            disabled.rd = true;
            $('#icon').removeClass('error');
        break;
        case 'third': 
            disabled.icon = true;
            disabled.st = false;
            disabled.nd = false;
            disabled.rd = true;
            $('#icon').removeClass('error');
        break;
        case 'fourth': 
            disabled.icon = true;
            disabled.st = false;
            disabled.nd = false;
            disabled.rd = false;
            $('#icon').removeClass('error');
        break;
    }
    $('#icon').prop('disabled',disabled.icon);
    $('#_id').prop('selectedIndex',0).prop('disabled',disabled.st);
    $('#secondary').prop('selectedIndex',0).prop('disabled',disabled.nd);
    $('#third').prop('selectedIndex',0).prop('disabled',disabled.rd);
    // if(val=='secondary' || val=='third'){
    //     iconDisabled = true;
    //     $('#icon').removeClass('error');
    //     $('#_id').prop('selectedIndex',0).prop('disabled',false);
    // }else{
    //     $('#_id').prop('disabled',true); 
    // }
    // $('#icon').prop('disabled',disabled);
    
})
$(document).on('change','#_id',function(){
    position = $('option:selected','#position').val();
    main = $('option:selected',this).val();
    if(position == 'third' || position == 'fourth')
    {
        data = getCategory('secondary',main);
        secondarySl = document.querySelector('#secondary');
        secondaryOp = secondarySl.querySelectorAll('option');
        if(secondaryOp.length > 1 )
        {
            Array.from(secondaryOp).map(function(v,k){
                if (k > 0) v.remove();
            })
        }
        data.map(function(v,k){
            option = document.createElement('option'); 
            option.value = v.id;
            option.innerHTML = v.name;
            secondarySl.appendChild(option);
        })
    }
})
$(document).on('change','#secondary',function(){
    position = $('option:selected','#position').val(); 
    secondary = $('option:selected','#secondary').val();
    if(position == 'fourth'){
        data = getCategory('third',secondary);
        thirdSl = document.querySelector('#third');
        thirdOp = thirdSl.querySelectorAll('option');
        if(thirdOp.length > 1 ) Array.from(thirdOp).map(function(v,k){ if (k > 0) v.remove(); })
        data.map(function(v,k){
            option = document.createElement('option');
            option.value = v.id;
            option.innerHTML = v.name;
            thirdSl.appendChild(option);
        })
    }
})
document.addEventListener('click',function(e){
    const addmoreBtn = e.target.closest('.add-more');
    if(addmoreBtn){
        countMenuItem = document.querySelectorAll('.add-more-content > .col-lg-12');
        col = document.createElement('div');
        col.classList.add('col-lg-12');
        col.innerHTML = `<div class="border rounded p-2 mb-2">
            <small>${countMenuItem.length}.</small>
            <div class="input-group input-group-sm mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" for="username">Name</span>
                </div>
                <input type="text" class="form-control form-control-sm" name="name[]">
            </div>
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" for="url">URL</span>
                </div>
                <input type="text" class="form-control form-control-sm" name="url[]">
            </div>
        </div>`;
        addMoreContent = document.querySelector('.add-more-content');
        addMoreContent.append(col);
    }
    const sortBtn = e.target.closest('.sort-category');
})
$('#icon').on('keyup',function(){
    $('#icon-preview').html($(this).val());
});
$('.status').on('click',function(){
    const $this = $(this), id = $(this).data('id');
    console.log(id);
    $.ajax({type:'get',url:'webpanel/'+module+'/status/'+id,success:function(res){if(res==false){$(this).prop('checked',false)}}});
})
$('.badge-status').on('click',function(){
    $.ajax({type:'get',url:fullUrl+'/'+module+'/status/'+$(this).data('id'),success:function(res){ if(res==true){ if($(this).text()=='on'){ $(this).html('off'); }else{ $(this).html('on'); } } }});
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
            return fetch(fullUrl+'/menu/destroy/'+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}

function getCategory(position,id) {
    return data = $.ajax({
        async:false,
        url:`webpanel/get/category/${position}/${id}`,
        error:function(err){ alert(err) }
    }).responseJSON;
}