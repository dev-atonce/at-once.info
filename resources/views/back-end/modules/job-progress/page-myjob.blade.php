<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/detail.css">
<style type="text/css">
    :root{
        --
        --blue: #023E8A;
        --green: #5DD39E;
        --yellow: #FFCB77;
        --main: #3c4b64;
        --grey: #D9D9D9;
        --red: #F25F5C;
        --pink: #ff6881;

        --darkpink: #d54860;
        --darkblue: #3C4B64;

        --lightpurple: #e4c1f9;
        --lightblue: #a9def9;
        --lightgreen: #d0f4de;
        --lightyellow: #d0f4de;
        --lightgrey: #EBEDEF;
        --lightred: #FF9E9C;
        --lightpink: #ffc8dd;
        
        --sunday-color: #CC0000;
        --monday-color: #FFFF00;
        --tuesday-color: #FF0066;
        --wednesday-color: #33FF00;
        --thursday-color: #FF4500;
        --friday-color: #00FFFF;
        --saturday-color: #8A2BE2;
        
    }
    .c-sunday{ color: var(--sunday-color);}
    .c-monday{ color: var(--monday-color);}
    .c-tuesday{ color: var(--tuesday-color);}
    .c-wednesday{ color: var(--wednesday-color);}
    .c-thursday{ color: var(--thursday-color);}
    .c-friday{ color: var(--friday-color);}
    .c-saturday{ color: var(--saturday-color);}
    .bg-sunday{ background-color: var(--sunday-color)}
    .bg-monday{ background-color: var(--monday-color)}
    .bg-tuesday{ background-color: var(--tuesday-color)}
    .bg-wednesday{ background-color: var(--wednesday-color)}
    .bg-thursday{ background-color: var(--thursday-color)}
    .bg-friday{ background-color: var(--friday-color)}
    .bg-saturday{ background-color: var(--saturday-color)}

    .bg-lightpurple{
        background-color: var(--lightpurple);
    }
    .badge-lightpurple{
        background-color: var(--lightpurple);
        color: var(--darkblue)
    }
    html {
        scroll-behavior: smooth;
    }
    /* HTML: <div class="loader"></div> */
    /* HTML: <div class="loader"></div> */
    .icon-loader {
        width: 20px;
        aspect-ratio: 1;
        border-radius: 50%;
        border: 4px solid rgb(240 240 240);
        border-right-color: #292929;
        animation: l2 1s infinite linear;
    }
    @keyframes l2 {to{transform: rotate(1turn)}}
    #my-jobs .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        /* background-color: #fff; */
        background-clip: border-box;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -1px rgb(0 0 0 / 6%);
    }

    .card-header {
        position: relative;
        padding: 1rem 1rem;
        border-bottom: none;
        background-color: #fff;
        /* box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%); */
        z-index: 2; 
        min-height: 65px;
    }


    .card-header h5 {
        padding: 4px;
    }

    .card-footer {
        padding: 1rem 2rem;
        background-color: rgba(0, 0, 0, .03);
        border-top: 1px solid transparent;
        min-height: 50px;
    }

    .box .title {
        margin-bottom: 10px;
    }

    .box-card .title {
        margin-bottom: 10px;
        color: #2c7be5;
    }

    .box .card-footer {
        min-height: 35px;
    }

    /*table*/
    .table-light th,
    .table-light td,
    .table-light thead th,
    .table-light tbody+tbody {
        background-color: #f7f7f7;
        color: #8898aa;
        font-weight: 500;
        border-bottom: 1px solid #e9ecef;
    }

    .form-check-input {
        position: relative;
        margin-top: 0;
    }

    .table-hover>tbody>tr:hover>* {
        --bs-table-accent-bg: var(--bs-table-hover-bg);
        color: var(--bs-table-hover-color);
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid;
        border-top-color: #f0f2f5;
    }
    .stockcs .table th,
    .stockcs .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-bottom: 1px solid;
        border-bottom-color: #f0f2f5;
        vertical-align: middle;
    }


    /*.table th, .table td {
    vertical-align: middle;
    }*/

    .table-light .th-date {
        width: 100px;
    }

    .table-light .th-status {
        width: 120px;
    }
    .table-light th {
        border-top: unset !important;
        border-top-color: unset !important;
        border-bottom: unset !important;
        border-bottom-color: unset !important;
    }


    .stock-list,
    .reject-list,
    .card-list,
    .tranfer-list,
    .job-list,
    .job-progress-list {
        overflow-y: auto;
        /* min-height: 200px; */
        max-height: 500px;
        height: 500px;
    }

    .table-responsive {
        overflow: auto;
        height: 500px;
    }

    .table-responsive thead th {
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .cs-list {
        overflow-y: scroll;
    }

    .cs-list .pd-0 td {
        padding: 0;
    }

    .cs-list .pd-0 td:last-child {
        padding: 5px 10px;
    }

    .cs-list .pd-0 .form-control {
        border-radius: 0rem;
        border: 0px solid #d8dbe0;
    }

    .cs-list th,
    .cs-list td {
        padding: 0.3rem;
        width: 80px;
        vertical-align: middle !important;
    }

    .design-stock-list {
        max-width: 580px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .vr {
        display: inline-block;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 1px;
        min-height: 1em;
        background-color: currentColor;
        opacity: 0.25;
        margin-right: 10px;
        margin-left: 10px;
    }

    .dot {
        width: 0.625rem;
        height: 0.625rem;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.5rem;
    }

    .border-left {
        border-width: 0 1px;
        border-left: 1px solid;
    }

    .file-thumbnail {
        height: 2.50rem;
        width: 2.50rem;
        border-radius: 4px;
    }

    .flex-between-center {
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }


    .flex-between-baseline {
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: baseline;
    }

    .btn-send {
        padding: 0.375rem 1.75rem;
    }

    .btn-primary[disabled]:hover {
        cursor: not-allowed;
        background-color: #3f6ad8 !important;
    }

    .col-auto {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        width: auto;
    }

    .progress-thin {
        height: 4px;
    }

    .fw-semibold {
        font-weight: 600 !important;
    }

    .fs-4 {
        font-size: 1.5rem !important;
    }

    .bg-light {
        background-color: #edf2f9 !important;
    }


    .box-created .number,
    .box-created .total {
        color: #0d6efd;
    }

    .box-created .card-footer,
    .btn-created {
        background-color: #cfe2ff;
        width: 100%;
    }

    .btn-created:hover {
        background-color: #99c2ff;
    }

    .box-created .progress-bar {
        background-color: #0d6efd;
    }

    .box-created02 .number,
    .box-created .total {
        color: #f58344;
    }

    .box-created02 .card-footer {
        background-color: #fef0e8;
    }

    .box-created02 .progress-bar {
        background-color: #f58344;
    }

    .box-finish .number,
    .box-finish .total,
    .box-online .number,
    .box-online .total {
        color: #35b653;
    }

    .box-finish .card-footer,
    .box-online .card-footer,
    .btn-online {
        background-color: #d7f0dd;
        width: 100%;
    }

    .box-finish .progress-bar,
    .box-online .progress-bar {
        background-color: #35b653;
    }

    .box-edit .number,
    .box-edit .total {
        color: #4650dd;
    }

    .box-edit .card-footer,
    .btn-edit,
    .btn-edit {
        background-color: #dadcf8;
        width: 100%;
    }

    .btn-edit:hover {
        background-color: #a6abf7;
    }

    .box-edit .progress-bar {
        background-color: #4650dd;
    }

    .box-reject .number,
    .box-reject .total {
        color: #dc3545;
    }

    .box-reject .card-body {
        background-color: #ffffff;
    }

    .box-reject .card-footer {
        background-color: #f8d7da;
    }

    .box-reject .progress-bar {
        background-color: #dc3545;
    }

    .box-reject .bg-danger {
        background-color: #dc3545
    }

    .box-booking .number,
    .box-booking .total {
        color: #ffc107;
    }

    .box-booking .card-footer,
    .btn-design {
        background-color: #fff3cd;
        width: 100%;
    }

    .btn-design:hover {
        background-color: #ffe799;
    }

    .box-booking .progress-bar {
        background-color: #ffc107;
    }

    .btn-falcon-default {
        color: #4d5969;
        background-color: #fff;
        border-color: 0 0 0 1px rgba(43, 45, 80, 0.1), 0 2px 5px 0 rgba(43, 45, 80, 0.08), 0 1px 1.5px 0 rgba(0, 0, 0, 0.07), 0 1px 2px 0 rgba(0, 0, 0, 0.08) !important;
        box-shadow: 0 0 0 1px rgba(43, 45, 80, 0.1), 0 2px 5px 0 rgba(43, 45, 80, 0.08), 0 1px 1.5px 0 rgba(0, 0, 0, 0.07), 0 1px 2px 0 rgba(0, 0, 0, 0.08) !important;
    }

    .box-card .number,
    .box-card .total {
        color: #5e6e82;
    }

    .box-card .card-body {
        background-color: #ffffff;
    }

    .box-card .card-footer {
        background-color: #ebedef;
    }

    .box-card .progress-bar {
        background-color: #2c7be5;
    }


    .box-kpi .number,
    .box-kpi .total {
        color: #e55353;
    }

    .box-kpi .card-body {
        background-color: #ffffff;
    }

    .box-kpi .card-footer {
        background-color: #ebedef;
    }

    .box-kpi .progress-bar {
        background-color: #e55353;
    }

    .box-card .badge {
        padding: 4px 8px;
    }
    /* .badge-close{
        font-size: 18px;
        padding: 0 !important;
        display: block;
        width: 30px;
        height: 30px;
        border-radius: 30px !important;
        display: flex;
        justify-content: center;
        align-items: center;
    } */
    .badge-close {
        position: absolute;
        right: -5px;
        top: -5px;
        display: flex;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-header .badge-close{
        right: 8px !important;
        top: 8px !important;
    }
    .badge-close-lg{
        font-size: 18px !important;
        border-radius: 30px !important;
        width: 28px !important;
        height: 28px !important;
    }
    /*btn--------------------------------*/

    .btn-primary {
        color: #fff;
        background-color: #3f6ad8;
        border-color: #3f6ad8;
    }

    .input-group .btn-dark {
        margin-left: -1px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .btn-none {
        background-color: #ffffff;
        width: 100%;
    }

    .send-to {
        color: #1f2937;
        background-color: #f0bc74;
        border-color: #f0bc74;
        box-shadow: inset 0 1px 0 rgb(255 255 255 / 15%), 0 1px 1px rgb(17 24 39 / 8%);
    }

    .step4_bar {
        -webkit-transition: background-color 250ms ease-out;
        -moz-transition: background-color 250ms ease-out;
        -o-transition: background-color 250ms ease-out;
        transition: background-color 250ms ease-out;
    }

    .progress-success {
        color: #00864e;
        background-color: #ccf6e4;
        padding: 2px;
        width: 100%;
        font-size: 10px;
        font-weight: 500;
        cursor: pointer;
    }

    .progress-warning {
        color: #404040;
        background-color: #f9b115;
        padding: 2px;
        width: 100%;
        font-size: 10px;
        font-weight: 500;
        cursor: pointer;
    }

    .progress-danger {
        color: #e55353;
        background-color: #f8d7da;
        padding: 2px;
        width: 100%;
        font-size: 10px;
        font-weight: 500;
        cursor: pointer;
    }

    .progress-none {
        color: #7d899b;
        background-color: #e3e6ea;
        padding: 2px;
        width: 100%;
        font-size: 10px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-falcon-default {
        color: #404a57;
        box-shadow: 0 0 0 1px rgba(43, 45, 80, 0.1), 0 2px 5px 0 rgba(43, 45, 80, 0.1), 0 3px 9px 0 rgba(43, 45, 80, 0.08), 0 1px 1.5px 0 rgba(0, 0, 0, 0.08), 0 1px 2px 0 rgba(0, 0, 0, 0.08);
    }

    /*pagination--------------------------------*/
    .pagination.pagination-primary .page-item.active .page-link {
        background-color: #435ebe;
        border-color: #435ebe;
        box-shadow: 0 2px 5px rgb(67 94 190 / 30%);
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #435ebe;
        border-color: #435ebe;
    }

    .text-gray {
        color: #adb5bd;
    }


    .text-primary {
        color: #4650dd !important;
    }

    .box-step {
        padding: 5px;
        border-radius: 0.25rem;
        color: #4d5969;
        background-color: #fff;
        border-color: 0 0 0 1px rgba(43, 45, 80, 0.1), 0 2px 5px 0 rgba(43, 45, 80, 0.08), 0 1px 1.5px 0 rgba(0, 0, 0, 0.07), 0 1px 2px 0 rgba(0, 0, 0, 0.08);
        box-shadow: 0 0 0 1px rgba(43, 45, 80, 0.1), 0 2px 5px 0 rgba(43, 45, 80, 0.08), 0 1px 1.5px 0 rgba(0, 0, 0, 0.07), 0 1px 2px 0 rgba(0, 0, 0, 0.08);
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .box-step:hover {
        /*background-color: #f6f9fc;*/
        cursor: pointer;
        box-shadow: 0 0 0 1px rgba(43, 45, 80, 0.1), 0 2px 5px 0 rgba(43, 45, 80, 0.1), 0 3px 9px 0 rgba(43, 45, 80, 0.08), 0 1px 1.5px 0 rgba(0, 0, 0, 0.08), 0 1px 2px 0 rgba(0, 0, 0, 0.08);
    }

    .badge-primary-light {
        color: #4650dd;
        background-color: #d9dbff;
        border-radius: 50rem !important;
        padding: 4px 10px;
    }


    .badge-danger-light {
        color: #e55353;
        background-color: #f8d7da;
        border-radius: 50rem !important;
        padding: 4px 10px;
    }

    .badge-soft-success {
        color: #00864e;
        background-color: #ccf6e4;
    }

    #my-jobs .badge {
        padding: 5px 8px;
        border-radius: 10px;
    }

    #my-jobs .badge-success {
        color: #00864e;
        background-color: #ccf6e4;
    }

    #my-jobs .badge-warning {
        color: #a47000;
        background-color: #ffdd96;
    }

    #my-jobs .badge-danger {
        color: #a54456;
        background-color: #fad7dd;
    }

    #my-jobs .badge-info {
        color: #1c6ab8;
        background-color: #a6d3ff;
    }

    .cursor{
      cursor: pointer;
  }

  .inbox-link {
    padding: 2px;
    color: #4f5d73;
    border: solid 1px #d8e2ef;
}

.inbox-link:hover {
    color: #4f5d73;
    background-color: #ffffff;
    text-decoration: none;
    box-shadow: 0 1px 1px 0 rgb(60 75 100 / 14%), 0 2px 1px -1px rgb(60 75 100 / 12%), 0 1px 3px 0 rgb(60 75 100 / 20%);
}

.inbox-link i {
    color: #e63757;
    margin-right: 5px;
}

.badge-next-month {
    color: #768192;
    background-color: #ffffff;
    border-radius: 50rem !important;
    padding: 4px 10px;
}

.badge-orange {
    color: #fff;
    background-color: #ff7600;
}


.box-activity .avatar {
    display: inline-block;
    position: relative;
    width: 3rem;
    height: 3rem;
    text-align: center;
    border: #dee2e6;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
    line-height: 3rem;
}

.box-activity .card-body {
    overflow-y: scroll;
    min-height: 400px;
    max-height: 400px;
    height: 100%;
}

.box-activity a {
    color: #3c4b64;
}

.box-activity .list-group-timeline .list-group-item::before {
    content: "";
    position: absolute;
    top: 0;
    left: 4px;
    height: 100%;
    /* border-left: 2px solid #e5e7eb; */
    border-left: 2px solid #dbe7ff;

}

.box-activity .list-group-timeline .list-group-item::after {
    content: "";
    position: absolute;
    top: 15px;
    left: 8px;
    width: 10px;
    height: 10px;
    margin-top: 0.425rem;
    margin-left: -0.5rem;
        /* border: 2px solid #e5e7eb;
        background: #fff; */
        border: 2px solid #a4bcf7;
        background: #a4bcf7;
        border-radius: 0.5rem;
    }

    .team-member .list-group-item {
        cursor: pointer;
    }

    .team-member li.active {
        color: #321fdb;
        background-color: unset !important;
        border-color: #321fdb;
    }

    .box-activity .position {
        padding: 5px 0px;
    }

    .card-members {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid transparent;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -1px rgb(0 0 0 / 6%);
        margin-bottom: 30px;
    }

    .box-activity .card-header {
        border-radius: 1rem 1rem 0rem 0rem !important;
    }

    .box-activity img {
        width: 2.5rem;
        height: 2.5rem;
    }

    .box-activity .icon-shape-purple {
        color: #7c3aed;
        background-color: rgba(124, 58, 237, .3);
    }

    .box-activity .icon-shape {
        width: 4rem;
        height: 4rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .box-activity .list-group-timeline {
        /* height: 300px; */
        overflow: hidden;
        overflow-y: auto;
    }

    .box-activity .list-group-item {
        padding: 0.2rem 0rem 0.2rem 1.25rem;
    }

    .cs-Search {
        width: 100% !important;
    }

    .btn i,
    .btn .c-icon {
        margin: unset !important;
    }

    .m-w130 {
        max-width: 130px !important;
    }

    .m-w200 {
        max-width: 200px !important;
    }

    .m-w300 {
        max-width: 300px !important;
    }

    p.cp-name {
        /* max-width: 215px; */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .blog-name {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        /* width: 400px;  */
        max-width: 800px;
    }

    .td-booking {
        width: 100px;
    }

    .booking-remove {}

    @media (min-width: 1200px) {
        .modal-full {
            max-width: 97vw;
        }
    }

    .user-position.active:hover,
    .receiver.active:hover {
        color: whitesmoke !important;
    }

    .user-position.active,
    .receiver.active {
        color: whitesmoke !important;
        background-color: #435ebe !important;
    }

    span.item-text {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    tr.tr {
        cursor: pointer;
    }

    tr.selected {
        /* color: blueviolet;
        background-color: #f5f3fd; */
        color: #04c;
        background-color: #d6e0fd;

    }

    .table-hover tbody tr.selected:hover {
        background-color: #d6e0fd;
    }

    .job-focus {
        background-color: rgba(255, 221, 150, 1) !important;
    }

    .custom-file-label.selected {
        overflow: hidden;
    }
    .badge-info .badge-close{
        position: absolute;
        top: -10px;
        right: -2px;
        color: #1c6ab8 !important;
        background-color: #a6d3ff !important;
        border-radius: 50%;
        display: flex;
        padding: 2px;
        width: 16px;
        height: 16px;
        border: 1px solid;
        align-content: center;
        justify-content: center;
    }
    .badge-success .badge-close{
        position: absolute;
        top: -10px;
        right: -2px;
        color: #00864e !important;
        background-color: #ccf6e4 !important;
        border-radius: 50%;
        display: flex;
        padding: 2px;
        width: 16px;
        height: 16px;
        border: 1px solid;
        align-content: center;
        justify-content: center;
    }
    .badge-warning .badge-close{
        position: absolute;
        top: -10px;
        right: -2px;
        color: #a47000 !important;
        background-color: #ffdd96 !important;
        border-radius: 50%;
        display: flex;
        padding: 2px;
        width: 16px;
        height: 16px;
        border: 1px solid;
        align-content: center;
        justify-content: center;
    }
    .badge-close:hover{
        text-decoration: none;
    }
    .badge-close:active {
        box-shadow: 0 0 0 2px #96dbad;
    }
    .border-top-info{
        border-color:#1c6ab8 !important;
    }
    .border-top-success{
        border-color:#00864e !important;
    }
    .border-top-warning{
        border-color:#a47000 !important;
    }
    .ss-main.error .ss-single-selected,
    .ss-main.error .ss-multi-selected{
        border-color: #d21515 !important;
    }
    .ss-main.error .ss-multi-selected:active,
    .ss-main.error .ss-single-selected:active{
        box-shadow: 0 0 0 0.2rem rgba(229,83,83,.25);
    }
    .pin-comment,
    .row-comment{
        margin-bottom:15px;
    }
    
    .badge-shadow{
        box-shadow: 0 0 2px 1px #dddddd;
    }
    .comment-body{
        display: flex;
        align-items: center;
    }
    .comment-body .comment{
        cursor: pointer;
    }
    .comment{
        position: relative;
        display: block;
        padding: 3px 11px;
        border-radius: 20px;
        width: fit-content;
    }
    .pin-comment .comment .fa-thumbtack{
        position: absolute;
        left: 9px;
        top: 7px;
    }
    .comment .pin-remove{
        position: absolute;
        top: -14px;
        right: 0;
        display: none;
    }
    .comment:hover .pin-remove{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .comment-primary{
        color: #321fdb;
        background-color: #321fdb1f;
    }
    .comment-light{
        color: #4f5d73;
        background-color: #ebedef;
    }
    .comment-info{
        background-color: #39f ;
        color: #fff;
    }
    .comment-warning {
        color: #8b6f00;
        background-color: #fff1ba;
    }
    .my-comment .comment-header{
        display: flex;
    }
    .my-comment .comment-body,
    .my-comment .comment-header
    {
        justify-content: flex-end;
    }
    .comment .pin-item{
        display: none;
        position: absolute;
    }
    .comment:hover .pin-item{
        display: block;
    }
    .menu-comment{
        background-color: #fff;
        position: absolute;
        display: grid;
        top: 35px;
        padding: 10px 0;
        border-radius: 15px;
        z-index: 100;
        border: 1px solid #dedede;
    }
    .menu-comment::before
    {
        content: "\A";
        border-style: solid;
        border-width: 9px 9px 9px 9px;
        border-color: transparent transparent #dedede transparent;
        position: absolute;
        left: 15px;
        top: -19px;
    }
    .menu-comment::after
    {
        content: "\A";
        border-style: solid;
        border-width: 9px 9px 9px 9px;
        border-color: transparent transparent #fff transparent;
        position: absolute;
        left: 15px;
        top: -18px;
    }
    .menu-body{
        overflow: 'hidden';
    }
    
    .menu-comment a.menu-item{
        display: block;
        color: dimgray;
        padding: 5px 15px;
        text-decoration: none;
        min-width: 160px;
    }
    .menu-comment a.menu-item:hover{
        color: rgb(53, 53, 53);
        background-color: #ebedef;
        text-decoration: none;
    }
    .arrow-up {
        content:"\A";
        width: 0; 
        height: 0; 
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 5px solid black;
    }
    .menu-comment .menu-close{
        position: absolute;
        right: -5px;
        top: -5px;
        display: flex;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .comment-card{
        border-radius: 15px;
        border: 1px solid #d8dbe0;
    }
    .newComment{
        width: 100%;
        overflow: hidden;
        border-radius: 15px;
        background-color: #ebedef;
    }
    .newComment .new-comment-body{
        width: 100%;
        height: 100%;
        outline: none;
        max-height: 80px;
        overflow-y: auto;
        cursor: text;
        padding: 5px 15px;
        border: none;
        line-height: 1.5;
        color: #4f5d73;
        resize: unset;
    }
    .newComment .new-comment-body::-webkit-scrollbar,
    .row-comment::-webkit-scrollbar{
        width: 10px;
        border-radius: 10px;
    }
    .newComment .new-comment-body::-webkit-scrollbar-track,
    .row-comment::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    /* Handle */
    .newComment .new-comment-body::-webkit-scrollbar-thumb,
    .row-comment::-webkit-scrollbar-thumb {
        background: #c1c0c0;
        border-radius: 10px;
    }

    /* Handle on hover */
    .newComment .new-comment-body::-webkit-scrollbar-thumb:hover ,
    .row-comment::-webkit-scrollbar-thumb:hover{
        background: #9b9b9b;
        border-radius: 10px;
    }
    .btn-new-comment:hover{
        text-decoration: none;
    }
    .table .thead-ultralight th {
        color: #768192;
        background-color: #f1f1f1;
        border-color: #d8dbe0;
    }
    .fs-10{ font-size:10px !important; }
    .fs-11{ font-size: 11px !important; }
    .fs-12{ font-size: 12px !important; }
    .fs-13{ font-size: 13px !important; }
    .fs-14{ font-size: 14px !important; }
    .fs-16{ font-size: 16px !important; }
    .fs-18{ font-size: 18px !important; }
    .fs-20{ font-size: 20px !important; }
    .fs-22{ font-size: 22px !important; }

    .border-dark{
        border: 1px solid !important;
        border-color: #969eab !important;
    }
    .br{
        border-radius: 7px;
    }
    .br-2x{
        border-radius: 15px;
    }
    .br-3x{
        border-radius: 20px !important;
    }
    .rt-30{
        transform: rotate(-30deg);
    }
    .rt-45{
        transform: rotate(-45deg);
    }
    .rt30{
        transform: rotate(30deg);
    }
    .rt45{
        transform: rotate(45deg);
    }
    .loader-mini {
        width: 20px;
        height: 20px;
        border: 4px solid #c4c5c6;
        border-bottom-color: #4c4f54;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    .loader{
        width: 48px;
        height: 48px;
        border: 6px solid #c4c5c6;
        border-bottom-color: #4c4f54;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    .loader-xs{
        width: 14px;
        height: 14px;
        border: 3px solid #f0f3fc;
        border-bottom-color: red;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }
    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    .draggable-handle{
        cursor: move;
    }
    .pdf-row{
        display: grid;
        gap: 10px;
        grid-auto-columns: 1fr;
        grid-row-gap: 15px;
        grid-template-areas: ".";
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto;
    }
    .pdf-detail{
        padding-left:10px;
        width: 100%;
    }
    .pdf-item{
        min-width: 200px;
        padding: 15px;
        border-radius: 15px;
    }
    .pdf-item{
        position: relative;
    }
    a.pdf-remove{
        position: absolute;
        top: 5px;
        right: 5px;
    }
    .pdf-item .pdf-name {
        font-size: 14px;
        font-weight: bold;
        color: #636f83;
    }
    a.pdf-preview:hover{
        text-decoration: none;
    }
    .pdf-name {
        margin: 0;.
        padding: 0;
    }
    .progress-percent{
        font-size: 12px;
    }
    .pdf-size{
        font-size: 11px;
        font-weight: bold;
    }
    html:not([dir=rtl]) .input-group-append {
        z-index: 0;
    }
    .row-comment{
        max-height: 75vh;
        overflow-y: auto;
        padding-right: 5px;
    }
    .fs-14px{
        font-size: 14px;
    }
    a.user{
        height: 24px;
        width: 24px;
        color: #fff;
        font-size: 12px;
        font-weight: 400;
        border-radius: 50%;
        overflow: hidden;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    a.user-sm{
        height: 20px !important;
        width: 20px !important;
    }
    a.user:hover{
        text-decoration: none;
    }
    .modal-tooltip {
        z-index: 100000000; 
    }
    .on-process-action a.edit-process{
        top: -12px;
        right: 0;
        display: none;
        box-shadow: 0 0 2px 1px #3b3b3b;
    }
    .on-process-action:hover a.edit-process{
        display: block;
        width: 16px;
        height: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        /* background-color: #a6d3ff; */
    }
    span.send-email.edit,
    span.cannot-contact.edit,
    span.follow.edit,
    span.no-reponse.edit,
    span.refuse.edit,
    span.call-again.edit
    {
        cursor:pointer;
    }
    .remark,
    .rank{
        display: block;
        width: 24px; 
        height: 24px; 
        border: 1px solid #d8dbe0; 
        border-radius: 30px;
    }
    .dropdown-item .remark,
    .dropdown-item .rank{
        width: 18px !important; 
        height: 18px !important; 
    }
    .remark.default,
    .rank.default { 
        background-color: #d8dbe0;
    }
    .badge-color{
        display: block;
        width: 20px !important;
        height: 20px !important;
        border-radius: 20px !important;
    }
    .remark.monday,
    .badge-color.monday{ 
        background-color: var(--monday-color);
    }
    .remark.tuesday,
    .badge-color.tuesday{ 
        background-color: var(--tuesday-color);
    }
    .remark.wednesday,
    .badge-color.wednesday{ 
        background-color: var(--wednesday-color);
    }
    .remark.thursday,
    .badge-color.thursday { 
        background-color: var(--thursday-color);
    }
    .remark.friday,
    .badge-color.friday{ 
        background-color: var(--friday-color);
    }
    .remark.saturday,
    .badge-color.saturday{ 
        background-color: var(--saturday-color);
    }
    .remark.sunday,
    .badge-color.sunday{ 
        background-color: var(--sunday-color);
    }
    .navigate{
        z-index: 100;
        right: 2px;
        display: flex;
        flex-direction: column;
    }
    .navigate .navigate-more,
    .navigate .navigate-item{
        font-weight: bold;
        width: 26px;
        height: 26px;
        border-radius: 25px !important;
        margin: 0 0 5px 0;
        border: 1px solid #bbbbbb;
        display: flex;
        justify-content: center;
        align-items: center;
        color:  #6f6f6f;
        text-decoration: none;
        position: relative;
        box-shadow: 0 0 3px 1px #cfcdcd;
    }
    .navigate-item.more{
        display: none;
    }
    .navigate-item.less{
        display: flex;
    }
    .btn-white{
        background-color: #fff;
    }
    .text-dark-blue{
        color:#1c6ab8;
    }
    /* .edit-group{
        border: 3px solid transparent;
    } */
    .edit-group.editing{
        box-shadow: 0 0 0 0.2rem rgba(50, 31, 219, .25);
        border-radius: 13px;
        overflow: hidden;
        background-color: #fff;
    }
    .edit[contenteditable="false"]{
        outline: none;
    }
    .edit-panel{
        overflow: hidden;
        display: flex;
        visibility: hidden
    }
    .editing .edit-panel{
        visibility:visible;
    }
    .edit-btn{
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        transition: color .15s ease-in-out, 
            background-color .15s ease-in-out, 
            border-color .15s ease-in-out, 
            box-shadow .15s ease-in-out;
    }
    .edit-btn:hover{
        color: unset;
        text-decoration: none;
    }
    .edit-cancel{
        color: #4f5d73;
        background-color: #ced2d8;
    }
    .edit-save{
        color: #a47000;
        background-color: #ffdd96;
    }
    .revise{
        position: relative;
        border-radius: 10px;
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: center;
        width: 100%;
        background-color: #FFCB77;
        color:#a16400;
        height: 24px;
        font-size: 11px;
        cursor: pointer;
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }
    .revise:hover{
        text-decoration: none;
        color:#000;
    }
    .revise.show{
        border-bottom-left-radius: unset;
        border-bottom-right-radius: unset;
    }
    .revise.show .revise-dropdown{
        display: grid !important;
        width: 100%;
        padding: 5px 0;
        border-top: 1px solid #a16400;
        box-shadow: 0 1px 0px 0px #a1640054;
        z-index: 2;
    }
    .revise i{
        transition: all 0.1s ease-in-out;
    }
    .revise.show i{
        transition: all 0.1s ease-in-out;
        transform: rotate(90deg);
    }
    .revise-dropdown{
        display: none;
        position: absolute;
        top:24px;
        background-color: #FFCB77;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        
    }
    /* .revise-dropdown.show{
        display: grid !important;
        width: -webkit-fill-available;
    } */

    .revise-item{
        color: #7e7e7e;
        padding: 1px 5px;
        justify-items:start;
        font-size: 11px;
        overflow: hidden; 
        white-space: nowrap;
        text-overflow: ellipsis;
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }
    .revise-item:hover{ text-decoration: none; color: #000;}
    .revise-content,
    .revise-design{
        height: 100%;
    }

    .package{
        position: relative;
        border-radius: 10px;
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: center;
        width: 100%;
        background-color: #ebedef;
        color: #5e5e5e;
        height: 24px;
        font-size: 11px;
        cursor: pointer;
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }
    .return{
        position: relative;
        border-radius: 10px;
        width: 100%;
        background-color: #ebedef;
        color: #5e5e5e;
        font-size: 11px;
        cursor: pointer;
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }
    .return .return-label{
        display: flex;
        justify-content: space-between;
        padding: 5px;
    }
    .package span,
    .return span{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 60px;
    }
    .package:hover,
    .return:hover{
        text-decoration: none;
        color:#000;
    }
    .package.show,
    .return.show{
        border-bottom-left-radius: unset;
        border-bottom-right-radius: unset;
    }
    .package.show .package-dropdown,
    .return.show .return-dropdown{
        display: grid !important;
        width: 100%;
        padding: 5px 0;
        border-top: 1px solid #9b9b9b;
        box-shadow: 0 1px 0px 0px #70707054;
        overflow: hidden;
        z-index: 2;
    }
    .package-dropdown,
    .return-dropdown{
        display: none;
        position: absolute;
        top:24px;
        background-color: #ebedef;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .return-dropdown{
        top:27px !important;
    }
    .package-item,
    .return-item{
        color: #5e5e5e;
        padding: 1px 5px;
        text-align: left;
        font-size: 11px;
        overflow: hidden; 
        white-space: nowrap;
        text-overflow: ellipsis;
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }
    .package-item:hover,.return-item:hover{ text-decoration: none; color: #000;}
    .package-content,
    .package-design{
        height: 100%;
    }
    .mw-375{
        max-width: 375px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    .table-responsive table{
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-responsive thead .last-child th {
        top: 25px;
        position: sticky;
    }
    .badge-revise{
        background-color: #FFCB77 !important;;
        color: #a16400 !important;
    }
    .badge-comment{
        background-color: var(--lightpink) !important;;
        color: var(--darkblue) !important;
    }
    .badge-assignment{
        background-color: var(--lightpurple) !important;;
        color: var(--darkblue) !important;
    }
    .title-success{
        display: flex;
        align-items: center;
        padding: 0 12px 2px 12px;
        border-radius: 20px;
        background-color:var(--lightgreen)
    }
    .br-15{
        border-radius: 15px;
    }
    .br-l-15{
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }
    .br-r-15{
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .hr-light{
        border-color: #f0f2f5;
    }
    .text-lightpink{
        color: var(--lightpink);
    }
    .bg-lightpink{
        background-color: var(--lightpink);
    }
    .btn-lightpink{
        color: var(--pink);
        background-color: var(--lightpink);
        box-shadow: unset !important;
    }
    .badge-lightpink{
        color: var(--darkpink);
        background-color: var(--lightpink);
    }
    .badge-lightpink:hover{
        color: var(--darkpink);
    }
    .btn-lightpink:hover{
        color: var(--darkpink);
    }
    .badge.badge-lightpink:focus-within,
    .btn.btn-lightpink:focus{
        box-shadow: 0 0 0 0.2rem rgba(229, 83, 149, 0.5) !important;
    }
    .btn-outline-lightpink{
        color: var(--lightpink);
        border:1px solid var(--lightpink);
        background-color: transparent;
    }
    .btn-outline-lightpink:hover{
        color: white;
        background-color: var(--lightpink);
    }
    .filter_category{
        width: 180px !important;
    }
    .user-assignment{
        padding: 0 !important;
        display: flex;
        /* margin: 2px 0; */
        width: 29px;
        height: 29px !important;
        align-items: center;
        justify-content: center;
        height: -webkit-fill-available;
    }
    .appointment-content{
        border: 3px solid #dedede;
        border-radius: 15px;
    }
    .appointment-ol{
        margin-bottom: 0;
    }
    .appointment-li a{
        display: none;
    }
    .appointment-li:hover a{
        display: initial;
    }
    .appointment-content.border-md{
        border: 2px solid #dedede;
        border-radius: 15px;
    }
    /* div.appointment-list{
        border: 1px solid #dedede;
        border-radius: 5px;
        overflow: hidden;
        overflow-y: auto;
        height: 75px;
    } */
    ol.appointment-list{
        padding-inline-start: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    ul.appointment-list{
        margin: 0;
        padding: 2px 0;
        list-style-type:none;
        overflow: hidden;
        overflow-y: auto;
        height: 55px;
    }
    .appointment-item{
        font-size: 12px;
        text-align: start;
    }
    ul.appointment-list::-webkit-scrollbar{
        width: 5px;
    }
    ul.appointment-list::-webkit-scrollbar-thumb{
        border-radius: 15px;
        background: #dedede;
    }
    .xy-14{
        width: 14px;
        height: 14px;
    }
    th.rotate-45 {
        /* Something you can count on */
        white-space: nowrap;
    }

    th .rotate-45{
        display: flex;
        align-items: center;
        writing-mode: vertical-rl;
        -ms-writing-mode: vertical-rl;
        -webkit-writing-mode: vertical-rl;
        width: -webkit-fill-available;

    }
    .ucfirst::first-letter {
        text-transform: capitalize;
    }
    .contract-list .contract-date{
        display: none;
    }
    .contract-list:hover .contract-date{
        display: block;
    }

</style>

@php
function kpiColor($kpi, $goal)
{
    if ($kpi < $goal) {
        return 'badge-danger';
    } elseif ($kpi > $goal) {
        return 'badge-success';
    } else {
        return 'badge-secondary';
    }
}
@endphp
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="back-end/build/paginattion-myjob.js?v=05"></script>
<script src="back-end/build/draggable.js"></script>
<div id="my-jobs">
    {{-- <div class="position-fixed navigate">
        <a href="javascript:stock-company" class="btn btn-link btn-white navigate-item" data-title="Stock Company Profile List" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">1</a>
        <a href="javascript:waiting-for-create" class="btn btn-link btn-white navigate-item" data-title="Waiting For Create" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">2</a>
        <a href="javascript:waiting-for-revise" class="btn btn-link btn-white navigate-item" data-title="Waiting For Revise" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">3</a>
        <a href="javascript:on-process" class="btn btn-link btn-white navigate-item" data-title="On Process" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">4</a>
        <a href="javascript:complete-on-process" class="btn btn-link btn-white navigate-item more" data-title="Complete" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">5</a>
        <a href="javascript:appointment" class="btn btn-link btn-white navigate-item more" data-title="Appointment" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">6</a>
        <a href="javascript:presentation" class="btn btn-link btn-white navigate-item more" data-title="Presentation" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">7</a>
        <a href="javascript:customer-lists" class="btn btn-link btn-white navigate-item more" data-title="Customer List" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">8</a>
        <a href="javascript:not-interested" class="btn btn-link btn-white navigate-item more" data-title="Not Interested" onmouseover="setTitle(this)" onmouseout="removeTitle(this)">9</a>
        <a href="javascript:" class="btn btn-link btn-white navigate-more" title="more"><i class="fas fa-chevron-down fa-xs"></i></a>
    </div> --}}
    {{-- <script>
        var navigate = document.querySelector('.navigate');
        document.addEventListener('click',function(e){
            const navigateItem = e.target.closest('.navigate-item');
            if(navigateItem) {
                let element = navigateItem.getAttribute('href');
                console.log(document.querySelector(`.${element.replace('javascript:','')}`));
                document.querySelector(`.${element.replace('javascript:','')}`).scrollIntoView({ behavior: "smooth", block: "center", inline: "nearest" });
            }
            const navigateMore = e.target.closest('.navigate-more');
            if(navigateMore){
                let more = navigateMore.closest('.navigate').querySelectorAll('.more');
                let less = navigateMore.closest('.navigate').querySelectorAll('.less');
                if(more.length > 0) {
                    navigateMore.title = 'less'
                    navigateMore.innerHTML = '<i class="fas fa-chevron-up fa-xs"></i>';
                    more.forEach(el => {
                        toggleClass(el,'more less');
                    })
                }else{
                    less.forEach(el => {
                        toggleClass(el,'more less');
                    });
                    navigateMore.title = 'more'
                    navigateMore.innerHTML = '<i class="fas fa-chevron-down fa-xs"></i>';
                }
            }
        })
        function setTitle(el){
            if (!el.querySelector('.position-absolute')) {
                let title = document.createElement('div');
                title.setAttribute('class','position-absolute')
                title.setAttribute('style','width:max-content;right:36px;background-color:#fff;padding:2px 10px;border:1px solid #bbb;border-radius:15px;box-shadow: 0 0 3px 1px #cfcdcd;')
                title.innerHTML = `<p class="m-0">${el.getAttribute('data-title')}</p>`;
                el.append(title)
            }
        }
        function removeTitle(el){
            el.querySelector('.position-absolute').remove()
        }
    </script> --}}

    @php($user=Auth::user())
    <input type="hidden" name="user" value="{{$auth}}">
    <input type="hidden" name="user_id" value="{{$auth->id}}">
    <input type="hidden" name="user_name" value="{{$auth->name}}">

    {{-- @include('back-end.modules.job-progress.position.pages.1-stock-company')
    @include('back-end.modules.job-progress.position.pages.2-waiting-for-create')
    @include('back-end.modules.job-progress.position.pages.3-waiting-for-revise')
    @include('back-end.modules.job-progress.position.pages.4-on-process')
    @include('back-end.modules.job-progress.position.pages.5-complete')
    @include('back-end.modules.job-progress.position.pages.6-appointment')
    @include('back-end.modules.job-progress.position.pages.7-presentation')
    @include('back-end.modules.job-progress.position.pages.8-customer-list')
    @include('back-end.modules.job-progress.position.pages.9-not-interest') --}}

    {{-- Data Input --}}
    @if ($auth->role == 'developer' || $auth->name == 'NOT' || $auth->name == 'NATTAWAT' || $auth->name == 'TUM')
        @include('back-end.modules.job-progress.position.di')
    @endif

    {{-- Designer --}}
    @if ($auth->role == 'developer' || $auth->name == 'NATTAWAT' )
        @include('back-end.modules.job-progress.position.designer')
    @endif

    {{-- Blog  --}}
    @if (
        $auth->role == 'developer' ||
        $auth->name == 'WIN' ||
        $auth->name == 'BOOM' ||
        $auth->name == 'NOT' ||
        $auth->name == 'NATTAWAT')
        @include('back-end.modules.job-progress.position.blog')
    @endif

    {{-- Customer Service --}}
    @if(
        $auth->name == 'NAMFON'
        || $auth->name == 'JASMIN'
        || $auth->name == 'FERN'
    )
        @include('back-end.modules.job-progress.position.newmyjob')
    @endif

    @if (
    $auth->role == 'developer' ||
    // $auth->name == 'TUM' ||
    // $auth->name == 'MAY' ||
    $auth->name == 'BUM' ||
    $auth->name == 'PAIR'||
    $auth->name == 'NAMFON' ||
    $auth->name == 'BANANA' ||
    $auth->name == 'FERN' ||
    $auth->name == 'JASMINE' ||
    $auth->name == 'TEAM'
    )
    @include('back-end.modules.job-progress.position.cs')
    @endif

    {{-- Search Engine Optimization --}}
    @if ($auth->role == 'developer')
    @include('back-end.modules.job-progress.position.seo')
    @endif

    {{-- QC. --}}
    @if (
        $auth->role == 'developer' ||
        $auth->name == 'PAIR' ||
        $auth->name == 'TUM' ||
        $auth->name == 'MAY' ||
        $auth->name == 'TEAM'
    )
    @include('back-end.modules.job-progress.position.qc')
    @endif

 
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    var errorAlert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
        <strong>Opps!</strong> error has an occurred.\
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
        </button>\
        </div>');

    var successAlert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">\
        <strong>Yeah!</strong> your request is success.\
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
        </button>\
        </div>');

    const allDetail = $('.have-detail').length;
    const allNoDetail = $('.no-detail').length;
    const allEdit = $('.have-edit').length;
    const allNoEdit = $('.no-edit').length;

    $('.all-detail').html(allDetail);
    $('.all-no-detail').html(allNoDetail);
    $('.all-edit').html(allEdit);
    $('.all-not-edit').html(allNoEdit);

    const height = $('.box-finish').height();
    $('.box-reject').css({
        'height': height
    });
    $('#datepicker').datepicker({
        format: 'yyyy-mm-d',
        todayHighlight: true
    });
    $('#blog_date').datepicker({
        format: 'yyyy-mm-d',
        todayHighlight: true
    });
    $('#designer_date').datepicker({
        format: 'yyyy-mm-d',
        todayHighlight: true
    });
    $('#cs_date').datepicker({
        format: 'yyyy-mm-d',
        todayHighlight: true
    });

    $('#qc_blog_date').datepicker({
        format: 'yyyy-mm-d',
        todayHighlight: true
    });
    // $('#date').datepicker({
    //     format: 'yyyy-m-d',
    //     inline: true,
    //     sideBySide: true,
    //     todayHighlight:true
    // });
    $('.select-all').on('click', function() {
        if ($(this).is(':checked')) $('.forward').prop('checked', true);
        else $('.forward').prop('checked', false);
    });
    $(document).on('click', '.forward-to-designer', function() {
        let job_progress = $('.forward').map(function() {
            if ($(this).is(':checked')) return $(this).val();
        }).get();
        if (job_progress.length > 0) {
            job = job_progress.join();
            let from = $('select[name="user"]').val();

            from = (from == '') ? $('input[name="user_id"]').val() : from;
            Swal.fire({
                title: 'Forward',
                text: 'Confirm to forward the job or not?',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/forward/to/designer?from=${from}&job=${job}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: res.value.icon,
                        title: res.value.message,
                        toast: true,
                        timer: 2000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    })
                    setTimeout(() => {
                        location.reload();
                    }, 2300)
                }
            })
        }
    })
    $(document).on('change', '.all-booking', function() {
        let checked = false;
        if ($(this).is(':checked')) checked = true;
        else checked = false;
        $('.booking-list').prop('checked', checked);
        disabled = (checked === true) ? false : true;
        $('.designer-booking').prop('disabled', disabled)

    })
    $(document).on('change', '.booking-list', function() {
        if ($('.booking-list:checked').length <= 5) {
            let job = $('.booking-list:checked').map(function() {
                return $(this).val()
            }).get();
            disabled = (job.length > 0) ? false : true;
            $('.designer-booking').prop('disabled', disabled);
        } else {
            alert('')
            $(this).prop('checked', false);
        }

    })

    $(document).on('click', '.di-send-reject', function() {
        jobs = $('.reject-from-qc:checked').map(function() {
            return $(this).val()
        }).get();
        if (jobs.length > 0) {
            Swal.fire({
                title: 'Recheck',
                text: 'Forward the jobs to the QC to check again.',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/recheck?user=${user}&job=${job}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            })
        }
    })
    $(document).on('click', '.designer-booking', function() {
        let job_progress = $('.booking-list:checked').map(function() {
            return $(this).val()
        }).get();
        if (job_progress.length > 0) {
            job = job_progress.join();
            user = $('input[name="user_id"]').val();
            Swal.fire({
                title: 'Booking',
                text: 'Confirm to booking the job or not?',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/designer/booking?user=${user}&job=${job}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: res.value.icon,
                        title: res.value.message,
                        toast: true,
                        timer: 2000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        location.reload()
                    }, 2300);
                }
            });
        }
    });
    $(document).on('click', '.job-reject-attach', function() {
        const Modal = $('#designer-modal');
        let attach = $(this).attr('data-img');
        attach = JSON.parse(attach);
        Modal.find('img').remove();
        if (attach != '') {
            $.each(attach, function(k, v) {
                let img = $('<img src="" class="img-fluid">')
                img.attr('src', v.image);
                Modal.find('.attach').append(img);
            })
        }
        Modal.modal('show')
    })
    $(document).on('click', '.booking-remove', function() {
        let job = $(this).attr('job');
        Swal.fire({
            icon: 'warning',
            title: 'Remove',
            text: 'Confirm to remove from stock',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            preConfirm: (job_progress) => {
                return fetch(`webpanel/my-job/remove-from-stock/step3?job=${job}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    icon: res.value.icon,
                    title: res.value.message,
                    toast: true,
                    timer: 2000,
                    position: 'top',
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(() => {
                    location.reload();
                }, 2100)
            }
        });
    })
    var designerContentJobs = $('#designer-content-jobs');
    designerContentJobs.on('click', 'button.reset', function() {
        designerContentJobs.find('input[name="search"]').val('');
        SearchCompany(designerContentJobs)
    })
    designerContentJobs.on('keyup', "#booking-search", function() {
        SearchCompany(designerContentJobs)
    });
    const SearchCompany = (Card) => {
        var matcher = new RegExp(Card.find('input[name="search"]').val(), 'gi');
        Card.find('.cp-name').closest('tr').show().not(function() {
            return matcher.test($(this).find('.cp-name').text())
        }).hide();
    }

    $(document).on('change', '.all-forward', function() {
        let checked = false;
        if ($(this).is(':checked')) checked = true;
        else checked = false;
        $('.forward-list').prop('checked', checked);
        disabled = (checked === true) ? false : true;
        $('.forward-to-qc').prop('disabled', disabled);
    })
    $(document).on('change', '.forward-list', function() {
        let job = $('.forward-list:checked').map(function() {
            return $(this).val()
        }).get();
        let disabled = (job.length > 0) ? false : true;
        $('.forward-to-qc').prop('disabled', disabled);
    });
    $('.forward-to-qc').on('click', function() {
        let job_progress = $('.forward-list:checked').map(function() {
            return $(this).val()
        }).get();
        if (job_progress.length > 0) {
            job = job_progress.join();
            let from = $('select[name="user"]').val();
            from = (from == '') ? '{{ Auth::user()->id }}' : from;
            Swal.fire({
                title: 'Forward',
                text: 'Confirm to forward the job or not?',
                icon: 'warning',
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/forward/to/qc?from=${from}&job=${job}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: res.value.icon,
                        title: res.value.message,
                        toast: true,
                        timer: 2000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2100)
                }
            })
        }
    })

    //-- Blog --//
    $(document).on('change', '.blog-all-design', function() {
        let checked = false;
        if ($(this).is(':checked')) checked = true;
        $('.blog-to-design').prop('checked', checked);
        $('.blog-forward').prop('disabled', (checked == false) ? true : false);
    })
    $(document).on('click', '.blog-to-design', function() {
        let toDesigner = $('.blog-to-design:checked').map(function() {
            return $(this).val();
        }).get();
        let disabled = (toDesigner.length > 0) ? false : true;
        $('.blog-forward').prop('disabled', disabled);
    })

    $(document).on('change', '.blog-all-qc', function() {
        let checked = false;
        if ($(this).is(':checked')) checked = true;
        $('.blog-to-qc').prop('checked', checked);
        $('.blog-forward').prop('disabled', (checked == false) ? true : false);
    })
    $(document).on('click', '.blog-to-qc', function() {
        let toQc = $('.blog-to-qc:checked').map(function() {
            return $(this).val();
        }).get();
        let disabled = (toQc.length > 0) ? false : true;
        $('.blog-forward').prop('disabled', disabled);
    })

    $(document).on('click', '.blog-forward', function() {
        let forwardToDesign = $('.blog-to-design:checked').map(function() {
            return $(this).val()
        }).get();
        let forwardToQC = $('.blog-to-qc:checked').map(function() {
            return $(this).val()
        }).get();
        if (forwardToDesign.length > 0) {
            blog = forwardToDesign.join();
            from = $('input[name="user_id"]').val();
            Swal.fire({
                title: 'Forward',
                text: 'Confirm to forward the job or not',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(
                        `webpanel/my-job/forward/blog/to/designer?from=${from}&blog=${blog}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: res.value.icon,
                        title: res.value.message,
                        toast: true,
                        timer: 2000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        location.reload()
                    }, 2100);
                }
            })
        }
        if (forwardToQC.length > 0) {
            blog = forwardToQC.join();
            from = $('input[name="user_id"]').val();
            Swal.fire({
                title: 'Forward',
                text: 'Confirm to forward the job or not',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/forward/blog/to/qc?from=${from}&blog=${blog}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: res.value.icon,
                        title: res.value.message,
                        toast: true,
                        timer: 2000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        location.reload()
                    }, 2100);
                }
            })
        }
    })

    // cannot contact checkbox functions
    $(document).on('change','input[name="cannot_contact"]', function(e) {
        let cannotContact = $('input[name="cannot_contact"]:checked').map(function(){ return $(this).val(); }).get();
        if(cannotContact.length > 0){
            $('.btn-cannot-contact').removeClass('btn-default').addClass('btn-primary').removeAttr('disabled');
        }else{
            $('.btn-cannot-contact').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
        }
        $(document).on('click','.btn-cannot-contact',function(){
            id = cannotContact.join(',');
            console.log(id)
            Swal.fire({
                title: 'Cannot Contact',
                text: 'Confirm to change',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/cs/cannot-contact?id=${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        $(this).prop('checked', false);
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed)
                {
                    if(res.value.data.length > 0 )
                    {
                        res.value.data.map((v,k)=>{
                            cur = $(`input[name="cannot_contact"][value="${v.id}"]`);
                            let html = `<a href="javascript:0" class="cannot_contact" data-id="${v.id}"><small class="text-success">${v.changed}</small></a>`;
                            let td = cur.parent();
                            td.html('');
                            td.append(html)
                        });
                        $('.btn-cannot-contact').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
                    }
                }
            });
        })
    });

    $(document).on('click', 'a.cannot_contact', function(e) {
        let cur = $(this),
        id = cur.attr('data-id');
        Swal.fire({
            title: 'Cannot Contact',
            text: 'Confirm to change',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: (job_progress) => {
                return fetch(`webpanel/my-job/cs/cancel/cannot-contact?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    $(this).prop('checked', false);
                    Swal.showValidationMessage(`Request failed: ${error}`);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                let html = `<input type="checkbox" name="cannot_contact" class="checkbox" value="${res.value.id}">`;
                let td = $(this).parent();
                let group = $(this).closest('.checkbox-group');
                group.find('.checkbox').prop('disabled', false);
                td.html('');
                td.append(html);
            }
        });
    });

    // follow checkbox function
    $(document).on('change', 'input[name="follow"]', function(e) {
        let follow = $('input[name="follow"]:checked').map(function(){ return $(this).val() }).get();
        let id;
        if (follow.length > 0) {
            id = follow.join(',');
            $('.btn-follow').removeClass('btn-default').addClass('btn-primary').removeAttr('disabled');
        }else{
            $('.btn-follow').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
        }
        $(document).on('click','.btn-follow',function(){
            Swal.fire({
                title: 'Follow',
                text: 'Confirm to change',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/cs/follow?id=${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        $(this).prop('checked', false);
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed)
                {
                    if(res.value.data.length > 0 )
                    {
                        res.value.data.map((v,k) =>
                        {
                            cur = $(`input[name="follow"][value="${v.id}"]`);
                            let html = `<a href="javascript:0" class="follow" data-id="${v.id}"><small class="text-success">${v.changed}</small></a>`;
                            let td = cur.parent();
                            td.html('');
                            td.append(html);
                        });
                        $('.btn-follow').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
                    }
                }
            });
        })
    });

    $(document).on('click', 'a.follow', function(e) {
        let cur = $(this),
        id = cur.attr('data-id');
        Swal.fire({
            title: 'Cancel',
            text: 'Confirm to change',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: (job_progress) => {
                return fetch(`webpanel/my-job/cs/cancel/follow?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    $(this).prop('checked', false);
                    Swal.showValidationMessage(`Request failed: ${error}`);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                let html = `<input type="checkbox" name="follow" class="checkbox" value="${res.value.id}">`;
                let td = $(this).parent();
                let group = $(this).closest('.checkbox-group');
                group.find('.checkbox').prop('disabled', false);
                td.html('');
                td.append(html);
            }
        });
    });

    // no response checkbox function
    $(document).on('change', 'input[name="no_response"]', function(e) {
        let noResponse = $('input[name="no_response"]:checked').map(function(){ return $(this).val()}).get();
        let id;
        if (noResponse.length > 0 ) {
            id = noResponse.join(',');
            $('.btn-no-response').removeClass('btn-default').addClass('btn-primary').removeAttr('disabled');
        }else{
            $('.btn-no-response').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
        }
        $(document).on('click', '.btn-no-response', function(){
            Swal.fire({
                title: 'No Response',
                text: 'Confirm to change',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/cs/no-response?id=${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        $(this).prop('checked', false);
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed)
                {
                    if(res.value.data.length > 0 )
                    {
                        res.value.data.map((v,k) =>
                        {
                            cur = $(`input[name="no_response"][value="${v.id}"]`);
                            let html = `<a href="javascript:0" class="no_response" data-id="${v.id}"><small class="text-success">${v.changed}</small></a>`;
                            let td = cur.parent();
                            td.html('');
                            td.append(html);
                        });
                    }
                    $('.btn-no-response').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
                }
            });

        });
    });

    $(document).on('click', 'a.no_response', function(e) {
        let cur = $(this),
        id = cur.attr('data-id');
        Swal.fire({
            title: 'Cancel',
            text: 'Confirm to change',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: (job_progress) => {
                return fetch(`webpanel/my-job/cs/cancel/no-response?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    $(this).prop('checked', false);
                    Swal.showValidationMessage(`Request failed: ${error}`);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                let html = `<input type="checkbox" name="no_response" id="no_response" class="checkbox" value="${res.value.id}">`;
                let td = $(this).parent();
                let group = $(this).closest('.checkbox-group');
                group.find('.checkbox').prop('disabled', false);
                td.html('');
                td.append(html);
            }
        });
    });

    //check filter checkbox function
    $(document).on('change', 'input[name="check_filter"]', function(e) {
        let checkFilter = $('input[name="check_filter"]:checked').map(function(){ return $(this).val()}).get();
        let id;
        if (checkFilter.length > 0 ) {
            id = checkFilter.join(',');
            $('.btn-filter').removeClass('btn-default').addClass('btn-primary').removeAttr('disabled');
        }else{
            $('.btn-filter').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
        }
        $(document).on('click', '.btn-filter', function(){
            Swal.fire({
                title: 'Check Filter',
                text: 'Confirm to change',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (job_progress) => {
                    return fetch(`webpanel/my-job/cs/check-filter?id=${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        $(this).prop('checked', false);
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    })
                }
            }).then((res) => {
                if (res.isConfirmed)
                {
                    if(res.value.data.length > 0 )
                    {
                        res.value.data.map((v,k) =>
                        {
                            cur = $(`input[name="check_filter"][value="${v.id}"]`);
                            let html = `<a href="javascript:0" class="check_filter" data-id="${v.id}"><small class="text-success">${v.changed}</small></a>`;
                            let td = cur.parent();
                            td.html('');
                            td.append(html);
                        });
                    }
                    $('.btn-filter').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
                }
            });

        });
    });

    $(document).on('click', 'a.check_filter', function(e) {
        let cur = $(this),
        id = cur.attr('data-id');
        Swal.fire({
            title: 'Cancel',
            text: 'Confirm to change',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: (job_progress) => {
                return fetch(`webpanel/my-job/cs/cancel/check-filter?id=${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    $(this).prop('checked', false);
                    Swal.showValidationMessage(`Request failed: ${error}`);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                let html = `<input type="checkbox" name="check_filter" id="check_filter" class="checkbox" value="${res.value.id}">`;
                let td = $(this).parent();
                let group = $(this).closest('.checkbox-group');
                group.find('.checkbox').prop('disabled', false);
                td.html('');
                td.append(html);
            }
        });
    });

    $(document).on('change','input[name="license_refuse"]', function(e) {

        let cur = $(this);
        let refuse = $('input[name="license_refuse"]:checked').map(function(){return $(this).attr('data-id')}).get();
        let vals = $('input[name="license_refuse"]:checked').map(function(){return $(this).val()}).get();
        if (refuse.length > 0 ) {
            id = refuse.join(',');
            $('.btn-refuse').removeClass('btn-default').addClass('btn-primary').removeAttr('disabled');
        }else{
            $('.btn-refuse').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
        }
    })
    $(document).on('click','.btn-refuse',function(){
        let modal = $('#refuseModal');
        modal.find('#message').val('');
        modal.modal('show')
        modal.find('.confirmRefuse').on('click', function() {
            let refuse = $('input[name="license_refuse"]:checked').map(function(){return $(this).attr('data-id')}).get();
            let vals = $('input[name="license_refuse"]:checked').map(function(){return $(this).val()}).get();
            cid = refuse.join(',');
            jid = vals.join(',')
            let fd = new FormData();
            fd.append('cid', cid);
            fd.append('jid', jid);
            fd.append('uid', modal.find('input[name="id"]').attr('data-id'));
            fd.append('msg', modal.find('textarea[name="message"]').val());
            fd.append('mail', modal.find('input[name="mail"]:checked').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'webpanel/my-job/cs/refuse',
                type: 'post',
                contentType: false,
                processData: false,
                async: false,
                data: fd,
                dataType: 'json',
                success: (response) => {
                    if (response.status === true) {
                        modal.modal('hide');
                        Swal.fire({
                            title: "refuse Success !",
                            icon: "success",
                            timer: 1000,
                            closeOnClickOutside: false,
                            showConfirmButton: false,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then(() => {

                            response.data.map(function(v,k){
                                cur = $(`input[name="license_refuse"][value="${v.id}"]`);
                                let html =
                                `<small class="text-danger">${v.changed}</small>`;
                                let td = cur.parent();
                                td.html('');
                                td.append(html);
                            })
                            $('.btn-refuse').removeClass('btn-primary').addClass('btn-default').prop('disabled',true);
                        });
                    }
                },
                error: (err) => {
                    Swal.fire({
                        title: "refuse error !",
                        icon: "error",
                        timer: 1000,
                        closeOnClickOutside: false,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then(() => {
                        refuse.map(function(v,k){
                            $(`input[name="license_refuse"][value="${v}"]`).prop('checked',false);
                        })
                    })
                }
            })
        })

    })

    $(document).on('click', '.scroll-to', function(e) {
        elm = $(this).attr('href');
        const offset = $(elm).offset();
        window.scrollTo({
            top: offset.top - 75,
            behavior: 'smooth'
        });
        e.preventDefault();
    })


    // ===================================== //
    // ================ QC. ================ //
    // ===================================== //
    const QcJobsContent = $('#qc-jobs-content');
    const QcRejectContent = document.getElementById('qc-reject-content');
    QcJobsContent.find('button.reset').on('click', function() {
        QcJobsContent.find('input[name="search"]').val('');
        SearchCompany(QcJobsContent)
    });
    QcJobsContent.find('input[name="search"]').on('keyup', function() {
        SearchCompany(QcJobsContent)
    })
    $(document).on('click', '.job-reject', function() {
        cur = $(this);
        job = cur.attr('data-job');
        id = cur.attr('data-id');
        type = cur.attr('data-type');
        modal = $('#rejectModal');
        modal.find('.modal-title').html('Job Rejection');
        modal.find('.tab-reject').removeClass('d-none');
        modal.find('.tab-status').addClass('d-none');
        modal.find('.alert').remove();
        modal.find('textarea').val('');
        modal.find('input[type="file"]').val('');
        modal.find('.custom-file-input').val('');
        modal.find('.custom-file-label').html('Choose file...');
        modal.find('input[name="job"]').val(cur.attr('data-job'))
        modal.find('input[name="type"]').val(cur.attr('data-type'))
        modal.modal('show');
        modal.find('option').map(function() {
            if ($(this).val() == id) {
                $(this).prop('selected', true)
            }
        });
        modal.find('.custom-file-input').on('change', function() {
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                $this.siblings(".custom-file-label").addClass("selected");

                let countfile = 0;
                $this.siblings(".custom-file-label").html('');
                for (let i = 0; i < input.files.length; i++) {
                    countfile++
                }
                $this.siblings(".custom-file-label").html(
                    `<div class='badge badge-primary'>${countfile} Files</div>`);

                // **show name in input files**
                // let filename = '';
                // $this.siblings(".custom-file-label").html('');
                // for (let i = 0; i < input.files.length; i++) {
                //     var reader = new FileReader();
                //     reader.readAsDataURL(input.files[i]);
                //     filename += (i> 0) ? ',' : '';
                //     filename += input.files[i].name.toString()
                // }
                // $this.siblings(".custom-file-label").html(filename);


                // reader.onload = function (e) {
                //     $('#preview').attr('src', e.target.result).fadeIn('slow');
                // }
            }
            $('.custom-file-label').html();
        })

    });
    $(document).on('click', 'button.qc-reject-job', function() {
        btn = $(this);
        let modal = $(this).closest('.tab-reject').find('.modal-body');
        fd = new FormData();
        fd.append('job', modal.find('input[name="job"]').val());
        fd.append('type', modal.find('input[name="type"]').val());
        fd.append('user', modal.find('select').val());
        fd.append('remark', modal.find('textarea').val());
        fd.append('_token', '{{ csrf_token() }}');
        console.log(modal)

        if (modal.find('.custom-file-input').val() != '') {
            jQuery.each(modal.find('.custom-file-input').prop('files'), function(i, file) {
                fd.append('attach[' + i + ']', file);
            });
        }

        if (type != '') fd.append('type', modal.find('input[name="type"]').val());
        if (fd.set.length > 0) {
            btn.prop('disabled', true);
            console.log(fd);
            submit(fd)
        }

        function submit(fd) {
            $.ajax({
                method: 'post',
                url: "webpanel/my-job/reject",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    console.log(res);
                    if (res.status === true) {
                        modal.prepend(successAlert);
                        modal.find('textarea').val('');
                        modal.find('input[type="file"]').val('');
                        modal.find('.custom-file-label').html('Choose file...');
                        btn.prop('disabled', false);
                        setTimeout(() => {
                            modal.find('.alert').remove();
                            modal.closest('.modal').modal('hide');
                        }, 3000);
                    } else {
                        modal.prepend(errorAlert);
                        btn.prop('disabled', false);
                        setTimeout(() => {
                            modal.find('.alert').remove();
                            modal.closest('.modal').modal('hide');
                        }, 3000);
                    }
                },
                error: (er) => {
                    console.log(er.responseText);
                    btn.prop('disabled', false);
                }
            });
        }
    });
    $(document).on('click', '.modalImgReject', function() {
        const modal = $('#modalImgReject');
        let attach = $(this).attr('data-href');
        attach = JSON.parse(attach);
        modal.find('img').remove();
        if (attach != '') {
            $.each(attach, function(k, v) {
                let img = $('<img src="" class="img-fluid">')
                img.attr('src', v.image);
                modal.find('.attach').append(img);
            })
        }
        modal.modal('show')
    })
    const JobsReject = document.getElementsByClassName('find-reject');
    const JobsRejectTable = document.getElementById('qc-reject-content');
    const qcRejectContent = $('#qc-reject-content');

    document.addEventListener('click', function(e) {
        const findReject = e.target.closest('.find-reject');
        if (findReject) {
            const allTr = JobsRejectTable.querySelector('.job-focus')?.classList.remove('job-focus');
            const jobId = findReject.getAttribute('job');
            const topRable = qcRejectContent.offset().top;
            window.scrollTo({
                top: topRable - 60,
                behavior: 'smooth'
            });
            const thisTr = JobsRejectTable.querySelector(`[data-job-progress="${jobId}"]`);
            thisTr.classList.add('job-focus')
            // const rows = JobsRejectTable.querySelector('tbody');
            setTimeout(() => {
                thisTr.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }, 800)
        }
    })


    $(document).on('change', '.qc-job-status', function() {
        const cur = $(this);
        const by = '{{ $auth->name }}';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            method: 'post',
            url: 'webpanel/members/company/status',
            data: {
                id: cur.attr('data-id')
            },
            success: (res) => {
                tr = cur.closest('tr');
                if (res === true) {
                    if (cur.is(':checked')) {

                        tr.find('.step4_bar').find('.fas').toggleClass(
                            'fa-check-circle fa-times-circle');
                        tr.find('.step4_bar').removeClass(
                            'progress-none progress-danger progress-success').addClass(
                            'progress-success');
                            tr.find('.step4_by').html(by);
                            tr.find('.public_status').html('ONLINE');
                        } else {
                            tr.find('.step4_bar').find('.fas').toggleClass(
                                'fa-check-circle fa-times-circle');
                            tr.find('.step4_bar').removeClass('progress-none progress-success')
                            .addClass('progress-danger');
                            tr.find('.step4_by').html('-');
                            tr.find('.public_status').html('OFFLINE');
                        }
                    } else {
                        alert('An error has occurred.');
                    }
                },
                error: (err) => {
                    console.log(err.responseText)
                }
            })
    })

    //Job Reject from Data input & Designer
    $(document).on('change', '.all-job-reject', function() {
        let checked = $(this).is(':checked') ? true : false;
        let disabled = checked === true ? false : true;
        $('.this-reject').prop('checked', checked);
        $('.job-send-reject').prop('disabled', disabled);
    })

    $(document).on('change', '.this-reject', function() {
        let id = $('.this-reject:checked').map(function() {
            return $(this).val()
        }).get();
        let disabled = id.length > 0 ? false : true;
        $('.job-send-reject').prop('disabled', disabled);
    })
    $(document).on('click', '.job-send-reject', function() {
        const type = $(this).attr('data-type');
        const id = [],
        message = [];
        $('.this-reject:checked').map(function(k, v) {
            id.push($(this).val());
            message.push($(this).closest('.text-center').prev().find('input').val());
        });
        const fd = new FormData();
        fd.append('id', id);
        fd.append('message', message);

        Swal.fire({
            icon: 'warning',
            title: 'Comfirm to send jobs?',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                return fetch(`webpanel/my-job/${type}/return/reject`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: fd
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(error);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    icon: res.value.icon,
                    title: res.value.message,
                    toast: true,
                    timer: 2000,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true
                });
                setTimeout(() => {
                    location.reload()
                }, 2100);
            }
        });
    });
    // getAccessToken = async () => {
    //     const token = await axios('webpanel/users/get/access-token').then((res)=>{return res.data});
    //     return token;
    // }

    function fetchUsers() {
        const response = $.ajax({
            method: 'get',
            url: 'webpanel/my-job/get/users',
            async: false,
            dataType: "json"
        }).responseJSON;

        return response;

    }


    $(document).on('click', '.member', function() {
        $('.member').removeClass('active');
        $(this).addClass('active');
        const cur = $(this);
        const id = cur.attr('data-id');

        const listGroup = $('.list-group-timeline');

        listGroup.html('');
        $.ajax({
            method: 'get',
            url: `api/task/activity/${id}`,
            success: function(res) {
                if (res.length > 0) {
                    res.map((v, k) => {
                        const timeline = $('<div class="list-group-item border-0">\
                            <div class="row ps-lg-1"><div class="col ms-n2 mb-3"><p class="fs-6 fw-bold mb-1 item-title">title</p>\
                            <div class="d-flex align-items-center"><span class="item-text">time</span></div></div></div>\
                            </div>');
                        let title = `<span style="font-weight:600;">${v.action}</span>`;
                        if (v.description != "") title +=
                            ', <small class="badge badge-secondary">' + v.datetime +
                        '</small>';
                        timeline.find('.item-title').html(title);
                        timeline.find('.item-text').html(v.description)
                        $('.list-group-timeline').append(timeline);
                    });
                } else {
                    listGroup.append('<div class="list-group-item border-0">\
                        <div class="row ps-lg-1"><div class="col ms-n2 mb-3"><p class="fs-6 fw-bold mb-1">No record.</p>\
                        </div>')
                }
            }
        });
    })

    $(document).on('closed.bs.alert', '#rejectModal', function() {
        $(this).find('.alert').remove();
    })
    $(document).on('click', '.reject-status', function() {
        cur = $(this);
        Modal = $('#rejectModal');
        Modal.find('.modal-title').html('Rejection status');
        let attach = cur.attr('data-image');
        attach = JSON.parse(attach);
        Modal.find('img').remove();
        if (attach != '') {
            $.each(attach, function(k, v) {
                let img = $('<img src="" class="img-fluid">')
                img.attr('src', v.image);
                Modal.find('.attach').append(img);
            })
            Modal.find('.no-image').addClass('d-none');
        } else {
            Modal.find('.no-image').removeClass('d-none');
        }

        Modal.find('.reject-status-text').html(cur.attr('data-status') == '1' ?
            '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Fixed</span>' :
            '<span class="badge badge-warning"><i class="far fa-circle"></i> Pending</span>');
        Modal.find('textarea[name="message"]').html(cur.attr('data-message'));
        Modal.find('.tab-reject').addClass('d-none');
        Modal.find('.tab-status').removeClass('d-none');
        checked = cur.attr('data-finished') != '' ? true : false;
        Modal.find('input[type="checkbox"]').prop('checked', checked);

        if (checked === true) Modal.find('.custom-control-label').find('span').html(cur.attr('data-finished'));
        else Modal.find('.custom-control-label').find('span').html('');

        Modal.modal('show');
        Modal.on('change', '[type="checkbox"]', function() {
            $this = $(this);
            bool = $this.is(':checked') ? true : false;
            id = cur.attr('data-id');
            // console.log(id)
            $.ajax(`webpanel/my-job/qc/finished/${bool}/${cur.attr('data-id')}`).done(function(res) {
                if (res?.datetime != undefined) {
                    Modal.find('.custom-control-label').find('span').html(res.datetime);
                    cur.attr('data-finished', res.datetime);
                } else {
                    Modal.find('.custom-control-label').find('span').html('');
                    cur.attr('data-finished', '');
                }
            });
            setTimeout(() => {
                Modal.modal('hide');
                location.reload();
            }, 2000);
        })
    })

    const userAlert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
        <strong class="alert-title">Opps!</strong> <span class="alert-text">An error has occurred.</span>\
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
        <span aria-hidden="true">&times;</span>\
        </button>\
        </div>');

    $(document).on('click', '.new-user', function() {
        const Modal = $('#ModalUser');

        Modal.find('modal-title').html('New User');
        Modal.modal('show');
        Modal.find('.user-position').on('click', function() {
            $('.user-position').removeClass('active badge-danger');
            $(this).addClass('active');
        });
        Modal.find('.btn-new-user').on('click', function() {

            validate = formUserValidate(Modal);

            $.ajax(
                `webpanel/my-job/qc/check-user-duplicate?username=${Modal.find('input[name="username"]').val()}`
                )
            .done((res) => {
                if (res.status === true) {
                    Modal.find('input[name="username"]').addClass('badge-danger');
                    if (Modal.find('.alert').hasClass('d-none')) {
                        if (validate == null) Modal.find('.alert').removeClass('d-none').append(
                            ' and ' + res.text.toLowerCase());
                            else Modal.find('.alert').removeClass('d-none').html(res.text);
                    } else {
                        if (validate == null) Modal.find('.alert').append(' and ' + res.text
                            .toLowerCase());
                            else Modal.find('.alert').html(res.text);
                    }
                } else {
                    Modal.find('input[name="username"]').removeClass('badge-danger');
                }
            });

            if (validate == null) {
                const fd = new FormData();
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('username', Modal.find('input[name="username"]').val());
                fd.append('password', Modal.find('input[name="password"]').val());
                fd.append('position', Modal.find('.user-position.active').attr('data-id'));
                newUser(Modal, fd)
            }
        })
    })
    $(document).on('click', '.qc-edit-user', function() {
        const cur = $(this);
        const Modal = $('#ModalUser');
        Modal.find('.modal-title').html('Edit user');
        Modal.find('input[name="username"]').attr('readonly', true);
        Modal.modal('show');
        const data = JSON.parse(cur.attr('data-user'));
        // console.log(JSON.parse(data));
        Modal.find('.user-position').removeClass('active');
        Modal.find('input[name="username"]').val(data.username);
        Modal.find('.user-position').each(function(k, v) {
            if ($(v).attr('data-id') == data.position) $(v).addClass('active');
        });
        Modal.find('.show-password').on('click', function() {
            passwordInput = Modal.find('input[name="password"]');

            thisType = passwordInput.attr('type');
            newType = thisType == 'password' ? 'text' : 'password';
            $(this).find('i').toggleClass('fa-eye-slash fa-eye');
            passwordInput.attr('type', newType);
        })
        Modal.find('.btn-new-user').on('click', function() {
            validate = formUserValidate(Modal);
            if (validate == null) {
                const fd = new FormData();
                fd.append('id', data.id);
                fd.append('password', Modal.find('input[name="password"]').val());
                fd.append('position', Modal.find('.user-position.active').attr('data-id'));
                updateUser(Modal, fd)
            }
        })
        Modal.find('.user-position').on('click', function() {
            positionSelect(Modal, $(this))
        })
    });

    $(document).on('click', '.qc-delete-user', function() {
        const data = JSON.parse($(this).attr('data-user'));
        deleteUser(data.id);
    })

    const newUser = (Modal, fd) => {
        const alert = Modal.find('.alert');
        $.ajax({
            method: 'POST',
            url: 'webpanel/my-job/qc/new-user',
            data: fd,
            processData: false,
            contentType: false,
            success: (res) => {
                if (res.statusCode == 201) {
                    userAlert.removeClass('alert-danger').addClass('alert-success');
                    userAlert.find('.alert-title').html(res.title);
                    userAlert.find('.alert-text').html(res.text);
                } else {
                    userAlert.removeClass('alert-success').addClass('alert-danger');
                    userAlert.find('.alert-title').html(res.title);
                    userAlert.find('.alert-text').html(res.text);
                }
                Modal.find('.modal-body').prepend(userAlert);
                setTimeout(() => {
                    Modal.find('input[name="username"]').val('')
                    Modal.find('input[name="password"]').val('');
                    Modal.find('.user-position').removeClass('active');
                    Modal.modal('hide');
                    Modal.find('.alert-dismissible').remove();
                }, 3000);
            }
        });
    }
    const updateUser = (Modal, fd) => {
        const alert = Modal.find('.alert');
        $.ajax({
            method: 'post',
            url: 'webpanel/my-job/qc/update/user',
            data: fd,
            processData: false,
            contentType: false
        }).then((res) => {
            if (res.status === true) {
                alert.removeClass('alert-danger d-none').addClass('alert-success');
            } else {
                alert.removeClass('alert-success d-none').addClass('alert-danger');
            }
            alert.html(
                `<strong class="alert-title">${res.title}</strong><span class="alert-text"> ${res.text}</span>`
                );
            setTimeout(() => {
                alert.addClass('d-none');
            }, 3000);
        })

    }

    const formUserValidate = (Modal) => {
        let required = {};
        const position = Modal.find('.user-position.active').attr('data-id');
        required.username = (Modal.find('input[name="username"]').val() == '') ? true : false,
        required.password = (Modal.find('input[name="password"]').val() == '') ? true : false,
        required.position = (position == undefined) ? true : false

        $.each(required, function(k, v) {
            if (v === true) Modal.find(`input[name="${k}"]`).addClass('is-invalid');
            else Modal.find(`input[name="${k}"]`).removeClass('is-invalid');
        });

        let error = [];
        let errorRequired = 'Please enter your';
        $.each(required, function(k, v) {
            if (v === true) error.push(k)
        })

        if (position === undefined) $('.user-position').addClass('badge-danger');
        else $('.user-position').removeClass('badge-danger');

        if (error.length > 0) {
            errorRequired += ' ' + error.join(', ');
            Modal.find('.alert').removeClass('d-none').html(errorRequired);
        } else {
            Modal.find('.alert').addClass('d-none').html('');
        }
        return (error.length == 0) ? null : error;
    }

    const positionSelect = (Modal, el) => {
        Modal.find('.user-position').removeClass('active badge-danger');
        el.addClass('active');
    }

    const deleteUser = (id) => {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Confirm to delete?',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                return fetch(`webpanel/my-job/qc/delete/user`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(error);
                });
            }
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    icon: res.value.icon,
                    title: res.value.message,
                    toast: true,
                    timer: 3000,
                    position: 'top',
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            }
        })

    }

    var vlidateRejection = (Modal, required) => {
        const errors = {};
        $.each(required, function(k, v) {
            if (k == 'receiver') {
                const receiver = Modal.find('.receiver.active').map(function() {
                    return $(this).attr('data-id')
                }).get();
                if (receiver.length == 0) {
                    Modal.find('.receiver').removeClass('badge-light').addClass('badge-danger');
                    errors[k] = true;
                } else {
                    Modal.find('.receiver').removeClass('badge-danger').addClass('badge-light');
                    delete errors[k];
                }
            } else {
                const input = elementValidate(k);
                const el = Modal.find(`${input}[name="${k}"]`);
                if (el.val() == '') {
                    el.addClass('is-invalid');
                    errors[k] = true;
                } else {
                    el.removeClass('is-invalid');
                    delete errors[k];
                }

            }
        });
        return errors;
    }
    var elementValidate = (name) => {
        let input;
        if ($('input[name="' + name + '"]').length > 0) {
            input = 'input';
        }
        if ($('textarea[name="' + name + '"]').length > 0) {
            input = 'textarea';
        }
        return input;
    }

    $(document).on('click', '.reject-blog', function() {
        const blog = $(this).attr('data-id');
        const Modal = $('#ModalRejectBlog');
        Modal.find('.tab-reject').removeClass('d-none');
        Modal.modal('show');
        Modal.find('.modal-title').html('Rejection status');
        Modal.on('click', '.receiver', function() {
            $(this).addClass('active');
            $('.receiver').not(this).removeClass('active');
        });
        Modal.find('.custom-file-label').html();
        Modal.find('.custom-file-input').on('change', function() {
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]) {

                $this.siblings(".custom-file-label").addClass("selected");

                let countfile = 0;
                $this.siblings(".custom-file-label").html('');
                for (let i = 0; i < input.files.length; i++) {
                    countfile++
                }
                $this.siblings(".custom-file-label").html(
                    `<div class='badge badge-primary'>${countfile} Files</div>`);

                // var reader = new FileReader();
                //======= Preview =======//
                // reader.onload = function (e) {
                //     $('#preview').attr('src', e.target.result).fadeIn('slow');
                // }
                // reader.readAsDataURL(input.files[0]);
                // $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
            }
            $('.custom-file-label').html();
        })
        Modal.on('click', '.btn-primary', function() {
            const validate = vlidateRejection(Modal, {
                'receiver': true,
                'remark': true
            });
            const fd = new FormData();
            fd.append('blog', blog);
            fd.append('to', Modal.find('.receiver.active').attr('data-id'));
            fd.append('remark', Modal.find('textarea[name="remark"]').val());
            fd.append('_token', '{{ csrf_token() }}');

            if (Modal.find('.custom-file-input').val() != '') {
                jQuery.each(Modal.find('.custom-file-input').prop('files'), function(i, file) {
                    fd.append('attach[' + i + ']', file);
                });
            }

            if (Object.keys(validate) == 0) {
                $.ajax({
                    method: 'post',
                    url: 'webpanel/my-job/qc/reject/blog',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status == true) location.reload();
                    }
                })
                .then((res) => {
                    console.log(res)
                })
                .catch(res => console.log(res.responseText))
            };
        });
    });
    var blogRejectTable = $('#blogRejectTable');
    var blogModal = $('#blogModal');
    const getIdReject = () => {
        var blogRejectTable = $('#blogRejectTable');
        return blogRejectTable.find('tr.selected').map(function() {
            return $(this).attr('data-id')
        }).get();
    }
    const returnBlogToQC = () => {
        const id = getIdReject();
        if (id.length > 0) {
            Swal.fire({
                title: 'Confirm blog return to QC.',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: () => {
                    return fetch(`webpanel/my-job/blog/return/to/qc`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(error);
                    });
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    location.reload();
                }
            })
        }
    }

    blogRejectTable.on('click', 'tr', function() {
        $(this).toggleClass('selected');
        const id = getIdReject();
        const disabled = (id.length > 0) ? false : true;
        $('.return-blog').prop('disabled', disabled);
    })

    $(document).on('click', '.return-blog', function() {
        returnBlogToQC();
    })
    $(document).on('change', '#allReturn', function() {
        if ($(this).is(':checked')) {
            blogRejectTable.find('tr').addClass('selected');
        } else {
            blogRejectTable.find('tr').removeClass('selected');
        }
        const id = getIdReject();
        const disabled = (id.length > 0) ? false : true;
        $('.return-blog').prop('disabled', disabled);
    });

    $(document).on('click', '.detail-reject', function() {
        const cur = $(this);
        const remark = cur.closest('tr').attr('data-remark');
        let attach = cur.closest('tr').attr('data-attach');
        attach = JSON.parse(attach);
        blogModal.find('img').remove();
        blogModal.find('.edit').removeClass('d-none').attr('href',
            `webpanel/blog/${cur.closest('tr').attr('data-id')}`).attr('target', '_blank');
        blogModal.modal('show');
        blogModal.find('.remark').children().html(remark);
        if (attach != '') {
            $.each(attach, function(k, v) {
                let img = $('<img src="" class="img-fluid">')
                img.attr('src', v.image);
                blogModal.find('.attach').append(img);
            })

        }
        blogModal.find('[data-dismiss="modal"]').on('click', function() {
            blogModal.find('.edit').addClass('d-none');
        })
    });
    $(document).on('click', '.reject-edit', function() {
        const cur = $(this);
        const Modal = $('#ModalRejectBlog');
        Modal.find('.tab-finished');
        Modal.find('.modal-title').html('Finished');
    });

    $(document).on('click', '.blog-finished', function() {
        const cur = $(this);
        const blog = cur.closest('tr').attr('data-id');
        if (blog != '') {
            $.ajax({
                method: 'post',
                url: 'webpanel/my-job/qc/blog/finished',
                data: {
                    _token: '{{ csrf_token() }}',
                    blog: blog
                },
                success: (res) => {
                    Swal.fire({
                        icon: res.icon,
                        title: res.text,
                        toast: true,
                        timer: 3000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    });

                },
                error: (err) => {
                    console.log(err)
                }
            });
        }
    })
    var fullUrl = window.location.origin + '/webpanel/company';

    $('.revise-status').on('click', function() {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return await fetch(fullUrl + '/revise?id=' + id)
                .then(response => response.json())
                .then(data => location.reload())
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`)
                })
            }
        });
    })
    $("body").tooltip({ selector: '[data-toggle="tooltip"]' });
</script>
