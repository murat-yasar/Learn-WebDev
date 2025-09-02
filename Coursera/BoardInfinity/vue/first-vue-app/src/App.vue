<template>
  <table>
    <thead>
      <tr><th></th><th><h2>Counter Inline</h2></th><th></th></tr>
    </thead>
    <tbody>
      <tr>
        <td><button v-on:click="counter1-=1">Decrease</button></td>
        <td style="text-align: center;">
          <span v-bind:style="{ fontSize: '2rem'}">{{ counter1 }}</span>
        </td>
        <td><button @click="counter1+=1">Increase</button></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;">
          <button @click="counter1=0">Reset</button>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <br><hr><br>

   <table>
    <thead>
      <tr><th></th><th><h2>Counter with Method</h2></th><th></th></tr>
    </thead>
    <tbody>
      <tr>
        <td><button @click="decrease(1)">Decrease</button></td>
        <td style="text-align: center;"><span v-bind:style="{ fontSize: '2rem'}">{{ counter2 }}</span></td>
        <td><button @click="increase(1)">Increase</button></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;"><button @click="reset()">Reset</button></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <br><hr><br>



</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      counter1: 0,
      counter2: 0
    }
  },
  methods: {
    increase(num){
      this.counter2 += num
    },
    decrease(num){
      this.counter2 -= num
    },
    reset() {
      this.counter2 = 0
    } 
  }
}
</script>

<style>
#app {

}
</style>
