import { onAuthStateChanged } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-auth.js"
import { getDocs, collection } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-firestore.js"
import { auth, db } from './firebase.js'
import { loginCheck } from './loginCheck.js'
import { setupPosts } from "./postList.js"

import './firebase.js'
import './signupForm.js'
import './signinForm.js'
import './googleLogin.js'
import './facebookLogin.js'
import './logout.js'


onAuthStateChanged(auth, async (user) => {
      if (user) {
         const querySnapshot = await getDocs(collection(db, 'tasks'))
         setupPosts(querySnapshot.docs)
      } else {
         setupPosts([])
       }
     loginCheck(user)
})