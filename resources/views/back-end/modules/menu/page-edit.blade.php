<style>
    .custom-control-input:checked~.label-success::before {
        border-color: #1fdb64 !important; 
        background-color: #1fdb64 !important;
    }
    @media only screen and (max-width:768px){
        .border-right-xs-none{
            border-right:unset !important;
        }
    }
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-6">
            <form id="menuForm" method="post" action="">
                <input type="hidden" name="menu_id" value="{{$row->id}}">
                <div class="card">
                    <div class="card-header">
                        <span class="breadcrumb-item "><a href="{{url("$prefix$segment")}}">User Mangement</a></span>
                        <span class="breadcrumb-item active">Create User Form</span>
                        <div class="card-header-actions"><small class="text-muted">docs</small></div>
                    </div>
                    <div class="card-body">                                 
                        @csrf
                        <div class="text-right pb-2">
                            <button class="btn btn-success" type="submit" name="signup">Update</button>
                            <a class="btn btn-secondary" href="{{url("$prefix$segment")}}">Cancel</a>
                        </div>  
                        <div class="row">
                            @php
                                $option = ['main','secondary','third','fourth'];
                            @endphp
                            <div class="col-lg-12 col-md-12">
                                <h5 class="text-center mt-2 mb-3 font-weight-bold text-primary">Menu information</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12">
                                        <label for="position">Position</label>
                                        <select class="form-control" name="position" id="position">
                                            <option value="" hidden>Please Select</option>
                                            @foreach($option as $op)
                                                <option value="{{$op}}" @if($row->position==$op) selected @endif>{{ucfirst($op)}}</option>
                                            @endforeach
                                            {{-- <option value="secondary" @if($row->position=='secondary') selected @endif>Secondary</option>
                                            <option value="third">Third</option>
                                            <option value="fourth">Fourth</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="_id">Within the menu :</label>
                                            <select class="form-control" name="_id" id="_id" @if($row->position=='main') disabled @endif>
                                                <option value="" hidden>Please Select</option>
                                                @if($main)
                                                @foreach($main as $i => $c)
                                                    <option value="{{$c->id}}" @if($row->_id==$c->id) selected @endif>{{$c->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="icon">Icon</label>
                                            <div class="card-header-actions"><small class="text-muted"><a href="https://fontawesome.com/icons">fontawesome.com</a></small></div>
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <span id="icon-preview"><i class="{!!$row->icon!!}"></i></span>
                                                    </span>
                                                </span>
                                                <input class="form-control" id="icon" name="icon" type="text" placeholder="icon" value="{!!$row->icon!!}" autocomplete="new-icon" @if($row->position=='secondary') disabled @endif>
                                            </div>                            
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="username">Name</label>
                                            <input class="form-control" id="name" type="text" name="name" placeholder="name" value="{{$row->name}}" autocomplete="new-name">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="url">URL</label>
                                            <input class="form-control" id="url" type="text" name="url" placeholder="url" value='{{$row->url}}' autocomplete="new-url">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                         
                        </div>           
                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <strong class="col-form-label">Update : </strong>{{date('d-M-Y H:i:s',strtotime($row->created))}}
                        </div>
                        <div class="float-right">
                            <button class="btn btn-success" type="submit">Update</button>
                            <a class="btn btn-secondary" href="">Cancel</a>
                        </div>
                    </div>
                </div>            
            </form>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center mb-3 font-weight-bold text-primary">Users permission</h5>
                    <div class="row">
                        @foreach(\App\Models\UsersMd::where('status','active')->get() as $k => $v)
                        <div class="col-lg-6">
                            @php
                            $permission = \App\Models\PermissionMd::select(['id','read','write','execute','created'])->where(['menu'=>$row->id,'user'=>$v->id])->first();
                            @endphp
                            <div class="border rounded p-2 mb-2">
                                <strong class="text-primary">{{@$v->name}}</strong>
                                <input type="hidden" name="userId[]" value="{{@$v->id}}">                                    
                                <input type="hidden" name="id[]" value="{{@$permission->id}}">
                                <div class="mb-1 form-inline">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="read[]" class="custom-control-input permission" action="read" id="read_{{$k}}" value="1" @if(@$permission->read==1) checked @endif>
                                        <label class="custom-control-label label-success text-dark" for="read_{{$k}}">Read</label>
                                    </div>
                                    <div class="custom-control custom-switch ml-5">
                                        <input type="checkbox" name="write[]" class="custom-control-input permission" action="write" id="write_{{$k}}" value="1" @if(@$permission->write==1) checked @endif>
                                        <label class="custom-control-label label-success text-dark" for="write_{{$k}}">Write</label>
                                    </div>
                                    <div class="custom-control custom-switch ml-5">
                                        <input type="checkbox" name="execute[]" class="custom-control-input permission" action="execute" id="execute_{{$k}}" value="1" @if(@$permission->execute==1) checked @endif>
                                        <label class="custom-control-label label-success text-dark" for="execute_{{$k}}">Execute</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            
                    </div>
                </div>
            </div>  
        </div>
    </div>
 

    
</div>         
<script> 
    $(document).on('change','.permission',function(){
        let value = $(this).is(':checked')? 1 : 0;
        let action = $(this).attr('action');
        let user = $(this).closest('.border').find('input[name="userId[]"]').val();
        let menu = $('input[name="menu_id"]').val();
        $.ajax(`webpanel/menu/update/permission?menu=${menu}&user=${user}&action=${action}&value=${value}`)
        .then((res)=>{
            if(res===true){ 
                Swal.fire({
                    title:'Success!',
                    text:'Data have been saved.',
                    icon:'success',
                    toast:true,
                    timer:2000,
                    position:'top-end',
                    showConfirmButton:false
                })
            }else{ 
                Swal.fire({
                    title:'Oops!',
                    text:'Error an occurred.',
                    icon:'error',
                    toast:true,
                    timer:2000,
                    position:'top-end',
                    showConfirmButton:false
                });
                $(this).prop('checked',false);
            }
        }).catch(()=>{ 
            Swal.fire({
                title:'Oops!',
                text:'Error an occurred',
                icon:'error',
                toast:true,
                timer:2000,
                position:'top-end',
                showConfirmButton:false
            });
            $(this).prop('checked',false);
        });
    })
</script>