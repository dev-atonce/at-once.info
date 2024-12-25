<div class="row">
    <div class="col-lg-12">
        <div class="card presentation">
            <div class="card-header card-header d-flex">
                <h5 class="mb-0">
                   7. Presentation
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
                <div class="table-responsive table-borderless ">
                    <table class="table mb-0" id="">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center" rowspan="2" width= "3%">NO.</th>
                                <th rowspan="2">Company Name</th>
                                <th class="text-center p-1" rowspan="2" width="2%"><div class="rotate-45">Ranking</div></th>
                                <th class="text-center p-1 border-left border-right" colspan="3">Avg. Statistics Per Month</th>
                                <th class="text-center" rowspan="2">Copyright</th>
                                <th class="text-center p-1" rowspan="2" width="2%"><div class="rotate-45">Assign</div></th>
                                <th class="text-center" rowspan="2" width="7%">Date</th>
                                <th class="text-center" rowspan="2" width="7%">Presentation</th>
                                <th class="text-center" rowspan="2" width="7%">Package</th>
                                <th class="text-center" rowspan="2">Process</th>
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
<div class="modal fade" id="ModalAttachProcess">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Attach file</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row-id">
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <input type="hidden" name="field">
                <div class="pdf-row mb-3"></div>
                <label class="label font-weight-bold ucfirst text-primary"></label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input presentation-file" accept=".pdf" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalPackage">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">New Package</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="company-id">
                    <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" name="package_name" id="package_name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Package Description</label>
                        <textarea name="package_description" id="package_description" class="form-control" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button class="btn btn-light br-25" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary br-15 new-package-btn" type="submit"><i class="fas fa-save pr-1"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    var AttactPresent = document.querySelector('#ModalAttachProcess');
    var PackageModalEl = document.querySelector('#ModalPackage');
    var PackageModal = new bootstrap.Modal(PackageModalEl,{ backdrop: false, keyboard: true});
    var sale_package = {};
    Draggable(PackageModalEl);
    var PresentationElement = document.querySelector('.presentation');

    const salePackage = async() => 
    {
        const request = await fetch(`api/my-job/customer-package`);
        if(request.status != 200){
            let res = {status:false,message:`${request.status} ${request.statusText}`};
            Alert(res); return res;
        }
        const response = await request.json();
        return response;
    }
    salePackage().then(res => sale_package = res);

    const PresentationData = async(params) =>
    {
        let queryString = Object.keys(params).map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`).join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/presentation${queryString}`);
        if (request.status != 200) {
            let res = {status:false,message:`${request.status} ${request.statusText}`};
            Alert(res); return res;
        }
        const response = await request.json();
        return response;
    }

    function Items(res)
    {
        if (res?.meta) {
            PresentationElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        PresentationElement.querySelector('tbody').innerHTML = '';

        if( res?.data )
        {
            res.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id',v.rowId);
                tr.setAttribute('job-id',v.jobId);
                tr.setAttribute('company-id',v.cid);
                let appointment = '';
                v.appointment?.map((va,k)=>{
                    appointment +=`<li class="appointment-item">${moment(va.date).format('DD/MM/YYYY HH:mm')}</li>`
                })
                let myPackage = '';
                let selected = sale_package.filter(p => p.id == v.package)[0];
                // console.log(selected);
                sale_package?.map((vp) => {
                    myPackage += `<a class="package-item${v.package == vp.id ? ` font-weight-bold`:``}" href="javascript:" data-id="${vp.id}" data-name="${vp.name}">${vp.name}</a>`;
                })
                let apmDate = '-';
                v.appointment.map((r,i)=>{apmDate=(i==(v.appointment.length-1))?r?.date==null?'-':r?.date:'-'});
                tr.innerHTML = `
                    <td class="text-center align-middle">${start++}</td>
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
                    <td class="px-1 text-center">
                        ${v.copyright != null ?
                            `<a href="javascript:" class="badge badge-primary" modal-attach" copyright="${v.copyright}">
                                <i class="fas fa-paperclip"></i> ${v.copyright.split('.')[1]}
                            </a>
                            <div class="d-flex justify-content-center mt-1">
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
                                ?   `<a class="user bg-primary assignmen sale-assignment" user-id="${v.assignId}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.assignName }">${v.assignDisplay}</a>`
                                :   `<a class="user bg-secondary assignment sale-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="text-center p-2">
                        <div class="appointment-list">
                            <div class="text-center">
                                <a class="badge badge-warning br-15 appointment-date" href="javascript:" data-appointment='${v.appointment.length > 0 ? JSON.stringify(v.appointment).replaceAll("'",'"'):``}'>
                                    <i class="fas fa-calendar-alt pr-1"></i>Add
                                </a>
                            </div>
                            <ol class="appointment-list">${appointment}</ol>
                        </div>
                    </td>
                    <td class="text-center">${apmDate!='-'?`<h6>${moment(apmDate).format('DD MMMM YYYY')},<br>${moment(apmDate).format('HH:mm')}</h6>`:`-`}</td>
                    <td class="text-center">
                        <div style="display:grid;">
                            <div class="package" data-default="Package">
                                <span>${selected.id?`${selected.name}`:`Package`}</span><i class="fas fa-caret-down ml-1"></i>
                                <div class="package-dropdown">
                                    ${myPackage}
                                    <a class="package-item mt-1" href="javascript:">More <i class="fas fa-plus fa-xs"></i></a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center sale-process">
                        ${v.telephone}, ${v.email}<br>
                        <a class="badge badge-light sale-process-item${v.present_send_email?` text-primary`:``}" process="present_send_email" href="javascript:"><i class="${v.present_send_email?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Send email</a>
                        <a class="badge badge-light sale-process-item${v.present_follow?` text-primary`:``}" process="present_follow" href="javascript:"><i class="${v.present_follow?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Follow</a>
                        <a class="badge badge-light sale-process-item${v.present_done?` text-primary`:``}" process="present_done" href="javascript:"><i class="${v.present_done?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Done</a>
                        <a class="badge badge-light sale-process-item${v.present_not_interest?` text-primary`:``}" process="present_not_interest" href="javascript:"><i class="${v.present_not_interest?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Not interest</a>
                        <br>
                        <a href="javascript:" class="badge${v.quotation?` badge-lightpurple`:` badge-light`} upload-process quotation" data-field="quotation" ${v.quotation?`data-file="${v.quotation}"`:``}><i class="fas fa-paperclip mr-1"></i>Quotation</a>
                        <a href="javascript:" class="badge${v.countersign?` badge-info`:` badge-light`} upload-process countersign" data-field="countersign" ${v.countersign?`data-file="${v.countersign}"`:``}><i class="fas fa-paperclip mr-1"></i>Countersign</a>
                        <a class="badge badge-comment this-comment" href="javascript:"><i class="fas fa-comment-alt pr-1" href="javascript:"></i>Comments</a>
                    </td>
                `;
                PresentationElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
            PresentationElement.querySelector('tbody').append(tr);
        }
    }
    const presentationPaginate = new Pagination({
        content: PresentationElement,
        rows: PresentationData,
        items: Items,
        search: {
            assignment: PresentationElement.querySelector('input[name="assignment"]'),
            category: PresentationElement.querySelector('select[name="category"]'),
            keyword: PresentationElement.querySelector('input[name="keyword"]'),
            submit: PresentationElement.querySelector('[type="submit"]'),
            reset: PresentationElement.querySelector('[type="reset"]')
        },
        refresh: PresentationElement.querySelector('.refresh')
    });
    function SaleUploadFile(fileName,file,field)
    {
        let AttactPresent = document.querySelector('#ModalAttachProcess');
        let tr = document.querySelector(`[company-id="${AttactPresent.querySelector('[name="company-id"]').value}"]`);
  
        let fileSize = (file.size < 1024) ? file.size + " KB" : (file.size/(1024*1024)).toFixed(2) + " MB";
        let item = document.createElement('div');
        item.setAttribute('class','pdf-item bg-light');
        item.setAttribute('company-id',AttactPresent.querySelector('[name="company-id"]'));
        item.innerHTML = `
        <div class="d-flex">
            <div class="pdf-icon">
                <i class="far fa-file-pdf text-danger fa-4x"></i>
            </div>
            <div class="pdf-detail">
                <a href="javascript:" class="badge badge-light badge-close presentation-pdf-remove"><i class="fas fa-times"></i></a>
                <span class="pdf-name">
                    <span>${fileName}</span>
                </span>
                <div class="upload-progress">
                    <span class="pdf-size d-none">${fileSize}</span>
                    <span class="progress-percent">Uploading 0%</span>
                    <div class="progress bg-secondary" style="height:10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        `;
        AttactPresent.querySelector(".pdf-row").append(item);
        
        this.name = item.querySelector('.pdf-name');
        this.size = item.querySelector('.pdf-size');
        this.filePercent = item.querySelector('.progress-percent');
        this.filePregress = item.querySelector('.progress');
        this.filePregressBar = item.querySelector('.progress-bar');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "webpanel/my-job/presentation/attach-file");
        xhr.upload.addEventListener("progress", ({loaded, total}) => 
        {

            let fileLoaded = Math.floor((loaded / total) * 100);
            let fileTotal = Math.floor(total / 1000);
            let size = (fileTotal < 1024) ? fileTotal + " KB" : (loaded/(1024*1024)).toFixed(2) + " MB";

            this.filePercent.innerHTML = `Uploading ${fileLoaded}%`;
            this.filePregressBar.style = `width:${fileLoaded}%`;
            this.filePregressBar.setAttribute('aria-valuenow',fileLoaded);
            
            if(loaded == total)
            {
                this.filePregress.style.width = `100%`;
                this.filePregress.setAttribute('aria-valuenow',100);
            }

        });
        xhr.onreadystatechange = function(){
            if(xhr.status === 500)
            {
                item.querySelector('.pdf-name').classList.add('text-danger');
                item.querySelector('.pdf-size')?.remove();
                percent = item.querySelector('.progress-percent');
                percent.classList.add('text-danger');
                percent.innerHTML = 'Error'
                toggleClass(item.querySelector('.badge-close'),'badge-light badge-danger');
                item.querySelector('.progress')?.remove();
            }
        }

        let data = new FormData();
        data.append('companyId',AttactPresent.querySelector('input[name="company-id"]').value);
        data.append('attachFile',file);
        data.append('field',field);
        data.append('size',file.size);
        // xhr.timeout = 45000;
        xhr.onload  = function() {
            var res = JSON.parse(xhr.response);
            if(res.status === true){
                fileName = res.file.split('/')[2];
                item.querySelector('.progress')?.remove();
                item.querySelector('.pdf-size')?.remove('d-none');
                item.querySelector('.progress-percent')?.remove('d-none');
                // make file link
                let a = document.createElement('a');
                a.href = 'javascript:'
                a.target = '_blank';
                a.setAttribute('file',`${res.file}`);
                a.setAttribute('class','pdf-preview');
                a.innerHTML = fileName;
                // change <span> element to <a> element
                item.querySelector('.pdf-name > span').replaceWith(a); 
                // set file path on button
                tr.querySelector(`.${field}`).setAttribute('data-file',res.file);
                document.querySelector('.presentation-file').value = null;
                let changeTo = field == 'quotation'?'badge-lightpurple':'badge-info';
                toggleClass(tr.querySelector(`.${field}`),`badge-light ${changeTo}`)
            }
        };
        xhr.send(data);
      
    }
    async function SaleProcess(params)
    {
        let queryString = Object.keys(params)
            .map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`)
            .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`webpanel/my-job/presentation/process${queryString}`);
        if(request.status != 200){
            Alert({statusW:false, message:`${request.status} ${request.statusText}`});
            return {statusW:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function UploadProcess(data)
    {
        const request = await fetch(``,{
            method:'POST',
            headers: {
                    "Content-type": "multipart/form-data; charset:utf-8;",
                    "X-CSRF-token": document.querySelector('meta[name="csrf-token"]').content
                },
                body:JSON.stringify(data)
        });
        if(request.status != 200){
            Alert({statusW:false, message:`${request.status} ${request.statusText}`});
            return {statusW:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function SetPackage(params)
    {
        let queryString = Object.keys(params)
            .map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`)
            .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`webpanel/my-job/presentation/package${queryString}`);
        if(request.status != 200){
            Alert({statusW:false, message:`${request.status} ${request.statusText}`});
            return {statusW:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function NewPackage(data)
    {
        const request = await fetch(`webpanel/my-job/presentation/new-package`,{
            method:'POST',
            headers: {
                    "Content-type": "application/json; charset:utf-8;",
                    "X-CSRF-token": document.querySelector('meta[name="csrf-token"]').content
                },
                body:JSON.stringify(data)
        });
        if(request.status != 200){
            Alert({statusW:false, message:`${request.status} ${request.statusText}`});
            return {statusW:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    /// remove pdf file
    function RemoveFileAttach(el)
    {
        let companyId = AttactPresent.querySelector('input[name="company-id"]').value;
        let tr = document.querySelector(`tr[company-id="${companyId}"]`);
        let field = AttactPresent.querySelector('[name="field"]').value
        if(confirm('Confirm to delete?') === true)
        {
            if (companyId)
            {
                try 
                {
                    async function Request(params) {
                        let queryString = Object.keys(params)
                            .map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`)
                            .join('&');
                        queryString = (queryString)?`?${queryString}`: ``;
                        const request = await fetch(`webpanel/my-job/presentation/attach-file/delete${queryString}`);
                        if (request.status != 200 ) {
                            Alert({status:false, message:`${request.status} ${request.statusText}`});
                            return {status:false, message:`${request.status} ${request.statusText}`};
                        }
                        const response = await request.json();
                        return response;
                    }
                    Request({
                        companyId: companyId,
                        field: AttactPresent.querySelector('[name="field"]').value
                    }).then(res => { 
                        Alert(res);
                        if(res.status === true) el.closest('.pdf-item').remove();
                        tr.querySelector(`.${field}`).removeAttribute('data-file');
                        let changeTo = (field == 'quotation')?'badge-lightpurple':'badge-info';
                        toggleClass(tr.querySelector(`[data-field="${field}"]`),`badge-light ${changeTo}`);
                        el.closest('.modal-body').querySelector('label.selected').innerHTML = 'Choose file';
                    });
                } catch (error) {
                    Alert({status:false,message:error});
                }
            }else{
                el.remove();
            }
        }
    }
    document.addEventListener('click',function(e){
        const saleProcess = e.target.closest('.sale-process-item');
        if(saleProcess) {
            let tr = saleProcess.closest('tr');
            let thisProcess = saleProcess.getAttribute('process');
            let icon = saleProcess.querySelector('i');
            let UncheckedIcon = `far fa-circle pr-1`;
            let CheckedIcon = `fas fa-check-circle pr-1`;

            if(saleProcess.classList.contains('text-primary')){
                saleProcess.classList.remove('text-primary');
                icon.setAttribute('class',UncheckedIcon);
            }else{
                saleProcess.classList.add('text-primary');
                icon.setAttribute('class',CheckedIcon);

            }

            SaleProcess({
                company: tr.getAttribute('company-id'),
                process: thisProcess
            }).then(res => {
                if(res.status === true) {
                    Alert({status:true,message:`${res.message}`});
                }else{
                    if(saleProcess.classList.contains('text-primary')){
                        saleProcess.classList.remove('text-primary');
                        icon.setAttribute('class',UncheckedIcon);
                    }else{
                        saleProcess.classList.add('text-primary');
                        icon.setAttribute('class',CheckedIcon);
                    }
                }
            })
        }
        const pacakgeAction = e.target.closest('.package');
        if(pacakgeAction){
            // let dropdown = pacakgeAction.querySelector('.revise-dropdown');
            if(!pacakgeAction.classList.contains('show')) pacakgeAction.classList.add('show');
            else pacakgeAction.classList.remove('show');
        }
        const packageItem = e.target.closest('.package-item');
        if (packageItem) {
            let tr = packageItem.closest('tr');
            let thisPackage = packageItem.getAttribute('data-id');
            let thisPackageText = packageItem.innerText;
            let select = tr.querySelector('.package');
            if(thisPackage){
                SetPackage({
                    company: tr.getAttribute('company-id'),
                    package: thisPackage
                }).then(res=>{
                    Alert(res);
                    if(res.status === true) {
                        let select = tr.querySelector('.package');
                        select.querySelector('span').innerText = thisPackageText;
                        packageItem.closest('.package-dropdown').querySelector('.font-weight-bold').classList.remove('font-weight-bold');
                        packageItem.classList.add('font-weight-bold');
                    }
                })
            }else{
                PackageModalEl.querySelector('[name="company-id"]').value = tr.getAttribute('company-id');
                PackageModal.show();
            }
        }
        const uploadProcess = e.target.closest('.upload-process');
        if(uploadProcess) {
            let tr = uploadProcess.closest('tr');
            let label = uploadProcess.getAttribute('data-field');
            let file = uploadProcess?.getAttribute('data-file');
            AttactPresent.querySelector('.pdf-row').innerHTML = '';
            AttactPresent.querySelector('.custom-file-label').innerHTML = 'Choose file';
            if(file)
            {
                fileName = file.split('/')[2];
                item = document.createElement('div');
                item.setAttribute('class','pdf-item bg-light');
                item.setAttribute('company-id',tr.getAttribute('company-id'));
                item.innerHTML = `
                    <div class="d-flex">
                        <div class="pdf-icon">
                            <i class="far fa-file-pdf text-danger fa-4x"></i>
                        </div>
                        <div class="pdf-detail">
                            <a href="javascript:" class="badge badge-light badge-close presentation-pdf-remove"><i class="fas fa-times"></i></a>
                            <p class="pdf-name">
                                <a href="javascript:" file="${file}" class="pdf-preview" target="_blank">${fileName}</a>
                            </p>
                        </div>
                    </div>
                `;
                AttactPresent.querySelector('.pdf-row').append(item);
            }
            AttactPresent = document.querySelector('#ModalAttachProcess');
            AttactModal = new bootstrap.Modal(AttactPresent,{backdrop:false, keyboard:true});
            Draggable(AttactPresent);
            
            AttactPresent.querySelector('input[name="company-id"]').value = tr.getAttribute('company-id');
            AttactPresent.querySelector('.presentation-file').innerHTML = '';
            AttactPresent.querySelector('input[name="field"]').value = uploadProcess.getAttribute('data-field');
            AttactPresent.querySelector('.label').innerHTML = `${label} file`;
            AttactModal.show();
        }
        const removePresentationFile = e.target.closest('.presentation-pdf-remove');
        if(removePresentationFile) {
            RemoveFileAttach(removePresentationFile)
        }
        const newPackageBtn = e.target.closest('.new-package-btn');
        if(newPackageBtn) {
            let tr = PresentationElement.querySelector(`tr[company-id="${PackageModalEl.querySelector('[name="company-id"]').value}"]`)
            let validate = Validate({
                required: {
                    package_name: true,
                    package_description: true
                }
            });
            if( validate === true ) NewPackage({
                name: PackageModalEl.querySelector('[name="package_name"]').value,
                description: PackageModalEl.querySelector('[name="package_description"]').value,
                companyId: PackageModalEl.querySelector('[name="company-id"]').value
            }).then(res=>{
                Alert(res);
                if(res === true) {
                    PackageModalEl.querySelector('[name="name"]').value = '';
                    PackageModalEl.querySelector('[name="description"]').value = '';
                    PackageModal.hide();
                }
            })
            
        }

    });
    document.addEventListener('change',function(e){
        // preview copyright pdf file from new window
        pdfFile = e.target.closest('.presentation-file');
        if(pdfFile){
            let file = pdfFile.files[0];
            let fileName = file.name;
            let field = pdfFile.closest('.modal-body')?.querySelector('input[name="field"]').value;
            SaleUploadFile(fileName,file,field);
        }
    });
</script>