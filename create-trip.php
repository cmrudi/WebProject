<?php include 'header.php';
	get_header();

	$locationId = $_GET["loc"];
	$userId = $_GET["id"];
	$imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";
	$webInfoURL = "http://$_SERVER[HTTP_HOST]/Piknix/web-info.php?loc=";
	$targetUri = "http://$_SERVER[HTTP_HOST]/Piknix/backend/addTrip_db.php";

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "UPDATE user_auth SET last_destination_id = '$locationId' WHERE id = '$userId'";
	$result = mysqli_query($conn,$query);

	$query = "SELECT username FROM user_auth WHERE id = '$userId'";
	$result = mysqli_query($conn,$query);
	$row = $result->fetch_assoc();
	$username = $row["username"];

	$query = "SELECT * FROM bookmark WHERE user_id='$userId' AND location_id='$locationId'";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0 ) {
		$bookmarkClass = "bookmarked";
	}
	else {
		$bookmarkClass = "not-bookmarked";
	}


	
	$query = "SELECT id,title,location,image_file FROM destination WHERE id='$locationId'";
	if ($result = mysqli_query($conn,$query)) {
		$row = $result->fetch_assoc();

?>

<script type="text/javascript" src="js/chat.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<div class="row">
  <div class="col-sm-7">
    <div id="map"></div>
    <div id="capture"></div>
  </div>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>
  <div class="col-sm-5">
    <div class="picnix-container">
		<div id="content-search" class="center-text" style="background-image: url(<?php echo $imageURL.$row["image_file"]; ?>)">
			<div id="content-search-inside">
				<p><?php echo $row["title"]; ?><p>
				<p class="small-text"><?php echo $row["location"]; ?><p>
			</div>
			<div id="over-image-div">
				<button id="bookmarkButton" class="<?php echo "over-image-button ".$bookmarkClass; ?>" onclick="addBookmark(<?php echo $userId.",".$locationId; ?>)"><span class="glyphicon glyphicon-pushpin"></span></button>
				<button class="over-image-button" onclick=<?php echo "window.location.href='".$webInfoURL.$locationId."&id=".$id."'"; ?>><span class="glyphicon glyphicon-info-sign"></span></button>
			</div>
		</div>
		<input id="location" type="hidden" value=<?php echo $locationId; ?>>
		<div class="chat-room">
			<div id="chat-multi-container" class="create-trip-container">
				<h3 class="orange-text">create new trip</h3><br>
				<form name="addTrip" method = "POST" action = <?php echo '"'.$targetUri.'"'; ?>>
					<p>duration</p>
					<input type="hidden" name="userId" value=<?php echo $userId; ?>>
					<input type="hidden" name="locationId" value=<?php echo $locationId; ?>>
					<input type="date" name="startDate"> - <input type="date" name="endDate">
					<br>
					<br>
					<p>number of people</p>
					<input type="number" name="quota" min="2" max="100">
					<br>
					<br>
					<p>gender</p>
					<input type="radio" name="gender" value="male"> male &nbsp&nbsp&nbsp<input type="radio" name="gender" value="female"> female &nbsp&nbsp&nbsp<input type="radio" name="gender" value="both"> both
					<br>
					<br>
					<p>trip description</p>
					<textarea name="tripDescription" row="4" style="width:100%"></textarea>
					<br>
					<input type="submit" value="submit">
				</form>
			</div>
		</div>
	</div>
  </div>
</div>
	
	<?php } ?>

</body>
</html>