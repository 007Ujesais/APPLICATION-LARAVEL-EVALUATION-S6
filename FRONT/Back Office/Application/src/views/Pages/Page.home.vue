<template>
    <div class="home-page">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Hi there, Isaac &nbsp; &nbsp; &nbsp; Welcome to My App</h1>
                <p class="hero-subtitle">Discover a unique experience with our advanced features.</p>
            </div>
        </section>
    </div>
</template>

<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const goToFeatures = () => {
    router.push("/features");
};
</script>

<style scoped>
.home-page {
    text-align: center;
    padding: 40px;
}

.hero-content {
    width: 1000px;
    text-align: left;
    line-height: 0.9; /* Ajuste l'espacement entre les lignes de texte */
}

.hero {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    position: relative;
    overflow: hidden;
}

.hero-title {
    font-size: 5.5rem;
    font-weight: bold;
    margin-bottom: 10px;
    background: linear-gradient(135deg, var(--p-primary-color), var(--p-primary-100));
    -webkit-background-clip: text;
    color: transparent;
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 20px;
    width: 500px;
    text-align: left;
    opacity: 0.7;
}

/* Responsive */
@media (max-width: 768px) {
    .hero {
        flex-direction: column;
        text-align: center;
    }
    .hero-content {
        text-align: center;
    }
}
</style>
