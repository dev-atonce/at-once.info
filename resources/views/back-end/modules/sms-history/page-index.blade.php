@if($rows->count()>0)
<div class="card">
    <div class="card-body p-2">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-group list-group-flush">
                    @foreach($rows as $key => $row)
                        <li class="list-group-item">{{$row->message}} <span class="badge badge-warning">{{date('D, d-F-Y H:i',strtotime($row->created))}}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <h5>No data.</h5>
            </div>
        </div>
    </div>
@endif