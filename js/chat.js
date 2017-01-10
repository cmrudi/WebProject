 (function($scope) {   

    angular
        .module('chatApp', ['firebase'])
        .controller('chatController', ['$scope','$firebase','$firebaseArray','$firebaseObject', function($scope,$firebase,$firebaseArray,$firebaseObject){
            var config = {
                apiKey: "AIzaSyCz93oYzFZegc-gcXTELEaFWmwFO89cM0g",
                authDomain: "piknix-chat.firebaseapp.com",
                databaseURL: "https://piknix-chat.firebaseio.com",
                storageBucket: "piknix-chat.appspot.com",
                messagingSenderId: "599616184921"
            };

            var locationId = document.getElementById("location").value;
            firebase.initializeApp(config);
            const dbRef = firebase.database().ref().child('messages').child(locationId);
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

$('.tab-chat').click(function(e){
    //make all tabs inactive
    $('.chat-room a').removeClass('active');
    //then make the clicked tab active
    $(this).addClass('active');    
    $('.show-trip').hide();
    $('.show-chat').show();
});

$('.tab-trip').click(function(e){
    //make all tabs inactive
    $('.chat-room a').removeClass('active');
    //then make the clicked tab active
    $(this).addClass('active');    
    $('.show-trip').show();
    $('.show-chat').hide();
});