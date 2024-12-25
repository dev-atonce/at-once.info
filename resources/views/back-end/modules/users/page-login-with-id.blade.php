<div class="row">    
    @foreach(\App\Models\UsersMd::where('status','active')->get() as $k => $v)
    <div class="col-lg-2">
        <div class="card users" data-id="{{$v->id}}">
            <div class="card-body" style="border-radius: 1.35rem">
                <h5 class="font-weight-bold">{{$v->name}}</h5>
                <a class="badge @if($v->status=='active') badge-success @else badge-secondary @endif" href="javascript:">{{$v->status}}</a>
                <a href="javascript:" class="float-right"><i class="fas fa-sign-in-alt"></i></a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).on('click','.users',function(){
        const id = $(this).attr('data-id');
        // $(this).addClass('bg-primary');
        // $('.users').not(this).removeClass('bg-primary');
        console.log(id);
        $.ajax({
            method:'post',
            url:'webpanel/users/login-with-id',
            data:{
                _token: '{{csrf_token()}}',
                id: id,
            },
            success:(res) =>{ console.log(res); }
        })
        .catch((err) => {
            console.log(err.responseText);
        })
    });
</script>