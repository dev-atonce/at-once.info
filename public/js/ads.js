const area = $('.elementor');
const path = window.location.pathname;
const pathArr = path.split('/');
const img = $.ajax({method:'get',url:'api/ads/blog',async:false}).responseJSON;
const popup = $('<div id="pop-up" class="modal fade" role="dialog">\
<div class="modal-dialog modal-dialog-centered" role="document">\
  <div class="modal-content">\
    <div class="modal-body">\
      <button data-dismiss="modal" class="close">&times;</button>\
      <a href="https://www.at-once.info" target="_blank">\
        <img src="images/pop-ups-blog.jpg" class="img-fluid">\
      </a>\
    </div>\
  </div>\
</div>\
</div>');

img.map(function(v,k){
    if(k==0){
        ads0(v.url)
    }
    if(k==1){
        ads1(v.url)
    }
    if(k==2){
        popupAds()
    }
})
function WriteCookie() {
    var now = new Date();
    var minutes = 30;
    now.setTime(now.getTime() + (minutes * 60 * 1000));
    cookievalue = escape('show') + ";"
    document.cookie="popupAds=" + cookievalue;
    document.cookie = "expires=" + now.toUTCString() + ";"
    document.write("Setting Cookies : " + "popupAds=" + cookievalue );
    
}

function ads0(url){
    $('<a href="'+pathArr[1]+'" target="_blank"><img class="mt-4" src="'+url+'" style="width:100%"/></a>').insertAfter($('.elementor'));
}
function ads1(url){
    $('<a href="'+pathArr[1]+'" target="_blank"><img class="mt-4" src="'+url+'" style="width:100%"/></a>').insertAfter($('.blog-sh'));
}
function popupAds(){
    const ckk = getCookie("popupAds");
    if(ckk == ""){
        popup.modal('show');
        WriteCookie()
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }