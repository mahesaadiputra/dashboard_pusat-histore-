'use strict'

importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js');
// importScripts('MessageController.js');

// var CACHE_NAME = 'HiStore-Notification-Cache';
// var urlsToCache = [
//   'https://code.jquery.com/jquery-3.4.1.js',
//   'MessageController.js'
// ];

// self.addEventListener('install', event => {
//   // Perform install steps
//   event.waitUntil(
//     caches.open(CACHE_NAME)
//       .then(cache => {
//         console.log('Opened cache');
//         cache.addAll(urlsToCache);
//       })
//   );
// });

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

const url = self.location.origin;

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  MessageReceived(payload);
  // console.log('[firebase-messaging-sw.js] Received background message ', payload);
  var notificationTitle = payload.data.title;
  var notificationOptions = {
    body: payload.data.body,
    icon: 'https://intek.id/img/logoin.png',
    timestamp: new Date()
  };

  return self.registration.showNotification(notificationTitle, notificationOptions);
});

// self.addEventListener('push', function(event) {
//   const title = 'New Histore Message';
//   const options = {
//     body: 'Yay it works.',
//     icon: 'images/icon.png',
//     badge: 'https://intek.id/img/logoin.png',
//     icon: 'https://intek.id/img/logoin.png',
//     image: 'https://intek.id/img/logoin.png'

//   };

//   event.waitUntil(self.registration.showNotification(title, options));
// });
// self.addEventListener('notificationclick', function(event) {
//   console.log('[Service Worker] Notification click Received.');
//   MessageReceived(event.notification);

//   event.notification.close();

//   event.waitUntil(
//     clients.openWindow('http://localhost:3000')
//   );
// });

self.addEventListener('notificationclick', function(event) {
  console.log('On notification click: ', event.notification);
  event.notification.close();
  // This looks to see if the current is already open and
  // focuses if it is
  event.waitUntil(
    clients.matchAll({
      type: "window"
    })
    .then(function(clientList) {
      for (var i = 0; i < clientList.length; i++) {
        var client = clientList[i];
        if (client.url == '/' && 'focus' in client)
          return client.focus();
      }
      if (clients.openWindow) {
        return clients.openWindow(url);
      }
    })
  );
});


// [END background_handler]
/*
TO DO LIST Service Worker

*/
function MessageReceived(data) {
    const message = JSON.parse(data.data.data);
    console.log('new Message : ', message);
}