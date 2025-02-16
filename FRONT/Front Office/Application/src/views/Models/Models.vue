<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
</script>

<template>
    <Card>
        <template #header>
            <Header />
        </template>
        <template #content>
            <ScrollPanel class="layout">
                <router-view />
            </ScrollPanel>
        </template>
        <template #footer>
            <Footer />
        </template>
    </Card>
</template>

<style lang="scss" scoped>
.layout {
    display: flex;
    flex-direction: column;
    min-height: 66vh;
}

</style>
