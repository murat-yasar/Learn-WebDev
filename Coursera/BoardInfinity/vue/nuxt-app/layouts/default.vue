<template>
   <header class="header">
      <nav>
         <ul>
            <li class="nav-link"><NuxtLink to="/">Home</NuxtLink></li>
            <li class="nav-link"><NuxtLink to="/about">About</NuxtLink></li>
            <li class="nav-link"><NuxtLink to="/products">Products</NuxtLink></li>
         </ul>
      </nav>
   </header>

   <slot />
</template>

<style>
.header {
   background-color: black;
   color: white;
}
.nav-link {
   display: inline-block;
   text-decoration: none;
   color: white;
   margin: 10px;
}
</style>