(function($) {
    $.skRecommend = function(box, options) {
        var box = $(box);
        var defaults = {
            class: null,
            width: null,
            height: null,
            event: ''
        };
        var rcmDialog = $('<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\
            <div class="modal-dialog modal-lg">\
                <div class="modal-content">\
                    <div class="modal-header">\
                        Edit Recommend\
                    </div>\
                    <div class="modal-body">\
                        <div class="form-group">\
                            <label>ชื่อบริษัท</label>\
                            <input type="text" class="form-control" name="name" value="">\
                        </div>\
                        <div class="form-group">\
                            <label>URL</label>\
                            <input type="text" class="form-control" name="href" value="">\
                        </div>\
                    </div>\
                    <div class="modal-footer">\
                        <button class="btn btn-warning btn-block save">Save</button>\
                        <button class="btn btn-block cancel m-0" data-dismiss="modal">Cancel</button>\
                    </div>\
                </div>\
            </div>\
        </div>');

        const aeRecommend = () => {
            const defaultHTML = '<div class="recommend-ref"><div class="content"><h2>แนะนำบริษัทที่ให้บริการ<span style="color:orange;">กำหนดเอง</span></h2><ul><li class="position-relative"><p><a href="javascript:" class="text-dark">บริษัท...จำกัด</a><a class="delete-li" style="cursor:pointer; position:absolute; top:0; margin-left: 10px"><i class="fas fa-times"></i></a></p></li></ul></div></div>';
            const area = box;
            const edit = area.attr('contentEditable');
            const html = area.html();
            $('#onRecommend').prop('checked',true);
            if(edit=='false'){         
                box.html('');
                box.attr('contentEditable',true);            
                box.text((html=='')?defaultHTML:html);            
            }else{
                box.html('');            
                box.append($($.parseHTML(html)[0].textContent));
                if(area.find('.add-list').length == 0) box.prepend(addList);
                box.attr('contentEditable',false);
            }
        }

        const edit = (e) => {
            el = $(e);            
            rcmDialog.find('input[name="name"]').val(el.html());
            rcmDialog.find('input[name="href"]').val(el.attr('data-href'));
            rcmDialog.modal({backdrop:false,keyboard:false,show:true});
            rcmDialog.find('.save').on('click', function(){
                el.html(rcmDialog.find('input[name="name"]').val());
                el.attr('data-href', rcmDialog.find('input[name="href"]').val());
                rcmDialog.modal('hide');
            });
        }

        const addList = $('<a class="btn btn-sm btn-primary add-list" style="position:absolute; right:5px; top:5px; color:ghostwhite; cursor:pointer;"><i class="fas fa-plus fa-lg"></i></a>');
        if(box.find('li').length>0){
            box.append(addList);
        }
        const li = box.find('li');
        li.map(function(k,el){
            $(el).addClass("position-relative");
            $(el).find('p').append('<a class="delete-li" style="cursor:pointer; position:absolute; top:0; margin-left: 10px"><i class="fas fa-times"></i></a>');
            $(el).find('a').attr('href', 'javascript:');
            $(el).find('a').attr('id', 'list-'+k);
            $(el).find('a').removeAttr('target');
        })
        
  
        $(document).on('click','.recommend-edit', function(){
            aeRecommend()
        })
        $(document).on('click','#onRecommend',function(){
            if(!$('#onRecommend').is(':checked')){
                box.html('');
                box.attr('contentEditable',false);
            }else{
                aeRecommend()
            }
        });
        $(document).on('click','.add-list',function(){
            const area = box;
            const li = $('<li class="position-relative"><p><a href="javascript:" data-href="" class="text-dark">บริษัท...จำกัด</a><a class="delete-li" style="cursor:pointer; position:absolute; top:0; margin-left: 10px"><i class="fas fa-times"></i></a></p></li>');
            area.find('ul').append(li);
        });
        
        box.on('click','a.text-dark',function(){
            edit(this)
        });
    
        $(document).on('submit','#formEdit',function(e){
            box.find('.add-list').remove();
            const li = box.find('li');
            li.map(function(k,el){
                $(el).find('.delete-li').remove();
                let a = $(el).find('.text-dark');
                let href = $(el).find('.text-dark').attr('data-href');
                a.attr('href', href);
                // a.attr('target','_blank');
            })
            $('#recommend').val(box.html());
        })
        $(document).on('click','.delete-li',function(){
            const li = $(this).closest('li');
            if(confirm('ยืนยันลบ?')===true){
                li.remove();
            }
    
        })
        
    };
    $.fn.extend({
        skRecommend:function(options){
            options = $.extend({},options);
            this.each(function(){ new $.skRecommend(this, options); });
            return this;
        }
    });
})(jQuery);