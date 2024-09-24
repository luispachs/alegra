<script setup lang="ts">
const props = defineProps(['name','amount','date','id']);
    
let zebraStyle = "light";
if((props.id%2)==0){
    zebraStyle ="dark"
}
</script>
<template>
    <article :class="zebraStyle">
        <h3>{{ name }}</h3>
        <article >
            <div><p><strong>Id:</strong> {{ id }}</p></div>
            <div><p><strong>Cantidad:</strong> {{ amount }}</p></div>
            <div><p><strong>Fecha de compra:</strong> {{ date }}</p></div>
        </article>
    </article>
</template>

<style scope>

.light{
    background-color: var(--mint-green);
    border-radius: 5px;
    padding:1rem;
}
.dark{
    background-color: var(--rose-quartz);
    border-radius: 5px;
    padding: 1rem;
}

</style>