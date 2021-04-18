function removeUser() {
    var remove = confirm("Haluatko varmasti poistaa tilisi? Kaikki tiedot poistuu pysyvästi.");
    if (remove == true) {
        window.location.href = "iremoveUser.php"
    }
    else {
        window.location.href = "userSettings.php";
    }
}