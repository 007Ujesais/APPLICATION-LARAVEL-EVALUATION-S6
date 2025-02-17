<template>
    <div class="header">
        <!-- Fil d'Ariane -->
        <div class="breadcrumb-container">
            <Breadcrumb :home="home" :model="breadcrumbs" class="p-1">
                <template #item="{ item, props }">
                    <router-link v-if="item.route" :to="item.route" v-bind="props">
                        <span :class="[item.icon, 'text-color']" />
                        <span class="text-primary font-semibold">{{ item.label }}</span>
                    </router-link>
                    <a v-else :href="item.url" :target="item.target" v-bind="props.action">
                        <span class="text-surface-700 dark:text-surface-0">{{ item.label }}</span>
                    </a>
                </template>
            </Breadcrumb>
            
            <div class="date-container">
                <Tag severity="info">{{ new Date().toLocaleString('default', { month: 'long' }) }}</Tag>
                <Tag severity="info">{{ new Date().getDate() }}</Tag>
                <Tag severity="info">{{ new Date().getFullYear() }}</Tag>
            </div>

        </div>
        <Menubar style="border-radius: 1rem; padding: 1rem 1rem 1rem 1.5rem" :model="items">
            <template #item="{ item, props, hasSubmenu }">
                <router-link v-if="item.route" :to="item.route" v-bind="props">
                    <span :class="item.icon" />
                    <span>{{ item.label }}</span>
                </router-link>
                <a v-else v-ripple :href="item.url" :target="item.target" v-bind="props.action">
                    <span :class="item.icon" />
                    <span>{{ item.label }}</span>
                    <span v-if="hasSubmenu" class="pi pi-fw pi-angle-down" />
                </a>
            </template>
            <template #end>
                <Button :icon="isDarkMode ? 'pi pi-sun' : 'pi pi-moon'" class="p-button-rounded p-button-text" @click="toggleDarkMode" />
            </template>
        </Menubar>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";

// État du mode sombre avec persistance
const isDarkMode = ref(localStorage.getItem("darkMode") === "true");

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    document.documentElement.classList.toggle("my-app-dark", isDarkMode.value);
    localStorage.setItem("darkMode", isDarkMode.value);
};

// Appliquer le mode sombre au chargement si activé
onMounted(() => {
    if (isDarkMode.value) {
        document.documentElement.classList.add("my-app-dark");
    }
});

// Définition du menu
const router = useRouter();

const items = ref([
    {
        label: 'Router',
        icon: 'pi pi-palette',
        items: [
            { label: 'Styled', route: '/theming/styled' },
            { label: 'Unstyled', route: '/theming/unstyled' }
        ]
    },
    {
        label: 'Programmatic',
        icon: 'pi pi-link',
        command: () => router.push('/')
    },
    {
        label: 'External',
        icon: 'pi pi-home',
        items: [
            { label: 'Vue.js', url: 'https://vuejs.org/' },
            { label: 'Vite.js', url: 'https://vitejs.dev/' }
        ]
    }
]);

// Gestion des breadcrumbs
const home = ref({ icon: "pi pi-home", route: "/" });
const breadcrumbs = ref([]);
const route = useRoute();

const updateBreadcrumb = () => {
    breadcrumbs.value = route.matched
        .filter(r => r.name) // Évite les routes anonymes
        .map(r => ({
            label: r.meta.breadcrumb || r.name || r.path, // Permet un titre personnalisé
            route: r.path
        }));
};

watch(() => route.path, updateBreadcrumb, { immediate: true });
</script>

<style lang="scss" scoped>
.header {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
    background-color: var(--surface-ground);
    transition: background-color 0.3s ease, color 0.3s ease;
}

.header-title {
    line-height: 0.9;
    font-size: 20px;
    font-weight: bold;
    color: var(--text-color);
    margin-left: 10px;
}

.breadcrumb-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: row;
    padding: 10px;
    background: var(--surface-card);
    border-radius: 8px;
    transition: background 0.3s ease;

    .date-container {
        display: flex;
        gap: 10px;
    }
}

/* Animation pour le mode sombre */
:root {
    transition: background-color 0.3s ease, color 0.3s ease;
}

.p-menuitem-link:hover {
    background-color: var(--primary-color);
    color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
</style>