<?php include 'header.php';
	get_header();

	$locationId = $_GET["loc"];
	$userId = $_GET["id"];
	$imageURL = "http://$_SERVER[HTTP_HOST]/Piknix/location_img/";
	$webInfoURL = "http://$_SERVER[HTTP_HOST]/Piknix/web-info.php?loc=";
	$targetUri = "http://$_SERVER[HTTP_HOST]/Piknix/join-trip.php";

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

	$query = "SELECT * FROM trip_joined WHERE user_id = '$userId'";
	$result = mysqli_query($conn,$query);
	$row = $result->fetch_assoc();
	$tripId = $row["trip_id"];

	if ($tripId != 0) {
		$query = "SELECT * FROM trip WHERE id = '$tripId'";
		$result = mysqli_query($conn,$query);
		$row = $result->fetch_assoc();
		$startDate = $row["start_date"];
		$endDate = $row["end_date"];
		$username = $row["user_id"];
		$quota = $row["quota"];
		$description = $row["description"];
		$gender = $row["gender"];
		$functionParameter = $description."#".$gender;

		$query = "SELECT count(1) AS quota_filled FROM trip_joined WHERE trip_id ='$tripId'";
		$result = mysqli_query($conn,$query);
		$row = $result->fetch_assoc();
		$quotaFilled = $row["quota_filled"];
	}

	$query = "SELECT * FROM bookmark WHERE user_id='$userId' AND location_id='$locationId'";
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) > 0 ) {
		$bookmarkClass = "bookmarked";
	}
	else {
		$bookmarkClass = "not-bookmarked";
	}

	$query = "SELECT trip.id AS tripId ,quota,start_date,end_date,description,username FROM trip INNER JOIN user_auth WHERE user_id = user_auth.id AND destination_id = '$locationId'";
	$tripResult = mysqli_query($conn,$query);


	$query = "SELECT id,title,location,image_file FROM destination WHERE id='$locationId'";
	if ($result = mysqli_query($conn,$query)) {
		$row = $result->fetch_assoc();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
<script src="https://cdn.firebase.com/libs/angularfire/2.0.1/angularfire.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
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
		<div id="content-search" class="center-text show-picture" style="background-image: url(<?php echo $imageURL.$row["image_file"]; ?>)">
			<div id="content-search-inside">
				<p><?php echo $row["title"]; ?><p>
				<p class="small-text"><?php echo $row["location"]; ?><p>
			</div>
			<div id="over-image-div">
				<button id="bookmarkButton" class="<?php echo "over-image-button ".$bookmarkClass; ?>" onclick="addBookmark(<?php echo $userId.",".$locationId; ?>)"><span class="glyphicon glyphicon-pushpin"></span></button>
				<button class="over-image-button" onclick=<?php echo "window.location.href='".$webInfoURL.$locationId."&id=".$id."'"; ?>><span class="glyphicon glyphicon-info-sign"></span></button>
			</div>
		</div>
		<div id="content-search" class="center-text unshow-picture">
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
				<a href=<?php echo $targetUri."?id=".$userId."&loc=".$locationId."&tripId=".$tripId ?> class="button" id="join-trip-button"><button>Leave</button></a>
				<a class="trip-detail" href="javascript:void(0)">
					<button onclick="showTripDescription('<?php print $functionParameter ?>')" class="over-image-button" id="show-trip-description" ><span class="glyphicon glyphicon-chevron-down"></span></button>
				</a>
			</div>
		</div>
		<input id="location" type="hidden" value=<?php echo $locationId; ?>>
		<div class="chat-room" ng-app="chatApp">
		<?php if ($tripId == 0) { ?>
			<a class="chat-menu tab-chat active" href="javascript:void(0)"><div id="chat-button" class="active-tab">Chat Room</div></a>
			<a class="chat-menu tab-trip" href="javascript:void(0)"><div  id="trip-button" class="inactive-tab">Trip Room</div></a>
		<?php } else { ?>
			<a class="chat-menu tab-chat active" href="javascript:void(0)"><div id="chat-button-small" class="active-tab">Chat Room</div></a>
			<a class="chat-menu tab-trip-join" href="javascript:void(0)"><div id="trip-join-button-small" class="inactive-tab">Trip Chat</div></a>
			<a class="chat-menu tab-trip" href="javascript:void(0)"><div  id="trip-button-small" class="inactive-tab">Trip Room</div></a>
		<?php } ?>
			<div id="chat-multi-container" class="show-chat" ng-controller="chatController">
				<div class="show-chat" id="chat-container">
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
				<input class="show-chat" id="chat-input-text" type="text" ng-model="newmessage.text">
				<button class="show-chat" id = "chat-input-button" ng-click="insert(newmessage)">Add</button>
			</div>
			<div class="show-trip" id="chat-multi-container">
				<a href=<?php echo "create-trip.php?id=".$userId."&loc=".$locationId; ?>><div id="add-trip-box">Create a Trip</div></a>
				<?php while($tripRow = $tripResult->fetch_assoc()):  ?>
					<a href=<?php echo $targetUri."?id=".$userId."&loc=".$locationId."&tripId=".$tripRow["tripId"]; ?>>
						<div id="list-trip-box">
							<?php echo $tripRow["tripId"]." | ".$tripRow["username"]."<br>".$tripRow["start_date"]." - ".$tripRow["end_date"]."<br>".$tripRow["quota"]."<br>".$tripRow["description"]; ?>
						</div>
					</a>
				<?php endwhile; ?>
			</div>
		<?php if ($tripId != 0) { ?>
			<input id="tripId" type="hidden" value=<?php echo $tripId; ?>>
			<div class="show-trip-join" id="chat-multi-container" ng-controller="tripChatController">
				<div class="show-trip-join" id="chat-container">
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
				<input class="show-trip-join" id="chat-input-text" type="text" ng-model="newmessage.text">
				<button class="show-trip-join" id = "chat-input-button" ng-click="insert(newmessage)">Add</button>
			</div>
			<div class="organize-trip" id="chat-multi-container">
			<?php if ($username != $userId) { ?>
				<div id="member-join-trip">
					<span class="glyphicon glyphicon-user"> Member</span>
				</div>
				<a href=<?php echo $targetUri."?id=".$userId."&loc=".$locationId."&tripId=".$tripId ?> class="button" id="join-trip-button">
				<div id="login-join-trip">
					<span class="glyphicon glyphicon-log-in">Leave</span>
				</div>
				</a>
			<?php } else { ?>
				<div id="triple-member-join-trip">
					<span class="glyphicon glyphicon-user"> Member</span>
				</div>
				<div id="triple-edit-trip">
					<span class="glyphicon glyphicon-user"> Edit</span>
				</div>
				<a href=<?php echo $targetUri."?id=".$userId."&loc=".$locationId."&tripId=".$tripId ?> class="button" id="join-trip-button">
				<div id="triple-login-join-trip">
					<span class="glyphicon glyphicon-log-in"> Leave</span>
				</div>
				</a>
			<?php } ?>
			</div>
		<?php } ?>
		</div>
	</div>
  </div>
</div>
	
	<?php } ?>

</body>
</html>
<?php if ($tripId == 0) { ?>
<script>
	$('.tab-chat').click(function(e){
	    //make all tabs inactive

	    $('#chat-button').removeClass('inactive-tab');
	    $('#chat-button').addClass('active-tab');
	    $('#trip-button').addClass('inactive-tab');
	    $('#trip-button').removeClass('active-tab');
	    //then make the clicked tab active    
	    $('.show-trip').hide();
	    $('.show-chat').show();
	    $('.unshow-picture').hide();
	    $('.show-picture').show();
	});

	$('.tab-trip').click(function(e){
	    //make all tabs inactive
	    //then make the clicked tab active
	    $('#trip-button').removeClass('inactive-tab');
	    $('#trip-button').addClass('active-tab');
	    $('#chat-button').addClass('inactive-tab');
	    $('#chat-button').removeClass('active-tab');
    
	    $('.show-trip').show();
	    $('.show-chat').hide();
	    $('.unshow-picture').hide();
	    $('.show-picture').show();
	});
</script>
<?php } else { ?>
<script>
	$('.tab-chat').click(function(e){
	    //make all tabs inactive

	    $('#chat-button-small').removeClass('inactive-tab');
	    $('#chat-button-small').addClass('active-tab');
	    $('#trip-button-small').addClass('inactive-tab');
	    $('#trip-button-small').removeClass('active-tab');
	    $('#trip-join-button-small').addClass('inactive-tab');
	    $('#trip-join-button-small').removeClass('active-tab');

	    //then make the clicked tab active    
	    $('.show-trip').hide();
	    $('.show-trip-join').hide();
	    $('.show-chat').show();
	    $('.unshow-picture').hide();
	    $('.organize-trip').hide();
	    $('.show-picture').show();
	});

	$('.tab-trip').click(function(e){
	    //make all tabs inactive
	    //then make the clicked tab active
	    $('#trip-button-small').removeClass('inactive-tab');
	    $('#trip-button-small').addClass('active-tab');
	    $('#chat-button-small').addClass('inactive-tab');
	    $('#chat-button-small').removeClass('active-tab');
	    $('#trip-join-button-small').addClass('inactive-tab');
	    $('#trip-join-button-small').removeClass('active-tab');
    
	    $('.show-trip').show();
	    $('.show-trip-join').hide();
	    $('.show-chat').hide();
	    $('.unshow-picture').hide();
	    $('.show-picture').show();
	    $('.organize-trip').hide();
	});

	$('.tab-trip-join').click(function(e){
	    //make all tabs inactive
	    //then make the clicked tab active
	    $('#trip-button-small').removeClass('active-tab');
	    $('#trip-button-small').addClass('inactive-tab');
	    $('#chat-button-small').addClass('inactive-tab');
	    $('#chat-button-small').removeClass('active-tab');
	    $('#trip-join-button-small').addClass('active-tab');
	    $('#trip-join-button-small').removeClass('inactive-tab');
   
	    $('.show-trip').hide();
	    $('.show-trip-join').show();
	    $('.show-chat').hide();
	    $('.unshow-picture').show();
	    $('.show-picture').hide();
	    $('.organize-trip').hide();
	    
	});

	$('.trip-detail').click(function(e){
	    //make all tabs inactive
	    //then make the clicked tab active
	    $('#trip-button-small').addClass('inactive-tab');
	    $('#chat-button-small').addClass('inactive-tab');
	    $('#trip-join-button-small').addClass('inactive-tab');
   
	    $('.show-trip').hide();
	    $('.show-trip-join').hide();
	    $('.show-chat').hide();
	    $('.unshow-picture').show();
	    $('.show-picture').hide();
	    $('.chat-menu').hide();
	    $('.organize-trip').show();
	    
	});
</script>
<?php } ?>




