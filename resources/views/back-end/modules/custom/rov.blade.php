<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

    <title>Web Panel - Job Progress</title>

    <base href="{{url('/')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <link rel="stylesheet" href="back-end/fontawesome-5.15.4/css/all.css">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <link href="back-end/css/style.css" rel="stylesheet">
    {{-- <link href="back-end/bootstrap-4.3.1/css/bootstrap.css" rel="stylesheet"> --}}
    <link href="back-end/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    @if(@$css)
    @foreach($css as $css)
    <link href="{{$css}}" rel="stylesheet">
    @endforeach
    @endif
    @if(@$js)
    @foreach($js as $js)
    <script src="{{$js}}"></script>
    @endforeach
    @endif
    <style>
        .pagination {
            justify-content: center;
        }
        .player{
            cursor: pointer;
        }
        .player.active{
            color: #fff !important;
            background: #0275ff !important;
        }
        .input-invalid{
            color: #e55353;
            border-color: #e55353 !important;
        }
    </style>
</head>

<body class="c-app flex-row">
    <script>
        let c = localStorage.getItem("theme"),
            tag = document.getElementsByTagName('body').item(0);
        if (c != '' && c != null) tag.classList.add(c);
    </script>
    <div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        @include('back-end.layout.left-menu')
    </div>
    @php
        $data=\App\Models\CompanyMd::leftJoin('category','company.category','=','category.id')->where('type','full')->select(['company.id','company.type','company.detail_th','company.detail_en','company.detail_jp','company.detail_jp','company.name_th','company.name_jp','company.name_en','company.name_zh','company.more_th','company.more_en','company.more_jp','company.more_zh','category.name_jp as categoryName'])->paginate(100);
    @endphp
    <div class="c-wrapper">
        @include('back-end.layout.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid h-100">
                    {{-- <div class="row">
                        <div class="col-lg-12 ">
                            <button class="btn btn-primary add-player justify-content-center align-items-center" style="width:50px; height:50px; border-radius:50%;"><i class="fas fa-plus fa-lg"></i></button>
                        </div>
                    </div> --}}
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-xs-12 col-md-6">
                            <div class="card rounded-lg">
                                <div class="card-body">
                
                                        <h4 class="text-center">Options</h4>
                                        <label class="border rounded p-2 w-100" for="option1">
                                            <strong class="mb-0">
                                                <input type="radio" name="option" id="option1" value="player"> สุ่มผู้เล่น
                                            </strong>
                                        </label>
                                        <div class="form-group">
                                            <label class="border rounded p-2 mb-0 w-100" for="option2">
                                                <strong>
                                                    <input type="radio" name="option" id="option2" value="player+position"> สุ่มผู้เล่น + ตำแหน่ง
                                                </strong>
                                                <p class="text-center mb-0 player-position">เลน Dark Slayer, เลนกลาง, ฟาร์มป่า, โรมมิ่ง/ชัพพอร์ท, เลนมังกร</p>
                                            </label>
                                        </div>
                                        <h4 class="text-center">Team</h4>
                                        <div class="row justify-content-center">
                                            <label for="team5" class="py-2 px-3 border rounded mx-1 text-center">
                                                <input type="radio" name="team" id="team5" value="5">
                                                <strong class="pl-1">1 Team</strong><br>
                                                <small> 5 Players</small>
                                            </label>
                                            <label for="team10" class="py-2 px-3 border rounded mx-1 text-center">
                                                <input type="radio" name="team" id="team10" value="10">
                                                <strong class="pl-1">2 Teams</strong><br>
                                                <small>10 Players</small>
                                            </label>
                                        </div>
                                        <h4 class="text-center mt-2">Player</h4>
                                        <div class="form-group form-inline">
                                            @foreach(
                                                \App\Models\UsersMd::where(['status'=>'active'])
                                                    ->where('name','not like','%JWIL%')
                                                    ->whereNotIn('name',['RAY','AUM','EI'])
                                                    ->get()
                                                as $k => $v
                                            )
                                                <span class="btn btn-light btn-sm m-1 player">{{$v->name}}</span>
                                            @endforeach
                                        </div>
                                        <div class="form-group text-center mt-2">
                                            <button class="btn btn-primary btn-random">Random</button>
                                        </div>
                                        <div class="result-content"></div>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row h-100 justify-content-center align-items-center">
                        <div class="col-lg-12">
                                <p class="text-center mb-5"><i class="fas fa-biohazard fa-5x"></i></p>
                                <h1 class="text-center mb-3" style="font-size: 42px;">นั่นแน่!!!</h1>
                                <h2 class="text-center">รอก่อนใจเย็นๆ</h2>
                        </div>
                    </div> --}}
                </div>
            </main>
        </div>
        <footer class="c-footer">
            <div><a href="https://coreui.io">CoreUI</a> © 2019 creativeLabs.</div>
            <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
        </footer>
    </div>
</body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
<script src="back-end/vendors/pace-progress/js/pace.min.js"></script>
<script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script>
<script>
    var tooltipEl = document.getElementById('header-tooltip');
    var tootltip = new coreui.Tooltip(tooltipEl);
</script>
<script src="back-end/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="back-end/sweetalert2/sweetalert2.all.js"></script>
<script src="js/axios.min.js"></script>
<script>

    document.addEventListener('click',function(e){
        const randomBtn = e.target.closest('.btn-random');
        const selectPlayer = e.target.closest('.player')
        if(randomBtn)
        {
            player = document.querySelectorAll('.player.active');
            players = document.querySelectorAll('.player');
            position = document.querySelector('.player-position');
            position = position.innerHTML;
            position = position.split(', ');
            team = document.querySelector('input[name="team"]:checked');
            const teams = document.querySelectorAll('input[name="team"]')

            array = [];
            for(let i = 0; i < player.length; i++)
            {
                array.push(player[i].innerHTML);
            }
            if(array.length<1){
                for(let i=0; i<players.length; i++){
                    players[i].classList.add('text-danger')
                }
            }else{
                for(let i=0; i<players.length; i++){
                    players[i].classList.remove('text-danger')
                }
            }
            if(team == null) {
                for(let i=0; i<teams.length; i++){
                    teams[i].closest('label').classList.add('input-invalid');
                }
            }else{
                for(let i=0; i<teams.length; i++){
                    teams[i].closest('label').classList.remove('input-invalid');
                }
            }

            result = [];
            if(team.value == 10)
            {
                result[0] = shuffle(array,5);
                team2 = cut(array, result[0]);
                result[1] = shuffle(team2);
    
            }else{
                result[0] = shuffle(array,5);
            }
            console.log(result)

            FetchData(result)
            setTimeout(() => {
                a = shuffle(position);
                b = shuffle(position);
                FetchPosition(a,b);
            },150);
        }
        if(selectPlayer)
        {
            btn = selectPlayer
            if(btn.classList.contains('active')) 
                btn.classList.remove('active');
            else
                btn.classList.add('active');
        }
    })

    const shuffle = (array,length) => {
        data = [...Array(array.length)]
            .map((el, i) => Math.floor(Math.random() * i))
            .reduce( (a, rv, i) => ([a[i], a[rv]] = [a[rv], a[i]]) && a, array);
        let arr = [];
        for(i in data){
            if(length != null){
                if(i == length) break;
                arr.push(data[i]);
            }else{
                arr.push(data[i])
            }
        }
        return arr;
    }

    const cut = (data, cut) => {
        for (i in cut) data.splice(cut[i], 1);
        return data;
    }

    const FetchData = (data) => 
    {
        resultContent = document.querySelector('.result-content');
        
        option = document.querySelector('input[name="option"]:checked').value;
        team = document.querySelector('input[name="team"]:checked').value;

        cols = data.length;
        rows = data[0].length;
        if(resultContent.querySelector('table') == undefined)
        {
            table = document.createElement('table');
            table.classList.add('table','table-bordered','table-striped','table-sm');
            tbody = document.createElement('tbody');
            let tr = '';
            for(i in data[0]) tr += `<tr><td width="20%"></td><td width="30%"></td><td width="20%"></td><td width="30%"></td></tr>`;
            tbody.innerHTML = tr;
            table.innerHTML = `<thead><tr><td colspan="2" class="text-center" width="50%">Team 1</td><td colspan="2" class="text-center" width="50%">Team 2</td></tr></thead>`;
            table.append(tbody)
            resultContent.append(table);
        }
        for(i in data)
        {
            tr = resultContent.querySelectorAll('tbody > tr');
            for(j in data[i])
            {
                nth = (i == 0) ? 1 : 3;
                if(tr[j] != undefined) tr[j].querySelector(`td:nth-child(${nth})`).innerHTML = data[i][j];
            }
        }
      
    }

    const FetchPosition = (a,b) =>
    {
        const resultContent = document.querySelector('.result-content');
        team = document.querySelector('input[name="team"]:checked').value;
        option = document.querySelector('input[name="option"]:checked').value;
        tr = resultContent.querySelectorAll('tbody > tr');
        if(option != undefined && option == 'player'){
            for(i in tr){
                tr[i].querySelector('td:nth-child(2)').innerHTML = '';
                tr[i].querySelector('td:nth-child(4)').innerHTML = '';
            }
        }
        for(i in a)
        {
            if(team == 10){
                tr[i].querySelector('td:nth-child(2)').innerHTML = a[i];
                tr[i].querySelector('td:nth-child(4)').innerHTML = b[i];
            }
            if(team == 5){
                tr[i].querySelector('td:nth-child(2)').innerHTML = a[i];
                tr[i].querySelector('td:nth-child(3)').innerHTML = '';
                tr[i].querySelector('td:nth-child(4)').innerHTML = '';
            }
        }
    }
    // const shuffle = (array,length) => [...Array(array.length)]
    //     .map((el, i) => Math.floor(Math.random() * i))
    //     .reduce( (a, rv, i) => ([a[i], a[rv]] = [a[rv], a[i]]) && a, array);
</script>