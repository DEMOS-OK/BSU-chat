<script setup>
defineProps({
    user: Object,
    author: String,
    text: String,
    date: String,
});
</script>
<template>
    <div class="bg-green-200 rounded-md py-2 px-4 text-sm w-1/2">
        <p class="font-bold">{{ author }}</p>
        <p>{{ text }}</p>
        <div class="flex justify-end text-gray-500 font-light italic">
            {{ date }}
        </div>
    </div>
</template>
