function removeMessage(id) {
    var remove = confirm("Haluatko varmasti poistaa viestin pysyvästi?");
    if (remove == true) {
        $.ajax({
            url: "https://users.metropolia.fi/~aapokok/WSK12021/Toivu/includes/iremoveMessage.php",
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, error){
                console.error(xhr);
            }
        });

        //window.location.href = "includes/iremoveMessage.php";
    }
    else {
        window.location.href = "notifications.php";
    }
}