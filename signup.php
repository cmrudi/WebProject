<?php 

function get_signup_form() {
	$targetUri = "http://$_SERVER[HTTP_HOST]/Piknix/backend/signup_db.php";

	?>
		<form name="signup-form" enctype="multipart/form-data" onsubmit="" method = "POST" action =<?php echo '"'.$targetUri.'"'; ?>
			<br>
			<h4 class="orange-text">username</h4>
			<input type = "text" name = "username">
			<br><br>
			<h4 class="orange-text">email address</h4>
			<input type = "text" name = "email">
			<br><br>
			<h4 class="orange-text">PIN code</h4>
			<input type = "text" name = "password">
			<br><br>
			<input type="submit" value="Submit">
			<br>
		</form>
	<?php
}
?>
