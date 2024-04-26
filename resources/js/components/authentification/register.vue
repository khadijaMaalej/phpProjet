<template>
    <Menu1></Menu1>
    <div class="marge">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card card-default">
            <div class="card-header">Register</div>
            <div class="card-body">
              <form @submit.prevent="handleSubmit">
                <div class="form-group row">
                  <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control" v-model="user.name" required autofocus autocomplete="off">
                  </div>
                </div>
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
                <div class="form-group row">
                  <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
                  <div class="col-md-6">
                    <input id="password_confirmation" type="password" class="form-control" v-model="user.password_confirmation" required autocomplete="off">
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Register</button>
                  </div>
                </div>
              </form>
              <!-- Ajoutez une section pour afficher les erreurs -->
              <div v-if="error" class="alert alert-danger mt-3" role="alert">
                {{ error }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from "axios";
  import { useRouter } from 'vue-router';
import Menu1 from "../Menu1.vue";
  const router = useRouter();
  let user = {};
  let error = null;
  
  const handleSubmit = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/register/', user);
      console.log(response);
      router.replace({ name: 'login' });
    } catch (err) {
      console.log(err);
      if (err.response && err.response.status === 422) {
        error = err.response.data.message; // Assurez-vous que votre backend renvoie les erreurs de validation correctement
      } else {
        error = 'Une erreur s\'est produite lors de l\'inscription.';
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
  