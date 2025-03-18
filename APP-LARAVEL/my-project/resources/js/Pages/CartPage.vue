<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';

// Props venant du contrôleur
const props = defineProps({
    cardProducts: Array,
});

// Convertir les produits en un tableau réactif
const cardProducts = ref([...props.cardProducts]);

// Fonction pour supprimer un produit du panier
const addCard = (productId) => {
    router.post('/card', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: () => {
            if (cardProducts.value.has(productId)) {
                cardProducts.value.delete(productId);
            } else {
                cardProducts.value.add(productId);
            }
        },
        onError: (error) => {
            console.error('Erreur lors du ajout au panier', error);
        }
    });
};
// Fonction pour mettre à jour la quantité d'un produit
const updateQuantity = (productId, quantity) => {
    router.post('/card/update-quantity', { product_id: productId, quantity }, {
        preserveScroll: true,
        onSuccess: () => {
            const product = cardProducts.value.find(p => p.id === productId);
            if (product) {
                product.quantity = quantity;
            }
        },
        onError: (error) => {
            console.error('Erreur lors de la mise à jour de la quantité', error);
        },
    });
};
</script>

<template>
    <Head title="Cart" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">My Cart</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold">Liste des produits</h3>
                        <ul v-if="cardProducts.length">
                            <li v-for="product in cardProducts" :key="product.id" class="mb-4">
                                <strong>{{ product.name }}</strong> - {{ product.price }}€ (Modèle: {{ product.model }})
                                <div class="flex items-center mt-2">
                                    <label for="quantity" class="mr-2">Quantité :</label>
                                    <input
                                        type="number"
                                        v-model="product.quantity"
                                        min="1"
                                        class="w-16 px-2 py-1 border rounded"
                                        @change="updateQuantity(product.id, product.quantity)"
                                    />

                                    <button
                                        @click="addCard(product.id)"
                                        class="ml-2 p-1 border rounded"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </li>
                        </ul>
                        <p v-else class="text-gray-500">Aucun produit ajouté pour le moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
