<template>
    <Menu></Menu> 
     <div>
         <div v-if="isLoading">
             <h2> Loading .... </h2>
         </div>
         
         <div v-else class="py-6">
             <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                 <div class="container-fluid">
 
                     <router-link :to="{ name: 'Addcommande' }" class="btn btn-
 outline-light">
 
                         <i class="fa-solid fa-square-plus"></i> Ajouter commande
                     </router-link>
 
                 </div>
             </nav>
             <table class="table table-striped shadow">
                <thead>
                    <tr>
                        <th>Id Commande</th>
                        
                        <th>Nom</th>
                        <th>Date de creation</th>
                        <th>Fournisseur</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="commande in commandes" :key="commande.id">
    <td>{{ commande.id }}</td>
    <td>{{ commande.Nom }}</td>
    <td>{{ commande.datecreation }}</td>
    <td>{{ commande.NomFournisseur }}</td>
    <td>
      
    
      
                            <button class="btn btn-outline-danger mx-2" @click="deleteCommande(commande.id)">

                                <i class="fa-solid fa-trash-can"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr v-if="commandes.length === 0">
                        <th colspan="7">aucun enregistrement trouvé</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
   
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Menu from '../Menu.vue';
const commandes = ref([])
const isLoading = ref(true)

// Your existing data and methods


const getcommandes = async () => {
    await axios.get("http://localhost:8000/api/commandes")
        .then(res => {
            commandes.value = res.data
            isLoading.value = false

        })
        .catch(error => {
            console.log(error)
        })
}
onMounted(() => {
    getcommandes();
});
const deleteCommande = async (id) => {
  if (window.confirm('Êtes-vous sûr de vouloir supprimer ?')) {
    try {
      await axios.delete(`http://localhost:8000/api/commandes/${id}`);
      getcommandes();
    } catch (error) {
      console.error(error);
    }
  }
};
</script>
<style lang="css" scoped></style>
