<div class="row">
    <div class="col-lg-12">
        <div class="card waiting-for-create">
            <div class="card-header card-header d-flex">
                <div class="mb-0 fs-18 d-flex align-items-center">
                    <span>2. Waiting For Create</span>
                    <span class="badge badge-info mx-1 count-on-create">0</span>
                    <a class="badge badge-info refresh-for-create refresh" title="Refresh" href="javascript:">
                        <i class="fas fa-sync-alt fs-12"></i>
                    </a>
                </div>
                <div class="ms-auto col-auto form-inline">
                    <strong class="mr-2">Filter: </strong>
                    <div class="badge badge-lightpink br-3x fs-12 dropdown user-assignment cursor" title="Assigment">
                        <span class="fas fa-filter"></span>
                        <input type="hidden" name="assignment">
                    </div>
                    <select name="user" class="form-control form-control-sm br-15 cs-droplist ml-2">
                        <option value="">All Users</option>
                        @foreach(\App\Models\UsersMd::whereIn('name',['NAMFON','JASMINE','FERN'])->get() as $k => $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-sm br-15 ml-2 filter_category" name="category"><option value="">Category</option><select>
                    <div class="mx-2">
                        {{-- <button class="btn btn-falcon-default" id="job_progress_date"><i class="far fa-calendar-alt"></i>&nbsp;  Date</button> --}}
                        <input type="text" 
                            id="waiting_daterange" 
                            class="form-control form-control-sm br-15" 
                            name="daterange" 
                            style="background-color:whitesmoke;"
                            placeholder="DD/MM/YYYY - DD/MM/YYYY"
                            autocomplete="new-daterange"
                        >  
                    </div>
                    <input type="text" name="keyword" class="form-control form-control-sm br-15" placeholder="Search Company Name...">
                    <button class="btn btn-outline-primary br-15 ml-2" type="submit"><i class="fas fa-search-plus"></i></button>
                    <button class="btn btn-outline-danger br-15 ml-2 reset" type="reset"><i class="fas fa-history"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="CsStock">
                        <thead class="table-light fw-semibold">
                            <tr>
                                <th width="3%" rowspan="2" class="text-center align-middle">No.</th>
                                <th width="25%" rowspan="2" class="align-middle">Company Name</th>
                                <th width="8%" rowspan="2" class="align-middle">Tel & Email</th>               
                                <th width="5%" rowspan="2" class="text-center align-middle">Ranking</th>
                                <th width="5%" rowspan="2" class="text-center align-middle">Assign</th>
                                <th width="5%" rowspan="2" class="text-center align-middle">Created Date</th>
                                <th width="5%" rowspan="2" class="text-center align-middle">Booking<br>Content</th>
                                <th width="5%" rowspan="2" class="text-center align-middle">Booking<br>Design</th>
                                <th colspan="3" class="text-center border-left p-1">AVG. Statistics/Month</th>
                            </tr>
                            <tr>
                                <th width="6%" class="text-center border-left p-1">Page view</th>
                                <th width="6%" class="text-center border-left p-1">User</th>
                                <th width="6%" class="text-center border-left p-1">Country</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>  
                    </table>   
                </div>  
            </div> 
        
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-dark btn-sm br-l-15 prev-page" disabled="">< Prev</button>
                            </div>
                            <select class="form-control form-control-sm border-dark page" name="page"></select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark btn-sm br-r-15 next-page" disabled="">Next ></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"></div>
                </div>
            </div> 
        </div>  
    </div>
</div>


<script>
    $('#waiting_daterange').daterangepicker({ 
        // autoApply: true, 
        autoUpdateInput: false,
        locale: {format: 'DD/MM/YYYY'}
    });
    $('#waiting_daterange').on('apply.daterangepicker',function(ev, picker){
        $(this).val(`${picker.startDate.format('DD/MM/YYYY')}-${picker.endDate.format('DD/MM/YYYY')}`);
    });
    // var userName = document.querySelector('input[name="user_name"]').value;
    var RowContent = document.querySelector('#RowModal');
    var RowModal = new bootstrap.Modal(RowContent,{ backdrop: false, keyboard: true});
    // var userId = parseInt(`{{Auth::user()->id}}`);
    // var RowCategorySelect = new SlimSelect({select:'#row_category',placeholder:'Please Select'});
    // var ImportCategorySelect = new SlimSelect({select:'#import_category',placeholder:'Please Select'});
    // var ImportContent = document.querySelector('#ModalImport');
    // var ImportModal = new bootstrap.Modal(ImportContent,{backdrop: false,keyboard: true});
    var required = document.createElement('i'); 
        required.setAttribute('class','text-danger ml-2'); 
        required.innerHTML = `* กรุณาเลือก`;
    var Categories;
    var appendTo = document.querySelector('.waiting-for-create');
    Draggable(RowContent);
    // All categories main => sub => category
 
        
    // const companyId = e.target.closest('.company-indentity');
    // if(companyId){
    //     getRow(companyId.getAttribute('data-id')).then(res=>{
    //         RowCategorySelect.config.isEnabled = false;
    //         const name_th = RowContent.querySelector('[name="name_th"]');
    //         const name_en = RowContent.querySelector('[name="name_en"]');
    //         const category = RowContent.querySelector('[name="category"]');

    //         const telephone = RowContent.querySelector('[name="telephone"]');
    //         const email = RowContent.querySelector('[name="email"]');
    //         const website = RowContent.querySelector('[name="website"]');
    //         RowContent.querySelector(`button.update-row`).classList.add('d-none');
    //         RowContent.querySelector('.action-edit').classList.remove('d-none');
    //         RowContent.querySelector('button.update-cid').classList.remove('d-none');
    //         RowContent.querySelector('button.update-cid').setAttribute('data-id',res.id);
    //         name_th.value = res.name_th;
    //         name_en.value = res.name_en;
    //         name_th.setAttribute('readonly',true);
    //         name_en.setAttribute('readonly',true);
    //         category.value = res.category;
    //         category.setAttribute('readonly',true);
    //         RowCategorySelect.setSelected(res.category);        
    //         telephone.value = res.telephone;
    //         telephone.setAttribute('readonly',true);
    //         email.value = res.email;
    //         email.setAttribute('readonly',true);
    //         website.value = res.website;
    //         website.setAttribute('readonly',true);
    //         RowModal.show();
    //     })
    // }
    RowContent.addEventListener("hide.bs.modal", function(e){
        ClearModal();
    });

    RowContent.addEventListener('click',function(e){
        
        const updateRowBtn = e.target.closest('.update-row');
        if(updateRowBtn){
            save = updateRowBtn.getAttribute('data-save');
            thisRow = JSON.parse(RowContent.querySelector('[name="row"]').value);
 
            if(save == 'UpdateCompanyId'){
                thisRow.company = RowContent.querySelector('[name="company"]').value
                const validate = Validate({
                    required: { company:true}
                });
                if( validate === true ) {
                    UpdateCompanyId(thisRow).then(r => {
                        if (r.status == true) {
                            change = appendTo.querySelector(`tr[row-id="${thisRow.rowId}"]`).querySelector('.waiting-created').closest('td');
                            change.innerHTML = '';
                            let a = document.createElement('a');
                            a.setAttribute('class','badge badge-success position-relative');
                            a.href = 'javascript:';
                            a.innerHTML = `
                                <span class="cancel-for-create badge-close" data-id="${thisRow.rowId}"><i class="fas fa-times"></i></span>
                                <span class="d-block py-1">${r.createdName}</span>
                            `;
                            change.append(a)
                            RowModal.hide();
                            ClearModal();
                        }
                    });
                }
            }else{

                const validate = Validate({
                    required: {
                        name:true, company:true, category:true, telephone:true, email:true, website:true,
                    }
                });
                if( validate === true ) updateRow({
                    id: updateRowBtn.getAttribute('data-id'),
                    name_th: RowContent.querySelector('[name="name_th"]').value,
                    name_en: RowContent.querySelector('[name="name_en"]').value,
                    company: RowContent.querySelector('[name="company"]').value,
                    category: RowContent.querySelector('[name="category"]').value,
                    telephone: RowContent.querySelector('[name="telephone"]').value,
                    email: RowContent.querySelector('[name="email"]').value,
                    website: RowContent.querySelector('[name="website"]').value
                }).then(r => {
                    RowModal.hide();
                    Alert(r);
                    if (r.status == true) {
                        ClearModal();
                        appendTo.querySelector('.refresh-for-create').click();
                    }
                });
            }
        }
        
    });
    document.addEventListener('click',function(e){
        const removeCreated = e.target.closest('.remove-created');
        if(removeCreated){
            if(confirm('Confirm to remove')){
                removeCompanyId(JSON.parse(removeCreated.closest('tr').getAttribute('data-row'))).then(r => {
                    Alert(r);
                    if (r.status === true) {
                        ClearModal();
                        appendTo.querySelector('.refresh-for-create').click();
                    }
                })
            }
        }
        const removeDesigned = e.target.closest('.remove-designed');
        if(removeDesigned){
            if(confirm('Confirm to remove')){
                RemoveDesigned(JSON.parse(removeDesigned.closest('tr').getAttribute('data-row'))).then(r => {
                    Alert(r);
                    if (r.status === true) {
                        appendTo.querySelector('.refresh-for-create').click();
                    }
                });
            }
        }
        const editCancel = e.target.closest('.edit-cancel');
        if (editCancel) {
            CancelEditAVG(editCancel)
        }
        const editSave = e.target.closest('.edit-save');
        if (editSave) {
            let parent = editSave.closest('.edit-group');
            let text = parent.querySelector('.edit').innerText;
            if(confirm('Save changes?')){
                obj = JSON.parse(editSave.closest('tr').getAttribute('data-row'));
                obj.field = editSave?.getAttribute('data-field');
                obj.avg = text;
                SaveChangeAVG(obj).then(r => {
                    Alert(r);
                    if(r.status === true) {
                        CancelEditAVG(editSave)
                    }
                });
            }else{
                CancelEditAVG(editSave)
            }
        }
    })
    document.addEventListener('change',function(e){
        const designed = e.target.closest('.designed-by');
        if(designed){
            try{
                Designed(designed.getAttribute('data-id')).then(r=>{
                    Alert(r)
                    if(r.status === true){
                        td = designed.closest('td');
                        td.innerHTML = '';
                        let a = document.createElement('a');
                        a.href = "javascrript:"
                        a.setAttribute('class','badge badge-info');
                        a.innerHTML = `
                            <span class="cancel-for-create badge-close" data-id="${designed.getAttribute('data-id')}"><i class="fas fa-times"></i></span>
                            <span class="d-block py-1">${r.designedBy}</span>
                        `;
                        td.append(a);
                    }else{
                        designed.checked = false;
                    }
                })
            } catch (e) {
                designed.checked = false;
            }
        }
        const createdBtn = e.target.closest('.waiting-created');
        if(createdBtn && createdBtn.checked === true){
            thisRow = JSON.parse(createdBtn.closest('tr').getAttribute('data-row'));
            console.log(thisRow);
            console.log(RowContent)
            console.log(RowContent.querySelector('[name="row"]'))
            RowContent.querySelector('[name="row"]').value = JSON.stringify(thisRow);
            RowContent.querySelector('.action-edit').classList.remove('d-none');
            RowContent.querySelector('.update-row').setAttribute('data-save',`UpdateCompanyId`)
            RowContent.querySelector('input[name="name_th"]').value = thisRow.name_th;
            RowContent.querySelector('input[name="name_en"]').value = thisRow.name_en;
            telephone = RowContent.querySelector('input[name="telephone"]');
            email = RowContent.querySelector('input[name="email"]');
            website = RowContent.querySelector('input[name="website"]');
            
            if(thisRow.telephone) telephone.value = thisRow.telephone;
            if(thisRow.email) email.value = thisRow.email;
            if(thisRow.website) website.value = thisRow.website; ;
            // console.log(thisRow.categoryId)
            if(thisRow.categoryId) {
                RowContent.querySelector('#row_category').setAttribute('disabled',true);
                RowCategorySelect.disable(true);
                RowCategorySelect.setSelected(thisRow.categoryId);
            }
            RowModal.show();
            // Created(created.closest(tr).getAttribute('company-id'))
        }
    })
    async function getRow(id)
    {
        const request = await fetch(`api/my-job/cs/${id}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
    }
    const getAllRow = async (params) =>
    {
        // console.log(params)
        let queryString = Object.keys(params)
             .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
             .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/waiting-for-create${queryString}`);
        if (request.status != 200) {
            Alert({status:false,message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    
    async function getOnProgress()
    {
        const request = await fetch('api/my-job/cs/on-process');
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const rresponse = await request.json();
        return response;
    }
    async function Created(id)
    {
        const request = await fetch(`webpanel/my-job/waiting-for-create/created?id=${id}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
        
    } 
    function Alert(ev)
    {
        let icon = (ev.status === true) ? 'success' : 'error';
        Swal.fire({
            icon: icon,
            title : ev.message,
            position: 'top', toast: true, timer: 1500, timerProgressBar: true, showConfirmButton: false,
        });
    }
    async function updateRow(el)
    {
        const request = await fetch(`webpanel/my-job/waiting-for-create/created?id=${el.getAttribute('row-id')}&company=${el.getAttribute('company-id')}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
    }
    async function UpdateCompanyId(obj)
    {
        console.log(obj)
        const request = await fetch(`webpanel/my-job/waiting-for-create/update/company?id=${obj.rowId}&company=${obj.company}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
    }
    async function removeCompanyId(obj)
    {
        const request = await fetch(`webpanel/my-job/waiting-for-create/remove/company?id=${obj.rowId}&company=${obj.company}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
    }
    async function Designed(id)
    {
        const request = await fetch(`webpanel/my-job/waiting-for-create/designed?id=${id}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
    } 
    async function RemoveDesigned(obj)
    {
        const request = await fetch(`webpanel/my-job/waiting-for-create/designed/remove?id=${obj.rowId}&company=${obj.company}`);
        if(!request.ok) Alert({status:false,message:`500 Internal server error`});
        const response = await request.json();
        return response;
    }
    async function SaveChangeAVG(obj)
    {
        const request = await fetch(`webpanel/my-job/waiting-for-create/avg?id=${obj.rowId}&field=${obj.field}&avg=${obj.avg}`);
        if(!request.ok) Alert({status:false,message:'500 Error internal server.'});
        const response = await request.json();
        return response;
    }
    

    let metaData = {};
    function Items(res)
    {
        if (res?.meta) {
            appendTo.querySelector('.count-on-create').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        appendTo.querySelector('tbody').innerHTML = '';
        if( res.data.length > 0 ){
            res?.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id',v.rowId);
                tr.setAttribute('company-id',v.companyId);
                tr.setAttribute('category-id',v.categoryId);
                tr.setAttribute('data-row',JSON.stringify(v))
                tr.innerHTML = `<tr>
                    <td class="text-center align-top">${start++}</td>
                    <td class="text-left align-top">
                        <div class="mb-0 design-stock-list">
                            <p class="m-0"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                            <p class="m-0"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                            <span class="badge badge-primary-light">${v.categoryNo}. ${v.categoryNameEN}</span>
                        </div>
                    </td>
                    <td class="align-top">${v.telephone}, ${v.email}</td>
                    <td class="text-center align-top">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            <a class="rank default dropdown font-weight-bold text-dark add-rank" href="javascript:">${v.ranking?`${v.ranking.toUpperCase()}`:``}</a>
                        </div>
                    </td>
                    <td class="text-center align-top">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                        ${v.assignby
                            ?`<a class="user bg-primary assignment" user-id="${v.assignBy}" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.assignName}">${v.assignDisplay}</a>`
                            :`<a class="user bg-dark assignment add-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                        }
                        </div>
                    </td>
                    <td class="text-center align-top"><small>${moment(v.created_at).format('D/M/YYYY hh:mm')}</small></td>  
                    <td class="text-center align-top">
                        ${v.created != null 
                            ? `<a class="badge badge-success position-relative" href="javascript:">
                                    ${user.role=='developer'?`<span class="remove-created badge-close" data-id="${v.rowId}" ><i class="fas fa-times"></i></span>`:``}
                                    <span class="d-block py-1">${v.createdBy}</span>
                                </a>`
                            : `<div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input cursor waiting-created" id="created-${v.rowId}" data-id="${v.rowId}">
                                    <label class="form-check-label pl-1" for="created-${v.rowId}"> Created</label>
                                </div>`
                        }
                    </td>
                    <td class="text-center align-top">
                        ${v.designed != null 
                            ? `<a class="badge badge-info cursor position-relative" href="javascript:">
                                ${user.role=='developer'?`<span class="remove-designed badge-close" data-id="${v.rowId}"><i class="fas fa-times"></i></span>`:``}
                                    <span class="d-block py-1">${v.designedBy}</span>
                                </a>`
                            : `<div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input designed-by" id="designed-${v.rowId}" data-id="${v.rowId}">
                                    <label class="form-check-label pl-1" for="designed-${v.rowId}"> Designed</label>
                                </div>`
                        }</td>
                    <td class="text-center align-top p-1" ondblclick="EditAVG(this)">
                        <div class="edit-group">
                            <div class="edit" contenteditable="false" style="outline:none;">
                                <p class="font-weight-bold avg m-0">${v.pvw?`${v.pvw}`:`0`}</p>
                            </div>
                            <div class="edit-panel">
                                <a class="edit-btn edit-cancel w-100 p-1" href="javascript:">Cancel</a>
                                <a class="edit-btn edit-save w-100 p-1" href="javascript:" data-field="pvw"><i class="fas fa-save"></i> Save</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center align-top p-1" ondblclick="EditAVG(this)">
                        <div class="edit-group">
                            <div class="edit" contenteditable="false" style="outline:none;">
                                <p class="font-weight-bold avg m-0">${v.usr?`${v.usr}`:`0`}</p>
                            </div>
                            <div class="edit-panel">
                                <a class="edit-btn edit-cancel w-100 p-1" href="javascript:">Cancel</a>
                                <a class="edit-btn edit-save w-100 p-1" href="javascript:" data-field="usr"><i class="fas fa-save"></i> Save</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center align-top p-1" ondblclick="EditAVG(this)">
                        <div class="edit-group">
                            <div class="edit" contenteditable="false" style="outline:none;">
                                <p class="font-weight-bold avg m-0">${v.ctr?`${v.ctr}`:`0`}</p>
                            </div>
                            <div class="edit-panel">
                                <a class="edit-btn edit-cancel w-100 p-1" href="javascript:">Cancel</a>
                                <a class="edit-btn edit-save w-100 p-1" href="javascript:" data-field="ctr"><i class="fas fa-save"></i> Save</a>
                            </div>
                        </div>
                    </td>
                </tr>`;
                appendTo.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="12" class="text-center">No data record.</td>';
            appendTo.querySelector('tbody').append(tr);
        }
    }
    const WaitingPaginate = new Pagination({
        content: appendTo.closest('.waiting-for-create'),
        rows: getAllRow,
        items: Items,
        search: {
            date:  appendTo.querySelector('input[name="daterange"]'),
            keyword: appendTo.querySelector('input[name="keyword"]'),
            user: appendTo.querySelector('select[name="user"]'),
            category: appendTo.querySelector('select[name="category"]'),
            assignment: appendTo.querySelector('input[name="assignment"]'),
            submit: appendTo.querySelector('[type="submit"]'),
            reset: appendTo.querySelector('[type="reset"]')
        },
        refresh: appendTo.querySelector('.refresh-for-create')
    });

    

    
    async function DeleteRow(data)
    {
        data._token = document.querySelector('meta[name="csrf-token"]').content
        const request = await fetch(`webpanel/my-job/cs/row/delete/${data.id}`,{
            method: 'post',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }
        });
        const reponse = await request.json();
        return reponse;
    }
    
    // $('.modal-dialog').draggable({handle:".modal-content"});
    function ClearModal()
    {
        RowCategorySelect.enable();
        RowContent.querySelector('.action-add').classList.add('d-none');
        RowContent.querySelector('.action-edit').classList.add('d-none');
        name_th = RowContent.querySelector('[name="name_th"]');
        name_th.setAttribute('readonly',true);
        name_th.value = '';
        name_th.setAttribute('readonly',true);
        name_en = RowContent.querySelector('[name="name_en"]');
        name_en.value = '';
        name_en.setAttribute('readonly',true);
        company = RowContent.querySelector('[name="company"]');
        company.value= '';
        // company.setAttribute('readonly',true);
        category = RowContent.querySelector('[name="category"]');
        category.value = '';
        category.setAttribute('readonly',true);
        telephone = RowContent.querySelector('[name="telephone"]')
        telephone.value= '';
        telephone.setAttribute('readonly',true);
        email = RowContent.querySelector('[name="email"]');
        email.value= '';
        email.setAttribute('readonly',true);
        website = RowContent.querySelector('[name="website"]');
        website.value= '';
        website.setAttribute('readonly',true);
    }
    
    var InputImportFile = document.querySelector('input[name="import"]')
    function readFileImport()
    {
        const reader = new FileReader()
        reader.onload = () => {
            const table = document.createElement('table');
            table.setAttribute('class','table table-striped');
            table.style.fontSize = '13px';
            table.createTHead(0);
            table.querySelector('thead').innerHTML = `
                <th>No.</th>
                <th>Company name</th>
                <th>Address</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Website</th>
            `;
            const data = reader.result.split('\r');
            const head = data[0].split(',');
            console.log(head)
            const column = []
            column[0] = 0;
            column[1] = head.indexOf('บริษัท');
            column[2] = head.indexOf('ที่อยู่');
            column[3] = head.indexOf('โทรศัพท์');
            column[4] = head.indexOf('อีเมล');
            column[5] = head.indexOf('เว็บไซต์');

            delete data[0];
            let rows = [];
            // replace
            // , = '
            //
            data.map(function(v,k){
                let row = v.split(/,/).filter((v)=>{ return v!= null});
                if(typeof row[column[1]] != typeof undefined) {
                    rows.push([
                        (k+1),
                        row[column[1]].replaceAll('"','').replaceAll('CO.','CO.,').replaceAll('Co.','Co.,'),
                        row[column[2]].replaceAll("'",', '),
                        row[column[3]].replaceAll("'",', '),
                        row[column[4]].replaceAll('"',''),
                        row[column[5]]
                    ]);
                }
            });
            console.log(rows)
            table.createTBody(0);
            rows.map(function(v,k){
                let tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${v[0]}</td>
                    <td>${v[1]}</td>
                    <td>${v[2]}</td>
                    <td>${v[3]}</td>
                    <td>${v[4] !='' && v[4] != 'ไม่มีอะไร'?`${v[4]}`:``}</td>
                    <td>
                        ${v[5] !='' && v[5] != 'ไม่มีอะไร'
                            ? `<a href="${v[4]}" target="_blank" class="btn btn-link">Click</a>`
                            : ''
                        }
                    </td>
                `;
                table.querySelector('tbody').append(tr);
            })
            rows.map(function(v,k){
                v[1].replaceAll('"','').replaceAll('CO.','CO.,');
                v[2].replaceAll("'",', ');
                v[3].replaceAll("'",', ');
                v[4].replaceAll("'",', ');
            });
            ImportContent.querySelector('.preview').setAttribute('data-import',JSON.stringify(rows))
            ImportContent.querySelector('.preview').append(table)
        }
        reader.readAsText(InputImportFile.files[0],'UTF-8')
    }

    document.querySelector('.import_file').addEventListener('change',readFileImport)

    function ExportToBatabase(data)
    {
        data.map(function(v,k){
            v[1].replaceAll('"','').replaceAll('CO.','CO.,');
            v[2].replaceAll('/',`,<br>`).replaceAll("'",',');
            v[3].replaceAll('"','');
        });
        document.addEventListener('click',function(e){
            const importToTableBtn = e.target.closest('.import-to-table');
            if(importToTableBtn) {
                
                // if(ImportContent.querySelector('[name="category"]').value != '') {
                //     ImportContent.querySelector('[name="category"]').classList.remove('error');
                //     async function Request(data){
                //         const request = await fetch(`webpanel/my-job/cs/rows/import`,{
                //             method:'post',
                //             headers:{
                //                 "Content-type":'application/json; charset:utf-8;',
                //                 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                //             },
                //             body:JSON.stringify({
                //                 rows: data,
                //                 category: ImportContent.querySelector('[name="category"]').value
                //             })
                //         });
                //         if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
                //         const rs = request.json();
                //     };
                //     Request(data).then(res => {
                //         Alert(res);
                //         if (res.status === true) {
                //             setTimeout(() => {
                //                 ImportContent.querySelector('.preview').innerHTML = '';
                //             }, 1000);
                //         }
                //     })
                // }
            }else{
                ImportContent.querySelector('[name="category"]').classList.add('error');
            }
        })

    }
    function EditAVG(el)
    {
        el.querySelector('.edit-group').classList.add('editing');
        el.querySelector('.edit').setAttribute('contenteditable',true);
        setTimeout(() => {
            const elem = el.querySelector('.avg');
            var range = document.createRange();
            var sel = window.getSelection();

            range.setStart(elem.childNodes[0], elem.innerHTML.length);
            range.collapse(true);
            
            sel.removeAllRanges();
            sel.addRange(range);

        }, 100);
    }
    
    function CancelEditAVG(el){
        let parent = el.closest('.edit-group');
        parent.classList.remove('editing');
        parent.querySelector('.edit').setAttribute('contenteditable',false);
    }
</script>