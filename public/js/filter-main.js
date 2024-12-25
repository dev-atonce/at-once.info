let lang = window.location.pathname.split("/")[1];

document.addEventListener("click", function (e) {
    const searchTabContent = e.target.closest(".tab-item");
    if (searchTabContent) {
        const tabs = searchTabContent.closest(".search-tab");
        const toggle = searchTabContent.getAttribute("tab-toggle");
        const tabsBody = searchTabContent
            .closest(".search-tab-content")
            .querySelector(".search-tab-body");
        if (!searchTabContent.classList?.contains("active")) {
            tabs.querySelector(".active").classList.remove("active");
            searchTabContent.classList.add("active");
            tabsBody.querySelector(".active").classList.remove("active");
            thisTab = tabsBody.querySelector(`[data-tab="${toggle}"]`);
            thisTab.classList.add("active");
            if (toggle == "second") {
                searchTabContent.closest("#main-page-cover").style.height = `${thisTab.clientHeight + 840}px`;
            } else {
                searchTabContent.closest("#main-page-cover").style.height =
                    null;
            }
            // setTimeout(() => { setHeight(thisTab); });
        }
    }
});
// setHeight(document.querySelector('.search-tab-body > .active'))

function setHeight(el) {
    box = el.closest(".search-tab-body");
    boxHeight = box.querySelector(".search-tab-body > .active").clientHeight;
    // allHeight = Number(s2.clientHeight) + Number(s3.getAttribute('data-height'));
    // newHeight = (Number(s3.clientHeight) < minHeight) ? minHeight : s3.clientHeight;
    // if( allHeight != 0 ) el.closest('.card').style.height = allHeight + 'px';
    // s3.style.height = `${newHeight}px`;
    // console.log(box);
    box.style.height = `${boxHeight}px`;
}

function scrollHorizontal(el) {
    setTimeout(() => {
        const offsetLeft = el.offsetLeft;
        maxWidth = el.closest(".step2").clientWidth;
        mid = maxWidth / 3 / 2;
        el.closest(".step2").scrollTo({
            top: 0,
            left: offsetLeft - Math.ceil(maxWidth / 3),
            behavior: "smooth",
        });
    }, 1200);
}

// var searchTabContent = document.querySelector('.search-tab-content');
let portrait = window.matchMedia("(orientation: portrait)");
var myCategory = document.querySelector(".card-category");
// var subCat = document.querySelectorAll('.card-sub');
var step2 = myCategory.querySelector(".step2");
var step3 = myCategory.querySelector(".step3");
var maxWidth = 1270;
var minHeight = 430;
// var borderAndPadding = 52;
// let step2Width = myCategory.querySelector('.step2').clientWidth - borderAndPadding;
var state = document.querySelectorAll(".state");

var loadingOverlay = document.createElement("div");
loadingOverlay.setAttribute("class", "content-overlay light");
loadingOverlay.style.borderRadius = `15px`;
loadingOverlay.innerHTML = `<div class="cv-spinner"><span class="spinner"></span></div>`;

adjustWidth();
portrait.addEventListener("change", function (e) {
    // if(e.matches)  console.log('Portrait mode') else console.log('Landscape')
    // step2Width = myCategory.querySelector('.container').clientWidth - borderAndPadding;
    adjustWidth();
});
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
for (let i = 0; i < state.length; i++) {
    state[i].addEventListener("click", () => {
        changeSubCategory(state[i]);
    });
}

function activeStep2(el) {
    id = el.getAttribute("data-id");
    main = el.getAttribute("data-main");
    subCategory = el.closest(".collection-list").querySelectorAll(".card-sub");
    for (let i = 0; i < subCategory.length; i++) {
        if (id != subCategory[i].getAttribute("data-id"))
            subCategory[i].classList.remove("active");
    }
    setTimeout(() => {
        list = el.closest(".collection-list");
        if (list.classList.contains("-grid")) {
            list.classList.remove("-grid");
            list.classList.add("-flex");
            list.closest(".step2").style.width = `${step2Width}px`;
            list.closest(".step2").style.overflowX = "auto";
            list.closest(".step2").style.height = 230;
            step3 = list.closest(".sub-category").querySelector(".step3");
            step3.setAttribute(
                "data-height",
                step3.clientHeight < minHeight ? minHeight : step3.clientHeight
            );
            setHeight(main);
        }
    }, 500);
}
var bacward = document.querySelectorAll(".backward");
for (let i = 0; i < bacward.length; i++) {
    bacward[i].addEventListener("click", () => {
        backSubCategory(bacward[i]);
    });
}

function active(el, id, find) {
    // sub
    box = el.closest(".container").querySelector(".card");
    $id = `sub-category${id}`;
    sub = box.querySelector(`#${$id}`);
    setTimeout(() => {
        if (box.clientHeight < sub.clientHeight)
            box.style.height = sub.clientHeight + "px";
    }, 500);
    if (el.classList.contains("active")) {
        el.classList.remove("active");
        sub.classList.remove("active");
        box.classList.remove("show");
        box.style.height = 0;
    } else {
        el.classList.add("active");
        sub.classList.add("active");
        box.classList.add("show");
    }
    for (let i = 0; i < mains.length; i++) {
        if (find != i)
            mains[i]
                .querySelector(".box__big-category")
                .classList.remove("active");
    }
    for (let i = 0; i < subCat.length; i++) {
        if (subCat[i].closest(".sub-category").getAttribute("id") != $id)
            subCat[i].closest(".sub-category").classList.remove("active");
    }
}

function getCategory(id, el) {
    subCategory = el.closest(".sub-category");
    step2 = subCategory.querySelector(".step2");
    step3 = subCategory.querySelector(".step3");
    row = step3.querySelector(".collection-list");
    html = "";
    if (id) {
        //================= Loading Overlay =================//

        myCategory.querySelector(".card").appendChild(loadingOverlay);

        fetch(`/api/category/${id}`, {
            method: "GET",
            headers: { Accept: "application/json" },
        })
            .then((response) => response.json())
            .then((data) => {
                data.map(function (v, k) {
                    html += `<div class="card-cat fade">
                    <a href="${
                        v.coming_soon != 1 ? lang + "/" + v.key : "javascript:"
                    }" target="_blank" class="category">
                        <div class="circle">
                            <div class="images${
                                v.coming_soon == 1 ? " coming-soon" : ""
                            }">
                                ${
                                    v.coming_soon == 1
                                        ? "<span>Coming soon</span>"
                                        : ""
                                }
                                <img src="${
                                    v.image
                                }" alt="icons" width="114" height="114">
                            </div>
                        </div>
                        <div class="title">${v.name}</div>
                    </a>
                </div>`;
                });
                row.innerHTML = html;
                if (Object.keys(data).length > 0) {
                    setTimeout(() => {
                        myCategory.querySelector(".content-overlay").remove();
                        newHeight =
                            step3.clientHeight +
                            Number(step2.getAttribute("data-height"));
                    }, 500);
                    setTimeout(() => {
                        cat = step3.querySelectorAll(".card-cat");
                        for (let j = 0; j < cat.length; j++) {
                            cat[j].classList.add("show");
                        }
                    }, 800);
                }
            });
    } else {
        step3.classList.remove("show");
    }
}
function backSubCategory(el) {
    const subCat = el.closest(".sub-category");
    const step2 = subCat.querySelector(".step2");
    const cardActive = step2.querySelector(".active");
}
function nextSubCategory(el) {
    const subCat = el.closest(".sub-category");
    const step2 = subCat.querySelector(".step2");
    const cardActive = step2.querySelector(".active");
    if (cardActive.length > 0) {
        const next = cardActive.nextSiling;
    }
}

function adjustWidth() {
    var width = document.body.clientWidth;
    var step3 = document.querySelector(".step3");
    if (width <= 736 && step3.classList.contains("pl-0")) {
        step3.classList.remove("pl-0");
        step3.classList.add("pl-3");
    }
    // thisActive = myCategory.querySelector('.sub-category.active');
    // if( thisActive != null && thisActive.querySelector('.step2 > .-flex') != null){
    //     thisActive.querySelector('.step2').style.width = `${step2Width}px`;
    // }
}

function scrollDown(el, id) {
    box = el.closest(".container").querySelector(".card");
    $id = `sub-category${id}`;
    setTimeout(() => {
        const sub = document.getElementById(`${$id}`);
        window.scrollTo({
            top: sub.offsetParent.offsetTop - 20,
            behavior: "smooth",
        });
    }, 500);
}

function changeSubCategory(el) {
    const thisSub = el.closest(".sub-category");
    const step2 = thisSub.querySelector(".step2");
    const state = el.getAttribute("data-state");
    const thisActive = step2.querySelector(".active");
    if (state == "next") find = thisActive.nextElementSibling;
    if (state == "previous") find = thisActive.previousElementSibling;
    if (find != null) find.click();
}
// const formCategory = document.getElementById('formCategory');
// const content = formCategory.closest('.container').querySelector('.category-content');

let timer;
const waitTime = 1250;
var categories;
allCategory().then((data) => {
    categories = data;
});

const adjustCategory = (category) => {
    const noItem = `<div class="p-3 h-100 text-dark d-flex justify-content-center align-items-center">ไม่พบข้อมูล</div>`;
    categoryContent = document.querySelector(".category-content");
    mains = categoryContent.querySelectorAll("li");
    // subs = categoryContent.querySelectorAll('.sub-category');
    // cat = categoryContent.querySelector('.step3')
    let first = true;
    const Step3 = categoryContent.querySelector(".step3");
    Step3.innerHTML = "";
    category.map((m, i) => {
        mains[i].classList.remove("d-none", "d-block");
        mains[i].querySelector('.box__big-category').classList.remove("active");
        if (m.display != "d-block") mains[i].classList.add(`${m.display}`);

        let subItem = "";
        if (m.display == "d-block" && first == true) {
            m.sub.map((s, j) => {
                if (s.display != "d-none") {
                    let itemC = "";
                    s.category.map(function (c) {
                        if (c.display != "d-none") {
                            if (s.name != "")
                                itemC += `
                            <a class="text-dark" href="${c.coming_soon != 1 ? lang + "/" + c.key : "javascript:"}" target="_blank" style="text-decoration: none;">
                                <div class="card-cat fade show">
                                    <div class="circle">
                                        <div class="images${c.coming_soon == 1 ? " coming-soon" : "" }">
                                            ${c.coming_soon == 1 ? "<span>Coming soon</span>" : "" }
                                            <img src="${c.icon ? c.icon : "img/no-image.png" }" title="${c.name}" width="100">
                                        </div>
                                    </div>
                                    <div class="title mb-3">${c.name}</div>
                                </div>
                            </a>`;
                        }
                    });
                    if (itemC != "") {
                        subItem += `<div class="col-12 col-lg-12 col-md-12 sub-category">
                            <h3 class="mt-3 mb-2 border-bottom --c-blue" data-id="${s.id}"><small>${s.name}</small></h3>
                        </div>
                        <div class="col-12 col-lg-12 col-md-12 px-0 pb-3">
                            <div class="-grid collection-list">${itemC}</div>
                        </div>`;
                    }
                }
            });
            Step3.innerHTML = subItem;
            first = false;
        }
    });

    mains[category.findIndex(i => i.display == 'd-block')]?.querySelector('.box__big-category').classList.add("active");
    subs = categoryContent.querySelectorAll(".sub-category");
    if (subs.length < 1) {
        setTimeout(() => {
            Step3.innerHTML = noItem;
        }, 300);
    }

    setTimeout(() => {
        document.querySelector(".card-category > .category-content").querySelector(".content-overlay").remove();
    }, 300);
};

const SetShow = (el) => {
    const step3 = el.closest(".category-content").querySelector(".step3");
    const set = el.getAttribute("data-id");
    // console.log(set);
    Array.from(
        el.closest(".main-category")?.querySelectorAll(".main-category-link"),
        (e) => {
            e.classList?.remove("active");
        }
    );
    el.classList.add("active");
    // console.log(categories);
    categories.map((m) => {
        if (m.id == set) {
            let subItem = "";
            m.sub.map((s) => {
                let itemC = "";
                let sName = s.name;
                s.category.map((c) => {
                    if (c.display != "d-none") {
                        if (c.name)
                            itemC += `<a class="text-dark" href="${c.coming_soon != 1 ? lang + "/" + c.key : "javascript:" }" target="_blank" style="text-decoration: none;">
                            <div class="card-cat fade show">
                                <div class="circle">
                                    <div class="images${c.coming_soon == 1 ? " coming-soon" : "" }">
                                        ${c.coming_soon == 1 ? "<span>Coming soon</span>" : "" }
                                        <img src="${c.icon ? c.icon : "img/no-image.png"}" title="${c.name}" width="100">
                                    </div>
                                </div>
                                <div class="title mb-3">${c.name}</div>
                            </div>
                        </a>`;
                    }
                });
                if (itemC != "") {
                    subItem += `<div class="col-12 col-lg-12 col-md-12 sub-category">
                        <h3 class="mt-3 mb-2 border-bottom --c-blue" data-id="${s.id}"><small>${sName}</small></h3>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 px-0 pb-3">
                        <div class="-grid collection-list">${itemC}</div>
                    </div>`;
                    step3.innerHTML = subItem;
                }
            });
            return false;
        }
    });
    setTimeout(() => {
        document
            .querySelector(".card-category > .category-content")
            .querySelector(".content-overlay")
            ?.remove();
    }, 300);
};
// const SetSubCategory = (el) =>
// {
// const step3 = el.closest('.category-content').querySelector('.step3')
// const set = el.closest('li').getAttribute('data-id');
// Array.from(el.closest('#myTabs').querySelectorAll('.active'), (e) => { e?.classList.remove('active'); });
// el.classList.add('active');

// categories.map((m)=>{
//     if (m.id == set) {
//         let item = '';
//         m.sub.map((s) =>
//         {
//             if(s.display != 'd-none'){
//                 item += `<div class="sub-category card-sub" data-id="${s.id}" main="${m.id}">
//                     <div class="circle">
//                         <div class="images">
//                             <img src="${s.icon}" title="${s.name_th}" width="50" height="50">
//                         </div>
//                     </div>
//                     <div class="title">${s.name_th}</div>
//                 </div>`;
//             }
//         });
//         step3.innerHTML = item;
//         return false;
//     }
// });
// setTimeout(()=>{
//     sub = step2.querySelectorAll('.sub-category');
//     sub[0]?.click();
// },200)
// }

document.getElementById("formCategory").addEventListener("keyup", function () {
    clearTimeout(timer);
    document
        .querySelector(".card-category > .category-content")
        .appendChild(loadingOverlay);
    timer = setTimeout(() => {
        search = this.value.toLowerCase();
        categories.map((m) => {
            m.sub.map((s) => {
                s.category.map((c) => {
                    if (c.name != null) {
                        keyword = c.name.toLowerCase().indexOf(search);
                        c.display = keyword >= 0 ? "d-block" : "d-none";
                    }
                });
                let d = s.category.map(function (e) {
                    return e.display;
                });
                displayS = d.indexOf("d-block");
                s.display = displayS >= 0 ? "d-block" : "d-none";
            });
            let ds = m.sub.map(function (e) {
                return e.display;
            });
            display = ds.indexOf("d-block");
            m.display = display >= 0 ? "d-block" : "d-none";
        });
        adjustCategory(categories);
    }, waitTime);
});

document.addEventListener("click", function (e) {
    const Main = e.target.closest(".box__big-category");
    if (Main) {
        // if(!Main.closest('.tabs__big-category').classList.contains('coming-soon')){

        document
            .querySelector(".card-category > .category-content")
            .appendChild(loadingOverlay);
        // setTimeout(()=>{ SetSubCategory(Main) },300);
        setTimeout(() => {
            SetShow(Main);
        }, 300);
        // }
    }
});
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
async function allCategory() {
    const response = await fetch(`/api/get/category/all?lang=${lang}`);
    const data = await response.json();
    return data;
}
function CloseSearch(el) {
    cardCategory = el.closest(".card-category");
    cardCategory.querySelector(".search-content").remove();
    cardCategory.style.height = null;
}
function Calc(e) {
    cardCategory = e.closest(".card-category");
    headHeight = cardCategory.querySelector(
        ".justify-content-between"
    ).clientHeight;
    bodyHeight = cardCategory.querySelector(".search-content").clientHeight;
}
