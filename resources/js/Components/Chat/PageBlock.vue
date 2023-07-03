<script setup>
defineProps({
    addClass: String,
});
</script>

<template>
    <div :class="['page-block bg-white p-4 rounded shadow-md', addClass]">
        <slot></slot>
    </div>
</template>

<style scoped>
.page-block {
    min-height: 700px;
}
</style>
