var listArea = $(".company-list");
var listAreaHeight = listArea.find(".row").height();

const moreBtn = $("#more-company");
const lastChild = moreBtn.closest(".col-lg-12");
const nomore = $(
    '<div class="col-md-12 col-md-6 col-lg-12 no-more" style="margin-top:-12px;">\
    <div class="d-flex justify-content-sm-center">\
        <span class="ml-2 text-light">No more.</span>\
    </div>\
</div>'
);

var throttleTimer;
const throttle = (callback, time) => {
    if (throttleTimer) return;
    throttleTimer = true;
    setTimeout(() => {
        callback();
        throttleTimer = false;
    }, time);
};

const handleInfiniteScroll = () => {
    throttle(() => {
        // เดิม -70 //
        const endOfPage =
            listArea.scrollTop() >=
            listArea.find(".row").outerHeight() -
                Math.round(listArea.offset().top) -
                296;
        if (endOfPage) {
            if ($(".no-more").length == 0) {
                $(".load-more-content").removeClass("d-none");
                fetchData();
            }
        }
    }, 1000);
};
document
    .querySelector(".company-list")
    .addEventListener("scroll", handleInfiniteScroll);

lang = window.location.pathname.replace("/", "").split("/")[0];

const phrase = {
    more: {
        th: "ดูรายละเอียด",
        en: "see details",
        jp: "詳細を見る",
        ch: "看詳情",
    },
    select: {
        th: "เลือก",
        en: "Select",
        jp: "選ぶ",
        ch: "選擇",
    },
    images: {
        th: "ดูภาพทั้งหมด",
        en: "View all images",
        jp: "すべての画像を表示",
        ch: "查看所有图片",
    },
};

async function fetchData() {
    let cid = [];
    $(".card-profile").map(function (k, v) {
        cid.push(v.getAttribute("data-id"));
    });
    const skip = $("#more-company").attr("data-more");
    const category = $("#more-company").attr("data-category");

    let list = $('<div class="col-md-12 col-md-6 col-lg-12"></div>');

    const urlSearchParams = new URLSearchParams(window.location.search);
    params = Object.fromEntries(urlSearchParams.entries());
    arr = [];
    $.each(params, function (k, v) {
        if (v != "") arr[k] = v;
    });
    arr["category"] = category;
    // arr['skip']= skip;
    arr["lang"] = lang;
    arr["cid"] = cid.toString();
    let obj = Object.assign({}, arr);

    const response = await axios.post(`api/company/more`, obj);

    if (response.data.length > 0) {
        response.data?.map(function (val, key) {
            let row = val.data;
            let locate = '<span class="badge-location">';
            val.locations?.map(function (v, k) {
                if (k == 0)
                    locate += '<i class="fas fa-map-marker-alt fa-fw"></i>' + v;
                else locate += ", " + v;
            });

            locate += "</span>";
            let gallerys =
                '<div class="gallery-flex relative-gall" id="light' +
                row.id +
                '">';

            val.gallerys?.map(function (v, k) {
                if (k < 3)
                    gallerys +=
                        '<a href="' +
                        v +
                        '" style="background-image:url(' +
                        v.replace(".", "-sm.") +
                        ');background-position:center;background-size:cover;border-radius:4px;"><img src="' +
                        v.replace(".", "-sm.") +
                        '" class="cWzaZM" style="display: none;"></a>';
                else if (k == 3)
                    gallerys +=
                        '<a href="' +
                        v +
                        '" style="background-image:url(' +
                        v.replace(".", "-sm.") +
                        ');background-position:center;background-size:cover;border-radius:4px;"><img src="' +
                        v.replace(".", "-sm.") +
                        '" class="cWzaZM" style="display: none;"><div class="overlay-see-all"><span class="backdrop-gallery" style="text-align:center;vertical-align:middle;height:100%;vertical-align:-webkit-baseline-middle;">' +
                        phrase.images[lang] +
                        "</span></div></a>";
                else
                    gallerys +=
                        '<a href="' +
                        v +
                        '" style="background-image:url(' +
                        v.replace(".", "-sm.") +
                        ');background-position:center;background-size:cover;border-radius:4px;  position:relative;display:none;"><img src="' +
                        v.replace(".", "-sm.") +
                        '" class="cWzaZM" style="display: none;"></a>';
            });
            gallerys += "</div>";
            let flag =
                row.alpha2 != undefined
                    ? '<div class="box-nation"><small class="nation"><img src="https://www.at-once.info/flags/' +
                      row.alpha2?.toLowerCase() +
                      '.png"> ' +
                      row.nationality +
                      " Company</small></div>"
                    : '<div class="box-nation"><small class="nation"></small></div>';
            let websiteClass = row.website == null ? "none-info" : "";
            let hrefWeb =
                row.website != null ? 'href="' + row.website + '"' : "";
            let facebookClass = row.facebook == null ? "none-info" : "";
            let hrefFace =
                row.facebook != null ? 'href="' + row.facebook + '"' : "";
            let linekClass = row.line == null ? "none-info" : "";
            let position = row.line != null ? row.line.search("@") : "";
            if (position >= 0 && row.line != null) {
                hrefLine =
                    'href="https://line.me/ti/p/' +
                    row.line.replace("@", "%40") +
                    '"';
            } else {
                hrefLine = 'href="https://line.me/ti/p/~' + row.line + '"';
            }
            let item = "";
            // list.append(
            item +=
                '<div class="card-profile" data-id="' +
                row.id +
                '">\
                    <div class="toggle">\
                        <div class="rkmd-checkbox checkbox-ripple">\
                            <label for="com_' +
                row.id +
                '" class="label">' +
                phrase.select[lang] +
                '</label>\
                            <label class="input-checkbox checkbox-lightBlue">\
                                <input type="checkbox" id="com_' +
                row.id +
                '" class="mr-1 comp-select" value="' +
                row.id +
                '" tag="' +
                row.id +
                '" text="' +
                row.name +
                '">\
                                <span class="checkbox"></span>\
                            </label>\
                        </div>\
                    </div>\
                    <div class="card-top row" style="align-items: center; visibility: visible;">\
                        <div class="col-12 col-lg-9 pl-2 pr-2 pl-lg-3 pr-lg-3">\
                            <div class="row">';

            if (row.type != "basic") {
                if (row.type == "full") {
                    item +=
                        '<div class="col-4 col-lg-3 pr-lg-0">\
                                                            <a href="' +
                        lang +
                        "/" +
                        row.key +
                        "/cp/" +
                        row.profile_url +
                        '" target="_blank"><img src="' +
                        row.logo?.replace(".", "-xs.") +
                        '" src-xs="' +
                        row.logo?.replace(".", "-xs.") +
                        '" alt="' +
                        row.name +
                        '" class="img-fluid logo-company"></a>\
                                                            ' +
                        flag +
                        '\
                                                                <div class="social"> \
                                                                    <a class="aicon ' +
                        websiteClass +
                        '" ' +
                        hrefWeb +
                        ' target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="" data-original-title="Website">\
                                                                        <span class="boxicon website"></span>\
                                                                    </a>\
                                                                    <a class="aicon ' +
                        facebookClass +
                        '" ' +
                        hrefFace +
                        ' target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="" data-original-title="facebook">\
                                                                        <span class="boxicon facebook"></span>\
                                                                    </a>\
                                                                    <a class="aicon ' +
                        linekClass +
                        '" ' +
                        hrefLine +
                        ' target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="" data-original-title="Line">\
                                                                        <span class="boxicon line-card"></span>\
                                                                    </a>\
                                                                </div>\
                                                            </div>';
                } else {
                    item +=
                        '<div class="col-4 col-lg-3 pr-lg-0">\
                                                            <a href="' +
                        lang +
                        "/" +
                        row.key +
                        "/cp/" +
                        row.profile_url +
                        '" target="_blank"><img src="' +
                        row.logo?.replace(".", "-xs.") +
                        '" src-xs="' +
                        row.logo?.replace(".", "-xs.") +
                        '" alt="' +
                        row.name +
                        '" class="img-fluid logo-company blury"></a>\
                                                            ' +
                        flag +
                        '\
                                                                <div class="social"> \
                                                                    <a class="aicon ' +
                        websiteClass +
                        '" ' +
                        hrefWeb +
                        ' target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="" data-original-title="Website">\
                                                                        <span class="boxicon website"></span>\
                                                                    </a>\
                                                                    <a class="aicon ' +
                        facebookClass +
                        '" ' +
                        hrefFace +
                        ' target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="" data-original-title="facebook">\
                                                                        <span class="boxicon facebook"></span>\
                                                                    </a>\
                                                                    <a class="aicon ' +
                        linekClass +
                        '" ' +
                        hrefLine +
                        ' target="_blank" rel="noopener" data-toggle="tooltip" data-placement="top" title="" data-original-title="Line">\
                                                                        <span class="boxicon line-card"></span>\
                                                                    </a>\
                                                                </div>\
                                                            </div>';
                }
            }
            if (row.type != "basic") {
                item += '<div class="col-8 col-lg-9 ';
            } else {
                item += '<div class="col-lg-12 ';
            }
            item +=
                ' pl-0 pl-lg-4">\
                                        <h3 class="title bold">\
                                            <a href="' +
                lang +
                "/" +
                row.key +
                "/cp/" +
                row.profile_url +
                '" target="_blank" class="skiptranslate">' +
                row.name +
                "</a>\
                                        </h3>";
            if (row.type != "basic") {
                item += locate;
            }
            item += '<div class="content">';
            if (row.type != "basic") {
                if (row.description) {
                    item += '<p class="highlight"> ' + row.description + "</p>";
                } else if (row.description_th) {
                    item +=
                        '<p class="highlight"> ' + row.description_th + "</p>";
                }
            } else {
                if (row.description) {
                    item +=
                        '<p class="highlight-basic"> ' +
                        row.description +
                        "</p>";
                }
            }
            item +=
                '</div>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-lg-3 pl-2 pr-2 pl-lg-3 pr-lg-3">';
            if (row.type != "basic") {
                item +=
                    '<div class="light-g d-none d-lg-block">' +
                    gallerys +
                    "</div>";
            }
            item +=
                '<div class="card-footer-cp ">\
                                    <a target="_blank" href="' +
                lang +
                "/" +
                row.key +
                "/cp/" +
                row.profile_url +
                '" class="search-buttons ' +
                ' capture="index" data-full="' +
                lang +
                "/" +
                row.key +
                "/cp/" +
                row.profile_url +
                '">' +
                phrase.more[lang] +
                "</a>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>";
            list.append(item);
            list.insertBefore(lastChild);
        });
    } else {
        $(".load-more-content").addClass("d-none");
        nomore.insertBefore(lastChild);
    }
    $(".light-g").each(function () {
        $(this)
            .find(".gallery-flex")
            .lightGallery({ thumbnail: true, download: false });
    });
}
