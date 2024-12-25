const allUsers = $.ajax({
    url: '/webpanel/users/all',
    method: 'get',
    async: false
}).responseJSON;

const fetchUser = () => {
    let options = '<option hidden>Please select!</option>';
    allUsers.map(function(v,k){
        options += '<option value="'+v.id+'">'+ v.name +''+v.position+'</option>'
    })
    return options;
}

const Report = () => {
    const options = fetchUser();
    reportModal = $('<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\
        <div class="modal-dialog modal-lg">\
            <div class="modal-content">\
                <div class="modal-header">New problem report</div>\
                <div class="modal-body">\
                    <div class="form-group">\
                        <label>Problem</label>\
                        <textarea type="text" class="form-control" name="problem" value=""></textarea>\
                    </div>\
                    <div class="form-group">\
                        <label>Responsible</label>\
                        <select class="form-control" name="admin">'+options+'<select>\
                    </div>\
                    <div class="form-group">\
                        <label>Company</label>\
                        <input type="text" class="form-control" name="company-name">\
                        <input type="hidden" name="company" value="'+$('input[name="cp_id"]').val()+'">\
                    </div>\
                </div>\
                <div class="modal-footer">\
                    <button class="btn btn-warning btn-block save">Save</button>\
                    <button class="btn btn-block cancel m-0" data-dismiss="modal">Cancel</button>\
                </div>\
            </div>\
        </div>\
    </div>');
    reportModal.find('input[name="company-name"]').val($('input[name="name_th"]').val()+ ' / ' + $('input[name="name_jp"]').val())
    reportModal.modal({backdrop:false});
}
$(document).on('click','.new-report',function(){
    Report()
})