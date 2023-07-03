<script setup>
import ChatBlock from "@/Components/Chat/ChatBlock.vue";
import Message from "@/Components/Chat/Message.vue";
import { Input } from "flowbite-vue";
import MessagesIcon from "@/Components/Chat/MessagesIcon.vue";

defineProps({
    user: Object,
    messages: Array,
});
</script>

<template>
    <div class="flex flex-col w-3/4 rounded shadow-md">
        <ChatBlock add-class="rounded-b-none shadow-none">
            <div
                class="flex items-center gap-3 border-b-2 pb-3 border-gray-200"
            >
                <div class="w-7 h-7">
                    <MessagesIcon></MessagesIcon>
                </div>
                <p>Messages</p>
            </div>
            <div class="page-block flex flex-col gap-3 mt-5">
                <Message
                    v-for="message of messages"
                    :add-class="
                        user.id === message.user_id
                            ? 'ml-auto bg-blue-300 text-black'
                            : ''
                    "
                    :author="message.author"
                    :date="message.created_at"
                    :text="message.text"
                    :user="user"
                />
            </div>
        </ChatBlock>
        <div class="h-[100px] bg-white p-4 flex items-center">
            <Input class="w-full" placeholder="Enter the message..." />
        </div>
    </div>
</template>
