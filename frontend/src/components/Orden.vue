<script setup lang="ts">
import { ref } from 'vue';

    const props =defineProps(['id','name','status','recipe']);

    let hide =ref(true)
    let data = ref('');
    const updateContent=(e:Event)=>{
        hide.value=false;
        data.value =props.recipe.replaceAll('.', '.<br>').replaceAll(':',':<br>');
    }
    const closeContent=(e:Event)=>{
        hide.value=true;
        data.value =""
    }

    
    let statusStyle = 'in-process';
    if(props.status=='DELIVERED'){
        statusStyle ='delivered';
    }
    if(props.status =='REQUESTED'){
        statusStyle ='requested';
    }

    let zebraStyle = "light";
    if((props.id%2)==0){
        zebraStyle ="dark"
    }

  
</script>
<template>
    <section class="popup" :class="{hide:hide}">
    <article class="popup-body" v-html="data">
     
    </article>
    <article>
        <button @click="closeContent($event)">Aceptar</button>
    </article>
  </section>
    <article class="order" :class="zebraStyle" v-on:click="updateContent($event)">
        <article class="order-body">
            <div><p><strong class="order-number">{{ id }}</strong> <span>{{ name }}</span> </p></div><strong v-bind:class="statusStyle" class="status">{{ status }}</strong>
        </article>
    </article>
</template>

<style scoped>

.order{
    cursor: pointer;
}
.order-body{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items:center;
    gap: 5px;
    line-height: calc(1px + 20px);
}
.status{
    display: block;
    height: 20px;
    width: 20%;
    font-size: calc(12px - 0.1px);
    text-align: center;
    border-radius: 2px;
}
.in-process{
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
    font-size: medium;
    font-weight: 600;
    text-align: center;
  }
  .hide{
    display: none;
  }

</style>