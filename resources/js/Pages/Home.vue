<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed, defineProps } from 'vue';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    products: Array,
    userLikes: Array,
    userCards: Array
});

const likedProducts = ref(new Set(props.userLikes));
const cardProducts = ref(new Set(props.userCards));

const searchQuery = ref('');

const filteredProducts = computed(() => {
    return props.products.filter(product =>
        product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const toggleLike = (productId) => {
    router.post('/like', { product_id: productId }, {
        preserveScroll: true,
        onSuccess: () => {
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
            console.error('Erreur lors de l’ajout au panier', error);
        }
    });
};
const selectedProduct = ref(null);

const visible = ref(false);



</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Home</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <IconField>
                        <InputIcon class="pi pi-search " />
                        <InputText v-model="searchQuery" placeholder="Search" size="large"  />
                    </IconField>
                    <br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Products</h3>

                    <Card style="width: 25rem; overflow: hidden" v-for="product in filteredProducts" :key="product.id" class="mb-2">
                    <template #title>{{ product.name }}</template>
                    <template #subtitle>{{ product.model }}</template>
                    <template #content>{{ product.price }}€ </template>
                    <template #footer>
                        <div class="flex gap-4 mt-1">
                            <Button
                            :icon="likedProducts.has(product.id) ? 'pi pi-heart-fill' : 'pi pi-heart'"
                            :label="likedProducts.has(product.id) ? 'Unlike' : 'Like'"
                            variant="text"
                            @click="toggleLike(product.id)"
                            class="ml-2 p-1 border rounded"
                            :class="{ 'text-red-500': likedProducts.has(product.id) }">
                            </Button>

                            <Button
                            :icon="cardProducts.has(product.id)  ? 'pi pi-shopping-bag-fill' : 'pi pi-shopping-bag'"
                            :label="cardProducts.has(product.id) ? 'Remove' : 'Add to cart'"
                            variant="text"
                            @click="addCard(product.id)"
                            class="ml-2 p-1 border rounded"
                            :class="{ 'text-red-500': cardProducts.has(product.id)  }">
                            </Button>

                            <Button
                                :icon="'pi pi-arrow-up-right-and-arrow-down-left-from-center'"
                                :label="''"
                                variant="text"
                                @click="selectedProduct = product; visible = true"
                                class="ml-2 p-1 border rounded"
                            />


                            <Dialog v-model:visible="visible" maximizable modal header="Détails du produit"
                                :style="{ width: '50rem' }"
                                :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">

                                <template v-if="selectedProduct">
                                    <h2 class="text-lg font-bold">{{ selectedProduct.name }}</h2>
                                    <p><strong>Prix:</strong> {{ selectedProduct.price }}€</p>
                                    <p><strong>Modèle:</strong> {{ selectedProduct.model }}</p>
                                    <p><strong>Description:</strong> {{ selectedProduct.description || 'Aucune description' }}</p>
                                </template>

                                <button
                                    @click="visible = false"
                                    class="mt-4 px-4 py-2 rounded"
                                >
                                    Fermer
                                </button>
                            </Dialog>

                        </div>
                    </template>
                </Card>


                </div>
            </div>
        </div>



    </AuthenticatedLayout>
</template>
