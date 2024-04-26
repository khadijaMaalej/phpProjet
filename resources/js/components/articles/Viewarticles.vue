<template>
   <Menu></Menu> 
    <div>
        <div v-if="isLoading">
            <h2> Loading .... </h2>
        </div>
        
        <div v-else class="py-6">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <div class="container-fluid">

                    <router-link :to="{ name: 'Addarticle' }" class="btn btn-
outline-light">

                        <i class="fa-solid fa-square-plus"></i> Ajouter Voiture
                    </router-link>

                </div>
            </nav>
            <table class="table table-striped shadow">
                <thead>
                    <tr>
<th scope="col "> Id Voiture</th>
                        <th scope="col">Immatriculation</th>
                        <th scope="col">Nchassis</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modele</th>
                        <th scope="col">Moteur</th>
                        <th scope="col">Image</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="art in articles" :key="art.id">
                        <td>{{ art.id }}</td>
                        <td>{{ art.Immatriculation }}</td>
                        <td>{{ art.Nchassis }}</td>
                        <td>{{ art.Marque }}</td>
                        <td>{{ art.Modele }}</td>
                        <td>{{ art.Moteur }}</td>
                        <td><img :src="art.imageart" width="70" height="80" /> </td>


                        <td>
                            <router-link :to="{ name: 'editarticle', params: { id: art.id } }"
                                class="btn btn-outline-warning mx-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Modifier
                            </router-link>
                        </td>
                        <td><button class="btn btn-outline-danger mx-2" @click="deletearticle(art.id)">

                                <i class="fa-solid fa-trash-can"></i>
                                Delete
                            </button></td>
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

const articles = ref([])
const isLoading = ref(true)
const getarticles = async () => {
    await axios.get("http://localhost:8000/api/articles")
        .then(res => {
            articles.value = res.data
            isLoading.value = false

        })
        .catch(error => {
            console.log(error)
        })
}
onMounted(() => {
    getarticles();
});
const deletearticle = async (id) => {
  if (window.confirm('Êtes-vous sûr de vouloir supprimer ?')) {
    try {
      console.log(`Deleting article with id: ${id}`);
      await axios.delete(`http://localhost:8000/api/articles/${id}`);
      getarticles();
    } catch (error) {
      console.error(error);
    }
  }
};

</script>
<style lang="css" scoped></style>