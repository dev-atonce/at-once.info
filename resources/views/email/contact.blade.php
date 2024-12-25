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
        table tr:last-child{
            background: #dedede;
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
    </style>
</head>
<body style="margin:0px; padding:0px;">         

        <table class="table" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                <tr>
                    <td valign="top" class="em_content">
                        <p><strong>@lang('phrase.delivered.title-s1')</strong></p>
                        <p>{!!@$content!!}</p>
                    
                        <p class="em-pt-25"><strong>@lang('phrase.delivered.title-s2')</strong></p>
                        <p>
                            <strong>@lang('phrase.delivered.name') :</strong> {{@$name}}<br>
                            <strong>@lang('phrase.delivered.company') :</strong> {{@$company}}<br>
                            <strong>@lang('phrase.delivered.telephone') :</strong> {{@$telephone}}<br>
                            <strong>@lang('phrase.delivered.department') :</strong> @if(@$department=='') @else{{@$department}}@endif<br>
                            <strong>@lang('phrase.delivered.email') :</strong> {{@$email}}<br>
                            <strong>@lang('phrase.delivered.details') :</strong> {{@$detail}}
                        </p>

                        <p class="em-pt-25">
                            <strong>@lang('phrase.delivered.title-s3') {{@$email}}</strong><br>
                            @lang('phrase.delivered.email-from') <a href="https://www.at-once.info/th" >www.at-once.info</a></strong>
                            
                        </p>
                        <p class="text-blue">@lang('phrase.delivered.ads-phrase') <br><br>@lang('phrase.delivered.ads') <a href="https://www.at-once.info/th/promotion-package" class="text-red"><strong>@lang('phrase.delivered.click')!</strong></a></p>
                    </td>
                </tr>
                <tr>
                    <td style="font-family:'Open Sans', Arial, sans-serif; font-size:11px; line-height:18px; color:#000000;" valign="top">
                        <div class="">
                            <div>
                                <img src="{{url('/img/at-once-black.png')}}" class="em_logo pb">
                                <br>
                                Telephone : <a href="tel:+662126-6642" class="em_link">+66(0)2126-6624</a><br>
                                Mobile : <a href="tel:+6698-978-9029" class="em_link">+66(0)98-978-9029</a><br>
                                Email : <a href="mailto:admin@at-once.info" class="em_link">marketing@at-once.info</a><br>
                                Website : <a href="https://www.at-once.info/th"  class="em_link"> www.at-once.info/th</a><br>
                                Facebook : <a href="https://www.facebook.com/AtOnce.info"  class="em_link"> facebook/AtOnce.info</a><br><br>

                                ©{{date('Y')}} 1-CE WIND CO., LTD.
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
  
    
    </body>
</html>