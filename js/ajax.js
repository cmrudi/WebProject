function addBookmark(userId,locationId) {
	console.log(userId);
	console.log(locationId);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        	var bookmarkClass = document.getElementById("bookmarkButton").className;
        	if (bookmarkClass.includes("not-bookmarked")) { //I.S Like, F.S Liked
            	document.getElementById("bookmarkButton").className = "bookmarked";
            }
            else { //I.S Liked, F.S Like
            	document.getElementById("bookmarkButton").className = "not-bookmarked";
            }
        }
    }
    xmlhttp.open("GET", "backend/addBookmark.php?id="+userId+","+locationId, true);
    xmlhttp.send();
}

function nextWebInfo(locationId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var directResponse = this.responseText;
            var response = directResponse.split("#");
            var title = response[0];
            var location = response[1];
            var image_file_big = response[2];
            var description = response[3];
            document.getElementById("web-info-description").innerHTML = description;
            document.getElementById("web-info-title").innerHTML = title;
            document.getElementById("web-info-location").innerHTML = location;
            document.getElementById("web-info-picture").style.backgroundImage = "url('http://localhost/Piknix/location_img/"+image_file_big+"')";
        }
    }
    xmlhttp.open("GET", "backend/webInfoData.php?loc="+locationId+"&next="+1, true);
    xmlhttp.send();

}