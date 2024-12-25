function statisticsLocate(len) {
    const stLength = len != null ? "?range=" + len : "";
    const response = $.ajax({
        url: "api/" + category + "/" + cid + "/statistics/locate" + stLength,
        async: false,
        dataType: "json",
    }).responseJSON;
    return response;
}

function fetchLocate(len) {
    const data = statisticsLocate(len);
    stLocate = [];
    $.each(data, function (k, v) {
        stLocate.push([v.country + ", " + v.city, v.clicks]);
    });
    tab = $("#st-country").DataTable();
    tab.destroy();
    $("#st-country").DataTable({
        retrieve: true,
        responsive: {
            details: false,
        },
        columnDefs: [{ targets: 1, className: "text-right" }],
        order: [[1, "desc"]],
        info: false,
        data: stLocate,
        language: {
            paginate: {
                previous: "&#171;",
                next: "&#187;",
            },
        },
    });
    return true;
}

function staticClick(request) {
    request = request == null ? "" : "?range=" + request;
    const stClick = $.ajax({
        url: "api/" + category + "/" + cid + "/statistics/click" + request,
        async: false,
    }).responseJSON;

    // $(".all-visit")
    //   .children()
    //   .next()
    //   .html(stClick.cptoweb + stClick.blogtoweb);
    $(".cptoweb").html(stClick.cptoweb);
    $(".blogtoweb").html(stClick.blogtoweb);

    $("allview").html(stClick.monthlyView);
    $("blogtocp").html(stClick.blogtocp);

    $(".monthly-view").html(stClick.monthlyView);
    $(".total-view").html(stClick.totalView);
    $(".news-monthly").html(stClick.blogMonthly);
    $(".news-total").html(stClick.blogTotal);
    $(".phone-monthly").html(stClick.telephoneMonthly);
    $(".phone-total").html(stClick.telephoneTotal);

    $(".letter-monthly").html(stClick.emailContactMonthly);
    $(".letter-total").html(stClick.emailContactTotal);

    $(".popup-monthly").html(stClick.popupMonthly);
    $(".popup-total").html(stClick.popupTotal);

    return Object.keys(stClick).length > 0 ? true : false;
}

function loaded() {
    setTimeout(function () {
        $(".group-box-right").fadeIn(300);
        $(".loading-overlay").fadeOut(300);
    }, 500);
}
