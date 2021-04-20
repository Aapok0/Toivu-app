function removeMessage() {
    var remove = confirm("Haluatko varmasti poistaa viestin pysyvästi?");
    if (remove == true) {
        window.location.href = "includes/iremoveMessage.php"
    }
    else {
        window.location.href = "notifications.php";
    }
}