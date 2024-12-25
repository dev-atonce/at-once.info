@php($about=\App\Models\CategoryMd::where('key',Request::segment(2))->select("detail_$lang as detail")->first())
@if(@$about->detail)
<section class="more-content">
    <div class="container my-5">
        {!!$about->detail!!}
    </div>
</section>
<script>
    var moreContent = document.querySelector('.more-content');
    var rows = moreContent.querySelectorAll('.row');
    var readMoreAbourBtn = document.createElement('div');
    const text = {
        open : (document.querySelector('html').getAttribute('lang') == 'th')?'อ่านต่อ':'More',
        close : (document.querySelector('html').getAttribute('lang') == 'th')?'ย่อ':'Less'
    }

    readMoreAbourBtn.setAttribute('class','text-center mb-5');
    readMoreAbourBtn.innerHTML = `<span class="text-center btn btn-orange read-more-btn">อ่านต่อ</span>`;
    moreContent.querySelector('.container').append(readMoreAbourBtn);
    rows.forEach((el,i)=> {
        if( i > 0) el.classList.add('data-more','d-none');
    });
    document.addEventListener('click',function(e){
        const readMoreBtn = e.target.closest('.read-more-btn');
        if(readMoreBtn) {
            if(readMoreBtn.closest('.container').querySelector('.data-more').classList.contains('d-none')){
                readMoreBtn.closest('.container').querySelector('.data-more').classList.remove('d-none');
                readMoreBtn.innerText = text.close;
            }else{
                readMoreBtn.closest('.container').querySelector('.data-more').classList.add('d-none');
                readMoreBtn.innerText = text.open;
            }
        }
    })
    // $('[data-readmore-toggle]').click(function(e) {
    //     e.preventDefault();
        
    //     var open_text = $(this).siblings('div[data-readmore]').data('open-text');
    //     var close_text = $(this).siblings('div[data-readmore]').data('close-text');
        
    //     if(typeof open_text == 'undefined') {open_text = "อ่านต่อ"}
    //     if(typeof close_text == 'undefined') {close_text = "ย่อ"}

    //     if($(this).text() == open_text) {
    //         $(this).html(close_text).parent().prev('div[data-readmore]').show();
    //     } else {
    //         $(this).html(open_text).parent().prev('div[data-readmore]').hide();
    //     }
    // });
</script>
@endif