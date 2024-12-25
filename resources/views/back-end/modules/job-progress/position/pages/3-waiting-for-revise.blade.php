<div class="row">
    <div class="col-lg-12">
        <div class="card waiting-for-revise">
            <div class="card-header d-flex">
                <div class="mb-0 fs-18 d-flex align-items-center">
                    <span>3. Waiting For Revise</span>
                    <span class="badge badge-info mx-1 count">0</span>
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
                    <select class="form-control form-control-sm br-15 filter_category ml-2" name="category"><option value="">Category</option><select>
                    <input type="text" name="keyword" class="form-control form-control-sm br-15 ml-2" placeholder="Search Company Name...">
                    <button class="btn btn-outline-primary btn-sm br-15 ml-2" type="submit"><i class="fas fa-search-plus pr-1"></i>Search</button>
                    <button class="btn btn-outline-danger btn-sm br-15 ml-2" type="reset"><i class="fas fa-history pr-1"></i>Reset</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th width="3%" rowspan="2">No.</th>
                                <th width="18%" rowspan="2">Company Name</th>
                                <th width="8%" rowspan="2">Tel.</th>
                                <th width="8%" rowspan="2">Email</th>
                                <th width="5%" rowspan="2" class="text-center">Ranking</th>
                                <th width="5%" rowspan="2" class="text-center">Assign</th>
                                <th width="8%" rowspan="2" class="text-center">Created</th>
                                <th width="8%" rowspan="2" class="text-center">Design</th>
                                <th class="text-center border-left p-1" colspan="3" width="16%">Avg. Statistics Per Month</th>
                            </tr>
                            <tr class="last-child">
                                <th class="text-center border-left p-1">Page view</th>
                                <th class="text-center border-left p-1">User</th>
                                <th class="text-center border-left p-1">Country</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
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
    var ReviseElement = document.querySelector('.waiting-for-revise');
     async function GetAllRevise(params)
    {
        let queryString = Object.keys(params)
             .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
             .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/waiting-for-revise${queryString}`);
        if (request.status != 200) {
            Alert({status:false,message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    function ReviseItems(res)
    {

        if (res?.meta) {
            ReviseElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        ReviseElement.querySelector('tbody').innerHTML = '';
        if( res.data.length > 0 ){
            res?.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id', v.rowId);
                tr.innerHTML = `<tr>
                    <td class="text-center align-top">${start++}</td>
                    <td class="text-left align-top">
                        <div class="mb-0 design-stock-list">
                            <p class="m-0 mw-375"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                            <p class="m-0 mw-375"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                            <span class="badge badge-primary-light">${v.categoryNo}. ${v.categoryNameEN}</span>
                            <div class="d-flex">
                                Order Revise by 
                                <a class="user badge-revise assignment ml-1" user-id="${v.reviseById}" href="javascript:" data-placement="top" data-toggle="tooltip" title="" data-original-title="${v.reviseByName}">${v.reviseByDisplay}</a>
                            </div>
                        </div>
                    </td>
                    <td class="align-top">${v.telephone}</td>
                    <td class="align-top">${v.email}</td>
                    <td class="text-center align-top">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            <a class="rank default dropdown font-weight-bold text-upper-case add-rank" href="javascript:" data-ranking="${v.ranking?v.ranking:``}">
                                ${v.ranking?`${v.ranking.toUpperCase()}`:``}
                            </a>
                        </div>
                    </td>
                    <td class="px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            ${v.assignment 
                                ?   `<a class="user bg-primary assignment" user-id="${v.assignment}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.assignName }">${v.assignDisplay}</a>`
                                :   `<a class="user bg-dark assignment add-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="text-center align-top">
                        ${ v.confirmedBy != null 
                            ?   `<div class="badge badge-info cursor position-relative">
                                    <a href="javascript:" class="cancel-for-booking badge-close" data-id="${v.rowId}"><i class="fas fa-times"></i></a>
                                    Confirmed By
                                    <span class="border-top border-top-info mt-1 pt-1 d-block">${v.confirmedBy}</span>
                                </div>`
                            :   `<div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input confirm-create" id="confirm-${v.rowId}" data-id="${v.rowId}">
                                    <label class="form-check-label pl-1" for="confirm-${v.rowId}"> Confirm</label>
                                </div>`
                        }
                    </td>
                    <td>
                        ${v.refues != null
                            ?   `<span class="badge badge-danger"><i class="fas fa-times mr-2"></i>Refuse</span>`
                            :   `<div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input refuse-created" id="created-${v.rowId}" data-id="${v.rowId}">
                                    <label class="form-check-label" for="created-${v.rowId}"> Refuse</label>
                                </div>`
                        }
                    </td>
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
                ReviseElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="12" class="text-center">No data record.</td>';
            ReviseElement.querySelector('tbody').append(tr);
        }
    }
    
    const ReviseData = new Pagination({
        content: ReviseElement,
        rows: GetAllRevise,
        items: ReviseItems,
        search: {
            assignment: ReviseElement.querySelector('input[name="assignment"]'),
            category: ReviseElement.querySelector('select[name="category"]'),
            keyword: ReviseElement.querySelector('[name="keyword"]'),
            submit: ReviseElement.querySelector('[type="submit"]'),
            reset: ReviseElement.querySelector('[type="reset"]')
        },
        refresh: ReviseElement.querySelector('.refresh')
    });
</script>