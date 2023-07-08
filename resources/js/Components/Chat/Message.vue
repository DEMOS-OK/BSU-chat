<script setup>
defineProps({
    user: Object,
    author: String,
    text: String,
    date: String,
    userIsAuthor: Boolean,
    addClass: String,
});
</script>
<template>
    <div :class="['rounded-md py-2 px-4 text-sm w-1/2 shadow-md', addClass]">
        <p class="font-bold">{{ author }}</p>
        <p>{{ text }}</p>
        <div class="flex justify-end text-gray-500 font-light italic">
            {{ date }}
        </div>
    </div>
</template>
