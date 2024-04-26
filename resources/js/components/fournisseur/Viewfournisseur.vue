<template>
    <div>
      <Menu></Menu>
      <div>
        <div v-if="isLoading">
          <h2>Loading ....</h2>
        </div>
  
        <div v-else class="py-6">
          <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
              <router-link :to="{ name: 'Addfournisseur' }" class="btn btn-outline-light">
                <i class="fa-solid fa-square-plus"></i> Ajouter fournisseur
              </router-link>
            </div>
          </nav>

          

          <table class="table table-striped shadow">
            <thead>
              <tr>
                <th scope="col">id Fournisseur</th>
                <th scope="col">Fournisseur</th>
                <th scope="col">Adresse</th>
                <th scope="col">Telephone</th>
                <th scope="col">Email</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="fournisseur in fournisseurs" :key="fournisseur.id">
                <td>{{ fournisseur.id }}</td>
                <td>{{ fournisseur.NomFournisseur }}</td>
                <td>{{ fournisseur.Adresse }}</td>
                <td>{{ fournisseur.telephone }}</td>
                <td>{{ fournisseur.email }}</td>
                <td>
                 
<router-link :to="{ name: 'Editfournisseur', params: { id: fournisseur.id } }" class="btn btn-outline-warning mx-2">
  <i class="fa-solid fa-pen-to-square"></i> Modifier
</router-link>


                </td>
                <td>
                  <button class="btn btn-outline-danger mx-2" @click="deletefournisseur(fournisseur.id)">
                    <i class="fa-solid fa-trash-can"></i> Supprimer
                  </button>
                </td>
              </tr>
              <tr v-if="fournisseurs.length === 0">
                <td colspan="7">Aucun enregistrement trouvé</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Menu from '../Menu.vue';
  
  const fournisseurs = ref([]);
  const isLoading = ref(true);
  
  const getfournisseurs = async () => {
    try {
      const response = await axios.get("http://localhost:8000/api/fournisseurs");
      fournisseurs.value = response.data;
      isLoading.value = false;
    } catch (error) {
      console.error(error);
    }
  };
  
  const deletefournisseur = async (id) => {
    if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
      try {
        await axios.delete(`http://localhost:8000/api/fournisseurs/${id}`);
        getfournisseurs();
      } catch (error) {
        console.error(error);
      }
    }
  };
  
  onMounted(() => {
    getfournisseurs();
  });
  </script>
  
  <style lang="css" scoped>
  /* Ajoutez vos styles spécifiques au composant ici */
  </style>
  