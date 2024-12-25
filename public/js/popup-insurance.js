var category = window.location.pathname.split('/')[2];
var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
    personal : {
        placement : (d.isMobile())?'center':'left',
        width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
    business : {
        placement : 'center',
        width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    }
    ,
    location : {
        placement : (d.isMobile())?'center':'right',
        width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    }
};
$('#personal').hunterPopup({
    width: popUp.personal.width,
    title: $('#personal').attr('title'),
    content: $('#tableFirst'),
    placement: popUp.personal.placement,
    resetBtn: '.reset-all-filters',
    event:function(){
        box = $('#personal');
        var first = {id:[],text:[]};
        if (!d.isMobile()) { $('.Hunter-pop-up').css({'left':$('.container').offset().left+20,'right':($('.container').offset().left+20)});  }
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
            box.next().val('');
            $('.first_:checked').prop('checked',false);
            box.html(box.attr('title'));
            box.removeClass(color);
        })
    }
});
$('#business').hunterPopup({
    width: popUp.business.width,
    title: $('#business').attr('title'),
    content: $('#tableSecond'),
    placement: popUp.business.placement,
    resetBtn: '.reset-all-filters',
    event:function(){
        box = $('#business');
        var second = {id:[],text:[]};
        if (!d.isMobile()) { 
            $('.Hunter-pop-up').css({
                'left':$('.container').offset().left+20,
                'right':$('.container').offset().left+20
            });  
        }
        $('.second_').click(function(){ second = {id:[],text:[]}; adjust(box); });
        function adjust(box) {
            $('.second_:checked').each(function(){
                second.id.push($(this).val())
                second.text.push(' '+$(this).attr('text'))
            })
            box.html(second.text.join(', '));
            if(second.text.length>0){
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));   
            }
            box.next().val(second.id);
        }
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.second_:checked').prop('checked',false);
            box.html(box.attr('title'));
            box.removeClass(color);
        })
    }
});
$('#location').hunterPopup({
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableThird'),
    placement: popUp.location.placement,
    resetBtn: '.reset-all-filters',
    event:function(){
        box = $('#location');
        var third = {id:[],text:[]};
        if (!d.isMobile()) { 
            $('.Hunter-pop-up').css({
                'left':$('.container').offset().left+20,
                'right':$('.container').offset().left+20
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
            box.removeClass(color);
        })
    }
});
$('.reset-all-filters').click(function(){
    $('#keywords').val('');
})
checked()
function checked()
{
    /*===================================*/
    box = {first:$('#personal'),second:$('#business'),third:$('#location')}
    text = {first:[],second:[],third:[]};    
    /*===================================*/
    $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); })
    $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); })
    $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
    // $('.fourth_:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
    // $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
    // $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
    /*===================================*/
    if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
    if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
    if(text.third.length>0) box.third.addClass(color).html(text.third.join(', '));
    // if(text.fourth.length>0) box.fourth.addClass(color).html(text.fourth.join(', '));
    // if(text.fifth.length>0) box.fifth.addClass(color).html(text.fifth.join(', '));
    // if(text.sixth.length>0) box.sixth.addClass(color).html(text.sixth.join(', '));

}