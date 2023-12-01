<script setup>
import { VApp, VMain } from "vuetify/components";
</script>

<template>
  <VApp>
    <VMain
      style="
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f7f7f7;
      "
    >
      <router-view />
    </VMain>
  </VApp>
</template>
