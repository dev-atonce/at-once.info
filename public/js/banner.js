$(document).ready(function(){
    var stickyToggle = function(sticky, stickyWrapper, scrollElement) {
        var stickyHeight = sticky.outerHeight();
        var stickyTop = stickyWrapper.offset().top;
        var $navbar = $(".filter");
        var height = $navbar.height();
        var y_pos = $navbar.offset().top + height;
        if (scrollElement.scrollTop() >= y_pos) {
            stickyWrapper.height(stickyHeight);
            sticky.addClass("is-sticky");
        } else {
            sticky.removeClass("is-sticky");
            stickyWrapper.height('auto');
        }
    };
    $('[data-toggle="sticky-onscroll"]').each(function() {
      var sticky = $(this);
      var stickyWrapper = $('<div>').addClass('sticky-wrapper'); 
      sticky.before(stickyWrapper);
      sticky.addClass('sticky');
      $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function() {
        stickyToggle(sticky, stickyWrapper, $(this));
      });
      stickyToggle(sticky, stickyWrapper, $(window));
    });
});