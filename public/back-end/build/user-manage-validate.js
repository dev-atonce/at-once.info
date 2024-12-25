$('#signupForm').validate({
    ignore:[],
    rules:{
        role: 'required',
        status: 'required',
        name: 'required',
        username: { 
            required: true, 
            email: true ,
            remote: { url:window.location.origin+'/webpanel/user/exist', type:"post", data:{ _token:$('input[name="_token"]').val() }, }
        },
        password: { required:true, minlength:6 },
        confirm_password: { required:true, minlength:6, equalTo:"#password" },
    },
    messages:{
        confirm_password:{ equalTo: "Password mismatch" },
        username:{ remote: "Username is Existing" },
    },
    errorPlacement : function(error,element){
        if(element.parent().hasClass('input-group'))
        { 
            error.insertAfter(element.parent()) 
        }else{ 
            error.insertAfter(element) 
        }
    },
});
$('#new_username').on('click',function(el){
    if($(this).is(':checked')){ 
        $('#username').prop('disabled',false) 
    }else{  
        $('#username').removeClass('error').prop('disabled',true).val(''); 
        $('#'+$('#username').attr('id')+'-error').remove();
    }
});
$('#resetForm').validate({
    ignore:[],
    rules:{
        username: { 
            required: function(){ if($('#new_username').is(':checked')){ return true }else{ return false }},
            email: true,
            remote: { url: window.location.origin+'/webpanel/user/exist-on-reset', type:"get" }
        },
        password: { required:true, minlength:6 },
        confirm_password: { required:true, minlength:6, equalTo:"#password" },
    },
    messages:{
        confirm_password:{ equalTo: "Password mismatch" },
        username:{ remote: "Username is Existing" },
    },
    errorPlacement : function(error,element){
        if(element.parent().hasClass('input-group'))
        { 
            error.insertAfter(element.parent()) 
        }else{ 
            error.insertAfter(element) 
        }
    },
});
$('.fa-eye').on('click',function(){
    $(this).toggleClass('password-show');
    if($(this).hasClass('password-show')){ $('#'+$(this).data('id')).attr('type','text'); }else{ $('#'+$(this).data('id')).attr('type','password'); }
});


$(document).on('click','.deleteItem',function(){
    const id = $(this).data('id');
    Swal.fire({
        title:"ลบข้อมูล",text:"คุณต้องการลบข้อมูลใช่หรือไม่?",icon:"warning",showCancelButton:true,cancelButtonText:"ยกเลิก",confirmButtonColor:"#DD6B55",confirmButtonText:"ใช่! ลบเลย",closeOnConfirm:true
    },function(){              
        $.ajax({type:'post',url:window.location.origin+'/users/destroy',data:{'id[]':id,_method:'DELETE',_token:$('input[name="_token"]').val()},
            success:function(res){
                if(res == true){  $('tr[row-id="row'+id+'"]').remove(); swal({title:"สำเร็จ!",type:"success",closeOnClickOutside:false}); }
                else{ swal({title:"ล้มเหลว!",text:"มีบางอย่างผิดพลาด กรุณาทำรายการใหม่ภายหลัง",type:"error",closeOnClickOutside:false}); }                        
            }          
        });              
    });
})
$("#selectAll").click(function(){
    var checkAll = $(this).prop("checked");
    $("input.ChkBox").each(function(){ $(this).prop({"checked":checkAll}); });
    if(checkAll == true){ $('#delSelect').prop('disabled',false); }
    else{ $('#delSelect').prop('disabled',true); }
});
$('.ChkBox').click(function(){
    const checked = []; const $this = $(this).prop("checked");
    $('.ChkBox').each(function(){ if($(this).is(':checked')){ checked.push($this) } })
    if(checked.length>0){ $('#delSelect').prop('disabled',false); }else{ $('#delSelect').prop('disabled',true); }
})
