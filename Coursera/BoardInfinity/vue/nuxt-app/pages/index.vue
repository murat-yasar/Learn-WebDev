<template>
   <h1>Home</h1>

   <!-- <HomepageBanner /> -->
   <!-- <HomepageCard /> -->

   <h1>{{ counter }}</h1>
   <button @click="dec">dec</button>
   <button @click="inc">inc</button>

</template>

<script>
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
</script>