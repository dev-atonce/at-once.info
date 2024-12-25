(function($) {
    $.hunterPopup = function(box, options) {
        var box = $(box);
        var defaults = {
            title: 'Popup',
            placement: 'left',
            minWidth: '650',
            width: '100%',
            height: '100%',
            content: $('<div><h3>Popup</h3></div>'),
            resetBtn : '.all-reset',
            event: closePopup
        };
        var obj = $.extend(defaults, options);       
        var category = window.location.pathname.split('/')[2];
        // const borderColor = bg.replace('bg','border');
        var template = $('<div class="Hunter-pop-up border-1x --border-blue" id="Hunter-pop-up"><a class="close"><i class="glyphicon glyphicon-remove"></i></a><div class="arrow"></div><h3 class="title --c-blue --border-b-blue"></h3><div id="Hunter_pop_wrap" class="Hunter-wrap"></div></div>');
        var title = $('.title', template);
        var pop_wrap = $('#Hunter_pop_wrap', template);

        $(document).on('click',function() {
            template.remove();
        });

        var $sticky = $("#sticky-filter"); 
        OffSet = $sticky.offset();
        y_pos = (typeof OffSet !== typeof undefined)?OffSet.top:0;
        height = (typeof $sticky !== typeof undefined)?$sticky.height():0;

        box.click(function(event) {

            event.preventDefault();
            event.stopPropagation();
            $('.Hunter-pop-up').remove();
            var _this = $(this);
            var offset = _this.offset();
            var top = offset.top + _this.outerHeight() + 11;
            var right = ($(window).width() - (offset.left + _this.outerWidth()));
            

            template.addClass('popup-'+_this.attr('id'));
            template.find('style')?.remove();
            template.append('<style>.Hunter-pop-up:before{left: ' + (offset.left - (_this.outerWidth()/2) - 50) + 'px !important;}</style>')
            template.append('<style>.Hunter-pop-up:after{left: ' + (offset.left - (_this.outerWidth()/2) - 50) + 'px !important; border-color:transparent transparent var(--border-blue)}</style>')
            
            if (obj.placement == 'left') { 
                template.css({'left':offset.left,'top':top }); } 
            else if(obj.placement == 'center') { 
                $(template,'.Hunter-pop-up').addClass('Hunter-pop-up-center');
                template.css({ 'left':($(window).width()/2)-(obj.width/2),/*offset.left+((_this.width()-obj.width)/2)*/'top': top }); }
            else {
                template.addClass("Hunter-pop-up-right");
                template.css({/*'left': offset.left-obj.width+_this.width()/2,*/'left': ($(window).width() / 2.3),'right': right,'top': top,});
            }
            buildPopup();
            $('body').append(template);
            $('.Hunter-pop-up').click(function(event) {
                event.stopPropagation();
            });
            $('a.qa-title').click(function(){
                $(this).find('i.fa-chevron-left').toggleClass('rotate');
            })
            obj.event();
            $('.ok-list').click(function(){ template.remove(); });
          
            // $('.choice').on('click',function(){keywordStorage($(this))});
        });
   


        // $(document).scroll(function() {
        //     var scrollTop = $(this).scrollTop();
        //     if (!device.isIpad() && width > 768) {
        //         if (scrollTop > y_pos) {
        //             template.addClass('popup-sticky');
        //             template.remove()
        //         } else if (scrollTop <= (y_pos+height) ) {
        //             template.removeClass('popup-sticky');
        //         }
        //     }
        // });
        var text=[], id=[], bname = box.next().attr('name');
        function keywordStorage(e)
        {
            // clearStorage();
            // return false;

            const val = parseFloat(e.val());

            if(e.is(':checked')){
                if($.inArray(e.attr('text'),text)<0){ text.push(e.attr('text')); id.push(val); }
            }else{
                const i = id.indexOf(val);
                if(i > -1){ text.splice(i,1); id.splice(i,1); }
            }
            
            var local = JSON.parse(window.localStorage.getItem('filters'));
            switch (getState(local,bname)) {
                case true:
                    let x = getIndex(local,bname);
                    if(bname.toString()==local[x].name.toString()){
                        local[x].data.text = text;
                        local[x].data.id = id;
                    }
                    break;            
                default:
                    if(local!=null){                        
                        // local.push({'name':bname,'data':{'text':text,'id':id}});
                    }else{
                        local=[];
                        local.push({"name":bname,"data":{"text":text,'id':id}});
                    }
                    break;
            };

            window.localStorage.setItem('filters',JSON.stringify(local));

     
        }
        function log(){
            console.log(window.localStorage.getItem('filters'));
        }
        function clearStorage()
        {
            window.localStorage.removeItem('filters');
        }
        function getState(data,name){for(var x in data){if(data[x].name.toString()==name.toString()) return true;} return false;}
        function getIndex(data,name){for(var x in data){if(data[x].name.toString()==name.toString()) return parseInt(x);} return parseInt(-1);}

        
        $('.resetChoice').click(function(){
            reset()
        })
        $(document).on('click',obj.resetBtn,function(){
            obj.content.find('input[type="checkbox"]').prop('checked',false);
            box.html(box.attr('title'));
            box.next().val('');
            box.removeAttr('reset');
            box.removeClass(color);
        })
 

        function buildPopup() {
            buildPopupContent();
            closePopup();
            
        };

        function buildPopupContent() {
            title.text(obj.title);

            var _content = obj.content;

            if(box.attr('reset') !== undefined) {
                _content.find('input[type="checkbox"]').prop('checked',false);                
                box.removeAttr('reset');
            }
            _content.show();
            pop_wrap.children().remove();
            pop_wrap.append(_content);
            // pop_wrap.width(obj.width);
            pop_wrap.height(obj.height);

        };
        function reset()
        {
            template.find('input').prop('checked',false);
            template.find('select').prop('selectedIndex',0);
        }

        function closePopup() {
            template.on('click', '.close', function(event) {
                event.preventDefault();
                event.stopPropagation();
                template.remove();
            });
        }
     
    };

    $.fn.extend({
        hunterPopup: function(options) {
            options = $.extend({}, options);
            this.each(function() {
                new $.hunterPopup(this, options);
            });
            return this;
        }

    });
})(jQuery);

