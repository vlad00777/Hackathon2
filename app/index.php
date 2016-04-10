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

<div class="bg">
  <div class="absolute">
  <p class="title">Select your city and road time</p>
   <form action="list.php" method="get" class="inputs">
       <select name="city" id="city">
           <option value="Lublin">Lublin</option>
       </select>
       <select name="time" id="time">
           <option value="01:00:00">1 Hour</option>
           <option value="01:30:00">1.5 Hour</option>
           <option value="02:00:00">2 Hour</option>
           <option value="02:30:00">2.5 Hour</option>
           <option value="03:00:00">3 Hour</option>
           <option value="03:30:00">3.5 Hour</option>
           <option value="04:00:00">4 Hour</option>
           <option value="04:30:00">4.5 Hour</option>
           <option value="05:00:00">5 Hour</option>
           <option value="06:00:00">6 Hour</option>
           <option value="07:00:00">7 Hour</option>
           <option value="08:00:00">8 Hour</option>
           <option value="09:00:00">9 Hour</option>
           <option value="10:00:00">10 Hour</option>
           <option value="11:00:00">11 Hour</option>
           <option value="12:00:00">12 Hour</option>
           <option value="13:00:00">13 Hour</option>
           <option value="14:00:00">14 Hour</option>
           <option value="15:00:00">15 Hour</option>
           <option value="16:00:00">16 Hour</option>
           <option value="17:00:00">17 Hour</option>
           <option value="18:00:00">18 Hour</option>
           <option value="19:00:00">19 Hour</option>
           <option value="20:00:00">20 Hour</option>
           <option value="21:00:00">21 Hour</option>
           <option value="22:00:00">22 Hour</option>
           <option value="23:00:00">23 Hour</option>
       </select>
       <input type="submit" value="Search" id="sub">
       
   </form>
   <p class="or">OR</p>
    <form enctype="multipart/form-data" action="photos.php" method="Post" class="dropzone"></form>
    </div>
</div>



</body>

</html>
