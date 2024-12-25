<div class="fade-in">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Popup inquiry report</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="btn-group">
                                <a href="webpanel/report/inquiry/customer" class="btn btn-light">Customer [ {{$countEmail}} ]</a>
                                <a href="webpanel/report/inquiry/popup" class="btn @if(Request::segment(4) == 'popup')btn-info @else btn-secondary @endif">Popup [ {{$countPopup}} ]</a>
                                <a class="btn btn-success" data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseCategory">
                                    Category
                                </a>
                            </div>
                            <a href="webpanel/report/inquiry/popup/export" target="_blank" class="btn btn-success float-right"><i class="fas fa-file-export pr-2"></i> Export</a>
                        </div>
                    </div>
                    <div class="row collapse" id="collapseCategory">
                        @foreach ($sumReport as $k => $v)
                            @if ($v->popupTotal > 0)
                                <div class="col-3 mb-2">
                                    <span class="form-control">
                                        <div class="d-flex justify-content-center">
                                            <label for="">@if(!$v->categoryNameEN) At-Once.info @endif {{$v->categoryNameEN}} [<span class="text-success font-weight-bolder">{{ $v->popupTotal }}</span>]</label>
                                        </div>
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Telephone</th>
                                        <th>User company</th>
                                        <th>Message</th>
                                        <th>Company</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $item = $data->firstItem();
                                    @endphp
                                    @foreach($data as $k => $v)
                                        <tr>
                                            <td>{{$item + $k}}</td>
                                            <td>{{$v->name}}</td>
                                            <td>{{$v->telephone}}</td>
                                            <td>{{$v->user_company}}</td>
                                            <td>{{$v->message}}</td>
                                            <td>{{$v->company}}</td>
                                            <td>{{date('d F Y H:i',strtotime($v->created))}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>