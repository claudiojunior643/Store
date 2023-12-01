<script setup>
import Navbar from "../../components/dashboard/Navbar.vue";
import Sidebar from "../../components/dashboard/Sidebar.vue";
import Topbar from "../../components/dashboard/Topbar.vue";
import { ref, onMounted } from "vue";
import {
  VApp,
  VMain,
  VContainer,
  VRow,
  VCol,
  VSheet,
} from "vuetify/components";
const isScreenSizeMdAndUp = ref(false);

const updateScreenSize = (mediaQuery) => {
  isScreenSizeMdAndUp.value = mediaQuery.matches;
};

onMounted(() => {
  const mediaQuery = window.matchMedia("(min-width: 814px)");
  updateScreenSize(mediaQuery);
  mediaQuery.addEventListener("change", () => updateScreenSize(mediaQuery));
});
</script>

<template>
  <VApp id="inspire">
    <Navbar />
    <VMain class="bg-grey-lighten-3">
      <VContainer>
        <VRow>
          <VCol cols="2" v-if="isScreenSizeMdAndUp">
            <Sidebar />
          </VCol>
          <VCol>
            <VSheet minHeight="70vh" rounded="lg">
              <RouterView />
            </VSheet>
          </VCol>
        </VRow>
      </VContainer>
    </VMain>
  </VApp>
</template>
