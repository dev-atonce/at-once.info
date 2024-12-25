<style>
    .breadcrumb{
        border-bottom: unset !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="webpanel"><span>Home</span></a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="webpanel/problem-report"><span>Problem Report</span></a>
                </li>
                <li class="breadcrumb-item active"><span>Create</span></li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-lg-10 col-md-10 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="problem">ปัญหาที่พบ:</label>
                            <textarea type="text" name="problem" id="problem" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">ผู้รับผิดชอบ</label>
                            <select name="user" id="user" class="form-control">
                                @foreach(\App\Models\UsersMd::select("id","position","name","role")->where('status','active')->get() as $ku => $v)
                                <option value="{{$v->id}}">{{$v->name}}= {{$v->position}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="">บริษัท</label>
                            <select name="company" id="company" class="form-control">
        
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <button class="btn btn-primary btn-block mr-1">Create</button>
                            <button class="btn btn-secondary btn-block mt-0 ml-1">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>