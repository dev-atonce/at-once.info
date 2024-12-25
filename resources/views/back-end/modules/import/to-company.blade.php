<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="At-once">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{Config::get('app.name')}} | Webpanel</title>

        <base href="{{url('/')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
        <link rel="stylesheet" href="back-end/fontawesome-5.11.2/css/all.css">
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

    </head>
    <body class="c-app flex-row">    
        <script>var c=localStorage.getItem("theme"), tag=document.getElementsByTagName('body').item(0); if(c!=''&&c!=null)tag.classList.add(c);</script>
        <div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
            @include('back-end.layout.left-menu')
        </div>
        <div class="c-wrapper">
            @include('back-end.layout.header')
            <div class="c-body">
                <main class="c-main">
                    <div class="container-fluid">
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            accept=".csv"
                                            class="custom-file-input"
                                            id="profilePicture"
                                        />
                                        <label for="profilePicture" class="custom-file-label">Select CSV File</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card mt-3 d-none">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-inline">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Import to:</span>
                                                            </div>
                                                            <select name="category" class="form-control">
                                                                <option value="">Please Select</option>
                                                                @foreach(\App\Models\CategorySubMd::all() as $s)
                                                                    <optgroup label="{{$s->name_en}}">
                                                                    @foreach(\App\Models\CategoryMd::where([['name_th','!=',''],['category_sub',$s->id]])->get() as $v)<option value="{{$v->id}}">{{$v->no}}&nbsp;&nbsp;{{$v->name_en}}</option>@endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-primary ml-1 import-to-database">Import</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-3 preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            // var file
                            const labelDefault = 'Select CSV File';
                            document.getElementById('profilePicture').addEventListener('change',function(e){
                                let fileInput = e.target.files || e.dataTransfer.files;
                
                                if (!fileInput.length) {
                                    this.fileName = labelDefault;
                                } else {
                                    this.fileName = fileInput[0].name;
                                }
                                document.querySelector('.custom-file-label').innerHTML = this.fileName;
                 
                                const reader = new FileReader();
                                reader.readAsText(fileInput[0]);
                                reader.onload = (event) => {
                                    var csvdata = event.target.result;
                                    var rowData = csvdata.split('\r\n');
                                    const table = document.createElement('table');
                                    table.setAttribute('class','table table-bordered');
                                    tbody = document.createElement('tbody');
                                    tr = '';
                                    rowData.forEach((v,i) => {
                                        td = '';
                                        columns = v.split(/(,(?=\S)|:)/g);
                                        columns = columns.filter((val) => val != ',' );
                                        if(i == 0){
                                            thead = document.createElement('thead');
                                            th = '';
                                            columns.forEach((c,j)=>{ 
                                                th += `<th>${c}</th>`;
                                            })
                                            thead.innerHTML = th;
                                            table.append(thead)
                                        }else{
                                       
                                            columns.forEach((c,j)=>{
                                                str = j==3?c.replace(/^"(.*)"$/, '$1'):c;
                                                name = setName(j);
                                                td += `<td>${str}${name!=''?`<input type="hidden" name="${name}[${i-1}]" value="${str}">`:''}</td>`;
                                            })
                                            tr += `<tr>${td}</tr>`;
                                        }
                                    });
                                    tbody.innerHTML = tr;
                                    table.append(tbody);
                                    preview = document.querySelector('.preview');
                                    preview.innerHTML = '';
                                    preview.append(table);
                                    preview.closest('.card').classList.remove('d-none');
                                }
                                // reader.readAsBinaryString(fileInput.files);
                            });

                            document.querySelector('.import-to-database').addEventListener('click',function(e)
                            {
                                let name_th = [];
                                let address_th = [];
                                let tel = [];
                                let category = document.querySelector('[name="category"]');
                                if(category.value!=''){
                                    category.closest('.input-group').classList.remove('error');
                                    Swal.fire({
                                        title: 'Please Wait !',
                                        text: 'data uploading',// add html attribute if you want or remove
                                        allowOutsideClick: false,
                                        onBeforeOpen: () => { Swal.showLoading(); }
                                    });

                                    
                                    Array.from(document.querySelectorAll('[name^="name_th"]')).map(function(e){
                                        name_th.push(e.value);
                                    });
                                    Array.from(document.querySelectorAll('[name^="address_th"]')).map(function(e){
                                        address_th.push(e.value);
                                    });
                                    Array.from(document.querySelectorAll('[name^="telephone"]')).map(function(e){
                                        tel.push(e.value);
                                    });
                                    data = {
                                        csrf_token: '{{csrf_token()}}',
                                        category: category.value,
                                        name_th: name_th,
                                        address_th: address_th,
                                        telephone: tel
                                    };
                                    res = importData(data);
                                    res.then((r)=>{
                                        if(r.status == true)
                                        {
                                            Swal.fire({
                                                title: "Succesfully!",
                                                text: "Good jobs",
                                                icon: "success"
                                            }).then(function() {
                                                document.querySelector('.preview').innerHTML = '';
                                                document.getElementById('profilePicture').value = null;
                                                document.querySelector('.custom-file-label').innerHTML = labelDefault;
                                            });
                                        }else{
                                            Swal.fire({
                                                title: "Filed!",
                                                text: "An error has occurred.",
                                                icon: "error"
                                            })
                                        }
                                    })
                                }else{
                                    category.closest('.input-group').classList.add('error');
                                }
   
                                
                                
                            });
                            
                            async function importData(data) {
                                const response = await fetch("webpanel/import/to/company",{
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        // 'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: JSON.stringify(data)
                                });
                                const res = await response.json();
                                return res;
                                
                            }
                            
                            const setName = (i) => {
                                let name = '';
                                switch (i) {
                                    case 1: name = 'name_th'; break;
                                    case 2: name = 'address_th'; break;
                                    case 3: name = 'telephone'; break;
                                    default: name =''; break;
                                }
                                return name;
                            }
                            
                            const csvFileToArray = string =>
                            {
                                const csvHeader = string.slice(0, string.indexOf("\n")).split(",");
                                const csvRows = string.slice(string.indexOf("\n") + 1).split("\n");
                                const array = csvRows.map(i => {
                                    const values = i.split(",");
                                    const obj = csvHeader.reduce((object, header, index) => {
                                        object[header] = values[index];
                                        return object;
                                    }, {});
                                    return obj;
                                });
                            }
                            const resetFile = () => {
                                input  = document.querySelector('[type="file"]');
                            }
               
                            // const handleOnSubmit = (e) => {
                            //     e.preventDefault();

                            //     if (file) {
                            //     fileReader.onload = function (event) {
                            //         const text = event.target.result;
                            //         csvFileToArray(text);
                            //     };

                            //     fileReader.readAsText(file);
                            //     }
                            // };
                        </script>
                    </div>
                </main>
            </div>
            <footer class="c-footer">
                <div><a href="https://coreui.io">CoreUI</a> © 2019 creativeLabs.</div>
                <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
            </footer>          
        </div>
        <script src="back-end/vendors/pace-progress/js/pace.min.js"></script>
        <script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script>
        <script>
            var tooltipEl = document.getElementById('header-tooltip');
            var tootltip = new coreui.Tooltip(tooltipEl);
        </script>
        {{-- <script src="back-end/build/build.js"></script> --}}
    </body>
</html>