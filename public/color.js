
var industry = window.location.pathname.split('/')[2];
var color=null,bg=null,bb=null,b2=null;;
switch (industry) {
    case 'logistics':               color='--orange';       bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break;
    case 'solar-cell':              color='--skyblue';      bg='--bg-skyblue';      bb='--border-b-skyblue';        bb2='--border-b2-skyblue';      break;
    case 'translater':              color='--pink';         bg='--bg-pink';         bb='--border-b-pink';           bb2='--border-b2-pink';         break;
    case 'car-rental':              color='--goldenrod';    bg='--bg-goldenrod';    bb='--border-b-goldenrod';      bb2='--border-b2-goldenrod';    break;
    case 'visa-support':            color='--green';        bg='--bg-green';        bb='--border-b-green';          bb2='--border-b2-green';        break;
    case 'company-register':        color='--blueviolet';   bg='--bg-blueviolet';   bb='--border-b-blueviolet';     bb2='--border-b2-blueviolet';   break;
    case 'warehouse':               color='--blue';         bg='--bg-blue';         bb='--border-b-blue';           bb2='--border-b2-blue';         break;
    case 'printing':                color='--yellowgreen';  bg='--bg-yellowgreen';  bb='--border-b-yellowgreen';    bb2='--border-b2-yellowgreen';  break;
    case 'account':                 color='--gold';         bg='--bg-gold';         bb='--border-b-gold';           bb2='--border-b2-gold';         break;
    case 'law-firm':                color='--lightbrown';   bg='--bg-lightbrown';   bb='--border-b-lightbrown';     bb2='--border-b2-lightbrown';   break;
    case 'web-marketing':           color='--red';          bg='--bg-red';          bb='--border-b-red';            bb2='--border-b2-red';          break;
    case 'recruitment':             color='--fuchsia';      bg='--bg-fuchsia';      bb='--border-b-fuchsia';        bb2='--border-b2-fuchsia';      break;
    case 'web-system':              color='--emerald';      bg='--bg-emerald';      bb='--border-b-emerald';        bb2='--border-b2-emerald';      break;
    case 'co-working':              color='--cerise';       bg='--bg-cerise';       bb='--border-b-cerise';         bb2='--border-b2-cerise';       break;
    case 'office-rent':             color='--aqua';         bg='--bg-aqua';         bb='--border-b-aqua';           bb2='--border-b2-aqua';         break;
    case 'construction-machine':    color='--mediumpurple'; bg='--bg-mediumpurple'; bb='--border-b-mediumpurple';   bb2='--border-b2-mediumpurple'; break;
    case 'forklift':                color='--aquamarine';   bg='--bg-aquamarine';   bb='--border-b-aquamarine';     bb2='--border-b2-aquamarine';   break;
    case 'interior-design':         color='--tritanopia';   bg='--bg-tritanopia';   bb='--border-b-tritanopia';     bb2='--border-b2-tritanopia';   break;
    case 'security-system':         color='--dark';         bg='--bg-dark';         bb='--border-b-dark';           bb2='--border-b2-dark';         break;
    case 'real-estate-agent':       color='--applegreen';   bg='--bg-applegreen';   bb='--border-b-applegreen';     bb2='--border-b2-applegreen';   break;
    case 'package':                 color='--firebrick';    bg='--bg-firebrick';    bb='--border-b-firebrick';      bb2='--border-b2-firebrick';    break;
    case 'insurance':               color='--lightsalmon';  bg='--bg-lightsalmon';  bb='--border-b-lightsalmon';    bb2='--border-b2-lightsalmon';  break;
    case 'construction':            color='--clearblue';    bg='--bg-clearblue';    bb='--border-b-clearblue';      bb2='--border-b2-clearblue';    break;
    case 'leasing':         color='--cornflowerblue';   bg='--bg-cornflowerblue';   bb='--border-b-cornflowerblue'; bb2='--border-b2-cornflowerblue';  break;
    default: break;
}

var header = $('#header'), concept=$('.home__ads'), filter=$('#filter'), companyList=$('.company-list');
var header = $('#header'), concept=$('#mian-cover'), filter=$('.filter');
header.addClass(bb2);
concept.find('.bg-ti').addClass(bg);
filter.find('.header').addClass(bg);
filter.find('button[value="search"]').addClass(bg);

if(companyList.find('.card-profile').length>0) companyList.find('.card-footer-cp').find('.search-buttons').addClass(bg);