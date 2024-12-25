<div class="fade-in">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Email Inquiry Report</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="btn-group">
                                <a href="webpanel/report/inquiry/customer" class="btn @if(Request::segment(4) == 'customer')btn-info @elseif(!Request::segment(4))btn-info  @else btn-secondary @endif">Customer [ {{$countEmail}} ]</a>
                                <a href="webpanel/report/inquiry/popup" class="btn btn-light">Popup [ {{$countPopup}} ]</a>
                                <a class="btn btn-success" data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseCategory">
                                    Category
                                </a>
                            </div>
                            <a href="webpanel/report/inquiry/customer/export" target="_blank" class="btn btn-success float-right"><i class="fas fa-file-export pr-2"></i> Export</a>
                        </div>
                    </div>
                    <div class="row collapse" id="collapseCategory">
                        @foreach ($sumReport as $k => $v)
                            <div class="col-3 mb-2">
                                <span class="form-control">
                                    <div class="d-flex justify-content-center">
                                        <label for="">@if(!$v->categoryNameEN) No Category @endif {{$v->categoryNameEN}} [<span class="text-success font-weight-bolder">{{ $v->emailTotal }}</span>]</label>
                                    </div>
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>UserName</th>
                                        <th>UserDetail</th>
                                        <th>Detail of contact</th>
                                        <th>CompanyDetail</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $item = $rows->firstItem();
                                    @endphp
                                    @foreach ($rows as $k => $v)
                                        <tr>
                                            <td>{{ $item + $k }}</td>
                                            <td>{{ $v->userName }}</td>
                                            <td>
                                                <div><span class="badge badge-secondary">บริษัท:</span>
                                                    {{ $v->userCompany }}</div>
                                                <div><span class="badge badge-info">แผนก:</span>
                                                    {{ $v->userDepartment }}</div>
                                                <div><span class="badge badge-warning">อีเมล์:</span>
                                                    {{ $v->userEmail }}</div>
                                                <div><span class="badge badge-primary">เบอร์:</span>
                                                    {{ $v->userTelephone }}</div>
                                            </td>
                                            <td>{{ $v->userDetail }}</td>
                                            <td>
                                                <div><span class="badge badge-secondary">บริษัท:</span>
                                                    {{ $v->customerName }}</div>
                                                <div><span class="badge badge-warning">อีเมล์:</span>
                                                    {{ $v->customerEmail }}</div>
                                                <div><span class="badge badge-primary">เบอร์:</span>
                                                    {{ $v->customerTel }}</div>    
                                            </td>
                                            <td>{{ $v->created }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{$rows->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
