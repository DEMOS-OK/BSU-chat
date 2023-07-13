<script setup>
import ChatBlock from "@/Components/Chat/ChatBlock.vue";
import { Button, Input, ListGroup, ListGroupItem } from "flowbite-vue";
import ChatIcon from "@/Components/Chat/Icons/ChatIcon.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    chats: Array,
    selectedChat: {
        type: Object,
        required: false,
    },
});

defineEmits(["addChat"]);
</script>

<template>
    <ChatBlock add-class="sm:w-auto md:w-1/4 ">
        <div class="flex justify-between">
            <div class="flex gap-3 items-center">
                <ChatIcon></ChatIcon>
                <p>Chats</p>
            </div>

            <Button color="light" @click="$emit('addChat')">Add</Button>
        </div>
        <div class="mt-3">
            <Input
                label="Search chat"
                placeholder="Enter chat title"
                type="text"
            />
        </div>
        <ListGroup v-if="chats.length" class="w-full mt-2">
            <Link
                v-for="chat of chats"
                :data="{ chat_id: chat.id }"
                :href="route('dashboard')"
            >
                <ListGroupItem
                    :class="{ 'bg-gray-100': selectedChat.id === chat.id }"
                    class="py-3 text-[15px]"
                >
                    {{ chat.title.slice(0, 24) }}...
                </ListGroupItem>
            </Link>
        </ListGroup>
    </ChatBlock>
</template>
