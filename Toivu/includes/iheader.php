<?php
    include_once("config/chttps.php");
    include_once("config/cconfig.php");
    include_once("includes/iunreadMessages.php");
?>

<!DOCTYPE html>
<html lang="fi-FI">
    <head>
        <!-- METATIEDOT -->
        <meta charset="utf-8"/>
        <meta name="description" content="HRV-analysis web-application">
        <meta name="author" content="Aapo Kokko, Roni Heininen, Aku Korhonen and Jaakko Buchelnikov">
        <title>Toivu - Alpha 0.8</title>

        <!-- MOBIILIMETA -->
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <!-- FONTTI -->
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

        <!-- CSS -->
        <!-- Skeleton template -->
        <link rel="stylesheet" href="css/normalize.css"/>
        <link rel="stylesheet" href="css/skeleton.css"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- FullCalendar styles -->
        <link href='fullcalendar/lib/main.min.css' rel='stylesheet' />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Toivu styles -->
        <link rel="stylesheet" href="css/main.css"/>

        <!-- SCRIPTS -->
        <!-- Toivu scripts -->
        <script src="js/form_validation.js"></script>
        <script src="js/formAlert.js"></script>
        <!-- FullCalendar scripts -->
        <script src='fullcalendar/lib/main.min.js'></script>
        <script src='fullcalendar/lib/locales/fi.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <!-- amGraph scripts -->
        <script src="amcharts4/core.js"></script>
        <script src="amcharts4/charts.js"></script>
        <script src="amcharts4/animated.js"></script>
        <script src="amcharts4/fi_FI.js"></script>
        <script src="js/ToivuTheme.js"></script>

</head>
<body>