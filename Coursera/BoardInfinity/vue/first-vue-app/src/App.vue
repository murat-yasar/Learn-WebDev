<template>
  <table>
    <thead>
      <tr>
        <th></th>
        <th><h2>Counter</h2></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><button @click="counter-=1">Decrease</button></td>
        <td style="text-align: center;">
          <span v-bind:style="{ fontSize: '2rem'}">{{ counter }}</span>
        </td>
        <td><button v-on:click="counter+=1">Increase</button></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;">
          <button v-on:click="counter=0">Reset</button>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      counter: 0,
    }
  }
}
</script>

<style>
#app {

}
</style>
