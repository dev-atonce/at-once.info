$(window).on("blur focus", function(e) {
    let getS = JSON.parse(localStorage.getItem(category));
    var prevType = $(this).data("prevType");   
    if (prevType != e.type) {   //  reduce double fire issues
        switch (e.type) {
            case "blur": break;
            case "focus":
                if(getS?.sendTo.id.length > $('#companyList').find('.badge').length)
                {                       
                    fetchItem();
                    $('html,body').animate({
                        scrollTop: $('.company-form').offset().top - 200
                    },500);
                }
            break;
        }
    }
    $(this).data("prevType", e.type);
})