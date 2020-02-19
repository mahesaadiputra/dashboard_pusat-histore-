'use strict'

  /*Update this config*/
 var config = {
  apiKey: "AIzaSyChvsHdNtPclzF_PCELo5OK4eSxARinkqU",
  authDomain: "intek-3c647.firebaseapp.com",
  databaseURL: "https://intek-3c647.firebaseio.com",
  projectId: "intek-3c647",
  storageBucket: "intek-3c647.appspot.com",
  messagingSenderId: "1073052576756",
  appId: "1:1073052576756:web:2a59c094a38a0c808667a1",
  measurementId: "G-481C8VP88S"
};
firebase.initializeApp(config);
  // Retrieve Firebase Messaging object.
 const messaging = firebase.messaging();

 messaging.requestPermission()
 .then(function() {
    console.log('Notification permission granted.');
    getRegToken();
 })
  .catch(function(err) {
    console.log('Unable to get permission to notify.', err);
  });

  messaging.onTokenRefresh(() => {
    messaging.getToken().then((refreshedToken) => {
      console.log('Token refreshed.');
      // Indicate that the new Instance ID token has not yet been sent to the
      // app server.
      setTokenSentToServer(false, refreshedToken);
      // Send Instance ID token to app server.
      // sendTokenToServer(refreshedToken);
      // [START_EXCLUDE]
      // Display new Instance ID token and clear UI of all previous messages.
      resetUI();
      // [END_EXCLUDE]
    }).catch((err) => {
      console.log('Unable to retrieve refreshed token ', err);
      showToken('Unable to retrieve refreshed token ', err);
    });
  });

  function getRegToken(argument) {
      messaging.getToken()
        .then(function(currentToken) {
          if (currentToken) {
            //saving token to database
            // saveToken(currentToken);
            // if(isTokenRegistered() !== null){
              console.log('current token', currentToken);
              setTokenSentToServer(true, currentToken);
            // }
          } else {
            console.log('No Instance ID token available. Request permission to generate one.');
            setTokenSentToServer(false, currentToken);
          }
        })
        .catch(function(err) {
          console.log('An error occurred while retrieving token. ', err);
          setTokenSentToServer(false, '');
        });
  }

  function setTokenSentToServer(sent, token) {
      window.localStorage.setItem('__sts', sent ? 1 : 0);
      window.localStorage.setItem('___t', token);
      subscribe();
      if(!window.localStorage.getItem('___c_ts')){
        window.localStorage.setItem('___c_ts', 0);
      }

  }

  function isTokenSentToServer() {
      return window.localStorage.getItem('__sts') == 1;
  }
  function isTokenRegistered(argument) {
    // console.log(window.localStorage.getItem('___c_ts'));
    return window.localStorage.getItem('___c_ts');
  }

  messaging.onMessage((payload) => {
    MessageReceived(payload);
    // console.log('New Message',payload);
    var notificationTitle = payload.data.title;
    var notificationOptions = {
       body: payload.data.body,
       icon: 'https://intek.id/img/logoin.png'
    };
    var notification = new Notification(notificationTitle,notificationOptions);
  });


  function subscribe(){
    $.ajax({
        method:'GET',
        url:`/subscribe/${window.localStorage.getItem('___t')}`,
        success: function(data){
          // console.log(data);
          window.localStorage.setItem('___c_ts', 1);
        }
      })
  }