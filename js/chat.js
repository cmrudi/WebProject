 (function($scope) {   

    angular
        .module('chatApp', ['firebase'])
        .controller('chatController', ['$scope','$firebase','$firebaseArray','$firebaseArray', function($scope,$firebase,$firebaseArray,$firebaseObject){
            var config = {
                apiKey: "AIzaSyCz93oYzFZegc-gcXTELEaFWmwFO89cM0g",
                authDomain: "piknix-chat.firebaseapp.com",
                databaseURL: "https://piknix-chat.firebaseio.com",
                storageBucket: "piknix-chat.appspot.com",
                messagingSenderId: "599616184921"
            };

            firebase.initializeApp(config);
            const dbRef = firebase.database().ref().child('messages');
            //dbRef.on('value', snap => console.log(snap.val()));
            var messages = $firebaseArray(dbRef);
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