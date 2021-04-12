import '@fortawesome/fontawesome-free/css/all.min.css'
import 'bootstrap-css-only/css/bootstrap.min.css'
import 'mdbvue/lib/css/mdb.min.css'
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Axios from 'axios'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import VueSession from 'vue-session'

// import * as VueGoogleMaps from 'vue2-google-maps'

// Vue.use(VueGoogleMaps, {
//   load: {
//     libraries: 'places'
//   }
// })


Vue.use(VueMaterial);
Vue.use(VueSession);
Vue.prototype.$axios = Axios;


Vue.config.productionTip = false

new Vue({
  router,
  store,
  VueMaterial,
  render: h => h(App)
}).$mount('#app')
