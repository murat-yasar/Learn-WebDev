<template>
   <div class="card">
      <slot></slot>
   </div>
</template>

<script>
   export default {
      name: 'Card'
   }
</script>

<style scoped>
   .card {
      box-shadow: 0 4px 8px 0 rgb(0,0,0,.2);
      padding: 10px;
      margin: 10px;
      width: 400px;
   }
</style>