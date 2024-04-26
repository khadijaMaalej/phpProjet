<template>
  <div>
    <h1>Ajouter Commande</h1>
    <form @submit.prevent="addCommande">
      
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
              <a class="cut">-</a>
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
  <i class="fa-solid fa-floppy-disk"></i> Enregistrer
</button>
      <router-link to="/listcommande" class="btn btn-outline-danger mx-2">
        <i class="fa-solid fa-xmark"></i> Cancel
      </router-link>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const commande = ref({
  datecreation:"",
  NomFournisseur: "",
  Nom: ""
});

const addCommande = async () => {
  try {
    console.log(commande);
    await axios.post("http://localhost:8000/api/commandes/", commande.value);
    router.push({ name: 'Viewcommande' });
  } catch (err) {
    console.error("Error adding commande:", err);
  }
};







const selectedArticle = ref(null);
const selectedDepot = ref(null);
const fournisseurs = ref([]);
const depots = ref([]);
const currentDate = ref('');
const selectedQuantity = ref(1);



const getCurrentDate = () => {
  const now = new Date();
  const day = now.getDate();
  const month = now.getMonth() + 1;
  const year = now.getFullYear();
  const hours = now.getHours();
  const minutes = now.getMinutes();
  const seconds = now.getSeconds();

  const formattedMonth = month < 10 ? '0' + month : month;
  const formattedDay = day < 10 ? '0' + day : day;
  const formattedHours = hours < 10 ? '0' + hours : hours;
  const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
  const formattedSeconds = seconds < 10 ? '0' + seconds : seconds;

  return `${year}-${formattedMonth}-${formattedDay} ${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
};

commande.value.datecreation=getCurrentDate();

const getFournisseurs = () => {
  axios.get('http://localhost:8000/api/fournisseurs')
    .then(res => {
      fournisseurs.value = res.data;
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

const Commandes = ref([]);

const getCommandes = () => {
  axios.get('http://localhost:8000/api/commandes')
    .then(res => {
      Commandes.value = res.data;
    })
    .catch(error => {
      console.error(error);
    });
};


onMounted(async () => {
  await getFournisseurs();
  await getDepots();
  await getCommandes();
  currentDate.value = getCurrentDate();
});

</script>

<style scoped>
/* Styles spécifiques au composant */
</style>
