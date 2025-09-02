<template>
   <table>
    <thead>
      <tr><th></th><th><h2>Counter with Method</h2></th><th></th></tr>
    </thead>
    <tbody>
      <tr>
        <td><button @click="decrease(1)">Decrease</button></td>
        <td style="text-align: center;"><span v-bind:style="{ fontSize: '2rem'}">{{ counter }}</span></td>
        <td><button @click="increase(1)">Increase</button></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;"><button @click="reset()">Reset</button></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</template>

<script>

export default {
  name: 'Counter',
  data() {
    return {
      counter: 0
    }
  },
  methods: {
    increase(num){
      this.counter += num
    },
    decrease(num){
      this.counter -= num
    },
    reset() {
      this.counter = 0
    } 
  }
}
</script>