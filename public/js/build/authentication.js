(function($) {
    var title = {
        login : ['เข้าสู่ระบบ','Login'],
        email : ['อีเมล์','E-mail'],
        password : ['รหัสผ่าน','Password'],
        confirm_password : ['ยืนยันรหัสผ่าน','Confirm Password'],
        remember : ['จดจำฉันอยู่ในระบบ','Remember Me'],
        forgot : ['ลืมรหัสผ่าน','Forgot Password'],
        sign_up : ['สมัครเข้าใช้งาน','Sign up'],
        agreement : ['ยอมรับเงื่อนไข / ข้อตกลง','Accept the terms and conditions'],
        click : ['คลิก','Click'],
        to_read : ['เพื่อนอ่าน','to read.']
    },
    errMessage = {
        email : ['รูปแบบอีเมล์ไม่ถูกต้อง.','Please enter a valid email address.'],
        exists : ['มีอีเมล์นี้อยู่ในระบบแล้ว','This email already exists.'],
        equalTo : ['พาสเวิร์ดไม่ตรงกัน','Passwords do not match'],
    },
    reqMessage = {
        email : ['กรอกอีเมล์ของคุณ.','Enter your email.'],
        password : ['ป้อนรหัสผ่านของคุณ.','Enter your password.'],
        confirmPassword : ['ป้อนรหัสผ่านยืนยัน.','Enter your confirm password.'],
        minlength : ['โปรดป้อนค่าที่มากกว่าหรือเท่ากับ','Please enter a value greater than or equal to'],
        agreement : ['โปรดยอมรับ เงื่อนไข/ข้อตกลง.','Please accept the terms / conditions.'],
    },
    lang = $('html').attr('lang'),
    hl = (lang=='th')?0:1,
    url = window.location.pathname,
    segment = url.split('/'),
    category = segment[2];
    var content = {
        login : $('<div class="modal-header" id="content-login"><h5 class="modal-title bold">'+title.login[hl]+'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div id="login-modal"><form id="login-form" action="javascript:"><div class="row"><div class="col-lg-12"><div class="form-group"><label for="login_email">'+title.email[hl]+'</label><div class="form-input-group"><div class="input-group-prepend"><img src="images/icon/user.svg" ></div><input type="text" class="form-control" id="login_email" name="login_email" placeholder="'+title.email[hl]+'" autocomplete="new-loginEmail"></div></div></div><div class="col-lg-12"><div class="form-group"><label for="password">'+title.password[hl]+'</label><div class="form-input-group"><div class="input-group-prepend"><img src="images/icon/lock.svg"></div><input type="password" class="form-control" id="login_password" name="login_password" placeholder="'+title.password[hl]+'"></div></div></div><div class="col-lg-12"><div class="form-group-1 d-flex justify-content-between"><div class="check-remember"><label class="remember_me text-secondary" for="remember_me"><input id="remember_me" name="remember_me" class="checkbox" type="checkbox" value="on"> '+title.remember[hl]+'</label></div><a href="'+lang+'/password/forgot">'+title.forgot[hl]+'?</a></div></div></div><div class="col-btn"><button type="submit" data-content="signIn" class="btn btn-login" style="margin-bottom: 16px;">'+title.login[hl]+'</button></div></form></div></div>'),
        register : $('<div class="modal-header"><h5 class="modal-title bold" id="exampleModalLabel">'+title.sign_up[hl]+'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div id="login-modal"><form id="register-form" action="javascript:"><div class="form-group"><label for="password">'+title.email[hl]+'</label><div class="form-input-group"><div class="input-group-prepend"><img src="images/icon/mail.svg"></div><input type="text" class="form-control" id="register_email" name="register_email" placeholder="'+title.email[hl]+'" autocomplete="new-registerEmail"></div></div><div class="row"><div class="col-lg-6  form-group"><label for="password">'+title.password[hl]+'</label><div class="form-input-group"><div class="input-group-prepend"><img src="images/icon/key.svg"></div><input type="password" class="form-control" id="register_password" name="register_password" placeholder="'+title.password[hl]+'" autocomplete="register-password"></div></div><div class="col-lg-6  form-group"><label for="confirm-password">'+title.confirm_password[hl]+'</label><div class="form-input-group"><div class="input-group-prepend"><img src="images/icon/confirm.svg"></div><input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="'+title.confirm_password[hl]+'" autocomplete="new-password"></div></div></div><div class="form-group"><label class="form-check-label" for="res-condition" ><input type="checkbox" name="condition" id="res-condition" value="agree"> '+title.agreement[hl]+' <a href="/agreement"><u>'+title.click[hl]+'</u></a> '+title.to_read[hl]+'</label><br></div><div class="col-btn"><button type="submit" class="btn btn-login" data-submit="signUp" style="margin-bottom: 16px;">'+title.sign_up[hl]+'</button></div></form></div></div>')
    };
    var modal = $('<div class="modal fade" id="MemberDialog" tabindex="-1" aria-labelledby="MemberDialogLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"></div></div></div>'),
        spinner = $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

    $(document).on('click','a[data-target="#signInContent"]',function(){
        modal.find('.modal-content').html('');
        modal.find('.modal-content').append(content.login);
        modal.modal('show');
    });
    $(document).on('click','a[data-target="#signUpContent"]',function(){
        modal.find('.modal-content').html('');
        modal.find('.modal-content').append(content.register);
        modal.modal('show');
    })
    $(document).on('click','button[data-content="signIn"]',function(){
        $('#login-form').validate({
          ignore : [],
          rules : {
              login_email:{required:true,email:true},
              login_password:{required:true},
          },
          messages : {
              login_email : {
                required : reqMessage.email[hl],
                email : errMessage.email[hl],
              },
              login_password : {
                required : reqMessage.password[hl], 
                minlength : reqMessage.minlength[hl]+' {0}'
              },
          },
          highlight : function(el,error){ $(el).parent().addClass(error); },
          unhighlight : function(el,error) { $(el).parent().removeClass(error); },
          errorPlacement : function(error,el){ el.parent().parent().append(error); },
          submitHandler: function(){ authenticate() }
        });
    })
    $(document).on('click','button[data-submit="signUp"]',function(){
        $('#register-form').validate({
          ignore : [],
          rules : {
              register_email : { 
                  required : true, 
                  email : true, 
                  remote : {
                      url : 'check/email?a=existing',
                      type : 'get',
                      data : {
                        email : function(){ return $('#register_email').val() }
                      }
                  },
              },
              'register_password' : { required:true, minlength:8 },
              'confirm-password' : { required:true, minlength:8, equalTo:'#register_password' },
              'condition' : { required : true }
          },
          messages : {
            register_email : { required: reqMessage.email[hl], email: errMessage.email[hl],remote: errMessage.exists[hl]},
            register_password : { required: reqMessage.password[hl], minlength:reqMessage.minlength[hl]+' {0}'},
            'confirm-password' : { required : reqMessage.confirmPassword[hl], minlength : reqMessage.minlength[hl]+' {0}',equalTo:'Passwords do not match'},
            condition : { required : reqMessage.agreement[hl] },
          },
          highlight : function(el,err){ 
            if($(el).attr('type')=='text' || $(el).attr('type')=='password') $(el).parent().addClass(err);
          },
          unhighlight : function(el,err) { 
            if($(el).attr('type')=='text' || $(el).attr('type')=='password') $(el).parent().removeClass(err);
          },
          errorPlacement : function(error,el){   
              if(el.attr('type')=='checkbox'){ error.insertAfter(el.parent().next()); }
              else{ el.parent().parent().append(error); }
          },
          submitHandler: function(){ register() }
        });
    })
    var alert = {
      error : $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'),
      success : $('<div class="alert alert-success alert-dismissible fade show role="alert"><strong></strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>')
    };
    function authenticate(){
        $('button[data-content="sign-in"]').prepend(spinner);
        var fd = new FormData();

        fd.append('email',$('#login_email').val());
        fd.append('email',$('#login_email').val());
        fd.append('password',$('#login_password').val());
        fd.append('remember_me',($('#remember_me').is(':checked'))?$('#remember_me').val():'');

        axios({
          headers : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          method : 'post',
          url : 'authentication/request',
          data : $("#login-form").serialize()
        }).then(function(res) {
          if (res.data.status=='error') {
            alert.error.find('strong').html(res.data.message);
            $('#login-form').find('div.alert').remove();
            $('#login-form').prepend(alert.error);              
            $('button[data-content="sign-in"]').find('.spinner-border').remove();
          }else{
            alert.success.find('strong').html(res.data.message);
            $('#login-form').find('div.alert').remove();
            $('#login-form').prepend(alert.success);
            $('button[data-content="sign-in"]').find('.spinner-border').remove();
            setTimeout(function(){location.reload()},2000);
          }
        }).catch(function(error){
            $('#login-form').find('div.alert').remove();
            $('#login-form').prepend(alert.error);
            setTimeout(function(){ $('button[data-submit="signIn"]').find('.spinner-border').remove(); },1000);
        })
    }
    function register(){
        $('button[data-submit="signUp"]').prepend(spinner);
        const re = { alert : $('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Something went wrong please try again.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>') };
        axios({
            headers: { 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            method : 'post',
            url : lang+'/'+category+'/member/register',
            data : { 
                _method : 'PUT',
                email : $('input[name="register_email"]').val(),
                password : $('input[name="register_password"]').val(),
                condition : ($('input[name="condition"]').is(':checked'))?$('input[name="condition"]').val():'',
            }
        }).then(function(res) {
          if(res.data.status=='error'){
              if($('#register-form').find('div.alert').length==0) {
                $('#register-form').prepend(re.alert);
              }
              $('button[data-submit="signUp"]').find('.spinner-border').remove();
          }else{
              location.reload();
              $('#register-form').find('div.alert').remove();
              $('button[data-submit="signUp"]').find('.spinner-border').remove();
          }
        }).catch(function(error){
            if($('#register-form').find('div.alert').length==0) {
                $('#register-form').prepend(re.alert);
            }
            setTimeout(function(){ $('button[data-submit="signUp"]').find('.spinner-border').remove(); },1000);
        })
    }
})(jQuery);
