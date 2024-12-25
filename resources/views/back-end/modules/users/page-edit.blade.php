<div class="fade-in">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <form id="editForm" method="post" action=""> 
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href="{{url("$segment")}}">User Mangement</a></span>
                            <span class="breadcrumb-item active">Create User Form</span>
                            <div class="card-header-actions"><small class="text-muted">docs</small></div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Role</label><span class="text-danger">*</span>
                                            <select class="form-control" name="role" id="role">
                                                <option value="" hidden>Please Select</option>
                                                <option value="user" @if($row->role=='user') selected @endif>User</option>
                                                <option value="staff" @if($row->role=='staff') selected @endif>Staff</option>
                                                <option value="admin" @if($row->role=='admin') selected @endif>Admin</option>
                                                <option value="super" @if($row->role=='super') selected @endif>Super</option>
                                                <option value="developer" @if($row->role=='developer') selected @endif>Developer</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="status">Status</label><span class="text-danger">*</span>
                                            <select class="form-control" name="status" id="status">
                                                <option value="" hidden>Please Select</option>
                                                <option value="pending" @if($row->status=='pending') selected @endif>Pending</option>
                                                <option value="inactive" @if($row->status=='inactive') selected @endif>Inactive</option>
                                                <option value="active" @if($row->status=='active') selected @endif>Active</option>
                                                <option value="banned" @if($row->status=='banned') selected @endif>Banned</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Team</label>
                                            <select class="form-control" name="team" id="team">
                                                <option value="" hidden>Please Select</option>
                                                <option value="A" @if($row->team=='A') selected @endif>A</option>
                                                <option value="B" @if($row->team=='B') selected @endif>B</option>
                                                <option value="C" @if($row->team=='C') selected @endif>C</option>
                                                <option value="D" @if($row->team=='D') selected @endif>D</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="fill" class="custom-control-input fillInSpecialFields" data-id="{{$row->id}}" id="fillInSpecialFields" value="1" @if($row->fill==true) checked @endif>
                                    <label class="custom-control-label" for="fillInSpecialFields">fill in special fields</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="username">Name</label> <span class="text-danger font-weight-bold">*</span>
                                        <input class="form-control" id="name" type="text" name="name" placeholder="name" autocomplete="new-name" value="{{$row->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="username">Position</label> <span class="text-danger font-weight-bold">*</span>
                                        <select class="form-control" id="position" name="position">
                                            <option >Choose...</option>
                                            @foreach(\App\Models\UserPositionMd::all() as $k => $rs)
                                            <option value="{{$rs->id}}" @if($row->position==$rs->id) selected @endif>{{$rs->position}}</option>
                                            @endforeach
                                        </select>
                                    </div>                          
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="username">Username</label> <span class="text-danger font-weight-bold">*</span>
                                        <input class="form-control" id="username" type="text" name="username" placeholder="username" autocomplete="new-username" value="{{$row->username}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label" for="password">Password</label>
                                            <div class="input-group col-mb-6">
                                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" data-see="password"><i class="far fa-eye" data-id="password"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="col-form-label" for="confirm_password">Confirm password</label>
                                            <div class="input-group col-mb-6">
                                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm password" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" data-see="password"><i class="far fa-eye" data-id="password"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="card-footer">
                                <button class="btn btn-primary" type="submit" name="signup">Update</button>
                                <a class="btn btn-danger" href="{{url("$segment")}}">Cancel</a>                    
                        </div>
                    </form>
                </div>            
            </div>
        </div>              
    </div>         
    
            