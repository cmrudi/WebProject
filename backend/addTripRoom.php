<?php 
	$tripId = $_GET["trip"];
    $locationId = $_GET["loc"];
    $userId = $_GET["id"];
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>SUCCESS</p>
	<input type="hidden" id="tripId" value=<?php echo $tripId; ?> >
    <input type="hidden" id="userId" value=<?php echo $userId; ?> >
    <input type="hidden" id="locationId" value=<?php echo $locationId; ?> >
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
<script type="text/javascript">
    
    // put all your jQuery goodness in here.
    	var tripId = document.getElementById("tripId").value;
        var userId = document.getElementById("userId").value;
        var locationId = document.getElementById("locationId").value;
    	var config = {
            apiKey: "AIzaSyCz93oYzFZegc-gcXTELEaFWmwFO89cM0g",
            authDomain: "piknix-chat.firebaseapp.com",
            databaseURL: "https://piknix-chat.firebaseio.com",
            storageBucket: "piknix-chat.appspot.com",
            messagingSenderId: "599616184921"
        };
        firebase.initializeApp(config);
        const dbRef = firebase.database().ref().child("trip");
        //var newDbRef = dbRef.push();
        dbRef.child(tripId).set({
                        "-KZkQcLDZzlN98oAFgNB" : {
                            "name" : "admin",
                            "text" : "Hi Welcome to this Trip",
                            "time" : 1482576266
                          }});
</script>
<?php
    header("Location: /Piknix/chatroom.php?id=".$userId."&loc=".$locationId);
?>