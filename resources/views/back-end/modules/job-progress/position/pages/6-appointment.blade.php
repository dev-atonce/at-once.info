<div class="row">
    <div class="col-lg-12">
        <div class="card appointment">
            <div class="card-header d-flex">
                <h5 class="mb-0">
                    6. Appointment
                    <span class="badge badge-info mx-1 count">0</span>
                    <a class="badge badge-info refresh-for-create refresh" title="Refresh" href="javascript:">
                        <i class="fas fa-sync-alt fs-12"></i>
                    </a>
                </h5>
                <div class="ms-auto col-auto form-inline">
                    <strong class="mr-2">Filter: </strong>
                    <div class="badge badge-lightpink br-3x fs-12 dropdown user-assignment cursor" title="Assigment">
                        <span class="fas fa-filter"></span>
                        <input type="hidden" name="assignment">
                    </div>
                    <select class="form-control form-control-sm br-15 filter_category ml-2" name="category"><option value="">Category</option><select>
                    <input type="text" name="keyword" class="form-control form-control-sm ml-2 br-15" placeholder="Search Company Name..." aria-label="Search Company Name..." aria-describedby="button-addon1">
                    <button class="btn btn-primary btn-sm br-15 ml-2 submit" type="submit"><i class="fas fa-search-plus pr-1"></i> Search</button>
                    <button class="btn btn-outline-danger btn-sm br-15 ml-2 reset" type="reset"><i class="fas fa-history pr-1"></i> Reset</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th rowspan="2" width="3%">No.</th>
                                <th rowspan="2" width="20%">Company Name</th>
                                <th rowspan="2" width="2%" class="p-1"><div class="rotate-45">Ranking</div></th>
                                <th colspan="3" class="text-center border-left p-0 border-right" width="20%">Avg. Statistics Per Month</th>
                                <th rowspan="2" width="5%" class="text-center">Copyright</th>
                                <th rowspan="2" width="2%" class="text-center p-1"><div class="rotate-45">Assign</div></th>
                                <th rowspan="2" width="10%" class="text-center px-1">Date</th>
                                <th rowspan="2" width="10%" class="text-center px-1">APM Date</th>
                                <th rowspan="2" width="25%" class="text-center">Process</th>
                            </tr>
                            <tr class="last-child">
                                <th class="text-center border-left p-1">Page view</th>
                                <th class="text-center border-left p-1">User</th>
                                <th class="text-center border-left border-right p-1">Country</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-dark btn-sm br-l-15 prev-page" type="button">< Prev</button>
                            </div>
                            <select type="text" class="form-control form-control-sm border-dark page" name="page"></select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark btn-sm br-r-15 next-page" type="button">Next ></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalDateAppointment">
    <div class="modal-dialog modal-sm">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Appointment Date</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row-id">
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <div class="form-group">
                    <label>Day/Month/Year Hour:Second</label>
                    <div class="input-group mb-3">
                        <input type="text" name="date" class="form-control br-l-15" placeholder="DD/MM/YYYY H:ss" readonly="true">
                        <div class="input-group-append">
                            <button class="btn btn-primary add-appointment-date br-r-15" type="button">
                                <i class="fas fa-plus xy-14"></i><span class="ml-1">Add</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="appointment-content d-none py-2">
                        <ol class="appointment-ol pl-4">
                            {{-- <li class="appointment-li">17/04/2023 10:30 <a class="badge badge-danger remove-appointment-date" href="javascript:"><i class="fas fa-times"></i></a></li>
                            <li class="appointment-li">18/04/2023 09:30 <a class="badge badge-danger remove-appointment-date" href="javascript:"><i class="fas fa-times"></i></a></li>
                            <li class="appointment-li">19/04/2023 14:30 <a class="badge badge-danger remove-appointment-date" href="javascript:"><i class="fas fa-times"></i></a></li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var AppointmentElement = document.querySelector('.appointment');
    var ModalDateAppointment = document.getElementById('ModalDateAppointment');
    var DateAppointmentModal = new bootstrap.Modal(ModalDateAppointment,{ backdrop: false, keyboard: true});
    $(ModalDateAppointment.querySelector('[name="date"]')).daterangepicker({ 
        // autoApply: true, 
        alwaysShowCalendars: true,
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {format: 'DD/MM/YYYY'}
    });
    $(ModalDateAppointment.querySelector('[name="date"]')).on('apply.daterangepicker',function(ev, picker){
        console.log(picker);
        $(this).val(picker.startDate.format('DD/MM/YYYY H:mm'));
    });
    Draggable(ModalDateAppointment);
    
    const getDataAppointment = async (params) =>
    {
        let queryString = Object.keys(params)
             .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
             .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/appointment${queryString}`);
        if (request.status != 200) {
            Alert({status:false,message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function GetAppointment(company)
    {
        const request = await fetch(`api/my-job/appointment/get-date?company=${company}`);
        if (request.status != 200) {
            Alert({status:false,message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function getComment(company)
    {
        const request = fetch(`api/my-job/get-comment?company=${company}`);
        if (request.status != 200) {
            Alert({status:false,message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function SaleAssign()
    {
        const request = await fetch('my-job/appointment/assign');
        if (request.status != 200) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        } 
        const response = await request.json();
        return response;
    }
    async function AddAppointmentDate(data)
    {
        const request = await fetch('webpanel/my-job/add-apppointment-date',{
            method: "POST",
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-Token': document.querySelector('[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        if (request.status != 200) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        } 
        const response = await request.json();
        return response;
    }
    async function RemoveAppointment(id)
    {
        const request = await fetch(`webpanel/my-job/appointment/remove-date?id=${id}`);
        if (request.status != 200) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        } 
        const response = await request.json();
        return response;
    }
    async function AppointmentProcess(params)
    {
        let queryString = Object.keys(params)
            .map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`)
            .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`webpanel/my-job/appointment/process${queryString}`);
        if(request.status != 200){
            Alert({statusW:false, message:`${request.status} ${request.statusText}`});
            return {statusW:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    function Items(res)
    {
        if (res?.meta) {
            AppointmentElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        AppointmentElement.querySelector('tbody').innerHTML = '';
        if( res.data.length > 0 ){
            res.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id',v.rowId);
                tr.setAttribute('job-id',v.jobId);
                tr.setAttribute('company-id',v.cid);
                let appointment = '';
                v.appointment.map((va,k)=>{
                    appointment +=`<li class="appointment-item">${moment(va.date).format('DD/MM/YYYY HH:mm')}</li>`
                })
                let apmDate = '-';
                v.appointment.map((r,i)=>{apmDate=(i==(v.appointment.length-1))?r?.date==null?'-':r?.date:'-'});
                tr.innerHTML = `
                    <td class="text-center align-middle px-1">${start++}</td>
                    <td class="align-middle">
                        <div class="mb-0 design-stock-list">
                            <p class="m-0"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                            <p class="m-0"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                            <span class="badge badge-primary-light">${v.categoryNo}. ${v.categoryNameEN}</span>
                        </div>
                    </td>
                    <td class="text-center px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            <a class="rank default dropdown font-weight-bold text-upper-case add-rank" href="javascript:" data-ranking="${v.ranking?v.ranking:``}">
                                ${v.ranking?`${v.ranking.toUpperCase()}`:``}
                            </a>
                        </div>
                    </td>
                    <td class="text-center" ondblclick="EditAVG(this)">
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
                    <td class="text-center" ondblclick="EditAVG(this)">
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
                    <td class="text-center" ondblclick="EditAVG(this)">
                        <div class="edit-group">
                            <div class="edit" contenteditable="false" style="outline:none;">
                                <p class="font-weight-bold avg m-0">${v.ctr?`${v.ctr}`:`-`}</p>
                            </div>
                            <div class="edit-panel">
                                <a class="edit-btn edit-cancel w-100 p-1" href="javascript:">Cancel</a>
                                <a class="edit-btn edit-save w-100 p-1" href="javascript:" data-field="ctr"><i class="fas fa-save"></i> Save</a>
                            </div>
                        </div>
                    </td>
                    <td class="px-1 text-center px-1">
                        ${v.copyright != null ?
                            `<a href="javascript:" class="badge badge-primary" modal-attach" copyright="${v.copyright}">
                                <i class="fas fa-paperclip"></i> ${v.copyright.split('.')[1]}
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.displayName}">${v.display}</a>
                                <a class="user user-sm badge-comment fs-10 ml-1 this-comment" href="javascript:"><i class="fas fa-comment-alt"></i></a>
                            </div>
                            `:``
                        }
                    </td>
                    <td class="text-center px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            ${v.assignId 
                                ?   `<a class="user bg-primary assignment" user-id="${v.assignId}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.assignName }">${v.assignDisplay}</a>`
                                :   `<a class="user bg-secondary assignment sale-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="text-center px-1">
                        <div class="appointment-list">
                            <div class="text-center">
                                <a class="badge badge-warning br-15 appointment-date" href="javascript:" data-appointment='${v.appointment.length > 0 ? JSON.stringify(v.appointment).replaceAll("'",'"'):``}'>
                                    <i class="fas fa-calendar-alt pr-1"></i>Add
                                </a>
                            </div>
                            <ol class="appointment-list">${appointment}</ol>
                        </div>
                    </td>
                    <td class="text-center">${apmDate!='-'?`<div class="font-weight-bold">${moment(apmDate).format('DD MMMM YYYY')},<br>${moment(apmDate).format('HH:mm')}</div>`:`-`}</td>
                    <td class="text-center appointment-process">
                        <a class="badge badge-light appointment-process-item${v.call_again?` text-primary`:``}" process="call_again" href="javascript:"><i class="${v.call_again?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Call again</a>
                        <a class="badge badge-light appointment-process-item${v.follow?` text-primary`:``}" process="follow" href="javascript:"><i class="${v.follow?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Follow</a>
                        <a class="badge badge-light appointment-process-item${v.on_process?` text-primary`:``}" process="on_process" href="javascript:"><i class="${v.on_process?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>On Process</a>
                        <a class="badge badge-light appointment-process-item${v.done?` text-primary`:``}" process="done" href="javascript:"><i class="${v.done?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Done</a>
                        <a class="badge badge-light appointment-process-item${v.not_interest?` text-primary`:``}" process="not_interest" href="javascript:"><i class="${v.not_interest?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Not interest</a>
                        <a class="badge badge-comment this-comment" href="javascript:"><i class="fas fa-comment-alt pr-1" href="javascript:"></i>Comments</a>
                    </td>
                `;
                AppointmentElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
            AppointmentElement.querySelector('tbody').append(tr);
        }
    }
    const appointmentPaginate = new Pagination({
        content: AppointmentElement,
        rows: getDataAppointment,
        items: Items,
        search: {
            assignment: AppointmentElement.querySelector('input[name="assignment"]'),
            category: AppointmentElement.querySelector('select[name="category"]'),
            keyword: AppointmentElement.querySelector('input[name="keyword"]'),
            submit: AppointmentElement.querySelector('[type="submit"]'),
            reset: AppointmentElement.querySelector('[type="reset"]')
        },
        refresh: AppointmentElement.querySelector('.refresh')
    });
    function CompanyComments(companyId)
    {
        async function data(companyId) {
            const request = await fetch(`api/my-job/get-comments?company=${companyId}`);
            if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
            const response = await request.json();
            return response;
        }
        data(companyId).then(res => {
            console.log(res)
            const pinCommentContent = document.querySelector('.pin-comment');
            pinCommentContent.innerHTML = '';
            if (res.pin) {
                const item = res.pin;
                const comment = document.createElement('div');
                comment.setAttribute('comment-id',item.id);
                comment.setAttribute('class',`comment comment-primary pin-item`)
                comment.innerHTML = `
                    <i class="fas fa-thumbtack position-absolute rt45 mr-2"></i>
                    <a href="javascript:" class="badge badge-secondary badge-close pin-remove"><i class="fas fa-times"></i></a>
                    <span class="ml-3">${item.message}</span>
                `;
                pinCommentContent.innerHTML = '';
                pinCommentContent.append(comment);
            }
            const rowComment = document.querySelector('.row-comment');

            rowComment.innerHTML = '';
            res.map(function(item, k){
                const commentItem = document.createElement('div');
                let commentClass = userId == item.userId ? `comment-info` : 'comment-light';
                commentClass = item.type == 'system' ? `comment-warning` : commentClass;
                commentItem.setAttribute('class',`comment-item${userId == item.userId?` my-comment`:``}`);
                commentItem.setAttribute('comment-id',item.id);
                commentItem.setAttribute('user-id',item.userId);
                commentItem.innerHTML = `
                <div class="comment-header"> 
                    <small class="pl-2"><strong>${item.userName}</strong></small>
                </div>
                <div class="comment-body">
                    ${userId == item.userId?`<small class="mx-1">${moment(item.created_at).format('D MMM YYYY H:mm')}</small>`:``}
                    <div class="comment ${commentClass}">
                        <span>${item.message}</span>
                    </div>
                    ${userId != item.userId?`<small class="mx-1">${moment(item.created_at).format('D MMM YYYY H:mm')}</small>`:``}
                </div>
                `;
                rowComment.append(commentItem);
            })
        })
    }
    const fetchAppointmentDate = (company) =>
    {
        GetAppointment(company).then(res=>{
            let tr = AppointmentElement
                .querySelector(`tr[company-id="${company}"]`);
            let to = tr
                .querySelector('.appointment-list > .appointment-list');
            to.innerHTML = '';
            if(res && res.length > 0) {
                let lastDate = '';
                res.map(function(row,k){
                    let li = document.createElement('li');
                    li.setAttribute('class',"appointment-item");
                    li.innerHTML = moment(row.date).format('DD/MM/YYYY HH:mm');
                    to.append(li);
                    lastDate = ( (k+1) == res?.length ) ? row.date : '';
                })
                tr.getElementsByTagName('td')[5]
                    .innerHTML = `<h5>${moment(lastDate).format('DD/MM/YYYY')},<br>${moment(lastDate).format('HH:mm')}</h5>`;
            }else{
                tr.getElementsByTagName('td')[5].innerHTML = '-';
            }
        })
    }
    document.addEventListener('click',function(e){
        // add user assignment
        const saleAssign = e.target.closest('.sale-assignment');
        if (saleAssign) {
            let tr = saleAssign.closest('tr');
            const Request = async () => {
                const request = await fetch(`webpanel/my-job/appointment/assignment?company=${tr.getAttribute('company-id')}`);
                if(!request.ok) Error(request);
                const response = await request.json();
                return response;
            }
            Request().then(res=> {
                if (res.status === true) {
                    let item = document.createElement('a');
                    item.href = 'javascript:';
                    if(res?.assignment == 'remove'){
                        item.setAttribute('class','user bg-secondary assignment sale-assignment'); 
                        item.innerHTML = '<i class="fas fa-plus"></i>';
                        document.querySelector('.tooltip').remove();
                    }else{
                        item.setAttribute('class','user bg-primary assignment');
                        item.innerHTML = user.display;
                        item.setAttribute('user-id',user.id);
                        item.setAttribute('data-placement','top');
                        item.setAttribute('data-toggle','tooltip');
                        item.title = user.name;
                        item.setAttribute('data',JSON.stringify({id:res.data.id,name:res.data.name,display:res.data.display}));
                    }
                    saleAssign.replaceWith(item)
                }else{
                    Alert(res);
                }
            })
        }
        const addAppontmentBtn = e.target.closest('.appointment-date');
        if(addAppontmentBtn){
            // let appointments = JSON.parse(addAppontmentBtn.getAttribute('data-appointment'));
            const ulElement = ModalDateAppointment.querySelector('.appointment-content');
            ulElement.querySelector('ol').innerHTML = '';
            if(addAppontmentBtn.getAttribute('data-appointment') != '')
            {
                ulElement.classList.add('d-none');
                let appointments =  JSON.parse(addAppontmentBtn.getAttribute('data-appointment'));
                ulElement.classList.remove('d-none');
                appointments.forEach(row => {
                    let appointItem = document.createElement('li')
                    appointItem.setAttribute("class","appointment-li");
                    innerItem = `${moment(row.date).format('DD/MM/YYYY HH:mm')}<a class="badge badge-danger remove-appointment-date ml-1" href="javascript:" data-id="${row.id}"><i class="fas fa-times"></i></a>`
                    appointItem.innerHTML = innerItem;
                    ulElement.querySelector('ol').append(appointItem);
                });
            }else{
                ulElement.classList.add('d-none');
            }
            let tr = addAppontmentBtn.closest('tr');
            ModalDateAppointment.querySelector('input[name="company-id"]').value = tr.getAttribute('company-id');
            DateAppointmentModal.show();
        }
        const commentBtn = e.target.closest('.this-comment');
        if (commentBtn) {
            let tr = commentBtn.closest('tr');
            let company = tr.getAttribute('company-id');
            CommentModalElement.querySelector('[name="company-id"]').value = company;
            CommentModalElement.querySelector('[name="job-id"]').value = tr.getAttribute('job-id');
            CommentModal.show();
            CompanyComments(tr.getAttribute('company-id'));
            
        }
        const addBtn = e.target.closest('.add-appointment-date');
        if(addBtn) {
            // thisModal = addBtn.closest('.modal-body');
            let date = document.getElementById('ModalDateAppointment').querySelector('input[name="date"]');
            if (date.value) {
                currentIcon = 'fas fa-plus xy-14';
                loaderIcon = `loader-xs xy-14`;
                input = addBtn.closest('.input-group').querySelector('input[name="date"]');
                addBtn.querySelector('i').setAttribute('class',loaderIcon);
                date.classList.remove('error');
                AddAppointmentDate({
                    date: date.value,
                    company: ModalDateAppointment.querySelector('input[name="company-id"]').value
                }).then(res => {
                    Alert(res);
                    if (res.status === true) {
                        let li = document.createElement('li');
                        li.setAttribute('class','appointment-li');
                        li.innerHTML = `${moment(res.data.date).format('DD/MM/YYYY HH:mm')} <a class="badge badge-danger remove-appointment-date ml-1" href="javascript:" data-id="${res.data.id}"><i class="fas fa-times"></i></a>`
                        ModalDateAppointment.querySelector('.appointment-ol').append(li);
                        ModalDateAppointment.querySelector('.appointment-content').classList?.remove('d-none');
                        fetchAppointmentDate(ModalDateAppointment.querySelector('input[name="company-id"]').value)
                    }
                    addBtn.querySelector('i').setAttribute('class',currentIcon);
                })
            } else {
                date.classList.add('error');
            }
        }

        const removeAppointment = e.target.closest('.remove-appointment-date');
        if(removeAppointment) {
            let company = ModalDateAppointment.querySelector('input[name="company-id"]').value;
            if(confirm('Confirm to delete, right?') === true) {
                RemoveAppointment(removeAppointment.getAttribute('data-id')).then(res => {
                    if(res.status === true) {
                        removeAppointment.closest('li').remove();
                        fetchAppointmentDate(company)
                    }
                })
            }
        }
        const processItem  = e.target.closest('.appointment-process-item');
        if(processItem) {
            let tr = processItem.closest('tr');
            let thisProcess = processItem.getAttribute('process');
            let icon = processItem.querySelector('i');
            let UncheckedIcon = `far fa-circle pr-1`;
            let CheckedIcon = `fas fa-check-circle pr-1`;
            // if(processItem.classList.contains('text-primary')){
            //     processItem.classList.remove('text-primary');
            // }else{
            //     processItem.classList.add('text-primary');
            // }
            toggleClass(processItem,'text-primary')
            if(icon.classList.contains('fa-check-circle')){
                icon.setAttribute('class',UncheckedIcon);
            }else{ 
                icon.setAttribute('class',CheckedIcon);
            }
            AppointmentProcess({
                company: tr.getAttribute('company-id'),
                process: thisProcess
            }).then(res => {
                if(res.status === true) {
                    Alert({status:true,message:`${res.message}`});
                }else{
                    if (processItem.classList.contains('text-primary')) {
                        processItem.classList.remove('text-primary');
                        icon.setAttribute('class','far fa-circle pr-1');
                    }else{
                        processItem.classList.add('text-primary');
                        icon.setAttribute('class','fas fa-check-circle pr-1');
                    }

                }
            })
        }
    })

</script>