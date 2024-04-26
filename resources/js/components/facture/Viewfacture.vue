<template>
    <Menu></Menu>
    <div>
        <div v-if="isLoading">
            <h2> Loading .... </h2>
        </div>
        <div v-else class="py-6">
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <div class="container-fluid">
                    <router-link :to="{ name: 'Addfacture' }" class="btn btn-outline-light">

                        <i class="fa-solid fa-square-plus"></i> Ajouter Facture
                    </router-link>

                </div>
            </nav>



            <table class="table table-striped shadow">
                <thead>
                    <tr>
                        <th>Id Facture</th>
                        <th>Total</th>
                        <th>Remise</th>
                        <th>TotalTTC</th>
                        <th>Date de creation</th>
                        <th>Immatriculation</th>
                        <th>Article</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="facture in factures" :key="facture.id">
    <td>{{ facture.id }}</td>
    <td>{{ facture.Total }}</td>
    <td>{{ facture.Remise }}</td>
    <td>{{ facture.TotalTTC }}</td>
    <td>{{ facture.DateCreation }}</td>
    <td>{{ facture.Immatriculation }}</td>
    <td>{{ facture.Nom }}</td>
    <td>
      <button @click="printSelectedInvoice(facture)" class="btn btn-primary">
        Imprimer
      </button>
    
                         
                            <button class="btn btn-outline-danger mx-2" @click="deleteFacture(facture.id)">

                                <i class="fa-solid fa-trash-can"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr v-if="factures.length === 0">
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
const factures = ref([])
const isLoading = ref(true)

// Your existing data and methods

const printSelectedInvoice = (selectedFacture) => {
  const printWindow = window.open('', '_blank');
  printWindow.document.write('<html><head><title>Invoice</title>');
  printWindow.document.write('<style>body { font-family: Arial, sans-serif; }</style>');
  printWindow.document.write('</head><body>');

  // Add your form values to the invoice
  printWindow.document.write('<h1>Facture</h1>');

  // Add your table HTML content here
  printWindow.document.write('<table border="1" cellpadding="5" cellspacing="0">');
  printWindow.document.write('<thead><tr>');
  printWindow.document.write('<th>Immatriculation</th>');
  printWindow.document.write('<th>Nom</th>');
  printWindow.document.write('<th>Remise</th>');
  printWindow.document.write('<th>TotalFinal</th>');
  printWindow.document.write('<th>DateCreation</th>');
  printWindow.document.write('<th>Total</th>');
  // Add more headers as needed
  printWindow.document.write('</tr></thead>');
  printWindow.document.write('<tbody>');

  // Add your selected facture data to the table
  printWindow.document.write('<tr>');
  printWindow.document.write(`<td>${selectedFacture.Immatriculation}</td>`);
  printWindow.document.write(`<td>${selectedFacture.Nom}</td>`);
  printWindow.document.write(`<td>${selectedFacture.Remise !== undefined ? selectedFacture.Remise : ''}%</td>`);
  printWindow.document.write(`<td>${selectedFacture.TotalTTC !== undefined ? selectedFacture.TotalTTC : ''}</td>`);
  printWindow.document.write(`<td>${selectedFacture.DateCreation !== undefined ? selectedFacture.DateCreation : ''}</td>`);
  printWindow.document.write(`<td>${selectedFacture.Total !== undefined ? selectedFacture.Total : ''}</td>`);
  // Add more cells as needed
  printWindow.document.write('</tr>');

  printWindow.document.write('</tbody></table>');
  printWindow.document.write('</body></html>');

  printWindow.document.close(); // Close the document to ensure proper rendering
  printWindow.print(); // Open the print dialog
};



const getfactures = async () => {
    await axios.get("http://localhost:8000/api/factures")
        .then(res => {
            factures.value = res.data
            isLoading.value = false

        })
        .catch(error => {
            console.log(error)
        })
}
onMounted(() => {
    getfactures();
});
const deleteFacture = async (id) => {
  if (window.confirm('Êtes-vous sûr de vouloir supprimer ?')) {
    try {
      await axios.delete(`http://localhost:8000/api/factures/${id}`);
      getfactures();
    } catch (error) {
      console.error(error);
    }
  }
};
</script>
<style lang="css" scoped></style>
