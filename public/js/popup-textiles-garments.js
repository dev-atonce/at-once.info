var category = window.location.pathname.split('/')[2];
var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
    service : {
      placement : (d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    location : {
      placement : 'center',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
};


$('#service').hunterPopup({
    placement: popUp.service.placement,
    width: popUp.service.width,
    title: $('#service').attr('title'),
    content: $('#tableFirst'),
    resetBtn: '.reset-all-filters',
    event : function(){
      box = $('#service');
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
    event:function(){
      box = $('#location');
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      var second = {id:[],text:[]};
      $('.second_').click(function(){ second = {id:[],text:[]}; adjust(box); })
      function adjust() {
        $('.second_:checked').each(function(){
          second.id.push($(this).val())
          second.text.push(' '+$(this).attr('text'))
        })
        box.html(second.text.join(', '));
        console.log(second.text.length);
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
  $('.reset-all-filters').click(function(){
    $('#keywords').val('');
  })



  checked()
  function checked()
  {
      /*===================================*/
      box = { first:$('#service'), second:$('#location') };
      text = {first:[],second:[]};
      /*===================================*/
      $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); });
      $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); });
    //   $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
    //   $('.fourth_:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
    //   $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
    //   $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
      /*===================================*/
      if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
      if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
  }