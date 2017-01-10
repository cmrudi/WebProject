<?php
	$userId = $_GET["id"];
	$locationId = $_GET["loc"];
	$tripId = $_GET["tripId"];

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "SELECT * FROM trip_joined WHERE user_id = '$userId' AND location_id = '$locationId'";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0) {
		echo "you have joined trip in this destination";
	}
	else {
		$query = "INSERT INTO trip_joined (user_id, location_id,trip_id) VALUES ('$userId','$locationId','$tripId')";
		if (mysqli_query($conn,$query)) {
			header("Location: /Piknix/chatroom.php?id=".$userId."&loc=".$locationId);
		}
		else {
			echo  "Failed to add trip";
		}
	}



?>