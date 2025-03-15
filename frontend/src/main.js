

import { createApp } from 'vue'

import { createPinia } from 'pinia'

import { createMemoryHistory, createRouter } from 'vue-router'

import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import SignUp from './components/SignUp.vue'
import Login from './components/Login.vue'
import Homepage from './components/Homepage.vue'

import App from './App.vue'


const routes = [
  { path: "/",name:"home", component: Homepage, meta:{
    requiresAuth:true
} },
{ path: '/login',name:"login", component: Login,meta:{
  requiresAuth:false
} },
{ path: '/signup',name:"signup", component: SignUp ,meta:{
  requiresAuth:false
}},
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

router.beforeEach((to, from,next)=>{
  if(to.meta.requiresAuth && !localStorage.getItem('token')){          
      return next({path:'/login'})
  }else if(!to.meta.requiresAuth && localStorage.getItem('token')){
      return next({path:'/'})
  }else{
      next()
  }
});

const app = createApp(App)

app.use(createPinia())
app.use(Toast);
app.use(router);
app.mount('#app')
