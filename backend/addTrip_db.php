<?php 
	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 	$userId = test_input($_POST["userId"]);
	 	$locationId = test_input($_POST["locationId"]);
	 	$startDate = test_input($_POST["startDate"]);
	 	$endDate = test_input($_POST["endDate"]);
	 	$quota = test_input($_POST["quota"]);
	 	$gender = test_input($_POST["gender"]);
	 	$tripDescription = test_input($_POST["tripDescription"]);
	 	$createdTime = (new DateTime())->getTimestamp();

	 	$dbservername="localhost";
		$dbusername="piknix";
		$dbpassword="piknix";
		$database="piknix_db";

		$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

		if (mysqli_connect_errno()) {
			exit();
		}

		$query =  "INSERT INTO trip (destination_id,start_date,end_date,quota,gender,description,user_id,created_time) VALUES ('$locationId','$startDate','$endDate','$quota','$gender','$tripDescription','$userId','$createdTime')";
		if($result = mysqli_query($conn,$query)){
			header("Location: /Piknix/chatroom.php?id=".$userId."&loc=".$locationId);
		}
		else {
			echo "Failed to add trip<br>";
			echo $startDate."<br>";
			echo $gender;
		}

		mysqli_close($conn);
	 }

	 function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}


?>