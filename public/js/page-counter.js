var config = {
    
}
function threeTimes()
{
    $.ajax({
        method:'get',
        data:{
            page: 'promotion-package'
        },
        success:function(res){
            if(res>=3){

            }
        },
        error:function(err){ console.log(err) }
    })
}