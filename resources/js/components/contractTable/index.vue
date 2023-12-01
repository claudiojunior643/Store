<script setup>
import { VTable, VBtn } from "vuetify/components";
import ShoppingModal from "../../components/shoppingModal/index.vue";

const category = ["Nome", "Ano", "Placa", "Cor", "Chassi"];

const props = defineProps({
  items: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <VTable>
    <thead>
      <tr>
        <th v-for="item in category" :key="item.name" class="text-left">
          {{ item }}
        </th>
        <th>
          <ShoppingModal />
        </th>
      </tr>
      <tr>
        <th v-for="(item, index) in items" :key="index" class="text-left">
          {{ item }}
        </th>
        <th></th>
      </tr>
    </thead>
  </VTable>
</template>

<style>
@media (max-width: 720px) {
  .text-left {
    font-size: 12px;
  }
}
@media (max-width: 600px) {
  .text-left {
    font-size: 10px;
  }
}
@media (max-width: 450px) {
  .text-left {
    font-size: 8px;
  }
}
</style>