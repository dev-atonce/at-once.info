<div class="row">
    <div class="col-12">
        <ul class="breadcrumb p-0 px-1" style="border-bottom:none;">
            <li class="breadcrumb-item"><a href="{{$prefix}}/{{$module}}">Our Customer</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12 col-xs-12">        
        <div class="card">
            <form id="formEdit" action="" method="post">
                @csrf
                <div class="card-body">    
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <div class="form-group">
                                <label>Category</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" name="category" id="category" disabled>
                                        <option selected hidden>Choose...</option>
                                        @foreach(\App\Models\CategoryMd::where('status',true)->get() as $k => $p)
                                            <option value="{{$p->id}}" @if($row->category_id==$p->id)selected @endif>{{$p->name_th}} / {{$p->name_jp}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Company</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" name="company" id="company" disabled>
                                        <option selected hidden>Choose...</option>
                                        @foreach(\App\Models\CompanyMd::where('id',$row->company_id)->get() as $kc => $vc)
                                            <option value="{{$vc->id}}" @if($row->company_id == $vc->id) selected @endif>{{$vc->name_th}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Package</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" name="package" id="package">
                                        <option selected hidden>Choose...</option>
                                        @foreach(\App\Models\PackageMd::where('type','main')->get() as $k => $p)
                                            <option value="{{$p->id}}" @if($row->package==$p->id) selected @endif>{{$p->name_th}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="badge badge-secondary">Popup :</label><br>
                                <label class="c-switch c-switch-label c-switch-pill c-switch-success" style="margin: unset !important; padding: unset !important; vertical-align: middle; height: 26px !important;">
                                    <input class="c-switch-input status" type="checkbox" data-id="{{$row->id}}" @if($row->popup==1) checked @endif><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-success btn-block">Save</button>
                        <a href="{{$prefix}}/{{$module}}" class="btn btn-secondary btn-block m-0 ml-3">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>
<script src="js/axios.min.js"></script>
<script>
    $(document).on('change','select[name="category"]',function(){
        let id = $(this).val();

        axios({
            method: 'get',
            url: 'api/getCompanyFromCategory',
            params: { category: id }
        })
        .then((res) => {
            let option = '';
            if(res.data?.length>0){
                res.data?.map(function(v,k){
                    option += '<option value="'+v.id+'">'+v.name_th+'</option>'
                })
                $('select[name="company"]').append(option);
            }
        })
        .catch((err) => console.log(err));
    })
    $('#formEdit').validate({
        ignore: [],
        rules: {
            category: { required: true },
            company: { required: true },
            package: { required: true }
        },
        messages: {
            category:{ required: 'Please select' },
            company:{ required: 'Please select' },
            package:{ required: 'please select' }
        },
        errorPlacement: function(error,element){  
            error.insertAfter(element);            
        },
    })
</script>