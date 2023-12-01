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

defineEmits(["passarAba"]);

const defaultColumns = 6;
const nome = ref("");
const cpf = ref("");
const email = ref("");
const dataNascimento = ref("");
const telefone = ref("");
const invalido = ref(false);
const errorMessageName = ref("");
const errorMessageDate = ref("");
const errorMensagemEmail = ref("");
const errorMessageCpf = ref("");
const errorMessageTell = ref("");

const regras = [
  (value) => {
    if (value) return true;

    return "Preencha corretamente o campo .";
  },
];

const botaoBloqueado = computed(() => {
  return (
    !regras.every((rule) => rule(nome.value) === true) ||
    nome.value.trim().length < 3 ||
    cpf.value.trim().length < 14 ||
    invalido.value ||
    telefone.value.trim().length < 15 ||
    !isDateValid.value ||
    !email.value.includes("@gmail.com")
  );
});

const isDateValid = computed(() => {
  return dataNascimento.value !== "" && !errorMessageDate.value;
});

const validateTell = () => {
  const digitos = telefone.value.trim();
  errorMessageTell.value =
    digitos.length < 15 ? "Adicione um número de telefone valido" : "";
};

const validateCpf = () => {
  const digitos = cpf.value.trim();
  errorMessageCpf.value =
    digitos.length < 14 ? "Adicione um CPF/CNPJ valido" : "";
};

const validateUsername = () => {
  const digitos = nome.value.trim().split(" ");
  invalido.value = nome.value.length > 2 && digitos.length < 2;
  botaoBloqueado.value =
    invalido.value || nome.value.trim().split(" ").length < 2;
  errorMessageName.value =
    nome.value.length > 2 && digitos.length < 2
      ? "Nome de usuário inválido. Deve ter no mínimo duas palavras:"
      : "";
};

const validateDate = () => {
  const inputDate = new Date(dataNascimento.value);
  const today = new Date();
  const eighteenYearsAgo = today.getFullYear() - 17;
  const minDate = new Date(eighteenYearsAgo, today.getMonth(), today.getDate());
  errorMessageDate.value =
    inputDate > minDate ? "Você deve ter pelo menos 18 anos de idade." : "";
};

const validateEmail = () => {
  errorMensagemEmail.value = !email.value.includes("@gmail.com")
    ? "Digite um endereço de e-mail válido."
    : "";
};
</script>

<template>
  <VContainer class="bg-transparent">
    <h3 class="mb-5">Insira as informações do cliente abaixo:</h3>
    <VForm @submit.prevent>
      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            class="input"
            rounded
            label="Nome"
            placeholder="Digite o nome completo"
            variant="outlined"
            density="compact"
            v-model="nome"
            :rules="regras"
            :error-messages="errorMessageName"
            @input="validateUsername"
          >
          </VTextField>
        </VCol>
      </VRow>

      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            v-mask="['###.###.###-##', '##.###.###/####-##']"
            class="input"
            :error-messages="errorMessageCpf"
            label="CPF/CNPJ"
            placeholder="xxx.xxx.xxx-xx"
            variant="outlined"
            density="compact"
            v-model="cpf"
            :rules="regras"
            @input="validateCpf"
          ></VTextField>
        </VCol>
      </VRow>

      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            :error-messages="errorMensagemEmail"
            @input="validateEmail"
            class="input"
            type="email"
            name="email"
            label="E-mail"
            placeholder="Digite o e-mail"
            variant="outlined"
            density="compact"
            v-model="email"
            :rules="regras"
          ></VTextField>
        </VCol>
      </VRow>

      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            type="date"
            class="input"
            label="Data de nascimento"
            placeholder="xx/xx/xxxx"
            variant="outlined"
            density="compact"
            v-model="dataNascimento"
            @input="validateDate"
            :error-messages="errorMessageDate"
          ></VTextField>
        </VCol>
      </VRow>

      <VRow noGutters justify="center">
        <VCol :cols="defaultColumns">
          <VTextField
            v-mask="['(##) #####-####']"
            class="input"
            required
            label="Telefone"
            placeholder="(xx) xxxxx-xxxx"
            variant="outlined"
            density="compact"
            v-model="telefone"
            :rules="regras"
            :error-messages="errorMessageTell"
            @input="validateTell"
          ></VTextField>
        </VCol>
      </VRow>
      <VRow justify="center">
        <VBtn
          color="primary"
          @click="$emit('passarAba')"
          variant="outlined"
          :disabled="botaoBloqueado"
        >
          Continuar
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