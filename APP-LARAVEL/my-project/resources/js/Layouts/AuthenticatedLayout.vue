<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ToggleDarkMode from '@/Components/ToggleDarkMode.vue';

const showSidebar = ref(false);
const isDarkMode = ref(false);

const logout = () => {
    router.post(route('logout')); // Inertia gère la déconnexion avec une requête POST
};

const menuItems = ref([
    { label: 'Catalog', icon: 'pi pi-home', command: () => router.visit(route('home')) },
    { label: 'About', icon: 'pi pi-home', command: () => router.visit(route('home')) },
    { label: 'Delivery', icon: 'pi pi-home', command: () => router.visit(route('home')) },
    { label: 'Blog', icon: 'pi pi-home', command: () => router.visit(route('home')) },

]);

const userMenu = ref([
    { label: 'Profile', icon: 'pi pi-user', command: () => router.visit(route('profile.edit')) },
    { label: 'Log Out', icon: 'pi pi-sign-out', command: logout },
]);
</script>

<template>
    <div>
        <div class="min-h-screen bg-dots bg-center selection:bg-gray-300 selection:text-black">
            <nav class="h-14 fixed top-[-1rem] w-full z-40">
                <div class="bg-perso mx-auto flex justify-center flex-col px-4 sm:px-6">
                    <Link :href="'/'" class="flex relative top-[2.9rem] items-center justify-center">
                                    <ApplicationLogo class="h-9 w-auto text-gray-800" />
                    </Link>
                    <Menubar class="menu-bar" :model="menuItems">
                            <template #item="{ item, props, hasSubmenu, root }">
                                <a v-ripple v-bind="props.action" severity="contrast">
                                    <span class="items-color">{{ item.label }}</span>
                                    <Badge v-if="item.badge" :class="{ 'ml-auto': !root, 'ml-2': root }" :value="item.badge" />
                                    <span v-if="item.shortcut" class="ml-auto border border-surface rounded bg-emphasis text-muted-color text-xs p-1">{{ item.shortcut }}</span>
                                        <i v-if="hasSubmenu" :class="['pi pi-angle-down ml-auto', { 'pi-angle-down': root, 'pi-angle-right': !root }]"></i>
                                </a>
                            </template>
                            <template #end>
                                <div class="flex items-center gap-1">
                                    <Button
                                        :icon="'pi pi-heart'"
                                        class="p-button-rounded p-button-text"
                                        severity="contrast"
                                        @click="router.visit(route('like.show'))"
                                    />
                                    <Button
                                        :icon="'pi pi-shopping-bag'"
                                        class="p-button-rounded p-button-text"
                                        severity="contrast"
                                        @click="router.visit(route('cart.show'))"
                                    />
                                    <SplitButton
                                        :label="$page.props.auth.user.name"
                                        :model="userMenu"
                                        @click="router.visit(route('profile.edit'))"
                                        severity="contrast"
                                        text
                                        dropdownIcon="pi pi-user"
                                    />

                                    <ToggleDarkMode ref="isDarkMode" />
                                </div>
                            </template>
                    </Menubar>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="fixed w-full h-full top-14 left-0 p-5" v-if="$slots.header">
                <div class="max-w-7xl flex justify-center mx-auto py-1 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="fixed w-full h-full top-12 left-0 p-5">
                <ScrollPanel
                        style="width: 100%; height: 100%"
                        :dt="{
                            bar: {
                                background: '{primary.color}'
                            }
                        }"
                    >
                            <slot />
                </ScrollPanel>
            </main>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.bg-perso {
    filter: invert(1);
}
.menu-bar {
    padding: 7px 7px 7px 7px;
    border-radius: 20px;
    border: none;
}
</style>
