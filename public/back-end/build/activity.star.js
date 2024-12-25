var pageIndex = document.getElementById('page-index');
var pageEdit= document.getElementById('page-edit');
var pageAdd= document.getElementById('page-add');
var btnRemove = document.querySelectorAll('.btn-remove');
for(i=0; i<btnRemove.length; i++)
{
    btnRemove[i].addEventListener('click',function(){
        let cur = this;
        let id = cur.getAttribute('data-id');
        let action = cur.getAttribute('action');
        let data = null; 
        if (action=='trash') {
            data  = {
                id : id,
                action: 'trash',
                text:{icon:'warning',title:'ย้ายไปยังถังขยะ!',text:'ข้อมูลจะถูกย้ายไปยังถังขยะ',},
                success:{icon:'success',title:'สำเร็จ!',text:'ข้อมูลถูกย้ายไปยังถังขยะแล้ว'},
                error:{icon:'error',title:'อ๊ะ!',text:'บางอย่่างผิดพลาดกรุณาทำรายการใหม่'}
            }
        } 
        if (action=='delete') {
            data = {
                id : id,
                action: 'delete',
                text:{icon:'warning',title:'ยืนยันลบข้อมูล!',text:'เมื่อข้อมูลถูกลบแล้วจะไม่สามารถกู้คืนข้อมูลได้'},
                success:{icon:'success',title:'สำเร็จ!',text:'ลบข้อมูลแล้ว'},
                error:{icon:'error',title:'อ๊ะ!',text:'บางอย่่างผิดพลาดกรุณาทำรายการใหม่'}
            }
        }
        trash(data);
    })
}
var buttons = document.querySelectorAll('.tab');
for(i=0; i<buttons.length; i++)
{
    buttons[i].addEventListener('click',function(){
        let cur = this;
        let curClick = cur.getAttribute('toggle-area');
        let thisToggle = cur.getAttribute('tab-toggle');
        // let toggle = (thisToggle==true)?false:true;
        let tab = document.getElementById(curClick);
        let allTab = document.querySelectorAll('[area-toggle="tab"]');
        for(j=0; j<allTab.length; j++){
            allTab[j].setAttribute('tab-toggle',false);
        }
        tab.setAttribute('tab-toggle',true);
        for(k=0; k<buttons.length; k++){buttons[k].setAttribute('tab-toggle',false)}
        cur.setAttribute('tab-toggle',true);
    })
}

var unlimited = document.getElementById('unlimited');

if(pageEdit!=null || pageAdd!=null) {

    var datetime = document.querySelectorAll('[type="date"]');
    var company = document.getElementById('company');
    var companyData = JSON.parse(company.getAttribute('data-value'));

    if(companyData!=null){
        var selected = JsonToArray(companyData);
        for(i=0; i<company.length; i++){
            if(selected.indexOf(Number(company[i].getAttribute('value')))>-1){ company[i].setAttribute('selected',true); }
        }
    }
    unlimited.addEventListener('click',function(){
        if(this.checked){
            for(i=0;i<datetime.length;i++){datetime[i].setAttribute('readonly','readonly');}
        }else{            
            for(i=0;i<datetime.length;i++){datetime[i].removeAttribute('readonly');}
        }
    });
    new SlimSelect({select:'#company'});

}




var btnRestore = document.querySelectorAll('.btn-restore');
for(i=0;i<btnRestore.length;i++){
    btnRestore[i].addEventListener('click',function(){
        let cur = this;
        let id = cur.getAttribute('data-id');
        Swal.fire({
            icon:'warning',
            title:'กู้คืนข้อมูล!',
            text:'คุณต้องการทำรายการนี้ใช่หรือไม่',
            showCloseButton: true,
            showCancelButton: true,
            // confirmButtonColor:'#e55353',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch('webpanel/activity/star/restore/'+id)
                .then(response => { if (!response.ok) { throw new Error(response.statusText) } return response.json() })
                .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
            }
        }).then((result) => {
            if (result.value === true) { Swal.fire({icon:'success',title:`สำเร็จ!`,text:'นำข้อมูลออกจากถังขยะแล้ว'}).then(function(){window.location.reload()}) }
            if (result.value === false){ Swal.fire({icon:'error',title:`อ๊ะ!`,text:'บางอย่างผิดพลาดกรุณาทำรายการใหม่'}) }
        })
    })
}



function JsonToArray(data){
    let array = [];
    data.forEach(function(v,i){
        array.push(v.company)
    })
    return array;
}

function trash(data)
{
    Swal.fire({
        icon: data.text.icon,
        title: data.text.title,
        text: data.text.text,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonColor:'#e55353',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch('webpanel/activity/star/'+data.action+'/'+data.id)
            .then(response => { if (!response.ok) { throw new Error(response.statusText) } return response.json() })
            .catch(error => { Swal.showValidationMessage(`Request failed: ${error}`)})
        }
    }).then((result) => {
        if (result.value === true) { Swal.fire({icon:data.success.icon,title:data.success.title,text:data.success.text}).then(function(){window.location.reload()})}
        if (result.value === false){ Swal.fire({icon:data.error.icon,title:data.error.title,text:data.error.text}) }
    })
}