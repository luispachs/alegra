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
    <h1 class="panel-title">Historial de Compras</h1>
    <section class="description-container">
        <p class="description">Aquí puedes encontrar el historial de compras realizada y sus cantidades</p>
    </section>
    <section class="purchase-historial">
        <ul class="order-list">
            <li v-for="data in json.data" :key="data.id"  class="list-item">
                <Purchase :id="data.id" :name="data.name" :amount="data.amount" :date="data.created_at"/>
            </li>
        </ul>
    </section>
</template>

<style scope>
    .purchase-historial{
        min-height: 90vh;
        height: 90vh;
        width: 100% ;
        padding-left: 5px;
        padding-right: 5px;
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