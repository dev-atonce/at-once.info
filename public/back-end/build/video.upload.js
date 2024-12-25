(function() {
    var vUrl = window.location.pathname;
    var vUrlSegment = vUrl.split('/');
    var prefix = vUrlSegment[1];
    var vModule = vUrlSegment[2];
    var cpID = vUrlSegment[4];
    var modal = $('#VideoUpload');
    var righCol = $('.v-col.col-lg-6');
    // var industryId = vModule[];
    uploadZoneBtn = document.getElementById('uploadZoneBtn');
    uploadBack = document.getElementById('uploadBack');
    UploadZone = document.getElementById('vUploadZone');
    uploadBtn = document.getElementById('vUpload');
    ViewBtn = document.getElementsByClassName('view-group');
    ExplorerZone = document.getElementById('vExplorerZone');
    inputUpload = document.querySelectorAll('[name="v_upload"]')[0];
    actionBtn = document.getElementsByClassName('v-action');
    selectVideo = document.getElementsByClassName('select-video');
    
    selectVideo[0].addEventListener('click',function(){
        
        modal.modal('show');
        myFolder()
    })
    videoPreview = document.getElementById('vPreview');

    chooseFile = $(UploadZone).find('.choose').clone();
    vView = document.querySelectorAll('.v-view');

    for(i=0; i<vView.length; i++){
        vView[i].addEventListener('click',function(){
            let cur = this;
            let viewClass = cur.classList.contains('column')
            if (viewClass===true) { cur.classList.add('active'); view(6); }
            else { 
                view(12); 
                videoPreview.pause();
                $(videoPreview).removeAttr('src').css('display','none');
            }
        })
    }
    // vItem = document.querySelectorAll('.item');
    // for(i=0; i<vItem.length; i++){
    //     vItem[i].addEventListener('click',function(){
    //         clickItem(this)
    //     })
    // }
    $(document).on('click','.item',function(){clickItem(this)});
    uploadZoneBtn.addEventListener('click',function(){
        this.style.display='none';
        ExplorerZone.style.display='none';
        UploadZone.style.display='block';
        ViewBtn[0].style.display='none';
        uploadBack.style.display='block';
        // console.log(ViewBtn)
    })
    uploadBack.addEventListener('click',function(){
        this.style.display='none';
        UploadZone.style.display='none';
        uploadZoneBtn.style.display='block';
        ExplorerZone.style.display = 'block';
        ViewBtn[0].style.display='block';
        
    })
    $(UploadZone).find('.v-btn-choose').click(function(){
        $(this).children()[0].click();
    })
    $(document).on('click','.v-remove',function(){
        $(this).closest('.row').remove();
        $('input[name="v_upload"]').val('');
        $('.vContentUpload').append(chooseFile);
    })
    
    uploadBtn.addEventListener('click',function(){
        var videos = document.querySelectorAll('.v-src');
        for(i=0; i<videos.length; i++){
            var curr = $(videos[i]);
            progress = curr.parent().find('.progress-bar');
            var fd = new FormData();                    
            fd.append("_method",'PUT');
            $.each($('input[name="v_upload"]')[0].files, function(i, file) {
                fd.append('videos['+i+']', file);
            });
            fd.append("_id",cpID);

            $.ajax({
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.ceil((evt.loaded / evt.total) * 100);
                            progress.css('width',percentComplete+'%');
                            progress.html(percentComplete+'%');
                        }
                    }, false);
                    return xhr;
                },
                method : 'post',
                url: prefix+'/'+vModule+'/upload/profile-videos',
                contentType:false,
                processData:false,
                cache:false,
                data: fd,
                success:function(res){
                    if(res.length>0){ 
                        console.log(curr);
                        progress.html('Uploaded').removeClass('bg-danger').addClass('bg-success');
                        setTimeout(function(){curr.closest('.row').remove()},1000);
                        $('.vContentUpload').append(chooseFile);
                        myFolder();
                        $(uploadBack)[0].click();
                    }
                    
                    
                },
                error:function(){
                    curr.next().find('.progress-bar').html('Failed').addClass('bg-danger');
                },
                // complete:function(){ curr.next().find('.progress-bar').html('Uploaded.'); }
            });

        }
    });
    
    
    
    
    function view(el){
        var vCol = document.querySelectorAll('.v-col');
        if(el==6){
            for(i=0; i<vCol.length; i++){
                vCol[i].classList.remove('col-lg-12');
                vCol[i].classList.add('col-lg-6');
            }
        }else{
            for(i=0; i<vCol.length; i++){
                vCol[i].classList.add('col-lg-12');
                vCol[i].classList.remove('col-lg-6');
            }
        }
    }
    function clickItem(e){
        var selected = '';
        var item = document.querySelectorAll('.item');
        for(i=0; i<item.length; i++){
            item[i].classList.remove('active');
        }
        e.classList.add('active');
        selected = e.textContent;
        $(ExplorerZone).find('.v-footer').find('span').find('span').html(selected);
    }
    vCol = document.querySelectorAll('.v-col');

    function myFolder()
    {
        $(ExplorerZone).find('.list-item').html('');
        $.ajax({
            url : prefix+'/'+vModule+'/profile-videos?cp='+cpID,
            success: function (data) {
                $.each(data,function(i, val) {
                    let arr = val.split('/');
                    let file = { 
                        path : arr[0]+"/"+arr[1]+"/"+arr[2],
                        name : arr[3],
                        fullPath : val
                    };
                    $(ExplorerZone).find('.list-item').append('<span class="item" data-src="'+file.fullPath+'">'+file.name+'</span>');
                });
            }
        });
    }
  
    $(document).on('click','.item',function(){
        let c = $(this), src = c.attr('data-src');
        if($('.column').hasClass('active')){
            $(ExplorerZone).find('video').attr('src', window.location.origin+'/'+src).css({'display':'block','margin-top':'15px'});
        }
    });
    $(document).on('click','.v-select',function(){
        let path = $('.item.active').attr('data-src');
        modal.modal('hide');
        $('input[name="video_profile"]').val(path);
    })
    
})();
$(document).on('change','input[name="v_upload"]',function(){

    let row = $('<div class="row px-3"></div>');   
    for(i=0; i<this.files.length; i++){    
        $('.vContentUpload').html('');
        let file = this.files[i];
        let thumbanil = $('<div class="col-lg-12 p-2 v-item-upload"><div class="rounded" style="border-bottom:1px solid #dedede; display:block;"><div class="p-2 flex"><div class="float-left rounded-left"><i class="far fa-file-video fa-3x ml-2"></i></div><div class="v-details"><div class="mt-2 v-progress progress"><div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div></div><div class="v-action"><button class="v-remove btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></div></div></div></div>');
        var reader = new FileReader();
            reader.readAsDataURL(file);
        let name = file.name;
    
        thumbanil.find('.v-details').prepend('<div class="im-name text-left"><span alt="'+name+'"><strong>File name: </strong>'+name+'</span><br><span><strong>Type: </strong>'+file.type+'</span></div>');
        reader.onload = function(e) {
            // let image = new Image();
            // image.src = e.target.result;
            let item = $('<img class="v-src" style="display:none;">');
            thumbanil.find('.v-details').append(item);
        }
        row.append(thumbanil);
        $(UploadZone).find('.vContentUpload').append(row);
        reader=null;
    };
})
