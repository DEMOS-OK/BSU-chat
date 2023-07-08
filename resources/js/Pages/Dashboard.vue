<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import ChatsBar from "@/Components/Chat/ChatsBar.vue";
import MessagesBar from "@/Components/Chat/MessagesBar.vue";

defineProps({
    user: Array,
    chats: Array,
    selectedChat: Object,
    messages: Array,
});
</script>

<template>
    <AppLayout title="Home">
        <Container>
            <div class="flex sm:flex-col md:flex-row gap-5 py-10">
                <ChatsBar
                    :chats="chats"
                    :selected-chat="selectedChat"
                ></ChatsBar>
                <MessagesBar
                    :messages="messages"
                    :selected-chat="selectedChat"
                    :user="user"
                ></MessagesBar>
            </div>
        </Container>
    </AppLayout>
</template>
