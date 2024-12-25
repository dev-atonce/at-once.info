{{-- <style type="text/css">
    .stockcs .form-control.cs-droplist {
        color: #39f;
        font-weight: 500;
        border: 2px solid #3399ff;
    }


    .stockcs .table th, .stockcs .table td{
        border-bottom: 1px solid;
        border-bottom-color: #f0f2f5;
        vertical-align: middle;
    }
    .ui-draggable .ui-draggable-handle{
        cursor: move;
    }
</style>


   
    @include('back-end.modules.job-progress.position.pagesi.waiting-for-create')

    <!-- On Process ของ cs -->
    <div class="card strockcs">
        <div class="card-header card-header d-flex flex-between-center">
            <h5 class="mb-0">On Process 
                <strong class="text-info">284</strong> 
                <a href="javascript:" class="badge badge-info"><i class="fas fa-sync-alt"></i></a>
            </h5> 
            <div class="ms-auto col-auto form-inline">
                <input type="text" name="search" class="form-control" placeholder="Search Company Name..." aria-label="Search Company Name..." aria-describedby="button-addon1">
                <button class="btn btn-outline-danger ml-2 reset" type="button">Reset</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-borderless ">
                <table class="table mb-0" id="">
                    <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                            <th class="text-center">NO.</th>
                            <th class="text-center"></th>
                            <th >Company Name</th>
                            <th class="text-center">Category  </th>
                            <th class="text-center th-cannot-contact">Send email</th>
                            <th class="text-center th-cannot-contact">Cannot Contact</th>
                            <th class="text-center">Follow</th>
                            <th class="text-center">No Response</th>
                            <th class="text-center">Refuse</th>
                            <th class="text-center">Call again</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="" >
                            <td class="text-center align-middle" rowspan="2">1</td>
                            <td class="text-center align-middle" rowspan="2"></td>
                            <td class="align-middle" rowspan="1">
                                <a class="text-dark" href="th/preview/1" title="Preview">
                                    <p class="mb-0">YNP TRANSPORT LIMITED PARTNERSHIP</p>
                                </a>
                            </td>
    
                            <td class="text-center align-middle"  rowspan="1"><small>Logistics, Warehouse &amp; Delivery</small></td>
                            <td class="text-center align-middle">
                                <input type="checkbox" name="cannot_contact" id="cannot_contact" class="checkbox" value="1" data-id="4586">
                            </td>
    
                            <td class="text-center align-middle">
                                <input type="checkbox" name="cannot_contact" id="cannot_contact" class="checkbox" value="1" data-id="4586">
                            </td>
    
                            <td class="text-center align-middle">
                                <input type="checkbox" name="follow" id="follow" class="checkbox" value="1" data-id="4586">
                            </td>
    
                            <td class="text-center align-middle">
                                <input type="checkbox" name="no_response" id="no_response" class="checkbox" value="1" data-id="4586">
                            </td>
    
                            <td class="text-center align-middle">
                                <input type="checkbox" name="check_filter" id="check_filter" class="checkbox" value="1" data-id="4586">
                            </td>
    
                            <td class="text-center align-middle">
                                <input type="checkbox" id="license_refuse" name="license_refuse" value="1" data-id="4586">
                            </td>
                        </tr> 
                        <tr>
                            <td class="">
                                <div class="input-group">
    
                                    <input type="text" class="form-control" placeholder="Somchai">
                                    <input type="text" class="form-control" placeholder="Sookjai">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary"><i class="fas fa-pen"></i></button>
    
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">080-234-5678</td>
                            <td>contact@gmail.com</td>
                            <td colspan="5">
                                <a href="webpanel/blog/1183/visa-support" target="_blank" class="badge bg-light text-dark"><i class="fas fa-eye"></i> Preview</a>
                                <a href="javascript:" class="badge badge-info"><i class="far fa-paper-plane fa-lg"></i> Send</a>
                            
                                <span class="badge badge bg-light"><i class="far fa-eye-slash"></i> Private</span
                                <a href="https://www.at-once.info/th/contractor-service/cp/narong-rich-asset" target="_blank" class="badge badge-success"><i class="fas fa-check"></i> Public</a> <!--แสดงตอนที่ตั้มกด-->
                           
                            
                                <a href="javascript:" class="badge badge-primary-light modal-attach"><i class="fas fa-paperclip"></i> Attach File</a>
                           
                            
                                <button class="btn rounded-3 me-2 fs--2 icon-item icon-item-sm" data-toggle="modal" data-target="#ModalComment">
                                    <i class="fas fa-search"></i>
                                </button>
    
                                <!-- Modal -->
                                <div class="modal fade" id="ModalComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">   
                                                <p class="text-left">08-11-2023 10:32:41 - ติดต่อลูกค้าไม่ได้</p>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>  
                </table>   
            </div>
        </div>  
        <div class="card-footer py-2"></div> 
    </div>  

    <div class="card strockcs">
        <div class="card-header card-header d-flex flex-between-center">
            <h5 class="mb-0">Complete <strong class="text-info">284</strong></h5>
            <div class="ms-auto col-auto form-inline">
                <input type="text" name="search" class="form-control" placeholder="Search Company Name..." aria-label="Search Company Name..." aria-describedby="button-addon1">
                <button class="btn btn-outline-danger ml-2 reset" type="button">Reset</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-borderless ">
                <table class="table mb-0" id="">
                    <thead class="table-light fw-semibold">
                    <tr class="align-middle">
                            <th class="text-center">NO.</th>
                            <th class="text-center"></th>
                            <th >Company Name</th>
                            <th class="text-center">Category  </th>
                            <th class="text-center th-cannot-contact">Preview</th>

                            <th class="text-center">Status</th>

                            <th class="text-center"> Attach File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle checkbox-group" >
                            <td class="text-center align-middle" rowspan="2">1</td>
                            <td class="text-center align-middle" rowspan="2"></td>
                            <td class="align-middle" rowspan="2">
                                <a class="text-dark" href="#">
                                    <p class="mb-0">YNP TRANSPORT LIMITED PARTNERSHIP</p>
                                </a>
                            </td>
                            <td class="text-center"  rowspan="2"><small>Logistics, Warehouse &amp; Delivery</small></td>

                            <td class="text-center"><a href="webpanel/blog/1183/visa-support" target="_blank" class="badge bg-light text-dark"><i class="fas fa-eye"></i> Preview</a></td>
                            <td class="text-center">
                                <span class="badge badge-success"><i class="fas fa-check"></i> Public</span>
                            </td>
                            <td class="text-center">
                                <a href="#" class="badge inbox-link"><i class="far fa-file-pdf"></i>.pdf</a>
                            </td>
                        </tr>
                    </tbody>  
                </table>   
            </div>  
        </div>  
        <div class="card-footer py-2"></div>
    </div>  


<div class="modal fade" id="RowModal">
    <div class="modal-dialog modal-xl ui-draggable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Row Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-7 col-xs-12">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <div class="form-group">
                            <label for="">Assignment</label>
                            <select name="category" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Telephone</label>
                            <input type="text" name="telephone" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Website</label>
                            <input type="text" name="website" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="action-add d-none">
                    <button type="button" class="btn btn-primary add-row"><i class="fas fa-save pr-2"></i> Confirm</button>
                </div>
                <div class="action-edit d-none">
                    <button type="button" class="btn btn-warning update-row"><i class="fas fa-save pr-2"></i> Update</button>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ClearModal()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalComment">
    <div class="modal-dialog ui-draggable" role="document">
        <div class="modal-content ui-draggable-handle">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">   
                <p class="text-left">08-11-2023 10:32:41 - ติดต่อลูกค้าไม่ได้</p>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div> --}}


