$(document).ready(function() {
	
	smoothScroll();
	
	// Animate menu using animate.css
	// $('.tab-lang').addClass('animated bounceInDown');

	// Scroll event listen
	$(window).on('scroll', function(){
		updateNavigation();
	});
	
	$('.button-container, .switch-container').bind('touchstart mousedown', function(e){
	});
	
	// Update nav selected when click
	$('a.btn-lang').on('click', function() {
		$('.nav-item').removeClass('active');
		$(this).parent().addClass('active');
	});
	
	slideSwitch();
	
});

// Smooth the scroll action
function smoothScroll() {
	
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });
}

// Update nav selected
function updateNavigation() {
	var lastId,
    topMenu = $(".nav-tab-lang"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
    
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("data-scroll"));
      if (item.length) { return item; }
    });
  
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item

   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element


   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";

   if (lastId !== id) {
       lastId = id;
       // Set/remove active class

       console.log(id);
       menuItems
         .parent().removeClass("active")
         .end().filter("[data-scroll='#"+id+"']").parent().addClass("active");
   }                   
}

// Update slide switch highlight
function slideSwitch() {
	$('.switch-slide').on('click', function() {
		
    var activeSpan = $('.switch-toggle-slide .active');

    if (activeSpan.css('left') == '0px') {
      activeSpan.css('left', '50%');
    }
    
    if (activeSpan.css('left') == '125px') {
      activeSpan.css('left', '0');
    }
    
    if ($(this).hasClass('active-switch')) {
      $('.switch-slide').addClass('active-switch')
      $(this).removeClass('active-switch');
    }
    else {
      $('.switch-slide').removeClass('active-switch')
      $(this).addClass('active-switch');
    }
	});
}










$(function(){
    //WOW plugin init
    new WOW().init();

    //parallax effect for banner
    (function() {
        var posY;
        var image = document.getElementById('parallax');;
        function paralax() {
            posY = window.pageYOffset;
            image.style.top = posY * 0.9 + 'px';
        }
        window.addEventListener('scroll', paralax);
    })();
});




