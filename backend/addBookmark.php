<?php
	$get = $_REQUEST["id"];
	$test = explode(',',$get);
	$userId = $test[0];
	$locationId = $test[1];

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "SELECT * FROM bookmark WHERE user_id='$userId' AND location_id='$locationId'";
	$result = mysqli_query($conn,$query);

	if (mysqli_num_rows($result) == 0) {
		$query =  "INSERT INTO bookmark(user_id,location_id) VALUES ('$userId','$locationId')";
		mysqli_query($conn,$query);
	}
	else {
		$query =  "DELETE FROM bookmark WHERE location_id = '$locationId' AND user_id = '$userId'";
		mysqli_query($conn,$query);
	}

?>