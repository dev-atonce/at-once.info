var pathName = window.location.pathname;
pathName = pathName.replace('/th','');
pathName = pathName.replace('/en','');
pathName = pathName.replace('/jp','');
pathName = pathName.replace('/zh','');

$('.nav-link').each(function(){
  if($(this).attr('href')!='' && $(this).attr('href')!='#'){
    let current = $(this).attr('href');
      if(current.search(pathName)>-1 && pathName){
        $(this).addClass('--active')
      }
    }
})
$('.dropdown-item').each(function(){
  if($(this).attr('data-href')!='' && $(this).attr('data-href')!='#'){
    let current = $(this).attr('data-href');
    if(current == pathName){
      $(this).closest('.nav-item').find('.nav-link').addClass('--active');
      $(this).addClass('--active');
    }
  }
});
// $('div[data-readmore]').hide().each(function() {
//   var open_text = $(this).data('open-text');
//   open_text = typeof open_text !== 'undefined' ? open_text : 'อ่านต่อ';
//   $(this).after('<div class="text-center"><span class="text-center btn btn-orange" data-readmore-toggle>' + open_text + '</span></div>');
// });

// $('[data-readmore-toggle]').click(function(e) {
//   e.preventDefault();
  
//   var open_text = $(this).siblings('div[data-readmore]').data('open-text');
//   var close_text = $(this).siblings('div[data-readmore]').data('close-text');
  
//   if(typeof open_text == 'undefined') {open_text = "อ่านต่อ"}
//   if(typeof close_text == 'undefined') {close_text = "ย่อ"}

//   if($(this).text() == open_text) {
//     $(this).html(close_text).parent().prev('div[data-readmore]').show();
//   } else {
//     $(this).html(open_text).parent().prev('div[data-readmore]').hide();
//   }
// });
// close readmored




  $('span.form-control').on('click',function(ev){
      $(this).addClass('-focus');
      $('span.form-control').not(this).removeClass('-focus');
      ev.stopPropagation();
    });
    $(document).click(function(){
      $('span.form-control').removeClass('-focus');
    })

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $('.aicon').click(function(){
     if( $(this).find('.phone').length>0 ){ 
      if($(this).hasClass('-show')){
        $(this).removeClass('-show');
      }else{
        $(this).addClass('-show');
      }
    }
  })


  


  // navbar-slide

  $(document).ready(function () {
    if($("#sidebar").length > 0){
        $("#sidebar").mCustomScrollbar({
          theme: "minimal"
        });

    } 

    $('#dismiss, .overlay').on('click', function () {
      $('#sidebar').removeClass('active');
      $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').addClass('active');
      $('.overlay').addClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
  });

  $('.submenu-member').on('click',function(){
      if($(this).next().hasClass('menu-child')){
          $(this).next().toggleClass('d-none d-block');
          $(this).find('.fas').toggleClass('fa-chevron-left fa-chevron-down');
      }
  })
  var uri = window.location;
  $('.menu-child a').each(function(){
    var cur = $(this);
    if(cur.attr('href')==uri.pathname){ 
      cur.addClass('this-active'); 
      cur.prepend('<style>.nav-item.this-active::before{content:"";width:8px;background:#1a81c4;height:100%;top:0;right:0;position: absolute;}');
      cur.closest('.menu-child').removeClass('d-none').addClass('d-block');
      cur.closest('li').find('.fas').toggleClass('fa-chevron-left fa-chevron-down');
    }else{ }
    // if(cur.next().hasClass('nav')){ cur.next().toggleClass('d-block d-none') }
  })

//   var sidenavs = document.querySelectorAll('.sidenav')
// for (var i = 0; i < sidenavs.length; i++){
//   M.Sidenav.init(sidenavs[i]);
// }
// var dropdowns = document.querySelectorAll('.dropdown-trigger')
// for (var i = 0; i < dropdowns.length; i++){
//   M.Dropdown.init(dropdowns[i]);
// }
// var collapsibles = document.querySelectorAll('.collapsible')
// for (var i = 0; i < collapsibles.length; i++){
//   M.Collapsible.init(collapsibles[i]);
// }
// var featureDiscoveries = document.querySelectorAll('.tap-target')
// for (var i = 0; i < featureDiscoveries.length; i++){
//   M.FeatureDiscovery.init(featureDiscoveries[i]);
// }
// var materialboxes = document.querySelectorAll('.materialboxed')
// for (var i = 0; i < materialboxes.length; i++){
//   M.Materialbox.init(materialboxes[i]);
// }
// var modals = document.querySelectorAll('.modal')
// for (var i = 0; i < modals.length; i++){
//   M.Modal.init(modals[i]);
// }
// var parallax = document.querySelectorAll('.parallax')
// for (var i = 0; i < parallax.length; i++){
//   M.Parallax.init(parallax[i]);
// }
// var scrollspies = document.querySelectorAll('.scrollspy')
// for (var i = 0; i < scrollspies.length; i++){
//   M.ScrollSpy.init(scrollspies[i]);
// }
// var tabs = document.querySelectorAll('.tabs')
// for (var i = 0; i < tabs.length; i++){
//   M.Tabs.init(tabs[i]);
// }
// var tooltips = document.querySelectorAll('.tooltipped')
// for (var i = 0; i < tooltips.length; i++){
//   M.Tooltip.init(tooltips[i]);
// }










var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);





// var scrollTrigger = 100; // px
//   window.addEventListener('scroll', function () {
//       var scrollTop = window.scrollY;
//       if (scrollTop > scrollTrigger) 
//         document.getElementById('back-to-top').classList.add('show');
//       else
//           document.getElementById('back-to-top').classList.remove('show');
//   });
//   document.getElementById('back-to-top').addEventListener('click',function(){
//       window.scrollTo({top: 0, behavior: 'smooth'});
//   })






    $(function(){
      $('.qa-title').click(function(event) {
        event.preventDefault();
        $(this).next('.qa-content').stop().slideToggle(450); 
        $(this).toggleClass('opened');
    });
  });








// ------------------



if($(window).width() > 768){

// Hide all but first tab content on larger viewports
$('.accordion-p__content:not(:first)').hide();

// Activate first tab
$('.accordion-p__title:first-child').addClass('active');

} else {
  
// Hide all content items on narrow viewports
$('.accordion-p__content').hide();
};

// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
$( ".accordion-p__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

// The clicking action
$('.accordion-p__title').on('click', function() {
$('.accordion-p__content').hide();
$(this).next().show().prev().addClass('active').siblings().removeClass('active');
});

// ------------------


const cards = document.querySelectorAll('.card');

function transition() {
  if (this.classList.contains('active')) {
    this.classList.remove('active')
  } else {
    this.classList.add('active');
  }
}

cards.forEach(card => card.addEventListener('click', transition));
 


 // ------------------



var accordion = (function(){
  
  var $accordion = $('.js-accordion');
  var $accordion_header = $accordion.find('.js-accordion-header');
  var $accordion_item = $('.js-accordion-item');
 
  // default settings 
  var settings = {
    // animation speed
    speed: 400,
    
    // close all other accordion items if true
    oneOpen: false
  };
    
  return {
    // pass configurable object literal
    init: function($settings) {
      $accordion_header.on('click', function() {
        accordion.toggle($(this));
      });
      
      $.extend(settings, $settings); 
      
      // ensure only one accordion is active if oneOpen is true
      if(settings.oneOpen && $('.js-accordion-item.active').length > 1) {
        $('.js-accordion-item.active:not(:first)').removeClass('active');
      }
      
      // reveal the active accordion bodies
      $('.js-accordion-item.active').find('> .js-accordion-body').show();
    },
    toggle: function($this) {
            
      if(settings.oneOpen && $this[0] != $this.closest('.js-accordion').find('> .js-accordion-item.active > .js-accordion-header')[0]) {
        $this.closest('.js-accordion')
               .find('> .js-accordion-item')
               .removeClass('active')
               .find('.js-accordion-body')
               .slideUp()
      }
      
      // show/hide the clicked accordion item
      $this.closest('.js-accordion-item').toggleClass('active');
      $this.next().stop().slideToggle(settings.speed);
    }
  }
})();

$(document).ready(function(){
  accordion.init({ speed: 300, oneOpen: true });
});

// store google translate's change event
trackChange = null;
pageDelayed = 3000;

// overwrite prototype to snoop, reset after we find it (keep this right before translate init)
Element.prototype._addEventListener = Element.prototype.addEventListener;
Element.prototype.addEventListener = function(a,b,c) {
  let reset = false;

  // filter out first change event
  if (a == 'change'){
    trackChange = b;
    reset = true;
  }

  if(c==undefined)
    c=false;

  this._addEventListener(a,b,c);

  if(!this.eventListenerList)
    this.eventListenerList = {};

  if(!this.eventListenerList[a])
    this.eventListenerList[a] = [];

  this.eventListenerList[a].push({listener:b,useCapture:c});

  if (reset){
    Element.prototype.addEventListener = Element.prototype._addEventListener;
  }
};

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'auto',
    autoDisplay: 'true',
    includedLanguages:'th,en,vi,id,ms,lo,zh-TW,zh-CN,zh-HK,ja,es,fr,ko,it,de,my,pa,mr,hi,ar,pa,pt,ru,bn,jw,te,ta', 
  }, 'google_translate_element');

  let first = $('#google_translate_element');
  let second = $('#google_translate_element2');

  let nowChanging = false;

  // we need to let it load, since it'll be in footer a small delay shouldn't be a problem
  setTimeout(function(){
    select = first.find('select');
    // lets clone the translate select
    second.html(first.clone());
    second.find('select').val(select.val());

    // add our own event change
    first.find('select').on('change', function(event){
      if (nowChanging == false){
        second.find('select').val($(this).val());
      }
      return true;
    });

    second.find('select').on('change', function(event){
      if (nowChanging){
        return;
      }

      nowChanging = true;
      first.find('select').val($(this).val());
      trackChange();

      // give this some timeout incase changing events try to hit each other                    
      setTimeout(function(){
        nowChanging = false;
      }, 1000);
    });
  }, pageDelayed);
}









