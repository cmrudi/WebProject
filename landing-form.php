<?php
function get_landing_form() {
	$targetLogin = "http://$_SERVER[HTTP_HOST]/Piknix/backend/login_db.php";
	$targetSignup = "http://$_SERVER[HTTP_HOST]/Piknix/backend/signup_db.php";
	$targetSearch = "http://$_SERVER[HTTP_HOST]/Piknix/index.php";

	?>
	<form class="signup-form" name="signup-form" enctype="multipart/form-data" onsubmit="" method = "POST" action =<?php echo '"'.$targetSignup.'"'; ?> >
		<br>
		<h5 class="orange-text">username</h5>
		<input type = "text" name = "username">
		<br><br>
		<h5 class="orange-text">email address</h5>
		<input type = "text" name = "email">
		<br><br>
		<h5 class="orange-text">PIN code</h5>
		<input type = "text" name = "password">
		<br><br>
		<input class="submit-button" type="submit" value="Submit">
		<br>

	</form>
	<form class="login-form" name="login-form" enctype="multipart/form-data" onsubmit="" method = "POST" action = <?php echo '"'.$targetLogin.'"'; ?> >
		<br>
		<h5 class="orange-text">username</h5>
		<input type = "text" name = "username">
		<br><br>
		<h5 class="orange-text">PIN code</h5>
		<input type = "text" name = "password">
		<br><br>
		<input class="submit-button" type="submit" value="Submit">
		<br>
		
		<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
		</fb:login-button>
		<div id="status">
		</div>

	</form>
	<form class="search-form" name="search" method="post" action =<?php echo '"'.$targetSearch.'"'; ?>>
		<input type="text" id="search" name="searchText" class="center-text" placeholder="Type to Search">
	</form>

<script type="text/javascript">


	$('.tab-login').click(function(e){
	    //make all tabs inact
	    $('.login-form').show();
	    $('.signup-form').hide();
	    $('.search-form').hide();
	    $('.main-content').hide();


	});
	$('.tab-signup').click(function(e){
	    //make all tabs inact
	    $('.login-form').hide();
	    $('.signup-form').show();
	    $('.search-form').hide();
	    $('.main-content').hide();

	});

	$('.tab-search').click(function(e){
	    //make all tabs inact
	    $('.login-form').hide();
	    $('.signup-form').hide();
	    $('.search-form').show();
	    $('.main-content').show();
	    $('.main-content').height(465);

	});


</script>

<?php } ?>