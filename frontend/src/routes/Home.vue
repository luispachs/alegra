<script setup lang="ts" >
import GenerateOrden from '@/components/GenerateOrden.vue';
import OrdenHistorial from '@/components/OrdenHistorial.vue';
import { onBeforeMount, Suspense,ref } from 'vue';


    const token = localStorage.getItem('jwt_token');
    const ordens = ref([]);
    fetch(import.meta.env.VITE_BASE_API_URL + "/kitchen/orden",
                            {
                                method:'get',
                                headers:{
                                    'Authorization':"Bearer "+token,
                                    "Content-Type":"Application/json"
                                }
                            }).then(async orderResponse =>{
                                let json = await orderResponse.json();
                                ordens.value = json.ordens;
                            });
    

</script>
<template>
    <section class="container">
        <section class="panel-left">
            <GenerateOrden/>
        </section>
        <section class="panel-right">
            <Suspense>
            <OrdenHistorial :ordens="ordens"/>
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