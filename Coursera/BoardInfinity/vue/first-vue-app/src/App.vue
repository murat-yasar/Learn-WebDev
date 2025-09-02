<template>
  <Greet name="Murat" />
  <Greet name="Memluk" />
  <Greet :name="name" />
</template>

<script>
import Greet from './components/Greet.vue';

export default {
  name: 'App',
  components: {
    Greet
  },
  data() {
    return {
      name: 'SuperCoder'
    }
  }
}
</script>
