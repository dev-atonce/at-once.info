<div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form id="signupForm" method="post" action="" enctype="multipart/form-data"> 
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href="{{url("$prefix/$segment[0]")}}">User Mangement</a></span>
                            <span class="breadcrumb-item active">Create Form</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class=" col-lg-10 col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <img src="{{$row->image}}" class="img-thumbnail" id="preview">
                                        </div>                                        
                                    </div>
                                </div>
                            </div>   
                            <div class="row"> 
                                <div class="form-group col-lg-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div> 
                                </div>                        
                            </div>                        
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit" name="signup">Update</button>
                            <a class="btn btn-danger" href="{{url("$prefix/$segment[0]")}}">Cancel</a>                    
                        </div>
                    </form>
                </div>            
            </div>
        </div>              
    </div>         
    
            