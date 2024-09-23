<script setup lang="ts">
    const props =defineProps(['id','name','status']);
    let statusStyle = 'in-processs';
    if(props.status=='DELIVERED'){
        statusStyle ='delivered';
    }
    if(props.status =='REQUESTED'){
        statusStyle ='requested';
    }
  
</script>
<template>
    <article class="order">
        <article class="order-body">
            <p><strong class="order-number">{{ id }}</strong> <span>{{ name }}</span> <strong v-bind:class="statusStyle">{{ status }}</strong></p>
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

</style>