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

    <!-- Scripts -->
    <script src='fullcalendar/lib/main.js'></script>
    <script src='fullcalendar/lib/locales/fi.js'></script>
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

          headerToolbar: {
            left: 'dayGridMonth,timeGridWeek,timeGridDay',
            center: 'title',
            right: 'addEventButton today prev,next'
          },

          customButtons: {
            addEventButton: {
              text: 'Lisää tapahtuma',
              click: function() {
                var dateStr = prompt('Lisää päivä YYYY-MM-DD formaatissa');
                var date = new Date(dateStr + 'T00:00:00'); // will be in local time

                if (!isNaN(date.valueOf())) { // valid?
                  calendar.addEvent({
                    title: 'dynamic event',
                    start: date,
                    allDay: true
                  });
                  alert('Great. Now, update your database...');
                } else {
                  alert('Päivä väärässä muodossa.');
                }
              }
            }
          }

        });
        calendar.render();
      });
    </script>

    <!-- Sovelluksen logo -->
    <!-- <link rel="icon" type="image/png" href="images/"> -->
    </head>
    <body>