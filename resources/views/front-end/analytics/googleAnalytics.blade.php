<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PLZ5N3RPSC"></script>
<!-- Google AdSense Script -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8033466435262098"
 crossorigin="anonymous"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-PLZ5N3RPSC');
</script>

<!-- Google Tag Manager -->
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5FDVRDL');
</script>
<!-- End Google Tag Manager -->


<!-- Hotjar Tracking Code for https://www.at-once.info/th -->
<script>
    (function(h, o, t, j, a, r) {
        h.hj = h.hj || function() {
            (h.hj.q = h.hj.q || []).push(arguments)
        };
        h._hjSettings = {
            hjid: 3645756,
            hjsv: 6
        };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script');
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
</script>

@php
    $segments = request()->segments();
    $currentLang = @$segments[0];
    
    if(in_array($currentLang, ['th', 'en', 'jp', 'zh'])) {
        $pathWithoutLang = implode('/', array_slice($segments, 1));
    } else {
        $pathWithoutLang = implode('/', $segments);
    }
@endphp

<link rel="alternate" hreflang="th"        href="{{ url('th/' . $pathWithoutLang) }}" />
<link rel="alternate" hreflang="ja"        href="{{ url('jp/' . $pathWithoutLang) }}" />
<link rel="alternate" hreflang="en"        href="{{ url('en/' . $pathWithoutLang) }}" />
<link rel="alternate" hreflang="zh"        href="{{ url('zh/' . $pathWithoutLang) }}" />
<link rel="alternate" hreflang="x-default" href="{{ url('th/' . $pathWithoutLang) }}" />

<link rel="canonical" href="{{ url('th/' . $pathWithoutLang) }}" />
