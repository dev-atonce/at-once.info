<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <form id="signupForm" method="post" action="" enctype="multipart/form-data"> 
                <div class="card">
                    <div class="card-header">
                        <span class="breadcrumb-item "><a href="{{url("$prefix/$segment[0]")}}">News</a></span>
                        <span class="breadcrumb-item active">Create Form</span>
                        <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class=" col-lg-10 col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h6>Cover</h6>
                                        <img src="" class="img-thumbnail" id="preview">
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
                        <div class="row"> 
                            <div class="form-group col-lg-8">
                                <h6>Title</h6>
                                <input type="text" name="name_th" class="form-control" value=""/>
                            </div>
                        </div>       
                        <div class="row"> 
                                <div class="form-group col-lg-12">
                                    <h6>Caption</h6>
                                    <textarea type="text" name="caption_th" class="form-control" rows="6"></textarea>
                                </div>
                            </div> 
                        <div class="row"> 
                            <div class="form-group col-lg-12">
                                <h6>Detail</h6>
                                <textarea type="text" name="detail_th" class="form-control tiny" rows="9"></textarea>
                            </div>
                        </div>   
                        <div class="row"> 
                            <div class="form-group col-lg-12">
                                <h6>Gallery <a class="btn btn-sm btn-info" href="javascript:">Add +</a></h6>
                            </div>
                        </div>  
                        <div class="row">     
                            <div class="col-lg-12">                            
                                <div class="media border p-3">
                                    <div class="form-group col-lg-4 col-md-6 col-xs-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div> 
                                    </div>
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

        