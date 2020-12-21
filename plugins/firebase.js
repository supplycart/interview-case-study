import firebase from 'firebase/app'
import 'firebase/auth'

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyC3_5e65cFs_-Y0_NJskRI45JocD734KIY",
  authDomain: "interview-case-study-azman.firebaseapp.com",
  projectId: "interview-case-study-azman",
  storageBucket: "interview-case-study-azman.appspot.com",
  messagingSenderId: "897988186762",
  appId: "1:897988186762:web:91094c130c2009ae481373"
};

// Initialize Firebase
let app = null;
if (!firebase.apps.length) {
  app = firebase.initializeApp(firebaseConfig);
}

export default firebase