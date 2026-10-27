var noti = document.getElementsByClassName('notification'); 
var lang = $('html').attr('lang');
var messages = {
    selectLimit:{
        ['th']:'ท่านสามารถเลือกสูงสุด 10 บริษัท',
        ['en']:'You can select a maximum of 10 companies.'
    }
}
$(document).on('click','.comp-select',function(){ actionAd($(this)) });
$(document).on('click','.removeItem',function(){ removeItem($(this).parent()) });

function actionAd(el)
{
    var getS = JSON.parse(localStorage.getItem(industry));
    
    if (getS==null) {
        // console.log(industry)
        var saveMy = {
            company : $('input[name="company"]').val(),
            telephone : $('input[name="telephone"]').val(),
            position : $('input[name="position"]').val(),
            name : $('input[name="name"]').val(),
            email : $('input[name="email"]').val(),
            content : $('textarea[name="content"]').val(),            
            sendTo : {id:[el.val()], text:[el.data('text')]},
        };
        localStorage.setItem(industry,JSON.stringify(saveMy));
        fetchItem();
    }else{
        if(getS.sendTo.id.length<=9){
            if(el.is(':checked')){ 
                getS.sendTo.id.push(el.val());
                getS.sendTo.text.push(el.data('text'));
            }else{
                getS.sendTo.id.splice( $.inArray(el.val(), getS.sendTo.id), 1 );
                getS.sendTo.text.splice( $.inArray(el.data('text'), getS.sendTo.text), 1 );
            }
            localStorage.setItem(industry,JSON.stringify(getS));
            fetchItem();
        }else{
            alert(messages.selectLimit[lang]);
            el.prop('checked',false);
        }
    }
    if($('.company-contact').height()>=119){
            $('.company-contact').css({'max-height':'120px','overflow-y':'scroll','overflow-x':'hidden','margin-bottom':'10px'});
    }else{
        $('.company-contact').removeAttr('style');
    }
}

function fetchItem() {
        
    $('.company-contact').html('');
    let saveMy = JSON.parse(localStorage.getItem(industry));
    if (saveMy!=null) {
        
        $.each(saveMy.sendTo.id,function(k,v){
            let item = $('<div class="badge badge-light border border-default mr-1 position-relative"><span class="float-left badge-label"></span> <a class="fas fa-times fa-xs removeItem"></a></div>');
            item.find('span').html(saveMy.sendTo.text[k]+'&nbsp;');
            item.attr('tag',v);
            item.attr('text',saveMy.sendTo.text[k]);
            $('.company-contact').append(item);
        })
        $('.comp-select:not(:checked)').each(function(){
            cur = $(this);
            $.each(saveMy.sendTo.id,function(k1,v1){
              if(cur.val()==v1){ cur.prop('checked',true); }
            })
        })
        // var count = Number(noti.attr('data-count')) || 0;
        for (i=0;i<noti.length;i++) {
            noti[i].classList.add('show-count');
            noti[i].classList.add('show-count');
        }
        if (saveMy.sendTo.id.length>0) {
          
            for(i=0;i<noti.length;i++){
                noti[i].setAttribute('data-count', saveMy.sendTo.id.length);  
                noti[i].classList.remove('notify');              
                noti[i].offsetWidth = noti[i].offsetWidth;
                noti[i].classList.add('notify');
            }

          $('.chatbox').find('.alert_mail').removeAttr('style');
          $('.chatbox').find('.alert_mail').html(saveMy.sendTo.id.length)

        }else{
          $('.chatbox').find('.alert_mail').css('display','none');
            for(i=0;i<noti.length;i++){
                noti[i].classList.remove('show-count');
                noti[i].classList.remove('notify');
            }
        }
    }
    if($('.company-contact').height()>=119){
            $('.company-contact').css({'max-height':'120px','overflow-y':'scroll','overflow-x':'hidden','margin-bottom':'10px'});
    }else{
        $('.company-contact').removeAttr('style');
    }
}
function removeItem(el)
{
    saveMy = JSON.parse(localStorage.getItem(industry));
    saveMy.sendTo.id.splice( $.inArray(el.attr('tag'), saveMy.sendTo.id), 1 );
    saveMy.sendTo.text.splice( $.inArray(el.attr('text'), saveMy.sendTo.text), 1 );
    $('input[type="checkbox"][value="'+el.attr('tag')+'"]').prop('checked',false);
    localStorage.setItem(industry,JSON.stringify(saveMy));
    fetchItem();
}
function cleareStore(){
    localStorage.removeItem(industry);
    localStorage.clear();
}
function destroy(){
    localStorage.clear();
}