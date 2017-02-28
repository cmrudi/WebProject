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


function mainMenuClicked(menuId) {
	var currentMenu = document.getElementById("currentActiveMenu").value;
	console.log(currentMenu);
	if (currentMenu == "1") {
		document.getElementById("search-button").style.backgroundColor = "#F8F8F8";
		document.getElementById("search-button").style.color = "#F15A25";
	}
	else if (currentMenu == "2") {
		document.getElementById("recent-chat-button").style.backgroundColor = "#F8F8F8";
		document.getElementById("recent-chat-button").style.color = "#F15A25";
	}
	else if (currentMenu == "3") {
		document.getElementById("user-button").style.backgroundColor = "#F8F8F8";
		document.getElementById("user-button").style.color = "#F15A25";
	}
	else if (currentMenu == "4") {
		document.getElementById("more-button").style.backgroundColor = "#F8F8F8";
		document.getElementById("more-button").style.color = "#F15A25";
	}

	if (currentMenu == menuId) {
		menuId = 0;
		document.getElementById("currentActiveMenu").value = "0";
	}

	if (menuId == 1) {
		document.getElementById("search-button").style.backgroundColor = "#F15A25";
		document.getElementById("search-button").style.color = "white";
		document.getElementById("currentActiveMenu").value = "1";
	}
	else if (menuId == 2) {
		document.getElementById("recent-chat-button").style.backgroundColor = "#F15A25";
		document.getElementById("recent-chat-button").style.color = "white";
		document.getElementById("currentActiveMenu").value = "2";
	}
	else if (menuId == 3) {
		document.getElementById("user-button").style.backgroundColor = "#F15A25";
		document.getElementById("user-button").style.color = "white";
		document.getElementById("currentActiveMenu").value = "3";
	}
	else if (menuId == 4) {
		document.getElementById("more-button").style.backgroundColor = "#F15A25";
		document.getElementById("more-button").style.color = "white";
		document.getElementById("currentActiveMenu").value = "4";
	}


	    $('.user-menu').hide();
	    $('.more-menu').show();
}

