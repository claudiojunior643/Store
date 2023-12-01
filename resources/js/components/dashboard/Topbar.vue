<script setup>
import { ref } from "vue";
import {
  VCard,
  VBtn,
  VOverlay,
  VAppBar,
  VNavigationDrawer,
  VApp,
  VMain,
  VContainer,
  VAppBarNavIcon,
  VToolbarTitle,
} from "vuetify/components";
import Sidebar from "./Sidebar.vue";
const drawer = ref(false);
</script>

<template>
  <div>
    <VBtn
      variant="text"
      @click.stop="drawer = !drawer"
      class="topBar pi pi-bars"
    ></VBtn>
    <v-navigation-drawer v-model="drawer" app location="right" class="d-flex">
      <VBtn
        @click.stop="drawer = !drawer"
        variant="text"
        class="pi pi-times"
        style="margin-top: 20px; margin-left: 180px; font-size: 18px"
      ></VBtn>
      <Sidebar />
    </v-navigation-drawer>
  </div>
</template>
<style>
.topBar {
  font-size: 22px;
}
@media (max-width: 500px) {
  .topBar {
    font-size: 18px;
  }
}
</style>