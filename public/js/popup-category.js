var category = window.location.pathname.split("/")[2];
var d = $.fn.deviceDetector;
var resetBtn = ".reset-all-filters";
var color = "--c-orange";
formFilter = $("#formFilters");
formFilter.find("span.form-control").map(function (k, el) {
    $(`#${el.getAttribute("id")}`).hunterPopup({
        placement: "left",
        width: $(".container").width() - 10,
        title: el.getAttribute("title"),
        content: $(`#filter-${el.getAttribute("id")}`),
        resetBtn: resetBtn,
        event: function () {
            var content = $(`#filter-${el.getAttribute("id")}`);
            box = $(`#${el.getAttribute("id")}`);
            if (!d.isMobile()) {
                $(".Hunter-pop-up").css({
                    left: $(".container").offset().left + 15,
                    right: $(".container").offset().left + 15,
                });
            }
            var data = { id: [], text: [] };
            content.find(".choice").on("change", function () {
                data = { id: [], text: [] };
                adjust(box);
            });
            // $(document).on('change',`#filter-${el.getAttribute('id')} > .choice`,function(){ });
            function adjust() {
                content.find(".choice:checked").map(function () {
                    data.id.push($(this).val());
                    data.text.push(" " + $(this).attr("text"));
                });
                box.html(data.text.join(", "));
                if (data.text.length > 0) {
                    box.addClass(color);
                } else {
                    box.removeClass(color);
                    box.html(box.attr("title"));
                }
                box.next().val(data.id);
            }
            $(".clear-list").click(function () {
                box.html(box.attr("title"));
                box.next().val("");
                content.find(".choice:checked").prop("checked", false);
                box.removeClass(color);
            });
        },
    });
});

let resetFilter = document.querySelector(".reset-all-filters");

resetFilter.addEventListener("click", (e) => {
    formFilters = e.target.closest("#formFilters").querySelector("input[type=checkbox]");
    if (formFilters) {
        formFilters.checked = false;
    }
});

function getQueryParams(url) {
    const paramArr = url.slice(url.indexOf("?") + 1).split("&");
    const params = {};
    paramArr.map((param) => {
        const [key, val] = param.split("=");
        if (key != "submit" && key != "keywords") {
            if (val != "") params[key] = decodeURIComponent(val);
        }
    });
    return params;
}

let params = getQueryParams(window.location.search);
let checkedName = [];
$.each(params, function (i, v) {
    if ($(`.${i}_`).length > 0) {
        val = v.split(",");
        let text = [];
        let request = [];
        $.each($(`.${i}_[checked=""]`), function (j, v) {
            text.push($(v).attr("text"));
            request.push($(v).val());
        });
        checkedName[i] = text;
        $(`#${i}`).html(text.join(", "));
        $(`#${i}`).addClass(color);
        // $(`input[name="${i}"]`).val(request.join(','));
    }
});
