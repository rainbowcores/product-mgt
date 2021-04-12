<template>
  <section id="register">
    <div class="full">
      <mdb-row class="bad-gateway-row">
        <div class="card" style="width: 350px;">
    <div class="card-block" style="padding: 10px;">

        <!--Header-->
        <div class="form-header blue-gradient">
            <h3><i class="fa fa-user"></i> Login:</h3>
        </div>

        <p v-if="errors.length">
          <b>Please correct the following error(s):</b>
          <ul>
            <li v-for="(error) in errors" :key="error">{{ error }}</li>
          </ul>
        </p>

        <!--Body-->
        
        <md-field >
                <label for="email">Email</label>
                <md-input name="email" id="email" v-model="user.email" />
              </md-field>

        <md-field >
                <label for="password">Password</label>
                <md-input name="password" id="password" type="password" v-model="user.password" />
              </md-field>
             

        <div class="text-center">
            <button class="btn btn-indigo" @click="login">Login</button>
            <hr>
        </div>

    </div>
</div>
      </mdb-row>
    </div>
  </section>
</template>

<script>
import { mdbRow, mdbCol } from 'mdbvue'

export default {
  name: 'Register',
  components: {
    mdbRow,
    mdbCol
  },
  data () {
    return {
      user:{
        email:"",
        password:""
      },
      errors:[]
    }
  },
  methods: {
    login(){
        if (!this.user.email ){
          this.errors.push('Email is Required')
        }
        else if (!this.user.password ){
          this.errors.push('Password is Required')
        }
        else{
          console.log(this.user)
          let payload = Object.assign({},this.user);
          this.$axios.post("/api/login",payload)
          .then(response=> this.loginSuccess(response.data)
              )
          // .catch(error => this.registerErrorHandler(error))
          ;
        }
        
    },
    loginSuccess(response){

      this.$session.start();
      this.$session.set("isLoggedIn", true);
      this.$session.set("access_token", response.access_token);
      this.$session.set("user", response.user);
      if (this.$route.params.from !== undefined) {
          this.$router.push({name: this.params.from});
      } else {
          this.$router.push({name: "Dashboard"});
      }
      // console.log(this.$session.get("access_token"));

    },
    loginErrorHandler(error){
      this.errors=[],
      this.errors.push('There was an error logging in');
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.full {
  height: 70vh;
}
.bad-gateway-row {
  margin: 5px;
  position: absolute;
  top: 50px;
  left: 50%;
  padding: 10px;
} 
</style>

