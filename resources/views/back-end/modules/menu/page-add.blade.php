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
    @media (min-width:1366px){
        .custom-switch.ml-5:first-child{
            margin-left: unset !important;
        }
    }
    @media (max-width:1366px){
        /* .custom-switch.ml-5{
            margin-left: unset !important;
        } */
    }
</style>
<div class="fade-in">
    <div class="card">
        <div class="card-header">        
            <span class="breadcrumb-item "><a href="{{url("$prefix$segment")}}">Menu Mangement</a></span>
            <span class="breadcrumb-item active">Create Form</span>
            <div class="card-header-actions"><small class="text-muted">docs</small></div>
        </div>
        <div class="card-body">                                 
            <form id="menuForm" method="post" action="">
                @php
                    $option = ['main','secondary','third','fourth'];
                @endphp                
                @method('PUT')
                @csrf
                <div class="text-right">
                    <div class="mb-2">
                        <button class="btn btn-primary" type="submit" name="signup" value="Create">Create</button>
                        <a class="btn btn-danger" href="{{url("/$prefix/$segment[0]")}}">Cancel</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12 col-md-12 border-top border-right border-right-xs-none">
                        <h5 class="text-center mt-2 mb-3 font-weight-bold text-primary">Menu information</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <select class="form-control" name="position" id="position">
                                        <option value="" hidden>Please Select</option>
                                        @foreach($option as $op)
                                            <option value="{{$op}}">{{ucfirst($op)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="position">Main</label>
                                    <select class="form-control" name="_id" id="_id" disabled>
                                        <option value="" hidden>Please Select</option>
                                        @if($main)
                                        @foreach($main as $i => $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="secondary">Secondary</label>
                                    <select name="secondary" id="secondary" class="form-control" disabled>
                                        <option value="" hidden>Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="third">Third</label>
                                    <select name="third" id="third" class="form-control" disabled>
                                        <option value="" hidden>Please Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="icon">Icon</label>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://fontawesome.com/icons">fontawesome.com</a></small></div>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span id="icon-preview"><i class=""></i></span>
                                    </span>
                                </span>
                                <input class="form-control" id="icon" name="icon" type="text" disabled placeholder="icon" autocomplete="new-icon">
                            </div>                            
                        </div>
                        <div class="row add-more-content">
                            <div class="col-lg-12">
                                <a class="btn btn-info btn-sm add-more mb-2" href="javascript:">Add+</a>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="border rounded p-2 mb-2">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" for="username">Name</span>
                                        </div>
                                        <input class="form-control form-control-sm" id="name" type="text" name="name[]">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" for="url">URL</span>
                                        </div>
                                        <input class="form-control form-control-sm" id="url" type="text" name="url[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-12 border-top">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-center mt-2 mb-3 text-primary font-weight-bold">Users permission</h5>
                                <div class="row">
                                    @foreach(\App\Models\UsersMd::where('status','active')->get() as $k => $v)
                                    <div class="col-lg-6">
                                        <div class="border rounded p-2 mb-2">
                                            <strong class="text-primary">{{$v->name}}</strong>
                                            <input type="hidden" name="userId[{{$k}}]" value="{{$v->id}}">
                                            <div class="mb-1 form-inline">
                                                <div class="custom-control custom-switch ml-5">
                                                    <input type="checkbox" name="read[{{$k}}]" class="custom-control-input" id="read_{{$k}}" value="1">
                                                    <label class="custom-control-label label-success text-dark" for="read_{{$k}}">Read</label>
                                                </div>
                                                <div class="custom-control custom-switch ml-5">
                                                    <input type="checkbox" name="write[{{$k}}]" class="custom-control-input" id="write_{{$k}}" value="1">
                                                    <label class="custom-control-label label-success text-dark" for="write_{{$k}}">Write</label>
                                                </div>
                                                <div class="custom-control custom-switch ml-5">
                                                    <input type="checkbox" name="execute[{{$k}}]" class="custom-control-input" id="execute_{{$k}}" value="1">
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
            </form>
        </div>
        <div class="card-footer">
            <div class="flex">
                <div class="text-right">
                    <button class="btn btn-primary" type="submit" name="signup" value="Create">Create</button>
                    <a class="btn btn-danger" href="">Cancel</a>                              
                </div>
            </div>
        </div>        
    </div>              
</div>         

        