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
  <Card>
    <template v-slot:header>
      <h2>Card Header</h2>
    </template>
    <template v-slot:default>
      <img src="../src/assets/logo.png" />
    </template>
    <template v-slot:footer>
      <b>Card Footer</b>
    </template>
  </Card>

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
