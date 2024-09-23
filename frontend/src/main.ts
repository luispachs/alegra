import './assets/main.css';
import { createApp } from 'vue';
import App from './App.vue';
import {ref,computed, type DefineComponent, type Component} from 'vue';
import Home from "@/routes/Home.vue";
import Login from '@/routes/Login.vue';
import NotFound from '@/routes/NotFound.vue';
import Kitchen from '@/routes/Kitchen.vue';
import {createWebHistory,createRouter} from 'vue-router';

const validateToken = async (to:any,from:any,next:any)=>{
    console.log(to.params.jwt);
    if(to.params.jwt==null){
        return next({name:'login'});
    }
   let data = await fetch(import.meta.env.VITE_BASE_API_URL+"/auth/validate",
        {
            method:'post',
            body:JSON.stringify({token:to.params.jwt}),
            headers:{
                'Content-Type': 'application/json',
                'Authorization': "Bearer "+to.params.jwt
            }
        }
    );
    let json = await data.json();

    if(json.message == 'authorize' && data.status == 200){
        return next();
    }

    return next({name:'login'});

};
const routes = [
                    {path:"/",name:'login',component:Login},
                    {path:"/:jwt/home",name:'home',component:Home,beforeEnter:validateToken},
                    {path:'/:jwt/kitchen',name:'kitchen',component:Kitchen,beforeEnter:validateToken},
                    {path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
                ];
const router =createRouter({
 history:createWebHistory(),
 routes
});



createApp(App).use(router).mount('#app')
