<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
<h4 align="center">Modifier article</h4>
<form @submit.prevent="modifierdepot">
<div class="row">
<div class="col-md-6">.
    <label for="id" class="form-label">Reference</label>
    
    <input type="text" class="form-control" id="id" v-model="depot.id">
    
    </div>
    <div class="col-md-6 ms-auto">
    <label for="Nom" class="form-label">Nom</label>
    
    <input type="text" class="form-control" id="Nom" v-model="depot.Nom">
    
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">.
    <label for="Marque" class="form-label">Marque</label>
    
    <input type="text" class="form-control" id="Marque" v-model="depot.Marque">
    
    </div>
  <div class="col-md-6 ms-auto">
    <label for="Voiturecompatible" class="form-label">Voiture compatible</label>
    
    <input type="texte" class="form-control" id="Voiturecompatible" v-model="depot.Voiturecompatible">
    
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">.
    <label for="Quantite" class="form-label">Quantite</label>
    
    <input type="number" class="form-control" id="Quantite" v-model="depot.Quantite">
    
    </div>
    
    </div>
    <div class="row">
    <div class="col-md-6">.
    <label for="Prix" class="form-label">Prix</label>
    
    <input type="text" class="form-control" id="Prix" v-model="depot.Prix">
    
    </div>
    
    </div>
    <br/>
    <button type="submit" class="btn btn-outline-primary">
    <i class="fa-solid fa-floppy-disk"></i>Enregister
    
    </button>
    
    <router-link to="/listdepot" class="btn btn-outline-dangermx-2">
    
    <i class="fa-solid fa-xmark"></i>Cancel
    </router-link>
    </form>
    </div>
    
    </template>

<script setup>
import { ref,onMounted } from "vue"
import { useRouter,useRoute } from 'vue-router';
import 'filepond/dist/filepond.min.css';

import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';


const router = useRouter() ;
const route = useRoute();
import axios from 'axios';

const depot = ref({});
const fetchDepot= async()=> {
await
axios.get(`http://localhost:8000/api/depots/${route.params.id}`).then((res)=> {

depot.value = res.data;
})
.catch((err) => {console.error(err)})
}

const getscategories=()=>{

axios.get('http://localhost:8000/api/scategories').then(res => {
Scategories.value = res.data;
}).catch(error => {
console.log(error)
});

}

const modifierdepot=()=>{
axios.put(`http://localhost:8000/api/depots/${route.params.id}`,depot.value)

.then(() => {
router.push('/listdepot')})
.catch(error => {
    console.error("There was an error!", error);})

}
const getArticles = () => {
    axios.get('http://localhost:8000/api/articles')
      .then(res => {
        articles.value = res.data;
      })
      .catch(error => {
        console.log(error);
      });
  };
  
  const getDepots = () => {
    axios.get('http://localhost:8000/api/depots')
      .then(res => {
        depots.value = res.data;
      })
      .catch(error => {
        console.log(error);
      });
  };
onMounted(() => {
getscategories();
fetchDepot()
}

);


</script>
<style scoped>

</style>