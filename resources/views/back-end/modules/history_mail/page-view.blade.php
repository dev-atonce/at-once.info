<style>
    .img-preview{
        width: 100%;
        max-height:145px;
        overflow: hidden;
    }
    .img-preview>img{
        height: 100%;        
    }
    #tree{
        width:auto;
        height:350px; 
        overflow-x:auto; 
        overflow-y:auto;
    }
    #tree>ul{
        padding-top:10px;
    }
    .weekDays-selector .weekday {
        display: none!important;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .weekDays-selector input[type=checkbox] + label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        min-width: 50px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .weekDays-selector input[type=checkbox]:checked + label {
        background: #26B99A;
        color: #ffffff;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
</style>
<div class="fade-in">
    <div class="card">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-left" style="max-height: calc(100vh - 9rem);
                overflow-y: auto;">
                    <ul class="list-group">
                        @foreach (\App\Models\SendToMd::orderBy('created','desc')->get() as $item)
                            <li class="list-group-item"><a href="{{$prefix}}/history-mail/{{$item->id}}">{{$item->name}}<br>{{$item->subject}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">   
                    
                
                <div class="card-body">
                    <div class="form-group">
                        <h5>Sender</h5>
                        <span class="form-control">{{$row->name}} <span class="badge badge-secondary" style="font-size: unset; font-weight: 500;">{{$row->company}} &lt;{{$row->email}}&gt;</span><span>
                        
                    </div>
                    <div class="form-group">
                        <h5>Receiver</h5>
                        <span class="form-control">{{$row->to}} </span>                            
                        {{-- <h5>Date : {{$row->created}}</h5> --}}            
                    </div>
                    <div class="form-group">
                        <h5>Subject</h5>
                        <span class="form-control">{{$row->subject}}</span>
                    </div>
                    <div class="form-group">
                        <h5>Contact Details</h5>
                        <textarea class="form-control" rows="9">{!!$row->content!!}</textarea>
                    </div>  
                    @if($row->attachment!='')
                        <a href="{{url($row->attachment)}}" target="_blank" ><span class="badge badge-primary" style="font-size: unset; font-weight: 500;"><i class="fas fa-paperclip"></i> Attachment</span></a>
                    @endif                                  
            
                    <div class="form-group">
                        <label>{{date('d-M-Y เวลา H:i:s',strtotime($row->created))}} ({{\App\Helpers\BaseHp::time_passed_backend($row->created)}})</label>
                    </div>

                </div>            
            </div>
        </div>              
    </div>         
</div>   