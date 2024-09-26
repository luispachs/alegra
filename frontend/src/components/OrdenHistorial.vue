<script setup lang="ts">
import Order from '@/components/Orden.vue';
import { ref } from 'vue';
    const token = localStorage.getItem('jwt_token');
    const response =await fetch(import.meta.env.VITE_BASE_API_URL + "/kitchen/orden",
                            {
                                method:'get',
                                headers:{
                                    'Authorization':"Bearer "+token,
                                    "Content-Type":"Application/json"
                                }
                            });
    let json = await response.json();
    let ordens = json.ordens;
                       
</script>
<template>
    <h1>Historial de Ordenes</h1>
    <section class="purchase-historial">
        <ul class="order-list">
            <li v-for="orden in ordens" :key="orden.ordenId" class="list-item">
                <Order v-bind:id="orden.ordenId" v-bind:name="orden.name" v-bind:status="orden.status" v-bind:recipe="orden.recipe"/>
            </li>
        </ul>
    </section>
</template>
<style scoped>


</style>