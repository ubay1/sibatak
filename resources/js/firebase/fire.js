import * as firebase from 'firebase';

var config = {
    apiKey: "AIzaSyDvyig5t3a6z_Azxun3TzrlbOkBEt2ojDo",
    authDomain: "batakchat-b8d1e.firebaseapp.com",
    databaseURL: "https://batakchat-b8d1e.firebaseio.com",
    projectId: "batakchat-b8d1e",
    storageBucket: "batakchat-b8d1e.appspot.com",
    messagingSenderId: "410000922589",
    appId: "1:410000922589:web:5d40de1ab3f0244a878834",
    measurementId: "G-NFG9HK3SSR"
  };
  // Initialize Firebase
  var fire = firebase.initializeApp(config);
    export default fire;
