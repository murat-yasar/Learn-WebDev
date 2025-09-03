// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  app: {
    head: {
      title: 'My first Nuxt App',
      meta: [
        {name: 'description', content: 'Description about my webpage'},
        {name: 'tags', content: 'Nuxt, SEO, JS'}
      ],
      link: [
        {rel: 'stylesheet', href: 'https://fonts.googleapis.com'}
      ]
    }
  }
})
