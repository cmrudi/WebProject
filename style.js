function loadSignupForm() {
	$.ajax({
     type: "GET",
     url: 'signup.php',
     data: "id=true",
     success: function(data) {
          $('#signup-login-form').html(text);
          $('#login-button').html("new test");
     }

   });
}

function loadLoginForm() {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        	document.getElementById("login-button).innerHTML").innerHTML = "Liked";
        }
    }
    xmlhttp.open("GET", "login?id=true", true);
    xmlhttp.send();
}
