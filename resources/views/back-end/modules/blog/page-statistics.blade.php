<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    #blogStatLoading {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.65);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: inherit;
    }

    #blogStatLoading.show {
        display: flex;
    }

    #blogStatLoading .stat-spinner {
        width: 56px;
        height: 56px;
        margin: 0 auto;
        border: 6px solid #d6dce5;
        border-top-color: #321fdb;
        border-radius: 50%;
        animation: statSpin 0.8s linear infinite;
    }

    @keyframes statSpin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div class="card position-relative">
    <div id="blogStatLoading">
        <div class="text-center">
            <div class="stat-spinner"></div>
            <div class="mt-2 font-weight-bold text-primary">Loading…</div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-lg-12 col-xs-12 position-relative">
                <a href="{{ url("$prefix$segment") }}" class="btn btn-outline-secondary btn-sm position-absolute"
                    style="right:0; top:0"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
                <div class="text-muted">Blog Statistics</div>
                <div class="font-weight-bold pb-2" style="font-size:1.1rem;">{{ $blog->name_th }}</div>
                <div class="text-muted">{{ $blog->companyName }}</div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6 col-xs-12 form-inline">
                <div class="input-group float-left">
                    <input type="text" id="daterange" class="form-control" name="daterange"
                        style="background-color:whitesmoke;">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary input-sm btn-search" type="button"><i
                                class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-outline-danger input-sm btn-reset" type="button"><i
                                class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12">
                <div class="card bg-gradient-dark">
                    <div class="card-body pt-2 pb-2 d-flex justify-content-between align-items-center text-white">
                        <div style="min-height:90px;" class="d-flex flex-column align-items-start">
                            <div>
                                <div class="text-value-lg viewRange">0</div>
                                <div>Views (selected range)</div>
                            </div>
                            <div>
                                <div class="text-value-lg viewTotal">0</div>
                                <div>Total Views</div>
                            </div>
                        </div>
                        <i class="fas fa-eye fa-4x"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12">
                <div class="card bg-gradient-success">
                    <div class="card-body pt-2 pb-2 d-flex justify-content-between align-items-center text-white">
                        <div style="min-height:90px;" class="d-flex flex-column align-items-start">
                            <div>
                                <div class="text-value-lg contactRange">0</div>
                                <div>Inquiries (selected range)</div>
                            </div>
                            <div>
                                <div class="text-value-lg contactTotal">0</div>
                                <div>Total Inquiries</div>
                            </div>
                        </div>
                        <i class="fas fa-inbox fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="text-center">Blog Views</h3>
        <div class="form-inline justify-content-center mb-3">
            <label class="mr-2 mb-0">From</label>
            <input type="month" id="blogFrom" class="form-control mr-3">
            <label class="mr-2 mb-0">To</label>
            <input type="month" id="blogTo" class="form-control mr-3">
            <button type="button" class="btn btn-outline-primary btn-blog-graph">
                <i class="fas fa-search"></i>&nbsp;Show
            </button>
        </div>
        <div id="blogview"></div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    const blogId = {{ $blog->id }};
    const apiBase = '/api/blog/' + blogId + '/stat';

    // ---- Loading overlay (calls are sync, so paint the spinner first) ----
    function showLoading() { document.getElementById('blogStatLoading').classList.add('show'); }
    function hideLoading() { document.getElementById('blogStatLoading').classList.remove('show'); }
    function withLoading(work) {
        showLoading();
        setTimeout(function() {
            try { work(); } finally { hideLoading(); }
        }, 50);
    }

    // ---- Date range picker: empty by default = All-time ----
    $('input[name="daterange"]').daterangepicker({
        locale: { format: 'DD/MM/YYYY' },
        autoApply: true,
        autoUpdateInput: false,
        startDate: moment().startOf('month'),
        endDate: moment(),
        minDate: moment('20000101', 'YYYYMMDD'),
        maxDate: moment()
    });
    $('input[name="daterange"]').attr('placeholder', 'All-time');
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    // ---- Summary cards (views + inquiries) ----
    function fetchSummary(range) {
        const res = $.ajax({
            url: apiBase + '/summary',
            data: { range: range || '' },
            async: false
        }).responseJSON;
        if (!res) return;
        $('.viewRange').text(res.viewRange);
        $('.viewTotal').text(res.viewTotal);
        $('.contactRange').text(res.contactRange);
        $('.contactTotal').text(res.contactTotal);
    }

    // ---- Blog Views chart (custom month range; empty = last 6 months) ----
    function fetchBlogGraph(from, to) {
        let url = apiBase + '/graph';
        const params = [];
        if (from) params.push('from=' + from);
        if (to) params.push('to=' + to);
        if (params.length) url += '?' + params.join('&');

        const res = $.ajax({ url: url, async: false }).responseJSON;
        if (!res || !res.series) return;
        $('#blogFrom').val(res.from);
        $('#blogTo').val(res.to);

        Highcharts.chart('blogview', {
            chart: { type: 'column' },
            title: { text: 'Blog Views', align: 'center' },
            xAxis: { categories: res.series.map(s => s.label), crosshair: true },
            yAxis: { min: 0, title: { text: 'Total (views)' } },
            plotOptions: { column: { pointPadding: 0.2, borderWidth: 0 } },
            series: [{ name: 'Blog Views', data: res.series.map(s => s.total) }]
        });
    }

    // ---- Initial load (All-time) ----
    fetchSummary('');
    fetchBlogGraph();

    document.addEventListener('click', function(e) {
        const searchBtn = e.target.closest('.btn-search');
        if (searchBtn) {
            const hasRange = $('input[name="daterange"]').val().trim() !== '';
            let request = '';
            if (hasRange) {
                const picker = $('input[name="daterange"]').data('daterangepicker');
                request = picker.startDate.format('YYYY-MM-DD') + ',' + picker.endDate.format('YYYY-MM-DD');
            }
            withLoading(function() {
                fetchSummary(request);
            });
        }

        const resetBtn = e.target.closest('.btn-reset');
        if (resetBtn) {
            $('input[name="daterange"]').val('');
            withLoading(function() {
                fetchSummary('');
            });
        }

        const blogGraphBtn = e.target.closest('.btn-blog-graph');
        if (blogGraphBtn) {
            withLoading(function() {
                fetchBlogGraph($('#blogFrom').val(), $('#blogTo').val());
            });
        }
    });
</script>
