<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    products: Array,
    userLikes: Array
});

const likedProducts = ref(new Set(props.userLikes));

const toggleLike = (productId) => {
    router.post('/like', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: (response) => {
            if (likedProducts.value.has(productId)) {
                likedProducts.value.delete(productId);
            } else {
                likedProducts.value.add(productId);
            }
        },
        onError: (error) => {
            console.error('Erreur lors du like', error);
        }
    });
};
</script>

<template>
    <Head title="Home" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Home</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold">Products</h3>
                        <ul>
                            <li v-for="product in products" :key="product.id">
                                <strong>{{ product.name }}</strong> - {{ product.price }}€ (Modèle: {{ product.model }})
                                <button @click="toggleLike(product.id)">
                                    {{ likedProducts.has(product.id) ? 'Unlike' : 'Like' }}
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
