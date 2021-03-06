 (function($scope) {   

    angular
        .module('tripChatApp', ['firebase'])
        .controller('tripChatController', ['$scope','$firebase','$firebaseArray','$firebaseObject', function($scope,$firebase,$firebaseArray,$firebaseObject){
            var config = {
                apiKey: "AIzaSyCz93oYzFZegc-gcXTELEaFWmwFO89cM0g",
                authDomain: "piknix-chat.firebaseapp.com",
                databaseURL: "https://piknix-chat.firebaseio.com",
                storageBucket: "piknix-chat.appspot.com",
                messagingSenderId: "599616184921"
            };
            console.log("tripChattt");
            var tripId = document.getElementById("tripId").value;
            firebase.initializeApp(config);
            const dbRef = firebase.database().ref().child('trip').child(tripId);
            //dbRef.on('value', snap => console.log(snap.val()));
            var messages = $firebaseArray(dbRef);
            //messages.child(locationId);
            console.log(messages);
            messages.$loaded().then(function(messages) {
                $scope.messages = messages;
            });

            $scope.insert = function(newmessage) {
                var username = document.getElementById('username').value;
                newmessage.time = Date.now();
                newmessage.name = username;
                messages.$add(newmessage);
            }
    }]);
}());