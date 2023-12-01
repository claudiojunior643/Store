<script setup>
import {
  VAppBar,
  VAvatar,
  VContainer,
  VResponsive,
  VTextField,
} from "vuetify/components";
import Topbar from "./Topbar.vue";
import { ref, onMounted } from "vue";
const isScreenSizeMdAndUp = ref(false);

const updateScreenSize = (mediaQuery) => {
  isScreenSizeMdAndUp.value = mediaQuery.matches;
};

onMounted(() => {
  const mediaQuery = window.matchMedia("(max-width: 814px)");
  updateScreenSize(mediaQuery);
  mediaQuery.addEventListener("change", () => updateScreenSize(mediaQuery));
});
</script>

<template>
  <VBppBar flat>
    <VContainer class="d-flex align-center">
      <VAvatar class="me-10 ms-4" color="grey-darken-1" size="32"> </VAvatar>
      <VResponsive max-width="260">
        <VTextField variant="underlined" density="compact" hide-details>
          <i
            class="pi pi-search"
            style="padding-top: 5px; padding-right: 5px; padding-left: 5px"
          >
          </i>
        </VTextField>
      </VResponsive>
      <Topbar class="topBar" v-if="isScreenSizeMdAndUp" />
    </VContainer>
  </VBppBar>
</template>

<style>
.topBar {
  position: relative;
  left: 40%;
}

@media (max-width: 710px) {
  .topBar {
    left: 35%;
  }
}
@media (max-width: 650px) {
  .topBar {
    left: 28%;
  }
}
@media (max-width: 600px) {
  .topBar {
    left: 23%;
  }
}
@media (max-width: 550px) {
  .topBar {
    left: 15%;
  }
}
@media (max-width: 500px) {
  .topBar {
    left: 8%;
  }
}
@media (max-width: 460px) {
  .topBar {
    left: 5%;
  }
}
</style>