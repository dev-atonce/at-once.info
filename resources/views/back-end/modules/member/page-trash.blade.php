<div>
        <div class="fade-in"> 
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card" id="page-trash">                
                        <div class="card-header"> 
                            <a href="{{url("$prefix$segment")}}" class="card-header-action">Insurance Management</a>
                            <div class="card-header-actions"></div>                            
                        </div>
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <div class="form-group">    
                                            <label for="view">View : </label> 
                                            @php($numrows=10)
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
                                            <input type="text" name="keyword" class="form-control" id="search" value="{{Request::get('keyword')}}" placeholder="Name of News">
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
                                    <span class="btn btn-secondary">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="select" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll">Select All</label>
                                        </div>
                                    </span>
                                    <button class="btn btn-info" id="resSelect" disabled> Restore</button>
                                    <button class="btn btn-danger" id="delSelect" disabled> Delete</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped no-footer table-res" role="grid" style="border-collapse: collapse !important">
                                    <thead>
                                        <tr role="">
                                            <th width="5%">#</th>
                                            <th></th>
                                            <th width="55%">Insurance</th>
                                            <th width="15%">Deleted</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($rows)>0)
                                        @foreach($rows as $key => $row)
                                            <tr role="row" class="odd" data-row="" data-id="" id="">
                                                <td data-label="No."><span class="no">{{$key+1}}</span></i></td>
                                                <td data-label="" >
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="select" class="custom-control-input ChkBox" id="ChkBox{{$row->id}}" value="{{$row->id}}">
                                                        <label class="custom-control-label" for="ChkBox{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                                <td data-label="Insurance :">
                                                    {{$row->name_th}}
                                                </td>
                                                <td data-label="Created :">{{date('d-M-Y H:i:s',strtotime($row->deleted))}}</td>
                                                <td data-label="Actions :">
                                                    <a href="javasript:" class="btn btn-info btn-sm restoreItem" data-id="{{$row->id}}" title="Restore"><i class="fas fa-recycle"></i></a>                                                
                                                    <a href="javascript:" class="btn btn-danger btn-sm destroyItem" data-id="{{$row->id}}" title="Destroy"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                         <tr><td colspan="5" align="center">No Item.</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if(Request::get('view')!='all'){{$rows->links()}}@endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <strong>ทั้งหมด</strong> {{$rows->count()}} @if(Request::get('view')!='all'): <strong>จาก</strong> {{$rows->firstItem()}} - {{$rows->lastItem()}}@endif
                        </div>
                    </div>                
                </div>
            </div>                
        </div>         
    </div>
        