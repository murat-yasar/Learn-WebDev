<template>
   <div class="card">
      <div id="header">
         <slot name="header"></slot>
      </div>
      <div id="content">
         <slot></slot>
      </div>
      <div id="footer">
         <slot name="footer"></slot>
      </div>
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