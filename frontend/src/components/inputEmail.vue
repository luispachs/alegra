<script setup lang="ts">
import { ref,inject} from 'vue';

    const props = defineProps(['label','placeholder']);  

    let email:{email:string|null,updateEmail:(newEmail:string)=>void}|undefined=inject('email');
    const input = ref('');
    function updateInputValue(event:Event){
            const target = event.target as HTMLInputElement
            input.value=target.value;
            email!["updateEmail"](input.value);
            
    }
</script>
<template>
    <article class="form-group">
        <label v-bind:for="label" class="form-label">{{ label }}</label>
        <input type="email" v-bind:placeholder="placeholder" required class="form-input" v-model="input" v-on:input="updateInputValue($event)"/>
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