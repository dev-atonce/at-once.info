<div class="fade-in">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href="{{url("$segment")}}">User Mangement</a></span>
                    <span class="breadcrumb-item active">Create User Form</span>
                    <div class="card-header-actions"><small class="text-muted">docs</small></div>
                </div>
                <div class="card-body">                                 
                    <form id="signupForm" method="post" action="">                        
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="signup" value="Create">Create</button>
                            <a class="btn btn-danger" href="{{url("$segment")}}">Cancel</a>
                        </div>
                        <hr>   
                        <div class="row">
                            <div class="col-md-12">
                                @if(Session('status'))
                                <div class="alert alert-{{Session('name')}} alert-dismissible fade show" role="alert">
                                    {!!Session('message')!!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  
                                </div>
                                @endif
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="role">Role</label> <span class="text-danger font-weight-bold">*</span>
                                        <select class="form-control" name="role" id="role">
                                            <option value="" hidden>Please Select</option>
                                            <option value="user">User</option>
                                            <option value="staff">Staff</option>
                                            <option value="admin">Admin</option>
                                            <option value="super">Super</option>
                                            <option value="developer">Developer</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="status">Status</label> <span class="text-danger font-weight-bold">*</span>
                                        <select class="form-control" name="status" id="status">
                                            <option value="" hidden>Please Select</option>
                                            <option value="pending">Pending</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="active">Active</option>
                                            <option value="banned">Banned</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Team</label>
                                        <select class="form-control" name="team" id="team">
                                            <option value="" hidden>Please Select</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="fill" class="custom-control-input fillInSpecialFields" id="fillInSpecialFields" value="1">
                                <label class="custom-control-label" for="fillInSpecialFields">fill in special fields</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="username">Name</label> <span class="text-danger font-weight-bold">*</span>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="name" autocomplete="new-name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="username">Position</label> <span class="text-danger font-weight-bold">*{{Auth::user()->position}}</span>
                                    <select class="form-control" id="position" name="position">
                                        <option >Choose...</option>
                                        @foreach(\App\Models\UserPositionMd::all() as $k => $rs)
                                        <option value="{{$rs->id}}" @if(Auth::user()->position==$rs->id) selected @endif>{{$rs->position}}</option>
                                        @endforeach
                                    </select>
                                </div>                          
                            </div>
                            
                        </div>
                
                        <div class="form-group">
                            <label class="col-form-label" for="username">Username</label> <span class="text-danger font-weight-bold">*</span>
                            <input class="form-control" id="username" type="text" name="username" placeholder="username" autocomplete="new-username">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="password">Password</label> <span class="text-danger font-weight-bold">*</span>
                                        <div class="input-group col-mb-6">
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-see="password"><i class="far fa-eye" data-id="password"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="password_confirmation">Confirm password</label> <span class="text-danger font-weight-bold">*</span>
                                        <div class="input-group col-mb-6">
                                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm password" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-see="password"><i class="far fa-eye" data-id="password"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="signup" value="Create">Create</button>
                            <a class="btn btn-danger" href="">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>              
</div>         

        