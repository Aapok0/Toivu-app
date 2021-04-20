function openMessage($title, $message) {
    document.getElementById("messTitle").innerHTML = $title;
    document.getElementById("messText").innerHTML = $message;
}

//Haetaan modaali
var modal = document.getElementById("message");

//Haetaan modaalin avaava nappi
//var btn = document.getElementById("openMessage");
var btns = document.querySelectorAll('.openMessage');

//Haetaan <span> -elementti, joka sulkee modaalin
var span = document.getElementsByClassName("close")[0];

//Kun käyttäjä painaa nappia, modaali-ikkuna aukeaa sivulla
[].forEach.call(btns, function(el) {
    el.onclick = function() {
        modal.style.display = "block";
    }
})

//Kun käyttäjä painaa <span> (x), modaali-ikkuna sulkeutuu
span.onclick = function() {
    modal.style.display = "none";
}

//Kun käyttäjä painaa modaali-ikkunan ulkopuolelta, ikkuna sulkeutuu
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}