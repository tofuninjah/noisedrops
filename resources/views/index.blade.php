<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Noisedrops</title>
    <meta name="author" content="Chung Kang">
    <meta name="description" content="Noisedrops generates ambient sounds that allow you to concentrate or focus by drowning out distracting noises.  May also be used for relaxation.">
    <meta name="keywords" content="ASMR, productivity, concentration, white noise, background noise, noise generator">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <script>
        // (adsbygoogle = window.adsbygoogle || []).push({
        //     google_ad_client: "ca-pub-7787055189723472",
        //     enable_page_level_ads: true
        // });
    </script>
</head>
<body class="backdrop" style="background: url(/images/hero/pastels-test.jpg) no-repeat center center fixed; background-size: cover; background-color: #E9EFD4;">
    <div id="app">
        <drop-header></drop-header>

        <transition name="fade" mode="out-in">
            <drops v-if="show"></drops>
            <drop :drop="drop" v-else></drop>
        </transition>

        <drop-footer></drop-footer>
    </div>

    <script src="/js/app.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-100788423-1', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>
