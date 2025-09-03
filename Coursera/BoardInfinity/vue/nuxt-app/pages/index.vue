<template>
   <h1>Home</h1>

   <!-- <HomepageBanner /> -->
   <!-- <HomepageCard /> -->

   <!--
   <h1>{{ counter }}</h1>
   <button @click="dec">dec</button>
   <button @click="inc">inc</button>
   -->

   <div class="card" v-for="item in products">
      <h3>{{ item.title }}</h3>
      <p>{{ item.description }}</p>
   </div>

</template>

<script setup>
   /*
   export default {
      data(){
         return {
            counter: 0
         }
      },
      methods: {
         inc(){
            this.counter++
         },
         dec(){
            this.counter--
         }
      }
   }
   */
  const { data:products } = await useFetch('https://fakestoreapi.com/products');
</script>

<style>
.card {
   border: 1px solid black;
   padding: 10px;
   margin: 5px;
}
</style>