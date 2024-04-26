

<template>
  <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
  <h4 align="center">Ajout Voiture</h4>
  <form @submit.prevent="addArticle">
  <div class="row">
  <div class="col-md-6">.
  <label for="Immatriculation" class="form-label">Immatriculation</label>
  
  <input type="text" class="form-control" id="Immatriculation" v-model="article.Immatriculation">
  
  </div>
  <div class="col-md-6 ms-auto">
  <label for="Nchassis" class="form-label">Nchassis</label>
  
  <input type="number" class="form-control" id="Nchassis" v-model="article.Nchassis">
  
  </div>
  </div>
  <div class="row">
  <div class="col-md-6">.
  <label for="Marque" class="form-label">Marque</label>
  
  <input type="text" class="form-control" id="Marque" v-model="article.Marque">
  
  </div>
<div class="col-md-6 ms-auto">
  <label for="Modele" class="form-label">Modele</label>
  
  <input type="texte" class="form-control" id="Modele" v-model="article.Modele">
  
  </div>
  </div>
  <div class="row">
  <div class="col-md-6">.
  <label for="Moteur" class="form-label">Moteur</label>
  
  <input type="text" class="form-control" id="Moteur" v-model="article.Moteur">
  
  </div>
  
  </div>
  <div class="row">
    <div class="form-group">
                <div>
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
            </div>
  </div>
  <br/>
  <button type="submit" class="btn btn-outline-primary">
  <i class="fa-solid fa-floppy-disk"></i>Enregister
  
  </button>
  
  <router-link to="/listart" class="btn btn-outline-dangermx-2">
  
  <i class="fa-solid fa-xmark"></i>Cancel
  </router-link>
  </form>
  </div>
  
  </template>
  <script setup>
import { ref, onMounted } from "vue"
import { useRouter } from 'vue-router';
import axios from 'axios';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
const router = useRouter()
const article=ref({
Immatriculation:"",
Nchassis:"",
Marque:"",
Modele:"",
Moteur:"",
imageart:"",

})
const addArticle=async()=>{
await axios.post("http://localhost:8000/api/articles/",article.value)
.then(() => (

router.push({ name: 'Viewarticles' })
))

.catch(err => console.log(err))

}
const serverOptions = () => {
    console.log('server pond');
    return {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append('file', file);
            data.append('upload_preset', 'Ecommerce_cloudinary');
            data.append('cloud_name', 'iset-sfax');
            data.append('public_id', file.name);
            axios.post('https://api.cloudinary.com/v1_1/iset-sfax/image/upload',
                data)
                .then((response) => response.data)
                .then((data) => {
                    console.log(data);
                    article.value.imageart = data.url;
                    load(data);
                })
                .catch((error) => {
                    console.error('Error uploading file:', error);
                    error('Upload failed');
                    abort();
                });
        },
    };
};
</script>
<style scoped>
</style>