<template>
   <h2>Here is a Popup!</h2>
   <button @click="$emit('close')">Close</button>
</template>

<script>
   export default {
      name: 'Popup',
      emits: ['close']
   }
</script>