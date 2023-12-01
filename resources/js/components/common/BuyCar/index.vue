<script setup>
import { ref } from "vue";
import {
  VWindow,
  VWindowItem,
  VTabs,
  VTab,
  VIcon,
  VBtn,
  VSnackbar,
} from "vuetify/components";
import CustomerForm from "../../forms/CunstomerForm";
import CarForm from "../../forms/CarForm";

const step = ref(0);

const tabs = ["Cliente", "Veículo"];

const passar = () => {
  step.value = 1;
};

const voltar = () => {
  step.value = 0;
};
</script>

<template>
  <div>
    <VTabs v-model="step" class="tabs">
      <VTab :disabled="true" v-for="tab in tabs" :key="tab" class="custom-tab">
        {{ tab }}
        <VIcon> mdi-check </VIcon>
      </VTab>
    </VTabs>
    <VWindow v-model="step">
      <VWindowItem class="step">
        <CustomerForm @passar-aba="passar" />
      </VWindowItem>
      <VWindowItem class="step">
        <CarForm @voltar-aba="voltar" />
      </VWindowItem>
    </VWindow>
  </div>
</template>

<style>
.tabs {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}
.step {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.custom-snackbar {
  position: fixed;
  bottom: 20px;
  right: 20px;
}
.custom-tab {
  opacity: 1;
  pointer-events: none;
}
</style>