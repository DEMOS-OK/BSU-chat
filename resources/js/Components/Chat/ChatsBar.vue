<script setup>
import PageBlock from "@/Components/Chat/PageBlock.vue";
import { Input, ListGroup, ListGroupItem } from "flowbite-vue";
import ChatIcon from "@/Components/Chat/ChatIcon.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    chats: Array,
    selectedChat: Object,
});
</script>

<template>
    <PageBlock add-class="sm:w-auto md:w-1/4">
        <Input label="Search user" placeholder="Enter user name" type="text" />
        <div class="mt-5 mb-2 flex gap-3 items-center">
            <ChatIcon></ChatIcon>
            <p>Chats</p>
        </div>
        <ListGroup class="w-full">
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
    </PageBlock>
</template>
