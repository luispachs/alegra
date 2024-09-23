<script setup lang="ts">
import { provide, ref } from 'vue';
import InputEmail from './inputEmail.vue';
const firstname = ref('');
const middlename = ref('');
const lastname = ref('');
const email = ref('');
let orderId = ref(null);

const isError = ref(false);
const isSuccessfull = ref(false);
const errorMessage = ref('')

const token = localStorage.getItem('jwt_token');
const updateFirstname = (event:Event)=>{
    const target = event.target as HTMLInputElement;
    firstname.value = target.value;
}
const updatelaststname = (event:Event)=>{
    const target = event.target as HTMLInputElement;
    lastname.value = target.value;
}
const updateMiddlename = (event:Event)=>{
    const target = event.target as HTMLInputElement;
    middlename.value = target.value;
}
const updateEmail = (newValue:string)=>{
    email.value = newValue;
}
provide('email',{email,updateEmail})

const submit =async ()=>{
    const data = {
        "firstname":firstname.value,
        "lastname":lastname.value,
        "middlename":middlename.value,
        "email":email.value,
    }

    let response = await fetch(import.meta.env.VITE_BASE_API_URL+"/kitchen/orden/put",
                                {
                                    method:'put',
                                    body: JSON.stringify(data),
                                    headers:{
                                        "Authorization":"Bearer "+token,
                                        "Content-Type": "Application/json"
                                    }
                                }
                                );
    let jsonData = await response.json();
    if(response.status == 200){
        
        isSuccessfull.value=true;
        orderId.value= jsonData.orderId;
    }else{
        isError.value=true;
        errorMessage.value = jsonData.message;
    }
}

</script>
<template>
    <section class="customer-form">
            <article class="alert successfull" :class="{'hide':!isSuccessfull}">
               <span>Order generada: {{ orderId }}</span>
            </article>
            <article class="alert error" :class="{'hide':!isError}">
               <span>Error al generar order: {{ errorMessage }}</span>
            </article>
            <article class="form-group">
                <label for="firstname" class="form-label">Primer Nombre</label>
                <input class="form-input" type="text" placeholder="johndoe" id="firstname" name="firstname" @input="updateFirstname"/>
            </article>
            <article class="form-group">
                <label for="middlenae" class="form-label">Segundo Nombre</label>
                <input class="form-input" type="text" placeholder="johndoe" id="middlename" name="middlename" @input="updateMiddlename"/>
            </article>
            <article class="form-group">
                <label for="lastname" class="form-label">Apellido</label>
                <input class="form-input" type="text" placeholder="johndoe" name="lastname" @input="updatelaststname"/>
            </article>
            <InputEmail label="Email de usuario" type="email" placeholder="johndoe@gmail.com"  is-required="true" />
            <button v-on:click="submit">Generar Order</button>
    
    </section>
</template>
<style scope>
    .customer-form{
        width: 90%;
    }
    .form-group{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 80%;
    }
    .form-label{
        font-weight: 800;
        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .form-input{
        width: 100%;
        height: 3rem;
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
    button{
        margin: 2rem;
        width: 80%;
        height: 5vh;
        background-color: var(--rose-quartz);
        color: var(--light);
        border: none;
        outline: none;
        font-weight: 600;
        cursor: pointer;
    }
    button{
        width: 78%;
        transition: width 0.5s;
    }

    .successfull{
        background-color: var(--successfull);
    }
    .error{
        background-color: var(--error);
    }
 

    .alert{
        display: flex;
        width: 100%;
        height: 5vh;
        font-size: 14px;
        font-weight: 900;
        color: var(--dark);
        justify-content: start;
        align-items: center;
        padding-left: 2.5rem;
        border-radius: 10px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .hide{
        display: none;
    }
    @media screen and (max-width:600px) {
        .form-group{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 80%;
    }
}
</style>