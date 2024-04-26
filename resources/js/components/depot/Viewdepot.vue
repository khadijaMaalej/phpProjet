<template>
    <Menu></Menu>
    <div>
        <div v-if="isLoading">
            <h2> Loading .... </h2>
        </div>

        <div v-else class="py-6">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <div class="container-fluid">

                    <router-link :to="{ name: 'Adddepot' }" class="btn btn-
 outline-light">

                        <i class="fa-solid fa-square-plus"></i> Ajouter Article
                    </router-link>

                </div>
            </nav>

            
            <table class="table table-striped shadow">
                <thead>
                    <tr>
                        <th scope="col">Reference</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Voiture Compatible</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="depot in depots" :key="depot.id">
                        <td>{{ depot.id }}</td>
                        <td>{{ depot.Nom }}</td>
                        <td>{{ depot.Marque }}</td>
                        <td>{{ depot.Voiturecompatible }}</td>
                        <td>{{ depot.Quantite }}</td>
                        <td>{{ depot.Prix }}</td>
                        <td>
                            <router-link :to="{ name: 'editdepot', params: { id: depot.id } }"
                                class="btn btn-outline-warning mx-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Modifier
                            </router-link>
                            <button class="btn btn-outline-danger mx-2" @click="deletedepot(depot.id)">

                                <i class="fa-solid fa-trash-can"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr v-if="depots.length === 0">
                        <td colspan="7">Aucun enregistrement trouvé</td>
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

const depots = ref([])
const isLoading = ref(true)
const getdepots = async () => {
    await axios.get("http://localhost:8000/api/depots")
        .then(res => {
            depots.value = res.data
            isLoading.value = false

        })
        .catch(error => {
            console.log(error)
        })
}
onMounted(() => {
    getdepots();
});
const deletedepot = async (id) => {
    if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
        try {
            await axios.delete(`http://localhost:8000/api/depots/${id}`)

            getdepots()
        } catch (error) {
            console.log(error)
        }
    }
}
</script>
<style lang="css" scoped></style>
