
$('.btn-blog-tab').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 1000,
  responsive: [
  { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: true, } },
  { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
  { breakpoint: 480, settings: { slidesToShow: 3, slidesToScroll: 1 } }
  ]
});


$('.auto-blog').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 1000,
  responsive: [
  { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: true, } },
  { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
  { breakpoint: 480, settings: { slidesToShow: 3, slidesToScroll: 1 } }
  ]
});



$(document).on('ready', function() {
  $(".regular").slick({    
   autoplay: false,
   infinite: false,
   arrows: true,
   dots: false,
   slidesToShow: 3,
   slidesToScroll: 1,
   responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1,
      infinite: true
    }
  }, {   breakpoint: 600,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2,
      infinite: true
    }
  }, {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
              //centerMode: true,
              infinite: true
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
          ]
        });



  $(".top-cp").slick({
   autoplay: true,
   infinite: true,
   arrows: false,
   dots: true,
   slidesToShow: 2,
   slidesToScroll: 2,
   responsive: [{
    breakpoint: 1024,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1,
      infinite: true
    }
  }, {
    breakpoint: 600,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2,
      infinite: true,
      dots:false
    }
  }, {
    breakpoint: 480,
    settings: {
      dots:false,
      slidesToShow: 1,
      slidesToScroll: 1,
              //centerMode: true,
              infinite: true
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
          ]
        });

    //     $(".top-cp").slick({
    //   dots: false,
    //   infinite: true,
    //   slidesToShow: 2,
    //   slidesToScroll: 2,
    //   autoplay: true,
    //   autoplaySpeed: 3000,
    //   responsive: [
    //   { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 2, infinite: true, dots: true } },
    //   { breakpoint: 900, settings: { slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: false, prevArrow: true, nextArrow: false } },
    //   { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1, dots: false  } }
    //   ]
    // });


    $('.responsive').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
      { breakpoint: 1024,settings: { slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true } },
      { breakpoint: 600,settings: { slidesToShow: 2, slidesToScroll: 2 } },
      { breakpoint: 480,settings: { slidesToShow: 1, slidesToScroll: 1 } }
      ]
    });
    $('.autoplay').slick({
      slidesToShow: 7,
      slidesToScroll: 7,
      autoplay: true,
      autoplaySpeed: 3000,
      prevArrow: false,
      nextArrow: false,
      responsive: [
      { breakpoint: 1024, settings: { slidesToShow: 5, slidesToScroll: 3, infinite: true, }  },
      { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
      { breakpoint: 480, settings: { slidesToShow: 3, SlidesToScroll: 1 } }
      ]
    });

    //     $('.autoplay').slick({
    //   slidesToShow: 6,
    //   slidesToScroll: 6,
    //   speed: 4000,
    //   autoplay: true,
    //   autoplaySpeed: 0,
    //   centerMode: true,
    //   cssEase: 'linear',
    //   prevArrow: false,
    //   nextArrow: false,
    //   responsive: [
    //   { breakpoint: 1024, settings: { slidesToShow: 6, slidesToScroll: 3, infinite: true, }  },
    //   { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
    //   { breakpoint: 480, settings: { slidesToShow: 2, SlidesToScroll: 1 } }
    //   ]
    // });

    // $('.autoplay02').slick({
    //   slidesToShow: 10,
    //   slidesToScroll: 10,
    //   speed: 4000,
    //   autoplay: true,
    //   autoplaySpeed: 0,
    //   centerMode: true,
    //   cssEase: 'linear',
    //   prevArrow: false,
    //   nextArrow: false,
    //   responsive: [
    //   { breakpoint: 1024, settings: { slidesToShow: 6, slidesToScroll: 3, infinite: true, }  },
    //   { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
    //   { breakpoint: 480, settings: { slidesToShow: 2, SlidesToScroll: 1 } }
    //   ]
    // });

    $('.autoplay-banner').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 1000,
      responsive: [
      { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: true, } },
      { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
      { breakpoint: 480, settings: { slidesToShow: 3, slidesToScroll: 1 } }
      ]
    });



  });










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





if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
    backToTop = function () {
      var scrollTop = $(window).scrollTop();
      if (scrollTop > scrollTrigger) {
        $('#back-to-top').addClass('show');
      } else {
        $('#back-to-top').removeClass('show');
      }
    };
    backToTop();
    $(window).on('scroll', function () {
      backToTop();
    });
    $('#back-to-top').on('click', function (e) {
      e.preventDefault();
      $('html,body').animate({
        scrollTop: 5
      }, 1000);
    });
  }





  $(function(){
    $('.qa-title').click(function(event) {
      event.preventDefault();
      $(this).next('.qa-content').stop().slideToggle(450); 
      $(this).toggleClass('opened');
    });
  });



















