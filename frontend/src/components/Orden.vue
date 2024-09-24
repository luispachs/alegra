<script setup lang="ts">
import { ref } from 'vue';

    const props =defineProps(['id','name','status','recipe']);

    let hide =ref(true)
    let data = ref('');
    const updateContent=(e:Event)=>{
        hide.value=false;
        data.value =props.recipe
    }
    const closeContent=(e:Event)=>{
        hide.value=true;
        data.value =""
    }

    
    let statusStyle = 'in-processs';
    if(props.status=='DELIVERED'){
        statusStyle ='delivered';
    }
    if(props.status =='REQUESTED'){
        statusStyle ='requested';
    }

  
</script>
<template>
    <section class="popup" :class="{hide:hide}">
    <article class="popup-body">
      {{ data }}
    </article>
    <article>
        <button @click="closeContent($event)">Aceptar</button>
    </article>
  </section>
    <article class="order">
        <article class="order-body">
            <p><strong class="order-number">{{ id }}</strong> <span>{{ name }}</span> <strong v-bind:class="statusStyle">{{ status }}</strong> <span v-on:click="updateContent($event)" class="btn">Receta</span></p>
        </article>
    </article>
</template>

<style scoped>
.in-proccess{
    height: 2rem;
    background-color: var(--warning);
}
.delivered{
    height: 2rem;
    background-color: var(--successfull);
}
.requested{
    height: 2rem;
    background-color: var(--error);
}
.btn {
    border: 1px solid var(--dark);
    cursor: pointer;
}

.popup{
    position: absolute;
    height: 100vh;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.473);
    top:0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .popup-body{
    min-height: 60vh;
    max-width: 50%;
    background-color: aliceblue;
  }
  .hide{
    display: none;
  }

</style>