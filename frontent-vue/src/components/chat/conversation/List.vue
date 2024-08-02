<script setup lang="ts">
import {} from 'vue'
import Item from './Item.vue'
</script>

<template>
  <ul class="space-y-2 mt-4 grow bg-primary-300 px-2 py-4 rounded">
    <Item v-for="n in 5" :key="n" />
  </ul>
</template>
