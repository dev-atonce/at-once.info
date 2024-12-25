<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <form id="signupForm" method="post" action="" enctype="multipart/form-data"> 
                <div class="card">
                    <div class="card-header">
                        <span class="breadcrumb-item "><a href="{{url("$segment")}}">Banner</a></span>
                        <span class="breadcrumb-item active">Create Form</span>
                        <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class=" col-lg-10 col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h6>Banner Image</h6>
                                        <img src="" class="img-thumbnail" id="preview">
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
                            <div class="form-group col-lg-4">
                                <label class="form-control"><input type="checkbox" name="home" value="1">&nbsp; หน้าแรก</label>
                            </div>                       
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label class="form-control">URL &nbsp; <input type="checkbox" name="url" value="1"></label>
                            </div> 
                        </div>   
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="card bg-light">                                 
                                    <label class="card-body text-center font-weight-bold" for="home" style="font-size: 14px;">
                                        <input type="radio" name="_type" id="home" value="home"> หน้าแรก
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="card bg-light">                                 
                                    <label class="card-body text-center font-weight-bold" for="home+company" style="font-size: 14px;">
                                        <input type="radio" name="_type" id="home+company" value="home+company"> หน้าแรก + บริษัท
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="card bg-light">                                 
                                    <label class="card-body text-center font-weight-bold" for="home+link" style="font-size: 14px;">
                                        <input type="radio" name="_type" id="home+link" value="home+link"> หน้าแรก + ใส่ลิงค์เอง
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="card bg-light">                                 
                                    <label class="card-body text-center font-weight-bold" for="category" style="font-size: 14px;">
                                        <input type="radio" name="_type" id="category" value="category"> หน้าธุรกิจ
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="card bg-light">
                                    <label class="card-body text-center font-weight-bold" for="company" style="font-size: 14px;">
                                        <input type="radio" name="_type" id="company" value="company"> สำหรับบริษัท
                                    </label>
                                </div>
                            </div>
                           
                            <div class="col-lg-2">
                                <div class="card bg-light">                      
                                    <label class="card-body text-center font-weight-bold" for="custom" style="font-size: 14px;">
                                        <input type="radio" name="_type" id="custom" value="custom"> ใส่ลิงค์เอง
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="type">ประเภทธุรกิจ</label>
                                    <select name="type" id="type"><option value="">ทั้งหมด</option>@foreach(\App\Models\CategoryMd::orderBy('name_th')->get() as $k => $c)<option value="{{$c->id}}">{{$c->name_th}} @if($c->name_jp!='')/ {{$c->name_jp}}@endif</option>@endforeach</select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="_id">บริษัท</label> <label><input type="checkbox" name="url" class="url-auto"> Auto URL</label>
                                    <select name="_id" id="_id"><option value="">กรุณาเลือก</option>
                                        {{-- @foreach(\App\Models\CompanyMd::orderBy('name_th')->get() as $k => $c)
                                        <option value="{{$c->id}}">{{$c->name_th}} @if($c->name_jp!='')/ {{$c->name_jp}}@endif</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label>URL: </label> <span style="color:#bbb;">https://www.at-once.info/th/<span class="text-dark">promotion-package</span></span>
                                <input type="text" class="form-control" name="url">
                            </div>   
                        </div> 
                        <div class="row">
                            <div class="col-12"><h6 for="img">&lt;img src="" title="<span></span>" atl="<alt></alt>"&gt;<h6></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <code>title="<span></span>"</code>
                                    <input type="text" name="title" class="form-control" />
                                </div>
                            </div>   
                        </div>    
                        <div class="row"> 
                            <div class="form-group col-lg-12">
                                <code>alt="<span></span>"</code>
                                <input type="text" name="caption" class="form-control" />
                            </div>
                        </div>        
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit" name="signup">บันทึก</button>
                        <a class="btn btn-danger" href="{{url("$segment")}}">Cancel</a>                    
                    </div>
                </form>
            </div>            
        </div>
    </div>              
</div>         
        