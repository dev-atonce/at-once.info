var category = window.location.pathname.split('/')[2];
var d = $.fn.deviceDetector, width = $(window).width();;
var popUp = {
    international : {
      placement : 'center',
      width : $('.container').width()-10,
    },
    methods : {
      placement : (d.isMobile())?'center':'right',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    item : {
      placement : (d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    service : {
      placement : 'center',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    warehouse : {
      placement :(d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
    location : {
      placement :(d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-13:$('.filter-box02').width(),
    },
};
var resetBtn = '.reset-all-filters';

$(document).on('change','#domestic',function(){
  if($(this).is(":checked")){
    $(this).parent().addClass(color);
  }else{
    $(this).parent().removeClass(color);
  }
})

$('#international').hunterPopup({
    placement: popUp.international.placement,
    width: popUp.international.width,
    title: $('#international').attr('title'),
    content: $('#tableFirst'),
    resetBtn: resetBtn,
    event : function(){
      box = $('#international');
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+15,
            'right' : ($('.container').offset().left+15),
        });
      }      
      var first = {id:[],text:[]};
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
  // console.log($('.sticky').offset())
  $('#methods').hunterPopup({
    placement : popUp.methods.placement,
    width: popUp.methods.width,
    title: $('#methods').attr('title'),
    content: $('#tableMethods'),
    resetBtn: resetBtn,
    event : function(){
      box = $('#methods');
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+15,
            'right' : ($('.container').offset().left+15), 
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

  $('#item').hunterPopup({
    placement : popUp.item.placement,
    width: popUp.item.width,
    title: $('#item').attr('title'),
    content: $('#tableItems'),
    resetBtn: resetBtn,
    event:function(){
      box = $('#item');
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+15,
            'right' : $('.container').offset().left+15, 
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

  $('#services').hunterPopup({
    placement: popUp.service.placement,
    width: popUp.service.width,
    title: $('#services').attr('title'),
    content: $('#tableService'),
    resetBtn: resetBtn,
    event : function(){
      box = $('#services');
      if (!d.isMobile()) {

        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+15,
            'right' : ($('.container').offset().left+15), 
        });
      }
      var fourth = {id:[],text:[]};
      $('.fourth_').click(function(e){ fourth = {id:[],text:[]}; adjust(box) })
      function adjust(box) {
        $('.fourth_:checked').each(function(){
          fourth.id.push($(this).val())
          fourth.text.push($(this).attr('text'))
        })
        $('#services').html(fourth.text.join(', '));
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

  $('#warehouse').hunterPopup({
    placement: popUp.warehouse.placement,
    width: popUp.warehouse.width,
    title: $('#warehouse').attr('title'),
    content: $('#tableWarehouse'),
    resetBtn: resetBtn,
    event : function(){
      var box = $('#warehouse');
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+15,
            'right' : ($('.container').offset().left+15), 
        });
      }
      var fifth = {id:[],text:[]};
      $('.fifth_').click(function(e){ fifth = {id:[],text:[]}; adjust(box) })
      function adjust(box) {
        $('.fifth_:checked').each(function(){
          fifth.id.push($(this).val())
          fifth.text.push($(this).attr('text'))
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
        box.html(box.attr('title'))
        box.next().val('')
        $('.fifth_').prop('checked',false);
        box.removeClass(color);
      })
    }
  });

  $('#location').hunterPopup({
    placement: popUp.location.placement,
    width: popUp.location.width,
    title: $('#location').attr('title'),
    content: $('#tableLocation'),
    resetBtn: resetBtn,
    event : function(){
      var box = $('#location');
      if (!d.isMobile()) {
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+15,
            'right' : ($('.container').offset().left+15), 
        });
      }
      var sixth = {id:[],text:[]};
      $('.sixth_').click(function(e){ sixth = {id:[],text:[]}; adjust(box) })
      function adjust(box) {
        $('.sixth_:checked').each(function(){
          sixth.id.push($(this).val())
          sixth.text.push($(this).attr('text'))
        })
        box.html(sixth.text.join(', '));
        if (sixth.text.length>0) {
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
        $('.sixth_').prop('checked',false);
        box.removeClass(color);
      })
    }
  });

  $(document).on('click',resetBtn,function(){
      $('#domestic').prop('checked',false);
      $('#domestic').parent().removeClass(color);
  })
  $('.reset-all-filters').click(function(){
    $('#keywords').val('');
  })
  checked()
  function checked()
  {
      /*===================================*/
      box = {first:$('#international'),second:$('#methods'),third:$('#item'),fourth:$('#services'),fifth:$('#warehouse'),sixth:$('#location')}
      text = {first:[],second:[],third:[],fourth:[],fifth:[],sixth:[]};
      /*===================================*/
      $('.first_:checked').each(function(i,v){ text.first.push($(this).attr('text')); })
      $('.second_:checked').each(function(i,v){ text.second.push($(this).attr('text')); })
      $('.third_:checked').each(function(i,v){ text.third.push($(this).attr('text')); })
      $('.fourth_:checked').each(function(i,v){ text.fourth.push($(this).attr('text')); })
      $('.fifth_:checked').each(function(i,v){ text.fifth.push($(this).attr('text')); })
      $('.sixth_:checked').each(function(i,v){ text.sixth.push($(this).attr('text')); })
      /*===================================*/
      if($('#domestic').attr('checked')) $('#domestic').parent().addClass(color);
      if(text.first.length>0) box.first.addClass(color).html(text.first.join(', '));
      if(text.second.length>0) box.second.addClass(color).html(text.second.join(', '));
      if(text.third.length>0) box.third.addClass(color).html(text.third.join(', '));
      if(text.fourth.length>0) box.fourth.addClass(color).html(text.fourth.join(', '));
      if(text.fifth.length>0) box.fifth.addClass(color).html(text.fifth.join(', '));
      if(text.sixth.length>0) box.sixth.addClass(color).html(text.sixth.join(', '));
      /*===================================*/
  }