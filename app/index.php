<!DOCTYPE html>
<html lang="en-USU" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Верстка</title>
    <meta name="description" lang="en-us" content="">
    <meta name="keywords" lang="en-us" content="">

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- <meta name="viewport" content="width=1000"> -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="target-densitydpi=device-dpi">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="apple-touch-icon" sizes="57x57" href="favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicons/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#344358">
    <meta name="msapplication-TileImage" content="favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <link rel="stylesheet" href="css/style.css">
    
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script>!function(t){function r(){var t=navigator.userAgent,r=!window.addEventListener||t.match(/(Android (2|3|4.0|4.1|4.2|4.3))|(Opera (Mini|Mobi))/)&&!t.match(/Chrome/);if(r)return!1;var e="test";try{return localStorage.setItem(e,e),localStorage.removeItem(e),!0}catch(o){return!1}}t.localSupport=r(),t.localWrite=function(t,r){try{localStorage.setItem(t,r)}catch(e){if(e==QUOTA_EXCEEDED_ERR)return!1}}}(window);
    </script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <script src="js/modernizr.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--build:js js/main.min.js -->
    <script src="js/exif.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/init.js"></script>
    <!-- endbuild -->
    
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    
</head>

<body>
<a href="/" class="logo"><img src="images/logo.png" alt="logo">
<span>Touristic road</span>
</a>

<video autoplay loop muted poster="polina.jpg" id="bgvid">
    <source src="video.webm" type="video/webm">
    <source src="video.mp4" type="video/mp4">
</video>

<div class="bg"></div>

<form enctype="multipart/form-data" action="photos.php" method="Post" class="dropzone"></form>

</body>

</html>
