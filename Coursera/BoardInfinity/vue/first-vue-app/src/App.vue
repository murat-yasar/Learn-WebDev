<template>
  <!-- Counter Example -->
  <Counter />

  <br><hr><br>
  <!-- Props Example -->
  <Greet name="Murat" />
  <Greet name="Memluk" />
  <Greet :name="name" />

  <br><hr><br>
  <!-- Emitter Example -->
  <button @click="isPopupVisible=true">Show Popup</button>
  <Popup v-if="isPopupVisible" @close="isPopupVisible=false" />

  <br><hr><br>
  <!-- Slot Example -->
  <Card><h2>Card Component (Slots)</h2></Card>
  <card><img src="../src/assets/logo.png" /></card>

  <br><hr><br>
  <!-- Slot Example -->

</template>

<script>
import Counter from './components/Counter.vue';
import Greet from './components/Greet.vue';
import Popup from './components/Popup.vue';
import Card from './components/Card.vue';

export default {
  name: 'App',
  components: {
    Counter,
    Greet,
    Popup,
    Card
  },
  data(){
    return {
      name: 'SuperCoder',
      isPopupVisible: false
    }
  }
}
</script>
