<script setup>
import {
  VTable,
  VBtn,
  VRow,
  VDialog,
  VCard,
  VCardTitle,
  VCardText,
  VContainer,
  VCol,
  VTextField,
  VSelect,
  VAutocomplete,
  VCardActions,
  VSpacer,
  VSnackbar,
} from "vuetify/components";
import { ref } from "vue";
import BuyCar from "../../components/common/BuyCar";
import { useCounterStore } from "../../configs/stores/counterStore.js";

const counter = useCounterStore();

const text = ref(`Cadastro Finalizado`);
</script>

<template>
  <VRow justify="center">
    <VDialog v-model="counter.dialog" persistent width="1024">
      <template v-slot:activator="{ props }">
        <VBtn color="primary" v-bind="props" class="buttonShopping">
          Comprar
        </VBtn>
      </template>
      <VCard>
        <div class="buttonClose">
          <VBtn @click="counter.close" icon="$vuetify" variant="text">
            <i class="pi pi-times"></i>
          </VBtn>
        </div>
        <VCard-text>
          <VContainer>
            <BuyCar />
          </VContainer>
        </VCard-text>
        <VCard-actions>
          <VSpacer></VSpacer>
        </VCard-actions>
      </VCard>
    </VDialog>
  </VRow>
  <div class="text-center ma-2">
    <VSnackbar v-model="counter.snackbar" color="green">
      {{ text }}
      <template v-slot:actions>
        <VBtn color="black" variant="text" @click="counter.close"> Close </VBtn>
      </template>
    </VSnackbar>
  </div>
</template>

<style>
.buttonClose {
  display: flex;
  flex-direction: row-reverse;
  position: relative;
  margin-bottom: -30px;
  margin-top: 10px;
  margin-right: 10px;
}

@media (max-width: 720px) {
  .buttonShopping {
    width: 80px;
    height: 30px;
    font-size: 12px;
  }
}
@media (max-width: 510px) {
  .buttonShopping {
    width: 70px;
    height: 28px;
    font-size: 10px;
    right: 40px;
  }
}
@media (max-width: 460px) {
  .buttonShopping {
    width: 60px;
    height: 26px;
    font-size: 10px;
    position: relative;
  }
}
@media (max-width: 400px) {
  .buttonShopping {
    right: 60px;
  }
}
</style>