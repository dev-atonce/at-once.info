"use strict";

const dnlConsts = 
{
    classes : {
        topLi:"dnl-list",
        titleSpan:"dnl-title"
    }
}
const topLvlUl = null;
class dnlConfig
{
    grabber = true;
    indexing = true;
}

class DraggableNestableList
{
    

    constructor(selector, config = new dnlConfig())
    {
        
        this.topLvlUl = $(selector);

        this.topLvlUl.addClass(dnlConsts.classes.topLi);

        // Every Li
        this.topLvlUl.find("li").each((i,e)=>{
            let li = $(e);
            li.find('.justify-content-end').addClass('d-none');
            let nestedUl = li.children("ul").first()?.remove();
            let oldLiHtml = li.html();
            let titleSpan = document.createElement("span");
            titleSpan.classList.add(dnlConsts.classes.titleSpan);

            if(config.grabber)
            {
                titleSpan.insertAdjacentHTML("beforeEnd", `
                    <span class="dnl-graber">
                        <span class="fas fa-bars dnl-grab-icon"></span>
                        ${config.indexing ? `
                            <span>
                                <span class="dnl-index"></span>
                                ${oldLiHtml}
                            </span>
                        `: oldLiHtml}
                    </span>
                `);
            }
            else
            {
                titleSpan.insertAdjacentHTML("beforeEnd", `
                    ${config.indexing ? `
                        <span>
                            <span class="dnl-index"></span>
                            ${oldLiHtml}
                        </span>
                    `: oldLiHtml}
                `); 
            }

            li.html(titleSpan)

            li.append(nestedUl);

            return;
        });

        // Nested Ul s
        this.topLvlUl.find("ul").each((i,e)=>{
            let nUl = $(e);
            nUl[0]?.classList.add(`${dnlConsts.classes.topLi}`,`show`);
            let parentLi = nUl.closest("li");
            parentLi.addClass("dnl-has-nested-ul");
            parentLi.find('.badge').addClass('d-none');
            parentLi.children(dnlConsts.classes.titleSpan.clas()).first().append(`<span class="fas fa-plus dnl-icon-collapsed"></span><span class="fas fa-minus dnl-icon-expanded"></span>`);

        });

        // Dragging Logic
        document.addEventListener('click',function(e){
            let nested = e.target.closest('.dnl-has-nested-ul');
            if(nested){
                e.stopPropagation();
                let li = e.target.closest("li");
                const openClass = 'dnl-section-open';
                if (li.classList?.contains('dnl-section-open')) li.classList.remove(openClass);
                else li.classList.add(openClass);
            }
        })
        // this.topLvlUl?.on("click", ".dnl-has-nested-ul", (e)=>{
        //     // Dont toggle list if user clicks on drag icon
        //     e.stopPropagation();

        //     // if(e.target.classList.value.includes("dnl-grab-icon")) return;
        //     let li = e.target.closest("li");
        //     const openClass = 'dnl-section-open';
        //     if (li.classList?.contains('dnl-section-open')) li.classList.remove(openClass);
        //     else li.classList.add(openClass);
        //     // $(e.target).closest("li").toggleClass("dnl-section-open");
        // });

        
        let RealLi = null;
        let CloneLiBeingDragged = null;

        this.topLvlUl?.on("mousemove","li",  (e)=>{
            if($(e.target).closest('ul').hasClass('dnl-list'))
            {
                // getting the closest parent li if a child of li emits this event
                let li = jQuery(e.target).closest("li");
                $(".dnlHovering").removeClass("dnlHovering");
                $(li).addClass("dnlHovering");

                // jQuery(".potentialLi").removeClass("potentialLi");
    
                // Check if an Item is being Dragged and the li user is hovering over is the sibling of dragged li
                if(CloneLiBeingDragged && RealLi.parent()[0] == li?.parent()[0]) 
                    $(li).addClass("potentialNewSpotLi");
            }
        });

        this.topLvlUl?.on("mouseleave","li",  (e)=>{
            // if(jQuery(e.target).data("lvl") != DraggingLiLevel && CloneLiBeingDragged != null) return;

            jQuery(".dnlHovering").removeClass("dnlHovering");
            jQuery(".potentialNewSpotLi").removeClass("potentialNewSpotLi");
        });
        

        this.topLvlUl.on("mousedown","li",  (e)=>{
            e.stopPropagation();
            if(config.grabber && !$(e.target).hasClass("dnl-grab-icon"))
            {
                console.log("Cancelled grab because cursor not on icon.")
                return;
            }
            this.topLvlUl?.css("user-select","none")
            RealLi = $(e.target).closest("li");
            CloneLiBeingDragged = RealLi.clone();
            $(CloneLiBeingDragged).addClass("cloneLiBeingDragged");
            $(e.target).closest("ul").append(CloneLiBeingDragged);
        });

        $("body").on("mousemove",  (e)=>{
            e.stopPropagation();

            if(!CloneLiBeingDragged) return;

            $(".cloneLiBeingDragged").css({
                "top":e.clientY+"px",
                "left":e.clientX+"px",
                "width": RealLi[0].getBoundingClientRect().width,
                "height": RealLi[0].getBoundingClientRect().height,
                "display":RealLi.css("display")
            });

            if(jQuery(".potentialNewSpotLi").length)
            {
                let PotentialNewSpotLi = $(".potentialNewSpotLi");
                var rect = PotentialNewSpotLi[0].getBoundingClientRect();
                var y = e.clientY - rect.top;  //y position within the element.
                var h = rect.height;

                if((y/h) < .5)
                {
                    PotentialNewSpotLi.removeClass("bottom");
                    PotentialNewSpotLi.addClass("top");
                }
                else{
                    PotentialNewSpotLi.addClass("bottom");
                    PotentialNewSpotLi.removeClass("top");
                }
            }

        });
        
        $("body").on("mouseup", (e)=>{
            e.stopPropagation();

            if($(".potentialNewSpotLi").length)
            {
                let PotentialNewSpotLi = $(".potentialNewSpotLi");
                var rect = PotentialNewSpotLi[0].getBoundingClientRect();
                var y = e.clientY - rect.top;  //y position within the element.
                var h = rect.height;

                if((y/h) < .5)
                {
                    PotentialNewSpotLi.before(RealLi[0]);
                }
                else
                    PotentialNewSpotLi.after(RealLi[0]);

                this.indexLis(this.topLvlUl);
            }

            CloneLiBeingDragged?.remove();
            CloneLiBeingDragged = null;
            $(".cloneLiBeingDragged").removeClass("cloneLiBeingDragged");

        });

        this.indexLis(this.topLvlUl);

    }
    
    destroy = () =>
    {
        if(this.topLvlUl?.length > 0) {
            $(this.topLvlUl[0]).removeClass('dnl-list');
            let sortContent = $(this.topLvlUl[0]).prev();
            sortContent.find('.sort-category').removeClass('d-none');
            sortContent.find('.sort-save').addClass('d-none');
            sortContent.find('.sort-cancel').addClass('d-none');
            sortContent.find('.justify-content-end').removeClass('d-none');
        }

        this.topLvlUl?.find("ul").each((i,e)=>{
            let ul = $(e);
            ul[0]?.classList.remove(`${dnlConsts.classes.topLi}`,`show`);
        })

        this.topLvlUl?.find("li").each((i,e) =>
        {
            e?.classList.remove('dnl-has-nested-ul');
            const dnlTitle = e.querySelector('.dnl-title');
            let ul = e.querySelector('ul.list-group');
            const oldHTML = dnlTitle?.querySelector('.dnl-grab-icon').nextSibling.nextElementSibling;
            oldHTML.querySelector('.dnl-index').remove();
            oldHTML.querySelector('.justify-content-end')?.classList.remove('d-none');
            oldHTML.querySelector('a[data-toggle="collapse"]')?.classList.remove('d-none');
            e.querySelector('.dnl-title').remove();
            e.innerHTML = oldHTML.innerHTML;
            if (ul != undefined) {
                ul.classList.remove('show'); 
                e?.appendChild(ul);
            }
        });
        delete this.topLvlUl;
    }

    save = (url) =>
    {
        let sort = [];
        let ul = $(this.topLvlUl).find('ul');
        console.log(ul);
        console.log($(ul.prevObject[0]).children().length);
        if ($(ul.prevObject[0]).children().length > 1)
            Array.from($(ul.prevObject[0]).children()).map(function(v,k){
                console.log(v);
                sort.push({
                    id: v.getAttribute('data-id'),
                    name: v.getAttribute('data-name'),
                    sort: (k+1)
                });
            });
        else
            Array.from(ul).map(function(vrd,j){
                if(vrd.nodeName == 'UL'){
                    let li = $(vrd).children();
                    
                    Array.from(li).map(function(v,k){
                        sort.push({
                            id: v.getAttribute('data-id'),
                            name: v.getAttribute('data-name'),
                            sort: (k+1)
                        })
                    })
                }
            });

        if (url) { 
            const resp = $.ajax({
                url:url,
                method:'post',
                async:false,
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'sort':sort
                }}).responseJSON;
            if(resp) this.destroy();
        }
        else console.log('URL not found, please enter your URL');
    }

    indexLis(ul) 
    {  
        ul?.children("li").each((i,e)=>{
            $(e).find(".dnl-index").first().text(`${i + 1}. `);

            if($(e).children("ul").length)
                this.indexLis($(e).children("ul").first());
        });
    }
}
// Returns the string with . prepended
Object.defineProperty(String.prototype, "clas", {
	value: function clas() {
        return "."+this;
	},
	writable: true,
	configurable: true
});
