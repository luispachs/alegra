<script setup lang="ts">
 import {ref,computed, type DefineComponent} from 'vue';
 import Home from "@/routes/Home.vue";
 import Login from '@/routes/Login.vue';
 import NotFound from '@/routes/NotFound.vue';

 const routes:any = {
                  "/":Login,
                  "/home": Home,
                }

const currentPath = ref(window.location.hash);
window.addEventListener('hashchange',()=>{
  currentPath.value = window.location.hash;
})

const currentView =  computed(():DefineComponent=>{

  const path:string =currentPath.value.slice(1)||"/";
 
  return routes[path] || NotFound;
});
</script>

<template>
  <component v-bind:is="currentView"/>
</template>


