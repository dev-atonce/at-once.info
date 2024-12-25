<style>
    .btn-radius-50{
        border-radius: 50%
    }
    .btn-square-40{
        height: 40px;
        width: 40px;
    }
</style>
@csrf
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="row">
                    <div class="col-12 position-relative">
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Keyword" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </div>
                            <a 
                                href="{{$prefix}}/{{$module}}/create" 
                                class="btn btn-primary btn-radius-50 btn-square-40 float-right" 
                                style="position:absolute;right:15px;border-radius:50%;"
                            >
                                <i class="fas fa-plus" style="margin:0 auto;"></i>
                            </a>  
                        </form>  
                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(@$rows->count()>0)
        <div class="col-12">
            <div class="card">
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        @foreach($rows as $key => $row)
                        <li class="list-group-item">
                            <img src="{{$row->logo}}" class="img-thumbnail" style="width:50px; border-radius:50%;">
                            {{$row->name_th}}
                            <div class="float-right">
                                <label class="c-switch c-switch-label c-switch-pill c-switch-success" style="margin: unset !important; padding: unset !important; vertical-align: middle; height: 26px !important;">
                                    <input class="c-switch-input status" type="checkbox" data-id="{{$row->id}}" @if($row->status==true) checked @endif><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                </label>
                                <a href="{{$prefix}}/{{$module}}/edit/{{$row->id}}" class="badge badge-warning p-2" srt><i class="fas fa-pen"></i> Edit</a>
                                <a href="javascript:#{{$row->id}}" data-id="{{$row->id}}" class="badge badge-danger delete p-2"><i class="fas fa-trash" ></i> Delete</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="col-12 text-center"><h6>No Data.</h6></div>
    @endif
</div>
<script src="js/axios.min.js"></script>
<script>
    $('.delete').on('click',function(){
        let id = $(this).attr('data-id');
        deleted(id);
    })
    function deleted(id){
 
        Swal.fire({
            title:"Delete data",text:"Do you want to delete the data?",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch('webpanel/our-customer/delete/'+id)
                .then(response => response.json())
                .then(data => location.reload())
                .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
            }
        });
    }
    $(document).on('change','.status',function(){
        let id = $(this).attr('data-id');
        axios({
            method:'get',
            url:'webpanel/our-customer/status/'+id
        })
        .then(res => console.log(res.data))
        .catch(error => console.log(error));
    })
</script>