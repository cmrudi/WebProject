function showTripDescription(description) {
	var arr = description.split('#');
	var description = arr[0];
	var gender = arr[1];
	var glypIcon = document.getElementById("show-trip-description").innerHTML;
	if (glypIcon.search("-up")!= -1) {
		document.getElementById("show-trip-description").innerHTML = '<span class="glyphicon glyphicon-chevron-down"></span>';
		document.getElementById("join-trip-button").innerHTML = '<button>Join</button>';
		document.getElementById("join-trip-description").innerHTML = '';
		document.getElementById("trip-gender").innerHTML = '';
		$('#join-trip-description').removeClass('trip-description-box');
		$('#trip-gender').removeClass('trip-gender-box');

	
	}
	else {
		document.getElementById("show-trip-description").innerHTML = '<span class="glyphicon glyphicon-chevron-up"></span>';
		document.getElementById("join-trip-button").innerHTML = '';
		$('#join-trip-description').addClass('trip-description-box');
		document.getElementById("join-trip-description").innerHTML = '<p>'+description+'</p>';
		$('#trip-gender').addClass('trip-gender-box');
		if (gender == "male") {
			document.getElementById("trip-gender").innerHTML = '<span class="glyphicon glyphicon-chevron-up"></span>';	
		}
		else if (gender == "female") {
			document.getElementById("trip-gender").innerHTML = '<span class="glyphicon glyphicon-chevron-down"></span>';
		}
		else {
			document.getElementById("trip-gender").innerHTML = '<span class="glyphicon glyphicon-chevron-up"></span><span class="glyphicon glyphicon-chevron-down"></span>';
		}

	}
}

function showSearchMenu() {
	document.getElementById("function-menu").innerHTML = '<form name="search" action="" method="post">'+
															'<input type="text" id="search" name="searchText" class="center-text" placeholder="Type to Search">'+
														 '</form>';
}

function showUserMenu(username) {
	document.getElementById("function-menu").innerHTML = '<div id="function-menu-box">'+
															'<div id="username"><div id="photo-modal-button" class="photo-circle"></div><p class="username-text">username</p> <i class="glyphicon glyphicon-log-out"></i></div>'+
													  		    '<div id="bookmark-button"><div class="circle"><i class="glyphicon glyphicon-plane glyp-inside-circle"></i></div><p class="center-text">trip</p></div>'+
													  		    '<div id="bookmark-button"><div class="circle"><i class="glyphicon glyphicon-pushpin glyp-inside-circle"></i></div><p class="center-text">bookmarks</p></div>'+
													  		    '<div id="photo-modal" class="modal">'+
																 	'<div class="modal-content">'+
																 		'<div class="modal-header">'+
													      					'<span id="exit" class="close">&times;</span>'+
													      					'<h3>set your profile picture</h3>'+
													    				'</div>'+
																    	'<div class="modal-body">'+
																	      	'<form name="photo" action="" method="post">'+
																	      		'<input type="hidden" name="userId" value=<?php $userId; ?>>'+
																	      		'<input type="file" name="file" onchange="readURL(this);" />'+
																	      		'<br>'+
																	      		'<br>'+
																	      		'<div style="width: 200px; height:200px">'+
																	      			'<img id="blah" src="#" alt="your image" />'+
																	      		'</div>'+
																	      		'<br>'+
																	      		'<br>'+
																	      		'<input type="submit" value="upload">'+
																	  			'<br>'+
																	      	'</form>'+
																	    '</div>'+
																	    '<div class="modal-footer">'+
																	    '</div>'+
																	'</div>'+
																'</div>'+
															'</div>'+
														'</div>';
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(200)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);

        $('#blah').dragncrop({
		// Initial position
		position: {},
		centered: true,

		// Simple overflow:
		overflow: false,

		// Overflaid overflow
		overlay: false,

		// Drag instruction
		instruction: false,
		instructionText: 'Drag to crop',
		instructionHideOnHover: true,});
    }
}

