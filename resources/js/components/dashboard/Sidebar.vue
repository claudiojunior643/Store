<script setup>
import { VList, VSheet, VListItem, VBtn } from "vuetify/components";
import { PrimeIcons } from "primevue/api";
import { reactive } from "vue";

const links = reactive([
  {
    path: "/",
    name: "Pagina Inicial",
    icon: PrimeIcons.HOME,
  },
  {
    path: "/",
    name: "Gerar PDF",
    icon: PrimeIcons.FILE_PDF,
  },
  {
    path: "/contracts",
    name: "Contratos",
    icon: PrimeIcons.FILE_EDIT,
  },
  {
    path: "/user",
    name: "Usuario",
    icon: PrimeIcons.USER,
  },
]);
</script>

<template>
  <VSheet rounded="lg">
    <VList rounded="lg" class="sidbar">
      <VListItem v-for="link in links" :key="link" class="button-container">
        <a :href="link.path">
          <VBtn variant="plain" class="responsive-button" stacked>
            <i class="icon" :class="link.icon"></i>
            {{ link.name }}
          </VBtn>
        </a>
      </VListItem>
    </VList>
  </VSheet>
</template>

<style scoped>
.button-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.responsive-button {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color: black;
  font-size: 11px;
}
.icon {
  font-size: 18px;
  margin-bottom: 10px;
}

@media (max-width: 800px) {
  .button-container {
    width: 250px;
    height: 150px;
    font-size: 20px;
  }
  .responsive-button {
    font-size: 15px;
  }
  .icon {
    font-size: 25px;
  }
}
</style>