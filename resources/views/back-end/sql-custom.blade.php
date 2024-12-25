<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQL Custom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @if($rows->count()>0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="3%">#</th>
                <th width="17%">name TH</th>
                <th width="17%">name JP</th>
                <th width="10%">created</th>
                <th width="7%">created_by</th>
                <th width="10%">edited</th>
                <th width="7%">edited_by</th>
                <th width="10%">public</th>
                <th width="7%">public_by</th>
                <th width="10%">published_on</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $key => $row)
                <tr>
                    <td >{{$row->id}}</td>
                    <td >{{$row->name_th}}</td>
                    <td >{{$row->name_jp}}</td>
                    <td >{{$row->created}}</td>
                    <td >{{$row->created_by}}</td>
                    <td >{{$row->edited}}</td>
                    <td >{{$row->edited_by}}</td>
                    <td >{{$row->pubilc}}</td>
                    <td >{{$row->public_by}}</td>
                    <td >{{$row->published_on}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>