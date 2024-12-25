
var category = window.location.pathname.split('/')[2];
var color=null,bg=null,bb=null,bb2=null;
switch (category)
{
    // case 'office-rent':             color='--c-aqua';               bg='--bg-aqua';                 bb='--border-b-aqua';               bb2='--border-b2-aqua';             break;
    // case 'contractor':              color='--c-redvioled';    bg='--bg-redvioled';    bb='--border-b-redvioled';      bb2='--border-b2-redvioled';    break;
    // case 'machinery':               color='--c-beefblood';          bg='--bg-beefblood';            bb='--border-b-beefblood';          bb2='--border-b2-beefblood';        break;
    case 'electrical-appliance':            color='--c-blueviolet';     bg='--bg-blueviolet';   bb='--border-b-blueviolet';     bb2='--border-b2-blueviolet';   break; //1
    case 'office-appliance':                color='--c-burlywood';      bg='--bg-burlywood';    bb='--border-b-burlywood';      bb2='--border-b2-burlywood';    break; //2
    case 'home-appliance':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //3
    case 'ceremony-appliance':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //4
    case 'baby-appliance':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //5
    case 'home-decoration':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //6
    case 'costume-and-beauty':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //7
    case 'automotive-spareparts':           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //8
    case 'music-audio':                     color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //9
    case 'sport':                           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //10
    case 'construction-materials':          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //11
    case 'chemicals':                       color='--c-ocher';          bg='--bg-ocher';        bb='--border-b-ocher';          bb2='--border-b2-ocher';        break; //12
    case 'packaging':                       color='--c-firebrick';      bg='--bg-firebrick';    bb='--border-b-firebrick';      bb2='--border-b2-firebrick';    break; //13
    case 'other-product':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //14
    case 'foods':                           color='--c-steelblue';      bg='--bg-steelblue';    bb='--border-b-steelblue';      bb2='--border-b2-steelblue';    break; //15
    case 'drinks':                          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //16
    case 'factory-equipment':               color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //17
    case 'hand-tool':                       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //18
    case 'machine-parts':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //19
    case 'medicines':                       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //20
    case 'medical-equipment':               color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //21
    case 'visa-support':                    color='--c-green';          bg='--bg-green';        bb='--border-b-green';          bb2='--border-b2-green';        break; //22
    case 'company-register':                color='--c-blueviolet';     bg='--bg-blueviolet';   bb='--border-b-blueviolet';     bb2='--border-b2-blueviolet';   break; //23
    case 'law-firm':                        color='--c-lightbrown';     bg='--bg-lightbrown';   bb='--border-b-lightbrown';     bb2='--border-b2-lightbrown';   break; //24
    case 'space-for-rent':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //25
    case 'consultant':                      color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //26
    case 'translater':                      color='--c-pink';           bg='--bg-pink';         bb='--border-b-pink';           bb2='--border-b2-pink';         break; //27
    case 'accounting':                      color='--c-gold';           bg='--bg-gold';         bb='--border-b-gold';           bb2='--border-b2-gold';         break; //28
    case 'prefabricated-office':            color='--c-cerise';         bg='--bg-cerise';       bb='--border-b-cerise';         bb2='--border-b2-cerise';       break; //29
    case 'logistics':                       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //30
    case 'warehouse':                       color='--c-blue';           bg='--bg-blue';         bb='--border-b-blue';           bb2='--border-b2-blue';         break; //31
    case 'forklift':                        color='--c-aquamarine';     bg='--bg-aquamarine';   bb='--border-b-aquamarine';     bb2='--border-b2-aquamarine';   break; //32
    case 'heavy-machinery':                 color='--c-mediumpurple';   bg='--bg-mediumpurple'; bb='--border-b-mediumpurple';   bb2='--border-b2-mediumpurple'; break; //33
    case 'transportation-warehouse-equipment':      color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';           break;  //34
    case 'credit-loan':                     color='--c-cornflowerblue'; bg='--bg-cornflowerblue';       bb='--border-b-cornflowerblue';         bb2='--border-b2-cornflowerblue';   break;  //35
    case 'insurance':                       color='--c-lightsalmon';    bg='--bg-lightsalmon';  bb='--border-b-lightsalmon';    bb2='--border-b2-lightsalmon';  break; //36
    case 'financial':                       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //37
    case 'online-marketing':                color='--c-red';            bg='--bg-red';          bb='--border-b-red';            bb2='--border-b2-red';          break; //38
    case 'it-hardware':                     color='--c-navy';           bg='--bg-navy';         bb='--border-b-navy';           bb2='--border-b2-navy';         break; //39
    case 'web-system':                      color='--c-emerald';        bg='--bg-emerald';      bb='--border-b-emerald';        bb2='--border-b2-emerald';      break; //40
    case 'sofware-development':             color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //41
    case 'printing':                        color='--c-yellowgreen';    bg='--bg-yellowgreen';  bb='--border-b-yellowgreen';    bb2='--border-b2-yellowgreen';  break; //42
    case 'advertising':                     color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //43
    case 'car-rental':                      color='--c-goldenrod';      bg='--bg-goldenrod';    bb='--border-b-goldenrod';      bb2='--border-b2-goldenrod';    break; //44
    case 'public-transportation':           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //45
    case 'security-system':                 color='--c-dark';           bg='--bg-dark';         bb='--border-b-dark';           bb2='--border-b2-dark';         break; //46
    case 'recruitment':                     color='--c-fuchsia';        bg='--bg-fuchsia';      bb='--border-b-fuchsia';        bb2='--border-b2-fuchsia';      break; //47
    case 'organizer':                       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //48
    case 'land-survey':                     color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //49
    case 'gardening':                       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //50
    case 'studio':                          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //51
    case 'cleaning':                        color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //52
    case 'insecticide':                     color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //53
    case 'other-general':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //54
    case 'machinery-repair':                color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //55
    case 'electronics-repair':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //56
    case 'automotive-repair':               color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //57
    case 'accessories-repair':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //59
    case 'watersupply-repair':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //60
    case 'furniture-repair':                color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //61
    case 'textiles-repair':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //58
    case 'machines-for-stamping':           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //62
    case 'machines-for-folding':            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //63
    case 'machines-for-casting':            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //64
    case 'machines-for-dressing':           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //65
    case 'machines-for-compression':        color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //66
    case 'machines-for-rolling':            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //67
    case 'machines-for-welding':            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //68
    case 'other-machinery':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //69
    case 'forklift-industry':               color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //70
    case 'heavy-machinery-industry':        color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //71
    case 'automotive':                      color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //72
    case 'mold':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //73
    case 'machine-tools':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //74
    case 'measuring-tools':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //75
    case 'hand-tool-industry':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //76
    case 'improve-texture':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //77
    case 'baby-appliance-industry':         color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //78
    case 'ceremony-appliance-industry':     color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //79
    case 'jewelry-beauty-industry':         color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //80
    case 'kitchen-appliance-industry':      color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //81
    case 'music-audio-industry':            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //82
    case 'sport-industry':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //83
    case 'foods-industry':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //84
    case 'drinks-industry':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //85
    case 'home-decoration-industry':        color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //86
    case 'office-appliance-industry':       color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //87
    case 'electric-kitchen-appliance':      color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //88
    case 'factory-electrical-appliance':    color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //89
    case 'power-generation':                color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //90
    case 'electrical-appliance-industry':   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //91
    case 'steel-metal-material':            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //92
    case 'wood':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //93
    case 'rubber':                          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //94
    case 'plastic':                         color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //95
    case 'glass':                           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //96
    case 'chemicals-industry':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //97
    case 'medical-equipment-industry':      color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //98
    case 'medicines-industry':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //99
    case 'agricultural-equipment':          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //100
    case 'agricultural-chemicals':          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //101
    case 'laboratory-instruments':          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //102
    case 'petroleum-fuel':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //103
    case 'rock':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //104
    case 'blick-and-tile':                  color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //105
    case 'cement':                          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //106
    case 'pole':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //107
    case 'door-windows':                    color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //108
    case 'pipe':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //109
    case 'other-construction-materials':    color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //110
    case 'textiles-clothing':               color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //111
    case 'costume-industry':                color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //112
    case 'leath':                           color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //113
    case 'canvas':                          color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //114
    case 'silk':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //115
    case 'zipper-button':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //116
    case 'packaging-industry':              color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //117
    case 'interior-decoration':             color='--c-tritanopia';     bg='--bg-tritanopia';   bb='--border-b-tritanopia';     bb2='--border-b2-tritanopia';   break; //118
    case 'broker':                          color='--c-applegreen';     bg='--bg-applegreen';   bb='--border-b-applegreen';     bb2='--border-b2-applegreen';   break; //119
    case 'contractor':                      color='--c-clearblue';      bg='--bg-clearblue';    bb='--border-b-clearblue';      bb2='--border-b2-clearblue';    break; //120
    case 'solar-cell':                      color='--c-skyblue';        bg='--bg-skyblue';      bb='--border-b-skyblue';        bb2='--border-b2-skyblue';      break; //121
    case 'insurance-lifestyle':             color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //122
    case 'institution':                     color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //123
    case 'organization':                    color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //124
    case 'farm':                            color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //125
    case 'space-for-rent-lifestyle':        color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //126
    case 'animal-hospital':                 color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //127
    case 'beauty-clinic':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //128
    case 'tourist':                         color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //129
    case 'accommodation':                   color='--c-orange';         bg='--bg-orange';       bb='--border-b-orange';         bb2='--border-b2-orange';       break; //130
    default: break; 
}

// var header = $('#header'), concept=$('.home__ads'), filter=$('#filter'), ;
// var header = $('nav.header');
// var concept = $('#mian-cover');
// var mainkeyword = $('.main-keyword');
// var filter = $('.filter');
// var filterForm = $('.filter-form');
// var companyList = $('.company-list');
// var bookmark = $('.bookmark-industry');

// header.addClass(bb2);
// mainkeyword.addClass(bg);
// concept.find('.bg-ti').addClass('--c-orange');
// concept.find('.bookmark-industry').addClass(bg);
// filter.find('button[value="search"]').addClass('--bg-blue');

// if(companyList.find('.card-profile').length>0) 
//     companyList
//     .find('.card-footer-cp')
//     .find('.search-buttons')
//     .addClass(bg);

