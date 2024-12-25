<div id="page-index">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url("$segment") }}" class="card-header-action">Menu Management</a>
                        <div class="card-header-actions"></div>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="view">View : </label>
                                        @php($numrows = 10)
                                        <select name="view" id="view" class="form-control">
                                            <option value="10">10</option>
                                            @for ($i = 1; $i < 6; $i++)
                                                <option value="{{ $numrows = $numrows * 2 }}"
                                                    @if (Request::get('rows') == $numrows) selected @endif>
                                                    {{ $numrows }}</option>
                                            @endfor
                                            <option value="all">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <label for="search">Keyword :</label>
                                    <div class="input-group">
                                        <input type="text" name="keyword" class="form-control" id="search"
                                            value="{{ Request::get('keyword') }}" placeholder="Name of News">
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
                                        <input type="checkbox" name="select" class="custom-control-input"
                                            id="selectAll">
                                        <label class="custom-control-label" for="selectAll">Select All</label>
                                    </div>
                                </span>
                                <button class="btn btn-danger" id="delSelect" disabled> Delete</button>
                                <a class="btn btn-primary" href="{{ url("$segment/create") }}"> Create</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped no-footer" id="DataTables_Table_0" role="grid"
                                aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="select"
                                                    class="custom-control-input selectAll" id="selectAll">
                                                <label class="custom-control-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th width="55%">News</th>
                                        <th width="15%">Created</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows)
                                        @foreach ($rows as $key => $row)
                                            <tr role="row" class="odd">
                                                <td style="width:5%; text-align:center;">{{ $key + 1 }}</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="select"
                                                            class="custom-control-input ChkBox"
                                                            id="ChkBox{{ $row->id }}" value="{{ $row->id }}">
                                                        <label class="custom-control-label"
                                                            for="ChkBox{{ $row->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ $row->image }}" class="img-thumbnail">
                                                </td>
                                                <td>{{ date('d-M-Y H:i:s', strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                        <input class="c-switch-input status" type="checkbox"
                                                            data-id="{{ $row->id }}"
                                                            @if ($row->status == 1) checked @endif><span
                                                            class="c-switch-slider" data-checked="On"
                                                            data-unchecked="Off"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{ url("$segment/edit/$row->id") }}"
                                                        class="btn btn-secondary" title="Edit"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="javascript:" class="btn btn-danger deleteItem"
                                                        data-id="{{ $row->id }}" title="Delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $rows->links() }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>ทั้งหมด</strong> {{ $rows->count() }} : <strong>จาก</strong> {{ $rows->firstItem() }}
                        - {{ $rows->lastItem() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sortModal" data-backdrop="static" tabindex="-1" aria-labelledby="sortModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sortModalLabel">Sort Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <ul id="mainCategory" class="list-group">
                        @foreach (\App\Models\BannerMd::select('id', '_type', 'type as industryId', '_id as companyId', 'image', 'title', 'caption')->orderBy('sort')->get() as $k => $v)
                            <li class="list-group-item bg-white p-2" data-id="{{ $v->id }}" data-name="{{ $v->title }}">
                                <div>
                                    <p class="mr-2">{{ $v->_type }}</p>
                                </div>
                                <div>
                                    <img width="100%" src="{{ $v->image }}"> 
                                </div>
                            </li>
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
    document.addEventListener('click', function(e) {
        sort = e.target.closest('#sort');
        if (sort) {
            Modal = $('#sortModal');
            let dnl = new DraggableNestableList('#mainCategory');
            Modal.modal('show');
            Modal[0].querySelector('.btn-secondary').addEventListener('click', function() {
                dnl.destroy();
            });
            Modal[0].querySelector('.btn-primary').addEventListener('click', function() {
                dnl.save('webpanel/banner/sort');
            });
        }
    })
</script>
