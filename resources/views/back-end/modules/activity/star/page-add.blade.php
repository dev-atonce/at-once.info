<style>
    div[tab-toggle="false"]{display:none;}
    button[tab-toggle="true"]{background-color:#321fdb;color:white;}
    button[tab-toggle="true"]:hover{background-color:#5141df;color:white;}
</style>

<div class="card" id="page-add">
    <div class="card-header">Star Activity</div>
    <div class="card-body">
        <div class="content-fluid">
            <form action="" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <button class="btn btn-secondary tab" type="button" toggle="tab" tab-toggle="true" toggle-area="TH">TH</button>
                        <button class="btn btn-secondary tab" type="button" toggle="tab" tab-toggle="false" toggle-area="JP">JP</button>
                        <button class="btn btn-secondary tab" type="button" toggle="tab" tab-toggle="false" toggle-area="EN">EN</button>
                        <strong class="text-danger">* เพื่อเว็บไซต์ที่สมบูรณ์ควรกรอกให้ครบทุกภาษา</strong>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group form-check">
                            <input type="checkbox" name="unlimited" class="form-check-input" id="unlimited" value="on" checked>
                            <label class="form-check-label text-primary" for="unlimited">ไม่จำกัดเวลา</label>
                          </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>เวลาเริ่ม</label>
                            <input type="datetime-local" name="start" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>เวลาสิ้นสุด</label>
                            <input type="datetime-local" name="end" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div id="TH" area-toggle="tab" tab-toggle="true">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>ชื่อกิจกรรม</label>
                                <input type="text" name="name_th" id="name_th" class="form-control">
                            </div>
                        </div>       
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea name="detail_th" id="detail_th" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="JP" area-toggle="tab" tab-toggle="false">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>ชื่อกิจกรรม(JP)</label>
                                <input type="text" name="name_jp" id="name_jp" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>เวลาเริ่ม(JP)</label>
                                <textarea name="detail_jp" id="detail_jp" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="EN" area-toggle="tab" tab-toggle="false">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>ชื่อกิจกรรม(EN)</label>
                                <input type="text" name="name_en" id="name_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>รายละเอียด(EN)</label>
                                <textarea name="detail_en" id="detail_en" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <select name="company[]" id="company" multiple>
                                @foreach(\App\models\CategoryMd::select(['id','name_th'])->orderBy('id')->get() as $ind)
                                <optgroup label="{{$ind->name_th}}"></optgroup>
                                    @foreach(\App\Models\CompanyMd::select(['id','name_th','name_jp'])->where(['_id'=>$ind->id,'public'=>1])->get() as $v)
                                    <option value="{{$v->id}}"> - {{$v->name_th}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>            
                <div class="row">
                    <div class="col-lg-6">
                        <div class="float-right">
                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>            
        </div>
    </div>
</div>