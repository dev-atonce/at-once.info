<style>
    .radius-50{
        border-radius: 50%
    }
    .card-body{
        padding: 10px !important;
    }
    .btn-square{
        width:35px;
        height:35px;
    }
    .btn-square > i{
        height: 100%;
        width: 100%;
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: center;
    }
    .btn-dropdown::after{
        content: unset !important;
        
    }
</style>
{{-- <div class="card">
    <div class="card-body">
        <div class="tools">
            <h6 style="display:initial; margin:0; padding:0; width:auto;">Record: {{$rows->count()}}</h6>
            <div class="float-right">
                <button class="btn btn-primary btn-square radius-50 dropdown-toggle btn-dropdown" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                <button class="btn btn-primary btn-square radius-50"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
</div> --}}
@if($rows->count()>0)
<div class="row">
    @foreach($rows as $k => $v)
    <div class="col-lg-4 col-xs-6 col-md-4">
        <div class="card">  
            <div class="card-body">
                <div class="float-left">
                    <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                        <input class="c-switch-input status" type="checkbox" data-id="{{$v->id}}" @if($v->public==1) checked @endif><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
                <div class="float-right mb-2">
                    <button class="btn btn-primary btn-square radius-50 edit" data-id="{{$v->id}}" src="{{$v->image}}" title="Edit"><i class="fas fa-edit"></i></button>
                    {{-- <button class="btn btn-primary btn-square radius-50 trash" data-id="{{$v->id}}" title="Delete"><i class="fas fa-trash"></i></button> --}}
                </div>
                <div style="">
                    <img src="{{$v->image}}" style="max-width:calc(100%); border-radius:5px;">
                </div>
                <small><strong>Created:</strong> {{$v->created}}</small>
                <small><strong>By</strong> {{$v->created_by}}</small>                        
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div style="height: calc(100vh - 220px);">
    <h5 
        class="text-center"
        style="color:#9d9d9d; height: 100%; display: flex; align-content: center; justify-content: center; align-items: center;"
    >No data.</h5>
</div>
@endif
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Edit Form
            </div>
            <div class="modal-body">
                <form class="formUpdate">
                    <div class="">
                        <img src="" class="img-thumbnail mb-3">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning btn-block upload" disabled>Upload</button>
                <button class="btn btn-block cancel m-0" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
  </div>
<script src="js/b64toBlob.js"></script>
<script>
    function upload(args,url){
            let result;
            try {
            result = $.ajax({
                url: url,
                type: 'POST',
                data: args,
                contentType:false,
                processData:false,
                cache:false,
                async:false
            }).responseJSON;

            return result;
        } catch (error) {
            console.error(error);
        }

    }
    const spinner = $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    $(document).on('click','.edit',function(){
        const editLocation = $(this);
        const cpID = $(this).attr('data-id');
        const image = $(this).attr('src');
        const thumbnail = $('.bd-example-modal-lg').find('.img-thumbnail');
        thumbnail.attr('src',image);
        $('.bd-example-modal-lg').modal('show');
        $('#inputGroupFile01').on('change',function(){
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    thumbnail.attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
                $('.upload').removeAttr('disabled');
            }
        })
        $(document).on('click','.upload',function(){
            $(this).attr('disabled','disabled');
            $('.cancel').attr('disabled','disabled');
            $(this).html('');
            $(this).append(spinner);
            $(this).append(' Loading...');
            const find = thumbnail.attr('src'),
                block = find.split(";"),
                contentType = block[0].split(":")[1],
                realData = block[1].split(",")[1],
                blob = b64toBlob(realData, contentType);
            var fd = new FormData();  
            fd.append("_method",'post');
            fd.append("image",blob);
            fd.append("_id",cpID);
            const upl = upload(fd, window.location.href);
            if(upl.status==200){
                editLocation.closest('.card-body').find('img').attr('src',upl.url);
                editLocation.attr('src',upl.url)
                thumbnail.attr('src',upl.url);
                $('.upload').html('');
                $('.upload').html('Upload');
                $('.upload').attr('disabled','disabled');
                $('.bd-example-modal-lg').modal('hide');
                $('label[for="inputGroupFile01"]').html('');                
                $('.cancel').removeAttr('disabled');
            }
            if(upl.status==401){
                $('.upload').html('');
                $('.upload').html('Upload');
                $('<div class="alert alert-danger" role="alert">'+upl.status+'</div>').insertAfter($('.formUpdate'))
            }
        });
    });
    $(document).on('click', '.trash', function(){
        const id = $(this).attr('data-id');
    })
    $(document).on('change','.status',function(){
        const id = $(this).attr('data-id');
        $.ajax({
            url: window.location.href+'/status',
            data:{id:id},
            success:function(res){
                console.log(res)
            },
            error:function(){
                if($(this).is(':checked')){
                    $(this).prop('checked',false)
                }else{
                    $(this).prop('checked',true)
                }
            }
        })
    });
</script>