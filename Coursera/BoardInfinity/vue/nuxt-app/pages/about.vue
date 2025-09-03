<template>
   <h1>About Us</h1>
</template>

<script setup>
useHead(
   {
      title: 'My About Page',
      meta: [
        {name: 'description', content: 'Description about my company'},
        {name: 'tags', content: 'Nuxt, SEO, JS'}
      ],
      link: [
        {rel: 'stylesheet', href: 'https://fonts.googleapis.com'}
      ]
   }
)
</script>