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

    <!-- Custom CSS (small tweaks) -->
    <link rel="stylesheet" type="text/css" href="$ThemeDir/css/style.css" />

    <link rel="stylesheet" type="text/css" href="$ThemeDir/css/custom_2.css" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <%-- DatePicker Style Dependencies --%>
    <%--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css" />--%>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.css">





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
        $Layout
        <% if $Form %>
            <div style="height: 100px;"></div>
            $Form
        <% end_if %>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>



<%--<script type="text/javascript" src="$ThemeDir/js/jquery.calendario.js"></script>--%>
<script type="text/javascript" src="$ThemeDir/js/bootstrap.min.js"></script>

<%-- DATEPICKER JS DEPENDENCIES | NEED BOTH FILES--%>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/datepicker.js"></script>

<%--NAVIGATION JS--%>
<script type="text/javascript" src="$ThemeDir/js/navigation.js"></script>

<!-- GENERATE CALENDAR
 ---------------------------------
 -->
<%--<script type="text/javascript" src="$ThemeDir/js/calendar.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/jasney-bootstrap.js"></script>--%>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<%-- Happ-Time-Picker --%>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery-2.1.1.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery-ui.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/doc.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jtsage-datebox-4.0.0.bootstrap.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jtsage-datebox.lang.utf8.js"></script>





<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/hide-scrollbar.js"></script>
<script type="text/javascript" src="$ThemeDir/js/formdimensions.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="$ThemeDir/js/trons-timepicker-interface.js"></script>

<script type="text/javascript" src="$ThemeDir/js/datepicker.js"></script>

</body>
</html>