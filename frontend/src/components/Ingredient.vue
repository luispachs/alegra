<script setup lang="ts">
const props = defineProps(['name','amount','id' ,'isAvailable']);
    
let zebraStyle = "light";
if((props.id%2)==0){
    zebraStyle ="dark"
}
let available =false ;
if(props.isAvailable==0){
    available =true;
}
</script>
<template>
    <article :class="zebraStyle">
        <h3 :class="{'unavailable':available}">{{ name }}</h3>
        <article >
            <div><p><strong>Id:</strong> {{ id }}</p></div>
            <div><p><strong>Cantidad disponible:</strong> {{ amount }}</p></div>
        </article>
    </article>
</template>

<style scope>

.unavailable {
    text-decoration:line-through;
}
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