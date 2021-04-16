<?php
include_once("config/chttps.php");
include_once("config/cconfig.php");
session_start();
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
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='fullcalendar/lib/main.css' rel='stylesheet' />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

        <!-- Scripts -->
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
                    selectHelper: true,
                    eventLimit: true,
                    nowIndicator: true,
                    events: 'getEvent.php',

                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title',
                        right: 'today prev,next'
                    },

                    select: function(start, end, allday) {
                        var title = prompt("Kirjoita lyhyesti merkittävistä hyvinvointiisi vaikuttaneista tapahtumista, positiivista ja negatiivistista.");
                        var mood = prompt("Arvioi vointisi antamalla numeroarvo 1-5: 1->karmea, 2->huono, 3->OK, 4->hyvä ja 5->loistava.");
                        if (title) {
                            var start = $fullcalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            $.ajax({
                                url: "addEvent.php",
                                type: "POST",
                                data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    extendedProps: {
                                        mood: mood
                                    }
                                },
                                success: function() {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Tapahtuma lisätty onnistuneesti!");
                                }
                            })
                        }
                    },

                    editable: true,

                    eventResize: function(event) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url: "updateEvent.php",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                id: id,
                                extendedProps: {
                                    mood: mood
                                }
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert('Tapahtuma päivitetty!');
                            }
                        })
                    },

                    eventDrop: function(event) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                            url: "updateEvent.php",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                id: id,
                                extendedProps: {
                                    mood: mood
                                }
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert('Tapahtuma päivitetty!');
                            }
                        })
                    },

                    eventClick: function(event) {
                        if (confirm("Haluatko varmasti poistaa tapahtuman?")) {
                            var id = event.id;
                            $.ajax({
                                url: "deleteEvent.php",
                                type: "POST",
                                data: {
                                    id: id
                                },
                                success: function() {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Tapahtuma poistettu!");
                                }
                            })
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
        <!-- Graphs -->
        <script src="js/graph1.js"></script>
        <script src="js/graph2.js"></script>

</head>
<body>