const box = $('#blogActivity');
const blogWidth = box.find('.card').width();
const blogListWidth = box.find('.card-body').width();
const blogGoal = 2;
const blogConfig = {
    css : {  'z-index': '1000','width': blogWidth+'px','max-height': '698px' },
    button: {
        more: 'fa-angle-left', active: 'fa-angle-down',
    },
    position: { relative:'position-relative', absolute:'position-absolute' }
};

box.find('.list-item').find('span').css({width: blogListWidth - 212});
box.find('.list-item').find('a').css({width: blogListWidth - 212});



const allBlog = () => {
    let count = 0;
    $.ajax({
        method:'get',
        url:`api/blog/count/all`,
        success:(res) => {
            if(res?.count>0){
                box.find('.blog-remainning').find('strong').html(res.count);
            }
        }
    })
}

const blogTodayShow = (el) => {

    moreButton = $(el); 
    blogConfig.css.width = box.find('.card').width() + 'px';
    //toggle class
    moreButton.find('i').toggleClass(blogConfig.button.more+' '+blogConfig.button.active);
    moreButton.parent().addClass(blogConfig.position.absolute);
    //card content
    toggleContent = moreButton.closest('.card');
    if (toggleContent.hasClass('position-absolute')) {
      toggleContent.removeClass(blogConfig.position.absolute).removeAttr('style');
    //   moreButton.closest('.p1').removeAttr('style');
      moreButton.closest('.row').next().toggleClass('d-none d-block');
      $('.blog-remainning').removeClass('d-none');
      
    } else {    
      toggleContent.addClass(blogConfig.position.absolute).css(blogConfig.css);      
    //   moreButton.closest('.p1').css('margin-bottom','54px');
      moreButton.closest('.row').next().toggleClass('d-none d-block');
      
      $('.blog-remainning').addClass('d-none');
    }  
    currentTab = $('[tab="blog-created"]').find('ol');
    if(currentTab.height()>523){
      currentTab.addClass('scroll-y');
    }
}

const blogSummary = (el) => {
    var tab = $('.tab-blog-activity');
    var totolElm = $('.blog-total');
    var byElm = $('.blog-by');
    var industryId = [];
    var industryName = [];
    var byName = [];

    if (typeof el == typeof undefined) {
          var tabActive = $('[tab="blog-created"]');
      // var tabActive = $('[tab="'+el.attr('data-tab')+'"]');
      if(tabActive.find('li').length>0){
        tabActive.find('li').each(function(){
          id = $(this).attr('id');
          industry = $(this).attr('industry');
          by = $(this).find('small').attr('blog-by');
          if(industryId != undefined) if($.inArray(id,industryId) === -1) industryId.push(id);
          if(industry != undefined) if($.inArray(industry,industryName) === -1) industryName.push(industry);
          if(by != undefined) if($.inArray(by,byName) === -1) byName.push(by);
          tabActive.find('li');
        });   
        if(tabActive.find('ol').height()>523){
          tabActive.find('ol').addClass('scroll-y');
        }   
      }    
    } else {
      var tabActive = $('[tab="'+el.attr('data-tab')+'"]');
      el.addClass('text-primary');
      tab.not(el).removeClass('text-primary');
      $('[tab-toggle="blog-activity"]').addClass('d-none');
      tabActive.removeClass('d-none');
      let id='';
      let industry='';
      tabActive.find('li').each(function(){
        id = $(this).attr('id');
        industry = $(this).attr('industry');
        by = $(this).find('small').attr('blog-by');
        if($.inArray(id,industryId) === -1) industryId.push(id);
        if($.inArray(industry,industryName) === -1) industryName.push(industry);
        if($.inArray(by,byName) === -1) byName.push(by);
      });
      if(tabActive.find('ol').height()>523){
        tabActive.find('ol').addClass('scroll-y');
      }
    }
    totolElm.html('<strong>Total:&nbsp;</strong>');
    byElm.html('<strong>By:&nbsp;</strong>');

    if(industryName.length>0){
        let blogTotal = '';

        $.each(industryId,function(i,v){
            if (i>0) totolElm.append(',&nbsp;');
            if (typeof industryName[i] !== typeof undefined) {
                // console.log(tabActive)
                // if(typeof tabActive!== typeof undefined){
                    blogTotal += '[ ' + industryName[i] + ' : ' + tabActive.find('li').map(function(){ if($(this).attr('id') == v) return true }).get().length + ' ]';
                // }
            }else{
                // if(tabActive.find('li').length>0){
                    blogTotal += '[ At Once : ' + tabActive.find('li').map(function(){ if($(this).attr('id') != v) return true }).get().length + ' ]';
                // }
            }
        });
        totolElm.append(blogTotal); 
    }
    if(byName.length>0){
     
        let blogBy = '';
        $.each(byName,function(i,v){
            if (i>0) {
                blogBy += ',&nbsp;';
            }
            blogBy += '[ ' + byName[i] + ' : ' + tabActive.find('small').map(function(){ if($(this).attr('blog-by')==v ) return true }).get().length + ' ]';
        })
        byElm.append(blogBy);
    }
    
}
blogSummary();

const blogActivity = () => 
{
    const response = $.ajax({url:'api/dashboard/blog-activity/'+blogGoal,async:false,dataType:'json'}).responseJSON;
    // console.log(response);
    var tab = $('.tab-blog-activity');
    const icon = $('.blog-today').find('i');
    icon.addClass('rotate');
    tab.each(function(){
        let dataTab = $(this).attr('data-tab');
        let tabToggle = $('[tab="'+dataTab+'"]');
        $(this).find('.fs-4 span').html(response[dataTab].count);
        $(this).find('small.float-right').html(round(response[dataTab].percent,2)+'%');
        let ol = tabToggle.find('ol');
        ol.find('li').remove();
        for(i=0;i<response[dataTab].data.length; i++){
            let text  = response[dataTab].data[i].name_th;
            // let small = '';
            let industry = '';
            if(response[dataTab].data[i]?.industryName){
                industry = response[dataTab].data[i].industryName;
            }
            li = $('<li id="'+response[dataTab].data[i].industryId+'" industry="'+response[dataTab].data[i].industryName+'"><div class="list-item d-flex"><strong>'+industry+'</strong><a style="width:'+(blogListWidth - 212)+'px;">'+text+'</span></a></li>');
            if(dataTab=='blog-created' && response[dataTab].data[i].created_by!=null) {        
                small = $('<small class="list-item-right" blog-by="'+response[dataTab].data[i].created_by+'"><strong>By: </strong>'+response[dataTab].data[i].created_by+'</small>');
                li.children().append(small);
            }
            if(dataTab=='blog-online' && response[dataTab].data[i].published_by!=null) {
                let url = response[dataTab].data[i].name_th.replace(' ','-');
                a = li.find('a');
                a.attr('target','_blank')
                a.attr('href','/th/blog/'+url);
                small = $('<small class="list-item-right" blog-by="'+response[dataTab].data[i].published_by+'"><strong>By: </strong>'+response[dataTab].data[i].published_by+'</small>');
                li.children().append(small);
            }
            ol.append(li);
        }
        setTimeout(() => { icon.removeClass('rotate'); }, 500);
        
    })
}
const blogCalculateTheSum = () => {

}

$(document).on('click','.blog-more',function(){ 
    blogTodayShow(this)
});
$(document).on('click','.tab-blog-activity',function(){ 
    blogActivity(); 
    blogSummary($(this))  
});
$(document).on('click','.blog-today',function(){ blogActivity(); });
