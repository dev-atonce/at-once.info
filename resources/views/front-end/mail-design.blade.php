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
                        <p><strong>เรียนผู้เกี่ยวข้อง</strong></p>
                        {{-- <p>{!!@$content!!}</p> --}}
                        <p>
                        สอบถามมีเส้นทางการส่งสินค้าไปประเทศคูเวต
                        บาร์เรน
                        โอมาน
                        กาตาร์
                        ซาอุดิอาระเบีย
                        สหรัฐอาหรับเอมิเรตส์ หรือเปล่าคะ
                        -มีขั้นตอนการเตรียมสินค้าที้จะส่งออกอย่างไร
                        -ระยะเวลาในการขนส่งกี่วัน
                        -การคิดราคาขนส่งผลิตภัณฑ์ แฮร์โทนิคหรืออาหารเสริมคิดอย่างไร

                        ขอบคุณค่ะ
                    </p>
                    
                        <p class="em-pt-25"><strong>กรุณาติดต่อกลับตามข้อมูลด้านล่าง</strong></p>
                        <p>
                            <strong>ชื่อลูกค้า :</strong> สมฤดี{{@$name}}<br>
                            <strong>ชื่อบริษัท :</strong> บจ.บาลานซ์ แบรนด์{{@$company}}<br>
                            <strong>หมายเลขโทรศัพท์ :</strong> 0846972785{{@$telephone}}<br>
                            <strong>แผนกผู้ติดต่อ :</strong> การเงิน@if(@$department=='') @else{{@$department}}@endif<br>
                            <strong>อีเมลตอบกลับ :</strong> somreudee1206@gmail.com{{@$email}}
                        </p>

                        <p class="em-pt-25">
                            <strong>* กรุณาตอบกลับที่อยู่อีเมลลูกค้า {{@$email}}</strong><br>
                            อีเมลนี้ถูกส่งจากเว็บไซต์ <a href="https://www.at-once.info/th" >www.at-once.info</a></strong>
                            
                        </p>
                        <p class="text-blue">เราขอเสนอช่องทางที่จะช่วยให้คุณได้มีลูกค้าใหม่ เพิ่มขึ้นโดยที่ไม่ต้องออกไปขาย เพราะลูกค้าจะมาหาคุณเอง เพียงแค่ใช้บริการของเรา ในราคาที่ประหยัดและคุ้มค่า <br><br>สนใจลงโฆษณาโปรโมทบริษัท <a href="https://www.at-once.info/th/promotion-package" class="text-red"><strong>คลิก!</strong></a></p>
                    </td>
                </tr>
                <tr>
                    <td style="font-family:'Open Sans', Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;" valign="top">
                        <div class="">
                            <div>
                                <img src="{{url('/img/at-once-black.png')}}" class="em_logo pb">
                                <br>
                                Telephone : <a href="tel:+662-126-6624-25" class="em_link">+66(0)2-126-6624-25</a><br>
                                Mobile : <a href="tel:+6699-341-8236" class="em_link">+66(0)99-341-8236</a><br>
                                Email : <a href="mailto:Marketing@at-once.info" class="em_link">Marketing@at-once.info</a><br>
                                Website : <a href="https://www.at-once.info/th"  class="em_link"> www.at-once.info/th</a><br>
                                Facebook : <a href="https://www.facebook.com/AtOnce.info"  class="em_link"> facebook/AtOnce.info</a><br><br>

                                ©{{date('Y')}} 1-CE Wind Co., Ltd.
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>