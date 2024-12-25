<style>
    .img-preview{
        width: 100%;
        max-height:145px;
        overflow: hidden;
    }
    .img-preview>img{
        height: 100%;        
    }
</style>
<div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <form id="signupForm" method="post" action="" enctype="multipart/form-data"> 
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href="{{url("$prefix/$segment[0]")}}">News</a></span>
                            <span class="breadcrumb-item active">Edit Form</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h6>Cover</h6>
                                            <img src="{{$row->image}}" class="img-thumbnail" id="preview">
                                        </div>                                        
                                    </div>
                                </div>
                            </div>   
                            <div class="row"> 
                                <div class="form-group col-lg-4">
                                    <small class="help-block">*รองรับไฟล์ <strong class="text-danger">(jpg, jpeg, png)</strong> เท่านั้น</small>
                                    <small class="text-danger">Auto Resize : {{$size['cover']['lg']['x']}} x {{$size['cover']['lg']['y']}} px</small>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div> 
                                </div>                        
                            </div>   
                            <div class="row"> 
                                <div class="form-group col-lg-8">
                                    <h6>Title</h6>
                                    <input type="text" name="title_th" class="form-control" value="{{$row->title_th}}"/>
                                </div>
                            </div>       
                            <div class="row"> 
                                    <div class="form-group col-lg-12">
                                        <h6>Caption</h6>
                                        <textarea type="text" name="caption_th" class="form-control" rows="6">{{$row->caption_th}}</textarea>
                                    </div>
                                </div> 
                            <div class="row"> 
                                <div class="form-group col-lg-12">
                                    <h6>Detail</h6>
                                    <textarea type="text" name="detail_th" class="form-control tiny" rows="9">{{$row->detail_th}}</textarea>
                                </div>
                            </div>   
                            <div class="row">                            
                                <div class="col-lg-12">
                                    <div id="gallery">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card"><br>
                                                    <center><h5>Gallery<h5></center>
                                                    <div class="form-group col-lg-4 col-md-6 col-xs-12">
                                                        <br><div class="clearfix"></div>
                                                        <small class="help-block">*รองรับไฟล์ <strong class="text-danger">(jpg, jpeg, png)</strong> เท่านั้น</small>
                                                        <small class="text-danger">Auto Resize : {{$size['gallery']['lg']['x']}} x {{$size['gallery']['lg']['y']}} px</small>
                                                        <div class="input-group">                                                            
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="gallery[]" id="galleryUpload" multiple="" onchange="readGallery()" accept="image/jpg,image/jpeg,image/png">
                                                                <label class="custom-file-label" for="image">Choose file</label>
                                                            </div>
                                                            <span class="input-group-append">
                                                                <button class="btn btn-danger reset-upload" type="button">Reset</button>
                                                            </span> 
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row" id="galleryPreview">
                                                            @if($gallery)
                                                            @foreach($gallery as $i => $v)
                                                            <div class='col-lg-2 col-md-2 col-xs-6 p-2'>
                                                                <div class='img-thumbnail'>
                                                                    <div class="img-preview"><img class="img-fluid" src="{{url("$v->image")}}"></div>
                                                                    <div class="caption" style="margin-top:5px;">
                                                                        <a href="javascript:" class="btn-link"><i class="far fa-trash-alt"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                             
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="header">
                                <strong style="font-size:18px">Youtube :</strong>  
                                <a href="javascript:" class="btn btn-primary btn-sm" id="add_video" data-toggle="video" role="button">Add</a>
                                <button class="btn btn-danger btn-sm deleteVideos" role="button" data-row="youtubeRow" disabled>Delete</button>
                                <small class="help-block">
                                    *การใส่ VDO YouTube ให้นำ VIDEO_ID ของ YouTube มาใส่ ตัวอย่างเช่น https://www.youtube.com/watch?v=<span style="color:#F00;">AhgtoQIfuQ4</span> ตัวหนังสือ สีแดงคือ VIDEO_ID ของ YouTube
                                </small><div class="clearfix"></div><br>
                            </div>
                            <div class="row"> 
                                <div class="col-xs-12 col-lg-12">
                                    <div class="row px-2" id="video_product">
                                        @php($i=0)
                                        @if(!empty($video))
                                        @foreach($video as $vdo)
                                        <div class="col-lg-3 col-md-4 col-sm-6 p-2" data-row="videoRow" id="videoRow{{$vdo->id}}">                                       
                                        <div class="img-thumbnail p-2">
                                            <div class="float-left custom-control custom-checkbox">
                                                <input type="checkbox" name="youtube" class="custom-control-input" id="youtube{{$vdo->id}}" data-id="{{$vdo->id}}">
                                                <label class="custom-control-label" for="youtube{{$vdo->id}}"></label>
                                            </div>
                                            <a href="javascript:" class="float-right deleteVideo" data-row="videoRow" data-id="{{$vdo->id}}" data-timing="edit" style="margin-bottom:5px;"><i class="fas fa-times fa-lg"></i></a>
                                            <iframe width="100%" height="250" id="myIframe{{$vdo->id}}" name="myIframe" src="//www.youtube.com/embed/{{ $vdo->key }}?feature=player_detailpage"  frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                                            <div class="caption">
                                                <div class="form-group"><h6>Video ID :</h6>
                                                    <div class="form-line">
                                                        <input type="hidden" name="video_id[]" value="{{ $vdo->id }}" data-id="{{$vdo->id}}">
                                                        <input type="text" name="vid[]" class="form-control v_id" data-id="{{$vdo->id}}" value="{{$vdo->key}}" onkeyup="vChange($(this))">
                                                    </div>                                                
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @php($i++)
                                        @endforeach
                                        @endif                             
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="header">
                                <div class="form-group">
                                    <strong style="font-size:18px">SEO Friendly :</strong>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Title : &nbsp;</label><span></span>
                                        <input type="text" class="form-control seo" data-tag="title" name="meta_title" id="meta_title" value="{{$row->meta_title}}" placeholder="<title></title>">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Meta Description : &nbsp;</label><span></span>
                                        <input type="text" class="form-control seo" data-tag="description" name="meta_description" id="meta_description" value="{{$row->meta_description}}" placeholder='<meta name="description">'>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Meta Keywords : &nbsp;</label><span></span>
                                        <input type="text" class="form-control seo" data-tag="keywords" name="meta_keywords" id="meta_keywords" value="{{$row->meta_keywords}}" placeholder='<meta name="keyword">'>
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
    
            