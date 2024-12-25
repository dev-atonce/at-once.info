<style>
    .fas.fa-chevron-left{
        transition: .15s ease-in-out;
    }
    .fas.rotate{
        rotate: -90deg;
        transition: rotate .15s;
    }
    .rotate-45{
        transform: rotate(45deg);
    }
    .border-radius-1x{
        border-radius: 10px;
    }
    .border-radius-2x{
        border-radius: 15px;
    }
    .border-radius-3x{
        border-radius: 20px;
    }
    a.sub-category-item:hover{
        text-decoration: none;
    }
    .category-group{
        padding: 0 0 0 20px;
    }
    .category-group-item{
        padding: 2px 0;
    }
</style>
<link rel="stylesheet" href="back-end/css/skEditor.css" />
<link rel="stylesheet" href="bootstrap-multiselect/dist/css/bootstrap-multiselect.min.css" />
@php
    $main = \App\Models\CategoryMainMd::all();
@endphp
<input type="hidden" name="user" value="{{Auth::user()}}">
<div class="row">
    @foreach($main as $k => $v)
        <div class="col-lg-3 main-category">
            <div class="card border-radius-2x">
                <div class="card-body active">
                    <h6 class="mb-0">
                        {{$k+1}}. {{$v->name_en}}
                        <a href="javascript:" class="float-right" main="{{$v->id}}" title="{{$v->name_en}}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </h6>
                    
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row row-main d-none">
    <div class="col-lg-5 col-xs-12" data-main="1">
        <div class="card border-radius-2x">
            <div class="card-header">
                <span></span>
                <button class="btn btn-success float-right"><i class="fas fa-plus"></i></button>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
    
    <div class="col-lg-4 col-xs-12 col-2 d-none">
        <div class="card border-radius-2x">
            <div class="card-header">
                <h6>Form 
                    <span class="action-title">Add</span>
                    <a class="float-right badge badge-light expand-col" href="javascript:">
                        <i class="fas fa-expand-alt fa-lg m-1 rotate-45"></i>
                    </a>
                </h6>
            </div>
            <div class="card-body">                
                <form id="form-category" class="d-block">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Main Category</label>
                            <input type="text" name="main" class="form-control main-input" readonly>
                            <input type="hidden" name="main_id">
                            <input type="hidden" name="category_id">
                        </div>
                        <div class="col-lg-12">
                            <label>Name(TH)</label>
                            <input type="text" name="name_th" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label>Name(EN)</label>
                            <input type="text" name="name_en" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label>Name(JP)</label>
                            <input type="text" name="name_jp" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label>Name(ZH)</label>
                            <input type="text" name="name_zh" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="float-right">
                                <button type="button" class="btn btn-success new-category">Save</button>
                                <button type="button" class="btn btn-warning update-category d-none">Update</button>
                                <button type="button" class="btn btn-secondary mr-2 cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="form-industry" class="d-none"></form>
                <form id="form-filter" class="d-none"></form>
            </div>
        </div>
    </div>
    <div class="col-lg-7 detail-content d-none">
        <div class="card border-radius-2x">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="sk-area" data-lang="th">
                            <textarea name="detail_th" id="detail_th" class="sk-editor"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    
    var user = JSON.parse(document.querySelector('input[name="user"]').value);
    let categories = '';
    getCategories().then(res => categories = res);
    let SubCategory;
    let Category;

    var RowMain = document.getElementsByClassName('row-main')[0];
    category = document.getElementsByClassName('main-category');

    async function GetDetail(id) {
        const request = await fetch(`api/get/category/detail?id=${id}`);
        const response = await request.json();
        return response;
    } 
    function ClearEditor(el){
        let area = el.closest('.sk-area');
        area.querySelector('.sk-tools')?.remove();
        area.querySelector('.sk-body')?.remove();
        area.querySelector('.sk-footer')?.remove();
    }
    for(let i=0; i<category.length; i++)
    {
        cat = category[i];
        cat.querySelector('.float-right').addEventListener('click',function(){
            setActive(i)
            rotateIcon(this.firstElementChild,'rotate');
            getSubCategory(this.getAttribute('main'))
            hideForm()
        })
    }

    RowMain.querySelector('.btn-success').addEventListener('click',function(){
        $this = this.previousSibling.previousSibling;
        this.closest('.row-main').children[1].classList.remove('d-none')
        clearForm('#form-category');
        this.closest('.row-main').querySelector('.action-title').innerHTML = 'Add';
        form = this.closest('.row-main').children[1].querySelector('#form-category');
        form.classList.remove('d-none');

        form.querySelector('.update-category').classList.add('d-none');
        if(form.querySelector('.new-category').classList.contains('d-none'))
        {
            form.querySelector('.new-category').classList.remove('d-none');
        }
        form.querySelector('[name="main"]').value = $this.textContent;
        form.querySelector('[name="main_id"]').value = $this.getAttribute('data-main');

    })
    RowMain.querySelector('.expand-col').addEventListener('click',function(){
        expandCol(this)
        toggleClass(this.querySelector('i'),'fa-expand-alt','fa-compress-alt')
    })

    document.addEventListener('click',function(e){
        const morecategoryBtn = e.target.closest('.more-industry');
        const newCategoryBtn = e.target.closest('.new-category');
        const editCategory = e.target.closest('.edit-category');
        const updateCategory = e.target.closest('.update-category');
        const removeCategory = e.target.closest('.remove-category');
        const btnCancel = e.target.closest('.cancel');
        if(morecategoryBtn)
        {
            console.log(morecategoryBtn)
        }
        if(newCategoryBtn)
        {
            $thisForm = newCategoryBtn.closest('form');
            validate({
                form:'#'+$thisForm.getAttribute('id'),
                url:'webpanel/business-category/store/category',
                rules: {
                    main_id: true,
                    name_th: true,
                    name_en: true,
                    name_zh: true,
                }
            });
        
        }
        if(editCategory)
        {
            main = editCategory.closest('.card').querySelector('span[data-main]');
            item = editCategory.closest('.list-group-item').querySelector('a');
            clearForm('#form-category');
            thisForm = RowMain.querySelector('#form-category');
            thisForm.closest('.col-2').classList.remove('d-none');
            thisForm.classList.remove('d-none');
            adjust = thisForm;
            adjust.closest('.row-main').querySelector('.action-title').innerHTML = 'Edit';
            adjust.querySelector('.new-category').classList.add('d-none');
            adjust.querySelector('.update-category').classList.remove('d-none');

            adjust.querySelector('[name="main"]').value = main.textContent;
            adjust.querySelector('[name="main_id"]').value = main.getAttribute('data-main');
            adjust.querySelector('[name="category_id"]').value = item.getAttribute('data-id');
            adjust.querySelector('[name="name_th"]').value = item.textContent;
            adjust.querySelector('[name="name_en"]').value = item.getAttribute('en');
            adjust.querySelector('[name="name_en"]').value = item.getAttribute('en');
            adjust.querySelector('[name="name_jp"]').value = item.getAttribute('jp');
            adjust.querySelector('[name="name_zh"]').value = item.getAttribute('zh');

        }
        if(updateCategory)
        {
            $thisForm = updateCategory.closest('form');
            validate({
                form:'#'+$thisForm.getAttribute('id'),
                url:'webpanel/business-category/update/category',
                rules: {
                    main_id: true,
                    category_id: true,
                    name_th: true,
                    name_en: true,
                    name_jp: true,
                    name_zh: true,
                }
            });
        }
        if(removeCategory)
        {
            cur = removeCategory.closest('.list-group-item');
            main = cur.querySelector('a[data-main]').getAttribute('data-main');
            thisId = cur.querySelector('a[data-main]').getAttribute('data-id');
            if(thisId)
            {
                Swal.fire({
                    title: 'Delete',
                    text: 'Are you sure you want to delete this item?',
                    icon:'warning',
                    showCancelButton:true,
                    confirmButtonColor:'#e55353',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true,
                    preConfirm: (res) => {
                        return axios.delete(`webpanel/business-category/delete/category?id=${thisId}`)
                        .then(res => { return res.data; })
                        .catch(error => { Swal.showValidationMessage(`${error}`); })
                    }
                }).then((res) => {
                    Swal.fire({
                        icon:`${res.value.status}`,
                        title: `${res.value.title}`,
                        text:`${res.value.message}`
                    })
                    getSubCategory(main)
                })
            }
        }
        if(btnCancel)
        {
            card = btnCancel.closest('.col-2');
            card.classList.remove('d-block');
            card.classList.add('d-none');

        }
    })



    const getSubCategory = (id) =>
    {
        categories.filter(function(v){
            if(v.id == id) SubCategory = v; 
        })
        id = (id == undefined) ? RowMain.querySelector('[data-main]').getAttribute('data-main') : id; 
        let ul = document.createElement('ul');
        ul.classList.add('list-group');
        if(SubCategory.sub.length > 0) {
            SubCategory.sub.map(function(v,i){
                removeOldItem();
                li = document.createElement('li');
                li.setAttribute('class','list-group-item');
                li.setAttribute('data-id',v.id);
                li.innerHTML = `
                <div class="d-flex">
                    <a class="sub-category-item text-dark d-flex w-100"
                        href="javascript:"
                        onclick="getCategory(this)" 
                        en="${v.name_en}"
                        jp="${v.name_jp}"
                        zh="${v.name_zh}">
                        <div class="mr-2"><i class="fas fa-plus _category"></i></div>
                        <div class="w-100">${v.name_en}</div>
                    </a>
                    <div class="col-auto pl-2 pr-0">
                        ${(user.role == 'developer')
                            ? `
                                <a class="badge badge-warning edit-category" href="javascript:"><i class="fas fa-pen"></i></a>
                                <a class="badge badge-danger remove-category" href="javascript:"><i class="fas fa-times"></i></a>
                                `
                            : ``
                        }
                    </div>
                </div>`;
                ul.appendChild(li)

            });
            RowMain.querySelector('.card-body').appendChild(ul)
        }
    }
    async function getCategories(){
        const request = await fetch('api/get/category/all?lang=all');
        const response = request.json();
        return response;
    }
    
    function getCategory(el)
    {
        if(el.closest('.list-group-item').querySelector('.category-group') == null){
            let sub = parseInt(el.closest('li').getAttribute('data-id'))
            let ul = document.createElement('ul');
            SubCategory.sub.filter((v)=>{
                if(v.id == sub) Category = v;
            })
            ul.setAttribute('class','category-group d-block');
            Category.category.map(function(v){
                li = document.createElement('li');
                li.setAttribute('class','category-group-item d-flex');
                li.innerHTML = `
                <span class="w-100">${v.no}. ${v.name_en}</span>
                <div class="col-auto pl-2 pr-0">
                    <a class="badge badge-secondary detail-edit" href="javascript:" onclick="editDetailCategory(${v.id})"><i class="fas fa-info-circle"></i></a>
                    ${user.role=='developer'?`<a class="badge badge-warning" href="javascript:"><i class="fas fa-pen"></i></a><a class="badge badge-danger" href="javascript:"><i class="fas fa-times"></i></a>`:``}
                </div>`;
                ul.appendChild(li)
            });
            el.closest('.list-group-item').append(ul);
            toggleClass(el.querySelector('._category'),'fa-plus','fa-minus');
        }else{
            toggleClass(el.querySelector('._category'),'fa-plus','fa-minus');
            toggleClass(el.closest('.list-group-item').querySelector('.category-group'),'d-block','d-none')
        }
    }

    function editDetailCategory(id)
    {
        let row = document.querySelector('.detail-content');
        // ClearEditor(row.querySelector('[name="detail_th"]'));
        let base = window.location.hostname;
        window.open(`/webpanel/settings/category/detail?id=${id}`, "", "width=1000,height=800");
        // GetDetail(id).then(res => {
        //     row.querySelector('[name="detail_th"]').innerHTML = res.detail_th;
        //     // obj.setValue = res.detail_th
        //     detailTH({setValue:res.detail_th});
        //     row.classList.remove('d-none');
            
        // })
    };
        

    const storeCategory = async (form,fd) => {
        // fd = formData() function
        try {
            res = await axios({method:'post',url:`webpanel/business-category/store/category`, data: fd });
            data = res.data;
            if(data.length > 0){
                let alert = document.createElement('span');
                alert.classList.add(`alert alert-${data.class} alert-dismissible fade show`);
                alert.innerHTML = `<strong>${data.title}</strong>${data.message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
                form.closest('#form-category').prependChild(alert)
            }
        }
        catch (error) {
            console.log(error);
        }

    }

    const rotateIcon = (e,f) => 
    {
        if(e.classList.contains(f)){
            e.classList.add(f)
            title = RowMain.querySelector('span');
            title.innerHTML = e.closest('a').getAttribute('title');
            title.setAttribute('data-main', e.closest('a').getAttribute('main'));
            RowMain.classList.remove('d-none');
        }else{
            e.classList.remove(f)
            RowMain.querySelector('span').innerHTML = '';
            RowMain.classList.add('d-none');
        }
    }
    const removeListGroup = () =>
    {
        r = RowMain.querySelector('.list-group');
        if(r != null){
            r.innerHTML = '<li class="list-group-item">No record</li>';
        }else{
            RowMain.querySelector('.card-body').innerHTML = '<ul class="list-group"><li class="list-group-item">No record.</li></ul>';
        }
    }
    const removeOldItem = () => 
    {
        r = RowMain.querySelector('.list-group');
        if(r != null){
            r.remove();
        }
    }
    const setActive = (e) =>
    {
        var addRotate = (e) =>{
            e.classList.add('rotate');
        }
        var removeRotate = (e) => {
            e.classList.remove('rotate');
        }

        for(let i=0; i<category.length; i++)
        {
            $this = category[i].querySelector('.float-right').firstElementChild;
            if(i == e) {
                if ($this.classList.contains('rotate')) removeRotate($this); else addRotate($this);
            }else{
                removeRotate($this);
            } 
        }
    }
    const toggleClass = (e, f, r) => {
        // [e = element], [f = find class], [r = replace class]
        if (e.classList.contains(f)) { e.classList.remove(f); e.classList.add(r);}
        else { e.classList.add(f); e.classList.remove(r); }

    }

    const validate = async (obj) => 
    {
        let invalid = [];
        let values = [];
        for(var i in obj.rules)
        {
            if(obj.rules[i] === true){
                $this = document.querySelector(`[name="${i}"]`);
                if($this.value == '') {
                    $this.classList.add('is-invalid'); 
                    invalid.push($this.getAttribute('name'));
                }else {
                    $this.classList.remove('is-invalid');
                    values[i] = $this.value;
                }
            }
        }
        if(invalid.length == 0)
        {
            const fd = new FormData();
            for(var k in values) fd.append(k,values[k]);
            if(obj.url === undefined) throw new Error('Please provide the url: for your request.');
            if(Object.keys(values).length > 0){
                store = await axios({
                    method:'post',
                    url:`${obj.url}`,
                    data: fd
                })
                .then((res) => {
                    if(res.status == 200){
                        let data = res.data;
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.status,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            toast:true
                        })
                        getSubCategory(data.return);
                        clearForm(obj.form);
                    }
                });
                console.log(store);
            }
        }
        
    }
    const clearForm = (el) => {
        form = document.querySelector(el).querySelectorAll('input');
        for(i in form){
            if(form[i]) form[i].value = '';
        }
    }

    const JsonToArray = (data) => {
        var result = [];
        for(var i in data){ 
            result[i] = data[i];
        }
        return result;
    }
    const hideForm = () => {
        RowMain.querySelector('.col-2').classList.add('d-none')
    }
    const expandCol = (el) => 
    {
        prev = el.closest('.col-2').previousSibling.previousSibling;
        thisClass = el.closest('.col-2').classList.value;
        
        prevClass = prev.classList.value;
        var cols = [1,2,3,4,5,6,7,8,9,10,11,12];
        var maxCol = cols.length;
        thisCol = currentColumn(thisClass);
        newCol = newColumn(prevClass);

        function currentColumn(classList)
        {
            let res;
            for(i in cols)
            {
                if(classList.indexOf(`col-lg-${cols[i]}`) > -1){
                    res = `col-lg-`+cols[i];
                }
            }
            return res
        }
        function newColumn(classList)
        {
            let res;
            for(i in cols)
            {
                if(classList.indexOf(`col-lg-${cols[i]}`) > -1){
                    res = `col-lg-`+(maxCol - cols[i])
                }
            }
            return res
        }

        if(thisCol == newCol){
            oldClass = el.closest('.col-2').getAttribute('old-class');
            el.closest('.col-2').classList.toggle(thisCol)
            el.closest('.col-2').classList.toggle(oldClass)
        }else{
            el.closest('.col-2').setAttribute('old-class',thisCol);
            el.closest('.col-2').classList.toggle(thisCol)
            el.closest('.col-2').classList.toggle(newCol)
        }
    }

</script>
