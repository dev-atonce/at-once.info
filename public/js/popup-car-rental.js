var d = $.fn.deviceDetector, width = $(window).width();
var popUp = {
  type : {
    placement : 'left',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  location : {
    placement : 'center',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  period : {
    placement : (d.isMobile())?'center':'right',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  other_condition : {
    placement : 'left',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  }
};


$('input[name="type"]').on('change',function(){if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}});
$('input[name="location"]').on('change',function(){if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}});
$('input[name="period"]').on('change',function(){if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}});
$('input[name="other-conditions"]').on('change',function(){if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}});
$('#type').hunterPopup({
    placement: popUp.type.placement,
    width: popUp.type.width,
    title: $('#type').attr('title'),
    content: $('#tableFirst'),
    resetBtn: '.reset-all-filters',
    event : function(){
        box = $('#type');
        var first = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.first_').click(function(){ first = {id:[],text:[]}; adjust(box); });
        function adjust() {
          $('.first_:checked').each(function(){
            first.id.push($(this).val())
            first.text.push(' '+$(this).attr('text'))
          })
          box.html(first.text.join(', '));
          if (first.text.length>0) {
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
            box.removeClass(color)
        })    
    }
})
$('#location').hunterPopup({
    placement : popUp.location.placement,
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableSecond'),
    resetBtn: '.reset-all-filters',
    event : function(){
        box = $('#location');
        var second = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
          }
        $('.second_').click(function(){ second = {id:[],text:[]}; adjust(box); })
        function adjust() {
          $('.second_:checked').each(function(){
            second.id.push($(this).val())
            second.text.push(' '+$(this).attr('text'))
          })
          box.html(second.text.join(', '));
          if (second.text.length>0) {
              box.addClass(color);
          }else{
              box.removeClass(color);
              box.html(box.attr('title'));                    
          }
          box.next().val(second.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'));
            box.next().val('');
            $('.second_:checked').prop('checked',false);
            box.removeClass(color);
        }) 
    }
});

$('#period').hunterPopup({
    placement : popUp.period.placement,
    width: popUp.period.width,
    title: $('#period').attr('title'),
    content: $('#tableThird'),
    resetBtn: '.reset-all-filters',
    event:function(){
        box = $('#period');
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        var third = {id:[],text:[]};
        $('.third_').click(function(){ third = {id:[],text:[]}; adjust(box); })
        function adjust() {
            $('.third_:checked').each(function(){
              third.id.push($(this).val())
              third.text.push(' '+$(this).attr('text'))
            })
            box.html(third.text.join(', '));
            if (third.text.length>0) {
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));                    
            }
            box.next().val(third.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'));
            box.next().val('');
            $('.third_:checked').prop('checked',false);
            box.removeClass(color);
        }) 
    }
});

$('#other-conditions').hunterPopup({
    placement: popUp.other_condition.placement,
    width: popUp.other_condition.width,
    title: $('#other-conditions').attr('title'),
    content: $('#tableFourth'),
    resetBtn: '.reset-all-filters',
    event : function(){
        box = $('#other-conditions');
        const offset = $('#other-conditions').offset();
        var fourth = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.fourth_').click(function(e){ fourth = {id:[],text:[]}; adjust(box) })
        function adjust(box) {
            $('.fourth_:checked').each(function(){
              fourth.id.push($(this).val())
              fourth.text.push($(this).attr('text'))
            })
            $('#other-conditions').html(fourth.text.join(', '));
            if (fourth.text.length>0) {
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));                    
            }
            box.next().val(fourth.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.fourth_').prop('checked',false);
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
    box = {first:$('#type'),second:$('#location'),third:$('#period'),fourth:$('#other-conditions'),fifth:$('#fifth'),sixth:$('#sixth')}
    text = {first:[],second:[],third:[],fourth:[],fifth:[],sixth:[]};    
    /*===================================*/
    $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); })
    $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); })
    $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
    $('.fourth_:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
    $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
    $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
    /*===================================*/
    if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
    if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
    if(text.third.length>0) box.third.addClass(color).html(text.third.join(', '));
    if(text.fourth.length>0) box.fourth.addClass(color).html(text.fourth.join(', '));
    if(text.fifth.length>0) box.fifth.addClass(color).html(text.fifth.join(', '));
    if(text.sixth.length>0) box.sixth.addClass(color).html(text.sixth.join(', '));
    /*===================================*/
    if(box.first.is(':checked')){ box.first.parent().addClass(color) }
    if(box.second.is(':checked')){ box.second.parent().addClass(color) }
    if(box.third.is(':checked')){ box.third.parent().addClass(color) }
    if(box.fourth.is(':checked')){ box.fourth.parent().addClass(color) }
    if(box.fifth.is(':checked')){ box.fifth.parent().addClass(color) }
}
