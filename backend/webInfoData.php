<?php
	$locationId = $_GET["loc"];
	$next = $_GET["next"];


	$dbservername="localhost";
    $dbusername="piknix";
    $dbpassword="piknix";
    $database="piknix_db";

    $conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);

    if (mysqli_connect_errno()) {
      exit();
    }

    $query = "select min(id) as min,max(id) as max from destination";
    $result = mysqli_query($conn,$query);
    $row = $result->fetch_assoc();
    $min = $row["min"];
    $max = $row["max"];

    if (($next == 1)&&($locationId < $max)) {
		$locationId++;
	}
	else if (($next ==0)&&($locationId > $min)) {
		$locationId--;
	}

    $query = "SELECT title, location, image_file_big, description FROM destination WHERE id = '$locationId'";
    $result = mysqli_query($conn,$query);
    $row = $result->fetch_assoc();

   	$response = $row["title"]."#".$row["location"]."#".$row["image_file_big"]."#".$row["description"]."#".$locationId;
   	echo $response;

?>