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
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start banner-click">
                        <div style="min-height:100px;">
                            <div class="text-value-lg">0</div>
                            <div>Total Click Banner</div>
                        </div>
                        <i class="fas fa-eye fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    let apiUrl = window.location.pathname;
    let category = apiUrl.split('/')[3];
    let cid = apiUrl.split('/')[5];

    $('input[name="daterange"]').daterangepicker();
    function staticClick(request)
    {
        request = (request==null)?'':'?range='+request;
        const stClick = $.ajax({url:'api/'+category+'/'+cid+'/statistics/banner'+request,async:false}).responseJSON
        $('.banner-click').find('.text-value-lg').html(stClick.banner);
    }

    this.staticClick();

    var search = document.querySelectorAll('.btn-search');
    for(i=0; i<search.length; i++) {
        search[i].onclick = function(){
            let testDate = this.parentNode.previousElementSibling.value;
                testDate = testDate.split(' - ');
            let request = moment(testDate[0]).format('YYYY-MM-DD')+','+moment(testDate[1]).format('YYYY-MM-DD');
            switch (this.getAttribute('data-type')) {
                case 'clicks':  staticClick(request); break;
                default: staticClick(); break;
            }
        }
    }

    var reset = document.querySelectorAll('.btn-reset');
    for(i=0; i<reset.length; i++){
        reset[i].onclick = function() {
            switch (this.getAttribute('data-type')) {
                case 'clicks':  staticClick(''); break;
                default : staticClick(''); break;
            }
        }
    }
</script>