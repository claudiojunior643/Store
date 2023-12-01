<script>
import {defineComponent} from 'vue';

export default defineComponent({
  name: 'EmptyLayout',
});
</script>

<template>
  <div class="empty-layout">
    <router-view/>
  </div>
</template>

<style scoped>
.empty-layout {
  height: 100vh;
  width: 100%;
  background-color: gray;
}
</style>
