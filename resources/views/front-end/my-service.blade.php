<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>At Once</title>
</head>
<body>
    
</body>
</html>
<script>
    checkCookie();
    function setCookie(cname, cvalue) 
    {
        // 400 days
        const exdays = 3600 * 1000 * 24 * 400;
        const d = new Date();
        d.setTime(d.getTime() + exdays);
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) 
    {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function checkCookie() 
    {
        setCookie("at_once_visitor", 'cid-{{$cid}}');
        r = '{{$redirect}}';
        if(r!='') window.location.replace(r);

    }

</script>