<template>
    <div>
        <h1>Sign Up</h1>
        <form @submit.prevent="submitForm">  <!-- .prevent empêche le rechargement de la page -->
            <div class="p-field">
                <label for="name">Name</label>
                <InputText id="name" v-model="name" />
            </div>
            <div class="p-field">
                <label for="email">Email</label>
                <InputText id="email" v-model="email" />
            </div>
            <div class="p-field">
                <label for="password">Password</label>
                <Password id="password" v-model="password" />
            </div>
            <Button type="submit" label="Sign Up" />
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const name = ref('');
const email = ref('');
const password = ref('');

const submitForm = () => {
    console.log('Name:', name.value);
    console.log('Email:', email.value);
    console.log('Password:', password.value);
};
</script>
