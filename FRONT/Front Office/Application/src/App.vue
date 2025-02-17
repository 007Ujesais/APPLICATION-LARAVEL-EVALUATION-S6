<template>
  <div class="Main">
    <Dialog v-model:visible="visible" maximizable>
      <template #header>
        <h4> </h4>
      </template>
      <PageSignInForm />
    </Dialog>
    <Layout />
  </div>
</template>

<script setup>
import Layout from "./views/Models/Models.vue";
import PageSignInForm from "./views/Pages/Page.SignInForm.vue";
import { ref, onMounted } from "vue";

// Vérification de la session utilisateur
const visible = ref(false);

onMounted(() => {
  const userSession = localStorage.getItem("user"); // Vérifie si un utilisateur est stocké
  if (!userSession) {
    visible.value = true; // Afficher le formulaire de connexion si aucun utilisateur n'est connecté
  }
});
</script>

<style lang="scss" scoped>
.Main {
  padding: 20px;
}
</style>
