<?php include 'header.php';
	  include 'login.php';
	  include 'signup.php';
		get_header();
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
	  <div id="login-signup">
		<form action="" method="post">
		  <button type="submit" name="login" id="login-button"><h3 class="center-text">login</h3></button>
		  <button type="submit" name="signup" id="signup-button"><h3 class="center-text">sign up</h3></button>
		</form>
      </div>
      <div id="signup-login-form">
		<?php
       	  if ($_SERVER["REQUEST_METHOD"] == "POST") {
			 if (isset($_POST["login"])) {
				 get_login_form();
			 }
			 else if (isset($_POST["signup"])) {
				 get_signup_form();
			 }
		  }
		  else {
			get_login_form(); 
		  }
		  
		  function test_input($data) {
		    $data = trim($data);
		    $data = stripslashes($data);
		    $data = htmlspecialchars($data);
		    return $data;
		  }
		  
		  ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>
