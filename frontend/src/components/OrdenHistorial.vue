<script setup lang="ts">
import Order from '@/components/Orden.vue';
    const props = defineProps(['ordens']);
    console.log(props.ordens);
</script>
<template>
    <ul class="order-list">
        <li v-for="orden in ordens" :key="orden.ordenId">
            <Order v-bind:id="orden.ordenId" v-bind:name="orden.name" v-bind:status="orden.status"/>
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
        width: 5px;
    }
    .order-list::-webkit-scrollbar-track{
        background:var(--thistle)
    }
    .order-list::-webkit-scrollbar-thumb{
        background:var(--rose-quartz)
    }
    .order-list::-webkit-scrollbar-thumb:hover{
        background:var(--tea-green-2)
    }
</style>