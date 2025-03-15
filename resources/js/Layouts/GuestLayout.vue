<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-dots bg-center selection:bg-gray-300 selection:text-black">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <Card>
            <template #content>
                <div>
                    <slot />
                </div>
            </template>
        </Card>
    </div>
</template>
1