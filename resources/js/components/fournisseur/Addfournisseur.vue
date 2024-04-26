<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
      <h4 align="center">Ajout Fournisseur</h4>
      <form @submit.prevent="addFournisseur">
        <div class="row">
          <div class="col-md-6">
            <label for="id" class="form-label">Fournisseur</label>
            <input type="text" class="form-control" id="id" v-model="fournisseur.NomFournisseur" >
          </div>
          <div class="col-md-6 ms-auto">
            <label for="Nom" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="Nom" v-model="fournisseur.Adresse">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="Marque" class="form-label">Telephone</label>
            <input type="text" class="form-control" id="Marque" v-model="fournisseur.telephone">
          </div>
          <div class="col-md-6 ms-auto">
            <label for="Voiturecompatible" class="form-label">Email</label>
            <input type="text" class="form-control" id="Voiturecompatible" v-model="fournisseur.email">
          </div>
        </div>
        <br/>
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-floppy-disk"></i> Enregister
        </button>
        <router-link to="/listfournisseur" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Cancel
        </router-link>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  const router = useRouter();
  const fournisseur = ref({
    NomFournisseur: "",
    Adresse: "",
    telephone: "",
    email: ""
  });
  
  const addFournisseur = async () => {
  try {
    await axios.post("http://localhost:8000/api/fournisseurs/", fournisseur.value);
    router.push({ name: 'Viewfournisseur' });
  } catch (error) {
    console.error('Axios Error:', error);
    console.error('Server Response:', error.response); // Log the server response
  }
};


  </script>
  
  <style scoped>
  /* Add your component-specific styles here */
  </style>
  