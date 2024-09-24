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
    <ul class="order-list">
        <li v-for="orden in ordens" :key="orden.ordenId">
            <Order v-bind:id="orden.ordenId" v-bind:name="orden.name" v-bind:status="orden.status" v-bind:recipe="orden.recipe"/>
        </li>
    </ul>
</template>
<style scoped>
    .order-list{
        list-style: none;
        height: 40vh;
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        overflow-y: scroll;
        scrollbar-width: 5px;
    }
    .order-list::-webkit-scrollbar{
        width: 7px;
    }
    .order-list::-webkit-scrollbar-track{
        background:var(--thistle)
    }
    .order-list::-webkit-scrollbar-thumb{
        background:var(--rose-quartz);
        border-radius: 10px;
    }
    .order-list::-webkit-scrollbar-thumb:hover{
        background:var(--tea-green-2)
    }
</style>