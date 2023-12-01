<script setup>
import {
  VBtn,
  VContainer,
  VRow,
  VCol,
  VTextField,
  VForm,
} from "vuetify/components";
import { ref, computed, defineEmits } from "vue";
import { useCounterStore } from "../../../configs/stores/counterStore";

const counter = useCounterStore();

const marca = ref("");
const modelo = ref("");
const cor = ref("");
const placa = ref("");
const anoFabricacao = ref("");
const anoModelo = ref("");

const regras = [
  (value) => {
    if (value) return true;

    return "Preencha Corretamente o Campo .";
  },
];

const botaoBloqueado = computed(() => {
  return (
    !regras.every((rule) => rule(marca.value) === true) ||
    modelo.value.trim() === "" ||
    cor.value.trim() === "" ||
    placa.value.trim() === "" ||
    anoModelo.value.trim() === "" ||
    anoFabricacao.value.trim() === ""
  );
});

defineEmits(["voltarAba"]);
</script>

<template>
  <VContainer class="bg-transparent">
    <h3 class="mb-5">Insira as informações do cliente abaixo:</h3>
    <VForm @submit.prevent>
      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            class="input"
            v-model="marca"
            :rules="regras"
            style="margin-right: 10px"
            rounded
            label="Marca"
            placeholder="Digite o nome completo"
            variant="outlined"
            density="compact"
          ></VTextField>
        </VCol>
        <VCol :cols="defaultColumns">
          <VTextField
            class="input"
            v-model="modelo"
            :rules="regras"
            rounded
            label="Modelo"
            placeholder="Digite o modelo"
            variant="outlined"
            density="compact"
          ></VTextField>
        </VCol>
      </VRow>

      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            class="input"
            v-model="cor"
            :rules="regras"
            style="margin-right: 10px"
            rounded
            label="Cor"
            placeholder="Digite o cor"
            variant="outlined"
            density="compact"
          ></VTextField>
        </VCol>
        <VCol :cols="defaultColumns">
          <VTextField
            :maxlength="7"
            class="input"
            v-model="placa"
            type="text"
            :rules="regras"
            label="Placa"
            placeholder="Digite o e-mail"
            variant="outlined"
            density="compact"
          ></VTextField>
        </VCol>
      </VRow>

      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            v-mask="['####']"
            class="input"
            v-model="anoFabricacao"
            :rules="regras"
            style="margin-right: 10px"
            rounded
            label="Ano de fabricação"
            placeholder="xxxx"
            variant="outlined"
            density="compact"
          ></VTextField>
        </VCol>
        <VCol :cols="defaultColumns">
          <VTextField
            v-mask="['####']"
            class="input"
            v-model="anoModelo"
            :rules="regras"
            label="Ano do modelo"
            placeholder="xxxx"
            variant="outlined"
            density="compact"
          ></VTextField>
        </VCol>
      </VRow>
      <VRow justify="center">
        <VBtn
          type="submit"
          color="secondary"
          style="margin-right: 10px"
          variant="outlined"
          @click="$emit('voltarAba')"
        >
          Voltar
        </VBtn>
        <VBtn
          type="submit"
          color="primary"
          variant="outlined"
          @click="counter.closeOpen"
          :disabled="botaoBloqueado"
        >
          Finalizar
        </VBtn>
      </VRow>
    </VForm>
  </VContainer>
</template>

<style>
.input {
  margin-bottom: 5px;
}
</style>