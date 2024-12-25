function Pagination(config)
{
    let extend = function(obj, extObj) {
        if (arguments.length > 2) {
            for (var a = 1; a < arguments.length; a++) extend(obj, arguments[a]);
        } else {
            for (var i in extObj) obj[i] = extObj[i];
        }
        return obj;
    };
    
    let defaults = {
        autoRun: true, // Boolean
        content: config.content,
        select: config.content.querySelector('.page'),
        prevBtn: config.content.querySelector('.prev-page'),
        nextBtn: config.content.querySelector('.next-page'),
        meta: {
            previous: 0,
            skip: 0,
            take: 100,
            currentPage: 1,
            allPages: 1,
            allRows: 1
        },
        params: {
            date: null,
            keyword: null
        },
        columnName: [],
        columnKey: [],
        action: ''
    };
    let obj = extend(defaults, config);
    // ================= Loading Overlay ================= //
    let loadingOverlay = document.createElement('div');
    loadingOverlay.setAttribute('class', 'content-overlay');
    loadingOverlay.innerHTML = `<div class="cv-spinner"><span class="spinner"></span></div>`;
    var crContent = obj.content?.querySelector('.card-body');
    // crContent?.appendChild(loadingOverlay)
    params = {};
    Object.keys(obj.search).forEach((key) => {
        if(obj.search[key]?.getAttribute('default')=='true') params[key] = obj.search[key].value;
    });
    params.skip = obj.meta.skip ? parseInt(obj.meta.skip) : 0;
    params.take = obj.meta.take ? parseInt(obj.meta.take) : 100;
    obj.rows(params).then(res => {
        obj.items(res);
        obj.meta.skip = parseInt(res.meta.skip);
        obj.meta.take = parseInt(res.meta.take);
        obj.meta.allPages = parseInt(res.meta.allPages);
        SetPage();
    });
    obj.search.submit.addEventListener('click',function(e){
        e.preventDefault();
        crContent?.appendChild(loadingOverlay);
        let currentPage = e.target.value;
        let params = {};
        Object.keys(obj.search).forEach((key) => {
            // let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }else if (obj.search[key].value != '' || obj.search[key].value != null){
                params[key] = obj.search[key].value.replaceAll(' ','');
            } 
        })
        params.skip = 0;
        params.take = obj.meta.take;

        obj.rows(params).then(res => { 
            obj.items(res); 
            obj.meta.skip = parseInt(res.meta.skip);
            obj.meta.take = parseInt(res.meta.take);
            obj.meta.allPages = parseInt(res.meta.allPages);
            SetPage(obj.meta.allPages);
            loadingOverlay.remove();
        });
    })
    obj.search.keyword?.addEventListener('keyup',function(e){ if(e.keyCode == 13) SearchFromEnterKey(); });
    obj.search.date?.addEventListener('keyup',function(e){ if(e.keyCode==13) SearchFromEnterKey(); })
    
    // search reset button
    obj.search?.reset.addEventListener('click',function(e){
        e.preventDefault();
        crContent?.appendChild(loadingOverlay);
        let params = {};
        Object.keys(obj.search).forEach((key) => {
            // let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }else{
                if(obj.search[key]?.getAttribute('default')!='true')  setDefault(obj.search[key]);
                else params[key] = obj.search[key].value; 
            } 
        })
        params.skip = 0,
        params.take = obj.meta.take;

        obj.meta.skip = params.skip;
        obj.meta.take = params.take;
        obj.meta.currentPage = 1;
        SetPageButtonAction();
        SetSelected(obj.meta.currentPage);
        obj.rows(params).then(res => {
            obj.items(res); 
            obj.meta.skip = parseInt(res.meta.skip);
            obj.meta.take = parseInt(res.meta.take);
            obj.meta.allPages = parseInt(res.meta.allPages);
            SetPage(obj.meta.allPages);
            SetScrollToTop();
            loadingOverlay.remove();
        });
    })

    function setDefault(el){
        if(el){
            console.log(el)
            let name = el?.getAttribute('name');
            el.value = '';
            switch (name) {
                case 'assignment':
                    let select = el.closest('.user-assignment');
                    select.querySelector('.assignment-item')?.click();
                    select.querySelector('.assignment-menu').classList?.remove('show');
                    break;
                case 'keyword':  break;
                default: el.selectedIndex = 0; break;
            }
        }else{
            console.warn('undefined of element please check in your filter element');
        }
    }
    // select > option page
    obj.select.addEventListener('change', function(e){
        e.preventDefault();
        let currentPage = e.target.value;
        crContent?.appendChild(loadingOverlay);
        let params = {};
        Object.keys(obj.search).forEach((key) => {
            let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }else if (obj.search[key].value != '' || obj.search[key].value != null){
                params[key] = obj.search[key].value.replaceAll(' ','');
            } 
        })
        params.skip = (currentPage == 1) ? 0 : (currentPage-1) * obj.meta.take,
        params.take = obj.meta.take;
        obj.meta.skip = params.skip;
        obj.meta.take = params.take;
        obj.meta.currentPage = currentPage;
        SetPageButtonAction()
        obj.rows(params).then(res => { 
            obj.items(res); 
            SetScrollToTop();
            loadingOverlay.remove();
        });
        
    })
    // previous page button
    obj.prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        let currentPage = parseInt(obj.select.value);
        crContent?.appendChild(loadingOverlay);
        let params = {};
        Object.keys(obj.search).forEach((key) => {
            let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }else if (obj.search[key].value != '' || obj.search[key].value != null){
                params[key] = obj.search[key].value.replaceAll(' ','');
            } 
        })
        params.skip = (obj.meta.skip > 0) ? obj.meta.skip - obj.meta.take : 0;
        params.take = obj.meta.take;
        obj.meta.skip = params.skip;
        obj.meta.take = params.take;
        obj.meta.currentPage = currentPage > 2 ? (currentPage - 1) : 1;
        SetPageButtonAction()
        SetSelected(obj.meta.currentPage);
        obj.rows(params).then(res => { 
            obj.items(res); 
            SetScrollToTop();
            loadingOverlay.remove();
        });
    });
    // next page button
    obj.nextBtn.addEventListener('click', (e) => {
        console.log(e.target);
        e.preventDefault();
        let currentPage = parseInt(obj.select.value);
        crContent?.appendChild(loadingOverlay);
        let params = {}
        Object.keys(obj.search).forEach((key) => {
            let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }else if (obj.search[key].value != '' || obj.search[key].value != null){
                params[key] = obj.search[key].value.replaceAll(' ','');
            } 
        })
        params.skip = obj.meta.skip + obj.meta.take;
        params.take = obj.meta.take;
        obj.meta.skip = params.skip;
        obj.meta.take = params.take;
        obj.meta.currentPage = (currentPage + 1);
        SetPageButtonAction();
        SetSelected(obj.meta.currentPage);
        obj.rows(params).then(res => {
            obj.items(res); 
            SetScrollToTop();
            loadingOverlay.remove();
        });
    });
    obj?.refresh.addEventListener('click',function(e){
        e.preventDefault();
        let currentPage = parseInt(obj.select.value);
        let params = {};
        Object.keys(obj.search).forEach((key) => {
            // let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }
            if (obj.search[key]?.value != '' || obj.search[key].value != null){
                params[key] = obj.search[key]?.value.replaceAll(' ','');
            } 
        });
        params.skip = obj.meta.skip;
        params.take = obj.meta.take;
        obj.meta.skip = params.skip;
        obj.meta.take = params.take;
        SetSelected(obj.meta.currentPage);
        obj.rows(params).then(res => {
            obj.items(res); 
            // SetScrollToTop();
            loadingOverlay.remove();
        });
    })
   

    function SetPage(newSet)
    {
        oldPage = obj.select.querySelectorAll('option').length;
        if(oldPage != newSet){
            obj.select.innerHTML = '';
            for(let i = 0; i < obj.meta?.allPages; i++){
                let option = document.createElement('option');
                option.value = i+1;
                option.innerHTML = i+1;
                obj.select?.append(option);
            }
        }
        obj.prevBtn.setAttribute('disabled',true);
        if(obj.meta?.allPages > 1) obj.nextBtn.removeAttribute('disabled');
        else obj.nextBtn.setAttribute('disabled',true);
      
    }
    const SetSelected = (selected) => obj.select.querySelectorAll('option').forEach(option => { 
        if (option.value == selected) option.selected = true; 
    });
    const SetPageButtonAction = () =>
    {
        if(obj.meta.currentPage > 1) obj.prevBtn.removeAttribute('disabled');
        else obj.prevBtn.setAttribute('disabled',true);
        
        if(obj.meta.currentPage < obj.meta.allPages)  obj.nextBtn.removeAttribute('disabled');
        else obj.nextBtn.setAttribute('disabled',true);
    }
    const SetScrollToTop = () => {
        obj.content.querySelector('.table-responsive').scrollTop = 0;
    }
    const SearchFromEnterKey = () => {
        let params = {};
        crContent?.appendChild(loadingOverlay);
        Object.keys(obj.search).forEach((key) => {
            let value = obj.search[key].value;
            if(key == 'submit' || key == 'reset'){ 
                return;
            }else if (obj.search[key].value != '' || obj.search[key].value != null){
                params[key] = obj.search[key].value.replaceAll(' ','');
            } 
        });
        params.skip = 0;
        params.take = obj.meta.take;
        obj.rows(params).then(res => { 
            obj.items(res); 
            obj.meta.skip = parseInt(res.meta.skip);
            obj.meta.take = parseInt(res.meta.take);
            obj.meta.allPages = parseInt(res.meta.allPages);
            SetPage(obj.meta.allPages);
            loadingOverlay.remove();
        });
    }
}