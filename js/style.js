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