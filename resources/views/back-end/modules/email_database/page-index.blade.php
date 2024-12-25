<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="fade-in">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 position-relative">
                    <span class="my-2 font-weight-bold text-info">Total: {{number_format($total)}}</span>
                    <form class="my-2 "action="">
                        
                        <div class="d-flex justify-content-center">
                            <div class="form-inline">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button 
                                        type="button" 
                                        val="profile-create" 
                                        text="Company profile page" 
                                        class="source btn {{Request::get('type')=='Company profile page'||!Request::get('type')?'btn-primary':'btn-outline-primary'}}">Company Profile Page <span class="badge badge-light border ml-1">{{$count[0]}}</span>
                                    </button>
                                    <button 
                                        type="button" 
                                        val="cpProfile+blogCt+formCat" 
                                        text="User to company" 
                                        class="source btn {{Request::get('type')=='User to company'?'btn-primary':'btn-outline-primary'}}">User To CP. <span class="badge badge-light border ml-1">{{$count[1]}}</span>
                                    </button>
                                    <button 
                                        type="button" 
                                        val="blogMk+1ceProfile+package+contact+basicCp" 
                                        text="Company or users to us" 
                                        class="source btn {{Request::get('type')=='Company or users to us'?'btn-primary':'btn-outline-primary'}}">CP. or users to us <span class="badge badge-light border ml-1">{{$count[2]}}</span>
                                    </button>
                                    <button 
                                        type="button" 
                                        val="ma" 
                                        text="MA of customer" 
                                        class="source btn {{Request::get('type')=='MA of customer'?'btn-primary':'btn-outline-primary'}}">Ma of customers <span class="badge badge-light border ml-1">{{$count[3]}}</span>
                                    </button>
                                    <button 
                                    type="button" 
                                    val="all" 
                                    text="All Type" 
                                    class="source btn {{Request::get('type')=='All Type'?'btn-primary':'btn-outline-primary'}}">All Type
                                </button>
                                </div>
                                <input type="hidden" name="source" value="{{Request::get('source')?Request::get('source'):'profile-create'}}">
                                <input type="hidden" name="type" value="{{Request::get('type')?Request::get('type'):'Company profile page'}}">
                            </div><br/>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <div class="form-inline">
                                {{-- <input type="text" 
                                    class="form-control mx-2"
                                    placeholder="Date range"
                                    aria-label="Date" 
                                    name="date"
                                    id="date" 
                                    autocomplete="off" 
                                    value="{{Request::get('date')?Request::get('date'):date('Y-m-01').' - '.date('Y-m-t')}}"
                                /> --}}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search mr-1"></i> Search</button>
                                    <button type="reset" class="btn btn-secondary reset-date"><i class="fas fa-sync-alt mr-1"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="position-absolute" style="top:0; right:15px;">
                        <a href="webpanel/export/email-database" target="_blank" class="btn btn-dark btn-sm position-absolute" style="right: 0;"><i class="fas fa-file-export mr-1"></i>Export</a>
                    </div>
                </div>            
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Request::get('source')!='all')
                                    @php($first = $rows->firstItem())
                                    @foreach($rows as $i => $row)
                                    <tr>
                                        <td>{{$first+$i}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->company}}</td>
                                        <td>{{Request::get('type')?Request::get('type'):'Company profile page'}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    @for($i=0; $i<count($rows); $i++)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$rows[$i]['email']}}</td>
                                            <td>{{$rows[$i]['name']}}</td>
                                            <td>{{$rows[$i]['company']}}</td>
                                            <td>{{$rows[$i]['type']}}</td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        @if(Request::get('source')!='all')
                            <div class="d-flex justify-content-center">
                                {{$rows->links()}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>              
    </div>         
</div>   
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    const queryString = window.location.search;
    const exportBtn = $('.fa-file-export').parent();
    exportBtn.attr('href',exportBtn.attr('href')+queryString);
    $('#date').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'YYYY/MM/DD'
        },
        cancelButtonClasses: 'btn-danger',
    });
    $('#date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });
    $('.reset-date').on('click', function() {
        $(this).closest('.input-group').find('input').val('');
    });
    $(document).on('click','.source',function(){
        $('button.btn-primary').toggleClass('btn-primary btn-outline-primary');
        $(this).toggleClass('btn-outline-primary btn-primary');
        $('input[name="source"]').val($(this).attr('val'));
        $('input[name="type"]').val($(this).attr('text'));
    })
</script>