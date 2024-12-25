<div class="row">
    <div class="col-lg-12">
        <div class="card complete-on-process">
            <div class="card-header card-header d-flex">
                <div class="mb-0 fs-18 d-flex align-items-center">
                    <span>5. Complete</span>
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
                    <select name="license_attachfile" class="form-control form-control-sm br-15 mx-2 cs-droplist">
                        <option value="yes">Copyright</option>
                        <option value="no">No copyright</option>
                    </select>
                    <input type="text" name="keyword" class="form-control form-control-sm br-15" placeholder="Search Company Name..." aria-label="Search Company Name..." aria-describedby="button-addon1">
                    <button class="btn btn-primary btn-sm br-15 ml-2 submit" type="submit"><i class="fas fa-search-plus pr-1"></i> Search</button>
                    <button class="btn btn-outline-danger btn-sm br-15 ml-2 reset" type="reset"><i class="fas fa-history pr-1"></i> Reset</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="">
                        <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                                <th class="text-center" width="5%">NO.</th>
                                <th width="35%">Company Name</th>
                                <th class="">Category  </th>
                                <th class="">Status</th>
                                <th class="">Refuse</th>
                                <th class="r">Copyright</th>
                                <th class="th-cannot-contact">Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr class="align-middle checkbox-group" >
                                <td class="text-center align-middle" rowspan="2">1</td>
                                <td class="text-center align-middle" rowspan="2"></td>
                                <td class="align-middle" rowspan="2">
                                    <a class="text-dark" href="#">
                                        <p class="mb-0">YNP TRANSPORT LIMITED PARTNERSHIP</p>
                                    </a>
                                </td>
                                <td class="text-center"  rowspan="2"><small>Logistics, Warehouse &amp; Delivery</small></td>
                                <td class="text-center"><a href="webpanel/blog/1183/visa-support" target="_blank" class="badge bg-light text-dark"><i class="fas fa-eye"></i> Preview</a></td>
                                <td class="text-center"><span class="badge badge-success"><i class="fas fa-check"></i> Public</span></td>
                                <td class="text-center"><a href="#" class="badge inbox-link"><i class="far fa-file-pdf"></i>.pdf</a></td>
                            </tr> --}}
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
    var CompleteElement = document.querySelector('.complete-on-process');
    async function GetComplete() {
        const request = await fetch(`api/my-job/complete?status=done`);
        const response = await request.json();
        return response;
    }

    function CompleteItems(res)
    {
        if (res?.meta) {
            CompleteElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        CompleteElement.querySelector('tbody').innerHTML = '';
        if( res.data.length > 0 ){
            res?.data.map(function(v,k){
                let copyright = v.copyright;
                let ext = copyright ? copyright.split('.')[1].toUpperCase() : '';
                let tr = document.createElement('tr');
                tr.setAttribute('row-id', v.rowId);
                tr.innerHTML = `<tr>
                    <td class="text-center align-top">${start++}</td>
                    <td class="text-left align-top">
                        <div class="mb-0 design-stock-list">
                            <p class="m-0"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                            <p class="m-0"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                        </div>
                    </td>
                    <td class="align-top"><small class="font-weight-bold">${v.categoryNameEN}</small></td>
                    <td>
                        ${ v.created 
                            ? `<a class="badge badge-${v.status==1?`success`:`light`}" href="javascript:">${v.status==1?`Online`:`Offline`}</a>`
                            : `<a class="badge badge-danger" href="javascript:">Not created</a>`
                        }
                    </td>
                    <td class="align-top">${(v.refuse!='')?`<a class="badge badge-danger font-weight-bold" href="javascript:">Refuse by ${v.refuseName} <i class="fas fa-comment fa-fw"></i></a></br><small class="text-danger">${moment(v.refuse).format('D MMM YYYY, H:mm')}</small>`:``}</td>
                    <td>${(!v.refuse)?`${v.copyright?`<a href="${ext=='PDF'?`readfile?file=${v.copyright}`:`${v.copyright}`}">${ext}</a>`:`-`}`:`-`}</td>
                    <td class="align-top">${(!v.refuse)?`-`:`<a class="badge badge-success" href="th/preview/${v.cid}" target="_blank">Preview</a>`}</td>
                    <td class="text-center align-top">${(!v.refuse)?`-`:``}</td>
                </tr>`;
                CompleteElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
            CompleteElement.querySelector('tbody').append(tr);
        }
    }
    const CompleteData = new Pagination({
        content: CompleteElement,
        rows: GetComplete,
        items: CompleteItems,
        search: {
            keyword: CompleteElement.querySelector('[name="keyword"]'),
            submit: CompleteElement.querySelector('[type="submit"]'),
            reset: CompleteElement.querySelector('[type="reset"]')
        },
        refresh: CompleteElement.querySelector('.refresh')
    });
    document.addEventListener('click',function(e){
        
    });
    
</script>