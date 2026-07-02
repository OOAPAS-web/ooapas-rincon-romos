const firebaseConfig = {
    apiKey: "AIzaSyAmdGxyaakZg5TGxfTjB5EG4nf8Av6k05A",
    authDomain: "ooapas-pagina-provisional.firebaseapp.com",
    projectId: "ooapas-pagina-provisional",
    storageBucket: "ooapas-pagina-provisional.firebasestorage.app",
    messagingSenderId: "611138956829",
    appId: "1:611138956829:web:ac40a461fb35591bd7e0f4"
  };
  
  firebase.initializeApp(firebaseConfig);
  
  const db = firebase.firestore();
  const auth = firebase.auth();