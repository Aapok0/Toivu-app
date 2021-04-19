<?php
    include_once("config/chttps.php");
    include_once("config/cconfig.php");
?>

<!DOCTYPE html>
<html lang="fi-FI">
    <head>
        <!-- Perus metatiedot -->
        <meta charset="utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Toivu - Prototyyppi 0.1</title>

        <!-- Mobiilimeta -->
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <!-- Fontti -->
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css"/>
        <link rel="stylesheet" href="css/skeleton.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='fullcalendar/lib/main.css' rel='stylesheet' />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="css/main.css"/>

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- FullCalendar scripts -->
        <script src='fullcalendar/lib/main.js'></script>
        <script src='fullcalendar/lib/locales/fi.js'></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'fi',
                    initialView: 'dayGridMonth',
                    editable: true,
                    selectable: true,
                    nowIndicator: true,
                    eventSources: [
                        {
                            url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/igetEvent.php',
                            display: 'auto',
                            backgroundColor: '#D8A48F',
                            borderColor: '#BB8588',
                            textColor: 'black'
                        },
                        {
                            id: '1',
                            method: 'POST',
                            url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/iaddEvent.php'
                        },
                        {
                            id: '2',
                            method: 'POST',
                            url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/iupdateEvent.php'
                        },
                        {
                            id: '3',
                            method: 'POST',
                            url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/ideleteEvent.php'
                        }
                    ],

                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title',
                        right: 'today prev,next'
                    },

                    select: function(arg) {
                        var title = prompt("Kirjoita lyhyesti merkittävistä hyvinvointiisi vaikuttaneista tapahtumista, positiivista ja negatiivistista.");
                        var mood = prompt("Arvioi vointisi antamalla numeroarvo 1-5:\n1->karmea,\n2->huono,\n3->OK,\n4->hyvä\n5->loistava.");
                        if (title) {
                            calendar.addEvent({
                                title: title,
                                mood: mood,
                                start: arg.start,
                                end: arg.end,
                                display: 'auto',
                                backgroundColor: '#D8A48F',
                                borderColor: '#BB8588',
                                textColor: 'black'
                            }, '1')
                        calendar.refetchEvents()
                        }
                        calendar.unselect()
                    },

                    eventResize: function(info) {
                        var start = event.moveStart(info.startDelta)
                        var end = event.moveEnd(info.endDelta)
                        calendar.addEvent({
                            start: start,
                            end: end
                        }, '2')
                        calendar.refetchEvents()
                    },

                    eventDrop: function(info) {
                        var ? = event.moveDates(info.delta)
                        calendar.addEvent({
                            start: start,
                            end: end
                        }, '2')
                        calendar.refetchEvents()
                    },

                    eventClick: function(info) {
                        if (confirm("Haluatko varmasti poistaa tapahtuman?")) {
                            var id = info.event.id;
                            event.remove(info.event)
                            calendar.addEvent({
                                id: id
                            }, '3')
                            calendar.refetchEvents()
                        }
                    }
                });
                calendar.render();
            });
        </script>

        <!-- Registration datepicker -->
        <script>
            $( function() {
                $( "#datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy/mm/dd",
                    yearRange: "-100:+0",
                });
            });
        </script>

        <!-- amGraph scripts -->
        <!-- Resources -->
        <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
        <script src="js/ToivuTheme.js"></script>

</head>
<body>