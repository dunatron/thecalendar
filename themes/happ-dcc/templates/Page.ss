<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <title>Happ | $SiteConfig.Title</title>

    <%-- Favicons --%>
    <link rel="shortcut icon" href="$ThemeDir/favicons/favicon.ico"/>

    <link rel="apple-touch-icon" sizes="180x180" href="$ThemeDir/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="$ThemeDir/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="$ThemeDir/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="$ThemeDir/favicons/manifest.json">
    <link rel="mask-icon" href="$ThemeDir/favicons/safari-pinned-tab.svg" color="#FC6636">
    <meta name="theme-color" content="#ffffff">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="$ThemeDir/css/wicked-time-picker.min.css">

    <%-- TODO NEW NEW https://www.youtube.com/watch?v=5w3fqtIPM8A | HIDDEN SCROLLBAR--%>
    <style>
        .pac-container {
            z-index: 99999;
        }
    </style>
</head>

<body class="$ClassName.LowerCase">
    $Message
    $SessionMessage
<div class="ajax-page-load ajax-is-loading">
    <div class="ajax-loader"><div class="ajax-load-icon"><div class="ajax-load-message">Loading data...</div> </div> </div>
</div>


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

</body>

</html>