<template>
  <p>{{ greetings }} {{ name }}!</p>
  <p v-text="question"></p>
  <p v-html="bold"></p>
  <p v-bind:id="'static-id'">This is a p-tag with a static id.</p>
  <p v-bind:id="dynamicId">This is another p-tag with a dynamic id.</p>
  <p v-bind:class="myClass">This is a p-tag with a class.</p>
  <p v-bind:style="myStyle">This is a p-tag with a style.</p>

  <p v-bind:id="dynamicId" :class="myClass" :style="myStyle">This is p-tag with combined data-binding.</p>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      name: 'Murat',
      greetings: 'Hello',
      question: 'How are you?',
      bold: '<b>This is an HTML tag</b>',
      dynamicId: 'dynamic-id',
      myClass: 'center',
      myStyle: {
        color: 'red',
        backgroundColor: 'gold'
      }
    }
  }
}
</script>

<style>
#app {

}
</style>
