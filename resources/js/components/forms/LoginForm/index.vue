<template>
  <VCard
    class="login-form"
  >
    <VForm @submit.prevent="submitForm">
      <h1 style="text-align: center">
        Ideal Car
      </h1>
      <VContainer
        fluid
        class="bg-transparent"
      >
        <VRow>
          <VCol cols="12">
            <VTextField
              v-model="formData.email"
              label="E-mail"
              type="email"
              variant="underlined"
              :errorMessages="v$.email.$errors.map(e => e.$message)"
              required
              @input="v$.email.$touch"
              @blur="v$.email.$touch"
            ></VTextField>
          </VCol>
        </VRow>
        <VRow>
          <VCol cols="12">
            <VTextField
              v-model="formData.password"
              label="Senha"
              type="password"
              :errorMessages="v$.password.$errors.map(e => e.$message)"
              variant="underlined"
              required
              @input="v$.password.$touch"
              @blur="v$.password.$touch"
            ></VTextField>
          </VCol>
        </VRow>
        <VRow
          noGutters
          class="text-center mt-6"
        >
          <VCol cols="12">
            <VBtn
              color="primary"
              type="submit"
              width="300"
              text="Enviar"
            />
          </VCol>
        </VRow>
      </VContainer>
    </VForm>
  </VCard>
</template>
<script setup>
import {reactive} from "vue";
import { useVuelidate } from '@vuelidate/core';
import { required, email, minLength } from '@vuelidate/validators';
import axios from 'axios';

import { VContainer, VCard, VForm, VRow, VCol, VTextField, VBtn } from 'vuetify/components';

/**
 * Emits
 */
const emit = defineEmits(['onError'])

/**
 * State
 */
const formData = reactive({
  email: '',
  password: ''
});

const rules = {
  email: { required, email }, // Matches state.firstName
  password: { minLength: minLength(8) }, // Matches state.lastName
}

const v$ = useVuelidate(rules, formData)

/**
 * Functions
 */
const submitForm = async () => {
  if (!v$.value.$invalid) {

    try {
      const request = await axios.post('api/login', formData);
      const response = request.data;

      localStorage.token = response.data.token;

    } catch(err) {
      emit('onError')
    }

  }
};

</script>
<style scoped>
.login-form {
  position: absolute;
  left: 50%;
  transform: translate(-50%, 50%);
  background-color: white;
  max-width: 400px;
  width: 100%;
  border-radius: 10px;
  padding-inline: 15px;
  padding-block: 30px;
}
</style>
