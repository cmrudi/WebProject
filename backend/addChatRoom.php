<?php 
	$locationId = $_GET["loc"];
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>SUCCESS</p>
	<input type="hidden" id="location" value=<?php echo $locationId; ?> >
</body>
</html>
<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
<script type="text/javascript">
	console.log("testtt");
	var locationId = document.getElementById("location").value;
	console.log(locationId);
	var config = {
        apiKey: "AIzaSyCz93oYzFZegc-gcXTELEaFWmwFO89cM0g",
        authDomain: "piknix-chat.firebaseapp.com",
        databaseURL: "https://piknix-chat.firebaseio.com",
        storageBucket: "piknix-chat.appspot.com",
        messagingSenderId: "599616184921"
    };
    firebase.initializeApp(config);
    const dbRef = firebase.database().ref().child("messages");
    //var newDbRef = dbRef.push();
    dbRef.child(locationId).set({
                    "-KZkQcLDZzlN98oAFgNB" : {
                        "name" : "admin",
                        "text" : "Hi Welcome to Piknix",
                        "time" : 1482576266
                      }});
</script>