import firebase from 'firebase'
import firestore from 'firebase/firestore'

  var firebaseConfig = {
    apiKey: "AIzaSyBr6y0Saz6ztn3ZIwhCg5eF3z-EbQr-fHE",
    authDomain: "chat-enjo.firebaseapp.com",
    databaseURL: "https://chat-enjo.firebaseio.com",
    projectId: "chat-enjo",
    storageBucket: "chat-enjo.appspot.com",
    messagingSenderId: "10638368673",
    appId: "1:10638368673:web:499342ffaf6dd6af3a35e0",
    measurementId: "G-34FVGG2MZP"
  };
  // Initialize Firebase
  const firebaseApp = firebase.initializeApp(firebaseConfig);
  firebaseApp.firestore().settings({timestampsInSnapshots: true})

  export default firebaseApp.firestore()
