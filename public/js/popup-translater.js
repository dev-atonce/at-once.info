var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
  language : {
    placement :(d.isMobile())?'center':'left',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  speciality : {
    placement : 'center',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  status : {
    placement : (d.isMobile())?'center':'right',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  location : {
    placement : (d.isMobile())?'center':'left',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  }
};
var resetBtn = '.reset-all-filters';
$('input[name="language"]').on('change',function(){
    if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}
});
$('input[name="speciality"]').on('change',function(){
    if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}
});
$('input[name="status"]').on('change',function(){
    if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}
});

$('#language').hunterPopup({
    width : popUp.language.width,
    title : $('#language').attr('title'),
    content : $('#tableFirst'),
    placement : popUp.language.placement,
    resetBtn: resetBtn,
    event : function(){
        box = $('#language');
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
            box.removeClass(color);
        })
    }
})
$('#speciality').hunterPopup({
    width: popUp.speciality.width,
    title: $('#speciality').attr('title'),
    content: $('#tableSecond'),
    placement: popUp.speciality.placement,
    resetBtn: resetBtn,
    event:function(){
        box = $('#speciality');
        var second = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
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
})
$('#status').hunterPopup({
    width: popUp.status.width,
    title: $('#status').attr('title'),
    content: $('#tableThird'),
    placement: 'center',
    resetBtn: resetBtn,
    event:function(){
        box = $('#status');
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
            box.removeClass(color);
        })
    }
})
$('.reset-all-filters').click(function(){
    $('#keywords').val('');
})
checked()
$('#urgent').on('change',function(){
    if($(this).is(':checked')){
        $(this).parent().addClass(color);
    }else{
        $(this).parent().removeClass(color);
    }
});
$('#postpay').on('change',function(){
    if($(this).is(':checked')){
        $(this).parent().addClass(color);
    }else{
        $(this).parent().removeClass(color);
    }
});
$('#location').hunterPopup({
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableSixth'),
    placement: 'center',
    resetBtn: resetBtn,
    event:function(){
        box = $('#location');
        var sixth = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.sixth_').click(function(){ sixth = {id:[],text:[]}; adjust(box); });
        function adjust(box) {
            $('.sixth_:checked').each(function(){
                sixth.id.push($(this).val())
                sixth.text.push(' '+$(this).attr('text'))
            })
            box.html(sixth.text.join(', '));
            if(sixth.text.length>0){
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));   
            }
            box.next().val(sixth.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.sixth_:checked').prop('checked',false);
            box.html(box.attr('title'));
            box.removeClass(color);
        })
    }
})
$(document).on('click',resetBtn,function(){
    $('#urgent').prop('checked',false);
    $('#urgent').parent().removeClass(color);
    $('#postpay').prop('checked',false);
    $('#postpay').parent().removeClass(color);
})
function checked()
{
    /*===================================*/
    box = {first:$('#language'),second:$('#speciality'),third:$('#status'),fourth:$('#urgent'),fifth:$('#postpay'),sixth:$('#location')}
    text = {first:[],second:[],third:[],fourth:[],sixth:[]};    
    /*===================================*/
    $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); })
    $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); })
    $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
    $('#urgent:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
    $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
    $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
    // $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
    /*===================================*/
    if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
    if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
    if(text.third.length>0) box.third.addClass(color).html(text.third.join(', '));
    if(text.sixth.length>0) box.sixth.addClass(color).html(text.sixth.join(', '));
    // if(text.fourth.length>0) box.fourth.addClass(color).html(text.fourth.join(', '));
    // if(text.fifth.length>0) box.fifth.addClass(color).html(text.fifth.join(', '));
    // if(text.sixth.length>0) box.sixth.addClass(color).html(text.sixth.join(', '));
    /*===================================*/
    if(box.first.is(':checked')){ box.first.parent().addClass(color) }
    if(box.second.is(':checked')){ box.second.parent().addClass(color) }
    if(box.third.is(':checked')){ box.third.parent().addClass(color) }
    if(box.fourth.is(':checked')){ box.fourth.parent().addClass(color) }
    if(box.fifth.is(':checked')){ box.fifth.parent().addClass(color) }
    if(box.sixth.is(':checked')){ box.sixth.parent().addClass(color) }

}
