<script setup>
import { VSheet } from "vuetify/components";
import ContractTable from "../../components/contractTable/index.vue";

const meusItens = ["Gol", "2021", "lalala21", "Vermelho", "9BWZZZ377VT004251"];
</script>

<template>
  <div>
    <ContractTable :items="meusItens" />
  </div>
</template>
