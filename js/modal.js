var modal = document.getElementById('photo-modal');

// Get the button that opens the modal
var btn = document.getElementById("username");
var exit = document.getElementById("exit");

btn.onclick = function() {
    modal.style.display = "block";
}

exit.onclick = function() {
    modal.style.display = "none";
}



