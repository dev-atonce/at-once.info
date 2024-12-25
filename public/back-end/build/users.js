$('.status').on('click',function(){
    const $this = $(this), id = $(this).data('id');
    $.ajax({type:'get',url:URL+'/menu/status/'+id,success:function(res){if(res==false){$(this).prop('checked',false)}}});
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
function destroy(id){
    Swal.fire({
        title: 'Confirm to delete data.',
        text: 'On deleted data is not recovery',
        icon: 'warning'
    }).then(function(){
        $.ajax({
            url: window.location.origin+'/'+prefix+'/'+segment[0],
            type: 'post',
            data: {id:id,_token:$('input[name="_token"]').val()},
            dataType: 'json',
            success: function(res){
                if(res===true){ 
                    Swal.fire({title:'Deleted!',text:'Your request is successfully.',icon:'success',allowOutsideClick:false}).then((rs)=>{location.reload()});
                }else{
                    Swal.fire({title:'Opps!', text:'Something went wrong please try again.',icon:'error'});
                }
            }
        })
    });
}
const SeePassword = document.querySelectorAll('[data-see="password"]');
SeePassword.forEach(function(button){
    button.addEventListener('click',function(ev){
        let InputGroup = this.parentNode.parentNode;
        let set = InputGroup.children[0].getAttribute('type') == 'password' ? 'text' : 'password';
        InputGroup.children[0].setAttribute('type',set);
    })
})
const createForm = document.getElementById('signupForm');
if(createForm != null){
    $('#signupForm').validate({
        rules:{
            role:{required:true},
            status:{required:true},
            name:{required:true},
            username:{required:true},
            password:{required:true},
            password_confirmation:{required:true,equalTo:'#password'},
        },
        errorPlacement: function(err,el) {
            if($(el).parent().hasClass('input-group')){
                err.insertAfter($(el).parent());
            }else{
                err.insertAfter($(el));
            }
        }
    })
}
const editForm = document.getElementById('editForm');
if(editForm != null){
    $('#editForm').validate({
        rules:{
            role:{required:true},
            status:{required:true},
            name:{required:true},
            username:{required:true},
            // password:{required:false},
            // password_confirmation:function(el){
            //     console.log($('#password').val());
            //     if($('#password').val()!=''){
            //         return {required:true,equalTo:'#password'}
            //     }else{
            //         return {required:false};
            //     }
            // },
        },
        errorPlacement: function(err,el) {
            if($(el).parent().hasClass('input-group')){
                err.insertAfter($(el).parent());
            }else{
                err.insertAfter($(el));
            }
        }
    })
}
Activity = (id) => {
    const liDefault = document.createElement('li');
    liDefault.innerHTML = 'No record.';
    const ul = document.getElementById('timeline');
    axios.get('api/task/activity/'+id).then(function(res){
        const data = res.data;
        ul.innerHTML = '';
        data.forEach(function(v,k){
            let li = document.createElement('li');
            li.classList.add('timeline-item');
            let strong = document.createElement('strong');
            strong.innerHTML = v.action;
            li.appendChild(strong);
            let span = document.createElement('span');
            span.classList.add('float-end','text-muted','text-sm');
            span.innerHTML = v.datetime;
            li.appendChild(span)
            const p = document.createElement('p');
            if(v.description != ''){
                p.innerHTML = v.description;                
            }else{
                p.innerHTML = v.action+' at '+ v.datetime;
            }
            li.appendChild(p);
            ul.appendChild(li);
        })
        if(data.length == 0 ){ 
            ul.appendChild(liDefault) 
        }
        console.log($('#timeline').height());
        if($('#timeline').height()>=700){
            $('#timeline').css({
                height:'700px',
                overflowY:'scroll'
            })
        }else{
            $('#timeline').removeAttr('style');
        }
        
    });

}
if($('#changeForm').length>0){
    $('#changeForm').validate({
        ignore: [],
        rules : {
            password:{required:true,minlength:6},
            password_confirmation:{required:true,equalTo:'#password'},
        },
        messages:{
            password:{required:'Enter your password',minlength:'Please enter at least 6 characters.'},
            password_confirmation:{required:'Confirm your password',equalTo:'Password mismatch'},
        },
        errorPlacement: function(err,el){
            if($(el).parent().hasClass('input-group')){
                err.insertAfter($(el).parent());
            }else{
                err.insertAfter($(el));
            }
        }
    });
}