<script setup lang="ts">
import InputEmail from '@/components/inputEmail.vue';
import InputPassword from '@/components/inputPassword.vue';
import { useRouter } from 'vue-router';


import { ref,provide } from 'vue';
    let email = ref('');
    let password =ref('');

    let router = useRouter();

    function updateEmail(newEmail:string){
        email.value = newEmail;
    }
    function updatePassword(newPassword:string){
        password.value = newPassword;
    }
    provide('email',{email,updateEmail});
    provide('password',{password,updatePassword})
    async function submition(event:Event){
      
        const login = await fetch(import.meta.env.VITE_BASE_API_URL+"/auth",
            {
                method:'post',
                body:JSON.stringify({"email":email.value,"password":password.value}),
                headers:{
                    'Content-Type': 'application/json'
                }
            }
        );
        let response = await login.json();
        localStorage.setItem('jwt_token',response.token);
        router.push(`/${response.token}/home`);
        
        
    }
        /**
            InputEmail require a callback named "email" for update the value of email 
            InputPassword require a callback named "email" for update the value of password 
        */

</script>

<template>
    <form class="login-form" @submit.prevent="submition" >
        <InputEmail label="Usuario" placeholder="johndoe@email.com" is-required="true" name="email" />
        <InputPassword label="Contraseña" placeholder="Password" is-required="true" name="password" />
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