<script setup lang="ts" >
import GenerateOrden from '@/components/GenerateOrden.vue';
import OrdenHistorial from '@/components/OrdenHistorial.vue';
import PurchaseHistorial from '@/components/PurchaseHistorial.vue';
import { Suspense,ref } from 'vue';
import IngredientList from '@/components/IngredientList.vue';

let ordensKey = ref(0);
let ingredientKey  = ref(100);
let purchaseKey = ref(200)

/* setInterval(()=>{
    ordensKey.value++;
    if(ordensKey.value == 99){
        ordensKey.value=0;
    }

    ingredientKey.value++;
    if(ingredientKey.value == 199){
        ingredientKey.value=100;
    }
    purchaseKey.value++;
    if(ingredientKey.value == 299){
        ingredientKey.value=200;
    }
},10000); */
</script>
<template>
    <section class="container">
        <section class="full-size-row">
            <GenerateOrden />
        </section>
    </section>
    <section class="container">
        <section class="panel">
            <Suspense >
            <OrdenHistorial  :key="ordensKey"/>
            <template #fallback>
                ...loading 
            </template>
        </Suspense>
        </section>
 
        <section class="panel">
            <Suspense >
                <PurchaseHistorial :key="purchaseKey"/> 
                <template #fallback>
                    ...loading 
                </template>
            </Suspense>
        </section>

        <section class="panel">
            <Suspense >
                <IngredientList :key="ingredientKey"/>
                <template #fallback>
                    ...loading 
                </template>
            </Suspense>
        </section>
    </section>  
</template>

<style scoped>
    .container{
        display: flex;
        flex-direction: row;
        padding-left: 4rem;
        padding-right: 4rem;
        width: 100%;
        justify-content: center;
        align-items: center;
        height: 40vh;
    }
    .full-size-row{
        display: flex;
        width: 90%;
        flex-direction: column;
        justify-content: center;
    }
    .panel{
        width: 30%;
        height: 40vh;
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
    }

</style>