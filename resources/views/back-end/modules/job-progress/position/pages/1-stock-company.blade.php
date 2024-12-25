<div class="row">
    <div class="col-lg-12">
        <div class="card stock-company">
            {{-- flex-between-center --}}
            <div class="card-header d-flex">
                <div class="mb-0 fs-18 d-flex align-items-center">
                    <span>1. Stock Company Profile List</span>
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
                    <select class="form-control form-control-sm br-15 ml-2 filter_category" name="category"><option value="">Category</option><select>
                    <input type="text" name="keyword" class="form-control form-control-sm br-15 ml-2" placeholder="Search Company Name...">
                    <button class="btn btn-outline-primary br-15 ml-2" type="submit"><i class="fas fa-search-plus"></i></button>
                    <button class="btn btn-outline-danger br-15 ml-2" type="reset"><i class="fas fa-history"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr>
                                <th width="3%">No.</th>
                                <th width="25%">Company Name</th>
                                <th>Tel.</th>
                                <th>Email</th>
                                <th class="text-center">Add Row Date</th>
                                <th class="text-center">Ranking</th>
                                <th class="text-center">Assign</th>
                                <th class="text-center">Create</th>
                                <th>Refuse</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto">
                        @if(Auth::user()->name == 'HOCKY' || Auth::user()->name == 'TUM')
                        <button class="btn btn-secondary btn-sm br-15 btn-import"><i class="fas fa-file-import pr-2"></i> Import</button>
                        @endif
                    </div>
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
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm br-15 btn-add-row"><i class="fas fa-plus fa-fw"></i> Add Row</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="RowModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content br-3x">
            <div class="modal-header modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title title-success" id="exampleModalLabel">
                    <i class="far fa-edit fa-xs mr-1"></i> Row Form
                </h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="row" value="">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category" id="row_category"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-xs-12">
                            <div class="form-group">
                                <label for="">Company ID</label>
                                <input type="text" name="company" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-xs-12">
                            <div class="form-group">
                                <label for="">Title(TH)</label>
                                <select name="title" class="form-control">
                                    <option value="บริษัท-Company">บริษัท/Company</option>
                                    <option value="ห้างหุ้นส่วน-Partnership">ห้างหุ้นส่วน/Partnership</option>
                                    <option value="บุคคลธรรมดา-Individual">บุคคลธรรมดา/Individual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="">Company Name (TH)</label>
                                <input type="text" name="name_th" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="">Company Name (EN)</label>
                                <input type="text" name="name_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Telephone</label>
                                <input type="text" name="telephone" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Website</label>
                                <input type="text" name="website" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <div class="action-add d-none">
                    <button type="button" class="btn btn-primary btn-sm br-15 add-row"><i class="fas fa-save pr-2"></i> Confirm</button>
                </div>
                <div class="action-edit d-none">
                    <button type="button" class="btn btn-warning btn-sm br-15 update-row"><i class="fas fa-save pr-2"></i> Update</button>
                    <button type="button" class="btn btn-warning btn-sm br-15 update-cid d-none"><i class="fas fa-save pr-2"></i> Update ID</button>
                </div>
                <button type="button" class="btn btn-secondary btn-sm br-15" data-dismiss="modal" onclick="ClearModal()">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImport">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">   
                <form>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="font-weight-bold text-danger">Category</label>
                            <select name="category" id="import_category"><option>Please select</option></select>
                        </div>
                        <div class="col-lg-7">
                            <label for="" class="font-weight-bold text-danger">.csv file only</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Select file:</span>
                                </div>
                                <div class="custom-file">
                                    <input 
                                        type="file"
                                        name="import"
                                        class="custom-file-input" 
                                        aria-describedby="inputGroupFileAddon01"
                                        accept=".csv"
                                    >
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="preview" style="max-height: 65vh; overflow-y:auto;"></div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-warning btn-sm br-15 import-reset"><i class="fas fa-sync-alt pr-2"></i>Reset</button>
                <button type="button" class="btn btn-primary btn-sm br-15 import-to-table"><i class="fas fa-file-import pr-2"></i> Import</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalRefuse">
    <div class="modal-dialog" role="document">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Refuse</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Refuse By:</label>
                        <input type="hidden" name="cid" id="cid">
                        <input type="hidden" name="jid" id="jid">
                        <input readonly type="text" class="form-control" name="id" id="id"
                            data-id="{{ Auth::user()->id }}" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="mail" value="1"
                            name="mail">
                        <label class="form-check-label badge badge-info" for="mail">Mail</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="notmail" value="0"
                            name="mail">
                        <label class="form-check-label badge badge-danger" for="notmail">Not Mail</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="status" value="done" name="status" checked="">
                        <label class="form-check-label badge badge-success" for="status">Done</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm br-15 cancelRefuse" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm br-15 confirmRefuse">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    var userId = parseInt(`{{Auth::user()->id}}`);
    var userName = document.querySelector('input[name="user_name"]').value;
    var RowContent = document.querySelector('#RowModal');
    var RowModal = new bootstrap.Modal(RowContent,{ backdrop: false, keyboard: true});
    // var RowCategorySelect = new SlimSelect({select:'#row_category',placeholder:'Please Select'});
    var ImportContent = document.querySelector('#ModalImport');
    var ImportModal = new bootstrap.Modal(ImportContent,{backdrop: false,keyboard: true});
    var RowCategorySelect = new SlimSelect({select:'#row_category',placeholder:'Please Select'});
    var ImportCategorySelect = new SlimSelect({select:'#import_category',placeholder:'Please Select'});
    var RefuseContent = document.querySelector('#ModalRefuse');
    var RefuseModal = new bootstrap.Modal(RefuseContent,{backdrop:false, keyboard:true});
    var StockElement = document.querySelector('.stock-company');
    var required = document.createElement('i'); 
        required.setAttribute('class','text-danger ml-2'); 
        required.innerHTML = `* กรุณาเลือก`;
    var Categories;
    var user = JSON.parse(document.querySelector('[name="user"]').value);


    // Draggable(RowContent);
    function SetCategoryToAllCard()
    {
        RequestCategory().then(res => {
            Categories = res;
            let options = '<option value="">Category</option>';

            const elements = document.querySelectorAll('.filter_category');
            
            Categories.map(function(m){
                m.sub.map(function(s){
                    options += `<optgroup label="${s.name_en}">`;
                    s.category.map(function(c){
                        if(c.name_th != null) options += `<option value="${c.id}">${c.no} ${c.name_en}</option>`;
                    })
                    options += `</optgroup>`;
                })
            })
            elements.forEach((el)=>{
                el.innerHTML = options;
            });
        });
    }
    SetCategoryToAllCard();

    async function getAssignmentFromRecord()
    {
        const request = await fetch(`api/my-job/assignment`);
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = request.json();
        return response;
    }

    getAssignmentFromRecord().then(res => {
        const BoxAssignment = document.querySelectorAll('.user-assignment');
        BoxAssignment.forEach(function(el){ 
            let dropdownEl = document.createElement('div');
            dropdownEl.setAttribute('class','dropdown-menu assignment-menu');
            let html = `<a class="dropdown-item assignment-item fs-12" onclick="selectToAssignment(this)" href="javascript:" data-value="">All</a>`;
            res.map(function(v){
                html += `<a class="dropdown-item assignment-item fs-12" onclick="selectToAssignment(this)" href="javascript:" data-value="${v.id}" display="${v.display}">
                    <strong class="badge badge-primary br-15 mr-1">${v.display}</strong> ${v.name}
                </a>`;
            })
            dropdownEl.innerHTML = html;
            el.append(dropdownEl)
        });
    })

    function selectToAssignment(el){
        val = el.getAttribute('data-value');
        assignBtn = el.closest('.user-assignment');
        currentIco = document.createElement('span');
        currentIco.setAttribute('class','fas fa-filter fa-lg');
        if (val != '') {
            display = el.getAttribute('display');
            el.closest('.user-assignment').querySelector('input[name="assignment"]').value = el.getAttribute('data-value');
            assignBtn.querySelector('span').classList.remove('fas','fa-filter');
            assignBtn.querySelector('span').innerHTML = display;
        }else{
            assignBtn.querySelector('span').innerHTML = '';
            assignBtn.querySelector('span').classList.add('fas','fa-filter');
            el.closest('.user-assignment').querySelector('input[name="assignment"]').value = '';
        }
    }

    async function RequestCategory()
    {
        const request = await fetch('api/get/category/all?lang=all');
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    async function AddRow(data)
    {
        data._method = 'PUT';
        const request = await fetch('webpanel/my-job/cs/add-row',{
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content,
            },
            body:JSON.stringify(data)
        });
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const reponse = await request.json();
        return reponse;
    }
    async function updateRow(data)
    {
        const request = await fetch(`webpanel/my-job/stock/${data.id}`,{
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content,
            },
            body:JSON.stringify(data)
        });
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const reponse = await request.json();
        return reponse;
    }

    async function ConfirmForCreate(data)
    {
        const request = await fetch(`webpanel/my-job/stock/confirm`,{
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content,
            },
            body:JSON.stringify(data)
        });
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const reponse = await request.json();
        return reponse;

    }
    async function CancelConfirm(id)
    {
        const request = await fetch(`webpanel/my-job/stock/confirm/cancel?id=${id}`);
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const reponse = await request.json();
        return reponse;
    }
    async function BookingCreate(id)
    {
        const request = await fetch(`webpanel/my-job/stock/booking?id=${id}`);
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }

    // async function createdFor(id)
    // {
    //     const request = await fetch(`webpanel/my-job/stock/created?id=${id}`);
    //     if (request.status != 200 ) {
    //             Alert({status:false, message:`${request.status} ${request.statusText}`});
    //             return {status:false, message:`${request.status} ${request.statusText}`};
    //         }
    //     const response = await request.json();
    //     return response;
    // }
    async function RefuseCreate(params)
    {
        let queryString = Object.keys(params)
            .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
            .join('&');
        const request = await fetch(`webpanel/my-job/refuse?${queryString}`);
        if(!request.ok) Alert({status:false,message:'500 Internal server error'});
        const response = await request.json();
        return response;
    }

    RequestCategory().then(res => { 
        Categories = res;
        let options = '<option value="">กรุณาเลือก</option>';
        let selected = ImportContent.querySelector('select[name="category"]').getAttribute('selected');
        const element = [
            RowContent.querySelector('select[name="category"]'),
            ImportContent.querySelector('select[name="category"]')
        ];
        element.forEach((el)=>{
            Categories.map(function(m){
                m.sub.map(function(s){
                    options += `<optgroup label="${s.name_en}">`;
                    s.category.map(function(c){
                        if(c.name_th != null) options += `<option value="${c.id}" ${selected == c.id?`selected=""`:``}>${c.no} ${c.name_en}</option>`;
                    })
                    options += `</optgroup>`;
                })
            })
            el.innerHTML = options;
        })
    });
    const GetAllStock = async(params) => {
        let queryString = Object.keys(params)
             .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
             .join('&');
        const request = await fetch(`api/my-job/stock?${queryString}`);
        const response = await request.json();
        return response;
    }

    function StockItems(res)
    {

        if (res?.meta) {
            StockElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        StockElement.querySelector('tbody').innerHTML = '';
        if( res.data.length > 0 ){
            res?.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id', v.rowId);
                tr.innerHTML = `<tr>
                    <td class="text-center align-top">${start++}</td>
                    <td class="text-left align-top">
                        <div class="mb-0 design-stock-list">
                            <p class="m-0"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                            <p class="m-0"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                            <span class="badge badge-primary-light">${v.categoryNo}. ${v.categoryNameEN}</span>
                        </div>
                    </td>
                    <td class="align-top">${v.telephone}</td>
                    <td class="align-top">${v.email}</td>
                    <td class="text-center align-top">
                        <div class="fs-11">
                            <p class="m-0 p-0">${moment(v.addRowAt).format('D/M/YYYY')}</p>
                            <span class="font-weight-bold">By ${v.addRowName}<span>
                        </div>
                    </td>
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
                                    <a href="javascript:" class="cancel-confirm badge-close" data-id="${v.rowId}"><i class="fas fa-times"></i></a>
                                    Confirmed By
                                    <span class="border-top border-top-info mt-1 pt-1 d-block">${v.confirmedBy}</span>
                                </div>`
                            :   `<div class="form-group form-check"><input type="checkbox" class="form-check-input confirm-create" id="confirm-${v.rowId}" data-id="${v.rowId}"><label class="form-check-label pl-1" for="confirm-${v.rowId}"> Confirm</label></div>`
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
                    <td class="text-center align-top">
                        <div>
                            <a href="javascript:" class="badge badge-light edit-row" data-id="${v.rowId}">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <a href="javascript:" class="badge badge-danger delete-row" data-id="${v.rowId}">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                        <a href="javascript:" class="badge badge-info this-comment"><i class="fas fa-comment-alt"></i> Comments</a>
                    </td>
                </tr>`;
                StockElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="11" class="text-center">No data record.</td>';
            StockElement.querySelector('tbody').append(tr);
        }
    }
    
    const StockData = new Pagination({
        content: StockElement,
        rows: GetAllStock,
        items: StockItems,
        search: {
            assignment: StockElement.querySelector('input[name="assignment"]'),
            category: StockElement.querySelector('select[name="category"]'),
            keyword: StockElement.querySelector('input[name="keyword"]'),
            submit: StockElement.querySelector('[type="submit"]'),
            reset: StockElement.querySelector('[type="reset"]')
        },
        refresh: StockElement.querySelector('.refresh')
    });
    

    document.addEventListener('click',function(e){
        const addRow = e.target.closest('.btn-add-row');
        if(addRow){
            fetchUsers();
            RowContent.querySelector('.action-add').classList.remove('d-none');
            RowContent.querySelector('input[name="name_th"]').removeAttribute('readonly');
            RowContent.querySelector('input[name="name_en"]').removeAttribute('readonly');
            RowContent.querySelector('input[name="telephone"]').removeAttribute('readonly');
            RowContent.querySelector('input[name="email"]').removeAttribute('readonly');
            RowContent.querySelector('input[name="website"]').removeAttribute('readonly');
            RowModal.show();
        }
        const addRowBtn = e.target.closest('.add-row');
        if(addRowBtn)
        {
            let form = addRowBtn.closest('.modal-content').querySelector('form');
            const validate = Validate(form,{
                required: {
                    name_th:true,
                    name_en:true,
                    category:true,
                    telephone:true,
                    email:true,
                    website:true,
                },
                exist: { 
                    field: {
                        category, name_th, name_en, telephone, email, website 
                    },
                    url: 'my-job/add-row/exist'
                }
            });
            console.log(validate)
            if( validate === true ) AddRow({
                company: RowContent.querySelector('[name="company"]').value,
                title: RowContent.querySelector('[name="title"]').value,
                name_th: RowContent.querySelector('[name="name_th"]').value,
                name_en: RowContent.querySelector('[name="name_en"]').value,
                category: RowContent.querySelector('[name="category"]').value,
                telephone: RowContent.querySelector('[name="telephone"]').value,
                email: RowContent.querySelector('[name="email"]').value,
                website: RowContent.querySelector('[name="website"]').value
            }).then(r => {
                RowModal.hide();
                Alert(r);
                if (r.status == true) {
                    StockElement.querySelector('.refresh').click();
                    
                }
            });
        }
        const editRow = e.target.closest('.edit-row');
        if (editRow)
        {
            getRow(editRow.getAttribute('data-id')).then(res=>{
                RowCategorySelect.setSelected(res.category)
                RowContent.querySelector(`button.update-row`).setAttribute('data-id',res.id);
                RowContent.querySelector('.action-edit').classList.remove('d-none');
                RowContent.querySelector('[name="company"]').value = res.company;
                RowContent.querySelector('[name="name_th"]').value = res.name_th;
                RowContent.querySelector('[name="name_en"]').value = res.name_en;
                RowContent.querySelector('[name="category"]').value = res.category;
                RowContent.querySelector('[name="telephone"]').value = res.telephone;
                RowContent.querySelector('[name="email"]').value = res.email;
                RowContent.querySelector('[name="website"]').value = res.website;
                RowModal.show();
            })
        }
        const deleteRow = e.target.closest('.delete-row');
        if(deleteRow){
            let tr = deleteRow.closest('tr');
            if (confirm('Confirm to delete?') === true) {
                DeleteRow({
                    id: tr.getAttribute('row-id'),
                }).then(res => {
                    Alert(res);
                    if(res.status === true) StockElement.querySelector('.refresh').click();
                });
            }
        }
        // Ranking
        
        // add user assignment
        const addUserAssign = e.target.closest('.add-assignment');
        if(addUserAssign){
            let tr = addUserAssign.closest('tr');
            const Request = async () => {
                const request = await fetch(`webpanel/my-job/cs/on-process/assignment?id=${tr.getAttribute('row-id')}`);
                if(!request.ok) Error(request);
                const response = await request.json();
                return response;
            }
            Request().then(res=> {
                if (res.status === true) {
                    let item = document.createElement('a');
                    item.setAttribute('class','user bg-primary assignment');
                    item.href = 'javascript:';
                    item.innerHTML = user.display;
                    item.setAttribute('user-id',user.id);
                    item.setAttribute('data-placement','top');
                    item.setAttribute('data-toggle','tooltip');
                    item.title = user.name;
                    item.setAttribute('data',JSON.stringify({id:user.id,name:user.name,display:user.display}));
                    addUserAssign.replaceWith(item)
                }else{
                    Alert(res);
                }
            })
          
        }
        ImportBtn = e.target.closest('.btn-import')
        if(ImportBtn) {
            ImportModal.show();
        }
        const cancelFOrCreate = e.target.closest('.cancel-for-create');
        if (cancelFOrCreate)
        {
            if (confirm('Confirm to cancel?') === true) {
                createdFor(cancelFOrCreate.getAttribute('data-id')).then(r => {
                    Alert(r);
                })
            }
        }
        // const waitingCreated = e.target.closest('.waiting-created');
        // if(waitingCreated){
        //     createdFor(waitingCreated.getAttribute('data-id')).then(r => { 
        //         Alert(r);
        //         StockElement.querySelector('.refresh').click();
        //     });
        // }
        const refuseCreateEl = e.target.closest('.refuse-created');
        if (refuseCreateEl) {
            const tr = refuseCreateEl.closest('tr');
            const td = refuseCreateEl.closest('td');
            let jobId = tr.getAttribute('job-id');
            let companyId = tr.getAttribute('company-id');
            RefuseModal.show();
            document.addEventListener('click',(e) => {
                const btnConfirm = e.target.closest('.confirmRefuse');
                if (btnConfirm) {
                    let data = {
                        id : tr.getAttribute('row-id'),
                        msg: RefuseContent.querySelector('textarea[name="message"]').value,
                        mail: RefuseContent.querySelector('input[name="mail"]').value,
                        status: RefuseContent.querySelector('input[name="status"]:checked').value
                    };
                    if(jobId){
                        jid = jobId;
                        data = {...data, jid};
                    } 
                    if(companyId) {
                        cid = companyId;
                        data = {...data, cid};
                    }
                    console.log(data);
                    RefuseCreate(data).then(res => {
                        Alert(res);
                        if(res.status === true) {
                            RefuseModal.hide();
                            RefuseContent.querySelector('textarea[name="message"]').value = '';
                            RefuseContent.querySelector('input[name="mail"]').value = '';
                            td.innerHTML = '<a class="badge badge-danger" href="javascript:">Refuse</a>';
                            // toggleClass(el,'badge-light badge-info');
                            // toggleClass(el.querySelector('i'),'far fas');
                            // toggleClass(el.querySelector('i'),'fa-circle fa-check-circle');
                            setTimeout(() => {
                                StockElement.querySelector('.refresh').click();
                            }, 1500);
                        }
                    })
                }
                const closeRefuse = e.target.closest('.closeRefuse');
                if(closeRefuse){
                    console.log(closeRefuse)
                }
            })

            
        }
        const bookingWaitingForCreate = e.target.closest('.booking-waiting-for-create');
        if (bookingWaitingForCreate) {
            BookingCreate(bookingWaitingForCreate.getAttribute('data-id')).then(res => {
                StockElement.querySelector('.refresh').click();
            })
        }

        const cancelConfirm = e.target.closest('.cancel-confirm');
        if (cancelConfirm) {

            if (confirm('Confirm to cancel?') === true) {
                CancelConfirm(cancelConfirm.getAttribute('data-id')).then(r => {
                    Alert(r);
                    StockElement.querySelector('.refresh').click();
                })
            }
        }
        const rankingDropdown = e.target.closest('.add-rank');
        const closeRanking = e.target.closest('.close-ranking');
        if(rankingDropdown && !closeRanking) {
            document.querySelector('.ranking-menu')?.remove();
            RankingDropdownElement(rankingDropdown)
        }
        if(closeRanking){
            closeRanking.closest('.ranking-menu')?.remove();
        }

        const userAssignmentSelect = e.target.closest('.user-assignment');
        if (userAssignmentSelect) {
            dropdown = userAssignmentSelect.querySelector('.assignment-menu');
            if(dropdown) toggleClass(dropdown,'show');
        }

    });

    document.addEventListener('change',function(e){
        const confirmCreateBtn = e.target.closest('.confirm-create');
        if(confirmCreateBtn) {
            let tr = confirmCreateBtn.closest('tr');
            ConfirmForCreate({
                id: tr.getAttribute('row-id')
            }).then(res => {
                if(res.status === true){
                    confirmCreateBtn.closest('td').innerHTML = 
                    `<div class="badge badge-info cursor position-relative">
                        <a href="javascript:" class="cancel-confirm badge-close" data-id="${confirmCreateBtn.closest('tr').getAttribute('row-id')}"><i class="fas fa-times"></i></a>
                        Confirmed By
                        <span class="border-top border-top-info mt-1 pt-1 d-block">${user.name}</span>
                    </div>`
                }
                Alert(res);
                StockElement.querySelector('.refresh').click();
            })
        }
        const cancelConfirmBtn = e.target.closest('.cancel-confirm');
        if(cancelConfirmBtn){
            let tr = cancelConfirmBtn.closest('tr');
            CancelConfirm(tr.getAttribute('row-id')).the(res=>{
                Alert(res);
                if (res.status === true) {
                    cancelConfirmBtn.closest('td').innerHTML = 
                    `<div class="form-group form-check">
                        <input type="checkbox" class="form-check-input confirm-create" id="confirm-${tr.getAttribute('row-id')}" data-id="${tr.getAttribute('row-id')}">
                        <label class="form-check-label pl-1" for="confirm-${tr.getAttribute('row-id')}"> Confirm</label>
                    </div>`;
                }
            })
        }
    })
    function RankingItem(e){
        let tr = e.closest('tr');
        let old = e.closest('.add-rank').getAttribute('data-ranking');
        let rank = e.getAttribute('data-rank');
        let set = e.closest('.add-rank');
        let text = rank.toUpperCase();
        set.innerHTML = text;
        const Request = async () => {
            const request = await fetch(`webpanel/my-job/ranking?id=${tr.getAttribute('row-id')}&ranking=${rank}`);
            if(!request.ok) Alert({status:false,message:'500, Internal server error'});
            const response = request.json();
            return response;
        }
        Request().then(res=> {
            if (res.status === false) {
                Alert(res);
                set.innerHTML = (!old) ? ' ' : old;
            }
        })
    }
    function  ResetRanking(e)
    {
        
        let tr = e.closest('tr');
        let rowId = tr.getAttribute('row-id');
        let a = e.closest('.add-rank');
        let old = e.getAttribute('data-ranking');
        a.innerHTML = '';
        const Request = async () => {
            const request = await fetch(`webpanel/my-job/ranking/reset?id=${rowId}`);
            if(!request.ok) Alert({status:false,message:'500 Internal server error'});
            const response = await request.json();
            return response;
        } 
        Request().then(res => {
            if (res.status == false) {
                Alert(res);
                a.innerHTML = (!old) ? ' ' : old;
            }
        });
    }
    var RankingDropdownElement = (element) =>
    {
        const div = document.createElement('div');
        if(!element.querySelector('.dropdown-menu'))
        {
            div.setAttribute('class','dropdown-menu ranking-menu show');
            div.innerHTML = `
                <a class="badge badge-secondary badge-close close-ranking" href="javascript:">
                    <i class="fas fa-times"></i>
                </a>
                <a class="dropdown-item ranking-item" onclick="RankingItem(this)" href="javascript:" data-rank="a">
                    <strong>A
                        <i class="far fa-star ml-2"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i
                    </strong>
                </a>
                <a class="dropdown-item ranking-item" onclick="RankingItem(this)" href="javascript:" data-rank="b">
                    <strong>B
                        <i class="far fa-star ml-2"></i>
                        <i class="far fa-star"></i></strong>
                </a>
                <a class="dropdown-item ranking-item" onclick="RankingItem(this)" href="javascript:" data-rank="c">
                    <strong>
                        C <i class="far fa-star ml-2"></i>
                    </strong>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item reset-ranking" onclick="ResetRanking(this)" href="javascript:">
                    <i class="fas fa-history mr-2"></i> Reset
                </a>
            `;
            element.append(div);
        }
    }
    function Validate(form,e){
        let required = [];
        if(e.required && form){
            Object.entries(e.required).map(function(v,k){
                if(v[1] === true){
                    const input = form.querySelector(`[name="${v[0]}"]`);
                    if(input){
                        let label = document.createElement('i');
                        label.setAttribute('class','text-danger font-weight-bold ml-1');
                        label.innerHTML = `required *`;
                        if (input?.value=='') {
                            if (input.closest('.form-group')?.querySelector('i') == null) input.closest('.form-group')?.querySelector('label').append(label);
                            input.classList.add('error');
                            required.push(v[0]);
                        } 
                        else {
                            input.closest('.form-group').querySelector('i')?.remove();
                            input.classList.remove('error');
                            delete required[v[0]];
                        }
                    }
                }
                
            });
        }
        if(!form) {
            console.warn('Form element not found!');
            return false;
        }
        return required.length == 0 ? true : false ;
    }
    const readFileImport = () =>{
        const reader = new FileReader()
        reader.onload = () => {
            const table = document.createElement('table');
            table.setAttribute('class','table table-striped');
            table.style.fontSize = '13px';
            table.createTHead(0);
            table.querySelector('thead').innerHTML = `
                <th>No.</th>
                <th>Company name[TH]</th>
                <th>Company name[EN]</th>
                <th>Address</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Website</th>
            `;
            const data = reader.result.split('\r');
            const head = data[0].split(',');
            const column = []
            column[0] = 0;
            column[1] = head.indexOf('บริษัท[TH]');
            column[2] = head.indexOf('บริษัท[EN]');
            column[3] = head.indexOf('ที่อยู่');
            column[4] = head.indexOf('โทรศัพท์');
            column[5] = head.indexOf('อีเมล');
            column[6] = head.indexOf('เว็บไซต์');
            column[7] = head.indexOf('ข้อมูลธุรกิจ');
            column[8] = head.indexOf('สินค้าและบริการ');
            
            console.log(column)
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
                        row[column[2]],
                        row[column[3]].replaceAll("'",', '),
                        row[column[4]].replaceAll("'",', '),
                        row[column[5]].replaceAll('"',''),
                        row[column[6]],
                        row[column[7]],
                        row[column[8]],
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
                    <td>${v[4]}</td>
                    <td>${v[5] !='' && v[5] != 'NULL'?`${v[5]}`:``}</td>
                    <td>
                        ${v[6] !='' && v[6] != 'NULL'
                            ? `<a href="${v[6]}" target="_blank" class="btn btn-link">Click</a>`
                            : ''
                        }
                    </td>
                `;
                table.querySelector('tbody').append(tr);
            })
            rows.map(function(v,k){
                v[1].replaceAll('"','').replaceAll('CO.','CO.,');
                v[2];
                v[3].replaceAll("'",', ');
                v[4].replaceAll("'",', ');
                v[5].replaceAll("'",', ');
            });
            ImportContent.querySelector('.preview').setAttribute('data-import',JSON.stringify(rows))
            ImportContent.querySelector('.preview').append(table)
        }
        reader.readAsText(InputImportFile.files[0],'UTF-8')
    }
    document.querySelector('.import_file').addEventListener('change',readFileImport);
    
</script>