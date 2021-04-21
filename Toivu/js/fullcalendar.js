document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'fi',
        initialView: 'dayGridMonth',
        editable: true,
        selectable: true,
        nowIndicator: true,
        lazyFetching: false,
        eventSources: [
            {
                url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/igetEvent.php',
                display: 'auto',
                backgroundColor: '#D8A48F',
                borderColor: '#BB8588',
                textColor: 'black'
            }
        ],

        headerToolbar: {
            left: 'today',
            center: 'title',
            right: 'prev,next'
        },

        displayEventTime: false,

        select: function(arg) {
            var title = prompt("Kirjoita lyhyesti merkittävistä hyvinvointiisi vaikuttaneista tapahtumista, positiivista ja negatiivistista.");
            if (confirm("Haluatko merkitä olotilasi?")) {
                var mood = prompt("Arvioi vointisi antamalla numeroarvo 1-5:\n1->karmea,\n2->huono,\n3->OK,\n4->hyvä\n5->loistava.");
            }
            var start = FullCalendar.formatDate(arg.start, {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                meridiem: false
            });
            var end = FullCalendar.formatDate(arg.end, {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                meridiem: false
            });
            if (title) {
                if (mood) {
                    $.ajax({
                        type: 'POST',
                        url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/iaddEvent.php',
                        data: {
                            title: title + ' Olotila: ' + mood,
                            mood: mood,
                            start: start,
                            end: end,
                            allday: true
                        },
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(xhr, status, error){
                            console.error(xhr);
                        }
                    });
                }
                else {
                    $.ajax({
                        type: 'POST',
                        url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/iaddEvent.php',
                        data: {
                            title: title,
                            mood: mood,
                            start: start,
                            end: end,
                            allday: true
                        },
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(xhr, status, error){
                            console.error(xhr);
                        }
                    });
                }
            }
            calendar.unselect()
            calendar.refetchEvents()
        },

        editable: true,
        eventDrop: function(info) {
            var start = FullCalendar.formatDate(info.event.start, {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                meridiem: false
            });
            var end = FullCalendar.formatDate(info.event.end, {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                meridiem: false
            });
            $.ajax({
                type: 'POST',
                url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/iupdateEvent.php',
                data: {
                    id: info.event.id,
                    start: start,
                    end: end
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(xhr, status, error){
                    console.error(xhr);
                }
            });
            calendar.unselect()
            calendar.refetchEvents()
        },

        eventClick: function(info) {
            if (confirm("Haluatko varmasti poistaa tapahtuman?")) {
                var id = info.event.id;
                $.ajax({
                    type: 'POST',
                    url: 'https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/ideleteEvent.php',
                    data: {id: id},
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(xhr, status, error){
                        console.error(xhr);
                    }
                });
            }
            calendar.unselect()
            calendar.refetchEvents()
        }
    });
    calendar.render();
});