<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <!-- Bootstrap stuff -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <%-- Google Maps Dependencies --%>
    <script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyBWVd4651hNv8mOn-RaHZdC166O82S-BbY&sensor=false&libraries=places'></script>
    <script src="$ThemeDir/js/locationpicker/locationpicker.jquery.min.js"></script>
    <%-- SELECT 2 --%>
    <script src="$ThemeDir/js/select2/select2.full.min.js"></script>

    <title>Happ | $SiteConfig.Title</title>


    <%-- Favicons --%>
    <link rel="shortcut icon" href="$ThemeDir/favicons/favicon.ico" />

    <link rel="apple-touch-icon" sizes="180x180" href="$ThemeDir/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="$ThemeDir/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="$ThemeDir/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="$ThemeDir/favicons/manifest.json">
    <link rel="mask-icon" href="$ThemeDir/favicons/safari-pinned-tab.svg" color="#FC6636">
    <meta name="theme-color" content="#ffffff">



    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <%-- TODO NEW NEW https://www.youtube.com/watch?v=5w3fqtIPM8A | HIDDEN SCROLLBAR--%>
    <style>
        .pac-container {
            z-index: 99999;
        }
    </style>
</head>

<body class="$ClassName.LowerCase">

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

    <% include AddHappEventModal %>
    <% include FilterModal %>
    <%--<% include FilterModal %>--%>

<!-- JAVASCRIPT -->
    <%--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>--%>
<%--<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/bootstrap.min.js"></script>--%>


    <%--NAVIGATION JS--%>
<script type="text/javascript" src="$ThemeDir/js/navigation.js"></script>

    <%-- Happ-Time-Picker --%>
<%--<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery-2.1.1.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery-ui.min.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jquery.mousewheel.min.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/doc.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jtsage-datebox-4.0.0.bootstrap.min.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/happ-timepicker/jtsage-datebox.lang.utf8.js"></script>--%>

    <%--  Scroll squares and hide scrollbar  --%>
<%--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>--%>
<%--<script type="text/javascript" src="$ThemeDir/js/hide-scrollbar.js"></script>--%>
    <%-- Resize the Forms--%>
<%--<script type="text/javascript" src="$ThemeDir/js/formdimensions.js"></script>--%>
<%-- Custom Google maps location picker | auto-fill | locationpicker plugin --%>
<script src="$ThemeDir/js/locationpicker/location-picker-autofill.js"></script>
<script src="$ThemeDir/js/approved/approved-event.js"></script>
<script src="$ThemeDir/js/select2/custom-select2.js"></script>
<script src="$ThemeDir/js/modals/filtermodal.js"></script>
<script>

</script>

</body>

</html>