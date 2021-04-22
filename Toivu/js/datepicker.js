$( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd",
        yearRange: "-100:+0",
    });
});