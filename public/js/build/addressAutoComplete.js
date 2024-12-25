/**
* 
* @author HOCKY
* Version 0.2
* 
**/

(function($) {
    $.addressAuto = function(box,options){
        var box = $(box);
        var defaults = {
            district : '#district',
            subdistrict : '#subdistrict',
            postcode : '#postcode',
            displayAuto : '#displayAuto',
            language : 'th'
        //    textDefault : 'กรุณาเลือก'
        };
        var obj = $.extend(defaults,options);
        var url = window.location.origin;
        var offset = box.offset(),
            theme = $('<ul id="ad-auto" class="ad-auto" style="list-style-type:none;"></ul>'),
            thisId= theme.attr('id');
            
        theme.css({
            'display' : 'none',
            // top : (obj.top==null)?offset.top + box.outerHeight():obj.top,
            // left : offset.left,
            'width' : 'calc(100% - 30px)',
            'z-index': 99
        })

        $('body').append(theme);
   
        box.on('keypress keyup',function(){
            theme.html('');
            $('#'+thisId).html('');
            $('#'+thisId).css('display','block');
  
            $.ajax({url:url+'/address/get/postcode',data:{s:$(this).val(),hl:obj.language},dataType:'json',success:function(res){

                $.each(res,function(i,k){
                    let li = $("<li data-val='"+JSON.stringify(k)+"'></li>");
                    if (k.provinceId==1) 
                        li.append('<span> แขวง'+k.subdistrict.trim()+', '+k.district.trim()+', '+k.province+', <span><strong class="bold">'+k.postcode+'</strong>');
                    else 
                        li.append('<span> ต.'+k.subdistrict.trim()+', อ.'+k.district.trim()+', จ.'+k.province+', </span><strong class="bold">'+k.postcode+'</strong>');
                        theme.append(li);
                });
            }})
           
        })
        $(obj.displayAuto).append(theme);
        
        box.click(function(){
            if($('#'+thisId).find('li').length>0){
                $('#'+thisId).css('display','block');
            }
        })
        $(document).on('click','#'+thisId+' li',function(){
            let data = $(this).data('val');
            $(obj.subdistrict).val(data.subdistrict.trim());
            $(obj.district).val(data.district.trim());
            $(obj.province).val(data.province.trim());
            $('#'+thisId).css('display','none');
            $('input[name="postcode"]').val(data.postcode);
            $('input[name="subdistrict"]').val(data.subdistrictId);
            $('input[name="district"]').val(data.districtId);
            $('input[name="province"]').val(data.provinceId);
        })
        // $(document).on('click').not()

    };

    $.fn.extend({
       addressAuto : function(options){
           options = $.extend({}, options);
           this.each(function(){
               new $.addressAuto(this, options);
           })
           return this;
       }
    });

})(jQuery);