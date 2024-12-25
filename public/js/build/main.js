var lang = $('html').attr('lang');
    url = window.location,
    segment = url.pathname.split('/')
    category = segment[2];
$('.user-submenu li').each(function(){
    let $this = $(this).find('a');

    let search = window.location.pathname.search($this.attr('href'));
    if(search>-1){
        $this.addClass('current')
    }
    // if (window.location.pathname==$this.attr('href')) $this.addClass('current');
})



