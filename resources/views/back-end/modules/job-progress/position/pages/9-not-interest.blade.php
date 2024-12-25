<div class="row">
    <div class="col-lg-12">
        <div class="card not-interest">
            <div class="card-header card-header d-flex">
                <h5 class="mb-0">
                    9. Not Interest
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
                                <th class="text-center">Assign CS</th>
                                <th class="text-center">Copyright</th>
                                <th class="text-center">Assign Sele</th>
                                <th class="text-center">Quotation</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Return</th>
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

<script>
    var NotInterestElement = document.querySelector('.not-interest');

    const getNotInterestData = async(params) => {
        let queryString = Object.keys(params).map(k=>`${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`).join('&')
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/not-interest${queryString}`);
        if (request.status != 200) {
            let res = {status:false,message:`${request.status} ${request.statusText}`};
            Alert(res);
            return res;
        }
        const response = await request.json();
        return response;
    }
    const ReturnRecord = async(params) => {
        let queryString = Object.keys(params).map(k=>`${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`).join('&')
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`webpanel/my-job/not-interest/return-record${queryString}`);
    }
    function Items(res)
    {
        if (res?.meta) {
            NotInterestElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        NotInterestElement.querySelector('tbody').innerHTML = '';
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
                    <td class="text-center px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            ${v.assignCsId 
                                ?   `<a class="user bg-primary assignmen" user-id="${v.assignCsId}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.assignCsName}">${v.assignCsDisplay}</a>`
                                :   `<a class="user bg-secondary assignment sale-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="px-1 text-center">
                        ${v.copyright ?
                            `<a href="javascript:" class="badge badge-primary-light" modal-attach" copyright="${v.copyright}">
                                ${v.copyright.split('.')[1].toUpperCase()}<i class="fas fa-file-pdf ml-1"></i>
                            </a>
                            <div class="d-flex justify-content-center mt-1">
                                <span>by</span>
                                <a class="user user-sm badge-assignment fs-10 ml-1" href="javascript:" data-placement="top" data-toggle="tooltip" data-original-title="${v.copyrightName}">${v.copyrightDisplay}</a>
                            </div>
                            `:`-`
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
                    <td>
                        ${v.status?`${v.status}`:`<p class="m-0 text-center">-</p>`}
                    </td>
                    <td class="text-center">
                        <div style="display:grid;">
                            <div class="return" data-default="Return">
                                <div class="return-label">
                                    <span>Return</span><i class="fas fa-caret-down ml-1"></i>
                                </div>
                                <div class="return-dropdown">
                                    <a class="return-item" data-return="appointment">Appointment</a>
                                    <a class="return-item" data-return="presentation">Presentation</a>
                                </div>
                            </div>
                        </div>
                    </td>
                `;
                NotInterestElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
            NotInterestElement.querySelector('tbody').append(tr);
        }
    }
    const NotInterestPaginate = new Pagination({
        content: NotInterestElement,
        rows: getNotInterestData,
        items: Items,
        search: {
            assignment: NotInterestElement.querySelector('input[name="assignment"]'),
            category: NotInterestElement.querySelector('select[name="category"]'),
            keyword: NotInterestElement.querySelector('input[name="keyword"]'),
            submit: NotInterestElement.querySelector('[type="submit"]'),
            reset: NotInterestElement.querySelector('[type="reset"]')
        },
        refresh: NotInterestElement.querySelector('.refresh')
    });

    document.addEventListener('click',function(e){
        const returnDropdown = e.target.closest('.return');
        if (returnDropdown) {
            if(!returnDropdown.classList.contains('show')) returnDropdown.classList.add('show');
            else returnDropdown.classList.remove('show');
        }
        const returnItem = e.target.closest('.return-item');
        if(returnItem) {
            let tr = returnItem.closest('tr');
            let to = returnItem.getAttribute('data-return');
            let current = returnItem.closest('.return').getAttribute('data-default');
            let span = returnItem.closest('.return').querySelector('.return-label > span');
            span.innerHTML = to;
            ReturnRecord({companyId:tr.getAttribute('company-id'),return:to}).then(res=>{
                if(res?.status !== true) {
                    span.innerHTML = current;
                }
            })
        }
    })

</script>