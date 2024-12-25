<style>
    .odd{
        cursor: pointer;
    }
    .timeline {
        list-style-type: none;
        position: relative;
    }
    .timeline-item:before, .timeline:before {
        content: " ";
        display: inline-block;
        position: absolute;
        z-index: 1;
    }    
    .timeline {
        list-style-type: none;
        position: relative;
    }
    .timeline:before {
        background: #dee2e6;
        height: 100%;
        left: 9px;
        width: 2px;
    }
    .timeline-item:before {
        background: #fff;
        border: 3px solid #3b7ddd;
        border-radius: 50%;
        height: 20px;
        left: 0;
        width: 20px;
    }
    .timeline-item:before, .timeline:before {
        content: " ";
        display: inline-block;
        position: absolute;
        z-index: 1;
    }
    .text-sm {
        font-size: .75rem;
    }
    .text-muted {
        --bs-text-opacity: 1;
        color: #6c757d!important;
    }
    .float-end {
        float: right!important;
    }
</style>
<div>
        <div class="fade-in"> 
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card" id="page-index">                
                        {{-- <div class="card-header"> 
                            <a href="{{url("$prefix$segment")}}" class="card-header-action">{{ucfirst($folder)}} Management</a>
                            <div class="card-header-actions"></div>                            
                        </div> --}}
                        <div class="card-body">
                            <h4 class="pb-3">{{ucfirst($folder)}} Progress</h4>
                            <div class="table-responsive">
                                <table class="table no-footer table-res" id="sort_table" role="grid" style="border-collapse: collapse !important">
                                    <thead>
                                        <tr role="">
                                            <th width="5%">#</th>
                                            <th width="25%">Name</th>
                                            <th width="25%">Team</th>
                                            <th width="20%">Created</th>
                                            <th width="15%" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($rows)
                                        @foreach($rows as $key => $row)
                                            @php($company =\App\Models\CompanyMd::select('public','name_th','name_jp','description_th','description_jp','detail_th','detail_jp')->where('_id',$row->id))
                                            <tr role="row" class="odd" data-row="{{$key+1}}" data-id="{{$row->id}}" onClick="Activity({{$row->id}})">
                                                <td data-label="No."><span class="no">{{$key+1}}</span> <i class="fas fa-bars handle d-none"></i></td>
                                                <td data-label="Insurance :">
                                                    {{$row->name}}
                                                </td>
                                                <td>{{$row->team}}</td>
                                                <td data-label="Created :">{{$row->created_at}}</td>
                                                <td data-label="Status :" class="text-center">
                                                    <span class="badge badge-success">{{$row->status}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>      
                        </div>

                        
                    </div>                
                </div>
                <div class="col-lg-4">
                    <div class="card" id="content-timeline">
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
                                    <img src="img/Sample_User_Icon.png" width="64" height="64" class="rounded-circle mt-2" alt="Angelica Ramos">
                                </div>
                                <div class="col-sm-9 col-xl-12 col-xl-9">
                                    {{-- <strong>About me</strong>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> --}}
                                </div>
                            </div>
                            <strong>Activity</strong>
                            <ul class="timeline mt-2 mb-0" id="timeline">
                                <li>No record.</li>
                                
                            </ul>
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
    const contentHeight = $('#page-index').height();
    $('#content-timeline').css('height',contentHeight);
    
</script>