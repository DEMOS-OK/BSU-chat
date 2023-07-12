<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import ChatsBar from "@/Components/Chat/ChatsBar.vue";
import MessagesBar from "@/Components/Chat/MessagesBar.vue";
import AddChatModal from "@/Components/Chat/AddChatModal.vue";
import { ref } from "vue";

defineProps({
    user: Object,
    chats: Array,
    selectedChat: Object,
    messages: Array,
});

let modalForAddingChatIsShowed = ref(false);
</script>

<template>
    <AppLayout title="Home">
        <Container>
            <div class="flex sm:flex-col md:flex-row gap-5 py-10">
                <ChatsBar
                    :chats="chats"
                    :selected-chat="selectedChat"
                    @show-modal="modalForAddingChatIsShowed = true"
                ></ChatsBar>
                <MessagesBar
                    :messages="messages"
                    :selected-chat="selectedChat"
                    :user="user"
                ></MessagesBar>
            </div>
        </Container>
    </AppLayout>
    <AddChatModal
        :is-showed="modalForAddingChatIsShowed"
        :on-close-handler="() => (modalForAddingChatIsShowed = false)"
    ></AddChatModal>
</template>
