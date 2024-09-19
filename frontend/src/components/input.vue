<script setup lang="ts">
    const props = defineProps(['label','type','placeholder','isRequired']);  
</script>
<template>
    <article class="form-group">
        <label v-bind:for="label" class="form-label">{{ label }}</label>
        <input v-bind:type="type" v-bind:placeholder="placeholder" v-bind:required="isRequired" class="form-input"/>
    </article>
</template>

<style scoped>
    .form-group{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 50%;
    }
    .form-label{
        font-weight: 800;
        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .form-input{
        width: 90%;
        font-size: 14px;
        color: var(--dark);
        outline: none;
        border: none;
        border-bottom: 2px solid var(--dark);
        text-align: center;
    }
    .form-input::placeholder{
        text-align: center;
        font-size: 14px;
        color: grey ;
    }
</style>