var device = $.fn.deviceDetector,
  width = $(window).width();
  if (!device.isIpad() && width < 768) {
    $('#back-to-top').parent().parent().css({'z-index':'999'});
  }
  $(document).ready(function() {
    $('.checkbox-ripple').rkmd_checkboxRipple();
    change_checkbox_color();
  });



  (function($) {

    $.fn.rkmd_checkboxRipple = function() {
      var self, checkbox, ripple, size, rippleX, rippleY, eWidth, eHeight;
      self = this;
      checkbox = self.find('.input-checkbox');

      checkbox.on('mousedown', function(e) {
        if(e.button === 2) {
          return false;
        }

        if($(this).find('.ripple').length === 0) {
          $(this).append('<span class="ripple"></span>');
        }
        ripple = $(this).find('.ripple');

        eWidth = $(this).outerWidth();
        eHeight = $(this).outerHeight();
        size = Math.max(eWidth, eHeight);
        ripple.css({'width': size, 'height': size});
        ripple.addClass('animated');

        $(this).on('mouseup', function() {
          setTimeout(function () {
            ripple.removeClass('animated');
          }, 200);
        });

      });
    }

  }(jQuery));

  function change_checkbox_color() {
    $('.color-box .show-box').on('click', function() {
      $(".color-box").toggleClass("open");
    });

    $('.colors-list a').on('click', function() {
      var curr_color = $('main').data('checkbox-color');
      var color = $(this).data('checkbox-color');
      var new_colot = 'checkbox-' + color;

      $('.rkmd-checkbox .input-checkbox').each(function(i, v) {
        var findColor = $(this).hasClass(curr_color);

        if(findColor) {
          $(this).removeClass(curr_color);
          $(this).addClass(new_colot);
        }

        $('main').data('checkbox-color', new_colot);

      });
    });
  }


  //   if($('.company-logo').length>0) {
  //   $('.company-logo').each(function(){
  //     var intials = this.getAttribute("data-name").charAt(0) + this.getAttribute("data-name").charAt(1);
  //     $(this).html('<span>'+intials+'</span>');
  //   })
  // }
  $('span.form-control').on('click',function(ev){
    $(this).addClass('-focus');
    $('span.form-control').not(this).removeClass('-focus');
    ev.stopPropagation();
  });
  $(document).click(function(){
    $('span.form-control').removeClass('-focus');
  })
  $(function () { $('[data-toggle="tooltip"]').tooltip() })
  $('.aicon').click(function(){
    if( $(this).find('.phone').length>0 ){ 
      if($(this).hasClass('-show')){
        $(this).removeClass('-show');
      }else{
        $(this).addClass('-show');
      }
    }
  })
  
  $(function(){
    $('.chatbox-top').click(function(){ 
      $(this).closest('.chatbox').toggleClass('chatbox-min'); 
    });
    $('.fa-close').click(function(){
      $(this).closest('.chatbox').hide();
    });
  });
   $('.btn-view-more').click(function(){ $('#exampleModal').find('iframe').attr('src',$(this).attr('href'));});