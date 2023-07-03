<script setup>
defineProps({
    addClass: String,
});
</script>

<template>
    <div
        :class="[
            'bg-white p-4 rounded shadow-md overflow-x-scroll page-block',
            addClass,
        ]"
    >
        <slot></slot>
    </div>
</template>

<style scoped>
.page-block {
    height: 600px;
}
</style>
