<template>
  <Greet name="Murat" />
  <Greet name="Memluk" />
</template>

<script>
import Greet from './components/Greet.vue';

export default {
  name: 'App',
  components: {
    Greet
  }
}
</script>
