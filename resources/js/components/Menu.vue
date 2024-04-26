<template>
  <nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand">Ecommerce</a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <router-link class="nav-link active" to="/listart">Liste des voitures</router-link>
          </li>
          <li>
            <router-link class="nav-link active" to="/listdepot">Liste des articles</router-link>
          </li>
          <li>
            <router-link class="nav-link active" to="/listfact">Liste des factures</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/listfournisseur">Liste des fournisseurs</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" to="/listcommande">Liste des commandes</router-link>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <button class="nav-link active" @click="logout">Logout</button>
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