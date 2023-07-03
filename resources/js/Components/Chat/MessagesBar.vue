<script setup>
import PageBlock from "@/Components/Chat/PageBlock.vue";
import Message from "@/Components/Chat/Message.vue";

defineProps({
    user: Object,
    messages: Array,
});
</script>

<template>
    <PageBlock add-class="w-3/4">
        <p>Messages</p>
        <div class="flex flex-col gap-3 mt-5">
            <Message
                v-for="message of messages"
                :author="message.author"
                :date="message.created_at"
                :text="message.text"
                :user="user"
            />
        </div>
    </PageBlock>
</template>
