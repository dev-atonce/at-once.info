<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta http–equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http–equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
    <style>
        .em_defaultlink a {
            color: inherit !important;
            text-decoration: none !important;
        }

        .em-pt-25 {
            padding-top: 25px;
        }

        .em-pt-15 {
            padding-top: 25px;
        }

        .pb {
            padding-bottom: 10px;
        }

        .row {
            display: flex;
        }

        .col-left,
        .col-right {
            float: left;
        }

        .table {
            width: 100%;
        }

        table tr:last-child {
            background: #dedede;
        }

        table tr:last-child td {
            padding: 10px;
        }

        .em_logo {
            width: 20%;
        }

        .text-red {
            color: red;
        }

        .text-blue {
            color: blue;
        }

        td .em_content {
            height: 100vh - 260px;
        }

        @media (min-width: 1366px) {
            .em_logo {
                width: 5%;
            }
        }
    </style>
</head>

<body style="margin:0px; padding:0px;">

    <img src="{{url($blogImg->images)}}" alt="">
    <div style="display: flex; margin-top: 15px; margin-bottom: 15px;">
        <h2 style="margin-right: 30px">สามารถอ่านรายละเอียดเพิ่มเติมได้ที่นี่</h2>
        <a href="{{$blogUrl}}"><img src="https://at-once.info/images/click02.png" alt=""></a>
    </div>

    <p>From. www.at-once.info</p>

</body>

</html>
