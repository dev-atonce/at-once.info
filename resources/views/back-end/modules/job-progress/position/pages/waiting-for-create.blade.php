<div class="col-lg-12">
    <div class="card waiting-for-create">
        <div class="card-header card-header d-flex flex-between-center">
            <h5 class="mb-0">
                <a class="badge badge-info refresh-for-create" href="javascript:"><i class="fas fa-sync-alt"></i></a> 
                Waiting for create <strong class="text-info count-on-create">0</strong>
            </h5>
            <div class="ms-auto col-auto form-inline">
                <input type="hidden" name="type" value="waiting-for-create" default="true">
                <select name="user" class="form-control form-control-sm cs-droplist ml-3">
                    <option value="">All Users</option>
                    @foreach(\App\Models\UsersMd::whereIn('name',['NAMFON','JASMINE','FERN'])->get() as $k => $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
                <div class="ms-auto text-end col-auto">
                    {{-- <button class="btn btn-falcon-default" id="job_progress_date"><i class="far fa-calendar-alt"></i>&nbsp;  Date</button> --}}
                    <input type="text" id="daterange" class="form-control form-control-sm" name="daterange" style="background-color:whitesmoke;"
                        placeholder="DD/MM/YYYY - DD/MM/YYYY">  
                </div>
                <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Search Company Name...">
                <button class="btn btn-outline-primary ml-2" type="submit"><i class="fas fa-search-plus"></i></button>
                <button class="btn btn-outline-danger ml-2 reset" type="reset"><i class="fas fa-history"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-borderless table-hover">
                <table class="table mb-0" id="CsStock">
                    <thead class="table-light fw-semibold">
                        <tr>
                            <th width="5%" class="text-center">NO.</th>
                            <th width="25%">Company Name</th>
                            <th width="15%">Category</th>
                            <th width="8%" class="text-center">Tel</th>
                            <th class="text-center">Email</th>               
                            <th class="text-center"></th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Created</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>  
                </table>   
            </div>  
        </div> 
    
        <div class="card-footer py-2">
            <div class="row flex-between-center">
                <div class="col-auto">
                    @if(Auth::user()->name == 'HOCKY'  || Auth::user()->name == 'TUM')
                    <button class="btn btn-secondary btn-import"><i class="fas fa-file-import pr-2"></i> Import</button>
                    @endif
                </div>
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-dark btn-sm prev-page" disabled="">< Prev</button>
                        </div>
                        <select class="form-control form-control-sm page" name="page"></select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark btn-sm next-page" disabled="">Next ></button>
                        </div>
                      </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary btn-add-row"><i class="fas fa-plus fa-fw"></i> Add Row</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Row Form</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
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
                    <div class="col-lg-5 col-xs-12">
                        <div class="form-group">
                            <label for="">Company Name (TH)</label>
                            <input type="text" name="name_th" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-5 col-xs-12">
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
            </div>
            <div class="modal-footer">
                <div class="action-add d-none">
                    <button type="button" class="btn btn-primary add-row"><i class="fas fa-save pr-2"></i> Confirm</button>
                </div>
                <div class="action-edit d-none">
                    <button type="button" class="btn btn-warning update-row"><i class="fas fa-save pr-2"></i> Update</button>
                    <button type="button" class="btn btn-warning update-cid d-none"><i class="fas fa-save pr-2"></i> Update ID</button>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ClearModal()">Close</button>
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
                                    class="custom-file-input import_file" 
                                    aria-describedby="inputGroupFileAddon01"
                                    accept=".csv"
                                >
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="preview" style="max-height: 65vh; overflow-y:auto;" data-import=""></div>
                <label><input type="checkbox" name="to_company" value="yes" class="mr-2">And insert into company</label>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="button" class="btn btn-warning btn-sm import-reset"><i class="fas fa-sync-alt pr-2"></i>Reset</button>
                <button type="button" class="btn btn-primary btn-sm import-to-table"><i class="fas fa-file-import pr-2"></i> Import</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[name="daterange"]').daterangepicker({ autoUpdateInput: false, locale: {format: 'DD/MM/YYYY'}});

    var userName = document.querySelector('input[name="user_name"]').value;
    var RowContent = document.querySelector('#RowModal');
    var RowModal = new bootstrap.Modal(RowContent,{ backdrop: false, keyboard: true});
    var userId = parseInt(`{{Auth::user()->id}}`);
    var RowCategorySelect = new SlimSelect({select:'#row_category',placeholder:'Please Select'});
    var ImportCategorySelect = new SlimSelect({select:'#import_category',placeholder:'Please Select'});
    var ImportContent = document.querySelector('#ModalImport');
    var ImportModal = new bootstrap.Modal(ImportContent,{backdrop: false,keyboard: true});
    var required = document.createElement('i'); 
        required.setAttribute('class','text-danger ml-2'); 
        required.innerHTML = `* กรุณาเลือก`;
    var Categories;
    // All categories main => sub => category
    async function RequestCategory()
    {
        const request = await fetch('api/get/category/all?lang=all');
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
    
    RowContent.addEventListener("hide.bs.modal", function(e){
        ClearModal();
    });
    

    document.addEventListener('click',function(e){
        const addRow = e.target.closest('.btn-add-row');
        if(addRow){
            fetchUsers();
            RowContent.querySelector('.action-edit').classList.add('d-none');
            RowContent.querySelector('.action-add').classList.remove('d-none');
            RowModal.show();
        }
        const editRow = e.target.closest('.edit-row');
        if (editRow) 
        {
            RowContent.querySelector('.action-edit').classList.remove('d-none');
            RowContent.querySelector('.action-add').classList.add('d-none');
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
            if (confirm('Confirm to delete?') === true) {
                DeleteRow({
                    id: deleteRow.getAttribute('data-id'),
                }).then(res => {
                    Alert(res);
                    fetchStock();
                });
            }
        }
        ImportBtn = e.target.closest('.btn-import');
        if(ImportBtn) {
            ImportModal.show();
        }

        const resetFileBtn = e.target.closest('.import-reset');
        if(resetFileBtn)
        {
            let modal = resetFileBtn.closest('.modal-content');
            modal.querySelector('.table').remove();
            modal.querySelector('input[type="file"]').value = '';
        }

        const importToTableBtn = e.target.closest('.import-to-table');
        if(importToTableBtn) {
            importToTableBtn.setAttribute('disabled',true);
            // console.log(ImportContent.querySelector('[name="category"]').value)
            if(ImportContent.querySelector('[name="category"]').value != '') {
                ImportContent.querySelector('[name="category"]').classList.remove('error');
                let ImportData = JSON.parse(ImportContent.querySelector('.preview').getAttribute('data-import'));
                let data = {
                    rows: ImportData,
                    category: ImportContent.querySelector('[name="category"]').value,
                }
                if(ImportContent.querySelector('[name="to_company"]:checked')){
                    data.to_company = ImportContent.querySelector('[name="to_company"]').value
                }
                async function Request(){
                    const request = await fetch(`webpanel/my-job/cs/rows/import`,{
                        method:'post',
                        headers:{
                            "Content-type":'application/json; charset:utf-8;',
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body:JSON.stringify(data)
                    });
                    if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
                    const rs = request.json();
                    return rs;
                };
                Request().then(res => {
                    Alert(res);
                    if (res.status === true) {
                        setTimeout(() => {
                            ImportContent.querySelector('.preview').removeAttribute('data-import');
                            ImportContent.querySelector('.preview').innerHTML = '';
                            ImportContent.querySelector('[type="file"]').value = '';
                        }, 1000);
                    }
                    importToTableBtn.removeAttribute('disabled');
                })
            }
        }else{
            ImportContent.querySelector('[name="category"]').classList.add('error');
        }



        const waitingCreated = e.target.closest('.waiting-created');
        if(waitingCreated){
            createdFor(waitingCreated.getAttribute('data-id')).then(r => { Alert(r);fetchStock();});
        }
        const bookingWaitingForCreate = e.target.closest('.booking-waiting-for-create');
        if (bookingWaitingForCreate) {
            BookingCreate(bookingWaitingForCreate.getAttribute('data-id')).then(res => {fetchStock()})
        }
        const refreshForCreate = e.target.closest('.refresh-for-create');
        if(refreshForCreate){ fetchStock(); }
        const cancelForBooking = e.target.closest('.cancel-for-booking');
        if (cancelForBooking) {

            if (confirm('Confirm to cancel?') === true) {
                BookingCreate(cancelForBooking.getAttribute('data-id')).then(r => {
                    Alert(r);
                    fetchStock();
                })
            }
        }
        const cancelFOrCreate = e.target.closest('.cancel-for-create');
        if (cancelFOrCreate)
        {
            if (confirm('Confirm to cancel?') === true) {
                createdFor(cancelFOrCreate.getAttribute('data-id')).then(r => {
                    Alert(r);
                    fetchStock();
                })
            }
        }
        const companyId = e.target.closest('.company-indentity');
        if(companyId){
            getRow(companyId.getAttribute('data-id')).then(res=>{

                RowCategorySelect.config.isEnabled = false;
                const name_th = RowContent.querySelector('[name="name_th"]');
                const name_en = RowContent.querySelector('[name="name_en"]');
                const category = RowContent.querySelector('[name="category"]');

                const telephone = RowContent.querySelector('[name="telephone"]');
                const email = RowContent.querySelector('[name="email"]');
                const website = RowContent.querySelector('[name="website"]');
                RowContent.querySelector(`button.update-row`).classList.add('d-none');
                RowContent.querySelector('.action-edit').classList.remove('d-none');
                RowContent.querySelector('button.update-cid').classList.remove('d-none');
                RowContent.querySelector('button.update-cid').setAttribute('data-id',res.id);
                name_th.value = res.name_th;
                name_en.value = res.name_en;
                name_th.setAttribute('readonly',true);
                name_en.setAttribute('readonly',true);
                category.value = res.category;
                category.setAttribute('readonly',true);
                RowCategorySelect.setSelected(res.category);        
                telephone.value = res.telephone;
                telephone.setAttribute('readonly',true);
                email.value = res.email;
                email.setAttribute('readonly',true);
                website.value = res.website;
                website.setAttribute('readonly',true);
                RowModal.show();
            })

        }
        const updateID = e.target.closest('.update-cid');
    });
    RowContent.addEventListener('click',function(e){
        const addRowBtn = e.target.closest('.add-row');
        if(addRowBtn)
        {
            const validate = Validate({
                required: {
                    name_th:true,
                    name_en:true,
                    category:true,
                    telephone:true,
                    email:true,
                    website:true,
                }
            });


            if( validate === true ) addRow({
                company: RowContent.querySelector('input[name="company"]').value,
                name_th: RowContent.querySelector('input[name="name_th"]').value,
                name_en: RowContent.querySelector('input[name="name_en"]').value,
                category: RowContent.querySelector('select[name="category"]').value,
                telephone: RowContent.querySelector('input[name="telephone"]').value,
                email: RowContent.querySelector('input[name="email"]').value,
                website: RowContent.querySelector('input[name="website"]').value
            }).then(r => {
                RowModal.hide();
                Alert(r);
                if (r.status == true) {
                    ClearModal();
                    fetchStock();
                }
            });
        }
        const updateID = e.target.closest('.update-cid');
        if(updateID){
            const validate = Validate({
                required: {
                    company:true, name_th:true, name_en:true, category:true, telephone:true, email:true, website:true,
                }
            });
            if( validate === true ) updateRow({
                id: updateID.getAttribute('data-id'),
                company: RowContent.querySelector('[name="company"]').value,
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
                    ClearModal();
                    fetchStock();
                }
            });
        }
        const updateRowBtn = e.target.closest('.update-row');
        if(updateRowBtn){
            const validate = Validate({
                required: {
                    name:true, company:true, category:true, telephone:true, email:true, website:true,
                }
            });
            if( validate === true ) updateRow({
                id: updateRowBtn.getAttribute('data-id'),
                name_th: RowContent.querySelector('input[name="name_th"]').value,
                name_en: RowContent.querySelector('input[name="name_en"]').value,
                company: RowContent.querySelector('[name="company"]').value,
                category: RowContent.querySelector('select[name="category"]').value,
                telephone: RowContent.querySelector('input[name="telephone"]').value,
                email: RowContent.querySelector('input[name="email"]').value,
                website: RowContent.querySelector('input[name="website"]').value
            }).then(r => {
                RowModal.hide();
                Alert(r);
                if (r.status == true) {
                    ClearModal();
                    fetchStock();
                }
            });
        }
        
    });
    async function getRow(id)
    {
        const request = await fetch(`api/my-job/cs/${id}`);
        const response = await request.json();
        return response;
    }
    async function getAllRow(params)
    {
        let queryString = Object.keys(params)
             .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
             .join('&');
        const request = await fetch(`api/my-job/cs/all?${queryString}`);
        const response = await request.json();
        return response;
    }
    
    async function getOnProgress()
    {
        const request = await fetch('api/my-job/cs/on-process');
        const rresponse = await request.json();
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

    function fetchStock(meta)
    {
        const appendTo = document.getElementById('CsStock');
        const params = meta ? meta : [];
        let metaData = {};
        function Items(res)
        {
            if (res?.meta) {
                appendTo.closest('.waiting-for-create').querySelector('.count-on-create').innerHTML = res.meta.allRows;
            }
            let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
            appendTo.querySelector('tbody').innerHTML = '';
            if( res.data.length > 0 ){
                res?.data.map(function(v,k){
                    let tr = document.createElement('tr');
                    tr.innerHTML = `<tr>
                        <td class="text-center align-top">${start++}</td>
                        <td class="text-left align-top">
                            <div class="mb-0 design-stock-list">
                                <p class="m-0"><span class="badge badge-primary-light">TH</span> ${v.name_th}</p>
                                <p class="m-0"><span class="badge badge-primary-light">EN</span> ${v.name_en}</p>
                            </div>
                        </td>
                        <td class="align-top"><small class="font-weight-bold">${v.categoryName}</small></td>
                        <td class="text-center align-top">${v.telephone}</td>
                        <td class="text-center align-top">${v.email}</td>
                        <td class="text-center align-top">
                            ${v.website != null
                                ? `<a href="${v.website}" title="${v.website}" target="_blank">Website<i class="fas fa-link"></i></a>`
                                : ``
                            }
                            <div style="display:grid; justify-content:center; justify-items:center;">
                                <small>Ranking</small>
                                <a class="rank default dropdown add-rank" href="javascript:"></a>
                            </div>
                        </td>
                        <td class="text-center align-top"><small>${moment(v.created_at).format('lll')}</small></td>  
                        <td class="text-center align-top">
                            ${ v.booking != null 
                                ? `<div class="badge badge-info cursor position-relative">
                                    <a href="javascript:" class="cancel-for-booking badge-close" data-id="${v.id}"><i class="fas fa-times"></i></a>
                                    Booked By
                                    <span class="border-top border-top-info mt-1 pt-1 d-block">${v.booking_by}</span>
                                </div>`
                                : `<div class="form-group form-check"><input type="checkbox" class="form-check-input booking-waiting-for-create" id="created-${v.id}" data-id="${v.id}"><label class="form-check-label pl-1" for="created-${v.id}"> Booking</label></div>`
                            }
                            ${v.created != null 
                                ? `<div class="badge badge-success cursor position-relative">
                                        <a href="javascript:" class="cancel-for-create badge-close" data-id="${v.id}"><i class="fas fa-times"></i></a>
                                        Created By 
                                        <span class="border-top border-top-success d-block mt-1 pt-1">${v.created_with}</span>
                                    </div>`
                                : `<div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input waiting-created" id="created-${v.id}" data-id="${v.id}">
                                        <label class="form-check-label pl-1" for="created-${v.id}"> Created</label>
                                    </div>`
                            }
                        </td>
                        <td class="text-center align-top">
                            <a href="javascript:" class="badge badge-light edit-row" data-id="${v.id}">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <a href="javascript:" class="badge badge-danger delete-row" data-id="${v.id}">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>`;
                    appendTo.querySelector('tbody').append(tr);
                });
            }else{
                let tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
                appendTo.querySelector('tbody').append(tr);
            }
        }
        const paginate = new Pagination({
            content: appendTo.closest('.waiting-for-create'),
            rows: getAllRow,
            items: Items,
            search: {
                type:  appendTo.closest('.waiting-for-create').querySelector('[name="type"]'),
                date:  appendTo.closest('.waiting-for-create').querySelector('input[name="daterange"]'),
                keyword: appendTo.closest('.waiting-for-create').querySelector('input[name="keyword"]'),
                user: appendTo.closest('.waiting-for-create').querySelector('select[name="user"]'),
                submit: appendTo.closest('.waiting-for-create').querySelector('[type="submit"]'),
                reset: appendTo.closest('.waiting-for-create').querySelector('[type="reset"]')
            },
            refresh: appendTo.closest('.waiting-for-create').querySelector('.refresh-for-create')
        });
    }
    
   

    fetchStock();
    
    async function BookingCreate(id)
    {
        const request = await fetch(`webpanel/my-job/di/waiting-for-create/booking?id=${id}`);
        const response = await request.json();
        return response;
    }
    async function createdFor(id)
    {
        const request = await fetch(`webpanel/my-job/di/waiting-for-create/created?id=${id}`);
        const response = await request.json();
        return response;
    }

    async function addRow(data)
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
        const reponse = await request.json();
        return reponse;
    }
    async function updateRow(data)
    {
        const request = await fetch(`webpanel/my-job/cs/${data.id}`,{
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content,
            },
            body:JSON.stringify(data)
        });
        const reponse = await request.json();
        return reponse;
    }
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
    function Validate(e){
        let required = [];
        if(e.required){
            Object.entries(e.required).map(function(v,k){
                if(v[1] === true){
                    const input = document.querySelector(`[name="${v[0]}"]`);
                    if(input){
                        let label = document.createElement('i');
                        label.setAttribute('class','text-danger font-weight-bold ml-1');
                        label.innerHTML = `required *`;
                        if (input?.value=='') {
                            if (input.closest('.form-group')?.querySelector('i') == null) input.closest('.form-group').querySelector('label').append(label);
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
               4 
            })
        }
        return required.length == 0 ? true : false ;
    }
    // $('.modal-dialog').draggable({handle:".modal-content"});
    function ClearModal()
    {
        RowContent.querySelector('.action-add').classList.add('d-none');
        RowContent.querySelector('.action-edit').classList.add('d-none');
        RowContent.querySelector('[name="name_th"]').value= '';
        RowContent.querySelector('[name="name_en"]').value= '';
        RowContent.querySelector('[name="company"]').value= '';
        RowContent.querySelector('[name="category"]').value= '';
        RowContent.querySelector('[name="telephone"]').value= '';
        RowContent.querySelector('[name="email"]').value= '';
        RowContent.querySelector('[name="website"]').value= '';
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

    document.querySelector('.import_file').addEventListener('change',readFileImport)

</script>