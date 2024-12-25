
var headerTooltip = document.getElementById('header-tooltip');
headerTooltip.addEventListener('click',function(){
    const tag=document.getElementsByTagName('body').item(0);
    var cdt = 'c-dark-theme';
    const dt = localStorage.getItem("theme");
    if(dt!='' && dt!= null){ 
        localStorage.removeItem('theme'); 
        tag.classList.remove(cdt)
    }else{ 
        localStorage.setItem('theme',cdt); 
        tag.classList.add(cdt)
    }
})


