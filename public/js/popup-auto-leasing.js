var d = $.fn.deviceDetector, width = $(window).width();
var industry = window.location.pathname.split('/')[2];
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


$('input[name="domestic"]').on('change',function(){if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}});
$('#type').hunterPopup({
    placement: popUp.type.placement,
    width: popUp.type.width,
    title: $('#type').attr('title'),
    content: $('#tableType'),
    event : function(){
        box = $('#type');
        var one = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
          }
        $('.one_').click(function(){ one = {id:[],text:[]}; adjust(box); });
        function adjust() {
          $('.one_:checked').each(function(){
            one.id.push($(this).val())
            one.text.push(' '+$(this).attr('text'))
          })
          box.html(one.text.join(', '));
          if (one.text.length>0) {
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
            $('.one_:checked').prop('checked',false);
            box.removeClass(color)
        })    
    }
})
$('#location').hunterPopup({
    placement : popUp.location.placement,
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableLocation'),
    event : function(){
        box = $('#location');
        var two = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
          }
        $('.two_').click(function(){ two = {id:[],text:[]}; adjust(box); })
        function adjust() {
          $('.two_:checked').each(function(){
            two.id.push($(this).val())
            two.text.push(' '+$(this).attr('text'))
          })
          box.html(two.text.join(', '));
          if (two.text.length>0) {
              box.addClass(color);
          }else{
              box.removeClass(color);
              box.html(box.attr('title'));                    
          }
          box.next().val(two.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'));
            box.next().val('');
            $('.two_:checked').prop('checked',false);
            box.removeClass(color);
        }) 
    }
});

$('#period').hunterPopup({
    placement : popUp.period.placement,
    width: popUp.period.width,
    title: $('#period').attr('title'),
    content: $('#tablePeriod'),
    event:function(){
        box = $('#period');
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        var three = {id:[],text:[]};
        $('.three_').click(function(){ three = {id:[],text:[]}; adjust(box); })
        function adjust() {
            $('.three_:checked').each(function(){
              three.id.push($(this).val())
              three.text.push(' '+$(this).attr('text'))
            })
            box.html(three.text.join(', '));
            if (three.text.length>0) {
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));                    
            }
            box.next().val(three.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'));
            box.next().val('');
            $('.three_:checked').prop('checked',false);
            box.removeClass(color);
        }) 
    }
});

$('#other-conditions').hunterPopup({
    placement: popUp.other_condition.placement,
    width: popUp.other_condition.width,
    title: $('#other-conditions').attr('title'),
    content: $('#tableConditions'),
    event : function(){
        box = $('#other-conditions');
        const offset = $('#other-conditions').offset();
        var four = {id:[],text:[]};
        if (!d.isMobile()) {
            $('.Hunter-pop-up').css({
                'left' : $('.container').offset().left+20,
                'right' : ($('.container').offset().left+20),
            });
        }
        $('.four_').click(function(e){ four = {id:[],text:[]}; adjust(box) })
        function adjust(box) {
            $('.four_:checked').each(function(){
              four.id.push($(this).val())
              four.text.push($(this).attr('text'))
            })
            $('#other-conditions').html(four.text.join(', '));
            if (four.text.length>0) {
                box.addClass(color);
            }else{
                box.removeClass(color);
                box.html(box.attr('title'));                    
            }
            box.next().val(four.id);
        }  
        $('.clear-list').click(function(){
            box.html(box.attr('title'))
            box.next().val('')
            $('.four_').prop('checked',false);
            box.removeClass(color);
        })
    }
});


checked()
function checked()
{
    // const inter = $('input[name="international"]').val().split(',');
    text = { one:[],two:[],three:[],four:[],five:[],six:[]};
    // $('.one_:checked').each(function(i,v){ text.one.push($(this).attr('text')); })
    $('.two_:checked').each(function(i,v){ text.two.push($(this).attr('text')); })
    $('.three_:checked').each(function(i,v){ text.three.push($(this).attr('text')); })
    $('.four_:checked').each(function(i,v){ text.four.push($(this).attr('text')); })
    $('.five_:checked').each(function(i,v){ text.five.push($(this).attr('text')); })
    $('.six_:checked').each(function(i,v){ text.six.push($(this).attr('text')); })

    // $('#inland').html(text.one);
    if(text.two.length>0) $('#international').html(text.two.join(', '));
    if(text.three.length>0) $('#methods').html(text.three.join(', '));
    if(text.four.length>0) $('#item').html(text.four.join(', '));
    if(text.five.length>0) $('#services').html(text.five.join(', '));
    if(text.six.length>0) $('#warehouse').html(text.six.join(', '));
}
$('#select-all').on('click',function(){
    if($(this).is(':checked')){
        $('.comp').prop('checked',true);
        $('.total-select').html($('.comp:checked').length);
    }else{ 
        $('.comp').prop('checked',false);
        $('.total-select').html(0);
    }
});