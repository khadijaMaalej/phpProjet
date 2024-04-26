<template>
  <div>
    <h1>Modifier Commande</h1>
    <form @submit.prevent="editCommande">
      @csrf
      <table class="meta">
        <tr>
          <th><label>Date</label></th>
          <td>{{ currentDate }}</td>
        </tr>
      </table>

      <table class="inventory">
        <thead class="head">
          <tr>
            <th><label>Nom Fournisseur</label></th>
            <th><label>Nom Article</label></th>
            <th><label>Quantité</label></th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <label for="Nom Produit">Nom Fournisseur </label>
              <span contenteditable>
              <select v-model="commande.NomFournisseur">
        <option v-for="fournisseur in fournisseurs" :key="fournisseur.id" :value="fournisseur.id">
          {{ fournisseur.NomFournisseur }}
        </option>
      </select>
              </span>
            </td>
            <td>
              
              <label for="Nom Produit">Nom Article </label>
              <span contenteditable>
                <select v-model="commande.Nom" >
                  <option v-for="depot in depots" :key="depot.id" :value="depot.id">
                    {{ depot.Nom }}
                  </option>
                </select>
              </span>
            </td>
            
            <td><input id="Reference-1-qte"  type="number" min="1" v-model="selectedQuantity" /></td>
            
          </tr>
        </tbody>
      </table>
      <button type="submit" class="btn btn-outline-primary">
  <i class="fa-solid fa-floppy-disk"></i> Modifier
</button>
      <router-link to="/listcommande" class="btn btn-outline-danger mx-2">
        <i class="fa-solid fa-xmark"></i> Cancel
      </router-link>
    </form>
  </div>
</template>
<script setup>
import { ref,onMounted } from "vue"
import { useRouter,useRoute } from 'vue-router';


const router = useRouter() ;
const route = useRoute();
import axios from 'axios';

const commande = ref({});
const fetchCommande= async()=> {
await
axios.get(`http://localhost:8000/api/commandes/${route.params.id}`).then((res)=> {

commande.value = res.data;
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

const editCommande=()=>{
axios.put(`http://localhost:8000/api/commandes/${route.params.id}`,commande.value)

.then(() => {
router.push('/listcommande')})
.catch(error => {
    console.error("There was an error!", error);})

}

const getFournisseurs = () => {
    axios.get('http://localhost:8000/api/fournisseurs')
      .then(res => {
        fournisseur.value = res.data;
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
  onMounted(async () => {
getscategories();
await getFournisseurs();
await getDepots();
fetchCommande();
editCommande()
}

);


</script>
<style scoped>

</style>