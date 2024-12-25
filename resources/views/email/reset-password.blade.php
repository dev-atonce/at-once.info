<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta http–equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http–equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " />
    <style>

        .em_defaultlink a {
            color: inherit !important;
            text-decoration: none !important;
        }
        .em-pt-25{
            padding-top: 25px;
        }
        .em-pt-15{
            padding-top: 25px;
        }
        .pb{
            padding-bottom:10px;
        }
        .row{
            display: flex;
        }
        .col-left, .col-right{
            float: left;
        }
        .table{
            width: 100%;
        }

        table tr:last-child td{
            padding: 10px;
        }
        .em_logo{
            width: 20%;
        }
        .text-red{
            color: red ;
        }
        .text-blue{
            color: blue ;
        }
        td .em_content{
            height: 100vh - 260px;
        }
        @media (min-width: 1366px) {
            .em_logo{
                width: 5%;
            }
        }
        .text-center{
            text-align:center;
        }
        .btn{
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,
                background-color .15s ease-in-out,
                border-color .15s ease-in-out,
                box-shadow .15s ease-in-out;
        }
        .btn-primary{
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .m-2{
            margin: 10px;
        }
    </style>
</head>
<body style="margin:0px; padding:0px;">         

        <table class="table" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                <tr>
                    <td valign="top" class="em_content">
                        <p class="text-center"><strong>Reset Password</strong></p>
                        <p class="text-center em-pt-25">
                            <a href="{{@$url}}" target="_blank" class="btn btn-primary">Click!</a>
                        </p>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                        <td style="font-family:'Open Sans', Arial, sans-serif; font-size:11px; line-height:18px; color:#000000; background: #dedede; width:100%;">
                            <div style="margin: 10px;">
                                <img src="{{url('/img/at-once-black.png')}}" class="em_logo pb">
                                <br>
                                Telephone : <a href="tel:+662-007-5671" class="em_link">+66(0)2-007-5671</a><br>
                                Mobile : <a href="tel:+6699-341-8236" class="em_link">+66(0)99-341-8236</a><br>
                                Email : <a href="mailto:admin@at-once.info" class="em_link">admin@at-once.info</a><br>
                                Website : <a href="https://www.at-once.info/th"  class="em_link"> www.at-once.info/th</a><br>
                                Facebook : <a href="https://www.facebook.com/AtOnce.info"  class="em_link"> facebook/AtOnce.info</a><br><br>
                
                                ©{{date('Y')}} 1-CE Wind Co., Ltd.
                            </div>
                        </td>
                  
                </tr>
            </tfoot>
        </table>
    
    </body>
</html>