<script setup>
defineProps(['value']);
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <span class="text-gray-700" v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
