<style>
    select[name="st-country_length"] {
        width: 100% !important;
    }

    .fs-2 {
        font-size: 1rem !important;
    }

    .fs-3 {
        font-size: 1.25rem !important;
    }

    .fs-4 {
        font-size: 1.5rem !important;
    }

    .fs-5 {
        font-size: 1.75rem !important;
    }

    .fa-maximize {
        background-image: url('img/maximize.svg');
    }

    .fa-minimize {
        background-image: url('img/minimize.svg');
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    .fw-semibold {
        font-weight: 600 !important;
    }

    small,
    .small {
        font-size: 0.775em;
    }

    .card-body {
        /* overflow: hidden; */
        display: inline-block;
        text-overflow: ellipsis;
        /*overflow: hidden; */
        white-space: nowrap;
    }

    .progress-thin {
        height: 4px;
    }

    .tab-today-activity,
    .tab-blog-activity {
        cursor: pointer;
    }

    .scroll-y {
        /* padding: 1rem; */
        max-height: 523px;
        overflow-y: scroll;
        scrollbar-gutter: stable;
    }

    .scroll-y::-webkit-scrollbar {
        width: 12px;

    }

    .scroll-y::-webkit-scrollbar-track {
        background-color: rgb(237, 237, 237, 0.3);
    }

    .scroll-y::-webkit-scrollbar-thumb {
        background-color: #c1c1c1;
    }

    .badge-yellow {
        background-color: yellow;
    }

    span.dot {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: calc(100%);
        display: block;
    }

    ol.pl-4 {
        border-bottom: 1px solid #c1c1c1;
    }

    .fas.fa-sync-alt.rotate {
        -webkit-animation: spin 0.65s linear infinite;
        -moz-animation: spin 0.65s linear infinite;
        animation: spin 0.65s linear infinite;
    }

    .fas.fa-sync-alt {
        transition: transform 0.5s ease 0s;
    }

    .bg-lightgrey {
        background-color: #ebedef;
    }

    .bg-lightgrey .progress {
        background-color: #fff !important;
    }

    @-moz-keyframes spin {
        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    ol li div.list-item span,
    ol li div.list-item a {
        padding-left: 5px;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    /* [class^='col-lg'] ol li div.list-item span{
    width: 520px;
    } */

    /* [class^='col-sm'] .list-item-right{
    position: unset !important;
    } */
    .list-item-right {
        position: absolute;
        right: 15px;
    }
    .table{
        border-collapse: separate;
        border-spacing: 0;
    }
    .thead-sticky{
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .thead-sticky thead tr:first-child th:first-child{
        border-top-left-radius: 15px;
    }
    .thead-sticky thead tr:first-child th:last-child{
        border-top-right-radius: 15px;
    }
    .thead-sticky thead tr th{
        background: white;
        position: -webkit-sticky;
        position: sticky;
        border-bottom: 1px solid #dedede;
    }
    .thead-sticky thead tr:first-child th{
        top: 60px;
    }
    .thead-sticky thead tr:last-child th{
        top: 106px;
    }
    .thead-sticky tbody tr:last-child td:first-child{
        border-bottom-left-radius: 15px;
    }
    .thead-sticky tbody tr:last-child td:last-child{
        border-bottom-right-radius: 15px;
    }
    option[disabled] {
        color: #dedede !important;
    }

    .bg-ultra-light {
        background-color: #fbfbfb;
    }

    .today-body,
    .blog-body {
        white-space: initial;
    }

    ol.activity-list li {
        white-space: nowrap;
    }

    .table-industry {
        display: block;
        width: 100%;
        overflow-x: visible;
        border-radius: 0px;
        background-color: transparent;
        -webkit-overflow-scrolling: touch;
    }

    /* Fixed Headers */
    .table-industry thead {
        vertical-align: bottom;
        background-color: #ffffff;
        box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 1px;
    }

    .table-industry thead {
        position: sticky;
        top: 55px;
        z-index: 2;
    }

    .table-industry thead[scope=row] {
        position: sticky;
        left: 0;
        z-index: 1;
    }

    .table-industry thead[scope=row] {
        vertical-align: top;
        color: inherit;
        background-color: inherit;
    }

    table:nth-of-type(2) th:not([scope=row]):first-child {
        left: 0;
        z-index: 3;
    }

    /* Strictly for making the scrolling happen. */

    .table-industry thead[scope=row]+td {
        min-width: 24em;
    }

    .table-industry thead[scope=row] {
        min-width: 20em;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 0px solid;
        border-bottom-color: #d8dbe0;
    }

    @media (max-width: 768px) {
        .table-industry thead {
            position: relative;
            top: 55px;
            z-index: 2;
        }

        .table-industry thead[scope=row] {
            position: relative;
        }
    }

    @media (max-width: 820px) {
        .table-industry thead {
            position: relative;
            top: 55px;
            z-index: 2;
        }

        .table-industry thead[scope=row] {
            position: relative;
        }
    }
    .media-grid{
        display: grid;
        gap: 15px 15px;
        grid-auto-columns: 1fr;
        /* grid-row-gap: 10px; */
        grid-template-areas: ".";
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto;
    }
    .cate-grid{
        display: grid;
        gap: 15px 15px;
        grid-auto-columns: 1fr;
        /* grid-row-gap: 10px; */
        grid-template-areas: ".";
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-template-rows: auto;
    }
    .media-col, 
    .cate-col {
        max-width: 100%;
        display: contents;
    }
    .cate-title{
        text-overflow: ellipsis;
        overflow: hidden;
        width: 160px;
        height: 1.2em;
        white-space: nowrap;
    }

    @media (min-width:360px) and (max-width: 480px) {
        .media-grid,
        .cate-grid{
            grid-template-columns: 1fr 1fr;
        }
        .cate-item{
            min-height: 90px;
        }
        .cate-title{
            width: 130px;
        }
    }
    @media (max-width: 768px) and screen {
        .cate-item{
            min-height: 220px;
        }
    }

    @media (min-width: 768px) {
        .media-grid{
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
        .cate-grid{
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
        .cate-title{
            width: 130px;
        }
    }

    @media (min-width: 1366px) {
        .media-grid{
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        }
        .cate-col{
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
        .cate-title{
            width: 235px;
        }
    }

    a.media-item {
        padding: 15px;
        display: block;
        border-radius: 15px;
        background-color: #fefefe;
        min-height: 120px;
        position: relative;
        overflow: hidden;
    }
    .cate-item{
        padding: 15px;
        display: block;
        border-radius: 15px;
        background-color: #fefefe;
        position: relative;
        overflow: hidden;
    }

    a.media-item,
    a.media-item:active,
    a.media-item:hover,
    .cate-item,
    .cate-item:active,
    .cate-item:hover{
        color: rgb(34, 34, 34);
        text-decoration: none;
    }

    .media-item:not(.media-item--disabled):hover {
        background: rgb(240, 250, 255);
        transition: background-color 0.25s ease 0s, box-shadow 0.25s ease 0s;
    }

    .media-item:hover,
    .media-item.--active {
        background: rgb(240, 250, 255);
        transition: background-color 0.25s ease 0s, box-shadow 0.25s ease 0s;
    }

    .media-figure {
        margin: 0;
        /* margin-right: 8px;
        margin-bottom: 8px; */
        right: 0;
        bottom: 0;
        position: absolute;
    }
   

    .media-figure .media-icon {
        /* background: rgba(225, 230, 234, 0.6);
        border: 1px solid rgb(223, 223, 223); */
        border-radius: 6px;
        box-sizing: initial;
        color: rgb(115, 115, 115);
        padding: 15px;
    }

    .media-title {
        color: rgb(34, 34, 34);
        text-decoration: none;
    }

    .media-content,
    .cate-content {
        color: rgb(115, 115, 115);
        font-size: 12px;
        line-height: 1.333;
    }
    .cate-logo{
        position: absolute;
        top: -5px;
        right: -5px;
        height: 115%;
        opacity: 0.125;
    }
    ._row{
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    ._row ._col:first-child{
        /* padding-right: 6px !important; */
    }
    ._col-sm-1,
    ._col-sm-2,
    ._col-sm-3,
    ._col-sm-4,
    ._col-sm-5,
    ._col-sm-6,
    ._col-sm-7,
    ._col-sm-8,
    ._col-sm-9,
    ._col-sm-10,
    ._col-sm-11,
    ._col-sm-12,
    ._col-sm-13,
    ._col-sm-14,
    ._col-sm-15,
    ._col-sm-16,
    ._col-md-1,
    ._col-md-2,
    ._col-md-3,
    ._col-md-4,
    ._col-md-5,
    ._col-md-6,
    ._col-md-7,
    ._col-md-8,
    ._col-md-9,
    ._col-md-10,
    ._col-md-11,
    ._col-md-12,
    ._col-md-13,
    ._col-md-14,
    ._col-md-15,
    ._col-md-16,
    ._col-lg-1,
    ._col-lg-2,
    ._col-lg-3,
    ._col-lg-4,
    ._col-lg-5,
    ._col-lg-6,
    ._col-lg-7,
    ._col-lg-8,
    ._col-lg-9,
    ._col-lg-10,
    ._col-lg-11,
    ._col-lg-12,
    ._col-lg-13,
    ._col-lg-14,
    ._col-lg-15,
    ._col-lg-16{
        position: relative;
        width: 100%;
        padding-right: 10px;
        padding-left: 10px;
    }
    ._row ._col-lg-1,
    ._row ._col-md-1,
    ._row ._col-xs-1{ width:6.25% }    
    ._row ._col-lg-2,
    ._row ._col-md-2,
    ._row ._col-xs-2{ width:12.50% }
    ._row ._col-lg-3,
    ._row ._col-md-3,
    ._row ._col-xs-3{ width:18.75% }
    ._row ._col-lg-4,
    ._row ._col-md-4,
    ._row ._col-xs-4{ width:25% }
    ._row ._col-lg-5,
    ._row ._col-md-5,
    ._row ._col-xs-5{ width:31.25% }
    ._row ._col-lg-6,
    ._row ._col-md-6,
    ._row ._col-xs-6{ width:37.50% }
    ._row ._col-lg-7,
    ._row ._col-md-7,
    ._row ._col-xs-7{ width:43.75% }
    ._row ._col-lg-8,
    ._row ._col-md-8,
    ._row ._col-xs-8{ width:50% }
    ._row ._col-lg-9,
    ._row ._col-md-9,
    ._row ._col-xs-9{ width:56.26% }
    ._row ._col-lg-10,
    ._row ._col-md-10,
    ._row ._col-xs-10{ width:62.50% }
    ._row ._col-lg-11,
    ._row ._col-md-11,
    ._row ._col-xs-11{ width:68.75% }
    ._row ._col-lg-12,
    ._row ._col-md-12,
    ._row ._col-xs-12{ width:75% }
    ._row ._col-lg-13,
    ._row ._col-md-13,
    ._row ._col-xs-13{ width:81.25% }
    ._row ._col-lg-14,
    ._row ._col-md-14,
    ._row ._col-xs-14{ width:87.50% }
    ._row ._col-lg-15,
    ._row ._col-md-15,
    ._row ._col-xs-15{ width:93.75% }
    ._row ._col-lg-16,
    ._row ._col-md-16,
    ._row ._col-xs-16{ width:100% }
    /* @media only screen and (max-width:480px){
        ._col-xs-16{
            width: 100% !important;
        }
        ._col-lg-12{
            width:unset !important;
        }
        form.search{
            width: 100%;
            width: calc(100vw - 30px);
        }
    }
    @media (min-width:1024px){
        ._row ._col-lg-4 {
            width: 25%;
        }
    }
    @media only screen and (min-width:1024px){
        ._row ._col-xs-6 {
            width: 37.5%;
        }
        
        ._row ._col-xs-16 {
            width: 100%;
        }
        ._row ._col-lg-10, ._row ._col-md-10, ._row ._col-xs-10 {
            width: 62.50%;
        }
    }
    @media (min-width:1366px){
        ._col-lg-12{
            width:75% !important;
        }
        ._col-lg-4{
            width:25% !important;
        }
        form.search{
            width: 400px;
        }
    } */
    
    @media (min-width:320px)  {
        /* smartphones, iPhone, portrait 480x320 phones */
        ._row ._col-xs-12{
            width:75%;
        }
        ._row ._col-xs-16{
            width:100%;
        }
    }
    @media (max-width:641px) {
        form.search{
            width: 100%;
            width: calc(100vw - 30px) !important;
        }

    }
    @media (min-width:481px)  {
        /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ 
       
    }
    @media (min-width:641px)  {
        /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ 
    }
    @media (min-width:961px)  {
        /* tablet, landscape iPad, lo-res laptops ands desktops */ 
        ._row ._col-lg-4 {
            width: 25%;
        }
        ._row ._col-lg-12 {
            width: 75%;
        }
    }
    @media (min-width:1025px) {
        /* big landscape tablets, laptops, and desktops */
        ._row ._col-lg-4 {
            width: 25%;
        }
        ._row ._col-lg-12 {
            width: 75%;
        }
    }
    @media (min-width:1281px) {
        /* hi-res laptops and desktops */ 
        ._row ._col-lg-4 {
            width: 25%;
        }
    }
    
    ._card{
        display: block;
        border-radius: 15px;
        /* background-color: #fefefe; */
        position: relative;
    }
    ._card-body{
        padding: 15px;
    }
    ._list-group{
        margin: 0;
        padding: 0;
    }
    ul li._list-item{
        list-style: none;
        border-bottom: 1px solid #dedede;
        padding: 10px;
    }
    ul li._list-item:last-child{
        border-bottom: none;
    }
    ul li._list-item p{
        display: block;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    p.text-ellipsis{
        display: block;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .fs-16{
        font-size: 16px;
    }
    .--cate-active{
        color: #ff4900 !important;
    }
    ._link{
        cursor: pointer;
    }
    ._link:hover{
        color: #ff4900 !important;
    }
    .bg-ultralight{
        background-color: #f9f9f9;
    }
    .search-content{
        cursor: pointer;
    }
    .search-content:hover{
        background-color: #fff;
    }
    .search-content ._card-body,
    .search-content h5{
        opacity: 50%;
        animation: fadeIn 0.5s;
        -webkit-animation: fadeIn 0.5s;
        -moz-animation: fadeIn 0.5s;
        -o-animation: fadeIn 0.5s;
        -ms-animation: fadeIn 0.5s;
    }
    .search-content:hover,
    .search-content:hover h5{
        color: #000 !important;
        opacity: 100%;
        transition: opacity 0.5s;
    }
    ._mh-400{
        max-height:400px;
    }
    .overflow-hiden{
        overflow: hidden;
    }
    /* width */
    /* ._col:has(.-flex)::-webkit-scrollbar { */
    ._col::-webkit-scrollbar {
        width: 8px;
    }

    /* ._col:has(.-flex)::-webkit-scrollbar-thumb { */
    ._col::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 100px;
    }
    /* ._card ._col:has(.-flex)::-webkit-scrollbar-track { */
    ._col::-webkit-scrollbar-track {
        border-radius: 100px;
    }
    ._rounded{
        border-radius: 15px;
    }
    ._bg-light{
        background-color: #f3f3f3;    }
    /* .search-category:hover{
        background-color: #ced2d8;
        border-radius: 15px;
    } */
    form.search {
        color: #555;
        display: flex;
        padding: 2px;
        border: 1px solid currentColor;
        width: 450px;
    }
    form.search button[type="button"] {
        text-indent: -999px;
        overflow: hidden;
        width: 40px;
        padding: 0;
        margin: 0;
        border: 1px solid transparent;
        border-radius: inherit;
        /* background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-times' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat center; */
        background: transparent url("data:image/svg+xml;utf8,<svg width='16' height='16' class='text-gray-800 dark:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 14 14'><path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'/></svg>") no-repeat center;
        cursor: pointer;
        opacity: 0.7;
        outline: none;
    }

    form.search button[type="submit"]:hover{
        opacity: 1;
    }
    form.search input[name="search"]:focus{
        box-shadow: unset !important;
    }
    /* Tooltip container */
/* .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
} */

/* Tooltip text */
/* .tooltip[title] {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
} */

/* Tooltip arrow */
/* .tooltip[title]::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
} */

/* Show the tooltip text when you mouse over the tooltip container */
    .tooltip:hover[title] {
        visibility: visible;
        opacity: 1;
    }
</style>
<div>
    <link href="back-end/vendors/@coreui/coreui-chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <div class="fade-in">

        <div class="row">
            @php
                $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $goalCreated = 80;
                $goalDesign = 46;
                $goal = 80;
                $goalBlog = 5;
                $now = date('Y-m-d');
                $progressMd = \App\Models\JobProgressMd::class;
                $BlogMd = \App\Models\BlogMd::class;
                // Company Profile
                $created = $progressMd::where(db::raw('DATE(step1_on)'), 'like', $now)->count();
                $per_created = round(($created * 100) / $goalCreated, 2);
                $edited = $progressMd::where(db::raw('DATE(step2_on)'), 'like', $now)->count();
                $per_edited = round(($edited * 100) / $goal, 2);
                $design = $progressMd::where(db::raw('DATE(step3_on)'), 'like', $now)->count();
                $per_design = round(($design * 100) / $goalDesign, 2);
                $online = $progressMd::where(db::raw('DATE(step4_on)'), 'like', $now)->count();
                $per_online = round(($online * 100) / $goal, 2);
                // Blog
                $blogCreated = $BlogMd::where(db::raw('DATE(created)'), 'like', $now)->count();
                $blog_per_created = round(($blogCreated * 100) / $goalBlog, 2);
                $blogOnline = $BlogMd::where(db::raw('DATE(publish)'), 'like', $now)->count();
                $blog_per_online = round(($blogOnline * 100) / $goalBlog, 2);
                $lastday = date('d', strtotime('last day of this month', strtotime(date('Y-m-d'))));
                $myCategory = \App\Models\CompanyMd::select(['category.id', 'category.name_jp as name', 'category.key', db::raw('count(company.category) as company'), db::raw('count(IF(company.public = 1 AND company.type = "full", 1, NULL)) as online'), db::raw('count(IF(company.public = 0 AND company.type = "full", 1, NULL)) as offline'), db::raw('count(IF(company.more_th IS NULL AND company.more_jp IS NULL AND company.type = "full", 1, NULL)) as no_detail'), db::raw('count(IF(job_progress.step3 IS NULL AND company.type = "full", 1, NULL)) as no_design')])
                    ->leftJoin('category', 'company.category', '=', 'category.id')
                    ->leftJoin('job_progress', 'company.id', 'job_progress.company')
                    ->groupBy('company.category')
                    ->orderBy('id')
                    ->get();
            @endphp
            <div class="col-sm-12 col-lg-12">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <h5 class="font-weight-bold">Statistics</h5>
                        <div class="media-grid">
                            <div class="media-col">
                                <a href="webpanel/web-traffic" target="_blank" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fas fa-2x fa-user-check"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Web Traffic</h6>
                                        <div class="media-content">Identifiable</div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                <a href="webpanel/statistics" target="_blank" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fas fa-2x fa-chart-bar"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Statistics</h6>
                                        <div class="media-content">Visitor Statistics</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <h5 class="font-weight-bold mt-4">Companies</h5>
                        <div class="media-grid">
                            <div class="media-col">
                                <a href="javascript:" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fa-2x far fa-building"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">All</h6>
                                        <div class="media-content"> All Company in category</div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                <a href="webpanel/company/delisted" target="_blank" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fas fa-2x fa-trash-alt"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Delisted & Restore</h6>
                                        <div class="media-content"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                <a href="webpanel/company/refuse" target="_blank" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fas fa-2x fa-exclamation-triangle"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Refuse</h6>
                                        <div class="media-content">{{-- --}}Comming soon.</div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                <a href="webpanel/members" target="_blank" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fas fa-2x fa-users"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Members</h6>
                                        <div class="media-content">Username & Password</div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                <a href="webpanel/http/checking" target="_blank" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fas fa-check-circle fa-2x"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Checking</h6>
                                        {{-- <div class="media-content">Username & Password</div> --}}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p1">
                    <div class="col-sm-12 col-lg-12">
                        <h5 class="font-weight-bold mt-4">Today Activity</h5>
                        <div class="media-grid">
                            <div class="media-col">
                                <a href="javascript:#todayActivity" class="media-item --active">
                                    <figure class="media-figure">
                                        <i class="media-icon fa-2x fas fa-layer-group"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Job & Blog Progress</h6>
                                        <div class="media-content"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                <a href="javascript:#summaryCategory" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fa-2x fas fa-tasks"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">Categories</h6>
                                        <div class="media-content"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="media-col">
                                {{-- <a href="javascript:#onlineTable" class="media-item"> --}}
                                <a href="{{url('webpanel/allcategory')}}" class="media-item">
                                    <figure class="media-figure">
                                        <i class="media-icon fa-2x fas fa-chart-line"></i>
                                    </figure>
                                    <div class="media-body">
                                        <h6 class="media-title">KPI</h6>
                                        <div class="media-content">Key Performance Indicator</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="toggle-content mt-3">
                            <div class="row" id="todayActivity">
                                <div class="col-sm-12 col-lg-8">
                                    <div class="_card mb-3 bg-secondary-gradient">
                                        <div class="_card-body today-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h6>Job Progress</h6>
                                                    <a href="javascript:" class="today text-dark ml-2"
                                                        title="Refresh"><i class="fas fa-sync-alt"></i></a>
                                                    <a href="javascript:" class="print-today text-dark ml-2"
                                                        title="Print today"><i class="fas fa-print"></i></a>
                                                </div>
                                                <div class="position-absolute mr-3" style="right:0;">
                                                    <a href="javascript:" class="text-dark today-more"><i
                                                            class="fas fa-angle-down fa-lg"></i></a>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity"
                                                    data-tab="step1">
                                                    <div class="fs-4 fw-semibold">
                                                        <span>{{ $created }}</span>/{{ $goalCreated }}</div>
                                                    <small
                                                        class="text-medium-emphasis text-uppercase fw-semibold">Created</small>
                                                    <small>(1)</small>
                                                    <small class="float-right">{{ $per_created }}%</small>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $per_created }}%"
                                                            aria-valuenow="{{ $per_created }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity"
                                                    data-tab="step2">
                                                    <div class="fs-4 fw-semibold">
                                                        <span>{{ $edited }}</span>/{{ $goal }}</div>
                                                    <small
                                                        class="text-medium-emphasis text-uppercase fw-semibold">Edited</small>
                                                    <small>(2)</small>
                                                    <small class="float-right">{{ $per_edited }}%</small>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $per_edited }}%"
                                                            aria-valuenow="{{ $per_edited }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity"
                                                    data-tab="step3">
                                                    <div class="fs-4 fw-semibold">
                                                        <span>{{ $design }}</span>/{{ $goalDesign }}</div>
                                                    <small
                                                        class="text-medium-emphasis text-uppercase fw-semibold">Design</small>
                                                    <small>(3)</small>
                                                    <small class="float-right">{{ $per_design }}%</small>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $per_design }}%"
                                                            aria-valuenow="{{ $per_edited }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3 col-lg-3 tab-today-activity"
                                                    data-tab="step4">
                                                    <div class="fs-4 fw-semibold">
                                                        <span>{{ $online }}</span>/{{ $goal }}</div>
                                                    <small
                                                        class="text-medium-emphasis text-uppercase fw-semibold">Online</small>
                                                    <small>(4)</small>
                                                    <small class="float-right">{{ $per_online }}%</small>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $per_online }}%"
                                                            aria-valuenow="{{ $per_online }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row d-none">
                                                <div class="col-lg-12 pt-3" tab="step1"
                                                    tab-toggle="today-activity">
                                                    <ol class="pl-4 mb-1 profile-list">
                                                        @if ($step1->count() > 0)
                                                            @foreach ($step1 as $k1 => $rs1)
                                                                <li id="{{ $rs1->category_id }}"
                                                                    job="{{ $rs1->id }}"
                                                                    category="{{ $rs1->category }}">
                                                                    <div class="list-item d-flex position-relative">
                                                                        <strong>{{ $rs1->category }}</strong> <span>
                                                                            @if ($rs1->name_jp != '')
                                                                                {{ $rs1->name_jp }}@else{{ $rs1->name_th }}
                                                                            @endif
                                                                        </span>
                                                                        @if ($rs1->by != '')
                                                                            <small class="list-item-right"
                                                                                by="{{ $rs1->by }}"><strong>By:</strong>
                                                                                {{ $rs1->by }}</small>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li style="list-style:none;" class="text-center"
                                                                no-record="">No Record.</li>
                                                        @endif
                                                    </ol>
                                                </div>
                                                <div class="col-lg-12 pt-3 d-none" tab="step2"
                                                    tab-toggle="today-activity">
                                                    <ol class="pl-4 mb-1 activity-list profile-list">
                                                        @if ($step2->count() > 0)
                                                            @foreach ($step2 as $k2 => $rs2)
                                                                <li id="{{ $rs2->category_id }}"
                                                                    job="{{ $rs2->id }}"
                                                                    category="{{ $rs2->category }}">
                                                                    <div class="list-item d-flex position-relative">
                                                                        <strong>{{ $rs2->category }}</strong> <span>
                                                                            @if ($rs2->name_jp != '')
                                                                                {{ $rs2->name_jp }}@else{{ $rs2->name_th }}
                                                                            @endif
                                                                            @if($rs2->type == 'basic')<small class="badge badge-secondary text-info ml-1">Basic</small>@endif
                                                                        </span>
                                                                        @if ($rs2->by != '')
                                                                            <small class="list-item-right"
                                                                                by="{{ $rs2->by }}"><strong>By:</strong>
                                                                                {{ $rs2->by }}</small>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li style="list-style:none;" class="text-center"
                                                                no-record="">No Record.</li>
                                                        @endif
                                                    </ol>
                                                </div>
                                                <div class="col-lg-12 pt-3 d-none" tab="step3"
                                                    tab-toggle="today-activity">
                                                    <ol class="pl-4 mb-1 activity-list profile-list">
                                                        @if ($step3->count() > 0)
                                                            @foreach ($step3 as $k3 => $rs3)
                                                                <li id="{{ $rs3->category_id }}"
                                                                    job="{{ $rs3->id }}"
                                                                    category="{{ $rs3->category }}">
                                                                    <div class="list-item d-flex position-relative">
                                                                        <strong>{{ $rs3->category }}</strong> <span>
                                                                            @if ($rs3->name_jp != '')
                                                                                {{ $rs3->name_jp }}@else{{ $rs3->name_th }}
                                                                            @endif
                                                                            @if($rs3->type == 'basic')<small class="badge badge-secondary text-info ml-1">Basic</small>@endif
                                                                        </span>
                                                                        @if ($rs3->by != '')
                                                                            <small class="list-item-right"
                                                                                by="{{ $rs3->by }}"><strong>By:</strong>
                                                                                {{ $rs3->by }}</small>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li style="list-style:none;" class="text-center"
                                                                no-record="">No Record.</li>
                                                        @endif
                                                    </ol>
                                                </div>
                                                <div class="col-lg-12 pt-3 d-none" tab="step4"
                                                    tab-toggle="today-activity">
                                                    <ol class="pl-4 mb-1 activity-list profile-list">
                                                        @if ($step4->count() > 0)
                                                            @foreach ($step4 as $k4 => $rs4)
                                                                <li id="{{ $rs4->category_id }}"
                                                                    category="{{ $rs4->category }}">
                                                                    <div class="list-item d-flex position-relative">
                                                                        <strong>{{ $rs4->category }}</strong> <a
                                                                            href="{{ url('/th') }}/{{ $rs4->key }}/cp/{{ $rs4->profile_url }}"
                                                                            target="_blank">
                                                                            @if ($rs4->name_jp != '')
                                                                                {{ $rs4->name_jp }}@else{{ $rs4->name_th }}
                                                                            @endif
                                                                            @if($rs4->type == 'basic')<small class="badge badge-secondary text-info ml-1">Basic</small>@endif
                                                                        </a>
                                                                        @if ($rs4->by != '')
                                                                            <small class="list-item-right"
                                                                                by="{{ $rs4->by }}"><strong>By:</strong>
                                                                                {{ $rs4->by }}</small>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li style="list-style:none;" class="text-center"
                                                                no-record="">No Record.</li>
                                                        @endif
                                                    </ol>
                                                </div>
                                                <div class="col-lg-12 py-1">
                                                    <p class="text-black profile-total mb-2">Total: </p>
                                                    <p class="text-black profile-by mb-0 pb-0">By: </p>
                                                </div>
                                            </div>
                                            @php($CompanyMd = \App\Models\CompanyMd::class)
                                            @php($noDesign = $CompanyMd::whereNull('more_th')->whereNull('more_jp')->count())
                                            @php($remain = $CompanyMd::whereNull('logo')->count())
                                            @php($public = $CompanyMd::where('public', 1)->count())
                                            @php($lastStep = $CompanyMd::whereNotNull('edited')->where('public', 0)->count())
                                            @php($allCompany = $CompanyMd::count())
                                            @php($remainning = $remain)
                                            <div class="row profile-remainning" style="margin-top: 12px;">
                                                <div class="col-lg-6 col-xs-12">
                                                    <strong>Remaining to be detail data (2):</strong>
                                                    <span>{{ number_format($noDesign) }}</span>
                                                </div>
                                                <div class="col-lg-6 col-xs-12">
                                                    <strong>Remaining to be design (3):</strong>
                                                    <span>{{ number_format($remainning) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12 col-md-12">
                                    <div class="_card bg-secondary">
                                        <div class="_card-body blog-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h6>Blog Progress</h6>
                                                    <a href="javascript:" class="blog-today text-dark ml-2"
                                                        title="Refresh"><i class="fas fa-sync-alt"></i></a>
                                                </div>
                                                <div class="position-absolute mr-3" style="right:0;">
                                                    <a href="javascript:" class="text-dark blog-more"><i
                                                            class="fas fa-angle-down fa-lg"></i></a>
                                                </div>
                                                <div class="col-sm-6 col-md-4 col-lg-6 tab-blog-activity"
                                                    data-tab="blog-created">
                                                    <div class="fs-4 fw-semibold">
                                                        <span>{{ $blogCreated }}</span>/{{ $goalBlog }}</div>
                                                    <small
                                                        class="text-medium-emphasis text-uppercase fw-semibold">Created</small>
                                                    <small class="float-right">{{ $blog_per_created }}%</small>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $blog_per_created }}%"
                                                            aria-valuenow="{{ $blog_per_created }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 col-lg-6 tab-blog-activity"
                                                    data-tab="blog-online">
                                                    <div class="fs-4 fw-semibold">
                                                        <span>{{ $blogOnline }}</span>/{{ $goalBlog }}</div>
                                                    <small
                                                        class="text-medium-emphasis text-uppercase fw-semibold">Online</small>
                                                    <small class="float-right">{{ $blog_per_online }}%</small>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: {{ $blog_per_online }}%"
                                                            aria-valuenow="{{ $blog_per_online }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php($blogSelect = ['blog.id', 'category.name_jp as categoryName', 'category.key', 'category.id as categoryId', 'blog.name_th', 'blog.created', 'blog.created_by', 'blog.publish', 'blog.published_by'])
                                            @php($query = $BlogMd::select($blogSelect)->leftJoin('category', 'blog.type', '=', 'category.id'))
                                            <div class="row d-none">
                                                <div class="col-lg-12 pt-3" tab="blog-created"
                                                    tab-toggle="blog-activity">
                                                    <ol class="pl-4 mb-1 activity-list">
                                                        @foreach ($query->where(db::raw('DATE(blog.created)'), 'like', $now)->get() as $k => $rs)
                                                            <li id="{{ $rs->categoryId }}"
                                                                category="{{ $rs->categoryName }}">
                                                                <div class="list-item d-flex position-relative">
                                                                    <strong>{{ $rs->categoryName }}</strong><span>{{ $rs->name_th }}</span>
                                                                    @if ($rs->created_by != '')
                                                                        <small class="list-item-right"
                                                                            blog-by="{{ $rs->created_by }}"><strong>By:</strong>
                                                                            {{ $rs->created_by }}</small>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </div>
                                                <div class="col-lg-12 pt-3 d-none" tab="blog-online"
                                                    tab-toggle="blog-activity">
                                                    <ol class="pl-4 mb-1 activity-list">
                                                        @foreach ($query->where(db::raw('DATE(blog.publish)'), 'like', $now)->get() as $k => $rs)
                                                            <li id="{{ $rs->categoryId }}"
                                                                category="{{ $rs->categoryName }}">
                                                                <div class="list-item d-flex position-relative">
                                                                    <strong>{{ $rs->categoryName }}</strong><a
                                                                        href="{{ url('/th/blog') }}"
                                                                        target="_blank">{{ $rs->name_th }} </a>
                                                                    @if ($rs->published_by != '')
                                                                        <small class="list-item-right"
                                                                            blog-by="{{ $rs->published_by }}"><strong>By:</strong>
                                                                            {{ $rs->published_by }}</small>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </div>
                                                <div class="col-lg-12 py-1">
                                                    <p class="text-black blog-total mb-2">Total: </p>
                                                    <p class="text-black blog-by mb-0 pb-0">By: </p>
                                                </div>
                                            </div>
                                            <div class="row blog-remainning" style="margin-top: 12px;">
                                                <div class="col-lg-12">
                                                    <strong>All Blog :</strong> <span>{{ $blog }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            @php($CompanyMd=\App\Models\CompanyMd::class)
                            @php($online = $CompanyMd::where('public',1)->count())
                            @php($onlineFull = $CompanyMd::where(['public'=>1,'type'=>'full'])->count())
                            @php($onlineBasic = $CompanyMd::where(['type'=>'basic','public'=>1])->count())
                            @php($completedOn = $CompanyMd::leftJoin('job_progress','company.id','job_progress.company')->where(['company.type'=>'full','company.public'=> 1,'job_progress.step1'=>1,'job_progress.step2'=>1,'job_progress.step3'=>1])->count())
                            @php($completedOff = $CompanyMd::leftJoin('job_progress','company.id','job_progress.company')->where(['company.type'=>'full','company.public'=> 0,'job_progress.step1'=>1,'job_progress.step2'=>1,'job_progress.step3'=>1])->count())
                            @php($refuse = $CompanyMd::leftJoin('job_cs','company.id','job_cs.company')->where('company.type','full')->whereNotNull('job_cs.refuse')->count())
                            @php($completedOff = $completedOff - $refuse)
                            @php($completedTotal = $completedOn + $completedOff)
                            @php($delisted = \App\Models\CompanyMd::onlyTrashed()->count())
                            @php($grandTotal = ($completedTotal + $delisted + $refuse))
                            @php($grandTotalExceptDelisted = ($completedTotal + $refuse))
                            @php($sum = $CompanyMd::select('name_th')->groupBy('name_th')->get()->count())

                            <div class="d-none summary-category" id="summaryCategory">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="_card mb-3 bg-success bg-success-gradient">
                                                    <div class="_card-body p-3">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-3 col-xs-12 col-md-3 text-white text-center">
                                                                <h6>Online</h6>
                                                                <h6>{{ number_format($online) }}</h6>
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-6">
                                                                        Full<br />{{ number_format($onlineFull) }}</div>
                                                                    <div class="col-lg-6 col-md-6 col-6">
                                                                        Basic<br />{{ number_format($onlineBasic) }}</div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-4 col-xs-12 col-md-4 text-white text-center mb-1 border-left">
                                                                <div class="border-top w-100 my-1 d-block d-sm-none"></div>
                                                                <h6>Completed</h6>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-xs-12"><span
                                                                            class="float-left">Full Online</span> <span
                                                                            class="float-right">{{ number_format($completedOn) }}</span>
                                                                    </div>
                                                                    <div class="col-lg-12 col-xs-12"><span
                                                                            class="float-left">Full Offline</span> <span
                                                                            class="float-right">{{ number_format($completedOff) }}</span>
                                                                    </div>
                                                                    <div class="col-lg-12 col-xs-12"><span
                                                                            class="float-left">Total</span> <span
                                                                            class="float-right">{{ number_format($completedTotal) }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-5 col-xs-12 col-md-5 text-white text-center border-left mb-1">
                                                                <div class="border-top w-100 my-1 d-block d-sm-none"></div>
                                                                <h6>All Company</h6>
                                                                <h6>{{ number_format($CompanyMd::count()) }}</h6>
                                                                <div class="row">
                                                                    <div class="col-4 col-lg-4 col-md-4">
                                                                        <span>Basic</span><br />{{ number_format($CompanyMd::where('type', 'basic')->count()) }}
                                                                    </div>
                                                                    <div class="col-4 col-lg-4 col-md-4">
                                                                        <span>Full</span><br />{{ number_format($CompanyMd::leftJoin('job_progress', 'company.id', 'job_progress.company')->where(['company.type' => 'full', 'job_progress.step1' => 1, 'job_progress.step2' => 1, 'job_progress.step3' => 1])->count()) }}
                                                                    </div>
                                                                    <div class="col-4 col-lg-4 col-md-4">
                                                                        <span>Progress</span><br />{{ number_format(
                                                                            $CompanyMd
                                                                                ::leftJoin('job_progress', 'company.id', 'job_progress.company')->where('company.type', 'full')->where(function ($query) {
                                                                                    $query->where(['job_progress.step1' => 1, 'job_progress.step2' => 1])->orWhere(['job_progress.step1' => 1]);
                                                                                })->whereNull(['step3'])->count(),
                                                                        ) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                            <div class="border-top w-100 my-1"></div>
                                                            <div class="row">
                                                                <div class="col-lg-7 col-md-7 col-xs-12 mt-1">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 d-none d-sm-block">
                                                                    <p class="mb-0 text-white">Completed total </p>
                                                                    <p class="mb-0 text-white">Delisted company </p>
                                                                    <p class="mb-0 text-white">Refuse Company </p>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 d-none d-sm-block">
                                                                    <p class="mb-0 text-white">{{number_format($completedTotal)}}</p>
                                                                    <p class="mb-0 text-white">{{number_format($delisted)}}</p>
                                                                    <p class="mb-0 text-white">{{number_format($refuse)}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row d-block d-sm-none">
                                                                    <div class="col-sm-12">
                                                                    <p class="mb-0 text-white">Completed total : {{number_format($completedTotal)}}</p>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                    <p class="mb-0 text-white">Delisted company : {{number_format($delisted)}}</p>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-lg-5 col-md-5 col-xs-12 border-left mt-1">
                                                                    <div>
                                                                        <span class="text-white">Grand Total : </span>
                                                                        <span class="text-white">{{number_format($grandTotal)}}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="text-white">Grand Total Except Delisted : </span>
                                                                        <span class="text-white">{{number_format($grandTotalExceptDelisted)}}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="text-white">Sum : </span>
                                                                        <span class="text-white">{{number_format($sum)}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @foreach ($myCategory as $k => $item)
                                                <div class="col-lg-2 col-sm-6 col-md-4 industry-item">
                                                    <div class="card mb-3 bg-light-gradient">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12"><span class="dot"
                                                                        style="font-size: 17px;">{{ $k + 1 }}.
                                                                        {{ $item->name }}</span></div>
                                                                <div class="col-left col-lg-12 col-xs-12">
                                                                    <div
                                                                        class="font-weight-bold fs-4 fw-semibold text-success">
                                                                        {{ number_format($item->online) }}
                                                                        <small
                                                                            class="fs-2 fw-semibold text-dark">/{{ number_format($item->company) }}</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-right mt-2 col-lg-12 col-xs-12">
                                                                    <a href="{{ url('webpanel/company') }}/{{ $item->key }}?offline=1"
                                                                        class="text-dark">
                                                                        <p class="mb-1">
                                                                            <span
                                                                                class="badge badge-dark">{{ $item->offline }}</span>
                                                                            Offline
                                                                        </p>
                                                                    </a>
                                                                    <a href="{{ url('webpanel/company') }}/{{ $item->key }}?no_detail=1"
                                                                        class="text-dark">
                                                                        <p class="mb-1">
                                                                            <span
                                                                                class="badge badge-info">{{ $item->no_detail }}</span>
                                                                            No Detail
                                                                        </p>
                                                                    </a>
                                                                    <a href="{{ url('webpanel/company') }}/{{ $item->key }}?no_logo=1"
                                                                        class="text-dark">
                                                                        <p class="mb-1">
                                                                            <span
                                                                                class="badge badge-primary">{{ $item->no_design }}</span>
                                                                            No Design
                                                                        </p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-md-12">
                                        <div class="full-category">
                                            {{-- <div class="cate-grid">
                                                @foreach(\App\Models\CategoryMainMd::get() as $km => $vm)
                                                @php($active=($km==0)?'--cate-active':'')
                                                <div class="cate-col">
                                                    <a href="javascript:" class="cate-item _get-sub-category {{$active}}" main="{{$vm->id}}">
                                                        <div class="d-flex">
                                                            <div class="cate-body">
                                                                <h6 class="cate-title">{{$vm->name_en}}</h6>
                                                                <div class="cate-content">{{$vm->name_th}}</div>
                                                                <img class="cate-logo" src="{{$vm->logo}}">
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div> --}}
                                            <div class="_row mb-3">
                                                <div class="_col _col-lg-16 _col-sm-16">
                                                    <div class="_card overflow-hidden">
                                                        <div class="_card-body p-0">
                                                            <div class="_row">
                                                                <div class="_col _col-lg-4 _col-xs-16 left-content" style="height:480px; overflow-y:scroll;">
                                                                    @foreach(\App\Models\CategoryMainMd::get() as $km => $vm)
                                                                    <p class="mt-3 mb-2 pl-2 font-weight-bold">{{$vm->name_th}}</p>
                                                                    <ul class="_list-group mt-2 mb-3 _rounded bg-white" id="sub-category">
                                                                        @foreach(\App\Models\CategorySubMd::where('category_main',$vm->id)->get() as $k => $vs)
                                                                        <li sub="{{$vs->id}}" class="_list-item _link _get-category position-relative @if($k==0)--cate-active @endif">
                                                                            <img src="{{$vs->icon}}" class="position-absolute" width="45px" style="top:0; left:0;">
                                                                            <p class="m-0 ml-4 pl-2">{{$vs->name_en}}</p>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    @endforeach
                                                                </div>
                                                                <div class="_col _col-lg-12 _col-xs-16 right-content position-relative" id="count_job">
                                                                    @php($categories=\App\Models\CategoryMd::select(['category.*','cs.name_th as sub_name_th','cs.name_th as sub_name_jp'])->leftJoin('category_sub as cs','category.category_sub','=','cs.id')->where('category_sub',1)->get())
                                                                    <div class="mt-3">
                                                                        <p class="mt-3 mb-2 pl-2 font-weight-bold ml-2">{{$categories[0]->sub_name_th}}</p>
                                                                        <div class="position-absolute mt-3" style="right:10px; top:0;">
                                                                            <a href="javascript:" class="search-category px-3" style="padding-top:2px; padding-bottom:2px; text-decoration: none;">
                                                                                <i class="fas fa-search"></i>
                                                                                <span class="ml-1" style="font-size:16px;"> Search</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="media-grid">
                                                                        @foreach($categories as $kc => $vc)
                                                                        <div class="media-col">
                                                                            <div href="javascript:" class="cate-item bg-white">
                                                                                <div class="media-body">
                                                                                    <p class="text-ellipsis m-0">{{$vc->name_th}}</p>
                                                                                    <p class="text-ellipsis m-0">{{$vc->name_en}}</p>
                                                                                    <a href="webpanel/company/{{$vc->key}}?offline=1" target="_blank" class="badge badge-dark mr-1">0 | Off</a>
                                                                                    <a href="webpanel/company/{{$vc->key}}?online=1" target="_blank" class="badge badge-success mr-1">0 | On</a><br>
                                                                                    <span class="badge badge-info mr-1">0</span>
                                                                                    <small><a href="webpanel/company/{{$vc->key}}?no_detail=1" target="_blank">No Detail</a></small><br>
                                                                                    <span class="badge badge-primary mr-1">0</span>
                                                                                    <small><a href="webpanel/company/{{$vc->key}}?no_detail=1" target="_blank">No Design</a></small><br>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="onlineTable">
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-end">
                                        @php($m = date('m'))
                                        @php($lastYear = date('Y'))
                                        <div class="ml-auto">
                                            <form action="" class="form-inline">
                                                <div class="form-group">
                                                    <select name="year" class="custom-select">
                                                        <option value="" hidden>Year</option>
                                                        <option value="2024" selected>2024</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2022">2022</option>
                                                    </select>
                                                    <select name="month" class="custom-select ml-1" id="inputGroupSelect02">
                                                        <option hidden>Choose...</option>
                                                        @for ($i = 0; $i < 12; $i++)
                                                            <option value="{{ $i + 1 }}"
                                                                @if (date('m') == $i + 1) selected @endif>
                                                                {{ $month[$i] }}</option>
                                                        @endfor
                                                    </select>
                                                    <button type="button" class="btn btn-success ml-1 online-search"
                                                        for="inputGroupSelect02">Search</button>
                                                    <button type="button"
                                                        class="btn btn-success btn-lg ml-2 online-print"><i
                                                            class="fas fa-print"></i></button>
                                                </div>
                                            </form>
                                            <button class="btn btn-outline-defaut"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    @php($ym = date('Y-m'))
                                    {{-- <div class="_card bg-ultralight">
                                        <div class="_card-body">
                                            <table class="table table-hover table-sm">
                                                <thead>
                                                    <tr><td>DAYS</td></tr>
                                                </thead>
                                                <tbody>
                                                    @for($i=1; $i<=31; $i++)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                    </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> --}}
{{--                                     
                                    <div class="_card bg-ultralight overflow-hidden">
                                        <div class="_card-body p-0"> --}}
                                            <table class="table thead-sticky border-top-0 bg-white">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2"
                                                            style="text-align:center; vertical-align:middle;"
                                                            class="border-top-0">Category</th>
                                                        <th class="online-title border-top-0 border-left" colspan="32"
                                                            style="text-align:center;">
                                                            {{ date('F Y') }}</th>
                                                    </tr>
                                                    <tr class="dayOfMonth">
                                                        @for ($h = 1; $h <= 31; $h++)
                                                            <th style="font-weight:500; text-align:conter; border-left:1px solid #dedede; -webkit-print-color-adjust:exact !important;">
                                                                @if ($h <= $lastday)
                                                                    {{ $h }}
                                                                @endif
                                                            </th>
                                                        @endfor
                                                        <th>Sum</th>
                                                    </tr>
                                                </thead>
                                                @php($category = \App\Models\CategoryMd::select('id', 'name_jp', 'key')->where('status', 1)->get())
                                                <tbody>
                                                    @foreach ($category as $key => $row)
                                                        <tr class="row-industry" key="{{ $row->key }}"
                                                            id="row{{ $key + 1 }}">
                                                            <td>{{ $row->name_jp }}</td>
                                                            @for ($j = 1; $j <= 31; $j++)
                                                                <td class="online-number text-center"
                                                                    style="-webkit-print-color-adjust:exact !important; color: rgb(214, 214, 214);">
                                                                    0</td>
                                                            @endfor
                                                            <td class="sum text-center"></td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="row-sum">
                                                        <td style="text-align:right;"><strong>Sum</strong></td>
                                                        @for ($k = 1; $k <= 31; $k++)
                                                            <td class="sum-bottom text-center"
                                                                style="color: rgb(214, 214, 214);">0</td>
                                                        @endfor
                                                        <td class="sum-bottom text-center"
                                                            style="font-weight:bold; text-decoration:underline;"></td>
                                                    </tr>
                                                    <tr class="text-primary">
                                                        <td style="text-align:right;"><strong>Designed</strong></td>
                                                        @for ($k = 1; $k <= 31; $k++)
                                                            @php($d = $k < 10 ? "0$k" : "$k")
                                                            <td class="sum-design text-center" style="border-top:2px;">0
                                                            </td>
                                                        @endfor
                                                        <td class="sum-design text-center"
                                                            style="font-weight:bold; text-decoration:underline;"></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
                                        {{-- </div>
                                </div> --}}

                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-sm-6 col-lg-2 pl-2 pr-2">
                        <div class="card text-white bg-gradient-primary">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div class="text-value-lg">{{$member}}</div>
                                <div>Members</div>
                            </div>
                        </div>
                        </div> --}}
                    {{-- <div class="col-lg-2">
                        <h5>&nbsp;</h5>
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 pl-2 pr-2">
                            <div class="card text-white bg-gradient-info mb-3">
                                <div class="card-body d-flex justify-content-between align-items-start">
                                    <div class="text-value-lg">{{$count_mail}}</div>
                                    <div>Mail</div>
                                </div>
                            </div>
                            </div>

                            <div class="col-xs-12 col-lg-12 pl-2 pr-2">
                            <div class="card text-white bg-gradient-warning">
                                <div class="card-body d-flex justify-content-between align-items-start">
                                    <div class="text-value-lg">{{$blog}}</div>
                                    <div>Blog</div>
                                </div>
                            </div>
                            </div>

                        </div>
                        </div>
                        --}}
                </div>
                {{-- <div class="row online-section" id="onlineTable">
                        <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                            @php($m=date('m'))
                            @php($lastYear=date('Y'))
                            <form action="" class="form-inline mb-4">
                                <div class="form-group">
                                <select name="year" class="custom-select">
                                    <option value="">Year</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                                <select name="month" class="custom-select ml-1" id="inputGroupSelect02">
                                    <option hidden>Choose...</option>
                                    @for ($i = 0; $i < 12; $i++)
                                    <option value="{{$i+1}}" @if (date('m') == $i + 1) selected @endif>{{$month[$i]}}</option>
                                    @endfor
                                </select>
                                <button type="button" class="btn btn-outline-success ml-1 online-search" for="inputGroupSelect02">Search</button>
                                <button type="button" class="btn btn-outline-success ml-2 online-print"><i class="fas fa-print"></i></button>
                                </div>
                            </form>
                            <button class="btn btn-outline-defaut"></button>
                            </div>
                        </div>
                        @php($ym=date('Y-m'))
                        <div class="table-responsive table-industry">
                            <table class="table table-bordered thead-sticky">
                            <thead>
                                <tr><th rowspan="2" style="text-align:center; vertical-align:middle;">Industry</th><th class="online-title" colspan="32" style="text-align:center; background-color: #ced2d8;">{{date('F Y')}}</th></tr>
                                <tr class="dayOfMonth">
                                @for ($h = 1; $h <= 31; $h++)
                                @php($day=date('D',strtotime($ym.'-'.sprintf("%02d",$h))))
                                <th class="text-center" style="font-weight:500; text-align:conter;@if ($day == 'Sun' || $day == 'Sat')background-color:rgb(243,243,243);@endif -webkit-print-color-adjust:exact !important;">@if ($h <= $lastday){{$h}}@endif</th>
                                @endfor
                                <th>Sum</th>
                                </tr>
                            </thead>
                            @php($data=\App\Models\IndustryMd::select('id','name_jp','key')->where('status',1)->whereNull('coming_soon')->get())
                            <tbody>
                                @foreach ($data as $key => $row)
                                <tr class="row-industry" key="{{$row->key}}" id="row{{$key+1}}">
                                <td>{{$row->name_jp}}</td>
                                @for ($j = 1; $j <= 31; $j++)
                                @php($day=date('D',strtotime($ym.'-'.sprintf("%02d",$j))))
                                @php($count=\App\Models\CompanyMd::where('industry',$row->id)->where(db::raw('DATE(published_on)'),'like',date('Y-m-d',strtotime($ym.'-'.sprintf("%02d",$j))))->count())
                                <td class="online-number text-center" style="@if ($day == 'Sun' || $day == 'Sat')background-color:rgb(243,243,243);@endif @if ($count == 0)color:rgb(214,214,214);@endif -webkit-print-color-adjust:exact !important;">
                                    @if ($j <= $lastday){{$count}}@endif
                                </td>
                                @endfor
                                <td class="sum text-center"></td>
                                </tr>
                                @endforeach
                                <tr class="row-sum">
                                <td style="text-align:right;"><strong>Sum</strong></td>
                                @for ($k = 1; $k <= 31; $k++)
                                <td class="sum-bottom text-center"></td>
                                @endfor
                                <td class="sum-bottom text-center" style="font-weight:bold; text-decoration:underline;"></td>
                                </tr>
                                <tr class="text-primary">
                                <td style="text-align:right;"><strong>Designed</strong></td>
                                @for ($k = 1; $k <= 31; $k++)
                                @php($d = ($k<10)?"0$k":"$k")
                                <td class="sum-design text-center" style="border-top:2px;">{{\App\Models\JobProgressMd::where('step3',1)->where(DB::raw('(DATE_FORMAT(step3_on,"%Y-%m-%d"))'),date("Y-m-$d"))->count()}}</td>
                                @endfor
                                <td class="sum-design text-center" style="font-weight:bold; text-decoration:underline;"></td>
                                </tr>
                            </tbody>
                            <tfoot></tfoot>
                            </table>
                        </div>
                        </div>
                    </div> --}}
                {{--
                    </div>
                </div> --}}
            </div>
        </div>
        {{--
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        Email History
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped no-footer table-res" id="sort_table" role="grid" style="border-collapse: collapse !important">
                                                        <thead>
                                                            <tr role="">
                                                                <th width="5%">#</th>
                                                                <th width="15%">To</th>
                                                                <th width="10%">Name</th>
                                                                <th width="40%">Messages</th>
                                                                <th width="10%">Email,Telephone</th>
                                                                <th width="10%">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (!empty($history_mail))
                                                                @foreach ($history_mail as $key => $mail)
                                                                    <tr role="row" class="odd">
                                                                        <td data-label="No."><span class="no">{{$key+1}}</span> <i class="fas fa-bars handle d-none"></i></td>
                                                                        <td data-label="Sender, Company">
                                                                            {{$mail->to}},<br>
                                                                            {{$mail->company}}
                                                                        </td>
                                                                        <td data-label="Sender name">{{$mail->name}}</td>
                                                                        <td data-label="Message">{{$mail->content}}</td>
                                                                        <td data-label="Receiver, Company">{{$mail->email}}, {{$mail->telephone}}</td>
                                                                        <td data-label="Created :">{{date('d-m-Y H:i:s',strtotime($mail->created))}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">{{$history_mail->links()}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        --}}
    </div>
</div>
{{-- <script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script> --}}
<script src="back-end/build/loading-overlay.js"></script>
<script src="js/popper.min.js"></script>
<script>
    var loaded = {};
    const setSummaryHeight = () => {
        summaryItem = document.querySelector('.summary-category');
        const items = document.querySelectorAll('.industry-item');
        const last = items.length - 1;
        cal = Math.floor(items.length / 12);
        if (cal <= 3) {
            summaryItem.classList.add('col-lg-6')
            summaryItem.querySelector('.bg-success').style.height = (items[last].clientHeight + 12) + 'px';
        }
    }

    onlineMore = (el) => {

        icon = {
            minimize: "fa-compress-alt",
            maximize: 'fa-expand-alt'
        };
        el.find('i').toggleClass(icon.maximize + ' ' + icon.minimize);
        onlineSection = $('.online-section');
        onlineSection.toggleClass('d-none d-block');
        table = onlineSection.find('table');

    }
    $(document).on('click', '.online-more', function() {
        onlineMore($(this));
    });

    function printDiv(divName, css) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');
        head.appendChild(style);
        style.type = 'text/css';
        if (style.styleSheet) style.styleSheet.cssText = css; /* This is required for IE8 and below.*/
        else style.appendChild(document.createTextNode(css));

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    $(document).on('click', '.online-search', function() {
        $('.loading-overlay').fadeIn(300);
        setTimeout(() => {
            let m = $('select[name="month"]').val();
            let y = $('select[name="year"]').val();
            let my = m + '-' + y;
            let title = my;

            loaded.first = getOnlineOfMonth(my);
            loaded.designed = getDesignedOfMonth(my);
            console.log(loaded.first)

            fetchData(loaded.first, title, my);
            fetchDesigned(loaded.designed);

            if (Object.keys(loaded).length == 2) {
                $(".loading-overlay").fadeOut(300);
                loaded = {};
            }

        }, 500);
    })
    const getOnlineOfMonth = (my) => {
        let data = $.ajax({
            url: '/api/getOnlineOfMonth',
            method: 'get',
            async: false,
            data: {
                my: my
            },
            success: (res) => {

            }
        }).responseJSON;


        return data;
    }
    const getDesignedOfMonth = (my) => {
        let data = $.ajax({
            url: '/api/getDesignedOfMonth',
            method: 'get',
            async: false,
            data: {
                my: my
            }
        }).responseJSON;

        return data;
    }
    const fetchData = (data, title, my) => {

        const categoryOnce = $('.row-industry:first').attr('key');
        const currLength = $('.dayOfMonth').find('th:not(:last-child)').length;
        const newLength = data[categoryOnce]?.length;
        const dayOfMonth = $('.dayOfMonth').find('th:not(:last-child)');

        my = my.split('-');
        y = my[1];
        m = my[0];

        const LastDayOfMonth = new Date(y, m, 0).getDate();
        $('.online-title').html(title);
        const holiday = (y, m, d) => {
            var theDate = new Date(y + '-' + m + '-' + d);
            var myNewDate = new Date(theDate);
            return (myNewDate.getDay() == 0 || myNewDate.getDay() == 6) ? 'rgb(243,243,243)' :
                'rgb(255,255,255)';
        }

        dayOfMonth.each(function(k, v) {
            $(v).css('background-color', holiday(y, m, k + 1));
            if (k >= newLength) {
                $(v).html('');
            } else {
                $(v).html(k + 1)
            }
        });
        $('.row-industry').each(function() {
            $(this).find('td:not(:last-child)').each(function(k, v) {
                if (k > 0 && k > LastDayOfMonth) {
                    $(v).html('');
                }
                if (k > 0) {
                    $(v).css('background-color', holiday(y, m, k));
                }
            })
        });
        $('.online-section').find('tbody tr:last-child').find('td:not(:last-child)').each(function(k, v) {
            if (k > 0 && k > LastDayOfMonth) {
                $(v).css('background-color', holiday(y, m, k + 1));
                $(v).html('');
            }
        })

        const newCalculateTheSum = () => {
            $('.row-industry').each(function(key, value) {
                let number = [];
                $(value).find('.online-number').each(function() {
                    n = ($(this).html() == ' ') ? 0 : parseInt($(this).html());
                    if (!isNaN(n)) number.push(n);
                });
                sum = 0;
                sum = number.reduce(function(a, b) {
                    return a + b;
                }, 0)
                last = $(value).find('td:last');
                last.css('color', 'rgb(0,0,0)');
                last.html(sum);
            });
            $('.sum-bottom').each(function(i, v) {
                $(this).html(0);
                number2 = [];
                $('.row-industry').each(function() {
                    n = ($(this).find('td').eq(i + 1).html() == ' ') ? 0 : parseInt($(this)
                        .find('td').eq(i + 1).html());
                    if (!isNaN(n)) number2.push(n);
                });

                sum2 = number2.reduce(function(a, b) {
                    return a + b;
                }, 0)
                if (sum2 > 0) $(v).css({
                    'color': 'rgb(0,0,0)'
                });
                else $(v).css({
                    color: 'rgb(214, 214, 214)'
                });
                if (sum2 != ' ') $(v).css({
                    'color': 'rgb(0,0,0)'
                }).html(sum2);
            })
        }


        $('.row-industry').each(function(key, value) {
            category = $(value).attr('key');
            $(value).find('td').each(function(k, v) {
                if (k > 0) {
                    td = $(v);
                    if (data[category][k - 1] > 0) {
                        color = 'rgb(0,0,0)';
                    } else {
                        color = 'rgb(214,214,214)';
                    }
                    td.css('color', color);
                    td.html(data[category][k - 1]);
                }
            })
        })
        newCalculateTheSum();

    }

    const fetchDesigned = (data) => {
        $('.sum-design:not(:last-child)').each(function(k, e) {
            $(e).html(data[k])
        });
        let sum = data.reduce((a, b) => a + b, 0);
        $('.sum-design:last-child').html(sum);
    }

    $.each($('.row-sum').find('td'), function(k, e) {
        $(e).css('border-bottom', '3px solid #d8dbe0');
    })
    let sumDesign = 0;
    $.each($('.sum-design').not(':last-child'), function(k, e) {
        sumDesign = sumDesign + Number($(e).html());
    })
    $('.sum-design:last-child').html(sumDesign);

    const onlineTableOffset = $('#onlineTable').offset();
    const onlineTableSection = document.getElementById('onlineTable');

    function active(e) {
        $(e).toggleClass('--active');
    }

    calcHeight();

    document.addEventListener('click', function(e) {
        const cHeaderToggler = e.target.closest('.c-header-toggler');
        if(cHeaderToggler){ calcHeight(); }
        const item = e.target.closest('.media-item');
        if (item) {
            calcHeight();
            let href = item.getAttribute('href');
            href = href.replace('javascript:', '');
            href = `${href}`;
            if (href != '') {
                active(item)
                if (href == '#todayActivity') {
                    cur = $(item);
                    $(href).toggleClass('d-none');
                }
                if (href == '#summaryCategory') {
                    cur = $(item);
                    $(href).toggleClass('d-none');
                }
                if (href == '#onlineTable') {
                    cur = $(item);
                    $(href).toggleClass('d-none');
                    const onlineTableOffset = $(href).find('table')[0];
                    if (!$(href).hasClass('d-none')) {
                        window.scroll({
                            top: $(onlineTableOffset).offset().top - 42,
                            behavior: 'smooth'
                        });
                    }
                }
            }
        }
        const subCategory = e.target.closest('._get-sub-category');
        if(subCategory)
        {
            $('.loading-overlay').fadeIn(300);
            setTimeout(() => {
                let main = subCategory.getAttribute('main');
                let data = getSubCategory(main);
                const content = document.getElementById('sub-category');
                const Countcontent = document.getElementById('count_job');
                Countcontent.querySelector('.media-grid').innerHTML = '';
                if(data.length > 0)
                {
                    content.innerHTML = '';
                    Array.from(data).map(function(v,k){
                        let item = document.createElement('li');
                        item.setAttribute('sub',v.id);
                        item.setAttribute('class','_list-item _link _get-category position-relative');
                        item.innerHTML += `<img src="${v.icon}" class="position-absolute" width="45px" style="top:0; left:0;">
                            <p class="m-0 ml-4 pl-2">${v.name_th}</p>`;
                            content.append(item)
                    })
                    $(".loading-overlay").fadeOut(300);
                    setActiveJob(subCategory,'._get-sub-category');
                }
            }, 500);
        }
        const getCategory = e.target.closest('._get-category');
        if(getCategory)
        {
            $('.loading-overlay').fadeIn(300);
            setTimeout(()=>{
                let sub = getCategory.getAttribute('sub');
                let data = countTheNumberOfJob(sub);
                const content = document.getElementById('count_job');
                if(data.length > 0)
                {
                    content.querySelector('.media-grid').innerHTML = '';
                    Array.from(data).map(function(v,k){
                        let item = document.createElement('div');
                        item.classList.add('media-col');
                        item.innerHTML = `<div class="cate-item bg-white">
                            <div class="media-body">
                                <p class="text-ellipsis m-0" title="${v.nameTH}">${v.nameTH}</p>
                                <p class="text-ellipsis m-0" title="${v.nameEN}">${v.nameEN}</p>
                                <a href="webpanel/company/${v.key}?offline=1" target="_blank" class="badge badge-dark">${v.count.offline} | Off<a>
                                <a href="javascript:" target="_blank" class="badge badge-success">${v.count.online} | On</a>
                                <br>
                                <span class="badge badge-info">${v.count.no_detail}</span>
                                <small><a href="webpanel/company/${v.key}?no_detail=1" target="_blank">No Detail</small><br>
                                <span class="badge badge-primary">${v.count.no_design}</span>
                                <small><a href="webpanel/company/${v.key}?no_design=1" target="_blank">No Design</small><br>
                            </div>
                        </div>`;
                        content.querySelector('.media-grid').append(item);
                    });
                    $(".loading-overlay").fadeOut(300);
                    setActiveJob(getCategory,'._get-category')
                }
            },500)
        }
        // searchCategory = e.target.closest('.search-category');
        // if(searchCategory)
        // {
        //     const col = searchCategory.closest('._col');
        //     let maxWidth = col.offsetWidth;
        //     const form = searchCategory.previousElementSibling;
        //     const input = form.querySelector('input');
        //     const cancel = form.querySelector('.cancel-search');
        //     cancel.classList.remove('d-none');
        //     input.classList.remove('d-none');
        //     const box = form.parentElement;
        //     box.style.zIndex = '999';
        //     searchCategory.classList.add('d-none');
        //     form.classList.remove('d-none');
        //     // searchCategory
        // }
        const cancelSearch = e.target.closest('.cancel-search');
        if(cancelSearch)
        {
            cancelSearch.classList.remove('d-none');
            const form = cancelSearch.parentElement;
            const input = form.querySelector('input');
            input.classList.add('d-none');
            const box = form.parentElement;
            const action = box.querySelector('a');
            box.style.zIndex = '';
            cancelSearch.classList.add('d-none');
            form.classList.add('d-none');
            action.classList.remove('d-none');
        }
    })

    // onlineTable.on('click','.btn-primary',function(){
    // cur = $(this);
    // cur.toggleClass('show');
    // cur.find('.fas').toggleClass('fa-caret-right fa-caret-down');
    // onlineTable.find('.table-industry').toggleClass('d-none');
    // onlineForm.toggleClass('d-none');
    // if (cur.hasClass('show')) {
    //     window.scroll({
    //         top: onlineTableOffset.top - 42,
    //         behavior: 'smooth'
    //     });
    // }

    // })
    window.addEventListener("orientationchange", (event) => {
        calcHeight()
    });

    categoryItem = document.querySelector('.industry-item');
    const itemWidth = categoryItem?.offsetWidth;

    if (itemWidth <= 220) {
        const items = document.querySelectorAll('.industry-item');
        // setSummaryHeight()
        for (i in items) {
            const left = items[i].querySelector('.col-left');
            const right = items[i].querySelector('.col-right');
            left.classList.add('col-lg-12');
            right.classList.add('col-lg-12');
        }

    }
    function getSubCategory(main)
    {
        const data = $.ajax({
            url:'api/get/sub-category',
            data:{'main':main},
            async:false
        }).responseJSON;
        return data;
    }
    function countTheNumberOfJob(sub)
    {
        const data = $.ajax({
            url:'api/category/get/countTheNumberOfJob',
            data:{'sub':sub},
            async:false,
        }).responseJSON;
        return data;
    }
    function setActiveJob(e,list)
    {
        const activeClass = '--cate-active';
        const items = $(`${list}`);
        // const items = $('._get-category');
        items.not(e).removeClass(`${activeClass}`);
        $(e).addClass(`${activeClass}`);
        // if(list == '._get-category'){
        //     e.appendChild(`::after`);
        // }
    }
    function calcHeight()
    {
        setTimeout(() => {
            let content = document.querySelector('.full-category');
            let leftContent = content.querySelector('.left-content');
            let rightContent = content.querySelector('.right-content');
            let height = rightContent.offsetHeight;
            if(height == 0) height = 480;
            console.log(height);
            leftContent.style.setProperty('height', `${height}px`);
        }, 500);

    }
    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
            callback.apply(context, args);
            }, ms || 0);
        };
    }


    // Example usage:

    $(document).on('keyup','input[name="q"]',delay(function(e){
        const destination = $(this).closest('#search-box');
        const noItem = '<li class="list-search-item text-center text-dark">No item</li>';
        console.log(destination.find('ul'));
        if(destination.find('ul').length == 0) {
            destination.append('<ul class="list-search bg-white"></ul>');
            destination.find('ul').html('');
        }
        // ul.innerHTML = '';
        if( $(this).val() != '' )
        {
            queryString = `keywords=`+this.value;
            res = fetchDataSearch(queryString);

            destination.find('ul').html(res);
        }else{

            destination.find('ul').html(noItem);
        }

    },800));
    $(document).on('click','#reset-button',function(){
        $(this).closest('#search-box').find('ul').remove();
    })

    function fetchDataSearch(queryString)
    {
        const data = $.ajax({
            url:'api/get/category/search?'+queryString,
            async:false,
        }).responseJSON;

        let li = '';
        if(data.length > 0){

            Array.from(data).map(function(v,k){
                li  += `<li class="list-search-item">
                    <a class="text-dark" href="webpanel/company/${v.key}" target="_blank">
                        <span class="badge badge-light mr-1">M.</span>${v.main_th} > 
                        <span class="badge badge-light mr-1">S.</span>${v.sub_th} >
                        <span class="badge badge-dark mr-1">Category</span><strong>${v.name_th}</strong> 
                    </a>
                </li>`;
            })
        }else{
            li += `<li class="list-search-item text-center text-dark">No item</li>`;
        }
        return li;
    }
</script>
<script type="text/javascript">
    $(function () {
        $("[data-toggl='tooltip']").tooltip();
    });
    $('#close-btn').click(function() {
        $('#search-overlay').fadeOut();
        $('#search-btn').show();
        
    });
    $('.search-category').click(function() {
        // $(this).hide();
        placeholder = 'Category';
        $('input[name="q"]').attr('placeholder',placeholder);
        $('input[name="q"]').focus();
        $('#search-overlay').fadeIn();
    });
</script>
<script src="back-end/build/profile-activity.js?v=07"></script>
<script src="back-end/build/blog-activity.js?v=01"></script>
