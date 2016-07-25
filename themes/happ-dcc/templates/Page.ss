<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <% base_tag %>
    <title></title>
    $MetaTags(false)
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ee3e8b">
    <link rel="stylesheet" href="$ThemeDir/css/base-styles.css">
    <%--<link rel="stylesheet" href="$ThemeDir/css/style.css">--%>

    <%-- Copy Paste from old version, tidy--%>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="$ThemeDir/css/bootstrap.css" />
    <%--<link rel="shortcut icon" href="../favicon.ico">--%>

    <link rel="icon" type="image/png" href="PNG_File_Full_URL_Here">
    <!-- Calendar CSS -->
    <link rel="stylesheet" type="text/css" href="$ThemeDir/css/calendar.css" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">



    <!-- Google Analytics -->
    <script>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-67822693-6']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- End Google Analytics -->


    <%--end old copy paste--%>

    <style>

        #map {
            height: 600px;
        }
    </style>



</head>
<body class="$ClassName.LowerCase">
<!--[if lt IE 10]>

<div class="chromeframe">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning text-center">
                You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">
                upgrade your browser</a>
                to improve your experience.
            </div>
        </div>
    </div>
</div>
<![endif]-->
<div class="container-fluid" id="site-wrapper">
    <div class="$ClassName.LowerCase-menu-buffer"></div>
    <%-- above class is to compensate for the menu overlaying the content --%>
    <div class="site-content-wrapper">
        <%--$Layout--%>
        <%-- PUTTING THE MAPS HERE THE AUTO COMPLETE WORKS | removing $Layout --%>
        <input id="pac-input" class="controls" type="text"
               placeholder="Enter a location">
        <div id="type-selector" class="controls">
            <input type="radio" name="type" id="changetype-all" checked="checked">
            <label for="changetype-all">All</label>

            <input type="radio" name="type" id="changetype-establishment">
            <label for="changetype-establishment">Establishments</label>

            <input type="radio" name="type" id="changetype-address">
            <label for="changetype-address">Addresses</label>

            <input type="radio" name="type" id="changetype-geocode">
            <label for="changetype-geocode">Geocodes</label>
        </div>
        <div id="map"></div>

        <input id="address" type="text" size="90" autocomplete="off">
        <%-- PUTTING THE MAPS HERE THE AUTO COMPLETE WORKS --%>
        <% if $Form %>
            <div style="height: 100px;"></div>
            $Form
        <% end_if %>
    </div>
</div>

<!-- JAVASCRIPT -->
<%--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>--%>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/bootstrap.min.js"></script>


<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        height: 500px;
    }
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
</style>

<%--NAVIGATION JS--%>
<script type="text/javascript" src="$ThemeDir/js/navigation.js"></script>

<script type="text/javascript" src="$ThemeDir/js/google-maps.js"></script>

<%--  Google Maps  --%>
<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWVd4651hNv8mOn-RaHZdC166O82S-BbY&libraries=places&callback=initMap"
        async defer></script>

<%-- Happ-Time-Picker --%>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery-2.1.1.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery-ui.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/doc.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jtsage-datebox-4.0.0.bootstrap.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jtsage-datebox.lang.utf8.js"></script>

<%--  Scroll squares and hide scrollbar  --%>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/hide-scrollbar.js"></script>
<%-- Resize the Forms--%>
<script type="text/javascript" src="$ThemeDir/js/formdimensions.js"></script>


</body>
</html>