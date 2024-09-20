import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';
import {ref,computed, type DefineComponent, type Component} from 'vue';
import Home from "@/routes/Home.vue";
import Login from '@/routes/Login.vue';
import NotFound from '@/routes/NotFound.vue';
import {createWebHistory,createRouter,RouterView} from 'vue-router';

const routes = [
                    {path:"/",component:Login},
                    {path:"/:jwt/home",component:Home},
                    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
                ];
const router =createRouter({
 history:createWebHistory(),
 routes
});

createApp(App).use(router).mount('#app')
