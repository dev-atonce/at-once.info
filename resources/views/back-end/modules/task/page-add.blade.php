<style>
    .img-preview{
        width: 100%;
        max-height:145px;
        overflow: hidden;
    }
    .img-preview>img{
        height: 100%;        
    }
    #preview{
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        
    }
    #preview:after{
        font-family: 'Font Awesome 5 Free';
        font-size: 9em !important;
        content: "\f03e";
        color: #999;
        display: block;
        margin: 30px;
    }
    .img-thumbnail{
        text-align: center;
    }
</style>
<div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form id="form" method="post" action="" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href="{{url("$prefix$segment")}}">Member</a></span>
                            <span class="breadcrumb-item active">Add Form</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                            <div class="pb-2">
                                <button class="btn btn-primary btn-sm" type="submit" name="signup">Create</button>
                                <a class="btn btn-danger btn-sm" href="{{url("$prefix$segment")}}">Cancel</a>
                            </div>  
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <h6>Cover</h6>
                                                    <img src="" class="img-thumbnail" id="preview">
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row"> 
                                        <div class="form-group col-lg-12">
                                            <small class="help-block">*รองรับไฟล์ <strong class="text-danger">(jpg, jpeg, png)</strong> เท่านั้น</small>
                                            <small class="text-danger">Auto Resize :  Pixel</small>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div> 
                                        </div>                        
                                    </div>
                                </div> 
                                <div class="col-lg-8"> 
                                    <div class="row"> 
                                        <div class="form-group col-lg-12">
                                            <h6>Name</h6>
                                            <input type="text" name="name" class="form-control" required />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <h6>Email</h6>
                                            <input type="email" name="email" class="form-control" id="email" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <h6>Password</h6>
                                            <input type="password" name="password" class="form-control" id="password" required />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <h6>Confirm Password</h6>
                                            <input type="password" name="cpassword" class="form-control" id="cpassword" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                      
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm" type="submit" name="signup">Create</button>
                            <a class="btn btn-danger btn-sm" href="{{url("$prefix$segment")}}">Cancel</a>                    
                        </div>
                    </form>
                </div>            
            </div>
        </div>              
    </div>         
    <script>

        $("#image").change(function() {
            readCover(this);
        });

        // Source: http://stackoverflow.com/a/4459419/6396981
        function readCover(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function(){
          $('#form').validate({
              rules:{
                  'password':{required:true,minlength:6},
                  'cpassword':{required:true,minlength:6,equalTo:'#password'},
                  'email':{required:true,remote:{url:"{{url('webpanel/members/check/email/duplicate')}}",data:{_token:"{{ csrf_token() }}"},type:"post"}},
                  'name':{required:true},
              },
              messages:{
                  email:{
                      required: 'PLEASE ENTER YOUR EMAIL ADDRESS.',
                      email: 'INVALID EMAIL',
                      remote: 'EMAIL ALREADY IN USE!',
                  },
                  password: {
                      required: 'PLEASE ENTER YOUR PASSWORD.',
                      minlength: 'PLEASE ENTER AT LEAST 6 CHARACTERS.'
                  },
                  cpassword: {
                      required: 'PLEASE ENTER YOUR PASSWORD.',
                      minlength: 'PLEASE ENTER AT LEAST 6 CHARACTERS.',
                      equalTo: 'PASSWORD MISMATCH.'
                  },
                  name:{ required: 'PLEASE ENTER YOUR FIRSTNAME.' },
                  
              },
              errorPlacement: function(error, element){
                  if (element.attr("name") == "condition" ) {  element.parent().append(error); }
                  else { error.insertAfter(element); }
              },
              submitHandler: function(form){
                  $("#btn-submit").attr("disabled", true);
                  $('.recaptcha-checkbox-border').addClass('recaptcha-error');
                  form.submit();
              }
          });
        });
    </script>
            