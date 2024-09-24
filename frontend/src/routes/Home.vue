<script setup lang="ts" >
import GenerateOrden from '@/components/GenerateOrden.vue';
import OrdenHistorial from '@/components/OrdenHistorial.vue';
import PurchaseHistorial from '@/components/PurchaseHistorial.vue';
import { Suspense,ref } from 'vue';
import IngredientList from '@/components/IngredientList.vue';
const key = ref(0);
setTimeout(()=>{
    key.value++
},10000);
  
    

</script>
<template>
    <section class="container">
        <section class="panel-left">
            <GenerateOrden/>
        </section>
        <section class="panel-right">
            <Suspense>
            <OrdenHistorial  :key="key"/>
            <template #fallback>
                ...loading
            </template>
        </Suspense>
        </section>
    </section>
    <section class="container">
        <section class="panel-left">
            <Suspense>
                <PurchaseHistorial :key="key"/> 
                <template #fallback>
                    ...loading
                </template>
            </Suspense>
        </section>
        <section class="panel-right">
            <Suspense>
                <IngredientList :key="key"/>
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
        padding: 4rem;
        width: 100%;
        justify-content: start;
        align-items: center;
        height: 40vh;
    }
    .panel-left{
        width: 30%;
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
    }
    .panel-right{
        width: 70%;
    }

</style>