@php
$main = \App\Models\CategoryMainMd::where('status',1)->get();
@endphp

<section>
    <div class="container">
        <div class="card-category layout2" style="background-color:#d5d5d5; padding:10px; border-radius:15px; ">
            <div class="category-header">
                {{-- <h4 class="mx-2 font-weight-bold">หมวดหมู่ธุรกิจ:</h4> --}}
                <div class="row">
                    <div class="col-lg-12">
                        <form id="formCategory" action="">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text d-flex text-dark" style="background-color:#fff; border:#fff;">
                                        <strong style="font-size: 17px">หมวดหมู่ธุรกิจ :</strong>
                                    </label>
                                </div>
                                <input type="text" class="form-control" placeholder="ค้นหาหมวดหมู่" style="border:none;">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="category-content">
                <ul id="myTabs" class="nav nav-pills nav-justified row" role="tablist">
                    @foreach($main as $k => $v)
                    <li class="col-6 col-lg-3 tabs__big-category" data-id="{{$v->id}}">
                        <a href="javascript:" class="box__big-category">
                            <img src="{{$v->logo}}"><div>{{$v->name_th}}</div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="table-category position- mt-1">
                    <div class="table-body">
                        <div class="row bg-white">
                            <div class="col-12 col-lg-4 col-md-5">
                                <div class="step2">
                                    <div class="box-list bg-silver">
                                        <div class="scroll" id="scrollblue">
                                            <div class="collection-list">
                                                @foreach(
                                                    \App\Models\CategorySubMd::where('category_main',1)
                                                    ->select("id","name_th","icon","category_main as main")
                                                    ->get() 
                                                    as $j => $s
                                                )
                                                    @php($activeSub=($j==0)?'active':'')
                                                    {{-- @php($activeSub=($subId==$s->id)?'active':'') --}}
                                                    <div class="sub-category card-sub {{$activeSub}}" data-id="{{$s->id}}" main="{{$s->main}}">
                                                        <div class="circle">
                                                            <div class="images">
                                                                <img src="{{$s->icon}}" title="{{$s->name_th}}" width="50" height="50">
                                                            </div>
                                                        </div>
                                                        <div class="title">{{$s->name_th}}</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 col-md-7 pl-0 pr-3 pt-2 step3">
                                <div class="-grid collection-list">
                                    @foreach(
                                        \App\Models\CategoryMd::join('category_main as main','category.category_sub','=','main.id')
                                        ->where(['category.status'=>1,'category.category_sub'=>1])
                                        ->select('category.id','category.name_th','category.image','category.category_sub as sub','main.id as main','category.key','category.coming_soon')
                                        ->get() as $c
                                    )
                                    @php($href=($c->coming_soon!=1)?'th/'.$c->key:'javascript:')
                                    <a class="text-dark" href="{{$href}}" target="_blank" style="text-decoration: none;">
                                        <div class="card-cat fade show">
                                            <div class="circle">
                                                <div class="images @if($c->coming_soon==1)coming-soon @endif">
                                                    @if($c->coming_soon==1)<span>Coming soon</span>@endif
                                                    <img src="{{$c->image}}" title="{{$c->name_th}}" width="80">
                                                </div>
                                            </div>
                                            <div class="title">{{$c->name_th}}</div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card  mt-2">
                    @foreach($main as $k => $v)
                    <div class="sub-category" id="sub-category{{$v->id}}">
                        <div class="step2 pt-4 pb-3">
                            <div class="-grid collection-list">
                            @foreach(\App\Models\CategorySubMd::where(['status'=>1,'category_main'=>$v->id])->get() as $i => $sub)
                                <div class="card-sub" data-id="{{$sub->id}}" data-main="{{$v->id}}">
                                    <div class="circle">
                                        <div class="images">
                                            <img src="{{$sub->icon}}" alt="icons" width="114" height="114">
                                        </div>
                                    </div>
                                    <div class="title">{{$sub->name_th}}</div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="step3 py-4 pb-4">
                            <div class="backward state" data-state="previous"><i class="fas fa-chevron-left"></i></div>
                            <div class="-grid collection-list"></div>
                            <div class="forward state" data-state="next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
            </div>
        </div>
    </div>
</section>
<script>
    let portrait = window.matchMedia("(orientation: portrait)");    
    var myCategory = document.querySelector('.card-category');
    // var subCat = document.querySelectorAll('.card-sub');
    var step2 = myCategory.querySelector('.step2');
    var step3 = myCategory.querySelector('.step3');
    var maxWidth = 1270;
    var minHeight = 430;
    var borderAndPadding = 52;
    let step2Width = myCategory.querySelector('.step2').clientWidth - borderAndPadding;
    var state = document.querySelectorAll('.state');

    var loadingOverlay = document.createElement('div');
        loadingOverlay.setAttribute('class', 'content-overlay light');
        loadingOverlay.innerHTML = `<div class="cv-spinner"><span class="spinner"></span></div>`;
    
        adjustWidth()
    portrait.addEventListener("change", function(e) {
        // if(e.matches)  console.log('Portrait mode') else console.log('Landscape')
        // step2Width = myCategory.querySelector('.container').clientWidth - borderAndPadding;
        adjustWidth()
    })
    // addEventListener("resize", (event) => {
    //     step2Width = myCategory.querySelector('.container').clientWidth - borderAndPadding;
    //     adjustWidth()
    // });

    // mains = myCategory.querySelectorAll('.tabs__big-category');
    // for(let i = 0; i<mains.length; i++){
    //     mains[i].addEventListener('click',function(){
    //         btn = mains[i].querySelector('.box__big-category');
    //         id = mains[i].getAttribute('data-id');
    //         active(btn,id,i)
    //         scrollDown(btn,id)
    //     })
    // }
    // for(let j=0; j<subCat.length; j++){
    //     subCat[j].addEventListener('click',function(){
    //         id = subCat[j].getAttribute('data-id');
    //         step2 = subCat[j].closest('.sub-category').querySelector('.step2');
    //         step3 = subCat[j].closest('.sub-category').querySelector('.step3');
    //         if( ! subCat[j].classList.contains('active'))  
    //             getCategory(id, subCat[j]);
    //         if(!subCat[j].classList.contains('-flex'))
    //             step2.setAttribute('data-height',step2.clientHeight);
    //         setTimeout(() => { 
    //             if(!subCat[j].classList.contains('active')) subCat[j].classList.add('active');
    //             if(!step3.classList.contains('show')) step3.classList.add('show');
    //             activeStep2(subCat[j])
    //             scrollHorizontal(subCat[j]);
    //         },800);                
    //     })
    // }
    for(let i=0; i<state.length; i++)
    {
        state[i].addEventListener('click',()=>{
            changeSubCategory(state[i]);
        })
    }

    function activeStep2(el)
    {
        id = el.getAttribute('data-id');
        main = el.getAttribute('data-main')
        subCategory = el.closest('.collection-list').querySelectorAll('.card-sub');
        for(let i = 0; i < subCategory.length; i++)
        {
            if( id != subCategory[i].getAttribute('data-id'))
                subCategory[i].classList.remove('active');
        }
        setTimeout(() => {
            list = el.closest('.collection-list');
            if( list.classList.contains('-grid') ) {
                list.classList.remove('-grid');
                list.classList.add('-flex');
                list.closest('.step2').style.width = `${step2Width}px`;
                list.closest('.step2').style.overflowX = 'auto';
                list.closest('.step2').style.height = 230;
                step3 = list.closest('.sub-category').querySelector('.step3');
                step3.setAttribute('data-height', (step3.clientHeight < minHeight) ? minHeight : step3.clientHeight);
                setHeight(main);
                
            }
        },500);
    }
    var bacward = document.querySelectorAll('.backward');
    for(let i=0; i<bacward.length; i++){
        bacward[i].addEventListener('click',() => {
            backSubCategory(bacward[i])
        })
    }

    function active(el,id,find)
    {
        // sub
        box = el.closest('.container').querySelector('.card');
        $id = `sub-category${id}`
        sub = box.querySelector(`#${$id}`);
        setTimeout(()=>{
            if( box.clientHeight < sub.clientHeight )
                box.style.height = sub.clientHeight+'px';
        },500);
        if( el.classList.contains('active') )
        {
            el.classList.remove('active');
            sub.classList.remove('active');
            box.classList.remove('show');
            box.style.height = 0;
        } else {
            el.classList.add('active');
            sub.classList.add('active');
            box.classList.add('show');
        }
        for(let i = 0; i<mains.length; i++)
        {
            if( find != i )
                mains[i].querySelector('.box__big-category').classList.remove('active');
        }
        for(let i=0; i<subCat.length; i++)
        {
            if( subCat[i].closest('.sub-category').getAttribute('id') != $id )
                subCat[i].closest('.sub-category').classList.remove('active');
        }

    }
    function setHeight(id)
    {
        el = document.getElementById(`sub-category${id}`);
        s2 = el.querySelector('.step2');
        s3 = el.querySelector('.step3');
        box = s2.closest('.card');
        boxHeight = s2.clientHeight + Number(s3.getAttribute('data-height'));
        allHeight = Number(s2.clientHeight) + Number(s3.getAttribute('data-height'));
        newHeight = (Number(s3.clientHeight) < minHeight) ? minHeight : s3.clientHeight;
        if( allHeight != 0 ) el.closest('.card').style.height = allHeight + 'px';
        s3.style.height = `${newHeight}px`;
        box.style.height = boxHeight;
    }



    function getCategory(id,el)
    {
        subCategory = el.closest('.sub-category');
        step2 = subCategory.querySelector('.step2');
        step3 = subCategory.querySelector('.step3');
        row = step3.querySelector('.collection-list');
        html = '';
        if (id) {
            //================= Loading Overlay =================//
            
                myCategory.querySelector('.card').appendChild(loadingOverlay);

            fetch(`/api/category/${id}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' },
            })
            .then(response => response.json())
            .then(data => {
                data.map(function(v,k){
                    html +=`<div class="card-cat fade">
                        <a href="${v.coming_soon != 1 ? 'th/'+v.key : 'javascript:'}" target="_blank" class="category">
                            <div class="circle">
                                <div class="images${v.coming_soon==1?' coming-soon':''}">
                                    ${v.coming_soon == 1 ? '<span>Coming soon</span>':''}
                                    <img src="${v.image}" alt="icons" width="114" height="114">
                                </div>
                            </div>
                            <div class="title">${v.name_th}</div>
                        </a>
                    </div>`;
                });
                row.innerHTML = html;
                if (Object.keys(data).length > 0)
                {
                    setTimeout(() => { 
                        myCategory.querySelector('.content-overlay').remove(); 
                        newHeight = (step3.clientHeight + Number(step2.getAttribute('data-height')));
                        
                    }, 500);
                    setTimeout(()=>{
                        cat = step3.querySelectorAll('.card-cat');
                        for(let j=0; j<cat.length; j++)
                        {
                            cat[j].classList.add('show');
                        }
                    },800)

                }
            });
        } else {
            step3.classList.remove('show');
        }
    }
    function backSubCategory(el)
    {
        const subCat = el.closest('.sub-category');
        const step2 = subCat.querySelector('.step2');
        const cardActive = step2.querySelector('.active');
    }
    function nextSubCategory(el)
    {
        const subCat = el.closest('.sub-category');
        const step2 = subCat.querySelector('.step2');
        const cardActive = step2.querySelector('.active');
        if(cardActive.length > 0){
            const next = cardActive.nextSiling;
        }
    }

    function adjustWidth()
    {
        var width = document.body.clientWidth;
        var step3 = document.querySelector('.step3')
        if(width <= 736 && step3.classList.contains('pl-0')){
            step3.classList.remove('pl-0');
            step3.classList.add('pl-3');
        }
        // thisActive = myCategory.querySelector('.sub-category.active');
        // if( thisActive != null && thisActive.querySelector('.step2 > .-flex') != null){
        //     thisActive.querySelector('.step2').style.width = `${step2Width}px`;
        // }
    }

    function scrollDown(el,id)
    {
        box = el.closest('.container').querySelector('.card');
        $id = `sub-category${id}`
        setTimeout(()=>{
            const sub = document.getElementById(`${$id}`);
            window.scrollTo({
                top: sub.offsetParent.offsetTop - 20,
                behavior:'smooth'
            });
        },500)
    }
    function scrollHorizontal(el)
    {
        setTimeout(()=>{
            const offsetLeft = el.offsetLeft; 
            maxWidth = el.closest('.step2').clientWidth;
            mid = (maxWidth /3) / 2;
            el.closest('.step2').scrollTo({
                top: 0,
                left: offsetLeft - Math.ceil((maxWidth /3)),
                behavior: 'smooth'
            })
        },1200);
    }
    function changeSubCategory(el)
    {
        const thisSub = el.closest('.sub-category');
        const step2 = thisSub.querySelector('.step2');
        const state = el.getAttribute('data-state');
        const thisActive = step2.querySelector('.active');
        if (state == 'next') find = thisActive.nextElementSibling;
        if (state == 'previous') find = thisActive.previousElementSibling;
        if (find != null) find.click();
    }
    const formCategory = document.getElementById('formCategory');
    const content = formCategory.closest('.container').querySelector('.category-content');

    let timer;
    const waitTime = 1250;
    var categories;
    allCategory().then(data => { categories = data });

    const adjustCategory = (category) => 
    {
        const noItem = `<small class="text-center d-block">ไม่พบข้อมูล</small>`;
        categoryContent = document.querySelector('.category-content');
        mains = categoryContent.querySelectorAll('li');
        // subs = categoryContent.querySelectorAll('.sub-category');
        cat = categoryContent.querySelector('.step3')
        let first = true;
        const subCon = categoryContent.querySelector('.collection-list');
        subCon.innerHTML = '';
        category.map((m,i)=>
        {
            mains[i].classList.remove('d-none','d-block');
            mains[i].classList.add(`${m.display}`);
            
            let subTtem = '';
            if(m.display == 'd-block' && first == true)
            {
                m.sub.map((s,j) =>
                {
                    if(s.display != 'd-none')
                    {
                        subTtem += `<div class="sub-category card-sub" data-id="${s.id}" main="${m.id}">
                            <div class="circle">
                                <div class="images">
                                    <img src="${s.icon}" title="${s.name_th}" width="50" height="50">
                                </div>
                            </div>
                            <div class="title">${s.name_th}</div>
                        </div>`;
                    }
                })
                subCon.innerHTML = subTtem;
                first = false;
            }

        });
        subs = categoryContent.querySelectorAll('.sub-category');
        if(subs.length>0){
            subCon.closest('.table-category').querySelector('.step3 > .collection-list').classList.add('-grid');;
            subs[0]?.click();
        }else{
            setTimeout(()=>{ 
                subCon.innerHTML = noItem;
                step3 =  subCon.closest('.table-category').querySelector('.step3 > .collection-list');
                step3.classList.remove('-grid');
                step3.innerHTML = noItem;
            },300)
        }
        setTimeout(() => {
            document.querySelector('.card-category > .category-content').querySelector('.content-overlay').remove();
        }, 300);
    }

    const SetShow = (el) => 
    {    
        const step3 = document.querySelector('.step3');
        const set = el.getAttribute('data-id');
        Array.from(el.closest('.collection-list')?.childNodes, (e) => { e.classList?.remove('active') });
        el.classList.add('active');

        categories.map((m) =>
        {
            m.sub.map((s) =>
            {
                if(s.id == set)
                {
                    let item = '';
                    s.category.map((c) =>
                    {
                        if(c.display != 'd-none')
                        {
                            item += `<a class="text-dark" href="${c.coming_soon!=1?'th/'+c.key:'javascript:'}" target="_blank" style="text-decoration: none;">
                                <div class="card-cat fade show">
                                    <div class="circle">
                                        <div class="images${c.coming_soon==1?' coming-soon':''}">
                                            ${c.coming_soon==1?'<span>Coming soon</span>':''}
                                            <img src="${c.icon}" title="${c.name_th}" width="80">
                                        </div>
                                    </div>
                                    <div class="title">${c.name_th}</div>
                                </div>
                            </a>`
                        }
                    });
                    step3.querySelector('.collection-list').innerHTML = item;
                    return false;
                }
            });
        });
        setTimeout(() => {
            document.querySelector('.card-category > .category-content').querySelector('.content-overlay')?.remove();
        }, 300);

    }
    const SetSubCategory = (el) =>
    {
        const step2 = el.closest('.category-content').querySelector('.step2')
        const set = el.closest('li').getAttribute('data-id');
        Array.from(el.closest('#myTabs').querySelectorAll('.active'), (e) => { e?.classList.remove('active'); });
        el.classList.add('active');

        categories.map((m)=>{
            if (m.id == set) {
                let item = '';
                m.sub.map((s) =>
                {
                    if(s.display != 'd-none'){
                        item += `<div class="sub-category card-sub" data-id="${s.id}" main="${m.id}">
                            <div class="circle">
                                <div class="images">
                                    <img src="${s.icon}" title="${s.name_th}" width="50" height="50">
                                </div>
                            </div>
                            <div class="title">${s.name_th}</div>
                        </div>`;
                    }
                });    
                step2.querySelector('.collection-list').innerHTML = item;
                return false;
            }
        });
        setTimeout(()=>{
            sub = step2.querySelectorAll('.sub-category');
            sub[0]?.click();
        },200)
    }

    formCategory.querySelector('input').addEventListener('keyup',function()
    {
        clearTimeout(timer);
        document.querySelector('.card-category > .category-content').appendChild(loadingOverlay);
        timer = setTimeout(() => {
            search = this.value.toLowerCase();
            categories.map((m) => {
                m.sub.map((s) => {
                    s.category.map((c) => {
                        io_th = c.name_th.toLowerCase().indexOf(search);
                        io_en = c.name_en.toLowerCase().indexOf(search);
                        c.display = io_th >= 0 || io_en >= 0 ? 'd-block' : 'd-none';
                    })
                    let d = s.category.map(function(e){ return e.display; });
                    displayS = d.indexOf('d-block');
                    s.display = displayS >= 0 ? 'd-block' : 'd-none';
                })
                let ds = m.sub.map(function(e){ return e.display; });
                display = ds.indexOf('d-block');
                m.display = display >= 0 ? 'd-block' : 'd-none';
            })
            adjustCategory(categories);
        }, waitTime);
    })
    document.addEventListener('click',function(e)
    {
        const Main = e.target.closest('.box__big-category');
        if(Main){
            document.querySelector('.card-category > .category-content').appendChild(loadingOverlay);
            setTimeout(()=>{ SetSubCategory(Main) },300);
        }
        const Sub = e.target.closest('.sub-category');
        if(Sub){
            setTimeout(()=>{ SetShow(Sub); },300);
        }
    })
    // function searchCategory(val)
    // {
    //     let data = [];
    //     if ( val != '' )
    //         data = $.ajax({
    //             url:`api/get/category/search?keywords=${val}`,
    //             async:false,
    //         }).responseJSON;
    //     return data;
    // }
    async function allCategory()
    {
        const response = await fetch(`/api/get/category/all`);
        const data = await response.json();
        return data;
    }
    function CloseSearch(el){
        cardCategory = el.closest('.card-category');
        cardCategory.querySelector('.search-content').remove();
        cardCategory.style.height = null;
    }
    function Calc(e){
        cardCategory = e.closest('.card-category')
        headHeight = cardCategory.querySelector('.justify-content-between').clientHeight;
        bodyHeight = cardCategory.querySelector('.search-content').clientHeight;
    }
    
</script>