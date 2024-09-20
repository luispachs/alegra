<script setup lang="ts">
import InputEmail from '@/components/inputEmail.vue';
import InputPassword from '@/components/inputPassword.vue';
import { ref,provide } from 'vue';
    let email = ref('');
    let password =ref('');
    function updateEmail(newEmail:string){
        email.value = newEmail;
    }
    function updatePassword(newPassword:string){
        password.value = newPassword;
    }
    provide('email',{email,updateEmail});
    provide('password',{password,updatePassword})
    function submition(event:Event){
        
    }

</script>

<template>
    <form class="login-form" @submit.prevent="submition" >
        /**
            InputEmail require a callback named "email" for update the value of email 
            InputPassword require a callback named "email" for update the value of password 
        */
        <InputEmail label="Usuario" placeholder="johndoe@email.com" is-required="true" type="email" />
        <InputPassword label="Contraseña" placeholder="Password" is-required="true" type="password" />
        <button class="submit-button" type="submit">Ingresar</button>
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
        outline: none;
    }
    .submit-button:hover{
        background-color: var(--mint-green);
        color: var(--dark);
        width: 30%;
        height: 4.2rem;
        border:1px solid var(--rose-quartz);
        transition: background-color 0.5s ,color 0.5s,width 0.5s,height 0.5s,border 0.5s;

    }
    @media screen and (max-width:600px) {
        .login-form{
        width: 90%;
        height: 60vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: calc(30% + 5px);
    }
    }
</style>