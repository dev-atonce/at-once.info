<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="css/validate.css" />
<style>
    :root{
        --red-900: #861515;
        --red-800: #b52929;
        --red-700: #c53232;
        --red-600: #d14444;
        --red-500: #e36060;
        --red-400: #fb7474;
        --red-300: #fe8989;
        --red-200: #f89e9e;
        --red-100: #f9bebe;

        --blue-900: #414fa8;
        --blue-800: #414fa8;
        --blue-700: #414fa8;
        --blue-600: #414fa8;
        --blue-500: #5869d9;
        --blue-400: #7582d9;
        --blue-300: #96a2ec;
        --blue-200: #a6b7fe;
        --blue-200: #cad4fe;

        --green-900: #10713a;
        --green-800: #1e8b4d;
        --green-700: #279757;
        --green-600: #2fa361;
        --green-500: #4fc582;
        --green-300: #6ce29f;
        --green-200: #8df9bc;
        --green-100: #b6ffd6;

        --yellow-900: #847b01;
        --yellow-800: #b1a502;
        --yellow-700: #d1c302;
        --yellow-600: #ebdc03;
        --yellow-500: #ffee00;
        --yellow-400: #faec28;
        --yellow-300: #fcf56d;
        --yellow-200: #fef574;
        --yellow-100: #fefabd;

        --grey-900: #1d1d1d;
        --grey-800: #333333;
        --grey-700: #434343;
        --grey-600: #656565;
        --grey-500: #777777;
        --grey-400: #a3a2a2;
        --grey-300: #c4c4c4;
        --grey-200: #e5e5e5;
        --grey-100: #ebedef;
        --grey-50: #f7f7f7;

        --white: #ffffff;
    }
    .-btn{
        outline: none;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-align: center;
        align-items: center;
        font-weight: 400;
        color: #4f5d73;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 10px;
        padding: 0.375rem 0.75rem;
        font-size: .875rem;
        line-height: 1.5;
        transition: color .15s ease-in-out, 
            background-color .15s ease-in-out, 
            border-color .15s ease-in-out, 
            box-shadow .15s ease-in-out;

    }
    a.-btn:hover,
    .-btn:hover,
    .-btn-transparent{
        text-decoration: none;
    }
    .-btn-sm, 
    .-btn-group-sm > .-btn {
        padding: 0.25rem 0.5rem;
        font-size: .765625rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }



    .-btn-primary{
        background-color: var(--blue-500) !important;
        color: var(--white) !important;
    }
    .-btn-primary:hover {
        background-color: var(--blue-600) !important;
    }
    .-btn-primary:focus {
        outline: none;
    }
    .-btn-primary:not(:disabled):not(.disabled):active, 
    .-btn-primary:not(:disabled):not(.disabled).active{
        color: var(--blue-800);
        background-color: var(--blue-200);
        border-color: var(--blue-200);
    }


    .-btn-secondary{
        background-color: var(--grey-200) !important;
        color: var(--grey-900) !important;
    }
    .-btn-secondary:hover {
        background-color: var(--grey-300) !important;
        border-color: var(--grey-300) !important;
    }
    .-btn-secondary:focus {
        outline: none;
    }
    .-btn-secondary:not(:disabled):not(.disabled):active, 
    .-btn-secondary:not(:disabled):not(.disabled).active{
        color: var(--grey-800);
        background-color: var(--grey-200);
        border-color: var(--grey-200);
    }


    .-btn-danger{
        background-color: var(--red-500) !important;
        color: var(--white) !important;
    }
    .-btn-danger:hover {
        background-color: var(--red-600) !important;
    }
    .-btn-danger:focus {
        outline: none;
    }
    .-btn-danger:not(:disabled):not(.disabled):active, 
    .-btn-danger:not(:disabled):not(.disabled).active{
        color: var(--red-800);
        background-color: var(--red-200);
        border-color: var(--red-200);
    }



    .-btn-transparent{
        background-color: transparent !important;
    }
    .-btn-transparent:hover{
        background-color: var(--grey-200) !important;
        color: var(--grey-900) !important;
    }


    .-btn-darklight{
        background-color: var(--grey-300) !important;
        color: var(--grey-900) !important;
    }
    .-btn-darklight:hover {
        background-color: var(--grey-400) !important;
        border-color: var(--grey-300) !important;
    }
    .-btn-darklight:focus {
        outline: none;
    }

    .bg-darklight{
        background-color: var(--grey-300);
        color: var(--grey-500) !important;
    }
    .btn.bg-darklight:hover{
        background-color: var(--grey-400);
        color: var(--grey-800) !important;
    }



    .to-do-box {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        /* pointer-events: none; */
    }
    .box-card{
        border: 1px solid var(--grey-200);
        background-color: var(--white);
        border-radius: 15px;
        padding: 10px;
    }
    .box-header{
        display: flex;
        justify-content: space-between;
    }
    .box-header h6{
        padding: 5px 5px 0 5px;
    }
    .box {
        /* cursor: move; */
        cursor: pointer;
        margin-bottom: 5px;
        display: flex;
        flex-direction: column;
        scroll-margin: 80px;
        border-radius: 15px;
    }
    .box:focus-within{
        opacity: 1;
        outline-color: -webkit-focus-ring-color;
        outline-style: solid;
        outline-width: 2px;
    }
    .box-inner{
        border: 2px solid var(--grey-100);
        background-color: var(--grey-100);
        border-radius: 15px;
        padding: 10px;
        
    }
    .box:hover .box-inner{
        border: 2px solid var(--blue-400);
    }
    .to-do-list{
        height: 100%;
    }
    a.add-box{
        display: block;
        text-align: center;
        border-radius: 15px; 
        text-decoration: none;
        padding: 5px;
    }
    a.add-box:hover{
        background-color: rgb(220, 227, 255);
    }

    /* .box.over {
        border: 3px dotted #666;
    } */
    [draggable] {
        -webkit-user-drag: element;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -o-user-select: none;
        user-select: none;
    }
    .box.drag-sort-active {
        /* opacity: 0.1; */
        -webkit-user-select: all !important;
        -khtml-user-select: all !important;
        -moz-user-select: all !important;
        -o-user-select: all !important;
        user-select: all !important;
        -webkit-transition: none !important;
        -moz-transition: none !important;
        -o-transition: none !important;
        transition: none !important;
        border-radius: 15px !important;
        pointer-events: all !important;
        overflow: hidden !important;
        opacity: 0.5;
        user-select:none;
        -moz-user-select:none;
        -webkit-user-select:none;
        -ms-user-select:none;
    }
    .box.drag-sort-active .box-inner{
        background-color: rgba(221 221 221) !important;
        border: 2px solid var(--grey-500) !important;
        
    }
    .btn-circle {
        overflow: hidden;
        border-radius: 50%;
    }
    button.btn-circle:active {
        border: none;
        outline: none;
    }
    .fas.square{
        width: 22px;
        height: 22px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .box-header{
        margin-bottom: 10px;
    }
    .box-footer{
        margin-top: 10px;
    }
    .box-user{
        position: relative;
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 4px;
    }
    .list-title{
        margin-bottom: 0;
    }
    span.user,
    a.user{
        height: 24px;
        width: 24px;
        color: #fff;
        font-size: 11px;
        font-weight: 400;
        border-radius: 50%;
        overflow: hidden;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    a.user:hover{
        text-decoration: none;
    }
    .btn-link{ border-radius: 15px; }
    .btn-link:hover{
        background-color: var(--blue-200);
        border-radius: 15px;
        text-decoration: none;
    }
    .bg515fb9{ background-color: var(--blue-600); }
    .bg66b951{ background-color: #66b951; }
    .fs-12{ font-size: 12px; }
    .modal .head{ display: flex; align-items: center; }
    .modal .head h5{  margin: 0; }
    .modal a.description-edit,
    .modal .write-comment{
        background-color: var(--grey-100, #091e420f);
        box-shadow: none;
        border: none;
        font-weight: 500;
        color: var(--ds-text, #172b4d);
        display: block;
        min-height: 40px;
        padding: 8px 12px;
        text-decoration: none;
    }
    .mini-editor{ display: none; }
    .mini-editor.edit{ display: block; }
    .modal .detail-user,
    .modal .card-detail-data{ display: flex; }
    .detail-user{  gap: 3px; }
    .detail-user .user{
        width: 30px;
        height: 30px;
        font-size: 14px;
    }
    .card-detail-item{ margin: 0 15px 10px 0; }
    .ml-16{ margin-left: 16px; }
    .ml-33{ margin-left: 33px; }
    .checklist-title{
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    .window-module-title-options {
        margin: 0 2px 0 auto;
        float: right;
    }
    .checklist-add-controls-spacer { flex: 1; }
    .editing .checklist-add-controls { display: flex; flex-direction: row; }
    .checklist-item,
    .checklist-item-checkbox{ display: flex;  align-items: center; }
    .checklist-item .check-item-options-menu{ display: none; }
    .checklist-item.editing .check-item-options-menu{ display: block; }
    .row-comment,
    .new-comment,
    .comment-actions{
        display: flex;
    }
    .action-comment{
        background-color: var(--grey-100);
        border-radius: 8px;
    }
    .action-comment .current-comment {
        padding: 8px 12px;
    }
    .quiet a{
        text-decoration: underline;
        font-size: 12px;
    }
    .checklist-percentage{
        display: flex;
        align-items: center;
        margin: 10px 0 10px 0;
    }
    .checklist-percentage .left{
        width: 33px;
        display: flex;
    }
    .checklist-percentage .right{
        width: 100%;
    }
    .checklist-item-checkbox .fa-square{
        cursor: pointer;
    }
    .checklist-item-details{
        display: flex;
        justify-content: space-between;
        padding: 5px;
        border-radius: 15px;
    }
    .checklist-item-details button{
        visibility: hidden;
    }
    .checklist-item-details:hover button{
        visibility: visible;
    }
    .checklist-item-details:hover{
        
        background-color: var(--grey-100)
    }
    .checklist-item-controls{
        display: flex;
    }
    .-btn-circle{
        width: 25px;
        height: 25px;
        border-radius: 50%;
        justify-content: center;
    }
    .checklist-item-checkbox {
        background-color: var(--white);
        border-radius: 2px;
        /* border: 2px solid var(--grey-300); */
        box-shadow: inset 0 0 0 2px var(--grey-300,#091e4224);
        cursor: pointer;
        flex-shrink: 0;
        width: 16px;
        height: 16px;
        overflow: hidden;
        position: relative;
        text-align: center;
        white-space: nowrap;
        transition: all .2s ease-in-out;
    }
    .checklist-item-checkbox:hover{
        box-shadow: inset 0 0 0 2px var(--blue-300);
    }
    .checklist-item-checkbox.checked  .checklist-item-checkbox-check
    {
        content: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23fff' viewBox='-3 -4 16 16'%3E%3Cpath d='M1.49 3.215a.667.667 0 0 0-.98.903l2.408 2.613c.358.351.892.351 1.223.02l.243-.239a1689.645 1689.645 0 0 0 2.625-2.589l.027-.026a328.23 328.23 0 0 0 2.439-2.429.667.667 0 1 0-.95-.936c-.469.476-1.314 1.316-2.426 2.417l-.027.026a1368.126 1368.126 0 0 1-2.517 2.482L1.49 3.215Z'/%3E%3C/svg%3E");
        height: 16px;
        opacity: 1;
        width: 16px;
        background-color: var(--blue-500);
    }
    .progress-bar[aria-valuenow="100"]{
        background-color: var(--green-500) !important;
    }
    .actions{
        /* onclick add to style attribute */
        /* 
        position: fixed;
        width: 304px;
        will-change: top, left;
        top: 525px;
        left: 1104px; 
        */
        color: var(--ds-text, #172b4d);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Noto Sans', 'Ubuntu', 'Droid Sans', 'Helvetica Neue', sans-serif;
        font-size: 14px;
        line-height: 20px;
        font-weight: 400;
        font-display: swap;
        background-color: var(--ds-surface-overlay, #ffffff);
        border-radius: 8px;
        box-shadow: var(--ds-shadow-overlay, 0px 8px 12px #091e4226, 0px 0px 1px #091e424f);
        box-sizing: border-box;
        outline: 0;
        overflow: hidden;
    }
    .actions .actions-header{
        padding: 4px 8px;
        position: relative;
        text-align: center;
        display: grid;
        align-items: center;
        grid-template-columns: 32px 1fr 32px;
        
    }
    .actions-header{
        position: relative;
    }
    .actions-header h6{
        color: var(--grey-600, #44546f);
        font-size: 14px;
        font-weight: 600;
        letter-spacing: -0.003em;
        line-height: 40px;
        display: block;
        position: relative;
        height: 40px;
        margin: 0;
        overflow: hidden;
        padding: 0 32px;
        text-overflow: ellipsis;
        white-space: nowrap;
        grid-column: 1 / span 3;
        grid-row: 1;
        text-align: center;
    }
    .actions-header .action-close{
        text-decoration: none;
        border-radius: 10px;
        grid-column: 3;
        grid-row: 1;
        color: var(--grey-400, #626f86);
        border-radius: 8px;
        display: flex;
        width: 32px;
        height: 32px;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }
    button.action-item{
        text-align: left;
        width: 100%;
        cursor: pointer;
        display: block;
        font-weight: normal;
        padding: 6px 12px;
        position: relative;
        background-color: unset;
        margin: unset;
        border: none !important;
    }
    .checklist-item-details .checklist-item-row {
        display: flex;
        flex-direction: row;
    }
    .editing .edit {
        display: block;
        float: left;
        padding-bottom: 8px;
        width: 100%;
        z-index: 50;
    }
    .editing .checklist-item-details, 
    .checklist-item-details:hover {
        background-color: var(--grey-200,#091e420f)!important;
    }
    .checklist-item-details {
        word-wrap: break-word;
        overflow-wrap: break-word;
        padding: 8px;
        word-break: break-word;
    }
    .editing .edit {
        display: block;
        float: left;
        padding-bottom: 8px;
        width: 100%;
        z-index: 50;
    }
    .editable{

    }
    .editing .edit {
        display: block;
        float: left;
        padding-bottom: 8px;
        width: 100%;
        z-index: 50;
    }
    .edit {
        /* display: none; */
        position: relative;
    }
    .editing .hide-on-edit {
        display: none!important;
    }
    .edit .check-item-options-menu{
        padding: 5px
    }
    .edit-controls {
        clear: both;
        display: flex;
        flex-direction: row;
        margin-top: 8px;
    }
    .u-clearfix:after {
        clear: both;
        content: "";
        display: table;
    }
    .edit-controls-spacer{
        flex: 1;
    }
    .checklist-item-text-and-controls{
        width: 100%;
        cursor: text;
    }
    .sk-editor-mini{
        background-color: #fff;
        box-shadow: 0 0 0 1px inset var(--grey-300, #091e4224);
        border: none;
        border-radius: 5px;
        padding: 2px;
    }
    .description-edit{
        display: none;
    }
    .description-edit.edit{
        display: block;
    }
    .sk-editor-mini .sk-editor-main-toolbar{
        padding: 5px;
        box-shadow: 0 2px 0 0 var(--grey-300, #EBECF0);
    }
    .sk-editor-mini .toolbar{
        display: flex;
        align-items: center;
    }
    .-focus{
        box-shadow: 0 0 0 2px var(--blue-400);
    }
    .css-g4dhky
    {
        background: var(--ds-border, #EBECF0);
        width: 1px;
        height: 24px;
        display: inline-block;
        margin: 0 5px;
        user-select: none;
    }
    .sk-editor-content-area{
        -webkit-box-flex: 1;
        flex-grow: 1;
        overflow-x: hidden;
        line-height: 24px;
        padding: 20px;
    }
    .ProseMirror {
        outline: none;
        font-size: 14px;
        overflow-wrap: break-word;
        white-space: pre-wrap;
    }
    .markeddown{
        cursor: pointer;
    }
    .pop-over-member-list{
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .js-select-member{
        display:flex;
    }
    .pop-over-member-list li a {
        border-radius: 3px;
        color: black;
        display: flex;
        align-items: center;
        height: 32px;
        line-height: 32px;
        margin-bottom: 2px;
        overflow: hidden;
        padding: 4px;
        position: relative;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .pop-over-member-list li a:hover {
        background-color: var(--grey-200);
    }

    .loader {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin: 0 4px;
        position: relative;
        animation: rotate 1s linear infinite
      }
      .loader::before , .loader::after {
        content: "";
        box-sizing: border-box;
        position: absolute;
        inset: 0px;
        border-radius: 50%;
        border: 3px solid #FFF;
        animation: prixClipFix 2s linear infinite ;
      }
      .loader::after{
        border-color: #FF3D00;
        animation: prixClipFix 2s linear infinite , rotate 0.5s linear infinite reverse;
        inset: 3px;
      }

      @keyframes rotate {
        0%   {transform: rotate(0deg)}
        100%   {transform: rotate(360deg)}
      }

      @keyframes prixClipFix {
          0%   {clip-path:polygon(50% 50%,0 0,0 0,0 0,0 0,0 0)}
          25%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 0,100% 0,100% 0)}
          50%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,100% 100%,100% 100%)}
          75%  {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 100%)}
          100% {clip-path:polygon(50% 50%,0 0,100% 0,100% 100%,0 100%,0 0)}
      }
</style>
<div class="fade-in">
    {{-- <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 position-relative">
                    <form action="">
                        <div class="d-flex justify-content-center">
                            <div class="form-inline">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button 
                                        type="button" 
                                        val="profile-create" 
                                        text="Company profile page" 
                                        class="source btn {{Request::get('type')=='Company profile page'||!Request::get('type')?'btn-primary':'btn-outline-primary'}}">Company Profile Page
                                    </button>
                                    <button 
                                        type="button" 
                                        val="cpProfile+blogCt+formCat" 
                                        text="User to company" 
                                        class="source btn {{Request::get('type')=='User to company'?'btn-primary':'btn-outline-primary'}}">User To CP.
                                    </button>
                                    <button 
                                        type="button" 
                                        val="blogMk+1ceProfile+package+contact+basicCp" 
                                        text="Company or users to us" 
                                        class="source btn {{Request::get('type')=='Company or users to us'?'btn-primary':'btn-outline-primary'}}">CP. or users to us
                                    </button>
                                    <button 
                                        type="button" 
                                        val="ma" 
                                        text="MA of customer" 
                                        class="source btn {{Request::get('type')=='MA of customer'?'btn-primary':'btn-outline-primary'}}">Ma of customers
                                    </button>
                                </div>
                                <input type="hidden" name="source" value="{{Request::get('source')?Request::get('source'):'profile-create'}}">
                                <input type="hidden" name="type" value="{{Request::get('type')?Request::get('type'):'Company profile page'}}">
                            </div><br/>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <div class="form-inline">
                                <input type="text" 
                                    class="form-control mx-2"
                                    placeholder="Date range"
                                    aria-label="Date" 
                                    name="date"
                                    id="date" 
                                    autocomplete="off" 
                                    value="{{Request::get('date')?Request::get('date'):date('Y-m-01').' - '.date('Y-m-t')}}"
                                />
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search mr-1"></i> Search</button>
                                    <button type="reset" class="btn btn-secondary reset-date"><i class="fas fa-sync-alt mr-1"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="position-absolute" style="top:0; right:15px;">
                        <a href="webpanel/export/email-database" target="_blank" class="btn btn-dark btn-sm position-absolute" style="right: 0;"><i class="fas fa-file-export mr-1"></i>Export</a>
                    </div>
                </div>            
            </div>
        </div>              
    </div> --}}
    <div class="to-do-box">
        <div class="to-do-list">
            <div class="box-card">
                <div class="box-header d-flex justify-between">
                    <h6>To Do List</h6>
                    <button class="btn btn-link"><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <ol class="box-list list-default p-0">
                    {{-- <li class="box" data-id="1">
                        <div class="box-inner">
                            <p class="list-title">Store IP address MA Blog</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="2">
                        <div class="box-inner">
                            <p class="list-title">Add Marketing Blog to Main page</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="3">
                        <div class="box-inner">
                            <p class="list-title">Revise Search Page</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="4">
                        <div class="box-inner">
                            <p class="list-title">Fix Basic Company Profile Form</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="5">
                        <div class="box-inner">
                            <p class="list-title">Notification Blog selfedit</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="6">
                        <div class="box-inner">
                            <p class="list-title">Change Color Company Profile List</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="7">
                        <div class="box-inner">
                            <p class="list-title">Company list page cover photo</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="8">
                        <div class="box-inner">
                            <p class="list-title">Our customer send mail only 1</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li>
                    <li class="box" data-id="9">
                        <div class="box-inner">
                            <p class="list-title">Company profile form mail fix in page</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>
                                <span class="user bg515fb9">H</span>
                                <span class="user bg66b951">B</span>
                            </div>
                        </div>
                    </li> --}}
                </ol>
                <div class="box-footer">
                   <a class="add-box" href="javascript:"> <i class="fas fa-plus"></i> Add a card</a>
                </div>
            </div>
        </div>
        <div class="to-do-list">
            <div class="box-card">
                <div class="box-header"><h6>Do</h6></div>
                <div class="box-list"></div>
            </div>
        </div>
        <div class="to-do-list">
            <div class="box-card">
                <div class="box-header"><h6>Test</h6></div>
                <div class="box-list"></div>
            </div>
        </div>
        <div class="to-do-list">
            <div class="box-card">
                <div class="box-header"><h6>Done</h6></div>
                <div class="box-list"></div>
            </div>
        </div>
    </div>
  
</div>   
<div class="pop-over"></div>
<div class="actions" style="display:none;"></div>
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <i class="fas fa-window-maximize fa-lg mr-3"></i>
                <h4 class="modal-title font-weight-bold" id="exampleModalLabel">Modal title</h4>
                <button class="close btn-circle" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times square"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card-detail-data ml-33">
                                    <div class="card-detail-item">
                                        <span class="font-weight-bold">Members</span>
                                        <div class="detail-user">
                                            <a href="javascript:" class="user bg-light add-user"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-detail-item">
                                        <span class="font-weight-bold">Due date</span>
                                        <div class="card-detail-badge-due-date">
                                            <button class="btn btn-outline-dark btn-sm"><span>1 Nov 2023</span> <span class="badge badge-success ml-2">Complete</span><i class="fas fa-chevron-down ml-2 my-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 row-description">
                            <div class="col-lg-12 mb-3">
                                <div class="head">
                                    <i class="fas fa-align-justify fa-lg mr-3"></i>
                                    <h5>Description</h5>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="current markeddown ml-33 d-none"></div>
                                <p>
                                    <a href="javascript:" class="description-edit ml-33" onclick="descriptionEdit(this)" style="color: var(--grey-500)">Add a more detailed description...</a>
                                </p>

                                <div class="description-edit ml-33">
                                    <div class="sk-editor-mini">
                                        <div class="sk-editor-main-toolbar">
                                            <div class="toolbar">
                                                <button 
                                                    class="toolbar-item bold -btn -btn-transparent" 
                                                    exec-command="bold" 
                                                    title="Bold"
                                                >
                                                    <i class="fas fa-bold"></i>
                                                </button>
                                                <button 
                                                    class="toolbar-item italic -btn -btn-transparent" 
                                                    exec-command="italic" 
                                                    title="Italic"
                                                >
                                                    <i class="fas fa-italic"></i>
                                                </button>
                                                <button 
                                                    class="toolbar-item strikethrougth -btn -btn-transparent" 
                                                    exec-command="strikethrough" 
                                                    title="Strikethrough"
                                                >
                                                    <i class="fas fa-strikethrough"></i>
                                                </button>
                                                <span class="css-g4dhky"></span>
                                                <button
                                                    class="toolbar-item list-ul -btn -btn-transparent" 
                                                    exec-command="insertUnorderedList" 
                                                    title="Bullet list"
                                                >
                                                    <i class="fas fa-list-ul"></i>
                                                </button>
                                                <button 
                                                    class="toolbar-item dropdown list-ol -btn -btn-transparent" 
                                                    exec-command="insertOrderedList" 
                                                    title="Numbered list"
                                                >
                                                    <i class="fas fa-list-ol"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="sk-editor-content-area">
                                            <div class="ProseMirror" contenteditable="true"></div>
                                        </div>
                                    </div>
                                    <div class="sk-editor-action-button d-flex mt-2">
                                        <a href="javascript:" class="-btn -btn-primary -save" onclick="descriptionSave(this)"><span>Save</span></a>
                                        <a href="javascript:" class="-btn -btn-transparent -save" onclick="descriptionCancel(this)"><span>Cancel</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 row-activity">
                            <div class="col-lg-12 mb-3">
                                <div class="head">
                                    <i class="fas fa-tasks fa-lg mr-3"></i>
                                    <h5>Activity</h5>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="new-comment mb-2">
                                    <div class="current-user">
                                        <a href="javascript:" class="user bg515fb9" style="margin-left: -5px;">H</a>
                                    </div>
                                    <div class="checklist-new-comment w-100">
                                        <a href="javascript:" class="write-comment" style="margin-left: 8px; color: var(--grey-500)">Write a comment...</a>
                                    </div>
                                </div>
                                <div class="comment-list"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <h6 class="mb-2 font-weight-bold">Add to card</h6>
                        <button class="btn btn-secondary btn-block" onclick="AddToCard('member')">Member</button>
                        <button class="btn btn-secondary btn-block" onclick="AddToCard('checklist')">Checklist</button>
                        <button class="btn btn-secondary btn-block" onclick="AddToCard('dates')">Dates</button>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    const queryString = window.location.search;
    const exportBtn = $('.fa-file-export').parent();
    exportBtn.attr('href',exportBtn.attr('href')+queryString);
    $('#date').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'YYYY/MM/DD'
        },
        cancelButtonClasses: 'btn-danger',
    });
    $('#date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });
    $('.reset-date').on('click', function() {
        $(this).closest('.input-group').find('input').val('');
    });
    
    var row = [];
    var displayName = '{{Auth::user()->name}}';
    var shortName = displayName.charAt(0);
    var memberId = '{{Auth::user()->id}}';
    var comemnts = document.querySelector('.row-activity');
    // var miniEditor = document.createElement('div');
    // miniEditor.setAttribute('')
    
    var UsersList;
    getMember().then(res =>{ UsersList = res; });

    var userAction = document.createElement('div');
    userAction.setAttribute('class','');

    const Checklist = (e) =>
    {
        // console.log(e)
        const checklist = document.createElement('div');
        checklist.setAttribute(`class`,`row mb-3 checklist-${e.id}`);
        checklist.innerHTML = `<div class="col-lg-12 mb-2">
            <div class="head">
                <i class="far fa-calendar-check fa-lg mr-3"></i>
                <div class="checklist-title">
                    <h5>Title</h5>
                    <div class="window-module-title-options">
                        <a href="javascript:" class="btn btn-light btn-sm" action="checklist-delete" data-delete="checklist-${e.id}" data-id="${e.id}">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 row-checklist">
            <input type="hidden" name="checklistId" value="${e.id}" />
            <div class="checklist-percentage">
                <div class="left"><small><span class="percentage">0</span>%</small></div>
                <div class="right">
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="checklist-items"></div>
            <div class="checklist-add ml-33 my-2 editing">
                <button class="-btn -btn-secondary description-edit new-checklist-item mt-2 d-block">Add an item</button>
                <textarea class="checklist-new-item-text form-control my-2 d-none" placeholder="Add an item"></textarea>
                <div class="checklist-add-controls d-none">
                    <button class="add-checklist-item -btn -btn-primary mr-1" checklist-id="${e.id}">Add</button>
                    <a class="-btn -btn-transparent btn-sm cancel cancel-checklist-item" href="javascript:">Cancel</a>
                    <div class="checklist-add-controls-spacer"></div>
                    <a class="-btn -btn-transparent checklist-add-controls-option options-menu" href="javascript:">
                        <i class="fas fa-user-plus mr-1"></i>Assign
                    </a>
                    <a class="-btn -btn-transparent checklist-add-controls-option options-menu checklist-add-controls-due" href="javascript:">
                        <i class="far fa-clock mr-1"></i>Due date
                    </a>
                </div>
            </div>
        </div>
        `;
        return checklist;
    }
    const ChecklistItem = (e) => { 
        let checked = e.do == 1 ? 'checked' : '';
        item = document.createElement('div');
        item.setAttribute('class','checklist-item');
        item.setAttribute('checklist-item-id',e.id);
        item.innerHTML = `
            <div class="checklist-item-checkbox enabled js-toggle-checklist-item ${checked}" data-testid="checklist-item-checkbox">
                <span class="checklist-item-checkbox-check"></span>
            </div>
            <div class="checklist-item-details editable ml-16 w-100">
                <div class="checklist-item-row w-100 hide-on-edit">
                    <div class="checklist-item-text-and-controls">
                        <span class="checklist-item-details-text markeddown js-checkitem-name">${e.title}</span>
                    </div>
                    <div class="checklist-add-controls-spacer"></div>
                    <div class="checklist-item-controls">
                        <button class="-btn -btn-darklight -btn-circle mr-1"><i class="far fa-clock fa-sm m-auto"></i></button>
                        <button class="-btn -btn-darklight -btn-circle mr-1"><i class="fas fa-user-plus fa-sm m-auto"></i></button>
                        <button class="-btn -btn-darklight -btn-circle checklist-actions" data-attr="checklist-item-id" data-id="${e.id}" data-url="api/to-do-list/checklist/item/${e.id}"><i class="fas fa-ellipsis-h fa-sm m-auto"></i></button>
                    </div>
                </div>
                <div class="edit check-item-options-menu">
                    <textarea class="form-control" type="text" data-autosize="true" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"></textarea>
                    <div class="edit-controls u-clearfix">
                        <input class="-btn -btn-primary -save confirm save-edit-item mr-1" type="submit" value="Save" data-id="${e.id}">
                        <a class="-btn -btn-secondary btn-sm cancel cancel-edit-item" href="javascript:">Cancel</a>
                        <div class="edit-controls-spacer"></div>
                        <a class="-btn -btn-secondary mr-1 option check-item-options-menu js-assign" href="javascript:" data-id="${e.id}">
                            <i class="fas fa-user-plus mr-1"></i>Assign
                        </a>
                        <a class="-btn -btn-secondary option check-item-options-menu js-due checklist-add-controls-due" href="#" data-id="${e.id}">
                            <i class="far fa-clock mr-1"></i>Due date
                        </a>
                    </div>
                </div>
            </div>
        `;
        return item;
    }

    function MemberBadge(e)
    {
        modal = document.querySelector('#exampleModal');
        todoId = modal.querySelector('input[name="id"]').value;
        getMemberInTodolist(todoId).then(res => {
            destination = modal.querySelector(`${e.destination}`);
            modal.querySelector(e.destination).querySelectorAll('span.user').forEach(e => e.remove() );
            len = res.length;
            res.map(function(v,k){
                if (k<5) {
                    badge = document.createElement('span');
                    badge.setAttribute('href','javascript:');
                    badge.setAttribute('class','user bg515fb9');
                    badge.setAttribute('title',v.name);
                    badge.setAttribute('member-id',v.id);
                    badge.innerHTML = v.character;
                    destination.append(badge);
                }else{
                    more = parseInt(len) - 5;
                    if(more != 0) {
                        if(!destination?.querySelector('span.more'))
                        {
                            badge = document.createElement('span');
                            badge.setAttribute('href','javascript:');
                            badge.setAttribute('class','user bg515fb9 more');
                            badge.innerHTML = `+${more}`;
                            destination.append(badge);
                        }else{
                            badge = destination.querySelector('span.more');
                            badge.innerHTML = `+${more}`;
                        }
                    }
                    return false;
                }
            });
        });
    }

    function Saving(e)
    {
        const loader = document.createElement('span');
        loader.setAttribute('class','loader');
        if (e.querySelector('.loader') == undefined) e.prepend(loader);
        const saveBtn = e.querySelector('.-save');
        if (e) {
            e?.setAttribute('disabled',true);
            e.childNodes.forEach(el => {
                if (el.getAttribute('class') == null) el.innerHTML = `Loading...`;
            });
        }
    }
    function Saved(e)
    {
        e.querySelector('.loader')?.remove();
        e.querySelector('span').innerHTML = `Save`;
    }

    function SetAlert(e)
    {
        destination = e.element;
        const className = e.status === true ? 'success' : 'danger';
        const alert = document.createElement('span');
        alert.setAttribute('class',`text-alert text-${className} font-weight-bold d-block mb-0 mt-2`);
        alert.innerHTML = className === true ? `Success, ${e.message}`:`Oops, ${e.message}`;
        // console.log(destination);
        if (destination.closest('.description-edit').querySelector('.text-alert') == null) 
            destination.closest('.description-edit').insertBefore(alert, destination);
        // if (destination.querySelector('.alert') == null) destination.prepend(alert);
    }

    async function SaveAction(url,data)
    {
        if (data != null) data._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const request = await fetch(url,{
            method: "post",
            headers: { "Content-Type" : "application/json" },
            body: JSON.stringify(data)
        });
        const response = await request.json();
        return response;
    }

    async function getMember()
    {
        const response = await fetch('api/get/users?notlike=JWILL');
        const data = await response.json();
        return data;
    }
    async function getMemberInTodolist(id)
    {
        const response = await fetch(`api/to-do-list/${id}/member`);
        const data = await response.json();
        return data;
    }
    
    function enableDragSort(listClass)
    {
        const sortableLists = document.getElementsByClassName(listClass);
        Array.from(sortableLists).map(list =>  enableDragList(list) );
    }

    function enableDragList(list)
    {
        Array.prototype.map.call(list.querySelectorAll('.box'), (item) => { enableDragItem(item); });
    }

    function enableDragItem(item)
    {

        item.setAttribute('draggable', true);
        item.ondragend = handleDrop;
        item.ondrag = handleDrag;
        item.onclick = EditList;
    }

    function handleDrag(item) {
        const selectedItem = item.target,
            x = event.clientX,
            y = event.clientY;
        let list = selectedItem.closest('.to-do-list').querySelector('.box-list');
        selectedItem.classList.add('drag-sort-active');

        let swapItem = document.elementFromPoint(x,y) === null ? selectedItem : document.elementFromPoint(x,y).closest('.box');

        if (list === swapItem?.parentNode) {
            swapItem = swapItem !== selectedItem.nextSibling ? swapItem: swapItem.nextSibling;
            list.insertBefore(selectedItem, swapItem);
        }
        else{
            if (document.elementFromPoint(x,y).classList.contains('to-do-list')) {
                list = document.elementFromPoint(x,y);
                list.querySelector('.box-list').append(selectedItem);
            }
            else {
                list = document.elementFromPoint(x,y).closest('.to-do-list');
                if(list!== null) list.querySelector('.box-list').append(selectedItem);
            }
        }
    }

    function handleDrop(item)
    {
        item.target.classList.remove('drag-sort-active');
    }

    async function GetTodoList(id)
    {
        const url = id ? `api/get/to-do-list/${id}` : `api/get/to-do-list`;
        const request = await fetch(url);
        const response = await request.json();
        return response;
    }
    async function GetCheckList(checkListId,id)
    {
        const url = id ? `api/get/to-do-list/check-list/${id}` : `api/get/to-do-list/${checkListId}/check-list`;
        const request = await fetch(url);
        const response = await request.json();
        return response;
    }
    async function GetCheckListItems()
    {
        const request = fetch(`api/get/to-do-list/checklist/items?checklist=${id}`);
        const response = request.json();
        return response;
    }
    async function UpdateChecklist(data)
    {
        data._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const request = await fetch('api/to-do-list/checklist/update',{
            method: 'post',
            headers: { "Content-Type": 'application/json' },
            body: JSON.stringify(data)
        });
        const response = await request.json();
        return response;
    }
    async function StoreChecklistItem(data)
    {
        data._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const request = await fetch(`api/to-do-list/checklist/item`,{
            method: 'post',
            headers: { "Content-Type":"application/json"},
            body: JSON.stringify(data)
        });
        const response = await request.json();
        return response;
    }

    async function UpdateChecklistItem(data)
    {
        data._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const request = await fetch('api/to-do-list/checklist/item/update',{
            method:'post',
            headers:{ "Content-Type": 'application/json' },
            body: JSON.stringify(data)
        });
        const response = await request.json();
        return response;
    }
    async function UpdateMemberInTodolist(data)
    {
        const request = await fetch('api/to-do-list/member-and-return',{
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data),
        });
        const response = await request.json();
        return response;
    }
    async function DeleteAction(url,data)
    {
        const request = await fetch(url,{
            method: 'DELETE',
            headers: { 
                "Content-type": "application/jspn",
                "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            }
        });
        const response = await request.json();
        return response;
    }

    function FetchToDoList()
    {
        GetTodoList().then(res => pushData(res) );
        
        const data = { list:[], do:[], test:[], done:[] };
        function pushData(obj){
            data.list = [];
            obj?.forEach(v=> {
                if(v.do == 1){
                    data.list.push(v)
                }else if(v.test == 1){
                    data.test.push(v);
                }else if(v.do == 1){
                    data.do.push(v)
                }else{
                    data.done.push(v)
                }
            });
            console.log(data)

            if(data.list.length > 0)
            {
                listDefault = document.querySelector('.list-default');
                let item = '';
                data.list.map(v => {
                    let assign = v.users == null ? `<span class="user bg-darklight"><i class="fas fa-plus"></i></span>`:``;
                    item += `<li class="box" data-id="${v.id}">
                        <div class="box-inner">
                            <p class="list-title">${v.list}</p>
                            <div class="box-user">
                                <span class="fs-12">Assign:</span>${assign}
                            </div>
                        </div>
                    </li>`;
                });
                listDefault.innerHTML = item;
            }
            if (data.do?.length > 0) {
                listDo = document.querySelector('.list-do');
                data.do.forEach(v => {
    
                });
            }
            if (data.test?.length > 0) {
                listTest = document.querySelector('.list-test');
                data.test.forEach(v => {
    
                });
            }
            if (data.done?.length > 0) {
                listDone = document.querySelector('.list-done');
                data.done.forEach(v => {
    
                });
            }
        }
        setTimeout(() => { enableDragSort('to-do-list'); },1000);
        
    }

    FetchToDoList();

    function ClearModal()
    {
        const modal = $('#exampleModal');
        modal.find('.ProseMirror').html('');
        modal.find('.detail-user').find('span.user').remove();
        modal.find('.card-detail-badge-due-date').find('span').html('');
        modal.find('.markeddown').addClass('d-none');
        modal.find('.row-description').find('p').removeClass('d-none');
        modal.find('.row-checklist').closest('.row').remove();
    }

    function EditList(item)
    {
        console.log(item)
        if(!item.target.classList.contains('user'))
        {
            item = item.target.closest('.box');
            const id = item.getAttribute('data-id');
            const title = item.querySelector('.list-title').innerHTML;

            ClearModal();
    
            GetTodoList(id).then(row => {
                const modal = $('#exampleModal');
                modal.modal('show');
                if (row.description != null)
                {
                    descriptionRow = modal.find('.row-description');
                    // descriptionRow.find('.description-edit').addClass('edit');
                    descriptionRow.find('p').addClass('d-none');
                    descriptionRow.find('.markeddown').removeClass('d-none').html(row.description);
                }
                if (row.checklist.length > 0 )
                {
                    descriptionRow = modal.find('.row-description')
                    row.checklist.map(v => {
                        checklist = Checklist(v);
                        $(checklist).insertAfter(descriptionRow);
                        if (v.items.length > 0 )
                        {
                            let last = v.items.length
                            v.items.map(e => {
                                item = ChecklistItem(e);
                                checklist.querySelector('.checklist-items').append(item);
                            });
                            currentChecklistRow = v.items[(last - 1)]
                        }
                    });
                }
                if(row.members.length > 0){
                    const membersContent = document.querySelector('#exampleModal').querySelector('.detail-user');
                    // const badge = document.createElement('span'); 
                    modal.find('a.add-user').attr('select',`${JSON.stringify(row.members)}`);
                    const len = row.members.length;
                    row.members.map(function(v,k){
                        if (k<5) 
                        {
                            badge = document.createElement('span');
                            badge.setAttribute('class','user bg515fb9');
                            badge.setAttribute('title',v.name);
                            badge.setAttribute('member-id',v.id);
                            badge.innerHTML = v.character;
                            membersContent.append(badge);
                        }else{
                            more = parseInt(len) - 5;
                            if(more != 0) 
                            {
                                if(!membersContent?.querySelector('span.more'))
                                {
                                    badge = document.createElement('span');
                                    badge.setAttribute('class','user bg515fb9 more');
                                    badge.innerHTML = `+${more}`;
                                    membersContent.append(badge);
                                }else{
                                    badge = destination.querySelector('span.more');
                                    badge.innerHTML = `+${more}`;
                                }
                            }
                            return false;
                        }
                    })
                }
                calculatePercentage();
                modal.find('.modal-title').html(title);
                modal.find('input[name="id"]').val(id);
            });
        }
    }

    

    function AddToCard(action)
    {
        switch (action) {
            case 'member':

            break;
            case 'checklist':
                let checklist = document.createElement('div');
                let uid = genUid();
                checklist.setAttribute('class', `row mb-3 ${uid}`);
                checklist.innerHTML = `<div class="col-lg-12 mb-2">
                        <div class="head">
                            <i class="far fa-calendar-check fa-lg mr-3"></i>
                            <div class="checklist-title">
                                <h5>Title</h5>
                                <div class="window-module-title-options">
                                    <a href="javascript:" class="btn btn-light btn-sm" action="checklist-delete" data-delete="${uid}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 row-checklist">
                        <div class="checklist-percentage">
                            <div class="left">
                                <small><span class="percentage">0</span>%</small>
                            </div>
                            <div class="right">
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="checklist-items"></div>
                        <div class="checklist-add ml-33 my-2 editing">
                            <button class="-btn -btn-secondary description-edit new-checklist-item mt-2 d-none">Add an item</button>
                            <textarea class="checklist-new-item-text form-control my-2" placeholder="Add an item"></textarea>
                            <div class="checklist-add-controls">
                                <button class="add-checklist-item -btn -btn-primary mr-1">Add</button>
                                <a class="-btn -btn-transparent btn-sm cancel cancel-checklist-item" href="javascript:">Cancel</a>
                                <div class="checklist-add-controls-spacer"></div>
                                <a class="-btn -btn-transparent checklist-add-controls-option options-menu" href="javascript:">
                                    <i class="fas fa-user-plus mr-1"></i>Assign
                                </a>
                                <a class="-btn -btn-transparent checklist-add-controls-option options-menu checklist-add-controls-due" href="javascript:">
                                    <i class="far fa-clock mr-1"></i>Due date
                                </a>
                            </div>
                        </div>
                    </div>`;
                document.getElementById('exampleModal').querySelector('.col-lg-10').insertBefore(
                    checklist,
                    document.querySelector('.row-activity')
                );
                UpdateChecklist({
                    todoId: document.getElementById('exampleModal').querySelector('input[name="id"]').value
                }).then(res => {
                    if (res.status === true) {
                        const thisItem = document.querySelector(`${uid}`).setAttribute('data-id',res.id);
                        thisItem.querySelector('[action="checklist-delete"]').setAttribute('data-id',res.id)
                    }
                });
            break;
            default: break;
        }
    }
    var actionItem;
    var currentChecklistRow;
    //  Click Event
    //  Click Event
    document.addEventListener('click',function(e){
        const addList = e.target.closest('.add-box');
        if(addList) {
            modalContent = document.querySelector('#exampleModal');
            Modal = new bootstrap.Modal(modalContent,{ backdrop: false, keyboard: true});
            Modal.show();
        }
        const newChecklistItem = e.target.closest('.new-checklist-item');
        if(newChecklistItem){
            newChecklistItem.closest('.editing').querySelector('textarea').classList.remove('d-none');
            newChecklistItem.closest('.editing').querySelector('.checklist-add-controls').classList.remove('d-none');
            cancelEditChecklist(newChecklistItem);
            hideAddBtnOnEdit(newChecklistItem);
            
        }
        const cancelChecklistItem = e.target.closest('.cancel-checklist-item');
        if(cancelChecklistItem){
            cancelAddChecklist(cancelChecklistItem);
            showAddBtnOnCalcelEdit(cancelChecklistItem);
        }

        const AddChecklistItem = e.target.closest('.add-checklist-item');
        if(AddChecklistItem){
            let detail = AddChecklistItem.closest('.editing').querySelector('textarea');
            if(detail.value != ''){
                StoreChecklistItem({
                    _method: 'PUT',
                    checklist: AddChecklistItem.getAttribute('checklist-id'),
                    title: detail.value
                }).then(res => {
                    if(res.status === true)
                    {
                        detail.classList.remove('invalid');
                        let item = document.createElement('div');
                        let uid = genUid();
                        item.setAttribute('class','checklist-item');
                        item.setAttribute('checklist-item',res.id)
                        item.innerHTML = `
                        <div class="checklist-item-checkbox enabled js-toggle-checklist-item" data-testid="checklist-item-checkbox">
                            <span class="checklist-item-checkbox-check"></span>
                        </div>
                        <div class="checklist-item-details editable ml-16 w-100">
                            <div class="checklist-item-row w-100 hide-on-edit">
                                <div class="checklist-item-text-and-controls">
                                    <span class="checklist-item-details-text markeddown js-checkitem-name">${detail.value}</span>
                                </div>
                                <div class="checklist-add-controls-spacer"></div>
                                <div class="checklist-item-controls">
                                    <button class="-btn -btn-darklight -btn-circle mr-1"><i class="far fa-clock fa-sm m-auto"></i></button>
                                    <button class="-btn -btn-darklight -btn-circle mr-1"><i class="fas fa-user-plus fa-sm m-auto"></i></button>
                                    <button class="-btn -btn-darklight -btn-circle checklist-actions" data-attr="checklist-id" data-id="${res.id}"><i class="fas fa-ellipsis-h fa-sm m-auto"></i></button>
                                </div>
                            </div>
                            <div class="edit check-item-options-menu">
                                <textarea class="form-control" type="text" data-autosize="true" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;"></textarea>
                                <div class="edit-controls u-clearfix">
                                    <input class="-btn -btn-primary -save confirm save-edit-item mr-1" type="submit" value="Save">
                                    <a class="-btn -btn-secondary btn-sm cancel cancel-edit-item" href="javascript:">Cancel</a>
                                    <div class="edit-controls-spacer"></div>
                                    <a class="-btn -btn-secondary mr-1 option check-item-options-menu js-assign" href="javascript:">
                                        <i class="fas fa-user-plus mr-1"></i>Assign
                                    </a>
                                    <a class="-btn -btn-secondary option check-item-options-menu js-due checklist-add-controls-due" href="#">
                                        <i class="far fa-clock mr-1"></i>Due date
                                    </a>
                                </div>
                            </div>
                        </div>
                        `;
                        const checklist = AddChecklistItem.closest('.editing').previousElementSibling;
                        checklist.prepend(item);
                        detail.value = '';
                        currentChecklistRow = AddChecklistItem.closest('.row-checklist');
                    }
                })
                
            }else{
                detail.classList.add('invalid');
            }
        }
        // Edit todo list
        const EditList = e.target.closest('.box')
        if(EditList){
       
            const id = EditList.getAttribute('data-id');
            const title = EditList.querySelector('.list-title').innerHTML;

            ClearModal();
    
            GetTodoList(id).then(res => {
                const row = res.data[0];
                const modal = $('#exampleModal');
                modal.modal('show');
                if (row.description != null)
                {
                    descriptionRow = modal.find('.row-description');
                    // descriptionRow.find('.description-edit').addClass('edit');
                    descriptionRow.find('p').addClass('d-none');
                    descriptionRow.find('.markeddown').removeClass('d-none').html(row.description);
                }
                if (row.checklist.length > 0 )
                {
                    descriptionRow = modal.find('.row-description')
                    row.checklist.map(v => {
                        checklist = Checklist(v);
                        $(checklist).insertAfter(descriptionRow);
                        if (v.items.length > 0 )
                        {
                            let last = v.items.length
                            v.items.map(e => {
                                item = ChecklistItem(e);
                                checklist.querySelector('.checklist-items').append(item);
                            });
                            currentChecklistRow = v.items[(last - 1)]
                        }
                    });
                }
                if(row.members.length > 0){
                    const membersContent = document.querySelector('#exampleModal').querySelector('.detail-user');
                    // const badge = document.createElement('span'); 
                    modal.find('a.add-user').attr('select',`${JSON.stringify(row.members)}`);
                    const len = row.members.length;
                    row.members.map(function(v,k){
                        if (k<5) 
                        {
                            badge = document.createElement('span');
                            badge.setAttribute('class','user bg515fb9');
                            badge.setAttribute('title',v.name);
                            badge.setAttribute('member-id',v.id);
                            badge.innerHTML = v.character;
                            membersContent.append(badge);
                        }else{
                            more = parseInt(len) - 5;
                            if(more != 0) 
                            {
                                if(!membersContent?.querySelector('span.more'))
                                {
                                    badge = document.createElement('span');
                                    badge.setAttribute('class','user bg515fb9 more');
                                    badge.innerHTML = `+${more}`;
                                    membersContent.append(badge);
                                }else{
                                    badge = destination.querySelector('span.more');
                                    badge.innerHTML = `+${more}`;
                                }
                            }
                            return false;
                        }
                    })
                }
                calculatePercentage();
                modal.find('.modal-title').html(title);
                modal.find('input[name="id"]').val(id);
            });
        }
        const markedDown = e.target.closest('.markeddown');
        if(markedDown){
            markedDown.classList.add('d-none');
            descriptionEdit(markedDown.closest('.row-description').querySelector('.description-edit'))
        }
        const checkBox = e.target.closest('.checklist-item-checkbox');
        if(checkBox){
            let checked = false;
            let id = checkBox.closest('.checklist-item').getAttribute('checklist-item-id');
            if (checkBox.classList.contains('checked')) {
                checked = false;
                checkBox.classList.remove('checked');
            }else{
                checked = true;
                checkBox.classList.add('checked');
            } 
            currentChecklistRow = checkBox.closest('.row-checklist');
            UpdateChecklistItem({id:id,do:checked}).then(res => {
                if(res.status === true)
                {
                    calculatePercentage();
                }
            })
        }

        checklistDelete = e.target.closest('[action="checklist-delete"]');
        if(checklistDelete){
            actionItem = checklistDelete;
            let actions = `
            <div class="p-2">
                <p>Deleting a checklist is permanent and there is no way to get it back.</p>
                <button 
                    class="-btn -btn-danger action-item font-weight-bold text-center" 
                    action="delete"
                    action-with="class"
                    action-class="${checklistDelete.getAttribute('data-delete')}"
                >Delete</button>
            </div>
            `;
            const title = 'Delete '+checklistDelete.closest('.checklist-title').querySelector('h5').innerHTML + '?';
            const offset = getOffset(e,checklistDelete);
            showAction({offset: offset, actions: actions, title: title});
        }

        checklistActions = e.target.closest('.checklist-actions');
        if(checklistActions){
            let actions = `
            <div class="pb-2">
                <button
                    class="-btn -btn-transparent action-item"
                    action="edit"
                    action-with="attribute"
                    action-attr="${checklistActions.getAttribute('data-attr')}"
                    action-data="${checklistActions.getAttribute('data-id')}"
                >Edit</button>
                <button 
                    class="-btn -btn-transparent action-item"
                    action="delete"
                    action-with="attribute"
                    action-attr="${checklistActions.getAttribute('data-attr')}"
                    action-data="${checklistActions.getAttribute('data-id')}"
                    action-url="${checklistActions.getAttribute('data-url')}"
                >Delete</button>
            </div>
            `;
            
            const offset = getOffset(e,checklistActions);
            showAction({offset: offset, actions: actions});
        }

        const deleteComment = e.target.closest('.delete-comment');
        if(deleteComment){
            actionItem = deleteComment;
            let actions = `
            <div class="p-2">
                <p>Deleting a checklist is permanent and there is no way to get it back.</p>
                <button 
                    class="-btn -btn-danger action-item font-weight-bold text-center" 
                    action="${deleteComment.getAttribute('action')}"
                    action-with="${deleteComment.getAttribute('action-with')}"
                    action-id="${deleteComment.getAttribute('action-id')}"
                >Delete</button>
            </div>
            `;
            const title = 'Delete Comment?';
            const offset = getOffset(e,deleteComment);
            showAction({offset:offset, actions:actions, title:title});
        }


        const editable = e.target.closest('.checklist-item-text-and-controls');
        if(editable)
        {
            cancelAddChecklist(editable);
            if(!editable.closest('.checklist-item').classList.contains('editable'))
            {
                editChecklist(editable);
                hideAddBtnOnEdit(editable);
            }
        }
        const cancel = e.target.closest('.cancel');
        if(cancel)
        {
            if(cancel.classList.contains('cancel-edit-item'))
            {
                cancel.closest('.edit').querySelector('textarea').value = '';
                cancel.closest('.checklist-item').classList.remove('editing');
                showAddBtnOnCalcelEdit(cancel);
            }
        }
        const saveEditList = e.target.closest('.save-edit-item');
        if(saveEditList){

            let newText = saveEditList.closest('.check-item-options-menu').querySelector('textarea').value;
            let saveTo = saveEditList.closest('.checklist-item').querySelector('.checklist-item-details-text');
            saveTo.innerHTML = newText;
            hideEditChecklist(saveEditList);
        }

        const WriteComment = e.target.closest('.write-comment');
        if(WriteComment){
            let area = WriteComment.closest('.checklist-new-comment');
            MiniEditor({
                area: area,
                hideOnEdit: WriteComment,
                parent: '.row-activity',
                children: '.write-a-comment',
                appendTo: '.comment-list'
            });
        }

        const editComment = e.target.closest('.edit-comment');
        if(editComment){
            area = editComment.closest('.comment-right').querySelector('.comment-edit');
            MiniEditor({
                area: area,
                hideOnEdit: editComment.closest('.row-comment').querySelector('.comment-inner'),
                parent: '.row-comment',
                children: '.comment-edit',
                changeTo: '.current-comment',
                toggleClass:[{
                    '.comment-right':'w-100'
                }]
            });
        }
        const addUser = e.target.closest('.add-user');
        if(addUser){
            let actions = `
            <div class="p-2">
                <div class="pop-over-content js-pop-over-content u-fancy-scrollbar js-tab-parent" style="height: 500px; max-height: 500px; overflow-y:auto;">
                    <input type="text" name="members" class="form-control" placeholder="Search members" >
                    <div class="pop-over-section js-board-members">
                        <h6 class="my-2">Board members</h6>
                        <ul class="pop-over-member-list checkable u-clearfix member-list">`;
                            UsersList.map((v)=>
                            actions +=`<li class="item js-member-item list" member-id="${v.id}">\
                                <a class="name js-select-member" href="javascript:" member-id="${v.id}" title="${v.name}" member-badge="${v.name.charAt(0)+v.name.charAt(1)}">\
                                    <span class="member js-member"><span class="user bg515fb9">${v.name.charAt(0)+v.name.charAt(1)}</span></span><span class="full-name ml-1">${v.name}</span>\
                                </a>\
                            </li>`);
            actions+=`</ul></div></div>`;
            const title = 'Members';
            const offset = getOffset(e,addUser);
            showAction({
                offset: offset,
                actions: actions,
                title: title,
                select: JSON.parse(addUser.getAttribute('select'))
            });
        }
        
        list = e.target.closest('.js-member-item');
        if (list) {
            console.log(list);
            let icon = document.createElement('i');
            icon.setAttribute('class','fas fa-check position-absolute');
            icon.setAttribute('style','right: 10px;');
            const CharecterName = list.querySelector('span.user');
            const selected = list.querySelector('.fa-check');
            const user = [];
            action = '';
            if (selected == null) {
                list.querySelector('a').append(icon);
                action = 'add';
            }else{
                list.querySelector('.fa-check').remove();
                action = 'remove';
            }
            setTimeout(() => {
                select = list.closest('.member-list').querySelectorAll('.fa-check');
                select.forEach(function(e){ user.push(e.closest('li.item').getAttribute('member-id')); });
                UpdateMemberInTodolist({
                    user: user,
                    todoId: document.querySelector('#exampleModal').querySelector('input[name="id"]').value
                }).then(res => {
                    MemberBadge({
                        destination: '.detail-user',
                        id: list.getAttribute('member-id')
                    }); 
                });
            },500);
        }
    })

    function calculatePercentage()
    {
        let checkbox = currentChecklistRow?.querySelectorAll('.checklist-item-checkbox');
        let percentage = 0;
        let sum = 0;
        let count = checkbox != null ? checkbox.length : 0 ;
        Array?.from(checkbox).map(function(e){ if(e.classList.contains('checked')) sum++; })
        percentage = sum * 100 / count;
        percentage = isNaN(percentage)? 0 : Math.round(percentage);

        let percenteageRow = currentChecklistRow.querySelector('.checklist-percentage');
        if(percenteageRow)
        {
            percenteageRow.querySelector('.progress-bar').style.width = `${percentage}%`;
            percenteageRow.querySelector('.progress-bar').setAttribute('aria-valuenow',percentage);
            percenteageRow.querySelector('.percentage').innerHTML = percentage;
        }

    }
  
    function showAction(event)
    {
        const actionsBox = document.querySelector('.actions');
        actionsBox.innerHTML = '';
        const inner = document.createElement('div');
        inner.setAttribute('class','actions-container')
        inner.style.zIndex = 1;
        inner.innerHTML = `
        <div class="actions-header">
            <h6>Item actions</h6>
            <a href="javascript:" class="-btn -btn-transparent action-close">
                <i class="fas fa-times"></i>
            </a> 
        </div>
        <div class="action-body">${event.actions}</div>
        `;
        actionsBox.append(inner);
        if (event.title) actionsBox.querySelector('h6').innerHTML = event.title;
        actionsBox.style.display = 'block';
        actionsBox.style.position = 'fixed';
        actionsBox.style.width = '304px';
        actionsBox.style.willChange = 'top, left';
        actionsBox.style.top = `${event.offset.top}px`;
        actionsBox.style.left = `${event.offset.left}px`;
        actionsBox.style.zIndex = 9999;

        actionsBox.querySelector('input[name="members"]').addEventListener('keyup',function(e){
            if (this.timer) window.clearTimeout(this.timer);
            this.timer = window.setTimeout(function(){
                keyword = e.target.value;
                memberList = actionsBox.querySelectorAll('li.list');
                memberList.forEach((v) => {
                    val = v.querySelector('.full-name').innerHTML.toLowerCase();
                    if (val.indexOf(keyword.toLowerCase()) < 0 ) v.classList.add('d-none');
                    else v.classList.remove('d-none');
                });
            }, 500);

        });

        if(event.select.length > 0){
            event.select.map(function(v,k){
                icon = document.createElement('i');
                icon.setAttribute('class','fas fa-check position-absolute');
                icon.setAttribute('style','right: 10px;');
                actionsBox.querySelector(`[member-id="${v.id}"]`).querySelector('.js-select-member').append(icon);
            })

        }

        Array.from(document.querySelectorAll('.action-item')).map((item) => { item.onclick = takeAction });
        document.querySelector('.actions .action-close').onclick = closeAction;
    }

    function takeAction(){
        const el = this;
        const action = el.getAttribute('action');
        const actionWith = el.getAttribute('action-with');
        if(action == 'delete')
        {
            switch (actionWith)
            {
                case 'class':
                    closeAction();
                    setTimeout(() => {
                        currentChecklistRow = actionItem.closest('.row-checklist');
                        actionItem.closest(`.${el.getAttribute('action-class')}`)?.remove();
                        calculatePercentage();
                    },200);
                break;
                case 'attribute':
                    closeAction();
                    DeleteAction(el.getAttribute('action-url')).then(res => {
                        if(res.status === true){
                            setTimeout(() => {
                                currentChecklistRow =  document.querySelector(`[${el.getAttribute('action-attr')}="${el.getAttribute('action-data')}"]`).closest('.row-checklist');
                                document.querySelector(`[${el.getAttribute('action-attr')}="${el.getAttribute('action-data')}"]`)?.remove();
                                calculatePercentage();
                            },200);
                        }
                    });
                break;
            }
        }
        else if(action == 'delete-comment'){
            closeAction()
            setTimeout(()=>{
                currentRow = document.querySelector(`#${el.getAttribute('action-id')}`)?.remove();
            },200);
        }
        else if(action == 'edit')
        {
            currentChecklistRow =  document.querySelector(`[${el.getAttribute('action-attr')}="${el.getAttribute('action-data')}"]`).closest('.row-checklist');
            
            editChecklist(currentChecklistRow)
        }
    }
    function editChecklist(el)
    {
        thisRow = el.closest('.checklist-item');
        value = thisRow.querySelector('.checklist-item-details-text').innerHTML;
        Array.from(el.closest('.checklist-items').querySelectorAll('.checklist-item')).map(
        (e) => {
            if(thisRow.getAttribute('checklist-id') == e.getAttribute('checklist-id')) {
                e.classList.add('editing');
                e.querySelector('textarea').value = value;
            }else{
                e.classList.remove('editing');
            }
        })
    }
    function cancelAddChecklist(el)
    {
        row = el.closest('.row-checklist').querySelector('.checklist-add');
        row.querySelector('.checklist-add-controls').classList.add('d-none');
        row.querySelector('textarea').classList.add('d-none');
        row.querySelector('button').classList.remove('d-none');
        el.closest('.row-checklist').querySelector('.add-checklist-item').classList.remove('d-none');
    }
    function cancelEditChecklist(el)
    {
        row = el.closest('.row-checklist').querySelector('.checklist-item.editing');
        row?.classList.remove('editing');
    }

    const hideEditChecklist = (el) => {
        el.closest('.edit').querySelector('textarea').value = ''
        el.closest('.checklist-item').classList.remove('editing');
    }
    const hideAddBtnOnEdit = (el) => {
        const addEvent = el.closest('.checklist-add');
        const btn = (addEvent?.classList.contains('checklist-add')) ? addEvent.querySelector('.new-checklist-item') : el.closest('.checklist-items').nextElementSibling.querySelector('.new-checklist-item');
        btn?.classList.remove('d-block');
        btn?.classList.add('d-none');
    }
    const showAddBtnOnCalcelEdit = (el) => {
        const addEvent = el.closest('.checklist-add');
        const btn = (addEvent) ? addEvent.querySelector('.new-checklist-item') : el.closest('.checklist-items').nextElementSibling.querySelector('.new-checklist-item');

        btn.classList.remove('d-none');
        btn.classList.add('d-block');
    }
    function closeAction(){
        const actionsBox = document.querySelector('.actions');
        actionsBox.removeAttribute('style');
        actionsBox.innerHTML = '';
    }

    toolbar = document.querySelector('.toolbar');
    Array.prototype.map.call(toolbar.querySelectorAll('.toolbar-item'), (item) => {actions(item)});
    
    function actions (item) {
        item.onclick = handleButton;
    }
    function handleButton (el)
    {
        item = el.target.closest('.toolbar-item');
        command = item.getAttribute('exec-command');
        document.execCommand(command,true);
    }
    function descriptionEdit(el)
    {
        noRecordEl = el.closest('p');
        noRecordEl.classList.add('d-none');
        noRecordEl.nextElementSibling.classList.add('edit');
        markedDown = el.closest('.row-description').querySelector('.markeddown');
        if (markedDown.innerHTML != '') {
            const InnerHtml = markedDown.querySelector('[contenteditable="true"]').innerHTML;
            noRecordEl.nextElementSibling.querySelector('[contenteditable="true"]').innerHTML = InnerHtml;
        }
    }
    const descriptionSave = (btn) => {
        Saving(btn)
        setTimeout(() => 
        {
            const actionTools = btn.closest('.sk-editor-action-button');
            const descriptionRow = actionTools.closest('.row-description');
            const editor = descriptionRow.querySelector('.sk-editor-mini');
            const markedDown = descriptionRow.querySelector('.markeddown');
            const htmlString = actionTools.closest('.description-edit').querySelector('.ProseMirror')?.outerHTML.toString();

            const data = {};
            data._method = 'POST';
            data.description = htmlString;
            data.id = btn.closest('.modal-body').querySelector('input[name="id"]').value;
            SaveAction(`webpanel/to-do-list/description`,data).then((res)=>{
                if(res.status === false)
                {
                    SetAlert({
                        element: actionTools,
                        btn: btn,
                        status: res.status,
                        message: res.message,
                    })
                }else{
                    markedDown.innerHTML = htmlString;
                    markedDown.classList.remove('d-none');
                    editor.parentElement.classList.remove('edit');
                    btn.querySelector('.loader').remove();
                }
                Saved(btn);
            });
        }, 800);

    }
    const descriptionCancel = (btn) => 
    {
        const editEl = btn.closest('.description-edit');
        const markedDown = editEl.closest('.row-description').querySelector('.markeddown');
        editEl.classList.remove('edit');
        if(markedDown.querySelector('.ProseMirror').innerHTML!=''){
            markedDown.classList.remove('d-none');
        }else{
            editEl.previousElementSibling.classList.remove('d-none');
        }
        btn.closest('.sk-editor-action-button').querySelector('.loader')?.remove();
    }
    function getOffset(e,el)
    {
        return {
            top : e.pageY + el.clientHeight / 2,
            left : e.pageX
        };
    }
    function genUid()
    {
        return (new Date().getTime()).toString(36);
    }
 
    function MiniEditor(e)
    {
        var area = e.area;
        var parent = e.parent;
        var children = e.children;
        var Editor = document.createElement('div');
        Editor.setAttribute('class','mini-editor');
        Editor.innerHTML = `
        <div class="ml-2">
            <div class="sk-editor-mini">
                <div class="sk-editor-main-toolbar">
                    <div class="toolbar">
                        <button class="toolbar-item bold -btn -btn-transparent" exec-command="bold" title="Bold"><i class="fas fa-bold"></i></button>
                        <button class="toolbar-item italic -btn -btn-transparent" exec-command="italic" title="Italic"><i class="fas fa-italic"></i></button>
                        <button class="toolbar-item strikethrougth -btn -btn-transparent" exec-command="strikethrough" title="Strikethrough"><i class="fas fa-strikethrough"></i></button>
                        <span class="css-g4dhky"></span>
                        <button class="toolbar-item list-ul -btn -btn-transparent" exec-command="insertUnorderedList" title="Bullet list"><i class="fas fa-list-ul"></i></button>
                        <button class="toolbar-item dropdown list-ol -btn -btn-transparent" exec-command="insertOrderedList" title="Numbered list"><i class="fas fa-list-ol"></i></button>
                    </div>
                </div>
                <div class="sk-editor-content-area">
                    <div class="ProseMirror" contenteditable="true"></div>
                </div>
            </div>
            <div class="sk-editor-action-button d-flex mt-2">
                <button class="-btn -btn-primary -save action" action="save">Save</button>
                <button class="-btn -btn-transparent -save action" action="cancel">Cancel</button>
            </div>
        </div>
        `;
        if(e.hideOnEdit) e.hideOnEdit.classList.add('d-none');
        e.toggleClass?.map((v,i) => {
            area.closest(parent).querySelector(Object.keys(v)[0])?.classList.add(Object.values(v)[0]);
        })
        if(e.changeTo){
            oldText = area.closest(parent).querySelector('.current-comment').innerHTML;
            Editor.querySelector('[contenteditable="true"]').innerHTML = oldText;
        }
        if(!area.closest(e.parent).querySelector(e.children))
        {
            Editor.classList.add('edit');
            area.append(Editor);
        }else{
            area.append(Editor);
            Editor.classList.add('edit');
        }

        Editor.querySelector('.sk-editor-content-area').addEventListener('click',function(e){
            e.target.closest('.sk-editor-mini').classList.add('-focus');
            Editor.querySelector('[contenteditable="true"]').focus();
        })
        Array.prototype.map.call(Editor.querySelectorAll('.action'), (e)=>{ 
            e.onclick = actionEditor;
        });
        function actionEditor()
        {
            action = this.getAttribute('action');
            row = this.closest(e.parent);
            switch (action) 
            {
                case 'save':
                    commentId = genUid();
                    let rowComment = document.createElement('div');
                    rowComment.setAttribute('class','row-comment');
                    rowComment.setAttribute('id',commentId);
                    textHtml = Editor.querySelector('.ProseMirror').innerHTML;
                    textContainer = `
                        <div class="detail-user">
                            <a href="javascript:" class="user bg515fb9" style="margin-left: -5px;">${shortName}</a>
                        </div>
                        <div class="comment-right ml-2">
                            <div class="comment-container">
                                <span class="inline-member" idmember="${memberId}"><span class="font-weight-bold">${displayName}</span></span>
                                <span class="inline-spacer"> </span>
                                <div class="comment-inner">
                                    <div class="action-comment can-edit js-comment is-comments-rewrite">
                                        <div class="current-comment js-friendly-links js-open-card">${textHtml}</div>
                                    </div>
                                    <div class="comment-actions">
                                        <span class="quiet">
                                            <a class="edit-comment" href="javascript:">Edit</a> • <a class="delete-comment" href="javascript:" action="delete-comment" action-with="id" action-id="${commentId}">Delete</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-edit">
                            </div>
                            
                        </div>
                    `;
                    rowComment.classList.add(`${commentId}`);
                    rowComment.innerHTML = textContainer;
                    if(e.changeTo){
                        let newText = Editor.querySelector('[contenteditable="true"]').innerHTML;
                        area.closest(parent).querySelector(e.changeTo).innerHTML = newText
                    }
                    else{
                        area.closest(e.parent).querySelector(e.appendTo).prepend(rowComment);
                    }
                    clearComment();
                break;
                default:
                    Editor.classList.remove('edit');
                    e.hideOnEdit?.classList.remove('d-none');
                    Editor.querySelector('[contenteditable="true"]').innerHTML = '';
                break;
            }

        }
        function clearComment() {
            Editor.querySelector('.ProseMirror').innerHTML = '';
            e.hideOnEdit?.classList.remove('d-none');
            Editor.classList.remove('edit');
        }
        Array.prototype.map.call(Editor.querySelectorAll('.toolbar-item'), (item) => {actions(item)});
        

        // function getTakeACtion()
        // {
        //     Array.from(document.querySelectorAll('.action-item')).map((item)=>{ item.onclick = takeAction });
        // }
        

        

        


        function SaveEdit(action){
            switch (action) {
                case 'save-description': break;
                case 'save-comment': break;
                case 'save-list-item': break;
            
                default:
                    break;
            }
        }

        function AddMember()
        {

        }
        function DueDate()
        {
            const dueDate = document.querySelector('.')
        }
        function Assign(memberId)
        {
            memberId
        }

        


    }
    
</script>