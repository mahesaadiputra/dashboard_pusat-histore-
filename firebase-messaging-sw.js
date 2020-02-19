importScripts('https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.6.1/firebase-messaging.js');

// importScripts('MessageController.js');

// var url =  "http://localhost:333/fcm-push";
/*Update this config*/
var config = {
  // apiKey: "AAAA-dbq6_Q:APA91bEIKW996FW7XVDwbkOScc64SY4wGCENf-a9pUxVhWKOjHlbvA10O2KudqmcHHO3e4IK9bXvByf0Y4yI1ca4ZGGZJ2tIHLMZoLIB9Q29sL1hbIwyD8Q83S-mkqVT6UczeW8F4M9Y",
  // authDomain: "intek-3c647.firebaseapp.com",
  // databaseURL: "https://intek-3c647.firebaseio.com",
  // projectId: "intek-3c647",
  // messagingSenderId: "1073052576756",

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

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
    icon: payload.data.icon,
    image: 'https://intek.id/img/logoin.png'
  };
  //Send to another Function
  test(payload);
  return self.registration.showNotification(notificationTitle, notificationOptions);
});

// self.addEventListener('notificationclick', function(event) {
//   console.log('On notification click: ', event.notification);
//   test(event.notification);
//   event.notification.close();

//   // Do something as the result of the notification click
// });


self.addEventListener('notificationclick', function(event) {
    var url = "{{URL::to('/')}}";
    test(event);
    event.waitUntil(
        clients.matchAll({type: 'window'}).then( windowClients => {
          console.log(this)
          console.log(windowClients);
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});

// self.addEventListener('notificationclick', function(event) {
//   console.log('On notification click: ', event.notification);
//   event.notification.close();

//   test(event.notification);

//   // console.log(clients);

//   // This looks to see if the current is already open and
//   // focuses if it is
//   // event.waitUntil(
//   //   clients.matchAll({
//   //     type: "window"
//   //   })
//   //   .then(function(clientList) {
//   //     for (var i = 0; i < clientList.length; i++) {
//   //       var client = clientList[i];
//   //       // if (client.url == '/' && 'focus' in client)
//   //         return client.focus();
//   //     }
//   //     // if (clients.openWindow) {
//   //     //   return clients.openWindow('http://localhost:333/fcm-push');
//   //     // }
//   //   })
//   // );
// });
// [END background_handler]