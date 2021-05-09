const firebaseConfig = {
    apiKey: "AIzaSyCyucwX5d5MbddvT0lpjjYoZcNqFs0R5gs",
    authDomain: "aliaj-joosh.firebaseapp.com",
    databaseURL: "https://aliaj-joosh.firebaseio.com",
    projectId: "aliaj-joosh",
    storageBucket: "aliaj-joosh.appspot.com",
    messagingSenderId: "1030381904285",
    appId: "1:1030381904285:web:7771dde59c8dc364444f74"
};


firebase.initializeApp(firebaseConfig);

// -------------------------------------------------------------------------------
const messaging = firebase.messaging();
messaging.requestPermission()
            .then(function () {
                console.log("Notification permission granted.");
                return messaging.getToken()
            }).then(function (token) {
                $('#device_token').val(token);
                console.log(token);
            }).catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });
// -------------------------------------------------------------------------------

messaging.onMessage((payload) => {
    console.log(payload);
});