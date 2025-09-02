<template>
  <Greet name="Murat" />
  <Greet name="Memluk" />
  <Greet :name="name" />

  <hr><br>

  <!-- Emitter Example -->
   <button @click="isPopupVisible=true">Show Popup</button>
  <Popup v-if="isPopupVisible" @close="isPopupVisible=false" />

</template>

<script>
import Greet from './components/Greet.vue';
import Popup from './components/Popup.vue';

export default {
  name: 'App',
  components: {
    Greet,
    Popup
  },
  data(){
    return {
      name: 'SuperCoder',
      isPopupVisible: false
    }
  }
}
</script>
