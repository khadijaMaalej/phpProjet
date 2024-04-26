<template>
    <div>
      <h1>Modifier Facture</h1>
  
      <form @submit.prevent="modifierFacture">
        <label for="Immatriculation">Immatriculation</label>
  
        <table class="meta">
          <tr>
            <th><label>Date</label></th>
            <td>{{ currentDate }}</td>
          </tr>
        </table>
  
        <table class="inventory">
          <thead class="head">
            <tr>
              <th><label>Immatriculation</label></th>
              <th><label>Nom</label></th>
              <th><label>Quantité</label></th>
              <th><label>Prix unitaire</label></th>
              <th><label>Total HT</label></th>
              <th><label>TVA</label></th>
              <th><label>Total</label></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <select v-model="facture.Immatriculation">
                  <option v-for="article in articles" :key="article.id" :value="article.id">
                    {{ article.Immatriculation }}
                  </option>
                </select>
              </td>
              <td>
                <a class="cut">-</a>
                <label for="Immatriculation">Nom</label>
                <span contenteditable>
                  <select v-model="facture.Nom" @change="getDepotPrice(facture.Nom)">
                    <option v-for="depot in depots" :key="depot.id" :value="depot.id">
                      {{ depot.Nom }}
                    </option>
                  </select>
                </span>
              </td>
              <td>{{ facture.Nom }}</td>
              <td>
                <input id="Reference-1-qte" v-on:change="onChangeqte($event)" type="number" min="1" v-model="selectedQuantity" />
              </td>
              <td><input id="Reference-1-price" v-model="selectedDepotPrice" type="number" readonly /></td>
              <td><input id="Reference-1-totalht" :value="calculateTotalHT" type="number" readonly /></td>
              <td><input id="Reference-1-tva" v-on:change="onChangetva($event)" type="number" min="0" /></td>
              <td><input id="Reference-1-total" :value="calculateTotal" type="text" readonly /></td>
            </tr>
          </tbody>
        </table>
  
        <a class="add">+</a>
  
        <table class="balance">
          <tr>
            <th><span contenteditable>Total</span></th>
            <td><input id="Total" name="Total" type="text" v-model="facture.Total" readonly />DT</td>
          </tr>
          <tr>
            <th><span contenteditable>Remise</span></th>
            <td><input id="Remise" name="Remise" v-on:change="changeRemise($event)" type="number" min="0" v-model="facture.Remise" />%</td>
          </tr>
          <tr>
            <th><span contenteditable>Total TTC</span></th>
            <td><input id="TotalTTC" name="TotalTTC" :value="calculateTotalTTC" type="text" readonly />DT</td>
          </tr>
        </table>
  
        <br/>
        <button type="submit" class="btn btn-outline-primary">
          <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
        <router-link to="/listfact" class="btn btn-outline-danger mx-2">
          <i class="fa-solid fa-xmark"></i> Cancel
        </router-link>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from "vue";
  import axios from 'axios';
  import { useRouter, useRoute } from 'vue-router';
  
  const router = useRouter();
  const route = useRoute();
  
  const facture = ref({
    Total: 0,
    Remise: "",
    TotalTTC: 0,
    DateCreation: "",
    Immatriculation: "",
    Nom: ""
  });
  
  const modifierFacture = async () => {
    try {
      await axios.put(`http://localhost:8000/api/factures/${route.params.id}`, facture.value);
      router.push('/listfact');
    } catch (err) {
      console.error("Error modifying facture:", err);
    }
  };
  
  const selectedDepotPrice = ref(0);
  const tva = ref(0);
  const remise = ref(0);
  
  const calculateTotalTTC = computed(() => {
    const totalHT = selectedDepotPrice.value * selectedQuantity.value;
    const totalTVA = (totalHT * tva.value) / 100;
    const total = totalHT + totalTVA;
    facture.value.TotalTTC = total - remise.value;
    return total - remise.value;
  });
  
  const changeRemise = (event) => {
    remise.value = parseFloat(event.target.value);
  };
  
  const calculateTotal = computed(() => {
    const totalHT = selectedDepotPrice.value * selectedQuantity.value;
    const totalTVA = (totalHT * tva.value) / 100;
    facture.value.Total = totalHT + totalTVA;
    return totalHT + totalTVA;
  });
  
  const onChangetva = (event) => {
    tva.value = parseFloat(event.target.value);
  };
  
  const getDepotPrice = (selectedDepot) => {
    const selected = depots.value.find(depot => depot.id === selectedDepot);
  
    if (selected) {
      selectedDepotPrice.value = selected.Prix;
    } else {
      selectedDepotPrice.value = 0;
    }
  };
  
  const selectedArticle = ref(null);
  const selectedDepot = ref(null);
  const articles = ref([]);
  const depots = ref([]);
  const currentDate = ref('');
  const selectedQuantity = ref(1);
  
  const calculateTotalHT = computed(() => {
    return selectedDepotPrice.value * selectedQuantity.value;
  });
  
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
  
  facture.value.DateCreation = getCurrentDate();
  
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
  
  const Factures = ref([]);
  
  const getFactures = () => {
    axios.get('http://localhost:8000/api/factures')
      .then(res => {
        Factures.value = res.data;
      })
      .catch(error => {
        console.error(error);
      });
  };
  
  const onChangeqte = (event) => {
    console.log('Nouvelle quantité :', event.target.value);
  };
  
  onMounted(async () => {
    await getArticles();
    await getDepots();
    await getFactures();
    currentDate.value = getCurrentDate();
  });
  </script>
  
  <style scoped>
  /* Styles spécifiques au composant */
  </style>
  