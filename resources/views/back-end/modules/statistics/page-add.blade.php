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
  @php
        $day = DB::table('working_hours')->select('id','name_th')->get();
  @endphp
<div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">   
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href='{{url("$prefix$segment")}}'>Blog</a></span>
                            <span class="breadcrumb-item active">Edit Form</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                    @php
                        $category = \App\Models\CategoryMd::orderBy('name_th')->get()
                    @endphp
                    <form id="" method="post" action="{{url("$prefix$segment/insert")}}" enctype="multipart/form-data"> 
                        @csrf
                        {{-- Card --}}
                        <div class="card border-light">
                            <div class="card-header bg-light">
                            </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="img/no_image.webp" class="card-img" alt="" id="preview">
                                            <div class="mt-4">
                                                <input type="file" name="image" id="image">
                                            </div>
                                            <div class="mt-4">
                                                <label>Url:</label>
                                                <input type="text" id="urlTH" class="form-control name" data-target="urlTH" name="urlTH" value="" required>
                                            </div>
                                            {{-- <div class="mt-4">
                                                <label>Url JP:</label>
                                                <input type="text" id="urlJP" class="form-control name" data-target="urlJP" name="urlJP" value="" required>
                                            </div> --}}
                                            <div class="mt-4">
                                                <label>Type:</label>
                                                <select name="category" class="form-control" required>
                                                    <option value="">กรุณาเลือก</option>
                                                    @if(!empty($category))
                                                        @foreach($category as $ki => $vi)
                                                        <option value="{{$vi->id}}">{{$vi->name_th}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mt-4">
                                                <label>Language:</label>
                                                <select name="language" class="form-control" required>
                                                    <option value="">กรุณาเลือก</option>
                                                    <option value="1">Thai</option>
                                                    <option value="2">Japan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row mt-12">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>ชื่อบทความ</label>
                                                        <input type="text" name="name_th"  value="" data-target="urlTH" class="form-control name" required>
                                                    </div>
                                                </div> 
                                                {{-- <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>ชื่อบทความ (JP)</label>
                                                        <input type="text" name="name_jp"  value="" data-target="urlJP" class="form-control name" required>
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <div class="row">
                                                {{-- <div class="col-lg-12">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link active" id="TH1-tab" data-toggle="tab" href="#TH1" role="tab" aria-controls="TH1" aria-selected="true">TH</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link" id="JP1-tab" data-toggle="tab" href="#JP1" role="tab" aria-controls="JP1" aria-selected="false">JP</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="TH1" role="tabpanel" aria-labelledby="TH1-tab">
                                                            <div class="form-group">
                                                                <label>รายละเอียดย่อ (TH)</label>
                                                                <textarea class="form-control tiny1" rows="5" name="description_th"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="JP1" role="tabpanel" aria-labelledby="JP1-tab">
                                                            <div class="form-group">
                                                                <label>รายละเอียดย่อ (JP)</label>
                                                                <textarea class="form-control tiny1" rows="5" name="description_jp"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link active" id="TH2-tab" data-toggle="tab" href="#TH2" role="tab" aria-controls="TH2" aria-selected="true">TH</a>
                                                        </li>
                                                        {{-- <li class="nav-item" role="presentation">
                                                          <a class="nav-link" id="JP2-tab" data-toggle="tab" href="#JP2" role="tab" aria-controls="JP2" aria-selected="false">JP</a>
                                                        </li> --}}
                                                    </ul>
                                                    <div class="tab-content" id="myTab2Content">
                                                        <div class="tab-pane fade show active" id="TH2" role="tabpanel" aria-labelledby="TH2-tab">
                                                            <div class="form-group">
                                                                <label>รายละเอียดเต็ม</label>
                                                                <textarea class="form-control tiny" rows="5" name="detail_th"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show" id="JP2" role="tabpanel" aria-labelledby="JP2-tab">
                                                            {{-- <div class="form-group">
                                                                <label>รายละเอียดเต็ม (JP)</label>
                                                                <textarea class="form-control tiny" rows="5" name="detail_jp"></textarea>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr/>
                                            {{-- <div class="row">
                                                <div class="col-lg-12">
                                                    <h4>แกลเลอรี่</h4>
                                                </div>
                                            </div>
                                            <div class="row" id="gallery_preview">
                                     
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" name="gallery[]" id="gallery" onchange="readGallery('gallery',this)">
                                                </div>
                                            </div>
                                            <hr/> --}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Tag:</label>
                                                    <input type="text" class="form-control" name="tag" id="tokenfield"  />
                                                    @php
                                                        $get_tag = DB::table('tag')->select('tag')->get();
                                                        $count_tag = count($get_tag);
                                                        $tag_array = "";
                                                        foreach($get_tag as $k => $value){
                                                            $comma = ($k!=($count_tag-1))?($count_tag>1)?',':'':'';
                                                            $tag_array .= $value->tag.$comma;
                                                        }
                                                    @endphp
                                                    <input type="hidden" class="form-control" id="autocomplete" value="{{$tag_array}}"  />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h4>SEO</h4>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Keyword :</label>
                                                    <input type="text" name="seo_keyword" class="form-control">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Description :</label>
                                                    <textarea name="seo_description" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row text-right">
                                                <div class="col-lg-12">
                                                    <div id="areaAlert"></div>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="card-footer text-muted bg-light">
                                </div>
                            </div>
                        </form>
                                      
                        </div>
                </div>            
            </div>
        </div>              
    </div>         

<script>
        $("#image").on('change',function(){
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);

                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
            }
        });

        $('#gallery').filer({ limit: '5' });

    tinymce.init({
		selector: 'textarea.tiny1',
		menubar : false,
		force_br_newlines : true,
        force_p_newlines : false,
        height: 200, 
        plugins: ["code textcolor"],    
        toolbar: 'undo redo code bold italic forecolor backcolor',
        formats: {
            h1: { block: 'h1', classes: 'heading' }
        },
    });
    tinymce.init({
		selector: 'textarea.tiny',
		menubar : false,
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : '',
		height: 400, 
        //width : 1100,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
        toolbar: 'insertfile undo redo | table | styleselect fontselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',
        
    });

    function readGallery(input,id)
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e)
            {
                $("#"+id).css("display", "block").prop("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readGallery(input,id) 
    {
        var total_file=document.getElementById("gallery").files.length;
        var stringRand = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        $('.gal_add').remove();
        for(var i=0;i<total_file;i++)
        {
            var html = '<div class="col-lg-4 gal_add_'+'" id="gal_add_'+stringRand+'" >\
                               <img class="img-thumbnail" src="'+URL.createObjectURL(event.target.files[i])+'">\
                        </div>';
            $('#gallery_preview').append(html);
        }
    }
    function removeGalleryData(id){
        Swal.fire({
        title: 'ต้องการลบใช่หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่ !'
        }).then((result) => {
            if (result.isConfirmed) {
                OpenLoading();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type:'post',
                    url:'{{url($prefix.$segment."/deleteItemGallery")}}',
                    data: {id:id,_token:token},
                        success: function (data) {
                                CloseLoading();
                                Swal.fire(
                                    'สำเร็จ !',
                                    'ลบรายการออกแล้ว',
                                    'success'
                                ).then((result)=>{
                                    $('#gal_'+id).slideUp("slow", function() { $(this).remove(); } );
                                })
                        },
                        error: function() {
                            CloseLoading();
                            Swal.fire(
                                'Error!',
                                'มีบางอย่างผิดพลาด !',
                                'error'
                            )
                        }
                });
            }
        })
    }

    var autoCom = $('#autocomplete').val();
    var autoCom = autoCom.split(',')
    $('#tokenfield').tokenfield({
        autocomplete: {
            source: autoCom,
            delay: 100
        },
        showAutocompleteOnFocus: true
    })
    $('.name').blur(function(){
        var str = $(this).val();
        var target = $(this).data('target');
        replaceUrl(str,target);
    });
    function replaceUrl(str,target){
        str = str.replace(/ |\(|\^|%|&|\*|\)|\+|\=|\[|]|{|}|:|;|\'|\'|,|<|>|@|!|\$|\?/g,"-");
        $('#'+target).val(str);
    }

</script>      