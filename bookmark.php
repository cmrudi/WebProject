<?php include 'header.php';
	get_header();

	$userId = $_GET["id"];
	$imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";
	$webInfoURL = "http://$_SERVER[HTTP_HOST]/Piknix/web-info.php?loc=";

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "SELECT id,title,image_file_big FROM destination WHERE destination.id IN (SELECT location_id FROM bookmark WHERE user_id = '$userId')";
	$result = mysqli_query($conn,$query);


?>
<div class="row">
  <div class="col-sm-7">
    <div id="map"></div>
    <div id="capture"></div>
  </div>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>
  <div class="col-sm-5">
    <div class="picnix-container">
		<div id="search" class="center-text">Bookmarks</div>
		<div class="row">
		<?php 
		while($row = $result->fetch_assoc()):	?>
				<div id="content-bookmark" class="center-text" style="background-image: url(<?php echo $imageURL.$row["image_file_big"]; ?>)">
					<div id="inner-bookmark"><?php echo $row["title"]; ?></div>
				</div>
		<?php endwhile; ?>
		</div>
    </div>
  </div>
</div>

</body>
</html>
