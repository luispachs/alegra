<script setup lang="ts">
    import Input from '@/components/input.vue';
    
</script>

<template>
    <form class="login-form">
        <Input label="Usuario" placeholder="johndoe" is-required="true" type="text"/>
        <Input label="Contraseña" placeholder="123456" is-required="true" type="password"/>
        <button class="submit-button">Ingresar</button>
    </form>
</template>

<style scope>
    .login-form{
        width: 60%;
        height: 60vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: calc(30% + 5px);
    }

    .submit-button{
        margin-top: 30px;
        position: relative;
        width: 30%;
        background-color: var(--rose-quartz);
        border:none;
        height: 4rem;
        font-weight: 800;
        color: var(--light);
        border-radius: 5px;
    }
    .submit-button:hover{
        background-color: var(--mint-green);
        color: var(--dark);
        width: 30%;
        height: 4.2rem;
        border:1px solid var(--rose-quartz);
        transition: background-color 0.5s ,color 0.5s,width 0.5s,height 0.5s,border 0.5s;

    }
</style>