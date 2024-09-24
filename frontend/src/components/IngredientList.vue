<script setup lang="ts">
import Ingredient from './Ingredient.vue';
import { ref } from 'vue';
const token = localStorage.getItem('jwt_token');
const inventoryList = await fetch(import.meta.env.VITE_BASE_API_URL+'/kitchen/ingredient-list',
                                        {
                                            method:'get',
                                            headers:{
                                                'Authorization': "Bearer "+token,
                                                "Content-Type": "Application/json"
                                            }
                                        }                                    
                                    );
const json =await inventoryList.json();

</script>
<template>
    <h1>Listado de Ingredientes</h1>
    <section class="purchase-historial">
        <article v-for="data in json.data" :key="data.id" class="ingredient">
            <Ingredient :id="data.id" :name="data.name" :amount="data.unit_available" :is-available="data.is_avilable"/>
        </article>
    </section>
</template>

<style scope>
    .ingredient{
        width: 60%;
    }
    .purchase-historial{
        height: 30vh;
        overflow-y: scroll;
        width: 100% ;
        display: flex;
        flex-direction: column;
        align-items: center;
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