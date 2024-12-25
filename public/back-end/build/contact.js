tinymce.init({
    selector: 'textarea.tiny',
    menubar : false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : '',
    height: 500, 
    //width : 1100,
    plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
    toolbar: 'insertfile undo redo | table | styleselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',
    
});
$('textarea[name="map"]').on('keyup',function(){
    $('.map-preview').html($(this).val());
})