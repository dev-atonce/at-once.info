<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Demo Logistic</title>

    <base href="{{url('/')}}">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Noto+Sans+JP:wght@100;300;500;700;900&family=Roboto:ital,wght@0,100;0,300;1,500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-4.5.2/css/bootstrap.css">
    <style>
        body{
            background-color: #f3f3f3;
            margin:0;
            padding:0;
            top:0;
            bottom:0;
        }
        .container{
            box-shadow: 0 0 5px 2px rgba(225,225,225);
        }

        .tag:last-child{
            margin:unset;
        }
        .tag{
            display: inline-block;
            background-color: #f3f3f3;
            padding: 5px 10px 7px 10px;;
            border-radius: 5px;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .tag a{
            margin-right: 3px;
            padding-left: 5px;
            border-left:1px solid #007bff;
        }
    </style>
</head>
<body>
    <section>
        <div class="container bg-white">
            <div class="panel">
                <div class="panel-body p-3">
                    <div class="row">
                        <div class="col-lg-12"><h4 class="text-center">@lang('phrase.confirmation')</h4></div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-warning">
                                <span><i class="fas fa-exclamation-triangle"></i> @lang('phrase.check')</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">@lang('phrase.company') :</label>
                                <div id="tag-input">
                                    {{-- <span class="tag" data-tag="really">Really&nbsp;<a class="fas fa-times fa-xs"></a></span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">@lang('phrase.company-name') :</label>
                                <input type="text" class="form-control" name="company">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">@lang('phrase.telephone') :</label>
                                <input type="text" class="form-control" name="telephone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">@lang('phrase.position') :</label>
                                <input type="text" class="form-control" name="position">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">@lang('phrase.name') :</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email :</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">@lang('phrase.content') :</label>
                                <textarea type="text" class="form-control" name="content" rows="20"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12"><button type="button" class="btn btn-success float-right">Send</button></div>
                    </div>
                </div>
        
            </div>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="bootstrap-4.5.2/js/bootstrap.js"></script>
</body>
</html>
<script>
    var saveMy = JSON.parse(localStorage.getItem('saveMy'));
    $('input[name="company"]').val(saveMy.company);
    $('input[name="telephone"]').val(saveMy.telephone);
    $('input[name="position"]').val(saveMy.position);
    $('input[name="name"]').val(saveMy.name);
    $('input[name="email"]').val(saveMy.email);
    $('textarea[name="content"]').val(saveMy.content);
    // console.log(saveMy)
    
    // console.log(saveMy.sendTo)
    fetchItem();
    function fetchItem() {
        $('#tag-input').html('');
        $.each(saveMy.sendTo.id,function(k,v){
            var item = $('<span class="tag"><a class="fas fa-times fa-xs removeItem"></a></span>');
            $(item,'.tag').attr('data-tag',v);
            $(item,'.tag').prepend(saveMy.sendTo.text[k]+'&nbsp;');
            $('#tag-input').append(item);
        })
    }
    $(document).on('click','.removeItem',function(){
        removeItem($(this).parent())
    })
    function removeItem(el)
    {
        saveMy.sendTo.id.splice( $.inArray(el.val(), saveMy.sendTo.id), 1 );
        saveMy.sendTo.text.splice( $.inArray(el.data('tag'), saveMy.sendTo.text), 1 );
        localStorage.setItem('saveMy',JSON.stringify(saveMy));
        fetchItem();
    }
    
</script>
