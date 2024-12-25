<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix/company/$category/statistics/$cid") }}">Statistics</a> / Popup Form</span>
                    {{-- <small
                        class="badge badge-secondary"><a href="webpanel/export/sms-popup" target="_blank" class="export"><i class="fas fa-file-export"></i>
                            Export.csv</a></small> --}}
                </div>
                <div class="card-body">
                    <div class="card p-3">
                        <form method="get">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="text" name="keyword" id="keyword" class="form-control"
                                            value="{{ Request::get('keyword') }}" placeholder="Keyword">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Date" aria-label="Date"
                                            name="date" id="date" autocomplete="off" value="{{ Request::get('date') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary reset-date"
                                                type="button">Reset</button>
                                        </div>
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
    let exportLink = $('.export').attr('href');

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
        $('.export').attr('href', exportLink + `?date=${$(this).val()}`);
    });
    $('.reset-date').on('click', function() {
        $(this).closest('.input-group').find('input').val('');
    });
</script>
