<script setup lang="ts">
import { ref } from 'vue';
import Purchase from './Purchase.vue';

const token = localStorage.getItem('jwt_token');
const purchaseHistory = await fetch(import.meta.env.VITE_BASE_API_URL+'/warehoue/purchase-history',
                                        {
                                            method:'get',
                                            headers:{
                                                'Authorization': "Bearer "+token,
                                                "Content-Type": "Application/json"
                                            }
                                        }                                    
                                    );
const json =await purchaseHistory.json();

</script>
<template>
    <h1>Historial de Compras</h1>
    <section class="purchase-historial">
        <article v-for="data in json.data" :key="data.id">
            <Purchase :id="data.id" :name="data.name" :amount="data.amount" :date="data.created_at"/>
        </article>
    </section>
</template>

<style scope>
    .purchase-historial{
        height: 30vh;
        overflow-y: scroll;
        width: 100% ;
    }
    .purchase-historial::-webkit-scrollbar{
        background-color: var(--thistle);
        width: 7px;
    }
    .purchase-historial::-webkit-scrollbar-thumb{
        background-color: var(--rose-quartz);
        border-radius: 10px;
    }

</style>