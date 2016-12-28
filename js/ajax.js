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