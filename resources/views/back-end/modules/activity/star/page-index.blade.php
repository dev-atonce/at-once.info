<div id="page-index" class="card">
    <div class="card-header">Star Activity</div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-right">
                    <a href="{{$prefix}}/activity/{{$activity}}/create" class="btn btn-success btn-create mb-3">สร้าง</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="34%">กิจกรรม</th>
                            <th>วันที่เริ่ม</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>สร้างเมื่อ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($rows->count()>0)
                        @foreach($rows as $k => $v)
                        @php($color=($v->deleted!='')?'text-secondary':'')
                        <tr>
                            <td class="{{$color}}">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck{{$k}}">
                                    <label class="form-check-label" for="gridCheck{{$k}}">{{$v->name_th}}</label>
                                </div>
                            </td>
                            <td class="{{$color}}">@if($v->unlimited=='on')<span>ไม่จำกัดเวลา</span>@else{{$v->start}}@endif</td>
                            <td class="{{$color}}">@if($v->unlimited=='on')<span>ไม่จำกัดเวลา</span>@else{{$v->end}}@endif</td>
                            <td class="{{$color}}">{{$v->created}}</td>
                            <td align="right">
                                @if($v->deleted)<a class="btn btn-secondary btn-sm btn-restore" data-id="{{$v->id}}" title="Restore"><i class="fas fa-recycle"></i></a> @endif
                                <a href="{{$prefix}}/activity/{{$activity}}/{{$v->id}}" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                @php($action=($v->deleted!='')?'delete':'trash')
                                @php($title=($v->deleted!='')?'Delete':'Move to trash')
                                <button data-id="{{$v->id}}" class="btn btn-danger btn-sm btn-remove" action="{{$action}}" title="{{$title}}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr><td colspan="6" align="center">Data not found!</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h6>Create Activity</h6>
        </div>
        <div class="modal-body">
            <div class="container-fluid"></div>
        </div>
      </div>
    </div>
  </div>