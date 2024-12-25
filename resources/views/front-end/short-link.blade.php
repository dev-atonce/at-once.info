<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <style>
        .copy{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="">
                        @csrf
                        <h4 class="text-center">ย่อลิงค์ Short URL</h4>
                        @if(Session('status')=='error')
                            <div class="alert alert-danger" role="alert">{{Session('message')}}</div>
                        @endif
                        @if(Session('status')=='warning')
                            <div class="alert alert-warning" role="alert">{{Session('message')}}</div>
                        @endif
                        @if(Session('status')=='success')
                            <div class="alert alert-success" role="alert">{{Session('message')}}<h6 class="text-success copy float-right">Copy</h6><input type="hidden" id="link" value="{{Session('message')}}"></div>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control" name="url">
                        </div>
                        <center><button class="btn btn-warning">Short Url</button></center>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script>
    $([document]).on('click','.copy',function(){
		var dummy = document.createElement('input'),
		text = document.getElementById('link');
		document.body.appendChild(dummy);
		dummy.value = text.value;
		dummy.select();
		document.execCommand('copy');
        // console.log(document);
		document.body.removeChild(dummy);
		// Notifications('Copied to clipboard');
	})
</script>