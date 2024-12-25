<div>
    <div class="fade-in"> 
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">                
                    <div class="card-header"> 
                        <a href="{{url("$prefix/$segment")}}" class="card-header-action">Menu Management</a>
                        <div class="card-header-actions"></div>                            
                    </div>
                    <div class="card-body">
                        @csrf
                        <form action="" method="get">                            
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="form-group">    
                                        <label for="view">View : </label> 
                                        @php($numrows=10)
                                        <select name="view" id="view" class="form-control">
                                            <option value="10" @if(Request::get('view')==10) selected @endif>10</option>
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
                                        <input type="text" name="keyword" class="form-control" id="search" value="{{Request::get('keyword')}}" placeholder="Name of Menu">
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">Search</button>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                        <div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-default w65" id="sort" data-text="Sort">Sort</button>
                                <span class="btn btn-secondary">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="select" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll">Select All</label>
                                    </div>
                                </span>
                                <button class="btn btn-danger" id="delSelect" disabled> Delete</button>                                
                                <a class="btn btn-primary" href="{{url("$prefix$segment/create")}}">Create</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-footer" id="sorted_table" style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="select" class="custom-control-input selectAll" id="selectAll">
                                                <label class="custom-control-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th width="55%">Name of menu</th>
                                        <th width="15%">Created</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($rows)
                                    @foreach($rows as $key => $row)
                                        @php($secondary = \App\Models\MenuMd::where('_id',$row->id)->orderBy('sort')->get())
                                        <tr role="row" class="odd" data-row="{{$key+1}}" data-id="{{$row->id}}">
                                            <td style="width:5%; text-align:center;">
                                                <span class="no">{{$key+1}}</span>
                                                <i class="fas fa-bars handle" style="display:none;"></i>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="select" class="custom-control-input ChkBox" id="ChkBox{{$row->id}}" value="{{$row->id}}">
                                                    <label class="custom-control-label" for="ChkBox{{$row->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                {{$row->name}}
                                                @if(count($secondary)>0) 
                                                <a href="javascript:" class="badge badge-success menu-nd" type="button" data-toggle="collapse" data-target=".multi-collapse{{$key}}" aria-expanded="false" aria-controls="col2{{$key}} col3{{$key}} col4{{$key}} col5{{$key}}">Secondary</a>
                                                <div class="collapse multi-collapse{{$key}}" id="col2{{$key}}">
                                                    <div class="sort-action text-right">
                                                        <a class="badge badge-secondary sort-category" href="javascript:">Sort</a>
                                                        <a class="badge badge-success sort-save d-none" href="javascript:">Save</a>
                                                        <a class="badge badge-light sort-cancel d-none" href="javascript:">Cancel</a>
                                                    </div>
                                                    <ul class="list-group" id="sort{{$key}}" style="margin-top:5px">
                                                    @foreach($secondary as $col2)
                                                        @php($third=\App\Models\MenuMd::where(['_id'=>$col2->id,'position'=>'third'])->orderBy('sort')->get())
                                                        <li class="list-group-item p-2" data-id="{{$col2->id}}" data-name="{{$col2->name}}">
                                                            <div class="d-flex justify-content-between">
                                                                <span>
                                                                    {{$col2->name}}
                                                                    @if($third->count()>0)
                                                                        <a href="javascript:" class="badge badge-light ml-1" data-target="#third{{$col2->id}}" data-toggle="collapse" aria-expanded="false" >
                                                                            <i class="fas fa-plus"></i>
                                                                        </a>
                                                                    @endif
                                                                </span>
                                                                <div class="justify-content-end">
                                                                    <a class="badge badge-success badge-status" data-id="{{$col2->id}}" href="javascript:">{{$col2->status}}</a>
                                                                    <a class="badge badge-secondary" href="{{url("$prefix$segment/$col2->id")}}"><i class="fas fa-pen"></i></a>
                                                                    <a class="badge badge-danger deleteItem" data-id="{{$col2->id}}" href="javascript:"><i class="fas fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                            @if($third->count()>0)
                                                                <ul class="mt-2 collapse list-group" id="third{{$col2->id}}">
                                                                @foreach($third as $krd => $vrd)
                                                                    @php($fourth=\App\Models\MenuMd::where(['_id'=>$vrd->id,'position'=>'fourth'])->orderBy('sort')->get())
                                                                    <li class="list-group-item p-2" data-id="{{$vrd->id}}" data-name="{{$vrd->name}}">
                                                                        <div class="d-flex justify-content-between">
                                                                            <span>
                                                                                {{$vrd->name}}
                                                                                @if($fourth->count() > 0)
                                                                                <a href="javascript:" class="badge badge-light ml-1" data-target="#fourth{{$vrd->id}}" data-toggle="collapse" aria-expanded="false" >
                                                                                    <i class="fas fa-plus"></i>
                                                                                </a>
                                                                                @endif
                                                                            </span>
                                                                            <div class="justify-content-end">
                                                                                <a class="badge badge-success badge-status" data-id="{{$vrd->id}}" href="javascript:">{{$vrd->status}}</a>
                                                                                <a class="badge badge-secondary" href="{{url("$prefix$segment/$vrd->id")}}"><i class="fas fa-pen"></i></a>
                                                                                <a class="badge badge-danger deleteItem" data-id="{{$vrd->id}}" href="javascript:"><i class="fas fa-times"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        @if($fourth->count() > 0)
                                                                        <ul class="mt-2 collapse list-group" id="fourth{{$vrd->id}}">
                                                                            @foreach($fourth as $kth => $vth)
                                                                                <li class="list-group-item p-2" data-id="{{$vth->id}}" data-name="{{$vth->name}}">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <span>{{$vth->name}}</span>
                                                                                        <div class="justify-content-end">
                                                                                            <a class="badge badge-success badge-status" data-id="{{$vth->id}}" href="javascript:">{{$vth->status}}</a>
                                                                                            <a class="badge badge-secondary" href="{{url("$prefix$segment/$vth->id")}}"><i class="fas fa-pen"></i></a>
                                                                                            <a class="badge badge-danger deleteItem" data-id="{{$vth->id}}" href="javascript:"><i class="fas fa-times"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach  
                                                    </ul>                               
                                                </div>
                                                @endif 
                                            </td>
                                            <td>
                                                {{date('d-M-Y H:i:s',strtotime($row->created))}}
                                            </td>
                                            <td>
                                                <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                    <input class="c-switch-input status" type="checkbox" data-id="{{$row->id}}" @if($row->status=='on') checked @endif><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{url("$prefix$segment/$row->id")}}" class="btn btn-secondary" title="Edit"><i class="far fa-edit"></i></a>                                                
                                                <a href="javascript:" class="btn btn-danger deleteItem" data-id="{{$row->id}}" title="Delete"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if(Request::get('view')!='all') {{$rows->links()}} @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>ทั้งหมด</strong> {{$rows->count()}} @if(Request::get('view')!='all'): <strong>จาก</strong> {{$rows->firstItem()}} - {{$rows->lastItem()}} @endif
                    </div>
                </div>                
            </div>
        </div>                
    </div>         
</div>
<div class="modal fade" id="sortModal" data-backdrop="static" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sortModalLabel">Sort Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <ul id="mainCategory" class="list-group">
                @foreach(\App\Models\MenuMd::where('position','main')->get() as $k => $v)
                <li class="list-group-item p-2" data-id="{{$v->id}}" data-name="{{$v->name}}"><span>{{$v->name}}</span></li>
                @endforeach
            </ul>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Save Change</button>
        </div>
      </div>
    </div>
  </div>
<script>
    var fullUrl = window.location.origin + '/webpanel/menu';
    const deleteItem = document.querySelectorAll('a.deleteItem');
    for(let i=0; i<deleteItem.length; i++)
    {
        deleteItem[i].addEventListener('click',function(e){
            id = this.getAttribute('data-id');
            Delete(id)
        })
    }
    const Delete = (id) => {
        if(confirm('Confirm to delete?'))
        {
            fetch(`${fullUrl}/destroy/${id}`)
            .then(res => res.json())
            .then(data => { alert('You request is sucess!'); setTimeout(() => { location.reload() }, 1500); })
            .catch(error => { console.log(`Request failed: ${error}`) })
        }
    }
    
    document.addEventListener('click',function(e)
    {
        sortCategory = e.target.closest('.sort-category');
        if (sortCategory)
        {
            sortContent = sortCategory.closest('.collapse');
            sortContent.querySelector('.sort-category').classList.add('d-none');
            sortContent.querySelector('.sort-save').classList.remove('d-none');
            sortContent.querySelector('.sort-cancel').classList.remove('d-none');
            ul = sortContent.querySelector('.list-group');
            id = ul.getAttribute('id');
            let dnl = new DraggableNestableList(`#${id}`);
            sortContent.querySelector('.sort-save').addEventListener('click',function(){
                dnl.save('webpanel/menu/sort');
            });
            sortContent.querySelector('.sort-cancel').addEventListener('click',function(){
                dnl.destroy();
            })
        }
        sort = e.target.closest('#sort');
        if(sort){
            modal = $('#sortModal');
            let dnl = new DraggableNestableList('#mainCategory');
            modal.modal('show');
            modal[0].querySelector('.btn-secondary').addEventListener('click',function(){
                dnl.destroy();
            });
            modal[0].querySelector('.btn-primary').addEventListener('click',function(){
                let data = [];
                Array.from(modal[0].querySelectorAll('li')).map(function(v,k){
                    data.push({
                        id:v.getAttribute('data-id'), name:v.getAttribute('data-name'), sort:(k+1)
                    })
                })
                dnl.save('webpanel/menu/sort')
            });
        }
    })

</script>   