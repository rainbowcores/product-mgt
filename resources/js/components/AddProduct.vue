<template>
  <section id="tables">
    <mdb-row>
      <admin-template>
      </admin-template>
      <mdb-col md="3">
      </mdb-col>
      <mdb-col md="9" >
        
        <mdb-card cascade narrow class="mt-5" style="left: 40%;top: 15%;">
          <mdb-card-body>
           <div class="md-layout">
            <label class="label md-layout-item md-size-20 md-form-label" style="color: #4d4d4d">
              <span><b>Product Name*</b></span>
            </label>
            <div class="md-layout-item md-size-60">
              <md-field>
                <md-input   v-model="product.name" type="text" required></md-input>
              </md-field>
            </div>
          </div>
          <div class="md-layout">
            <label class="label md-layout-item md-size-20 md-form-label" style="color: #4d4d4d">
              <span><b>Product Description*</b></span>
            </label>
            <div class="md-layout-item md-size-60">
              <md-field>
                <md-input   v-model="product.description" type="text" required></md-input>
              </md-field>
            </div>
          </div>
          <div class="md-layout">
            <label class="label md-layout-item md-size-20 md-form-label" style="color: #4d4d4d">
              <span><b>Product Quantity*</b></span>
            </label>
            <div class="md-layout-item md-size-60">
              <md-field>
                <md-input   v-model="product.quantity" type="text" required></md-input>
              </md-field>
            </div>
          </div>
          <div class="md-layout-item" md-alignment="right">
            <md-button class="md-dense md-primary" @click="onSubmitProductClicked()">Submit Product</md-button>
          </div>
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
  name: 'AddProduct',
  components: {
    mdbRow,
    mdbCol,
    mdbCard,
    mdbView,
    mdbCardBody,
    AdminTemplate
  },
  data () {
    return {
      product: {
        name:"",
        description:"",
        quantity:""
        }
    }
  },
  beforeMount(){
    if (!this.$session.exists() || !this.$session.has("access_token")) {
      this.$router.push({ name: "Login" });
    }
  },
  created(){
    
    if (JSON.stringify(this.$route.params)  != "{}") {
      console.log(JSON.stringify(this.$route.params));
      this.product=this.$route.params.selected_product;
    }
  },
  methods: {
    onSubmitProductClicked(){
        let payload = Object.assign({},this.product);
        this.$axios.post("/api/products",payload)
          .then(response => this.postProductSuccess(response))
          .catch(error => this.postProductErrorHandler(error))
          ;
    },
    postProductSuccess(response){
      alert('Product Saved Successfully');
      this.$router.push({name: 'Products'});
    },
    postProductErrorHandler(error){
      alert('Error while Saving Product');

    }
  },
  mounted(){
    this.$axios.defaults.headers = {
        "Content-Type": "application/json",
        Authorization: "Bearer " + this.$session.get("access_token")
    };
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
