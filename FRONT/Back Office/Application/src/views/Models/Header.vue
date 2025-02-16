<template>
    <div class="header">
        <!-- Menu de navigation -->
        <Menubar :model="menuItems">
            <template #start>
                <h2 class="header-title">My App</h2>
            </template>
            <template #end>
                <Button :icon="isDarkMode ? 'pi pi-sun' : 'pi pi-moon'"
                        class="p-button-rounded p-button-text"
                        @click="toggleDarkMode" />
            </template>
        </Menubar>

        <!-- Fil d'Ariane -->
        <div class="breadcrumb-container">
            <Breadcrumb :home="home" :model="breadcrumbs" />
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useRoute } from "vue-router";

// État du mode sombre
const isDarkMode = ref(false);

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    document.documentElement.classList.toggle("my-app-dark");
};

// Définition du menu
const menuItems = ref([
    { label: "Home", icon: "pi pi-home", to: "/" },
    { label: "About", icon: "pi pi-info-circle", to: "/about" },
    { label: "Contact", icon: "pi pi-envelope", to: "/contact" },
]);

// Gestion des breadcrumbs
const home = ref({ icon: "pi pi-home", route: "/" });
const breadcrumbs = ref([]);
const route = useRoute();

const updateBreadcrumb = () => {
    breadcrumbs.value = route.matched.map((r) => ({
        label: r.name || r.path,
        route: r.path,
    }));
};

watch(() => route.path, updateBreadcrumb, { immediate: true });
</script>

<style scoped>
.header {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
    background-color: var(--surface-ground);
}

.header-title {
    font-size: 20px;
    font-weight: bold;
    color: var(--text-color);
    margin-left: 10px;
}

.breadcrumb-container {
    padding: 10px;
    background: var(--surface-card);
    border-radius: 8px;
}
</style>
