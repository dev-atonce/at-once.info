var fullUrl = window.location.origin+'/webpanel/order';

if($('#page-index').length>0)
{
    $('#selectAll').on('click',function(){
        if($(this).is(':checked')){ $('#delSelect').prop('disabled',false);$('.ChkBox').prop('checked',true) }else{ $('#delSelect').prop('disabled',true); $('.ChkBox').prop('checked',false) }
    })
    $('.ChkBox').click(function(){
        const checked = []; const $this = $(this).prop("checked");
        $('.ChkBox').each(function(){ if($(this).is(':checked')){ checked.push($this) } })
        if(checked.length>0){ $('#delSelect').prop('disabled',false); }else{ $('#delSelect').prop('disabled',true); }
    })
    $('.deleteItem').on('click',function(){
        const id =[$(this).data('id')]; if(id.length>0){ destroy(id) }
    })
    $('#delSelect').on('click',function(){
        const id = $('.ChkBox:checked').map(function(){ return $(this).val() }).get(); if(id.length>0){ destroy(id) }
    })
}
$('.to-shipping').click(function(){
    Swal.fire({
        title:'กรอกหมายเลขจัดส่งสินค้า',
        input:'text',
        inputPlaceholder: 'หมายเลขจัดส่ง',
        inputAttributes: {
            autocapitalize: 'on'
        },
        showCancelButton: true,
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            if (!value) { return 'กรุณากรอกหมายเลขจัดส่งสินค้า' }
        },
        preConfirm: (input) => {
            return fetch(fullUrl+'/change/status?s=shipping&id='+$('input[name="id"]').val()+'&no='+input)
                .then(response => { if (!response.ok) { throw new Error(response.statusText) }else{ /*return response.json()*/ location.reload() } })
                .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`) })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})
$('.to-cancel').click(function(){
    Swal.fire({
        title : 'ยืนยันยกเลิก Order',
        text : 'กดปุ่ม OK เพื่อยกเลิก Order',
        icon: 'warning',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor:'#e55353',
        preConfirm: (input) => {
            return fetch(fullUrl+'/change/status?s='+$(this).data('status')+'&id='+$('input[name="id"]').val()+'&no='+input)
            .then(response => { if (!response.ok) { throw new Error(response.statusText) }else{ location.reload() } })
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`) })
        }
    })
});
$('.noti').on('click',function(){
    Swal.fire({
        imageUrl: $(this).data('proof'),
        imageWidth: 400,
        imageHeight: 'auto',
      })
})
$('.change-status').on('click',function(){
    const status = $(this).data('status');
    const F = status.substr(0, 1);
    Swal.fire({
        title : 'Confirm to change status to "'+F.toUpperCase()+status.substr(1)+'"',
        text : 'Click OK Button to Save',
        icon: 'warning',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor:'#e55353',
        preConfirm: (input) => {
            return fetch(fullUrl+'/change/status?s='+$(this).data('status')+'&id='+$('input[name="id"]').val()+'&no='+input)
            .then(response => { if (!response.ok) { throw new Error(response.statusText) }else{ location.reload() } })
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`) })
        }
    })
})
function destroy(id)
{
    Swal.fire({
        title:"Delete data?",text:"Once the data has been deleted from the trash, You will not be able to recover it.",icon:"warning",showCancelButton:true,confirmButtonColor:"#DD6B55",showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(fullUrl+'/destroy?id='+id)
            .then(response => response.json())
            .then(data => location.reload())
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    });
}
