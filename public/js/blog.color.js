

function getBorderColor(category, where) {
    var borderColor = '';
    var bgColor = '';
    var fontColor = '';
    switch (category) {
        case 'logistics': borderColor = '--border-orange'; bgColor = '--bg-orange'; fontColor = '--c-orange'; break;
        case 'solar-cell': borderColor = '--border-skyblue'; bgColor = '--bg-skyblue'; fontColor = '--c-skyblue'; break;
        case 'translater': borderColor = '--border-pink'; bgColor = '--bg-pink'; fontColor = '--c-pink'; break;
        case 'car-rental': borderColor = '--border-goldenrod'; bgColor = '--bg-goldenrod'; fontColor = '--c-goldenrod'; break;
        case 'visa-support': borderColor = '--border-green'; bgColor = '--bg-green'; fontColor = '--c-green'; break;
        case 'company-register': borderColor = '--border-blueviolet'; bgColor = '--bg-blueviolet'; fontColor = '--c-blueviolet'; break;
        case 'warehouse': borderColor = '--border-blue'; bgColor = '--bg-blue'; fontColor = '--c-blue'; break;
        case 'printing': borderColor = '--border-yellowgreen'; bgColor = '--bg-yellowgreen'; fontColor = '--c-yellowgreen'; break;
        case 'account': borderColor = '--border-gold'; bgColor = '--bg-gold'; fontColor = '--c-gold'; break;
        case 'law-firm': borderColor = '--border-lightbrown'; bgColor = '--bg-lightbrown'; fontColor = '--c-lightbrown'; break;
        case 'web-marketing': borderColor = '--border-red'; bgColor = '--bg-red'; fontColor = '--c-red'; break;
        case 'recruitment': borderColor = '--border-fuchsia'; bgColor = '--bg-fuchsia'; fontColor = '--c-fuchsia'; break;
        case 'web-system': borderColor = '--border-emerald'; bgColor = '--bg-emerald'; fontColor = '--c-emerald'; break;
        case 'prefabricated-office': borderColor = '--border-cerise'; bgColor = '--bg-cerise'; fontColor = '--c-cerise'; break;
        case 'office-rent': borderColor = '--border-aqua'; bgColor = '--bg-aqua'; fontColor = '--c-aqua'; break;
        case 'heavy-machinery': borderColor = '--border-mediumpurple'; bgColor = '--bg-mediumpurple'; fontColor = '--c-mediumpurple'; break;
        case 'forklift': borderColor = '--border-aquamarine'; bgColor = '--bg-aquamarine'; fontColor = '--c-aquamarine'; break;
        case 'interior-decoration': borderColor = '--border-tritanopia'; bgColor = '--bg-tritanopia'; fontColor = '--c-tritanopia'; break;
        case 'security-system': borderColor = '--border-dark'; bgColor = '--bg-dark'; fontColor = '--c-dark'; break;
        case 'broker': borderColor = '--border-applegreen'; bgColor = '--bg-applegreen'; fontColor = '--c-applegreen'; break;
        case 'package': borderColor = '--border-firebrick'; bgColor = '--bg-firebrick'; fontColor = '--c-firebrick'; break;
        case 'insurance': borderColor = '--border-lightsalmon'; bgColor = '--bg-lightsalmon'; fontColor = '--c-lightsalmon'; break;
        case 'contractor': borderColor = '--border-clearblue'; bgColor = '--bg-clearblue'; fontColor = '--c-clearblue'; break;
        case 'credit-loan': borderColor = '--border-cornflowerblue'; bgColor = '--bg-cornflowerblue'; fontColor = '--c-cornflowerblue'; break;
        case 'textiles-clothing': borderColor = '--border-indigo'; bgColor = '--bg-indigo'; fontColor = '--c-indigo'; break;
        case 'machinery': borderColor = '--border-beefblood'; bgColor = '--bg-beefblood'; fontColor = '--c-beefblood'; break;
        case 'chemicals': borderColor = '--border-ocher'; bgColor = '--bg-ocher'; fontColor = '--c-ocher'; break;
        case 'foods': borderColor = '--border-steelblue'; bgColor = '--bg-steelblue'; fontColor = '--c-steelblue'; break;
        case 'it': borderColor = '--border-navy'; bgColor = '--bg-navy'; fontColor = '--c-navy'; break;
        case 'electrical-appliance': borderColor = '--border-blueviolet'; bgColor = '--bg-blueviolet'; fontColor = '--c-blueviolet'; break;
        case 'office-supplies': borderColor = '--c-burlywood'; bgColor = '--bg-burlywood'; fontColor = '--c-burlywood'; break;
        default: break;
    }
    if (where == "borderColor") {
        return borderColor;
    }
    if (where == "bgColor") {
        return bgColor;
    }
    if (where == "fontColor") {
        return fontColor;
    }
}
// blogList = document.querySelectorAll('.blog-list');
// for (i = 0; i < blogList.length; i++) {
    // let item = blogList[i];
    // let borderClass = getBorderColor(blogList[i].getAttribute('data-key'), 'borderColor');
    // if(borderClass){
    //     img = blogList[i].querySelectorAll('img');
    //     for (j = 0; j < img.length; j++) {
    //         img[j].classList.add(borderClass);
    //     }
    // } else {
    //     img = blogList[i].querySelectorAll('img');
    //     for (j = 0; j < img.length; j++) {
    //         img[j].classList.add('--border-orange');
    //     }
    // }
    // let lineColor = getBorderColor(blogList[i].getAttribute('data-key'), 'borderColor');
    // if(lineColor){
    //     idsName = blogList[i].querySelector('.border-3x')
    //     if(idsName){
    //         idsName.classList.add(lineColor)
    //     }
    // } else {
    //     idsName = blogList[i].querySelector('.border-3x')
    //     if(idsName){
    //         idsName.classList.add('--border-orange')
    //     }
    // }
    // let fontColor = getBorderColor(blogList[i].getAttribute('data-key'), 'fontColor');
    // if(fontColor){
    //     bullet = blogList[i].querySelector('.bullet')
    //     if(bullet){
    //         bullet.classList.add(fontColor)
    //     }
    // } else {
    //     bullet = blogList[i].querySelector('.bullet')
    //     if(bullet){
    //         bullet.classList.add('--c-orange')
    //     }
    // }
// }

// category = document.querySelectorAll('.categoryClick');
// for (i = 0; i < category.length; i++) {
//     let bgClass = getBorderColor(category[i].getAttribute('data-key'), 'bgColor');
//     if(bgClass){
//         bg = category[i].querySelector('.categoryname')
//         if(bg){
//             bg.classList.add(bgClass)
//         }
//     } else {
//         bg = category[i].querySelector('.categoryname')
//         if(bg){
//             bg.classList.add('--bg-navy')
//         }
//     }
// }
