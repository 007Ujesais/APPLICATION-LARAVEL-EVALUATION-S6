<template>
    <div class="signin-form">
        <h2>Sign In</h2>
        <FloatLabel variant="on">
            <label for="username">Username</label>
            <InputText id="username" v-model="username" />
        </FloatLabel>

        <FloatLabel variant="on">
            <Password id="password" v-model="password" />
            <label for="password">Password</label>
        </FloatLabel>
        
        <Button label="Sign In" @click="signIn" />
    </div>
</template>

<script setup>
import { ref } from 'vue';

const username = ref('');
const password = ref('');

const signIn = () => {
    console.log('Username:', username.value);
    console.log('Password:', password.value);
};
</script>

<style lang="scss" scoped>
.signin-form {
    max-width: 300px;
    margin: 0 auto;
}
.form-group {
    margin-bottom: 20px;
}
</style>