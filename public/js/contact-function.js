var noti = document.getElementsByClassName('notification');
var lang = $('html').attr('lang');
var messages = {
    selectLimit:{
        ['th'] : 'ท่านสามารถเลือกสูงสุด 10 บริษัท',
        ['en'] : 'You can select a maximum of 10 companies.'
    },
    dfplHolder:{
        ['th'] : 'เลือกบริษัทที่คุณต้องการติดต่อ',
        ['en'] : 'Select the company you want to contact'
    },
}
var dfHeight = 24, dfHiComList = 1130; //765
$(document).on('click','.comp-select',function(){ actionAd($(this)) });
$(document).on('click','.removeItem',function(){ removeItem($(this).parent()) });
fetchItem()
function actionAd(el)
{
    var getS = JSON.parse(localStorage.getItem(category));
    if (getS==null) {
        var saveMy = {
            company : $('input[name="company"]').val(),
            telephone : $('input[name="telephone"]').val(),
            position : $('input[name="department"]').val(),
            name : $('input[name="name"]').val(),
            email : $('input[name="email"]').val(),
            content : $('textarea[name="message"]').val(),
            sendTo : {id:[el.attr('tag')], text:[el.attr('text')]},
        };
        localStorage.setItem(category,JSON.stringify(saveMy));
    }else{
        if($('input[name="company"]').val() != '' ||
        $('input[name="telephone"]').val() != '' ||
        $('input[name="department"]').val() != '' ||
        $('input[name="name"]').val() != '' ||
        $('input[name="email"]').val() != '' ||
        $('textarea[name="message"]').val() != ''){
            getS.company = $('input[name="company"]').val()
            getS.telephone = $('input[name="telephone"]').val()
            getS.position = $('input[name="department"]').val()
            getS.name = $('input[name="name"]').val()
            getS.email = $('input[name="email"]').val()
            getS.content = $('textarea[name="message"]').val()
        }

        if (el.attr('type')=='checkbox'){
            if (el.is(':checked')) {
                getS.sendTo.id.push(el.attr('tag'));
                getS.sendTo.text.push(el.attr('text'));
                if (getS.sendTo.id.length>10){
                    alert(messages.selectLimit[lang]);
                    el.prop('checked',false);
                    getS.sendTo.id.splice( $.inArray(el.attr('tag'),getS.sendTo.id),1);
                    getS.sendTo.text.splice( $.inArray(el.attr('text'),getS.sendTo.text),1);
                }
            }else{
                getS.sendTo.id.splice( $.inArray(el.attr('tag'),getS.sendTo.id),1);
                getS.sendTo.text.splice( $.inArray(el.attr('text'),getS.sendTo.text),1);
            }
        }
        if (el.attr('href')){
            if (getS.sendTo.id.length>=10){
                alert(messages.selectLimit[lang]);
                getS.sendTo.id.splice( $.inArray(el.attr('tag'),getS.sendTo.id),1);
                getS.sendTo.text.splice( $.inArray(el.attr('text'),getS.sendTo.text),1);
                return false;
            }
            if ($.inArray(el.attr('tag'),getS.sendTo.id)<0) {
                getS.sendTo.id.push(el.attr('tag'));
                getS.sendTo.text.push(el.attr('text'));
            }
        }
        localStorage.setItem(category,JSON.stringify(getS));
    }

    fetchItem();
    if ($('.company-contact').height()>99) {
        $('.company-contact').css({'overflow-y':'scroll','max-height':'110px'});
        // $('.company-list').css({'max-height':($('.company-contact').height()-dfHeight)+dfHiComList})
    }
}

function fetchItem() {

    $('.company-contact').html('');
    const saveMy = JSON.parse(localStorage.getItem(category));

    if (saveMy!=null) {
        $('input[name="company"]').val(saveMy.company);
        $('input[name="telephone"]').val(saveMy.telephone);
        $('input[name="department"]').val(saveMy.position);
        $('input[name="name"]').val(saveMy.name);
        $('input[name="email"]').val(saveMy.email);
        $('textarea[name="message"]').val(saveMy.content);

        $.each(saveMy.sendTo.id,function(k,v){
            let item = $('<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:330px" class="badge badge-light border border-default mr-1 position-relative"><span class="float-left badge-label"></span> <a class="fas fa-times fa-xs removeItem"></a></div>');
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
    if(typeof saveMy == null){ $('.company-contact').html(messages.dfplHolder[lang]); }

    $('.company-contact').removeAttr('style');
    if ($('.company-contact').height()>dfHeight) $('.company-list').css({'max-height':$('.card-mail').height()-10})
    else $('.company-list').removeAttr('style');

    if ($('.company-contact').height()>99) $('.company-contact').css({'overflow-y':'scroll','max-height':'110px'}) ;
    else $('.company-contact').removeAttr('style');


}
function removeItem(el)
{
    // console.log(parseFloat(el.attr('tag')));
    // console.log($('.comp-selec[type="checkbox"][value="'+el.attr('tag')+'"]'))
    const saveMy = JSON.parse(localStorage.getItem(category));
    saveMy.sendTo.id.splice( $.inArray(el.attr('tag'), saveMy.sendTo.id), 1 );
    saveMy.sendTo.text.splice( $.inArray(el.attr('text'), saveMy.sendTo.text), 1 );
    $('.comp-select[type="checkbox"][value="'+el.attr('tag')+'"]').prop('checked',false);

    // $('.comp-select:checked').map(function(){ if(parseFloat($(this).val())==parseFloat(el.attr('tag'))) $(this).prop('checked',false); }) ;
    localStorage.setItem(category,JSON.stringify(saveMy));
    fetchItem();
}
function cleareStore(){
    localStorage.removeItem(category);
    localStorage.clear();
}
function destroy(){
    localStorage.clear();
}
