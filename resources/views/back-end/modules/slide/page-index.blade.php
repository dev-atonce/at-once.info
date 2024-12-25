<div>
        <div class="fade-in"> 
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">                
                        <div class="card-header"> 
                            <a href="{{url("$prefix/$segment[0]")}}" class="card-header-action">Menu Management</a>
                            <div class="card-header-actions">
                                <a class="btn btn-sm btn-primary" href="{{url("$prefix/$segment[0]/create")}}"> Add</a>   
                                <button class="btn btn-sm btn-danger" type="reset" id="delSelect" disabled> Delete</button>                                                     
                            </div>                            
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
                                                <option value="{{$numrows = $numrows*2}}" @if(Request::get('rows')==$numrows) selected @endif>{{$numrows}}</option>
                                                @endfor
                                                <option value="all">All</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-12">
                                        <label for="search">Keyword :</label>
                                        <div class="input-group">                                        
                                            <input type="text" name="keyword" class="form-control" id="search" value="{{Request::get('keyword')}}" placeholder="Name of Menu">
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary" type="submit">Search</button>
                                            </span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                                    <thead>
                                        <tr role="">
                                            <th width="5%" style="text-align:center;">#</th>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="select" class="custom-control-input selectAll" id="selectAll">
                                                    <label class="custom-control-label" for="selectAll"></label>
                                                </div>
                                            </th>
                                            <th width="55%">Slide Image</th>
                                            <th width="15%">Created</th>
                                            <th width="10%">Status</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($rows)
                                        @foreach($rows as $key => $row)
                                            <tr role="row" class="odd">
                                                <td style="width:5%; text-align:center;">{{$key+1}}</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="select" class="custom-control-input ChkBox" id="ChkBox{{$row->id}}" value="{{$row->id}}">
                                                        <label class="custom-control-label" for="ChkBox{{$row->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{str_replace('.','-sm.',$row->image)}}" class="img-responsive">
                                                </td>
                                                <td>{{date('d-M-Y H:i:s',strtotime($row->created))}}</td>
                                                <td>
                                                    <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                        <input class="c-switch-input status" type="checkbox" data-id="{{$row->id}}" @if($row->status=='on') checked @endif><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{url("$prefix/$segment[0]/$row->id")}}" class="btn btn-secondary" title="Edit"><i class="far fa-edit"></i></a>                                                
                                                    <a href="javascript:" class="btn btn-danger deleteItem" data-id="{{$row->id}}" title="Delete"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{$rows->links()}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <strong>ทั้งหมด</strong> {{$rows->count()}} : <strong>จาก</strong> {{$rows->firstItem()}} - {{$rows->lastItem()}} 
                        </div>
                    </div>                
                </div>
            </div>                
        </div>         
    </div>
        