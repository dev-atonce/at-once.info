<style>
    html {
        scroll-behavior: smooth;
    }

    
</style>
@php
    $user = Auth::user();
    $req_user = Request::get('user');
    $req_date = Request::get('date');
    /*-----------------------------------------*/
    $req_license = Request::get('license');
    $req_return = Request::get('return');
    $req_banner = Request::get('banner');
    $req_refuse = Request::get('refuse');
    $req_keyword = Request::get('keyword');
    /*-----------------------------------------*/
    
    // $queryBooking = \App\Models\JobCsMd::select(['job_cs.*', 'cp.name_th', 'cp.name_jp', 'category.name_jp as categoryName', 'cp.public', 'cp.id as cid'])
    //     ->join('company as cp', 'job_cs.company', '=', 'cp.id')
    //     ->leftJoin('category', 'cp.category', '=', 'category.id')
    //     // ->where('cp.public', '!=', 1)
    //     ->whereNull(['job_cs.refuse','cp.deleted']);
    // $CountBooking = $queryBooking->get()->count();
    // $booking = $queryBooking->limit(50)->get();
    // $refuseCount = \App\Models\JobCsMd::whereNotNull('refuse')->get()->count();

    // $emailappr = \App\Models\SendToMd::whereNotIn('status', ['waiting', 'done', 'revise'])
    //     ->where('cs_id', Auth::user()->id)->get()->count();
    // $emailreject = \App\Models\SendToMd::where('status', 'reject')
    //     ->where('cs_reject', Auth::user()->id)->get()->count();
    // $email_revise = \App\Models\SendToMd::select(['revise_email.created', 'revise_email.message', 'revise_email.from_id', 'to_company', 'users.name', 'content', 'revise_email._id', 'revise_email.id'])
    //     ->where('send_to.status', 'revise')
    //     ->where('revise_email.status', 'process')
    //     ->where('to_id', Auth::user()->id)
    //     ->leftJoin('revise_email', 'send_to.id', 'revise_email._id')
    //     ->leftJoin('users', 'revise_email.from_id', 'users.id')
    //     ->get();
@endphp

<div class="row" id="cs-content">
    {{-- <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <form action="" method="get">
                    <h3 class="mb-2">Customer Service</h3>
                    @if ($auth->role == 'developer')
                        <select name="user" class="custom-select custom-select-sm mb-3">
                            <option value="">Choose...</option>
                            @foreach (\App\Models\UsersMd::where('status', 'active')->where('position', 3)->get() as $k => $v)
                                <option value="{{ $v->id }}" @if ($v->id == $req_user) selected @endif>
                                    {{ $v->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if ($auth->role != 'developer')
                        <hr class="my-4">
                    @endif
                    <div class="fs-6 fw-semibold title mb-1">DATE</div>
                    <div class="input-group input-group-sm">
                        <input type="text" name="date" id="cs_date" class="form-control" readonly
                            value="{{ $req_date }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm" type="submit"><i
                                    class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">BOOKING</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ $booking->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">REFUSE</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ number_format(@$refuseCount) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">
                    <a
                        @if ($email_revise->count() > 0) style="color:red; text-decoration:none;" href="/webpanel/my-job#revisemail-zone" @endif>MAIL
                        REVISE</a>
                </div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number" @if ($email_revise->count() > 0) style="color:red;" @endif>
                        {{ $email_revise->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title" @if (number_format($emailappr) > 0) style="color:red;" @endif>
                    <a
                        @if (number_format($emailappr) > 0) style="color:red; text-decoration:none;" href="/webpanel/mail/history-mail?cs={{ Auth::user()->id }}" @endif>MAIL
                        APPROVE</a>
                </div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number" @if (number_format($emailappr) > 0) style="color:red;" @endif>
                        {{ number_format($emailappr) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title" @if (number_format($emailreject) > 0) style="color:red;" @endif>
                    <a
                        @if (number_format($emailreject) > 0) style="color:red; text-decoration:none;" href="/webpanel/email-reject?cs={{ Auth::user()->id }}" @endif>MAIL
                        REJECT</a>
                </div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number" @if (number_format($emailreject) > 0) style="color:red;" @endif>
                        {{ number_format($emailreject) }}</div>
                </div>
            </div>
        </div>
    </div> --}}
    
    <style type="text/css">
        .stockcs .form-control.cs-droplist {
            color: #39f;
            font-weight: 500;
            border: 2px solid #3399ff;
        }
    
    
        .stockcs .table th, .stockcs .table td{
            border-bottom: 1px solid;
            border-bottom-color: #f0f2f5;
            vertical-align: middle;
        }
        .ui-draggable .ui-draggable-handle{
            cursor: move;
        }
    </style>
    
    


    
    
    
</div>

<div class="modal fade" id="ModalComment">
    <div class="modal-dialog br-2x modal-lg ">
        <div class="modal-content br-3x">
            <div class="modal-header pl-3 pr-2 py-2 align-items-center draggable-handle">
                <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                <a href="javascript:" class="badge badge-light badge-close badge-close-lg text-dark" data-dismiss="modal" aria-label="Close">
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
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let RefuseContent = document.querySelector('#ModalRefuse');
    let RefuseModal = new bootstrap.Modal(RefuseContent,{backdrop:false, keyboard:true});
    let CommentContent = document.querySelector('#ModalComment');
    let CommentModal = new bootstrap.Modal(CommentContent,{backdrop:false, keyboard:true});
    
    let ContactContent = document.querySelector('#ModalContact');
    let ContactModal = new bootstrap.Modal(ContactContent,{backdrop:false, keyboard:true})

    var LoadingMini = document.createElement('span');
    LoadingMini.setAttribute('class','loader-mini');

    // get on process data from row_cs, job_cs, company, category table database.
    async function getDataOnProgress(params)
    {
        let queryString = Object.keys(params)
            .map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`)
            .join('&');
        const request = await fetch(`api/my-job/on-process?${queryString}`);
        const response = await request.json();
        return response;
    }
    async function getCompleteDataProgress(params)
    {
        let queryString = Object.keys(params)
            .map(k => `${encodeURIComponent(k)}=${encodeURIComponent(params[k])}`)
            .join('&');
        let copyright = queryString.search('license_attachfile');
        const request = await fetch(`api/my-job/on-process?status=done${copyright<0?`&license_attachfile=yes`:``}&${queryString}`);
        if(!request.ok) Error(res);
        const response = await request.json();
        return response;
    }

    async function UpdateContact(data)
    {
        const request = await fetch(`webpanel/my-job/cs/contact/update`,{
            method:'post',
            headers:{
                "Content-Type":"application/json; charset:utf-8;",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify(data)
        })
        const response = await request.json();
        if(response.status == 500 ) Alert({status:false,message:'500 Internal Server Error'});
        return response;
    }

    function Error(data)
    {
        let message = 'Unknown error';
        message = (data.status === 500) ? '500 Internal server error' : message;
        message = (data.status === 404) ? '404 Page not found' : message,
        Alert({status:false,message:message});
    }

    Draggable(CommentContent);
    
    if(typeof RowContent !== typeof undefined) Draggable(RowContent);
    if(typeof ImportContent !== typeof undefined) Draggable(ImportContent);
    

    // fetch on process data
    function fetchOnProcess(meta)
    {
        const appendTo = document.getElementById('my-jobs').querySelector('.cs-on-process');
        const params = meta ? meta : [];
        let metaData = {};
        function Items(items)
        {
            appendTo.querySelector('tbody').innerHTML = '';
            if (items?.meta) appendTo.querySelector('.count-on-process').innerHTML = items.meta.allRows;
            ////////////////////////////////////////////////////////////////
            let start = (items.meta?.skip) ? parseInt(items.meta.skip) + 1 : 1;
            appendTo.querySelector('tbody').innerHTML = '';
            items?.data.map(function(v,k){
                
                let tr = document.createElement('tr');
                tr.setAttribute('row-id',v.rowId);
                tr.setAttribute('job-id',v.jobId);
                tr.setAttribute('company-id',v.cid);
                tr.innerHTML = `
                    <td class="text-center align-middle">${start++}</td>
                    <td class="align-middle">
                        <a class="text-dark" href="th/preview/${v.cid}" target="_blank" title="Preview">
                            <p class="mb-0">${v.name_en}</p>
                        </a>
                        <div class="input-group">
                            <input 
                                type="text"
                                name="first_name"
                                class="form-control form-control-sm contact-name" 
                                placeholder="First name" 
                                value="${v.first_name?`${v.first_name}`:``}"
                                autocomplete="new-first-name"
                                readonly="">
                            <input 
                                type="text" 
                                name="last_name"
                                class="form-control form-control-sm contact-name" 
                                placeholder="Last name" 
                                value="${v.last_name?`${v.last_name}`:``}"
                                autocomplete="new-last-name"
                                readonly="">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary edit-contact-name">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            <small>Assign</small>
                            ${v.assignment 
                                ? `<a class="user bg-primary assignment" user-id="${v.assignment}" href="javascript:" data-placement="top" data-toggle="tooltip" title="${v.display_name}">${v.display}</a>`
                                : `<a class="user bg-dark assignment add-assignment" href="javascript:"><i class="fas fa-plus"></i></a>`
                            }
                        </div>
                    </td>
                    <td class="px-1">
                        <div style="display:grid; justify-content:center; justify-items:center;">
                            <small>Remark</small>
                            <a class="remark ${v.remark_color?`${v.remark_color}`:`default`} dropdown add-remark" href="javascript:"></a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <small>${v.categoryEN}</small>
                        <hr class="my-1">
                        <div class="d-flex justify-content-center">
                            <a class="text-primary contact-data telephone" href="javascript:" data="${v.telephone}">
                                <strong>Tel : </strong><span>${v.telephone}</span>
                            </a>
                            <span class="mx-1">|</span>
                            <a class="text-primary contact-data email" href="javascript:" data="${v.email}"> 
                                <strong>Email : </strong><span>${v.email}</span>
                            </a>
                        </div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="on-process position-relative">
                            <a href="javascript:" class="position-absolute badge badge-dark edit-process">
                                <i class="fas fa-pen"></i>
                            </a>
                            <div class="mt-1 edit-button">
                                <span class="badge ${v.send_email?`badge-info`:`badge-light`} btn-badge badge-shadow send-email" action="send-email">
                                    <i class="${v.send_email?`fas fa-check-circle`:`far fa-circle`} pr-1"></i>Send Email
                                </span>
                                <span class="badge ${v.cannot_contact?`badge-info`:`badge-light`} btn-badge badge-shadow cannot-contact" action="cannot-contact">
                                    <i class="${v.cannot_contact?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Cannot Contact
                                </span>
                                <span class="badge ${v.follow?`badge-info`:`badge-light`} btn-badge badge-shadow follow" action="follow">
                                    <i class="${v.follow?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Follow
                                    </span>
                                <span class="badge ${v.no_response?`badge-info`:`badge-light`} btn-badge badge-shadow no-reponse" action="no-response">
                                    <i class="${v.no_response?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>No Response
                                </span>
                                <span class="badge ${v.refuse?`badge-info`:`badge-light`} btn-badge badge-shadow refuse" action="refuse">
                                    <i class="${v.refuse?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Refuse
                                </span>
                                <span class="badge ${v.call_again?`badge-info`:`badge-light`} btn-badge badge-shadow call-again" action="call-again">
                                    <i class="${v.call_again?`fas fa-check-circle`:`far fa-circle`}  pr-1"></i>Call Again
                                </span>
                            </div>
                        </div>
                        <hr class="my-1">
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
                appendTo.querySelector('tbody').append(tr);
            });
        }
        const processPaginate = new Pagination({
            content: appendTo,
            rows: getDataOnProgress,
            items: Items,
            search: {
                keyword: appendTo.querySelector('input[name="keyword"]'),
                status: appendTo.querySelector('select[name="status"]'),
                remark_color: appendTo.querySelector('input[name="remark_color"]'),
                user_id: appendTo.querySelector('input[name="user_id"]'),
                submit: appendTo.querySelector('[type="submit"]'),
                reset: appendTo.querySelector('[type="reset"]')
            },
            refresh: appendTo.querySelector('.refresh')
        });
    }
    // load on process data from job customers
    fetchOnProcess()

    function fetcthComplete(meta)
    {
        const appendTo = document.getElementById('my-jobs').querySelector('.complete-on-process');
        const params = meta ? meta : [];
        let metaData = {};
        function Items(items)
        {
            appendTo.querySelector('tbody').innerHTML = '';
            if (items?.meta) appendTo.querySelector('.count-on-done').innerHTML = items.meta.allRows;
            ////////////////////////////////////////////////////////////////
            let start = (items.meta?.skip) ? parseInt(items.meta.skip) + 1 : 1;
            appendTo.querySelector('tbody').innerHTML = '';
            items?.data.map(function(v,k){
                let tr = document.createElement('tr');
                tr.setAttribute('row-id',v.rowId);
                tr.setAttribute('job-id',v.jobId);
                tr.setAttribute('company-id',v.cid);
                let ext = v.copyright.split('.')[1];
                tr.innerHTML = `
                    <td class="text-center">${start++}</td>
                    <td>
                        <span class="badge badge-primary-light">TH</span>${v.name_th}<br>
                        <span class="badge badge-primary-light">EN</span>${v.name_en}
                    </td>
                    <td class="text-center"><small>${v.categoryEN}</small></td>
                    <td class="text-center">
                        <a 
                            href="/th/preview/company-profile/${v?.cid}" 
                            target="_blank" 
                            class="badge bg-light text-dark">
                                <i class="fas fa-eye"></i> Preview
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="th/${v.key}/cp/${v.profile_url}" target="_blank" class="badge badge-success">
                            <i class="fas fa-check"></i> Public
                        </a>
                    </td>
                    <td class="text-center">
                        ${v.copyright 
                            ?
                            `<a 
                                ${ext =='pdf' 
                                    ?`href="javascript:"`
                                    :`href="${v.copyright}"`
                                }
                                class="badge badge-primary-light${ext=='pdf'?` pdf-preview`:``}"
                                target="_blank"
                                ${ext == 'pdf'?`copyright="/read/pdf?path=${v.copyright}"`:``}
                            >
                                ${ext == 'pdf'
                                    ?`<i class="far fa-file-pdf"></i>`
                                    :`<i class="fas fa-file-image"></i>`
                                } ${ext.toUpperCase()}</a>
                            `
                            :
                            ``}
                        </td>
                `;
                appendTo.querySelector('tbody').append(tr);
            });
        }
        const processPaginate = new Pagination({
            content: appendTo,
            rows: getCompleteDataProgress,
            items: Items,
            search: {
                license_attachfile: appendTo.querySelector('select[name="license_attachfile"]'),
                keyword: appendTo.querySelector('input[name="keyword"]'),
                submit: appendTo.querySelector('[type="submit"]'),
                reset: appendTo.querySelector('[type="reset"]')
            },
            refresh: appendTo.querySelector('.refresh')
        });
    }
    fetcthComplete();

    document.querySelector('body').onscroll = (event) => {
        // close menu option other click or scroll
        CloseMenuComment();
        CloseMenuRemark();
    }
 
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
                toggleClass(editProcessBtn,'badge-light badge-info');
                toggleClass(editProcessBtn.querySelector('i'),'far fas');
                toggleClass(editProcessBtn.querySelector('i'),'fa-circle fa-check-circle');
                OnProcessAction(editProcessBtn).then(response => {
                    if(response.status == 500) Alert(response);
                    
                })
            }
        }
        const commentModal = e.target.closest('.comment-modal');
        if (commentModal) {
            let tr = commentModal.closest('tr');
            CommentModal.querySelector('.row-comment').innerHTML = '';
            CommentContent.querySelector('input[name="company-id"]').value = tr.getAttribute('company-id');
            CommentContent.querySelector('input[name="job-id"]').value = tr.getAttribute('job-id');
            CommentContent.querySelector('input[name="row-id"]').value = tr.getAttribute('row-id');
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
            if(copyright != null){

                
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
        if(e.keyCode == 27){
  
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
            const response = await request.json();
            return response;
        }
        Request(data).then(res => { Alert(res); });
    }
    // clear comment in modal
    const ClearComment = (el) => el.innerHTML = '';
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
        if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
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
        if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
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
            if(request.status === 500) Alert({status:false,message:'500 Internal server error'});
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
                        if(request.status === 500) Alert({status:false,message:'Error 500, internal server error'});
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
            if(request.status === 500) Alert({status:false,message:'500 Internal server error'});
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
                <a class="dropdown-item yellow" href="javascript:" data-color="yellow">
                    <span class="badge-color yellow mr-2"></span>
                    <span>Yellow</span>
                </a>
                <a class="dropdown-item deep-pink" href="javascript:" data-color="deep-pink">
                    <span class="badge-color deep-pink mr-2"></span>
                    <span>Deep Pink</span>
                </a>
                <a class="dropdown-item green" href="javascript:" data-color="green">
                    <span class="badge-color green mr-2"></span>
                    <span>Green</span>
                </a>
                <a class="dropdown-item orange-red" href="javascript:" data-color="orange-red">
                    <span class="badge-color orange-red mr-2"></span>
                    <span>Orange Red</span>
                </a>
                <a class="dropdown-item deep-sky-blue" href="javascript:" data-color="deep-sky-blue">
                    <span class="badge-color deep-sky-blue mr-2"></span>
                    <span>Deep Sky Blue</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item reset-color" href="javascript:">Reset</a>
            `;
            element.append(div);
        }
    }
    /// close menu remark color
    const CloseMenuRemark = () => {
        document.querySelector('.color-menu')?.remove();
    }
    

</script>
{{--------------------------------------------------------------------------------}}
<script>
    $(document).on('click', '.show-modal', function() {
        _id = $(this).attr('data-id');
        id = $(this).attr('data-revise');
        fd = new FormData();
        fd.append('_id', _id);
        modal = $('#modalrevise');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/detailrevise/cs',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) => {
                modal.find('#_id').val(_id);
                modal.find('#id').val(id);
                modal.find('#company').val(res.comapny);
                modal.find('#telephone').val(res.telephone);
                modal.find('#department').val(res.department);
                modal.find('#name').val(res.name);
                modal.find('#email').val(res.email);
                modal.find('#content').val(res.content);
            }
        })
        modal.modal('show');
    })

    $(document).on('click', 'button.update-revise', function() {
        fd = new FormData();
        modal = $('#modalrevise');
        $(this).prop('disabled', true);
        fd.append('company', modal.find('input[name="company"]').val());
        fd.append('telephone', modal.find('input[name="telephone"]').val());
        fd.append('department', modal.find('input[name="department"]').val());
        fd.append('name', modal.find('input[name="name"]').val());
        fd.append('email', modal.find('input[name="email"]').val());
        fd.append('content', modal.find('textarea#content').val());
        fd.append('_id', modal.find('input[name="_id"]').val());
        fd.append('id', modal.find('input[name="id"]').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/update-revise/cs',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) => {
                if (res == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Your Email has been Updated',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Updated Failed',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('button.update-revise').prop('disabled', false);
                    })
                }
            }
        })
    })

    // OOP javascript function, created by HOCK3Y //
    // const dataContent = (config) => {
    //     var extend = function(obj, extObj) {
    //         if (arguments.length > 2) {
    //             for (var a = 1; a < arguments.length; a++) extend(obj, arguments[a]);
    //         } else {
    //             for (var i in extObj) obj[i] = extObj[i];
    //         }
    //         return obj;
    //     };
    //     const defaults = {
    //         autoRun: true, // Boolean
    //         paginate: {
    //             previous: 0,
    //             next: 20,
    //             take: 20,
    //             currentPage: 1,
    //             allPage: 0
    //         },
    //         pagination: 'content-pagination',
    //         content: 'content-data',
    //         url: 'get/data/from',
    //         params: {
    //             date: null,
    //             keyword: null
    //         },
    //         columnName: [],
    //         columnKey: [],
    //         action: ''
    //     };
    //     //================= Extend config from default variable. =================//
    //     const obj = extend(defaults, config);
    //     //================= Find the element to use the function. ================//
    //     var thisContent = document.getElementById(obj.content);
    //     //================= Loading Overlay =================//
    //     var loadingOverlay = document.createElement('div');
    //     loadingOverlay.setAttribute('class', 'content-overlay');
    //     loadingOverlay.innerHTML = `<div class="cv-spinner"><span class="spinner"></span></div>`;
    //     const crContent = thisContent?.querySelector('.card-body');
    //     crContent?.appendChild(loadingOverlay);
    //     //================= Number format from integer variable =================//
    //     const numberFormat = (x) => x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //     //================= Retrieve data from api your url =================//
    //     async function getData(skip) {
    //         try {
    //             crContent?.appendChild(loadingOverlay);
    //             const request = {
    //                 skip: (typeof skip == undefined) ? 0 : skip,
    //                 take: obj.paginate.take
    //             };
    //             const get = await axios(obj.url, {
    //                 params: request
    //             });
    //             fetchData(get.data, obj.paginate.previous);
    //             if (Object.keys(get).length >= 6) {
    //                 setTimeout(() => {
    //                     thisContent?.querySelector('.content-overlay').remove();
    //                     crContent.scroll({
    //                         top: 0,
    //                         behavior: 'smooth'
    //                     });
    //                 }, 500);
    //             }
    //         } catch (err) {
    //             console.log(err)
    //         }
    //     }
    //     const className = (x) => x.replace('.', '');
    //     //================= Fetch data from getData function and insert data to table =================//
    //     const fetchData = (data, start) => {
    //         const table = document.getElementById(obj.content);
    //         const tbody = table?.querySelector('tbody');
    //         const paginate = table?.querySelector('.card-footer');

    //         skip = (start == 0) ? 20 : start;

    //         if (thisContent?.querySelector(obj.pagination) == null) {
    //             obj.paginate.allPage = data.page;
    //             let footerContent = document.createElement('div');
    //             footerContent.setAttribute('class', 'm-auto');

    //             let prevButton = document.createElement('button');
    //             prevButton.setAttribute('class', 'btn btn-primary btn-lg mr-2 prev-page');
    //             prevButton.setAttribute('skip', obj.paginate.previous);
    //             prevButton.setAttribute('disabled', '');
    //             prevButton.innerHTML = `<i class="fas fa-backward"></i>`;


    //             let nextButton = document.createElement('button');
    //             nextButton.setAttribute('class', 'btn btn-primary btn-lg ml-2 next-page');
    //             nextButton.setAttribute('skip', obj.paginate.next);
    //             nextButton.innerHTML = `<i class="fas fa-forward"></i>`

    //             let select = document.createElement('select');
    //             select.setAttribute('class', `form-control m-auto text-center ${className(obj.pagination)}`);
    //             for (let i = 0; i < data.page; i++) {
    //                 let option = document.createElement('option');
    //                 option.innerHTML = (i + 1);
    //                 option.setAttribute('value', (i * skip));
    //                 select.appendChild(option);
    //             }
    //             footerContent.append(prevButton)
    //             footerContent.append(select)
    //             footerContent.append(nextButton)
    //             paginate?.append(footerContent);
    //         }
    //         tbody.innerHTML = '';
    //         let i = 0;
    //         data.data.map((v, k) => {
    //             i = (start == 0) ? numberFormat(k + 1) : numberFormat(start + k + 1);
    //             tr = document.createElement('tr');
    //             no = document.createElement('td'),
    //                 logo = document.createElement('td'),
    //                 companyName = document.createElement('td'),
    //                 receiptDate = document.createElement('td'),
    //                 by = document.createElement('td'),
    //                 typeOfData = document.createElement('td'),
    //                 receiveBy = document.createElement('td'),
    //                 file = document.createElement('td'),
    //                 action = document.createElement('td');
    //             tr.setAttribute('class', 'align-middle');
    //             tr.setAttribute('company', v.companyId);
    //             tr.setAttribute('job', v.jobId);
    //             no.innerHTML = i;
    //             logo.innerHTML = `<img class="file-thumbnail border" src="${v.logo}">`;
    //             companyName.innerHTML =
    //                 `<p class="cp-name mb-0">${v.name_jp}</p><p class="cp-name mb-0">${v.name_th}</p><small class="text-primary font-weight-bold">${v.categoryName}</small>`;
    //             receiptDate.setAttribute('class', 'text-center');
    //             receiptDate.innerHTML = v.license;
    //             by.setAttribute('class', 'text-center');
    //             by.innerHTML = `<i class="fas fa-user-circle"></i><br><small>${v.by}</small>`;
    //             action.setAttribute('class', 'text-center')
    //             action.innerHTML =
    //                 `<a class="badge badge-secondary" href="javascript:"><i class="fas fa-pen fa-fw"></i> Edit</a><a class="badge badge-warning d-none"><i class=fas fa-save fa-fw"></i> Save</a>`;

    //             let row = [];
    //             for (var i in v) row[i] = v[i];

    //             Array.from(obj.column, (val) => {
    //                 switch (val) {
    //                     case 'no':
    //                         tr.appendChild(no);
    //                         break;
    //                     case 'logo':
    //                         tr.appendChild(logo);
    //                         break;
    //                     case 'companyName':
    //                         tr.appendChild(companyName);
    //                         break;
    //                     case 'receiptDate':
    //                         tr.appendChild(receiptDate);
    //                         break;
    //                     case 'by':
    //                         tr.appendChild(by);
    //                         break;
    //                     case 'typeOfData':
    //                         tr.appendChild(typeOfData);
    //                         break;
    //                     case 'receiveBy':
    //                         tr.appendChild(receiveBy);
    //                         break;
    //                     case 'file':
    //                         tr.appendChild(file);
    //                         break;
    //                     default:
    //                         tr.appendChild(action);
    //                         break;
    //                 }
    //             })
    //             tbody.appendChild(tr);
    //         })
    //     }
    //     ================= Event from click from pagination =================//
    //     document.addEventListener('change', function(ev) {
    //         const pageSelect = ev.target.closest(obj.pagination);
    //         const prevPage = thisContent?.querySelector('.prev-page');
    //         const nextPage = thisContent?.querySelector('.next-page');
    //         const paginate = thisContent?.querySelector(obj.pagination);
    //         if (pageSelect) {
    //             obj.paginate.next = Number(pageSelect.value) + obj.paginate.take;
    //             obj.paginate.currentPage = Number(pageSelect.selectedIndex + 1);
    //             obj.paginate.previous = obj.paginate.currentPage == 1 ? 0 : obj.paginate.next - obj.paginate.take;
    //             if (obj.paginate.currentPage == 1) prevPage.setAttribute('disabled', '');
    //             else prevPage.removeAttribute('disabled');
    //             if (obj.paginate.currentPage < obj.paginate.allPage) nextPage.removeAttribute('disabled');
    //             else nextPage.setAttribute('disabled', '');
    //             prevPage.setAttribute('skip', obj.paginate.previous);
    //             nextPage.setAttribute('skip', obj.paginate.next);
    //             getData(obj.paginate.previous)
    //         }
    //     })
    //     ================= Event from change from pagination =================//
    //     document.addEventListener('click', function(ev) {
    //         const prevButton = ev.target.closest('.prev-page');
    //         const nextButton = ev.target.closest('.next-page');
    //         const prevPage = thisContent?.querySelector('.prev-page');
    //         const nextPage = thisContent?.querySelector('.next-page');
    //         const paginate = thisContent?.querySelector(obj.pagination);
    //         if (prevButton) {
    //             obj.paginate.previous = obj.paginate.previous - obj.paginate.take;
    //             obj.paginate.next = obj.paginate.next - obj.paginate.take;
    //             obj.paginate.currentPage = (obj.paginate.currentPage - 1);
    //             if (obj.paginate.previous == 0) prevPage.setAttribute('disabled', '');
    //             if (obj.paginate.currentPage < obj.paginate.allPage) nextPage?.removeAttribute('disabled');
    //             prevPage.setAttribute('skip', obj.paginate.previous)
    //             nextPage.setAttribute('skip', obj.paginate.next)
    //             getData(obj.paginate.previous)
    //         }
    //         if (nextButton) {
    //             obj.paginate.previous = obj.paginate.next;
    //             obj.paginate.next = obj.paginate.next + obj.paginate.take
    //             obj.paginate.currentPage = (obj.paginate.currentPage + 1);
    //             if (obj.paginate.previous > 0) prevPage.removeAttribute('disabled');
    //             if (obj.paginate.currentPage == obj.paginate.allPage) nextPage.setAttribute('disabled', '');
    //             prevPage.setAttribute('skip', obj.paginate.previous)
    //             nextPage.setAttribute('skip', obj.paginate.next)
    //             getData(obj.paginate.previous)
    //         }
    //         //================= Auto select from button events =================//
    //         pl = paginate ? paginate.length : 0 ;
    //         for (var i = 0; i < pl; i++) {
    //             if (Number(paginate[i].text) == obj.paginate.currentPage) paginate[i].selected = true;
    //         }
    //     })
    //     if (obj.autoRun === true) getData();

    // };
    // const test = dataContent({
    //     content: 'cs-copyright-content',
    //     url: 'api/my-job/cs/get/copyright',
    //     pagination: '.copyright-paginate',
    //     paginate: {
    //         previous: 0,
    //         next: 40,
    //         take: 40,
    //         currentPage: 1
    //     },
    //     column: ['no', 'logo', 'companyName', 'receiptDate', 'by', 'typeOfData', 'receiveBy', 'file', 'action']
    // });










    // var pagination = {
    //     previous: 0,
    //     next: 40,
    //     take: 40,
    //     currentPage: 1,
    //     allPage: 0
    // };
    // var loadingOverlay = document.createElement('div');
    // loadingOverlay.setAttribute('class','content-overlay');
    // loadingOverlay.innerHTML = `<div class="cv-spinner"><span class="spinner"></span></div>`;

    // var copyRightContent = document.getElementById('cs-copyright-content');
    // const crContent = copyRightContent.querySelector('.card-body');
    // crContent.appendChild(loadingOverlay)

    // const numberFormat = (x) => x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // async function csGetCopyright(skip)
    // {
    //     try{
    //         crContent.appendChild(loadingOverlay);

    //         const request = {
    //             skip: skip,
    //             take: pagination.take
    //         };

    //         const get = await axios('api/my-job/cs/get/copyright',{params:request});
    //         fetchCopyright(get.data,skip);

    //         if(Object.keys(get).length>=6){
    //             setTimeout(()=>{
    //                 copyRightContent.querySelector('.content-overlay').remove();
    //                 crContent.scroll({top:0, behavior:'smooth'});
    //             },500);
    //         }

    //     } catch (err) {
    //         console.log(err)

    //     }

    // }
    // const fetchCopyright = (data,start) =>
    // {
    //     const table = document.getElementById('cs-copyright-content');
    //     const tbody = table.querySelector('tbody');
    //     const paginate = table.querySelector('.card-footer');

    //     skip = (start==0)?20:start;

    //     if(document.querySelector('.copyright-paginate')==null){
    //         pagination.allPage = data.page;
    //         let footerContent = document.createElement('div');
    //         footerContent.setAttribute('class','m-auto');

    //         let prevButton = document.createElement('button');
    //         prevButton.setAttribute('class','btn btn-primary btn-lg mr-2 prev-page');
    //         prevButton.setAttribute('skip',0);
    //         prevButton.setAttribute('disabled','');
    //         prevButton.innerHTML = `<i class="fas fa-backward"></i>`;


    //         let nextButton = document.createElement('button');
    //         nextButton.setAttribute('class','btn btn-primary btn-lg ml-2 next-page');
    //         nextButton.setAttribute('skip',20);
    //         nextButton.innerHTML = `<i class="fas fa-forward"></i>`

    //         let select = document.createElement('select');
    //         select.setAttribute('class','form-control m-auto text-center copyright-paginate');
    //         for(let i = 0; i<data.page; i++){
    //             let option = document.createElement('option');
    //             option.innerHTML = (i+1);
    //             option.setAttribute('value',(i*skip));
    //             select.appendChild(option);
    //         }
    //         footerContent.append(prevButton)
    //         footerContent.append(select)
    //         footerContent.append(nextButton)
    //         paginate.append(footerContent);
    //     }
    //    tbody.innerHTML = '';
    //     let i = 0;
    //     data.data.map((v,k) => {
    //         i = (start==0) ? numberFormat(k+1) : numberFormat(start+k+1) ;
    //         tr = document.createElement('tr');
    //         no = document.createElement('td'),
    //         img = document.createElement('td'),
    //             companyName = document.createElement('td'),
    //             receiptDate = document.createElement('td'),
    //             by = document.createElement('td'),
    //             typeOfData = document.createElement('td'),
    //             receipBy = document.createElement('td'),
    //             file = document.createElement('td'),
    //             action = document.createElement('td');
    //         // tr.innnerHtml = '';
    //         tr.setAttribute('class','align-middle');
    //         tr.setAttribute('company', v.companyId);
    //         tr.setAttribute('job', v.jobId);
    //         no.innerHTML = i;
    //         img.innerHTML = `<img class="file-thumbnail border" src="${v.logo}">`;
    //         companyName.innerHTML = `<p class="cp-name mb-0">${v.name_jp}</p><p class="cp-name mb-0">${v.name_th}</p><small class="text-primary font-weight-bold">${v.categoryName}</small>`;
    //         receiptDate.setAttribute('class','text-center');
    //         receiptDate.innerHTML = v.license;
    //         by.setAttribute('class','text-center');
    //         by.innerHTML = v.by;
    //         action.setAttribute('class','text-center')
    //         action.innerHTML = `<a class="badge badge-secondary" href="javascript:"><i class="fas fa-pen fa-fw"></i> Edit</a><a class="badge badge-warning d-none"><i class=fas fa-save fa-fw"></i> Save</a>`;
    //         tr.appendChild(no);
    //         tr.appendChild(img);
    //         tr.appendChild(companyName);
    //         tr.appendChild(receiptDate);
    //         tr.appendChild(by);
    //         tr.appendChild(typeOfData);
    //         tr.appendChild(receipBy);
    //         tr.appendChild(file);
    //         tr.appendChild(action);
    //         tbody.appendChild(tr);
    //     })
    // }

    // csGetCopyright(0,0);

    // var prevPage = copyRightContent.querySelector('.prev-page');
    // var nextPage = copyRightContent.querySelector('.next-page');
    // var paginate = copyRightContent.querySelector('.copyright-paginate');

    // document.addEventListener('change',function(ev){
    //     const pageSelect = ev.target.closest('.copyright-paginate');
    //     const prevPage = copyRightContent.querySelector('.prev-page');
    //     const nextPage = copyRightContent.querySelector('.next-page');
    //     const paginate = copyRightContent.querySelector('.copyright-paginate');
    //     if(pageSelect)
    //     {
    //         pagination.next = Number(pageSelect.value) + pagination.take;
    //         pagination.currentPage = Number(pageSelect.selectedIndex + 1);
    //         pagination.previous = pagination.currentPage == 1 ? 0 : pagination.next - pagination.take;
    //         if(pagination.currentPage==1) prevPage.setAttribute('disabled',''); else prevPage.removeAttribute('disabled');
    //         if(pagination.currentPage < pagination.allPage) nextPage.removeAttribute('disabled'); else nextPage.setAttribute('disabled','');
    //         prevPage.setAttribute('skip',pagination.previous);
    //         nextPage.setAttribute('skip',pagination.next);
    //         csGetCopyright(pagination.previous)
    //     }
    // })
    // document.addEventListener('click',function(ev){
    //     const prevButton = ev.target.closest('.prev-page');
    //     const nextButton = ev.target.closest('.next-page');
    //     const prevPage = copyRightContent.querySelector('.prev-page');
    //     const nextPage = copyRightContent.querySelector('.next-page');
    //     const paginate = copyRightContent.querySelector('.copyright-paginate');
    //     if(prevButton){
    //         pagination.previous = pagination.previous - pagination.take;
    //         pagination.next = pagination.next - pagination.take
    //         pagination.currentPage = pagination.currentPage - 1;
    //         if(pagination.previous==0) prevPage.setAttribute('disabled','');
    //         if(pagination.currentPage < pagination.allPage) nextPage?.removeAttribute('disabled');
    //         prevPage.setAttribute('skip',pagination.previous)
    //         nextPage.setAttribute('skip',pagination.next)
    //         // console.log(pagination)
    //         csGetCopyright(pagination.previous)
    //     }
    //     if(nextButton){
    //         pagination.previous = pagination.next;
    //         pagination.next = pagination.next + pagination.take
    //         pagination.currentPage = pagination.currentPage + 1;
    //         if(pagination.previous>0) prevPage.removeAttribute('disabled');
    //         if(pagination.currentPage == pagination.allPage) nextPage.setAttribute('disabled','');
    //         prevPage.setAttribute('skip',pagination.previous)
    //         nextPage.setAttribute('skip',pagination.next)
    //         // console.log(pagination)
    //         csGetCopyright(pagination.previous)
    //     }
    //     for (var i = 0; i < paginate.length; i++){
    //         if (Number(paginate[i].text) == pagination.currentPage) paginate[i].selected = true;
    //     }
    // })
    // copyRightContent.on('change','.copyright-paginate',function(){
    //     console.log($(this).val())
    //     const skip = $(this).val();
    //     csGetCopyright(Number(skip))
    // })

    const reportDaily = () => {
        let data = $.ajax({
            method: 'get',
            async: false,
            url: 'webpanel/my-job/cs/report'
        }).responseJSON;
        return data;
    }
    const fetchReportDaily = () => {
        let data = reportDaily();
        if (data.length > 0) {
            const Table = $('#reportDaily');
            // Table.find('tbody').html('');
            let tr = $('<tr></tr>');
            data.map(function(v, k) {
                // console.log(data[k-1].date);
                // console.log(data[k].date);
                tr.html('');
                tr.append('<td class="text-center">' + v?.date + '</td>');
                tr.append('<td class="text-center">' + v?.new + '</td>');
                tr.append('<td class="text-center">' + v?.follow + '</td>');
                tr.append('<td class="text-center">' + v?.total_call + '</td>');
                tr.append('<td class="text-center">' + v?.refuse + '</td>');
                tr.append('<td class="text-center">' + v?.call_again + '</td>');
                tr.append('<td class="text-center">' + v?.cannot + '</td>');
                tr.append('<td class="text-center">' + v?.cr + '</td>');
                tr.append('<td class="text-center">' + v?.sum + '</td>');
                tr.append('<td class="text-center">' + v?.cr_today + '</td>');
                tr.append('<td class="text-center">' + v?.cr_return + '</td>');
                tr.append('<td class="text-center">' + v?.contact_sales + '</td>');
                tr.append('<td class="text-center">' + v?.filter + '</td>');
                if (Table.find('tr[data-date="' + v?.date + '"]').length < 1) {
                    tr.insertAfter(Table.find('[date-date="' + data[k - 1]?.date + '"]'));
                }

            })
        }

    }
    const alert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
                <strong>Opps!</strong><span class="text ml-1"> An error has occurred.</span>\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                    <span aria-hidden="true">&times;</span>\
                </button>\
            </div>')
    $(document).on('change', '.cs-all-export', function() {
        let curr = $(this);
        let checked = curr.is(':checked') ? true : false;
        $('.job-export').prop('checked', checked);
    })
    let totalCall = 0;
    $(document).on('click', '.cs-new-report', function() {
        const modal = $('#csAddEdit');
        modal.modal('show');
        modal.find('input[name="new"]').on('keyup keydown change', function() {
            totalCallCal();
        });
        modal.find('input[name="follow"]').on('keyup keydown change', function() {
            totalCallCal();
        });
        modal.find('input[name="refuse"]').on('keyup keydown change', function() {
            responseCal();
        });
        modal.find('input[name="call_again"]').on('keyup keydown change', function() {
            responseCal();
        });
        modal.find('input[name="cannot"]').on('keyup keydown change', function() {
            responseCal();
        });
        modal.find('input[name="cr"]').on('keyup keydown change', function() {
            responseCal();
        });
        modal.find('.report-save').on('click', function() {
            const Date = modal.find('input[name="date"]').val();
            const New = modal.find('input[name="new"]').val();
            const Follow = modal.find('input[name="follow"]').val();
            const Total_call = modal.find('input[name="total_call"]').val();
            const Refuse = modal.find('input[name="refuse"]').val();
            const Call_again = modal.find('input[name="call_again"]').val();
            const Cannot = modal.find('input[name="cannot"]').val();
            const Cr = modal.find('input[name="cr"]').val();
            const Sum = modal.find('input[name="sum"]').val();
            const Cr_today = modal.find('input[name="cr_today"]').val();
            const Cr_return = modal.find('input[name="cr_return"]').val();
            const Contact_sales = modal.find('input[name="contact_sales"]').val();
            const Filter = modal.find('input[name="filter"]').val();
            let res = newReportDaily(Date, New, Follow, Total_call, Refuse, Call_again, Cannot, Cr, Sum,
                Cr_today, Cr_return, Contact_sales, Filter)
            if (res.statusCode == 201) {
                alert.removeClass('alert-danger').addClass('alert-success');
                alert.find('strong').html(res.title);
                alert.find('.text').html(res.text);
                modal.find('.modal-body').append(alert);
                fetchReportDaily()
                setTimeout(() => {
                    modal.modal('hide');
                    modal.find('.alert').remove();
                }, 3000);
            } else {
                alert.removeClass('alert-success').addClass('alert-danger');
                alert.find('strong').html(res.title);
                alert.find('.text').html(res.text);
                modal.find('.alert').remove();
                modal.find('.modal-body').append(alert);
            }
        });
        modal.find('button[data-dismiss="modal"]').on('click', function() {
            modal.find('input[name="new"]').val('');
            modal.find('input[name="follow"]').val('');
            modal.find('input[name="total_call"]').val('');
            modal.find('input[name="refuse"]').val('');
            modal.find('input[name="call_again"]').val('');
            modal.find('input[name="cannot"]').val('');
            modal.find('input[name="cr"]').val('');
            modal.find('input[name="sum"]').val('');
            modal.find('input[name="cr_today"]').val('');
            modal.find('input[name="cr_return"]').val('');
            modal.find('input[name="contact_sales"]').val('');
            modal.find('input[name="filter"]').val('');
        });

    })
    const newReportDaily = (Date, New, Follow, Total_call, Refuse, Call_again, Cannot, Cr, Sum, Cr_today, Cr_return,
        Contact_sales, Filter) => {
        let fd = {
            '_token': "{{ csrf_token() }}",
            'date': Date,
            'new': New,
            'follow': Follow,
            'total_call': Total_call,
            'refuse': Refuse,
            'call_again': Call_again,
            'cannot': Cannot,
            'cr': Cr,
            'sum': Sum,
            'cr_today': Cr_today,
            'cr_return': Cr_return,
            'contact_sales': Contact_sales,
            'filter': Filter
        };
        let res = $.ajax({
            method: 'PUT',
            url: 'webpanel/my-job/cs/new/report',
            async: false,
            dataType: "json",
            data: fd,
            error: function(err) {
                console.log(err.responseText);
            }
        }).responseJSON;

        return res;
    }
    const totalCallCal = () => {
        el = $('input[name="total_call"]');
        New = Number($('input[name="new"]').val());
        Follow = Number($('input[name="follow"]').val());
        totalCall = (New + Follow);
        el.val(totalCall);
    }
    const responseCal = () => {
        el = $('input[name="sum"]');
        Refuse = Number($('input[name="refuse"]').val());
        CallAgain = Number($('input[name="call_again"]').val());
        Cannot = Number($('input[name="cannot"]').val());
        Cr = Number($('input[name="cr"]').val());
        Sum = (Refuse + CallAgain + Cannot + Cr);
        el.val(Sum);
    }

    $(document).on('change','.checkbox',function() {
        var group = $(this).closest('.checkbox-group');
        group.find('.checkbox').not(this).prop('disabled', this.checked);
    });

</script>

