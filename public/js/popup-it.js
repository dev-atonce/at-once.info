var category = window.location.pathname.split('/')[2];
var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
    service : {
      placement : (d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    software : {
      placement : 'center',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    hardware : {
      placement : (d.isMobile())?'center':'right',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    solution : {
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


  $('#software').hunterPopup({
    placement : popUp.software.placement,
    width: popUp.software.width,
    title: $('#software').attr('title'),
    content: $('#tableSecond'),
    resetBtn: '.reset-all-filters',
    event:function(){
      box = $('#software');
      if (!d.isMobile()) {
        const offset = box.offset();
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

  $('#hardware').hunterPopup({
    placement : popUp.hardware.placement,
    width: popUp.hardware.width,
    title: $('#hardware').attr('title'),
    content: $('#tableThird'),
    resetBtn: '.reset-all-filters',
    event:function(){
      box = $('#hardware');
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

  $('#solution').hunterPopup({
    placement : popUp.solution.placement,
    width: popUp.solution.width,
    title: $('#solution').attr('title'),
    content: $('#tableFourth'),
    resetBtn: '.reset-all-filters',
    event:function(){
      box = $('#solution');
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      var fourth = {id:[],text:[]};
      $('.fourth_').click(function(){ fourth = {id:[],text:[]}; adjust(box); })
      function adjust() {
        $('.fourth_:checked').each(function(){
          fourth.id.push($(this).val())
          fourth.text.push(' '+$(this).attr('text'))
        })
        box.html(fourth.text.join(', '));
        if (fourth.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(fourth.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'));
        box.next().val('');
        $('.fourth_:checked').prop('checked',false);
        box.removeClass(color);
      }) 
    }
  });

  $('#location').hunterPopup({
    placement : popUp.location.placement,
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableFifth'),
    resetBtn: '.reset-all-filters',
    event:function(){
      box = $('#location');
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      var fifth = {id:[],text:[]};
      $('.fifth_').click(function(){ fifth = {id:[],text:[]}; adjust(box); })
      function adjust() {
        $('.fifth_:checked').each(function(){
          fifth.id.push($(this).val())
          fifth.text.push(' '+$(this).attr('text'))
        })
        box.html(fifth.text.join(', '));
        if (fifth.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(fifth.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'));
        box.next().val('');
        $('.fifth_:checked').prop('checked',false);
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
      box = {first:$('#service'),second:$('#software'),third:$('#hardware'),fourth:$('#solution'),fifth:$('#location')}
      text = {first:[],second:[],third:[],fourth:[],fifth:[]};
      /*===================================*/
      $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); })
      $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); })
      $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
      $('.fourth_:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
      $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
    //   $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
      /*===================================*/
      if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
      if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
      if(text.third.length>0) box.third.addClass(color).html(text.third.join(', '));
      if(text.fourth.length>0) box.fourth.addClass(color).html(text.fourth.join(', '));
      if(text.fifth.length>0) box.fifth.addClass(color).html(text.fifth.join(', '));
    //   if(text.sixth.length>0) box.sixth.html(text.sixth.join(', '));
      /*===================================*/
  }