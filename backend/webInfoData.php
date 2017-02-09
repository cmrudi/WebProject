<?php
	$locationId = $_GET["loc"];
	$next = $_GET["next"];

	if ($next == 1) {
		$locationId++;
	}
	else {
		$locationId--;
	}

	$dbservername="localhost";
    $dbusername="piknix";
    $dbpassword="piknix";
    $database="piknix_db";

    $conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

    if (mysqli_connect_errno()) {
      exit();
    }

    $query = "SELECT title, location, image_file_big, description FROM destination WHERE id = '$locationId'";
    $result = mysqli_query($conn,$query);
    $row = $result->fetch_assoc();

   	$response = $row["title"]."#".$row["location"]."#".$row["image_file_big"]."#".$row["description"];
   	echo $response;

?>