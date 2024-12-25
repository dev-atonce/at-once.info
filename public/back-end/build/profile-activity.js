const profileBox = $('#todayActivity');
const profileWidth = profileBox.find('._card').width();
const listWidth = profileBox.find('._card-body').width();
const goalCreated = 80;
const goalDesign = 46;
const goal = 80;
const more = {
    css : {  'z-index': '1000','width': profileWidth+'px' },
    button: {
        more: 'fa-angle-left',active: 'fa-angle-down',
    },
    position: { relative:'position-relative', absolute:'position-absolute' }
};

profileBox.find('.list-item').find('span').css({width:listWidth-252});
profileBox.find('.list-item').find('a').css({width:listWidth-252});

$(document).on('click','.today-more',function(){ todayShow(this); });

function todayShow(el){

    moreButton = $(el); 
    more.css.width = profileBox.find('._card').width() + 'px';
    //toggle class
    moreButton.find('i').toggleClass(more.button.more+' '+more.button.active);
    moreButton.parent().addClass(more.position.absolute);
    //card content
    toggleContent = moreButton.closest('._card');
    if (toggleContent.hasClass('position-absolute')) {
      toggleContent.removeClass(more.position.absolute).removeAttr('style');
    //   moreButton.closest('.p1').removeAttr('style');
      moreButton.closest('.row').next().toggleClass('d-none d-block');
      $('.profile-remainning').removeClass('d-none');
      
    } else {    
      toggleContent.addClass(more.position.absolute).css(more.css);      
    //   moreButton.closest('.p1').css('margin-bottom','54px');
      moreButton.closest('.row').next().toggleClass('d-none d-block');
      
      $('.profile-remainning').addClass('d-none');
    }  
    currentTab = $('[tab="created"]').find('ol');
    if(currentTab.height()>523){
      currentTab.addClass('scroll-y');
    }
}



summary = (el) => {
  var tab = $('.tab-today-activity');
  var totolElm = $('.profile-total');
  var byElm = $('.profile-by');
  var categoryId = [];
  var categoryName = [];
  var byName = [];
  
  if (typeof el == typeof undefined) {
        var tabActive = $('[tab="created"]');
    // var tabActive = $('[tab="'+el.attr('data-tab')+'"]');
    if(tabActive.find('li').length>0){
      tabActive.find('li').each(function(){
        // console.log($(this).attr('no-record'));
        if($(this).attr('no-record') != ''){
          id = $(this).attr('id');
          category = $(this).attr('category');
          by = $(this).find('small').attr('by');
          if($.inArray(id,categoryId) === -1) categoryId.push(id);
          if($.inArray(category,categoryName) === -1) categoryName.push(category);
          if($.inArray(by,byName) === -1) byName.push(by);
          tabActive.find('li');
        }
      });   
      if(tabActive.find('ol').height()>523){
        tabActive.find('ol').addClass('scroll-y');
      }   
    }    
  } else {
    var tabActive = $('[tab="'+el.attr('data-tab')+'"]');
    el.addClass('text-primary');
    tab.not(el).removeClass('text-primary');
    $('[tab-toggle="today-activity"]').addClass('d-none');
    tabActive.removeClass('d-none');
    let id='';
    let category='';
    tabActive.find('li').each(function(){
      console.log($(this).attr('no-record'));
      if($(this).attr('no-record') != ''){
          id = $(this).attr('id');
          category = $(this).attr('category');
          by = $(this).find('small').attr('by');
          if($.inArray(id,categoryId) === -1) categoryId.push(id);
          if($.inArray(category,categoryName) === -1) categoryName.push(category);
          if($.inArray(by,byName) === -1) byName.push(by);
      }
    });
    if(tabActive.find('ol').height()>523){
      tabActive.find('ol').addClass('scroll-y');
    }
  }
  totolElm.html('<strong>Total:&nbsp;</strong>');
  byElm.html('<strong>By:&nbsp;</strong>');
  // console.log(byName);
  if(categoryName.length>0 ) { 
    let profileTotal = '';
   
    $.each(categoryId,function(i,v){
      if (i>0) profileTotal += ',&nbsp;';
      profileTotal += '[ ' + categoryName[i] + ' : ' + tabActive.find('li').map(function(){ if($(this).attr('id')==v ) return true }).get().length + ' ]';      
    });
    totolElm.append(profileTotal);
  
    let profileBy = '';

    $.each(byName,function(i,v){
        if (i>0) {
          profileBy += ',&nbsp;';
        }
        profileBy += '[ ' + byName[i] + ' : ' + tabActive.find('small').map(function(){ if($(this).attr('by')==v ) return true }).get().length + ' ]';
    })
    byElm.append(profileBy);
  }
  
}
summary();
function round(num, decimalPlaces = 0) {
    if (num < 0)
        return -round(-num, decimalPlaces);
    var p = Math.pow(10, decimalPlaces);
    var n = num * p;
    var f = n - Math.floor(n);
    var e = Number.EPSILON * n;

    // Determine whether this fraction is a midpoint value.
    return (f >= .5 - e) ? Math.ceil(n) / p : Math.floor(n) / p;
}
todayActivity = () => {
  const response = $.ajax({url:'api/dashboard/today-activity/'+goal+'/'+goalCreated+'/'+goalDesign,async:false,dataType:'json'}).responseJSON;
  var tab = $('.tab-today-activity');
  const icon = $('.today').find('i');
  const noData = $('<li style="list-style:none;" class="text-center" no-record="">No Record.</li>');
  icon.addClass('rotate');
  tab.each(function(){
    let dataTab = $(this).attr('data-tab');
    let tabToggle = $('[tab="'+dataTab+'"]');
    $(this).find('.fs-4 span').html(response[dataTab].count);
    $(this).find('small.float-right').html(round(response[dataTab].percent,2)+'%');
    let ol = tabToggle.find('ol');
    
    ol.find('li').remove();
    if(response[dataTab].data.length>0){
      for(i=0;i<response[dataTab].data.length; i++){
        let text  = (response[dataTab].data[i].name_en==null)?response[dataTab].data[i].name_th:response[dataTab].data[i].name_en;
        let small = '';
        
        
        let li = $(`<li id="${response[dataTab].data[i].category_id}" category="${response[dataTab].data[i].category}"><strong>${response[dataTab].data[i].category}</strong>&nbsp;<a>${text}</a></li>`);
        if(dataTab=='step1' && response[dataTab].data[i].by!=null) {        
          small = $('<small class="float-right" by="'+response[dataTab].data[i].by+'"><strong>By: </strong>'+response[dataTab].data[i].by+'</small>');
          li.append(small);
        }
        if(dataTab=='step2' && response[dataTab].data[i].by!=null) {
          small = $('<small class="float-right" by="'+response[dataTab].data[i].by+'"><strong>By: </strong>'+response[dataTab].data[i].by+'</small>');
          li.append(small);
        }
        if(dataTab=='step3' && response[dataTab].data[i].by!=null) {
          small = $('<small class="float-right" by="'+response[dataTab].data[i].by+'"><strong>By: </strong>'+response[dataTab].data[i].by+'</small>');
          li.append(small);
        }
        if(dataTab=='step4' && response[dataTab].data[i].by!=null) {
          a = li.find('a');
          a.attr('target','_blank')
          a.attr('href','/th/'+response[dataTab].data[i].key+'/cp/'+response[dataTab].data[i].profile_url);
          small = $('<small class="float-right" by="'+response[dataTab].data[i].by+'"><strong>By: </strong>'+response[dataTab].data[i].by+'</small>');
          li.append(small);
        }

        if(response[dataTab].data[i].type == 'basic' && dataTab == 'step2' || dataTab == 'step3' || dataTab == 'step4'){
            let profileType = (response[dataTab].data[i].type == 'basic')?$(`<span class="badge badge-secondary text-info ml-1">Basic</span>`):``;
            profileType?.insertBefore(li.find('small'));
        }

        ol.append(li);
      }
    }else{
      $('.profile-list').each(function(){
        if($(this).find('li').length == 0){
          $(this).append(noData);
        }
      })
      
    }
    setTimeout(() => {
      icon.removeClass('rotate');
    }, 500);
    
  })
}

$(document).on('click','.business-more',function(){
  $this = $(this);
  let width = $this.closest('.col-sm-6').width();
  $this.find('i').toggleClass('fa-angle-down fa-angle-left');
  let more = $this.closest('._card-body').find('.more-area');
  
  if(more.hasClass('d-none')) {
    more.removeClass('d-none');
    $this.closest('.card').css({'width':width,'height':190,'z-index':'888'})
    $this.closest('.card').addClass('position-absolute')
  }else{
    more.removeClass('position-absolute').addClass('d-none');
    $this.closest('.card').removeAttr('style')
    $this.closest('.card').removeClass('position-absolute');
  }
});
$(document).on('click','.tab-today-activity',function(){ blogActivity(); summary($(this)) });
$(document).on('click','.today',function(){ todayActivity(); });

$(document).on('click','.print-today',function(){
  let css = '@page{size:"A4";} @media print {\
    .tab-today-activity{-webkit-print-color-adjust:exact;}\
    .tab-today-activity.text-primary{display:block !important;-webkit-print-color-adjust:exact;font-weight:bold;}\
    a.today,a.print-today,a.today-more{display:none !important;}}';
  printDiv('todayActivity',css);
})
$(document).on('click','.online-print',function(){ 
  let css = '@media print{ @page{size: A3 landscape}.table-bordered{border:1px solid;border-color:#d8dbe0;}.table{width:100%;margin-bottom:1rem;color:#4f5d73;}table{border-collapse:collapse;}table tr td{-webkit-print-color-adjust:exact}.online-print{display:none;}}';
  printDiv('onlineTable',css);
})