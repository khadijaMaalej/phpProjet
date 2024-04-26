Bien sûr! Vous souhaitez appliquer le même style pour les liens "Login" et "Register" dans votre barre de navigation. Voici une version mise à jour de votre code:

<template>
    <nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Ecommerce</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link class="nav-link active" to="/login">Login</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" to="/register">Register</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </template>
  
  <script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();
const logout=async()=> {
let token=""

token=localStorage.getItem('token')
console.log(token)
axios.post('http://localhost:8000/api/logout', null, {

headers: {
'Authorization': `Bearer ${token}`
}
})

.then((response) => {
console.log(response)
localStorage.removeItem('token')
localStorage.removeItem('user')
router.push("/login")
})
.catch(err => {console.log(err);alert(err) })

}


  </script>


  <style lang="scss" scoped></style>