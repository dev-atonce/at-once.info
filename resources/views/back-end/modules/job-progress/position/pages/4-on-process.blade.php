<div class="row">
    <div class="col-lg-12">
        <!-- On Process ของ cs -->
        <div class="card on-process">
            <div class="card-header card-header d-flex">
                <div class="mb-0 fs-18 d-flex align-items-center">
                    <span>4. On Process </span>
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
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary br-15 ml-2 btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" default="Remark">
                            <div class="text-dark d-flex mr-1">
                                <span class="badge-color remark default mr-2" style="width:18px !important; height:18px !important;"></span>
                                <span>All</span>
                            </div>
                        </button>
                        <div class="dropdown-menu remark-filter">
                            <a class="dropdown-item default" href="javascript:" data-color="">
                                <span class="badge-color sunday default mr-2"></span>
                                <span>Sunday</span>
                            </a>
                            <a class="dropdown-item monday border-top" href="javascript:" data-color="monday">
                                <span class="badge-color monday mr-2"></span>
                                <span>Monday</span>
                            </a>
                            <a class="dropdown-item tuesday" href="javascript:" data-color="tuesday">
                                <span class="badge-color tuesday mr-2"></span>
                                <span>Tuesday</span>
                            </a>
                            <a class="dropdown-item wednesday" href="javascript:" data-color="wednesday">
                                <span class="badge-color wednesday mr-2"></span>
                                <span>Wednesday</span>
                            </a>
                            <a class="dropdown-item thursday" href="javascript:" data-color="thursday">
                                <span class="badge-color thursday mr-2"></span>
                                <span>Thursday</span>
                            </a>
                            <a class="dropdown-item friday border-bottom" href="javascript:" data-color="friday">
                                <span class="badge-color friday mr-2"></span>
                                <span>Friday</span>
                            </a>
                            <a class="dropdown-item saturday" href="javascript:" data-color="saturday">
                                <span class="badge-color saturday mr-2"></span>
                                <span>Saturday</span>
                            </a>
                        </div>
                        <input type="hidden" name="remark_color" value="">
                    </div>
                    <input type="text" name="keyword" class="form-control form-control-sm br-15 ml-2" placeholder="Search Company Name...">
                    <button class="btn btn-primary btn-sm br-15 ml-2" type="submit"><i class="fas fa-search-plus pr-1"></i>Search</button>
                    <button class="btn btn-outline-danger btn-sm br-15 ml-2 reset" type="reset"><i class="fas fa-history pr-1"></i>Reset</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="CsOnProcess">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th rowspan="2" class="text-center" width="5%">NO.</th>
                                <th rowspan="2" width="28%">Company</th>
                                <th rowspan="2" width="2%" class="text-center p-1"><div class="rotate-45">Assign</div></th>
                                <th rowspan="2"width="2%" class="text-center p-0">
                                    <a class="badge badge-secondary reset-remark" href="javascript:"><i class="fas fa-history"></i></a>
                                </th>
                                <th rowspan="2" width="5%" class="text-center p-0">Revise</th>
                                <th rowspan="2" width="2%" class="text-center p-1"><div class="rotate-45">Ranking</div></th>
                                <th colspan="3" class="text-center border-left border-right p-1" width="20%">Avg. Statistics Per Month</th>
                                <th rowspan="2" class="text-center th-cannot-contact" width="35%">Process</th>
                            </tr>
                            <tr class="last-child">
                                <th class="text-center border-left p-1">Page view</th>
                                <th class="text-center border-left p-1">User</th>
                                <th class="text-center border-left border-right p-1">Country</th>
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
                            <button class="btn btn-outline-dark btn-sm br-l-15 prev-page" type="button">< Prev</button>
                            </div>
                            <select type="text" class="form-control form-control-sm border-dark page" name="page">
                            </select>
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
<div class="modal fade" id="ModalComment">
    <div class="modal-dialog br-2x modal-lg ">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                <a href="javascript:" onclick="ClearComment()" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body" >
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <input type="hidden" name="row-id">
                <div class="comments-content">
                    <div class="pin-comment"></div>
                    <div class="row-comment">
                        <div class="w-100 d-flex justify-content-center align-items-center" style="min-height:250px;"><span class="loader"></span></div>
                    </div>
                    <div class="add-comment">
                        <div class="d-flex align-items-end">
                            <div class="newComment">
                                <div class="new-comment-body" contenteditable="true"></div>
                            </div>
                            <div class="comment-action">
                                <a href="javascript:" class="fas fa-paper-plane fs-22px btn-new-comment p-2"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalAttach">
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
                <div class="form-inline">
                    <label class="d-flex align-items-center badge badge-success" for="status">
                        <input type="checkbox" id="status" value="done" name="status" checked="">
                        <span class="ml-1">Done</span>
                    </label>
                </div>
                <div class="pdf-row mb-3"></div>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input pdf-file" accept=".pdf" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmRefuse">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalContact">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Contact data</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row-id">
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Last name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Telephone</label>
                            <input type="text" name="telephone" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning confirmRevise">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ReviseModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 align-items-center draggable-handle">
                <h5 class="modal-title">Revise Status</h5>
                <a href="javascript:" onclick="ClearReviseModal()" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
                    <span class="fas fa-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="row-id">
                <input type="hidden" name="job-id">
                <input type="hidden" name="company-id">
                <input type="hidden" name="revise">
                <input type="hidden" name="receiver">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="mr-1">Revise: </label><span class="revise-badge"></span>
                    </div>
                    <div class="col-lg-6">
                        <label >Receiver: </label>
                        @foreach(\App\Models\UsersMd::whereIn('name',['NOT','NATTAWAT','WIN','TANGMO'])->get() as $k => $v)
                        <a class="badge badge-pill badge-light mb-1 receiver" href="javascript:" data-id="{{$v->id}}">{{$v->name}}</a>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Remark: </label>
                            <textarea class="form-control" name="remark" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="rejectAttach" name="rejectAttach[]" multiple="">
                            <label class="custom-file-label" for="rejectAttach">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning confirmRevise mr-2"><i class="fas fa-save"></i><span class="ml-1">Confirm to revise</span></button>
                    <button type="submit" class="btn btn-secondary" onclick="ClearReviseModal()" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var OnProcessElement = document.querySelector('.on-process');
    var CommentModalElement = document.getElementById('ModalComment');
    var CommentModal = new bootstrap.Modal(CommentModalElement,{ backdrop: false, keyboard: true});
    var ReviseContent = document.querySelector('#ReviseModal');
    var ReviseModal = new bootstrap.Modal(ReviseContent,{ backdrop: false, keyboard: true});
    Draggable(ReviseContent);
    const getDataOnProgress = async(params) =>
    {
        let queryString = Object.keys(params)
             .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
             .join('&');
        queryString = (queryString) ? `?${queryString}` : ``;
        const request = await fetch(`api/my-job/on-process${queryString}`);
        if (request.status != 200) {
            let res = {status:false,message:`${request.status} ${request.statusText}`}
            Alert(res);
            return res;
        }
        const response = await request.json();
        return response;
    }
    function Items(res)
    {
        if (res?.meta) {
            OnProcessElement.querySelector('.count').innerHTML = res.meta.allRows;
        }
        let start = (res.meta?.skip) ? parseInt(res.meta.skip) + 1 : 1;
        OnProcessElement.querySelector('tbody').innerHTML = '';
        if( res.data.length > 0 ){
            res.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id',v.rowId);
                tr.setAttribute('job-id',v.jobId);
                tr.setAttribute('company-id',v.cid);
                tr.innerHTML = `
                    <td class="text-center align-middle">${start++}</td>
                    <td class="align-middle">
                        <p class="m-0">
                            <span class="badge badge-primary-light">TH</span> 
                            <a class="text-dark" href="th/preview/${v.cid}" target="_blank" title="Preview">
                                ${v.name_th}
                            </a>
                        </p>
                        <p class="m-0">
                            <span class="badge badge-primary-light">EN</span> 
                            <a class="text-dark" href="th/preview/${v.cid}" target="_blank" title="Preview">${v.name_en}</a>
                        </p>
                        <span class="badge badge-primary-light">${v.categoryNo}. ${v.categoryNameEN}</span>
                    </td>
                    <td class="px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            ${v.assignment 
                                ? `<a class="user bg-primary assignment" user-id="${v.assignment}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.display_name}">${v.display}</a>`
                                : `<a class="user bg-dark assignment add-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            <a class="remark ${v.remark_color?`${v.remark_color}`:`default`} dropdown add-remark" href="javascript:"></a>
                        </div>
                    </td>
                    <td class="px-1">
                        <div style="display:grid;">
                            <div class="revise" data-default="Revise">
                                <span>Revise</span><i class="fas fa-caret-down ml-1"></i>
                                <div class="revise-dropdown">
                                    <a class="revise-item" href="javascript:" data-revise="di">DI</a>
                                    <a class="revise-item" href="javascript:" data-revise="de">Design</a>
                                    <a class="revise-item" href="javascript:" data-revise="di+de">DI+Design</a>
                                </div>
                            </div>
                        </div
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
                    <td class="text-center align-middle">
                        <span><strong class="mr-1">Email:</strong>${v.email?`${v.email}`:`-`}</span> <span><strong class="mr-1">Tel.</strong>${v.telephone?`${v.telephone}`:`-`}</span>
                        <div class="on-process-action position-relative">
                            <a href="javascript:" class="position-absolute badge badge-dark edit-process">
                                <i class="fas fa-pen"></i>
                            </a>
                            <div class="mt-1 edit-button">
                                <span class="badge badge-light ${v.send_email?`text-primary`:``} btn-badge badge-shadow send-email" action="send-email">
                                    <i class="${v.send_email?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Send Email
                                </span>
                                <span class="badge badge-light ${v.cannot_contact?`text-primary`:``} btn-badge badge-shadow cannot-contact" action="cannot-contact">
                                    <i class="${v.cannot_contact?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Cannot Contact
                                </span>
                                <span class="badge badge-light ${v.follow?`text-primary`:``} btn-badge badge-shadow follow" action="follow">
                                    <i class="${v.follow?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Follow
                                    </span>
                                <span class="badge badge-light ${v.no_response?`text-primary`:``} btn-badge badge-shadow no-reponse" action="no-response">
                                    <i class="${v.no_response?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>No Response
                                </span>
                                <span class="badge badge-light ${v.refuse?`text-primary`:``} btn-badge badge-shadow refuse" action="refuse">
                                    <i class="${v.refuse?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Refuse
                                </span>
                                <span class="badge badge-light ${v.call_again?`text-primary`:``} btn-badge badge-shadow call-again" action="call-again">
                                    <i class="${v.call_again?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Call Again
                                </span>
                            </div>
                        </div>
                        <hr class="my-1 hr-light">
                        <a href="/th/preview/company-profile/${v.cid}" target="_blank" class="badge bg-info text-light"><i class="fas fa-eye"></i> Preview</a>
                        <a href="javascript:" class="badge ${v.send_email!=''?`badge-info`:`badge-danger`} send-email"
                            to="${v.email}"
                            data-href="/api/my/services/company/profile/${v.profile_url}"
                        ><i class="far fa-paper-plane fa-lg"></i> Send</a>
                        ${v.public == 1 
                            ? (`<a href="th/${v.categoryKey}/cp/${v.profile_url}" target="_blank" class="badge badge-success"><i class="fas fa-check"></i> Public</a>`)
                            : (`<a href="javascript:" class="badge ${v.publish==1?`badge-success`:`badge-secondary`}"><i class="fas fa-check"></i> Public</a>`)
                        }
                        <a href="javascript:" 
                            class="badge ${v.copyright!=null?`badge-primary-light`:`badge-secondary`} modal-attach" ${v.copyright!=null?`copyright="${v.copyright}"`:``}><i class="fas fa-paperclip"></i> Attach File</a>
                        <a href="javascript:" class="badge badge-primary text-light comment-modal">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                `;
                OnProcessElement.querySelector('tbody').append(tr);
            });
        }else{
            let tr = document.createElement('tr');
            tr.innerHTML = '<td colspan="9" class="text-center">No data record.</td>';
            OnProcessElement.querySelector('tbody').append(tr);
        }
    }
    const processPaginate = new Pagination({
        content: OnProcessElement,
        rows: getDataOnProgress,
        items: Items,
        search: {
            assignment: OnProcessElement.querySelector('input[name="assignment"]'),
            category: OnProcessElement.querySelector('select[name="category"]'),
            remark_color: OnProcessElement.querySelector('input[name="remark_color"]'),
            keyword: OnProcessElement.querySelector('input[name="keyword"]'),
            submit: OnProcessElement.querySelector('[type="submit"]'),
            reset: OnProcessElement.querySelector('[type="reset"]')
        },
        refresh: OnProcessElement.querySelector('.refresh')
    });
    // add event from click action
    document.addEventListener('click', function(e) {
        // Edit on process for checked or unchecked
        const editProcess = e.target.closest('.edit-process');
        if (editProcess) {
            const i = editProcess.children[0];
            if(i.classList?.contains('fa-pen')){
                toggleClass(i,'fa-pen fa-times');
            }else{
                toggleClass(i,'fa-times fa-pen');
            }
            const badge = editProcess.closest('.on-process').querySelectorAll('.btn-badge');
            badge.forEach(function(el){
                if (el.classList.contains('edit')) {
                    el.classList.remove('edit');
                }else{
                    el.classList.add('edit');
                }
                
            });
        }
        // checked or unchecked process
        const editProcessBtn = e.target.closest('.btn-badge');
        if (editProcessBtn?.classList.contains('edit'))
        {
            if(editProcessBtn.getAttribute('action') == 'refuse'){
                    RefuseAction(editProcessBtn);
            }else{
                toggleClass(editProcessBtn,'text-primary');
                toggleClass(editProcessBtn.querySelector('i'),'far fas');
                toggleClass(editProcessBtn.querySelector('i'),'fa-circle fa-check-circle');
                OnProcessAction(editProcessBtn).then(response => {
                    if(response.status == 500) Alert(response);
                    
                })
            }
        }
        const commentModalBtn = e.target.closest('.comment-modal');
        if (commentModalBtn) {
            let tr = commentModalBtn.closest('tr');
            CommentModal.querySelector('.row-comment').innerHTML = '';
            CommentModalElement.querySelector('input[name="company-id"]').value = tr.getAttribute('company-id');
            CommentModalElement.querySelector('input[name="job-id"]').value = tr.getAttribute('job-id');
            CommentModalElement.querySelector('input[name="row-id"]').value = tr.getAttribute('row-id');
            CommentModal.show();
            Comments(tr.getAttribute('job-id'));
        }
        //Option for comment
        const commentOption = e.target.closest('.comment')
        if(commentOption) { 
            let offset = {
                top : e.clientY + 15,
                left : e.clientX - 15,
            }
           
            if(!commentOption.classList.contains('pin-item'))
            {
                document.querySelector('.menu-comment')?.remove();
                CommentMenu(commentOption,offset)
            }
        }

        const menuItem = e.target.closest('.menu-item');
        if(menuItem) {

            const action = menuItem.getAttribute('action');
            const thisComment = menuItem;
            const commentId = menuItem?.getAttribute('comment-id');
            const jobId = menuItem?.closest('.modal-body')?.querySelector('[name="job-id"]').value;
            const userId = menuItem?.getAttribute('user-id');
            CloseMenuComment();
            switch (action) {
                case 'pin': PinAComment(thisComment); break;
                case 'copy': CopyTextToClipboard(thisComment); break;
                case 'reply': break;
                case 'to-do': break;
                case 'delete': DeleteComment(commentId); break;
            }
        }
        // New comment button 
        const newCommentBtn = e.target.closest('.btn-new-comment');
        if (newCommentBtn) {
            const html = newCommentBtn.closest('.add-comment').querySelector('[contenteditable]').innerText;
        }
        // Remove pin
        const removePin = e.target.closest('.pin-remove');
        if (removePin) {
            RemovePin(removePin.closest('.pin-item').getAttribute('comment-id'))
        }
        // Atttach file (copyright PDF file)
        const modalAttach = e.target.closest('.modal-attach');
        if (modalAttach) {
            tr = modalAttach.closest('tr');
            AttactContent = document.querySelector('#ModalAttach');
            AttactModal = new bootstrap.Modal(AttactContent,{backdrop:false, keyboard:true});
            Draggable(AttactContent);
            AttactContent.querySelector('input[name="row-id"]').value = tr.getAttribute('row-id');
            AttactContent.querySelector('input[name="job-id"]').value = tr.getAttribute('job-id');
            AttactContent.querySelector('input[name="company-id"]').value = tr.getAttribute('company-id');
            AttactContent.querySelector('.pdf-row').innerHTML = '';
            const copyright = modalAttach.getAttribute('copyright');
            if(copyright != null)
            {
                fileName = copyright.split('/')[2];
                item = document.createElement('div');
                item.setAttribute('class','pdf-item bg-light');
                item.setAttribute('company-id',tr.getAttribute('company-id'));
                item.setAttribute('job-id',tr.getAttribute('job-id'));
                item.innerHTML = `
                <div class="d-flex">
                    <div class="pdf-icon">
                        <i class="far fa-file-pdf text-danger fa-4x"></i>
                    </div>
                    <div class="pdf-detail">
                        <a href="javascript:" class="badge badge-light badge-close pdf-remove"><i class="fas fa-times"></i></a>
                        <p class="pdf-name">
                            <a href="javascript:" file="${copyright}" class="pdf-preview" target="_blank">${fileName}</a>
                        </p>
                    </div>
                </div>
                `;
                AttactContent.querySelector('.pdf-row').append(item);
            }
            AttactModal.show();
        }
        // PDF preview
        const pdfPreviewBtn = e.target.closest('.pdf-preview'); 
        if (pdfPreviewBtn) {
            e.preventDefault();
            const baseHref = window.location.origin;
            window.open(`${baseHref}/read/pdf?path=${pdfPreviewBtn.getAttribute('file')}`,'_blank',"width=1300,height=800");
        }
        // Remove PDF file
        const removeFileBtn = e.target.closest('.pdf-remove');
        if (removeFileBtn) { 
            RemoveFile(removeFileBtn.closest('.pdf-item'))
        }
        // update full name only
        const editContactName = e.target.closest('.edit-contact-name');
        if(editContactName)
        {
            let tr = editContactName.closest('tr');
            toggleClass(editContactName.querySelector('i'),'fa-pen fa-save');
            setTimeout(()=>{
                let firstName = tr.querySelector('input[name="first_name"]').removeAttribute('readonly');
                let lastName = tr.querySelector('input[name="last_name"]').removeAttribute('readonly');
                toggleClass(editContactName,'edit-contact-name update-contact-name');
            },200);
        }
        // update contact data first name, last name, telephone and email
        const updateContactBtn = e.target.closest('.update-contact-name');
        if(updateContactBtn)
        {
            let tr = updateContactBtn.closest('tr');
            let id = parseInt(tr.getAttribute('row-id'));
            let firstName = tr.querySelector('input[name="first_name"]');
            let lastName = tr.querySelector('input[name="last_name"]');
            if(firstName.value == ''){
                firstName.classList.add('error');
                lastName.classList.add('error');
            }else{
                firstName.classList.remove('error');
                lastName.classList.remove('error');
                updateContact({id:id, first_name:firstName.value, last_name:lastName.value});
            }
        }
        // send email button
        const sendEmailBtn = e.target.closest('.send-email');
        if(sendEmailBtn){
            let tr = sendEmailBtn.closest('tr');
            let cp = tr.getAttribute('company-id');
            let to = sendEmailBtn.getAttribute('to');
            let url = sendEmailBtn.getAttribute('data-href');
            url = window.location.origin+`${url}`;
            console.log(url);

            navigator.clipboard.writeText(`"${url}"`).then(() => {
                const Request = async () => {
                    const request = await fetch(`webpanel/company/copyUrlAndStorageData?company=${cp}&to=${to}`);
                    const response = await request.json();
                    return response; 
                }
                Request().then(res=>{
                    Alert({status:true, message:`Copy to clipboard.`});
                })
            });
        }

        const contactDataBtn = e.target.closest('.contact-data');
        if(contactDataBtn) {
            let tr = contactDataBtn.closest('tr');
            ContactContent = document.querySelector('#ModalContact');
            ContactModal = new bootstrap.Modal(ContactContent,{backdrop:false, keyboard:true});
            Draggable(ContactContent);
            ContactContent.querySelector('[name="row-id"]').value = tr.getAttribute('row-id');
            ContactContent.querySelector('[name="job-id"]').value = tr.getAttribute('job-id');
            ContactContent.querySelector('[name="company-id"]').value = tr.getAttribute('company-id');
            ContactContent.querySelector('[name="first_name"]').value = tr.querySelector('input[name="first_name"]').value;
            ContactContent.querySelector('[name="last_name"]').value =  tr.querySelector('input[name="last_name"]').value;
            ContactContent.querySelector('[name="telephone"]').value = tr.querySelector('.telephone')?.getAttribute('data');
            ContactContent.querySelector('[name="email"]').value = tr.querySelector('.email')?.getAttribute('data');
            ContactModal.show();
        }
        
        // remove asssignment
        const removeUserAssign = e.target.closest('.assignment');
        if (removeUserAssign) {
            let tr = removeUserAssign.closest('tr');
            if(removeUserAssign.getAttribute('user-id') == userId){
                const Request = async () => {
                    const request = await fetch(`webpanel/my-job/cs/on-process/assignment/remove?id=${tr.getAttribute('row-id')}`);
                    const response = await request.json();
                    return response;
                }
                Request().then(res=>{
                    if(res.status === true){
                        document.querySelector('.tooltip').remove();
                        let assignDefault = document.createElement('a');
                        assignDefault.href = "javascript:";
                        assignDefault.setAttribute('class','user bg-dark assignment add-assignment');
                        assignDefault.innerHTML = '<i class="fas fa-plus"></i>';
                        removeUserAssign.replaceWith(assignDefault);
                    }
                });
            }
        }
        // add color remark
        const addRemark = e.target.closest('.add-remark');
        if(addRemark && addRemark.innerHTML == '')
        {
            addRemark.closest('tbody').querySelectorAll('.dropdown-menu').forEach((el) => el.remove());
            dropdownElement(addRemark);
            
            addRemark.addEventListener('click',function(e){
                let tr = addRemark.closest('tr');
                item = e.target.closest('.dropdown-item');
                if (item)
                {
                    tr.querySelector('.assignment')?.getAttribute('user-id')
                    let color = item.getAttribute('data-color');
                    addRemark.setAttribute('class',`remark ${color} dropdown add-remark`);
                    const clearRemark = () => addRemark.setAttribute('class','remark default dropdown add-remark');
                    CloseMenuRemark();
                    async function Request() {

                        const request = await fetch(`webpanel/my-job/cs/remark-color/add?id=${tr.getAttribute('row-id')}&color=${color}`);
                        if (request.status === 500) {
                            Alert({status:false,message:'500 Internal server error'});
                            clearRemark()
                        } 
                        if (request.status === 404) {
                            Alert({status:false,message:'404 Page not found'});
                            clearRemark()
                        }
                        const response = await request.json();
                        return response;
                    }
                    Request().then(res => {
                        if (res.status == false) clearRemark();
                        Alert(res);
                    })
                }
            })
        }

        // ======= Revise Content ======= //
        const reviseAction = e.target.closest('.revise');
        if(reviseAction){
            // let dropdown = reviseAction.querySelector('.revise-dropdown');
            if(!reviseAction.classList.contains('show')) reviseAction.classList.add('show');
            else reviseAction.classList.remove('show');
        }
        const reviseItem = e.target.closest('.revise-item');
        if (reviseItem) {
            let tr = reviseItem.closest('tr');
            const parent = reviseItem.closest('.revise');
            const currentText = parent.innerText;
            text = reviseItem.innerText;
            ReviseContent.querySelector('[name="row-id"]').value = tr.getAttribute('row-id');
            ReviseContent.querySelector('[name="job-id"]').value = tr.getAttribute('job-id');
            ReviseContent.querySelector('[name="company-id"]').value = tr.getAttribute('company-id');
            ReviseContent.querySelector('.revise-badge').innerHTML = `<a class="badge badge-pill badge-info" href="javascript:">${text}</a>`;
            ReviseContent.querySelector('input[name="revise"]').value = reviseItem.getAttribute('data-revise');
            ReviseModal.show();
        }
        const receiverRevise = e.target.closest('.receiver');
        if (receiverRevise) 
        {
            if(receiverRevise.classList.contains('badge-light')) toggleClass(receiverRevise,'badge-light badge-info');
            allReceiver = document.querySelector('#ReviseModal').querySelectorAll('.receiver');
            allReceiver.forEach(function(v,k){
                if(v.getAttribute('data-id') != receiverRevise.getAttribute('data-id')) {
                    if(v.classList.contains('badge-info')) toggleClass(v,'badge-info badge-light');
                }
                else{ 
                    ReviseContent.querySelector('input[name="receiver"]').value = v.getAttribute('data-id');
                }
            });
        }
        const confirmToRevise = e.target.closest('.confirmRevise');
        if (confirmToRevise) {
            let ReviseC = document.querySelector('#ReviseModal');
            confirmToRevise.setAttribute('disabled',true);
            currentIcon = confirmToRevise.querySelector('i');
            currentClass = currentIcon.className;
            currentIcon.setAttribute('class','icon-loader');
            let data = new FormData();
            data.append('job', ReviseC.querySelector('[name="job-id"]').value);
            data.append('type', ReviseC.querySelector('[name="revise"]').value);
            data.append('user', ReviseC.querySelector('[name="receiver"]').value);
            data.append('remark', ReviseC.querySelector('[name="remark"]').value);
            const selectedFiles = document.getElementById("rejectAttach").files;
            for (let i = 0; i < selectedFiles.length; i++) {
                data.append("attach[]", selectedFiles[i]);
            }

            // data.append('attach', document.getElementById("rejectAttach").files);
            // console.log(data);
            ReviseCompany(data).then(res => {
                currentIcon.setAttribute('class',currentClass);
                confirmToRevise.removeAttribute('disabled');
                if (res.status === true) ReviseContent.querySelector('button[data-dismiss="modal"]').click();
                Alert(res);
            })

        }
        // ======= /Revise Content ====== //

        const closeMenuRemarkBtn = e.target.closest('.close-remark');
        if(closeMenuRemarkBtn) CloseMenuRemark();

        const remarkFilter = e.target.closest('.dropdown-item')
        if(remarkFilter && remarkFilter.closest('.remark-filter')){
            /////////
            let newNode =  document.createElement('div');
            newNode.setAttribute('class','text-dark d-flex mr-1');
            /////////
            let colorBadge = remarkFilter.cloneNode(true);
            colorBadge.childNodes.forEach(function(el){
                let v = el.cloneNode(true);
                newNode.append(v);
            });
            /////////
            let button = remarkFilter.closest('.btn-group').querySelector('.btn');
            button.innerHTML = '';
            button.append(newNode);
            /////////
            let color = remarkFilter.getAttribute('data-color');
            remarkFilter.closest('.btn-group').querySelector('input').value = color;
        }

        const resetRemarkBtn = e.target.closest('.reset-remark');
        if(resetRemarkBtn) {
            let user = document.querySelector('input[name="user_id"]').value;
            let card = document.querySelector('.cs-on-process');
            let color = card.querySelector('[name="remark_color"]').value;
            let status = card.querySelector('[name="status"]').value;
            const Request = async () => {
                const request = await fetch(`webpanel/my-job/cs/remark-color/all-reset?user=${user}&color=${color}&status=${status}`);
                if(!request.ok) Error(request);
                const response = await request.json();
                return response;
            }
            Request().then(res=>{
                Alert(res);
                if( res.status === true ) {
                    let userId = document.querySelector('[name="user_id"]').value;
                    document.querySelectorAll('a.assignment').forEach(el => {
                        if(
                            el.getAttribute('user-id') == userId &&
                            el.closest('td').nextElementSibling.querySelector(`.${color}`)
                        ){

                            el.closest('td').nextElementSibling.querySelector(`.${color}`).setAttribute('class','remark default dropdown add-remark')
                        }
                    });
                }
            })
        }

    });
    document.querySelector('#ModalContact').querySelector('button[type="submit"]').addEventListener('click',function(e){
        e.preventDefault();
        let rowId = ContactContent.querySelector('[name="row-id"]').value;
        let data = {
            id: rowId,
            first_name: ContactContent.querySelector('[name="first_name"]').value,
            last_name: ContactContent.querySelector('[name="last_name"]').value,
            telephone: ContactContent.querySelector('[name="telephone"]').value,
            email: ContactContent.querySelector('[name="email"]').value
        }
        UpdateContact(data).then(res => { 
            Alert(res); 
            if(res?.status === true) setTimeout(res=>{ 
                let tr = document.getElementById('my-jobs').querySelector('.cs-on-process').querySelector(`[row-id="${rowId}"]`);
                ContactModal.hide(); 
                tr.querySelector('.telephone').setAttribute('data',data.telephone);
                tr.querySelector('.telephone > span').innerHTML = data.telephone;
                tr.querySelector('.email').setAttribute('data',data.email);
                tr.querySelector('.email > span').innerHTML = data.email;
                if(data.first_name != '') tr.querySelector('[name="first_name"]').value = data.first_name;
                if(data.last_name != '') tr.querySelector('[name="last_name"]').value = data.last_name;
            },1000); 
        });
    })
    window.addEventListener('keydown',function(e){
        const comment = e.target.closest('.new-comment-body');
        // Enter key and not shift key
        if(e.keyCode == 13 && e.shiftKey === false && comment) {
            e.preventDefault();
            let newComment = comment.innerText;
            comment.innerHTML = '';
            NewComment({
                comment: newComment,
                jobId: comment.closest('.modal-body').querySelector('[name="job-id"]').value,
                cid: comment.closest('.modal-body').querySelector('[name="company-id"]').value,
                userId: userId
            }).then(res => {
                Comments(comment.closest('.modal-body').querySelector('[name="job-id"]').value)
            })
        }
        // ESC key
        if(e.keyCode == 27)
        {
            const contactName = e.target.closest('.contact-name');
            const updateContactBtn = e.target.closest('.update-contact-name');
            if(contactName || updateContactBtn) {
                const inputGroup = contactName?.closest('.input-group') || updateContactBtn?.closest('.input-group');
                let firstName = inputGroup.querySelector('input[name="first_name"]').setAttribute('readonly',true);
                let lastName = inputGroup.querySelector('input[name="last_name"]').setAttribute('readonly',true);
                toggleClass(inputGroup.querySelector('.fa-save'),'fa-pen fa-save');
                toggleClass(inputGroup.querySelector('.update-contact-name'),'update-contact-name edit-contact-name');
            }
        }
    })

    document.addEventListener('change',function(e){
        // preview copyright pdf file from new window
        pdfFile = e.target.closest('.pdf-file');
        if(pdfFile){
            let file = pdfFile.files[0];
            let fileName = file.name;
            let status = pdfFile.closest('.modal-body')?.querySelector('input[name="status"]').value;
            UploadFile(fileName,file,status);
        }

        const reviseAttach = e.target.closest('.custom-file-input');
        if(reviseAttach)
        {
            let file = reviseAttach.files;
            if (file)
            {
                reviseAttach.nextElementSibling.classList.add("selected");
                let countfile = 0;
                reviseAttach.nextElementSibling.innerHTML = '';
                for (let i = 0; i < file.length; i++) {
                    countfile++
                }
                reviseAttach.nextElementSibling.innerHTML = `<div class='badge badge-primary'>${countfile} Files</div>`;
            }
        }
    
    })
    
    // pin a comment to top
    function PinAComment(menu)
    {

        const commentId = parseInt(menu.getAttribute('comment-id'));
        const jobId =  CommentContent.querySelector('input[name="job-id"]').value;
        async function Request() {
            const request = await fetch(`webpanel/my-job/cs/pin-a-comment?job=${jobId}&comment=${commentId}`);
            if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
            const response = await request.json();
            return response;
        }
        Request().then(res=> Comments(jobId));
    }
    
    // ================================================================= //
    const CloseMenuComment = () => document.querySelector('.menu-comment')?.remove();
    // ================================================================= //

    // fetch for load all comments from job
    function Comments(jobId)
    {
        async function data(jobId) {
            const request = await fetch(`webpanel/my-job/cs/comments?job=${jobId}`);
            if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
            const response = await request.json();
            return response;
        }
        data(jobId).then(res => {
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
            const rowComment = document.querySelector('.row-comment')
            rowComment.innerHTML = '';
            res.data.map(function(item, k){
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
    // fetch for remove pin
    function RemovePin(id)
    {
        async function Request(id){
            const request = await fetch(`webpanel/my-job/cs/comment/remove-pin?id=${id}`);
            if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
            const response = request.json();
            return response;
        }
        Request(id).then(res => { Comments(CommentContent.querySelector('input[name="job-id"]').value); if(res.status === false) Alert(res); });
    }
    // fetch for update contact data
    function updateContact(data) 
    {
        async function Request(data) {
            const request = await fetch(`webpanel/my-job/cs/contact/update`,{
                method: 'post',
                headers: {
                    "Content-type": "application/json; charset=utf-8;",
                    "X-CSRF-token": document.querySelector('meta[name="csrf-token"]').content
                },
                body:JSON.stringify(data)
            });
            if (request.status != 200 ) {
                Alert({status:false, message:`${request.status} ${request.statusText}`});
                return {status:false, message:`${request.status} ${request.statusText}`};
            }
            const response = await request.json();
            return response;
        }
        
        Request(data).then(res => { Alert(res); });
    }
    // clear comment in modal

    const ClearComment = () => CommentModalElement.querySelector('.row-comment').innerHTML = ' <div class="w-100 d-flex justify-content-center align-items-center" style="min-height:250px;"><span class="loader"></span></div>';
    // fetch new comment
    async function NewComment(data)
    {
        const request = await fetch(`webpanel/my-job/cs/comment/new`,{
            method: 'post',
            headers: {
                "Content-type":'application/json; charset=UTF-8',
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(data)
        });
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    //the menu comment on click
    const CommentMenu = (el,offset) =>
    {
        if(!document.querySelector('.menu-comment'))
        {
            const Menu = document.createElement('div');
            uid = parseInt(el.closest('.comment-item').getAttribute('user-id'));
            commentId = parseInt(el.closest('.comment-item').getAttribute('comment-id'));
            Menu.setAttribute('style',`position:fixed; top:${offset.top}px; left:${offset.left}px; z-index:9999;`)
            Menu.setAttribute('class','menu-comment');
            Menu.setAttribute('comment-id',commentId)
            Menu.setAttribute('user-id',uid)
            Menu.innerHTML = `
                <a href="javascript:" class="badge badge-secondary menu-close" style="right: -5px;top: -5px;"><i class="fas fa-times"></i></a>
                <div class="menu-body">
                    <a href="javascript:" class="menu-item" action="pin" comment-id="${commentId}"><i class="fas fa-thumbtack rt45 mr-1"></i> Pin to start</a>
                    <hr class="w-100 my-2">
                    <a href="javascript:" class="menu-item" action="reply" comment-id="${commentId}"><i class="fas fa-reply mr-2"></i> Reply</a>
                    <a href="javascript:" class="menu-item" action="copy" comment-id="${commentId}"><i class="fas fa-copy mr-2"></i> Copy</a>
                    <a href="javascript:" class="menu-item ${userId!=uid?`text-light`:``}" ${userId==uid?`action="edit" comment-id="${commentId}"`:``}><i class="fas fa-pen mr-2"></i> Edit</a>
                    <a href="javascript:" class="menu-item ${userId!=uid?`text-light`:``}" ${userId==uid?`action="delete" comment-id="${commentId}"`:``}><i class="fas fa-trash mr-2"></i> Delete</a>
                    <hr class="w-100 my-2">
                    <a href="javascript:" class="menu-item" action="add-to" comment-id="${commentId}"><i class="fas fa-tasks mr-2"></i> Add a to-do list</a>
                </div>
            `;
            Menu.querySelector('.menu-close').addEventListener('click',function(){
                document.querySelector('.menu-comment')?.remove();
            })
            document.querySelector('body').append(Menu);
        }
        // el.preventDefault();
       
    }
    // Revise
    async function ReviseItem(data)
    {
        console.log(data);
        const request = await fetch('webpanel/my-job/revise',{
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

    // toggle class, 
    // 1. element for toggle 
    // 2. class for toggle e.g. 'fa-pen fa-save'
    function toggleClass(el,toggle)
    {
        let className = toggle.split(' ');
        if(el?.classList?.contains(className[0]))
        {
            el?.classList?.remove(className[0]);
            el?.classList?.add(className[1]);
        }else{
            el?.classList?.remove(className[1]);
            el?.classList?.add(className[0]);
        }
    }
    // fetch, set checked or unchecked action on company process
    async function OnProcessAction(el)
    {
        const action = el.getAttribute('action');
        const request = await fetch(`webpanel/my-job/cs/on-process/${action}/${el.closest('tr').getAttribute('row-id')}`);
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    // refuse the company action
    function RefuseAction(el)
    {
        const tr = el.closest('tr');
        let jobId = tr.getAttribute('job-id');
        let companyId = tr.getAttribute('company-id');
        async function Request(data) {
            const request = await fetch('webpanel/my-job/cs/refuse',{
                method:'post',
                headers:{
                    'Content-Type' : 'application/json; charset:utf-8;',
                    'X-CSRF-Token' : document.querySelector('meta[name="csrf-token"]').content
                },
                body:JSON.stringify(data)
            });
            if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
            const response = await request.json();
            return response;
        }
        if(el.getAttribute('action') === 'refuse'){
            RefuseModal.show();
            document.addEventListener('click',(e) => {
                const btn = e.target.closest('.confirmRefuse');
                if (btn) {
                    Request({
                        'jid': jobId,
                        'cid': companyId,
                        'msg': RefuseContent.querySelector('textarea[name="message"]').value,
                        'mail': RefuseContent.querySelector('input[name="mail"]').value,
                        'status': RefuseContent.querySelector('input[name="status"]').value
                    }).then(res => {
                        Alert(res);
                        if(res.status === true) {
                            RefuseModal.hide();
                            RefuseContent.querySelector('textarea[name="message"]').value = '';
                            RefuseContent.querySelector('input[name="mail"]').value = '';
                            toggleClass(el,'badge-light badge-info');
                            toggleClass(el.querySelector('i'),'far fas');
                            toggleClass(el.querySelector('i'),'fa-circle fa-check-circle');
                        }
                    })
                }
            })
        }
    }
    // cpoy comment text
    function CopyTextToClipboard(element)
    {
        const commentId = element.getAttribute('comment-id');
        let text = document.querySelector(`.row-comment > [comment-id="${commentId}"]`).querySelector('span');
        try {
            navigator.clipboard.writeText(`${text.innerText}`).then(() => {
                Alert({status:true,message:`Copy Text to Clipboard`});
            });
        } catch (error) {
            console.log(error.message);
        }
    }
    //delete comment in process customer service
    function DeleteComment(id)
    {
        const thisComment = document.querySelector(`.row-comment > [comment-id="${id}"]`);
        if (thisComment?.classList.contains('my-comment')) thisComment.querySelector('.comment-body').prepend(LoadingMini);
        else thisComment.querySelector('.comment-body').append(LoadingMini);
        CloseMenuComment()
        async function request(id)
        {
            const request = await fetch(`webpanel/my-job/cs/comment/delete?id=${id}`);
            if (request.status != 200 ) {
                Alert({status:false, message:`${request.status} ${request.statusText}`});
                return {status:false, message:`${request.status} ${request.statusText}`};
            }
            const res = request.json();
            return res;
        }
        setTimeout(res => {
            request(id).then(res => removeCommentHtml(id,res));
        },1000)
    }
    /// Remove HTML comment
    function removeCommentHtml(id,res)
    {
        const thisComment = document.querySelector(`.row-comment > [comment-id="${id}"]`);;
        if(res.status === true) thisComment.remove();
        else thisComment.querySelector('.loading').remove();
    }
    /// Draggable content for modal
    function Draggable(elmnt)
    {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        element = elmnt.querySelector('.draggable-handle');
        element.onmousedown = dragMouseDown;
        function dragMouseDown(e) {
            e = e || window.event;
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
            e.preventDefault();
        }
        function elementDrag(e) {
            e = e || window.event;
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            e.preventDefault();
        }
        function closeDragElement() {
            // stop moving when mouse button is released:
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
    /// upload pdf file
    function UploadFile(fileName,input,status)
    {
        let AttactContent = document.querySelector('#ModalAttach');
        let tr = document.querySelector(`[row-id="${AttactContent.querySelector('[name="row-id"]').value}"]`);
        let file = document.querySelector(".pdf-file").files[0];
        let fileSize = (file.size < 1024) ? file.size + " KB" : (file.size/(1024*1024)).toFixed(2) + " MB";
        let item = document.createElement('div');
        item.setAttribute('class','pdf-item bg-light');
        item.setAttribute('row-id',tr.getAttribute('row-id'));
        item.setAttribute('job-id',tr.getAttribute('job-id'));
        item.setAttribute('company-id',tr.getAttribute('company-id'));
        item.innerHTML = `
        <div class="d-flex">
            <div class="pdf-icon">
                <i class="far fa-file-pdf text-danger fa-4x"></i>
            </div>
            <div class="pdf-detail">
                <a href="javascript:" class="badge badge-light badge-close pdf-remove"><i class="fas fa-times"></i></a>
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
        AttactContent.querySelector(".pdf-row").append(item);
        
        this.name = item.querySelector('.pdf-name');
        this.size = item.querySelector('.pdf-size');
        this.filePercent = item.querySelector('.progress-percent');
        this.filePregress = item.querySelector('.progress');
        this.filePregressBar = item.querySelector('.progress-bar');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "webpanel/my-job/cs/attach-file");
        xhr.upload.addEventListener("progress", ({loaded, total}) => 
        {

            let fileLoaded = Math.floor((loaded / total) * 100);
            let fileTotal = Math.floor(total / 1000);
            let size = (fileTotal < 1024) ? fileTotal + " KB" : (loaded/(1024*1024)).toFixed(2) + " MB";

            this.filePercent.innerHTML = `Uploading ${fileLoaded}%`;
            this.filePregressBar.style = `width:${fileLoaded}%`;
            this.filePregressBar.setAttribute('aria-valuenow',fileLoaded);
            


            if(loaded == total){
                // this.size.classList.remove('d-none');
                // this.filePercent.remove();
                // this.filePregress.remove();
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
        data.append('companyId',AttactContent.querySelector('input[name="company-id"]').value);
        data.append('attachFile',input);
        data.append('size',file.size);
        data.append('status',status);
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
                tr.querySelector('.modal-attach').setAttribute('copyright',res.file);
                toggleClass(tr.querySelector('.modal-attach'),'badge-secondary badge-primary-light');
                document.querySelector('.pdf-file').value = null;
            }
        };
        xhr.send(data);
      
    }
    /// remove pdf file
    function RemoveFile(el)
    {
        const companyId = el?.getAttribute('company-id');
        const rowId = el?.getAttribute('row-id');
        const tr = document.querySelector(`tr[row-id="${AttactContent.querySelector('input[name="row-id"]').value}"]`);
        if(confirm('Confirm to delete?') === true)
        {
            if (companyId)
            {
                try 
                {
                    async function Request() {
                        const request = await fetch(`webpanel/my-job/cs/attach-file/delete?companyId=${companyId}`);
                        if (request.status != 200 ) {
                            Alert({status:false, message:`${request.status} ${request.statusText}`});
                            return {status:false, message:`${request.status} ${request.statusText}`};
                        }
                        const response = await request.json();
                        return response;
                    }
                    Request(companyId).then(res => { 
                        if(res.status === false) Alert(res); else el.remove();
                        tr.querySelector('.modal-attach').removeAttribute('copyright');
                        toggleClass(tr.querySelector('.modal-attach'),'badge-secondary badge-primary-light');
                    });
                } catch (error) {
                    Alert({status:false,message:error});
                }
            }else{
                el.remove();
            }
        }
    }
    /// fetch for set remark color
    function SetRemarkColor(color)
    {
        const Request = async () => {
            const request = await fetch(`webpanel/my-job/cs/remark-color?color=${color}`);
            if (request.status != 200 ) {
                Alert({status:false, message:`${request.status} ${request.statusText}`});
                return {status:false, message:`${request.status} ${request.statusText}`};
            }
            const response = await request.json();
            return response;
        }
        Request.then(res => {
            if(res.status === 200){
                CloseMenuRemark();
            }
        })
    }
    var dropdownElement = (element) =>
    {
        const div = document.createElement('div');
        if(!element.querySelector('.dropdown-menu'))
        {
            div.setAttribute('class','dropdown-menu color-menu');
            div.style.display = 'block';
            div.innerHTML = `
                <a class="badge badge-secondary badge-close close-remark" href="javascript:">
                    <i class="fas fa-times"></i>
                </a>
                <a class="dropdown-item monday" href="javascript:" data-color="monday">
                    <span class="badge-color monday mr-2"></span>
                    <span>Monday</span>
                </a>
                <a class="dropdown-item tuesday" href="javascript:" data-color="tuesday">
                    <span class="badge-color tuesday mr-2"></span>
                    <span>Tuesday</span>
                </a>
                <a class="dropdown-item wednesday" href="javascript:" data-color="wednesday">
                    <span class="badge-color wednesday mr-2"></span>
                    <span>Wednesday</span>
                </a>
                <a class="dropdown-item thursday" href="javascript:" data-color="thursday">
                    <span class="badge-color thursday mr-2"></span>
                    <span>Thursday</span>
                </a>
                <a class="dropdown-item friday" href="javascript:" data-color="friday">
                    <span class="badge-color friday mr-2"></span>
                    <span>Friday</span>
                </a>
                <a class="dropdown-item saturday" href="javascript:" data-color="saturday">
                    <span class="badge-color saturday mr-2"></span>
                    <span>Saturday</span>
                </a>
                <a class="dropdown-item sunday" href="javascript:" data-color="sunday">
                    <span class="badge-color sunday mr-2"></span>
                    <span>Sunday</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item reset-color" href="javascript:">Reset</a>
            `;
            element.append(div);
        }
    }
    async function ReviseCompany(data)
    {
        // data = new FormData();
        const request = await fetch(`webpanel/my-job/revise`,{
            method:'post',
            headers:{
                // "Content-type":'multipart/form-data; charset:utf-8;',
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
            },
            body: data
        });
        if (request.status != 200 ) {
            Alert({status:false, message:`${request.status} ${request.statusText}`});
            return {status:false, message:`${request.status} ${request.statusText}`};
        }
        const response = await request.json();
        return response;
    }
    function ClearReviseModal()
    {
        ReviseContent.querySelector('.revise-badge').innerHTML = '';
        let receiver = ReviseContent.querySelector('.badge-info');
        if(receiver) toggleClass(receiver,'badge-light badge-info');
        ReviseContent.querySelector('[name="remark"]').value = '';
        ReviseContent.querySelector('[name="rejectAttach[]"]').value = null;
    }

    /// close menu remark color
    const CloseMenuRemark = () => {
        document.querySelector('.color-menu')?.remove();
    }
</script>