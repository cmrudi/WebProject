<?php include 'header.php';
	get_header();

	$locationId = $_GET["loc"];
	$userId = $_GET["id"];
	$tripId = $_GET["tripId"];
	$targetUri = "http://$_SERVER[HTTP_HOST]/Piknix/backend/enterToTrip.php";

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}

	$query = "SELECT * FROM trip WHERE id = '$tripId'";
	if ($result = mysqli_query($conn,$query)) {
		$row = $result->fetch_assoc();

		$destinationId = $row["destination_id"];
		$startDate = $row["start_date"];
		$endDate = $row["end_date"];
		$quota = $row["quota"];
		$gender = $row["gender"];
		$description = $row["description"];
		$userCreated = $row["user_id"];
		$functionParameter = $description."#".$gender;

		$query = "SELECT username FROM user_auth WHERE id = $userCreated";
		$username = "";
		if ($result = mysqli_query($conn,$query)) {
			$row = $result->fetch_assoc();
			$username = $row["username"];
		}

		$query = "SELECT count(1) AS quota_filled FROM user_auth WHERE trip_joined ='$tripId'";
		$result = mysqli_query($conn,$query);
		$row = $result->fetch_assoc();
		$quotaFilled = $row["quota_filled"];

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/style.js"></script>

<div class="row">
  <div class="col-sm-7">
    <div id="map"></div>
    <div id="capture"></div>
  </div>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtTM7HTfmrIedFAbJYWFLLo0Et7CQxlew&callback=initMap"></script>
  <div class="col-sm-5">
    <div class="picnix-container">
		<div id="content-search" class="center-text orange-background">
			<div id="content-trip-inside">
				<p><?php echo $tripId." | ".$username; ?></p>
				<p><?php echo $startDate." / ".$endDate; ?></p>
				<p><?php echo $quotaFilled."/".$quota; ?></p>
			</div>
			<div id="trip-gender">
			</div>
			<div id="join-trip-description">
			</div>
			<div id="over-image-div">
				<a href=<?php echo $targetUri."?id=".$userId."&loc=".$locationId."&tripId=".$tripId ?> class="button" id="join-trip-button"><button>Join</button></a>
				<button onclick="showTripDescription('<?php print $functionParameter ?>')" class="over-image-button" id="show-trip-description" ><span class="glyphicon glyphicon-chevron-down"></span></button>
			</div>
		</div>
		<div class="chat-room join-trip-room">
			<div id="chat-multi-container">
				<div id="member-join-trip">
					<span class="glyphicon glyphicon-user"> Member</span>
				</div>
				<a href=<?php echo $targetUri."?id=".$userId."&loc=".$locationId."&tripId=".$tripId ?> class="button" id="join-trip-button">
				<div id="login-join-trip">
					<span class="glyphicon glyphicon-log-in"> Join</span>
				</div>
				</a>
			</div>
		</div>
	</div>
  </div>
</div>
	
	<?php } ?>

</body>
</html>

