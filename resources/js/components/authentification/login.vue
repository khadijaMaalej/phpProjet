<template>
<Menu1></Menu1>
<div class="marge">
<div class="row justify-content-center">
<div class="col-md-8">

<div class="card card-default">
<div class="card-header">Login</div>
<div class="card-body">
    <form @submit.prevent="handleLogin">
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" v-model="user.email" required autofocus autocomplete="off">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" v-model="user.password" required autocomplete="off">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</template>
<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
import Menu1 from '../Menu1.vue';
const router = useRouter()
let user= {}
const handleLogin = async () => {
    try {
        const response = await axios.post('http://localhost:8000/api/login/', user);
        router.push("/dashboard");
        localStorage.setItem('user', response.data.user.name);
        localStorage.setItem('token', response.data.token);
    } catch (err) {
        console.error(err);
        if (err.response && err.response.status === 422) {
            console.log('Validation Error:', err.response.data.errors);
            // Affichez les messages d'erreur spécifiques à la validation
            // Peut-être mettre à jour l'état de votre composant pour afficher ces erreurs à l'utilisateur
        } else {
            alert('Une erreur s\'est produite lors de la connexion.');
        }
    }
};
</script>
<style scoped>
.marge {
position: fixed;
width: 100%;
height: 300px;
margin: 5% auto;
padding: 20px;
border: 5px solid #ccc;
background-color: #fff;
}
</style>