<template>
    <div>
      <h1>Techniques</h1>
      <ul>
        <li v-for="technique in techniques" :key="technique.id">
          <router-link :to="`/techniques/${technique.id}`">
            {{ technique.name }}
          </router-link>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      techniques: Array,
    },
  }
  </script>
  