<?php include 'header.php';
	get_header();

	$locationId = $_GET["loc"];
	$userId = $_GET["id"];
	$imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";

	$dbservername="localhost";
	$dbusername="piknix";
	$dbpassword="piknix";
	$database="piknix_db";

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$database);
	
	if (mysqli_connect_errno()) {
			exit();
	}
	$query = "SELECT username FROM user_auth WHERE id = '$userId'";
	$result = mysqli_query($conn,$query);
	$row = $result->fetch_assoc();
	$username = $row["username"];
	
	$query = "SELECT id,title,location,image_file FROM destination WHERE id= '$locationId'";
	if ($result = mysqli_query($conn,$query)) {
		$row = $result->fetch_assoc();

?>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
<script src="https://cdn.firebase.com/libs/angularfire/2.0.1/angularfire.min.js"></script>

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
		</div>
		<div class="chat-room" ng-app="chatApp" ng-controller="chatController">
			<div id="chat-button">Chat Room</div>
			<div id="trip-button">Trip Room</div>
			<div id="chat-multi-container">
				<div id="chat-container">
					<ul>
    					<div ng-repeat="message in messages">
    						<div class="text-message">
    							{{ message.name }} <date>{{ message.time | date:'HH:mm'}}</date><br>
	 							{{message.text}}
	 						</div>
    					</div>
					</ul>
				</div>
				<input id="username" type="hidden" ng-model="newmessage.name" value=<?php echo $username; ?>>
				<input id="chat-input-text" type="text" ng-model="newmessage.text">
				<button id = "chat-input-button" ng-click="insert(newmessage)">Add</button>
			</div>
		</div>
	</div>
  </div>
</div>
	
	<?php } ?>

</body>
</html>




