<?php

function get_header() {
	$userId = $_GET["id"];
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Piknix</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
	  <link rel="stylesheet" href="css/style.css">
	  <link rel="stylesheet" href="css/map.css">
	  <link rel="stylesheet" href="css/chat.css">
	  <script src="js/google-maps.js"></script>
	  <script src="js/style.js"></script>
	</head>
	<body>

	<input type="hidden" id="currentActiveMenu" value="">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php"><img id="header-logo" src="img/piknix_logo.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li>
				<div onclick="mainMenuClicked(1)" id="search-button" class="landing-header-button-google tab-search">
					<i class="material-icons md-24">search</i>
				</div>
			</li>
			<li>
				<div onclick="mainMenuClicked(2)" id="recent-chat-button" class="landing-header-button-google">
					<i class="material-icons md-24">chat_bubble_outline</i>
				</div>
			</li>
			<li>
				<div onclick="mainMenuClicked(3)" id="user-button" class="landing-header-button-google tab-user">
					<i class="material-icons md-24">perm_identity</i>
				</div>
			</li>
			<li>
				<div onclick="mainMenuClicked(4)" id="more-button" class="landing-header-button-google tab-more">
					<i class="material-icons md-24">more_horiz</i>
				</div>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	<?php
}

?>
