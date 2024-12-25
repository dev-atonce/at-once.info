<div class="row">
    <div class="col-lg-12">
        <div class="card customer-list">
            <div class="card-header card-header d-flex">
                <h5 class="mb-0">
                    8. Customer List
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
                                <th class="text-center">NO.</th>
                                <th>Company Name</th>
                                <th class="text-center">Package</th>
                                <th class="text-center p-1"><div class="rotate-45">Assign CS</div></th>
                                <th class="text-center">Copyright</th>
                                <th class="text-center p-1"><div class="rotate-45">Assign Sale</div></th>
                                <th class="text-center">Quotation</th>
                                <th class="text-center">Countersign</th>
                                <th class="text-center">Customer<br>Document</th>
                                <th class="text-center">Agreement</th>
                                <th class="text-center">Contract Date</th>
                                <th class="text-center">Check Keyword</th>
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
<div class="modal fade" id="AttachCustomerModal">
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
                        <input type="file" class="custom-file-input customer-file" accept=".pdf" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="KeywordModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Keyword</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row-id">
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <input type="hidden" name="member-id">
                <table class="table table-bordered">
                    <thead class="thead-ultralight">
                        <tr>
                            <th>No.</th>
                            <th>Keyword</th>
                            <th>Search volume</th>
                            <th>SEO Difficult</th>
                            <th>Select Keyword</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="5">No record.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ContractModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Contract Date</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row-id">
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <input type="hidden" name="member-id">
                <div class="row">
                    <div class="col-lg-6 col-xs-6"><label>Start</label><input type="text" name="start" class="form-control"></div>
                    <div class="col-lg-6 col-xs-6"><label>End</label><input type="text" name="end" class="form-control"></div>
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button class="btn btn-light btn-sm br-15 px-3">Cancel</button>
                <button class="btn btn-primary btn-sm br-15 px-3 contract-save-edit"><span class="fas fa-save fs-13 pr-2"></span>Save the edits.</button>
            </div>
        </div>
    </div>
</div>
<script>
    var CustomerListElement = document.querySelector('.customer-list');
    var AttactCustomerEl = document.querySelector('#AttachCustomerModal');
    var KeywordModalEl = document.getElementById('KeywordModal');
    var ContractModalEl = document.getElementById('ContractModal')
    // var ModalKeywordEl = document.getElementById('ModalKeyword');

    var AttactModal = new bootstrap.Modal(AttactCustomerEl,{backdrop:false, keyboard:true});
    var KeywordModal = new bootstrap.Modal(KeywordModalEl,{backdrop:false, keyboard:true});
    var ContracModal = new bootstrap.Modal(ContractModalEl,{backdrop:false, keyboard:true});

    Draggable(KeywordModalEl);
    Draggable(KeywordModalEl);
    Draggable(ContractModalEl);

    ContractModalEl.querySelectorAll('[type="text"]').forEach((element, k) => 
    {
        let datetime = new daterangepicker(element,{ 
            // autoApply: true, 
            autoUpdateInput: false,
            singleDatePicker: true,
            alwaysShowCalendars: true,
            locale: {format: 'DD/MM/YYYY'}
        },function(date){
            element.value = moment(date).format('DD/MM/YYYY')
        })
    });

    function CustomerUploadFile(fileName,file,field,input)
    {
        // let AttactCustomerEl = document.querySelector('#ModalAttachProcess');
        let tr = CustomerListElement.querySelector(`tr[company-id="${AttactCustomerEl.querySelector('[name="company-id"]').value}"]`);
  
        let fileSize = (file.size < 1024) ? file.size + " KB" : (file.size/(1024*1024)).toFixed(2) + " MB";
        let item = document.createElement('div');
        item.setAttribute('class','pdf-item bg-light');
        item.setAttribute('company-id',AttactCustomerEl.querySelector('[name="company-id"]'));
        item.innerHTML = `
        <div class="d-flex">
            <div class="pdf-icon">
                <i class="far fa-file-pdf text-danger fa-4x"></i>
            </div>
            <div class="pdf-detail">
                <a href="javascript:" class="badge badge-light badge-close customer-pdf-remove"><i class="fas fa-times"></i></a>
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
        AttactCustomerEl.querySelector(".pdf-row").append(item);
        
        this.name = item.querySelector('.pdf-name');
        this.size = item.querySelector('.pdf-size');
        this.filePercent = item.querySelector('.progress-percent');
        this.filePregress = item.querySelector('.progress');
        this.filePregressBar = item.querySelector('.progress-bar');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "webpanel/my-job/customer-list/attach-file");
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
        data.append('companyId',AttactCustomerEl.querySelector('input[name="company-id"]').value);
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
                document.querySelector('.customer-file').value = null;
                if(res?.by) {
                    let td = tr.querySelector(`.${field}`).closest('td');
                    let byItem = document.createElement('div');
                    byItem.setAttribute('class','d-flex justify-content-center mt-1');
                    byItem.innerHTML = `<span>by</span><a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${res.name}">${res.display}</a>`;
                    tr.querySelector(`.${field}`).innerHTML = `${res.file.split('.')[1].toUpperCase()}<i class="fas fa-file-pdf ml-1"></i>`
                    td.append(byItem);
                }
                let changeTo = field == 'quotation'? 'badge-lightpurple' :'badge-info';
                changeTo = field == 'countersign'? 'badge-lightpink' : changeTo;
                changeTo = field == 'document'? 'badge-info' : changeTo;
                changeTo = field == 'agreement'? 'badge-success' : changeTo;
                toggleClass(tr.querySelector(`.${field}`),`badge-light ${changeTo}`);
                input.querySelector('.custom-file-label').innerHTML = 'Choose file';
            }
        };
        xhr.send(data);
      
    }
    /// remove pdf file
    function customerDeleteAttachedFile(el)
    {
        let companyId = AttactCustomerEl.querySelector('input[name="company-id"]').value;
        let tr = CustomerListElement.querySelector(`tr[company-id="${companyId}"]`);
        let field = AttactCustomerEl.querySelector('[name="field"]').value
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
                        const request = await fetch(`webpanel/my-job/customer-list/attach-file/delete${queryString}`);
                        if (request.status != 200 ) {
                            Alert({status:false, message:`${request.status} ${request.statusText}`});
                            return {status:false, message:`${request.status} ${request.statusText}`};
                        }
                        const response = await request.json();
                        return response;
                    }
                    Request({
                        companyId: companyId,
                        field: AttactCustomerEl.querySelector('[name="field"]').value
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
    const updateContract = async(params) => 
    {
        let queryString = Object.keys(params).map(k=>`${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`).join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`webpanel/my-job/customer-list/contract/update${queryString}`);
        if(request.status != 200){
            let res = {status:false,message:`${request.status} ${request.statusText}`};
            Alert(res); return res;
        }
        const response = await request.json();
        return response;

    }
    const getDataCustomerList = async(params) =>
    {
        let queryString = Object.keys(params).map(k=>`${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`).join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/customer-list${queryString}`);
        if (request.status != 200) {
            let res = {status:false,message:`${request.status} ${request.statusText}`};
            Alert(res);
            return res;
        }
        const response = await request.json();
        return response;
    }
    function Items(res)
    {
        if (res?.meta) {
            CustomerListElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        CustomerListElement.querySelector('tbody').innerHTML = '';
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
                let apmDate = '-';
                tr.innerHTML = `
                    <td class="text-center align-middle">${start++}</td>
                    <td class="align-middle">
                        <div class="mb-0 design-stock-list">
                            <p class="m-0"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                            <p class="m-0"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                            <span class="badge badge-primary-light">${v.categoryNo}. ${v.categoryNameEN}</span>
                        </div>
                    </td>
                    <td>${v.package}</td>
                    <td class="text-center px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            ${v.assignCsId 
                                ?   `<a class="user bg-primary assignmen" user-id="${v.assignCsId}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.assignCsName}">${v.assignCsDisplay}</a>`
                                :   `<a class="user bg-secondary assignment sale-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="px-1 text-center">
                        ${v.copyright != null ?
                            `<a href="javascript:" class="badge badge-primary-light" modal-attach" copyright="${v.copyright}">
                                ${v.copyright.split('.')[1].toUpperCase()}<i class="fas fa-file-pdf ml-1"></i>
                            </a>
                            <div class="d-flex justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.copyrightName}">${v.copyrightDisplay}</a>
                            </div>
                            `:``
                        }
                    </td>
                    <td class="text-center px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            ${v.assignSaleId 
                                ?   `<a class="user bg-primary ${!v.assignSaleId?`document-upload-process`:``} assignmen" user-id="${v.assignSaleId}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.assignSaleName}">${v.assignSaleDisplay}</a>`
                                :   `<a class="user bg-secondary assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="text-center px-1">
                        <a href="javascript:" class="badge${v.quotation?` badge-lightpurple`:` badge-light`} ${!v.quotation?`document-upload-process`:`px-3`} quotation" data-field="quotation" ${v.quotation?`data-file="${v.quotation}"`:``}>
                            ${v.quotation?`PDF<i class="fas fa-file-pdf ml-1"></i>`:`<i class="fas fa-paperclip mr-1"></i>Attach File`}
                        </a>
                        ${v.quotation ?
                            `<div class="d-flex justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.quotationName}">${v.quotationDisplay}</a>
                            </div>
                            `:``
                        }
                    </td>
                    <td class="text-center">
                        <a href="javascript:" class="badge${v.countersign?` badge-lightpink`:` badge-light`} ${!v.countersign?`document-upload-process`:`px-3`} countersign" data-field="countersign" ${v.countersign?`data-file="${v.countersign}"`:``}>
                            ${v.countersign?`PDF<i class="fas fa-file-pdf ml-1"></i>`:`<i class="fas fa-paperclip mr-1"></i>Attach File`}
                        </a>
                        ${v.countersign ?
                            `<div class="d-flex justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.countersignName}">${v.countersignDisplay}</a>
                            </div>
                            `:``
                        }
                    </td>
                    <td class="text-center">
                        <a href="javascript:" class="badge${v.document?` badge-info`:` badge-light`} ${!v.document?`document-upload-process`:`px-3`} document" data-field="document" ${v.document?`data-file="${v.document}"`:``}>
                            ${v.document?`PDF<i class="fas fa-file-pdf ml-1"></i>`:`<i class="fas fa-paperclip mr-1"></i>Attach File`}
                        </a>
                        ${v.documentName?
                            `<div class="d-flex justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.documentName}">${v.documentDisplay}</a>
                            </div>`
                            :``
                        }
                        
                    </td>
                    <td class="text-center">
                        <a href="javascript:" class="badge${v.agreement?` badge-success`:` badge-light`} ${!v.agreement?`document-upload-process`:`px-3`} agreement" data-field="agreement" ${v.agreement?`data-file="${v.agreement}"`:``}>
                            ${v.agreement?`PDF<i class="fas fa-file-pdf ml-1"></i>`:`<i class="fas fa-paperclip mr-1"></i>Attach File`}
                        </a>
                        ${v.agreementName?
                            `<div class="d-flex justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.agreementName}">${v.agreementDisplay}</a>
                            </div>`
                            :``
                        }
                    </td>
                    <td class="text-center px-1">
                        ${v.contract
                            ?   `<div class="contract-date">
                                    <p class="m-0 fs-13"><strong>Start: </strong>${v.contract_start}</p>
                                    <p class="m-0 fs-13"><strong>End: </strong>${v.contract_end}</p>
                                    <a href="javascript:" class="badge badge-light contract-date" data-start="${moment(v.contract_start).format('DD/MM/YYYY')}" data-end="${moment(v.contract_end).format('DD/MM/YYYY')}">Edit</a>
                                </div>`
                            :   `<a class="badge badge-secondary contract-date" href="javascript:">Add</a>`
                        }
                    </td>
                    <td class="text-center">
                        ${v.keyword 
                            ?   `<a class="badge badge-success" href="javascript:">Checked keyword</a>`
                            :   `<a class="text-dark checking-keyword fs-12" href="javascript:">Checking keyword</a>`
                        }
                    </td>
                `;
                CustomerListElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
            CustomerListElement.querySelector('tbody').append(tr);
        }
    }
    const CustomerPaginate = new Pagination({
        content: CustomerListElement,
        rows: getDataCustomerList,
        items: Items,
        search: {
            assignment: CustomerListElement.querySelector('input[name="assignment"]'),
            category: CustomerListElement.querySelector('select[name="category"]'),
            keyword: CustomerListElement.querySelector('input[name="keyword"]'),
            submit: CustomerListElement.querySelector('[type="submit"]'),
            reset: CustomerListElement.querySelector('[type="reset"]')
        },
        refresh: CustomerListElement.querySelector('.refresh')
    });

    document.addEventListener('click',function(e){
        const CustomerAttachBtn = e.target.closest('.document-upload-process');
        if(CustomerAttachBtn) {
            let tr = CustomerAttachBtn.closest('tr');
            let label = CustomerAttachBtn.getAttribute('data-field');
            let file = CustomerAttachBtn?.getAttribute('data-file');
            AttactCustomerEl.querySelector('.pdf-row').innerHTML = '';
            AttactCustomerEl.querySelector('.custom-file-label').innerHTML = 'Choose file';
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
                AttactCustomerEl.querySelector('.pdf-row').append(item);
            }
            
            AttactCustomerEl.querySelector('input[name="company-id"]').value = tr.getAttribute('company-id');
            // AttactCustomerEl.querySelector('.presentation-file').innerHTML = '';
            AttactCustomerEl.querySelector('input[name="field"]').value = CustomerAttachBtn.getAttribute('data-field');
            AttactCustomerEl.querySelector('.label').innerHTML = label + ' file';
            AttactModal.show();

        }
        const removeCustomerFile = e.target.closest('.customer-pdf-remove');
        if(removeCustomerFile) {
            customerDeleteAttachedFile(removeCustomerFile)
        }
        const CheckingKeywordBtn = e.target.closest('.checking-keyword');
        if(CheckingKeywordBtn) {
            let tr = CheckingKeywordBtn.closest('tr');
            KeywordModalEl.querySelector('[name="company-id"]').value = tr.getAttribute('company-id');
            KeywordModal.show();
        }
        const contactDateBtn = e.target.closest('.contract-date');
        if(contactDateBtn && contactDateBtn.tagName == 'A') {
            let tr = contactDateBtn.closest('tr');
            ContractModalEl.querySelector('[name="company-id"]').value = tr.getAttribute('company-id');
            if(contactDateBtn?.getAttribute('data-start')){
                ContractModalEl.querySelector('[name="start"]').value = contactDateBtn?.getAttribute('data-start');
                ContractModalEl.querySelector('[name="end"]').value = contactDateBtn?.getAttribute('data-end');
            }
            ContracModal.show();
        }
        const contractSaveEdit = e.target.closest('.contract-save-edit');
        if(contractSaveEdit) {
            let loadIcon = document.createElement('span');
            let currentIcon = contractSaveEdit.querySelector('span').cloneNode(true);
            let tr = ContractModalEl.querySelector('[name="company-id"]').value;
            loadIcon.setAttribute('class','loader-xs mr-2');
            contractSaveEdit.querySelector('span').replaceWith(loadIcon);
            let data = {
                companyId: ContractModalEl.querySelector('[name="company-id"]').value,
                start: ContractModalEl.querySelector('[name="start"]').value,
                end: ContractModalEl.querySelector('[name="end"]').value,
            }
            updateContract(data).then(res => {
                Alert(res);
                contractSaveEdit.querySelector('span').replaceWith(currentIcon);
                if(res.status === true){
                    let contractLabel = document.createElement('div');
                    contractLabel.setAttribute('class','contract-list');
                    contractLabel.innerHTML = `<p class="m-0 fs-13"><strong>Start: </strong>${moment(data.start).format('dd/mm/YYY')}</p><p class="m-0 fs-13"><strong>End: </strong>${moment(data.end).format('dd/mm/YYYY')}</p><a class="fs-10 badge badge-light contract-date" href="javascript:">Edit</a>`;
                    tr.querySelector('div.contract-list').replaceWith(contractLabel);
                }
            })
        }
    });
    document.addEventListener('change',function(e){
        const customerFile = e.target.closest('.customer-file');
        if(customerFile){
            let file = customerFile.files[0];
            let fileName = file.name;
            let field = customerFile.closest('.modal-body')?.querySelector('input[name="field"]').value;
            CustomerUploadFile(fileName,file,field,customerFile);
        }
    })
</script>