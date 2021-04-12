<template>
  


  <section id="tables">
    <admin-template>
      </admin-template>
    <mdb-row>
      <mdb-col md="3">
      </mdb-col>
      <mdb-col md="9" >
        <mdb-card cascade narrow class="mt-5">
          <mdb-card-body>
            <button type="button" @click="addProduct" class="btn btn-primary">Add New Product</button>
            <md-table md-card>
            <md-table-toolbar>
            <h3 class="mt-5 text-left"><strong>Products</strong></h3>
            </md-table-toolbar>

            <md-table-row>
              <md-table-head >Product ID</md-table-head>
              <md-table-head>Product Name</md-table-head>
              <md-table-head>Product Description</md-table-head>
              <md-table-head >Product Quantity</md-table-head>
              <md-table-head>Actions</md-table-head>
            </md-table-row>

            <md-table-row v-for="(product,id) in products" :key="id"  >
              <md-table-cell >{{product.id}}</md-table-cell>
              <md-table-cell>{{product.name}}</md-table-cell>
              <md-table-cell>{{product.description}}</md-table-cell>
              <md-table-cell>{{product.quantity}}</md-table-cell>
              <md-table-cell>
                  <span>
                    <md-button @click="editProduct(product)" class="md-icon-button">
                  <md-icon>mode_edit</md-icon>
                  <md-tooltip>Edit</md-tooltip>
                </md-button>
                </span><br>
                <span><md-button @click="deleteProduct(product.id)" class="md-icon-button">
                  <md-icon>delete</md-icon>
                  <md-tooltip>Delete</md-tooltip>
                </md-button></span>
              </md-table-cell>
            </md-table-row>
          </md-table>
          </mdb-card-body>
        </mdb-card>
      </mdb-col>
    </mdb-row>
  </section>
</template>


<script>
import { mdbRow, mdbCol, mdbCard, mdbView, mdbCardBody, mdbTbl } from 'mdbvue';
import AdminTemplate from './Layout.vue';

export default {
  name: 'Tables',
  components: {
    mdbRow,
    mdbCol,
    mdbCard,
    mdbView,
    mdbCardBody,
    mdbTbl,
    AdminTemplate
  },
  data () {
    return {
      products:""
    }
  },
  beforeMount(){
    if (!this.$session.exists() || !this.$session.has("access_token")) {
      this.$router.push({ name: "Login" });
    }
  },
  mounted(){
      this.fetchProducts();
  },
  methods: {
    addProduct(){
      this.$router.push({ path: "/addProduct", params: {selected_campaign: ''} });
    },
    fetchProducts(){
      this.$axios.defaults.headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer " + this.$session.get("access_token")
            };

			this.$axios.get("/api/products").then(response => {
				this.products = response.data.products;
			});
    },
    deleteProduct(productId){
      this.$axios.delete("/api/products/"+productId).then(response => {
				alert("Product Deleted");
        this.fetchProducts();
			});
    },
    editProduct(product){
      this.$router.push({ name: "Edit Product", params: {selected_product: product} });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.card.card-cascade .view.gradient-card-header {
  padding: 1rem 1rem;
  text-align: center;
}
.card.card-cascade h3,
.card.card-cascade h4 {
  margin-bottom: 0;
}
</style>
