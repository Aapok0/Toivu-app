function removeMessage($id) {
    var remove = confirm("Haluatko varmasti poistaa viestin pysyvästi?");
    if (remove == true) {
        createCookie("removeID", $id, "1");
        window.location.href = "includes/iremoveMessage.php";
    }
    else {
        window.location.href = "notifications.php";
    }
}

//Tehdään viestin ID:lle cookie, jota voidaan kutsua php:ssä viestin poistamiseksi
function createCookie(name, value, minutes) {
    var expires;
      
    if (minutes) {
        var date = new Date();
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}