<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: -webkit-fill-available !important;
    }
</style>

<h5 class="font-weight-bold pb-2">{{$cp_name->name_th}}</h5>

<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="text" id="daterangeVisitor" class="form-control" name="daterange" readonly style="background-color:whitesmoke;">  
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary input-sm btn-search" type="button" data-type="clicks"><i class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-outline-danger input-sm btn-reset" type="button" data-type="clicks"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>                             
                </div>
                <div class="mb-3"></div>
            </div>
            <div class="col">
                <a href="{{$prefix}}/company/{{$category}}/sms/{{request()->segment(5)}}/report" class="btn btn-outline-success float-right">Report</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="card text-white bg-gradient-info">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-popup">
                        <div style="min-height:100px;">
                            <div class="text-value-lg">0</div>
                            <div>Total Popup Showed Up</div>
                        </div>
                        <i class="fas fa-eye fa-4x"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="card text-white bg-gradient-primary">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-send">
                        <div style="min-height:100px;">
                            <div class="text-value-lg">0</div>
                            <div>User Fill In Popup</div>
                        </div>
                        <i class="fas fa-user-edit fa-4x"></i>
                    </div>
                </div>
            </div>   
            <div class="col-lg-3 col-xs-12">
                <div class="card text-white bg-gradient-dark">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-sms">
                        <div style="min-height:100px;">
                            <div class="text-value-lg">0</div>
                            <div>Send Popup By SMS</div>
                        </div>
                        <i class="fas fa-sms fa-4x"></i>
                    </div>
                </div>
            </div>  
            <div class="col-lg-3 col-xs-6">
                <div class="card bg-gradient-light">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-line">
                        <div style="min-height:100px;">
                            <div class="text-value-lg">0</div>
                            <div>Send Popup By Line Notification</div>
                        </div>
                        <i class="fab fa-line fa-4x"></i>
                    </div>
                </div>
            </div>         
        </div>
    </div>
</div>

<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card p-3">
                        <form method="get">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="text" name="keyword" id="keyword" class="form-control"
                                            value="{{ Request::get('keyword') }}" placeholder="Keyword">
                                            <input type="hidden" name="cid" value="{{request()->segment(5)}}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Date" aria-label="Date"
                                            name="date" id="date" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary reset-date"
                                                type="button">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="sms"  @if (Request::get('type') == 'sms') selected @endif>SMS</option>
                                            <option value="line"  @if (Request::get('type') == 'line') selected @endif>Line</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="input-group">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Telephone</th>
                                        <th>Message</th>
                                        <th>Send By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows->count() > 0)
                                        @foreach ($rows as $key => $row)
                                            <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                                data-id="{{ $row->id }}">
                                                <td>{{ $row->created }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->telephone }}</td>
                                                <td>{{ $row->message }}</td>
                                                <td>{{ $row->type }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h5>No data Found !</h5>
                                            </div>
                                        </div>
                                    @endif
                                </tbody>
                            </table>
                            {{ $rows->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    range = '{{ Request::get('date') }}';
    range = (range != '') ? range.split('-') : '';
    start = (range.length > 0) ? range[0].trim() : '';
    end = (range.length > 0) ? range[1].trim() : '';

    $('#date').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'YYYY/MM/DD'
        },
        cancelButtonClasses: 'btn-danger',
        startDate: (range.length > 0) ? range[0] : false,
        endDate: (range.length > 0) ? range[1] : false,
    });
    $('#date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });
    $('.reset-date').on('click', function() {
        $(this).closest('.input-group').find('input').val('');
    });

    let apiUrl = window.location.pathname;
    let category = apiUrl.split('/')[3];
    let cid = apiUrl.split('/')[5];

    $('input[name="daterange"]').daterangepicker();
    function totalpopup(request)
    {
        request = (request==null)?'':'?range='+request;
        const popup = $.ajax({url:'api/'+category+'/'+cid+'/statistics/popup'+request,async:false}).responseJSON

        $('.all-popup').find('.text-value-lg').html(popup.popup);
        $('.all-send').find('.text-value-lg').html(popup.send);
        $('.all-sms').find('.text-value-lg').html(popup.sms);
        $('.all-line').find('.text-value-lg').html(popup.line);
    }

    this.totalpopup();

    let search = document.querySelectorAll('.btn-search');
    for(i=0; i<search.length; i++) {
        search[i].onclick = function(){
            let testDate = this.parentNode.previousElementSibling.value;
                testDate = testDate.split(' - ');
            let request = moment(testDate[0]).format('YYYY-MM-DD')+','+moment(testDate[1]).format('YYYY-MM-DD');
            switch (this.getAttribute('data-type')) {
                case 'clicks':  
                    totalpopup(request); 
                break;
                default: 
                break;
            }
        }
    }

    let reset = document.querySelectorAll('.btn-reset');
    for(i=0; i<reset.length; i++){
        reset[i].onclick = function() {
            switch (this.getAttribute('data-type')) {
                case 'clicks':  
                    totalpopup(''); 
                break;
                default : 
                break;
            }
        }
    }
</script>