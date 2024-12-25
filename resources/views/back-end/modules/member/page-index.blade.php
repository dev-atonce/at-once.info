<div>
        <div class="fade-in"> 
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="page-index">                
                        <div class="card-header"> 
                            <a href="{{url("$prefix$segment")}}" class="card-header-action">{{ucfirst($folder)}} Management</a>
                            <div class="card-header-actions"></div>                            
                        </div>
                        <div class="card-body">
                            @csrf
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">    
                                            <label for="view">View : </label> 
                                            @php $numrows=10 @endphp
                                            <select name="view" id="view" class="form-control">
                                                <option value="10">10</option>
                                                @for($i=1; $i<6; $i++)
                                                <option value="{{$numrows = $numrows*2}}" @if(Request::get('view')==$numrows) selected @endif>{{$numrows}}</option>
                                                @endfor
                                                <option value="all" @if(Request::get('view')=='all') selected @endif>All</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-12">
                                        <label for="search">Keyword :</label>
                                        <div class="input-group">                                        
                                            <input type="text" name="keyword" class="form-control" id="search" value="{{Request::get('keyword')}}" placeholder="Keyword">
                                            <span class="input-group-append">
                                                <button class="btn btn-info" type="submit">Search</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <br>
                                <div class="form-group">
                                    {{-- <button class="btn btn-default w65" id="sort" data-text="Sort">Sort</button> --}}
                                    {{-- <span class="btn btn-secondary">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="select" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll">Select All</label>
                                        </div>
                                    </span> --}}
                                    {{-- <button class="btn btn-danger" id="delSelect" disabled> Delete</button>                                 --}}
                                    <a class="btn btn-primary" href="{{url("$prefix$segment/create")}}"> Create</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-footer table-res" id="sort_table" role="grid" style="border-collapse: collapse !important">
                                    <thead>
                                        <tr role="">
                                            <th width="5%">#</th>
                                            <th width="5%"></th>
                                            <th width="45%">Member</th>
                                            {{-- <th width="20%">Status</th> --}}
                                            <th width="15%">Created</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($rows)
                                        @php
                                            $item = $rows->firstItem();
                                        @endphp
                                        @foreach($rows as $key => $row)
                                            @php($company =\App\Models\CompanyMd::select('public','name_th','name_jp','description_th','description_jp','detail_th','detail_jp')->where('_id',$row->id))
                                            <tr role="row" class="odd" data-row="{{$key+1}}" data-id="{{$row->id}}" company="{{$company->count()}}">
                                                <td data-label="No."><span class="no">{{$item+$key}}</span> <i class="fas fa-bars handle d-none"></i></td>
                                                <td data-label="" >
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="select" class="custom-control-input ChkBox" id="ChkBox{{$row->id}}" value="{{$row->id}}">
                                                        <label class="custom-control-label" for="ChkBox{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                                <td data-label="Insurance :">
                                                    TH{{$row->name_th}}
                                                    JP{{$row->name_th}}
                                                    @if($company->count()>0)<a href="javascript:" class="badge badge-secondary --more"><i class="fas fa-angle-left text-primary"></i></a>@endif
                                                </td>
                                                {{-- <td><span>Total: {{$row->total}}</span> <span class="text-success">Online: {{$row->public}}</span> <span class="text-danger">Offline: {{$row->offline}}</span></td> --}}
                                                <td data-label="Created :">{{date('d-M-Y H:i:s',strtotime($row->created))}}</td>
                                                <td data-label="Actions :">
                                                    <a href="{{url("$prefix$segment/$row->id")}}" class="btn btn-info btn-sm" title="Company"><i class="fas fa-search"></i></a>                                                
                                                    <a href="{{url("$prefix$segment/edit/$row->id")}}" class="btn btn-warning btn-sm" title="Edit"><i class="far fa-edit"></i></a>                                                
                                                    <a href="javascript:" class="btn btn-danger btn-sm deleteItem" data-id="{{$row->id}}" title="Delete"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>     
                                            @if($company->count()>0)
                                            <tr style="display:none;">
                                                <td colspan="6">
                                                    <div class="row">
                                                        @foreach($company->get() as $co) 
                                                        <div class="card text-dark bg-light ml-2">
                                                            <div class="p-3">
                                                                <h6 class="card-title">{{$co->name_th}}</h6>
                                                                <hr style="padding:0; margin:0;">
                                                                <h6 class="badge"><strong>Status: </strong>@if($co->public==1)<a href="javascript:" class="text-success"> Publish</a>@else <a href="javascript:" class="text-danger">Offline</a> @endif</h6>
                                                                <h6 class="badge"><strong>Caption: </strong>@if($co->description_th!='')<i class="fas fa-check-circle text-success"></i>@else <i class="fas fa-exclamation-triangle text-warning"></i> @endif</h6>
                                                                <h6 class="badge"><strong>Detail: </strong>@if($co->detail_th!='')<i class="fas fa-check-circle text-success"></i>@else <i class="fas fa-exclamation-triangle text-warning"></i> @endif</h6>
                                                            </div>
                                                        </div>                                               
                                                        @endforeach
                                                    </div> 
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-center">
                                @if(Request::get('view')!='all'){{$rows->links()}}@endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <strong>ทั้งหมด</strong> {{$rows->total()}} @if(Request::get('view')!='all'): <strong>จาก</strong> {{$rows->firstItem()}} - {{$rows->lastItem()}}@endif
                        </div>
                    </div>                
                </div>
            </div>                
        </div>         
    </div>
    <script>
        var fullUrl = window.location.origin+'/webpanel/members';
        $('#delSelect').on('click',function(){
            const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ deleted(id) }
        })
        $('.deleteItem').on('click',function(){
            const id =[$(this).data('id')]; if(id.length>0){ deleted(id) }
        })
        function deleted(id){
            Swal.fire({
                title:"Delete data",text:"Do you want to delete the data?",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(fullUrl+'/delete?id='+id)
                    .then(response => response.json())
                    .then(data => location.reload())
                    .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
                }
            });
        }
        $('.--more').click(function(){
            const cur=$(this),tr = $(this).parent().parent();
            cur.children().toggleClass('fa-angle-down fa-angle-left');
            
            if(!tr.next().hasClass('--show')) {
                tr.next().slideDown('fast');
                tr.next().addClass('--show');
                tr.next().find('td').css('border-top','none');
            } else {
                tr.next().slideUp('fast');
                tr.next().removeClass('--show');
            }
        })
    </script>