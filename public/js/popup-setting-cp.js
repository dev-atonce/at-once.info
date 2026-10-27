var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
    location : {
        placement :(d.isMobile())?'center':'left',
        width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
    consulting : {
        placement : 'center',
        width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
    service : {
        placement : (d.isMobile())?'center':'right',
        width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    }         
};
var industry = window.location.pathname.split('/')[2];
let color = '';
switch (industry) {
    case 'logistic':      color = '--orange';   break;
    case 'solar-cell':    color = '--sky-blue'; break;
    case 'translater':    color = '--pink';     break;
    case 'auto-leasing':  color = '--gold';     break;
    case 'visa-support':  color = '--green';    break;
    case 'setting-cp':    color = '--indigo';   break;
    default: break;
}
$('#location').hunterPopup({
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableFirst'),
    placement: popUp.location.placement,
    event:function(){
        box = $('#location');
        var first = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.first_').click(function(){ first = {id:[],text:[]}; adjust(box); });
        function adjust(box) {
            $('.first_:checked').each(function(){
                first.id.push($(this).val())
                first.text.push(' '+$(this).attr('text'))
            })
            box.html(first.text.join(', '));
            if(first.text.length>0){
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));   
            }
            box.next().val(first.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.first_:checked').prop('checked',false);
            box.html(box.attr('title'));
        })
    }
})
$('#consulting').hunterPopup({
    width: popUp.consulting.width,
    title: $('#consulting').attr('title'),
    content: $('#tableConsulting'),
    placement: popUp.consulting.placement,
    event:function(){
        box = $('#consulting');
        var one = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.secondary_').click(function(){ one = {id:[],text:[]}; adjust(box); });
        function adjust(box) {
            $('.secondary_:checked').each(function(){
                one.id.push($(this).val())
                one.text.push(' '+$(this).attr('text'))
            })
            box.html(one.text.join(', '));
            if(one.text.length>0){
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));   
            }
            box.next().val(one.id);
        }
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.secondary_:checked').prop('checked',false);
            box.html(box.attr('title'));
        })
    }
})
$('#service').hunterPopup({
    width: popUp.service.width,
    title: $('#service').attr('title'),
    content: $('#tableThird'),
    placement: popUp.service.placement,
    event:function(){
        box = $('#service');
        var third = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.third_').click(function(){ third = {id:[],text:[]}; adjust(box); });
        function adjust(box) {
            $('.third_:checked').each(function(){
                third.id.push($(this).val())
                third.text.push(' '+$(this).attr('text'))
            })
            box.html(third.text.join(', '));
            if(third.text.length>0){
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));   
            }
            box.next().val(third.id);
        }
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.third_:checked').prop('checked',false);
            box.html(box.attr('title'));
        })
    }
})
checked()
function checked()
{
    text = { one:[],two:[],three:[],four:[],five:[],six:[]};
    $('.two_:checked').each(function(i,v){ text.two.push($(this).attr('text')); })

    // $('#inland').html(text.one);
    if(text.two.length>0) $('#international').html(text.two.join(', '));
    $('#select-all').on('click',function(){
        if($(this).is(':checked')){
        $('.comp').prop('checked',true);
        $('.total-select').html($('.comp:checked').length);
        }else{ 
        $('.comp').prop('checked',false);
        $('.total-select').html(0);
        }
    });
}
