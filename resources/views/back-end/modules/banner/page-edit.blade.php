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
                {{$row}}
                <form id="signupForm" method="post" action="" enctype="multipart/form-data"> 
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href="{{url("$segment")}}">Banner</a></span>
                            <span class="breadcrumb-item active">Edit Form</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class=" col-lg-10 col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h6>Banner Image</h6>
                                            <img src="{{$row->image}}" class="img-thumbnail" id="preview">
                                        </div>                                        
                                    </div>
                                </div>
                            </div>   
                            <div class="row"> 
                                <div class="form-group col-lg-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" for="image">เลือกรูปภาพแบนเนอร์</label>
                                    </div> 
                                </div>                   
                            </div>   
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="card bg-light">                                 
                                        <label class="card-body text-center font-weight-bold" for="home" style="font-size: 14px;">
                                            <input type="radio" name="_type" id="home" value="home" @if($row->_type=='home') checked @endif> หน้าแรก
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="card bg-light">                                 
                                        <label class="card-body text-center font-weight-bold" for="home+link" style="font-size: 14px;">
                                            <input type="radio" name="_type" id="home+link" value="home+link" @if($row->_type=='home+link') checked @endif> หน้าแรก + ใส่ลิ้งค์เอง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="card bg-light">                                 
                                        <label class="card-body text-center font-weight-bold" for="home+company" style="font-size: 14px;">
                                            <input type="radio" name="_type" id="home+company" value="home+company" @if($row->_type=='home+company') checked @endif> หน้าแรก + บริษัท
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="card bg-light">                                 
                                        <label class="card-body text-center font-weight-bold" for="category" style="font-size: 14px;">
                                            <input type="radio" name="_type" id="category" value="category" @if($row->_type=='category') checked @endif> หน้าธุรกิจ
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="card bg-light">
                                        <label class="card-body text-center font-weight-bold" for="company" style="font-size: 14px;">
                                            <input type="radio" name="_type" id="company" value="company" @if($row->_type=='company') checked @endif> สำหรับบริษัท
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-2">
                                    <div class="card bg-light">                      
                                        <label class="card-body text-center font-weight-bold" for="custom" style="font-size: 14px;">
                                            <input type="radio" name="_type" id="custom" value="custom" @if($row->_type=='custom') checked @endif> ใส่ลิงค์เอง
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="type">ประเภทธุรกิจ</label>
                                        <select name="type" id="type" @if($row->_type=='custom' || $row->_type=='home' || $row->_type=='home+link' || $row->_type=='category') disabled="" @endif>
                                            <option value="" @if($row->type==null) selected @endif>ทั้งหมด</option>
                                            @foreach(\App\Models\CategoryMd::where(['status'=>1,'coming_soon'=>0])->get() as $k => $c)
                                                <option value="{{$c->id}}" @if($row->type==$c->id) selected @endif>
                                                    {{$c->name_th}} / {{$c->name_jp}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="_id">บริษัท: </label>
                                        <input type="checkbox" name="url" class="url-auto" value="1" @if($row->url==1) checked @endif> Company URL</label>
                                        <select name="_id" id="_id" @if($row->_type=='custom' || $row->_type=='custom' || $row->_type=='home+link' || $row->_type=='category') disabled="" @endif><option value="">กรุณาเลือก</option>
                                            @foreach(\App\Models\CompanyMd::where('category',$row->type)->orderBy('name_th')->get() as $k => $c)
                                                <option value="{{$c->id}}" @if($row->_id==$c->id) selected @endif>{{$c->name_th}} / {{$c->name_jp}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label>URL: </label> <span style="color:#bbb;">https://www.at-once.info/th/<span class="text-dark">promotion-package</span></span>
                                    <input type="text" class="form-control" name="url" value="@if($row->url!=1){{$row->url}}@endif" @if($row->_type=='company' || $row->_type=='home+company') disabled="" @endif>
                                </div>   
                            </div>  
                            <div class="row">
                                <div class="col-12"><h6 for="img">&lt;img src="" title="<span></span>" atl="<alt></alt>"&gt;<h6></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <code>title="<span></span>"</code>
                                        <input type="text" name="title" class="form-control" value="{{$row->title}}"/>
                                    </div>
                                </div>   
                            </div>    
                            <div class="row"> 
                                <div class="form-group col-lg-12">
                                    <code>alt="<span></span>"</code>
                                    <input type="text" name="caption" class="form-control" value="{{$row->caption}}">
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
        
    
            