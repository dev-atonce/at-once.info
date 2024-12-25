var d = $.fn.deviceDetector, width = $(window).width();
var popUp = {
  location : {
    placement :(d.isMobile())?'center':'left',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  },
  condition : {
    placement : 'center',
    width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
  }          
};
var category = window.location.pathname.split('/')[2];

$('#location').hunterPopup({
  placement: popUp.location.placement,
  width: popUp.location.width,
  title: $('#location').attr('title'),
  content: $('#tableLocation'),
  resetBtn: '.reset-all-filters',
  event : function(){
    box = $('#location');
    var first = {id:[],text:[]};
    if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20),
        });
      }
    $('.first_').click(function(e){ first = {id:[],text:[]}; adjust(box) })
    function adjust(box) {
      $('.first_:checked').each(function(){
        first.id.push($(this).val())
        first.text.push($(this).attr('text'))
      })
      box.html(first.text.join(', '));
      if(first.id.length>0){
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
        $('.first_').prop('checked',false);
        box.html(box.attr('title'));
        box.removeClass(color);
    })
  }
});
$('#condition').hunterPopup({
  placement: popUp.condition.placement,
  width: popUp.condition.width,
  title: $('#condition').attr('title'),
  content: $('#tableCondition'),
  resetBtn: '.reset-all-filters',
  event : function(){
    box = $('#condition');
    var second = {id:[],text:[]};
    if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20),
        });
      }
    $('.second_').click(function(e){ second={id:[],text:[]}; adjust(box) })
    function adjust(box) {
      $('.second_:checked').each(function(){
        second.id.push($(this).val())
        second.text.push($(this).attr('text'))
      })
      box.html(second.text.join(', '));
      if(second.id.length>0){
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
      $('.second_').prop('checked',false);
      box.removeClass(color)
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

    text = { first:[],second:[],third:[],fourth:[],fifth:[],sixth:[]};
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
checked()
function checked()
{
    /*===================================*/
    box = {first:$('#location'),second:$('#condition'),third:null,fourth:null,fifth:null,sixth:null}
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
}