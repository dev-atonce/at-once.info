var overlayElement = $('<div class="loading-overlay">\
    <div class="cv-spinner">\
        <span class="spinner"></span>\
    </div>\
</div>');
$(document).find('.c-main').prepend(overlayElement);   
$(document).find(".loading-overlay").fadeIn(300);

window.addEventListener("load", (event) => {
    setTimeout(function(){
        $(document).find('.c-main').fadeIn(300);
        $(document).find(".loading-overlay").fadeOut(300);
    },500);
});