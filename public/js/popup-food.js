var category = window.location.pathname.split('/')[2];
var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
    type : {
      placement : (d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    location : {
      placement : (d.isMobile())?'center':'right',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
};


$('#type').hunterPopup({
    placement: popUp.type.placement,
    width: popUp.type.width,
    title: $('#type').attr('title'),
    content: $('#tableFirst'),
    resetBtn: '.reset-all-filters',
    event : function(){
      box = $('#type');
      var two = {id:[],text:[]};
      
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20),
        });
      }
      
      $('.first_').click(function(){ two = {id:[],text:[]}; adjust(box); });
      function adjust() {
        $('.first_:checked').each(function(){
          two.id.push($(this).val())
          two.text.push(' '+$(this).attr('text'))
        })
        console.log(two.text);
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
    event:function(){
      box = $('#item');
      if (!d.isMobile()) {
        const offset = box.offset();
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
  $('.reset-all-filters').click(function(){
    $('#keywords').val('');
  })

  checked()
  function checked()
  {
      /*===================================*/
      box = {first:$('#type'),second:$('#service'),third:$('#location')}
      text = {first:[],second:[],third:[]};
      /*===================================*/
      $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); })
      $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); })
    //   $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
    //   $('.fourth_:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
    //   $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
    //   $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
      /*===================================*/
      if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
      if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
    //   if(text.third.length>0) box.third.html(text.third.join(', '));
    //   if(text.fourth.length>0) box.fourth.html(text.fourth.join(', '));
    //   if(text.fifth.length>0) box.fifth.html(text.fifth.join(', '));
    //   if(text.sixth.length>0) box.sixth.html(text.sixth.join(', '));
      /*===================================*/
  }