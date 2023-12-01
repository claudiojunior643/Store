<script setup>
import {
  VCard,
  VTextField,
  VSelect,
  VCheckbox,
  VBtn,
} from "vuetify/components";
import { ref } from "vue";
import { useField, useForm } from "vee-validate/dist/vee-validate";

const { handleSubmit, handleReset } = useForm({
  validationSchema: {
    name(value) {
      if (value?.length >= 2) return true;

      return "Name needs to be at least 2 characters.";
    },
    phone(value) {
      if (value?.length > 9 && /[0-9-]+/.test(value)) return true;

      return "Phone number needs to be at least 9 digits.";
    },
    email(value) {
      if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true;

      return "Must be a valid e-mail.";
    },
    select(value) {
      if (value) return true;

      return "Select an item.";
    },
  },
});

const name = useField("name");
const phone = useField("phone");
const email = useField("email");
const select = useField("select");

const items = ref(["Item 1", "Item 2", "Item 3", "Item 4"]);

const submit = handleSubmit((values) => {
  alert(JSON.stringify(values, null, 2));
});
</script>

<template>
  <VCard style="width: 60vh; flex: 0 0 auto">
    <form @submit.prevent="submit" style="padding: 50px">
      <VTextField
        variant="outlined"
        v-model="name.value.value"
        :counter="10"
        :error-messages="name.errorMessage.value"
        label="Name"
      ></VTextField>

      <VTextField
        variant="outlined"
        v-model="phone.value.value"
        :counter="7"
        :error-messages="phone.errorMessage.value"
        label="Phone Number"
      ></VTextField>

      <VTextField
        variant="outlined"
        v-model="email.value.value"
        :error-messages="email.errorMessage.value"
        label="E-mail"
      ></VTextField>

      <VSelect
        variant="outlined"
        v-model="select.value.value"
        :items="items"
        :error-messages="select.errorMessage.value"
        label="Select"
      ></VSelect>

      <VBtn class="me-4" type="submit" variant="outlined"> submit </VBtn>

      <VBtn @click="handleReset" variant="outlined"> clear </VBtn>
    </form>
  </VCard>
</template>