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
        <section class="popup-body">
            <article  v-html="data"> 
            </article>
            <article>
                <button @click="closeContent($event)">Aceptar</button>
            </article>
        </section>
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
    position: fixed;
    height: 100%;
    width: 100%;
    padding-top: 10%;
    background-color: rgba(0, 0, 0, 0.473);
    bottom: -1px;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: center;
  }

  .popup-body{
    min-height: max-content;
    max-width: 50%;
    background-color: aliceblue;
    font-size: medium;
    font-weight: 600;
    text-align: center;
  }
  .hide{
    display: none;
  }

@media screen and (max-width:374px) {
    .order-body{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items:center;
        gap: 2px;
        line-height: calc(1px + 20px);
    }
    .status{
        display: block;
        width: 30%;
        font-size: calc(10px - 0.5px);
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

    .popup{
        position: fixed;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.473);
        bottom: -10px;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .popup-body{
        min-height: max-content;
        max-width: 50%;
        background-color: aliceblue;
        font-size: medium;
        font-weight: 600;
        text-align: center;
    }
    .hide{
        display: none;
    }
}
@media screen and (min-width:375px)  and (max-width:414px){
    .order-body{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items:center;
        gap: 2px;
        line-height: calc(1px + 20px);
    }
    .status{
        display: block;
        width: 30%;
        font-size: calc(10px - 0.5px);
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

    .popup{
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.473);
    bottom: -10px;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .popup-body{
    min-height: max-content;
    max-width: 50%;
    background-color: aliceblue;
    font-size: medium;
    font-weight: 600;
    text-align: center;
  }
  .hide{
    display: none;
  }
}


@media screen and (min-width:430px)  and (max-width:768px){
    .order-body{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items:center;
        gap: 2px;
        line-height: calc(1px + 20px);
    }
    .status{
        display: block;
        width: 30%;
        font-size: calc(10px - 0.5px);
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

    .popup{
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.473);
    bottom: -10px;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .popup-body{
    min-height: max-content;
    max-width: 50%;
    background-color: aliceblue;
    font-size: medium;
    font-weight: 600;
    text-align: center;
  }
  .hide{
    display: none;
  }

}

@media screen and (min-width:768px)  and (max-width:820px){
    .order-body{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items:center;
        gap: 2px;
        line-height: calc(1px + 20px);
    }
    .status{
        display: block;
        width: 30%;
        font-size: calc(10px - 0.5px);
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

    .popup{
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.473);
    bottom: -10px;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .popup-body{
    min-height: max-content;
    max-width: 50%;
    background-color: aliceblue;
    font-size: medium;
    font-weight: 600;
    text-align: center;
  }
  .hide{
    display: none;
  }

}

</style>