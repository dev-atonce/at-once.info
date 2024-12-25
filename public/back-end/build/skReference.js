(function($) {
    $.skReference = function(box, options) {
        var box = $(box);
        var defaults = {
            class: null,
            width: null,
            height: null,
            event: ''
        };
        var no = 0;
      
        var refDialog = $('<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\
            <div class="modal-dialog modal-lg">\
                <div class="modal-content">\
                    <div class="modal-header">Reference</div>\
                    <div class="modal-body">\
                        <div class="form-group">\
                            <label>หัวข้อ:</label>\
                            <input type="text" class="form-control" name="ref-title" value="">\
                        </div>\
                        <div class="form-group">\
                            <label>ลิ้งค์:</label>\
                            <input type="text" class="form-control" name="ref-name" value="" placeholder="ชื่อลิ้งค์">\
                            <input type="text" class="form-control mt-3" name="ref-link" value="" placeholder="ลิ้งค์">\
                        </div>\
                    </div>\
                    <div class="modal-footer">\
                        <button class="btn btn-warning btn-block save">Save</button>\
                        <button class="btn btn-block cancel m-0" data-dismiss="modal">Cancel</button>\
                    </div>\
                </div>\
            </div>\
        </div>');
        const addBtn = $('<div class="ref-tools"><div class="float-right"><button type="button" class="btn btn-sm btn-primary add-ref"><i class="fas fa-plus fa-lg"></i></button></div></div>');
        const deleteBtn = $('<a class="ref-delete" style="cursor:pointer; position:absolute; display:inline-block; margin-left: 10px"><i class="fas fa-times"></i></a>');
        const add = () => {
            const p = $('<p style="cursor:pointer"><strong class="ref-title ref-edit">ที่มา</strong>: <a href="javascript:" data-href="" class="ref-link ref-edit" target="_blank">ชื่่อลิ้งค์</a> <a class="ref-delete" style="cursor:pointer; position:absolute; display:inline-block; margin-left: 10px"><i class="fas fa-times"></i></a></p>');
            box.append(p);
            no++;
        }
        function edit(e){
            el = $(e);
            cur = el.parent();
            refDialog.find('input[name="ref-title"]').val(cur.find('.ref-title').html());
            refDialog.find('input[name="ref-name"]').val(cur.find('.ref-link').html());
            refDialog.find('input[name="ref-link"]').val(cur.find('.ref-link').attr('data-href'));
            refDialog.modal({backdrop:false,show:true});
            refDialog.find('.save').on('click',function(){
                cur.find('.ref-title').html(refDialog.find('input[name="ref-title"]').val());
                cur.find('.ref-link').html(refDialog.find('input[name="ref-name"]').val());
                cur.find('.ref-link').attr('data-href', refDialog.find('input[name="ref-link"]').val());
                refDialog.modal('hide');
            });
        }
        function fetchData() {
            if(box.html()==''){
                box.append(addBtn);                
            }else{
                box.prepend(addBtn);
                let p = box.find('p');
                p.map(function(k,v){
                    $(v).css("cursor","pointer");
                    $(v).find('strong').addClass('ref-edit');
                    let link = $(v).find('.ref-link');
                    link.addClass('ref-edit');
                    link.attr('href','javascript:');
                    $(v).append(deleteBtn);
                }); 
            }
        }
        fetchData()        
       
        $(document).on('click','.add-ref',function(){add()});
        $(document).on('click','.reference-edit',function(){
            const current = $(this);
            editable = current.next().attr('contenteditable');
            if(editable == 'false'){
                current.next().attr('contenteditable',true);
                let obj = current.next().clone();
                obj.find('.ref-tools').remove();
                current.next().text(obj.html());                
            }else{
                let text = $('.reference').text();
                let obj = $(text);
                current.next().attr('contenteditable',false);
                current.next().html('');
                $('.reference').append(addBtn);
                $('.reference').append(obj);
            }
            
        })
        $(document).on('click','.ref-edit',function(){ edit(this) });
        $(document).on('click','.ref-delete',function(){let e = $(this).closest('p'); if(confirm('ยืนยันลบ')===true){e.remove();}});
        $(document).on('submit','form',function(e){
            // e.preventDefault();
            let p = box.find('p');
            p.map(function(k,v){
                $(v).removeAttr('style');
                $(v).find('strong').removeClass('ref-edit');
                let link = $(v).find('.ref-link');
                link.removeClass('ref-edit');
                link.attr('href',link.attr('data-href'));
                $(v).find('.ref-delete').remove();
            });   
            box.find('.ref-tools').remove();       
            $('#reference').val($('.reference').html());
            // console.log($('#reference').val());
        })
        
        
    };
    $.fn.extend({
        skReference:function(options){
            options = $.extend({},options);
            this.each(function(){ new $.skReference(this, options); });
            return this;
        }
    });
})(jQuery);