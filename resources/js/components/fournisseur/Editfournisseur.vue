<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
      <h4 align="center">Modifier Fournisseur</h4>
      <form @submit.prevent="modifierFournisseur">
        <div class="row">
          <div class="col-md-6">
            <label for="id" class="form-label">Fournisseur</label>
            <input type="text" class="form-control" id="id" v-model="fournisseur.NomFournisseur">
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
        <br />
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-pen"></i> Modifier
        </button>
        <router-link to="/listfournisseur" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Annuler
        </router-link>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  import axios from 'axios';
  
  const route = useRoute();
  const router = useRouter();
  const fournisseur = ref({});
  
  const fetchFournisseur = async () => {
    try {
      const response = await axios.get(`http://localhost:8000/api/fournisseurs/${route.params.id}`);
      fournisseur.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const modifierFournisseur = async () => {
    try {
      await axios.put(`http://localhost:8000/api/fournisseurs/${route.params.id}`, fournisseur.value);
      router.push('/listfournisseur');
    } catch (error) {
      console.error('There was an error!', error);
    }
  };
  
  onMounted(() => {
    fetchFournisseur();
  });
  </script>
  
  <style scoped>
  /* Add your component-specific styles here */
  </style>
  