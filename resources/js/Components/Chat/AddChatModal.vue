<script setup>
import Modal from "../Modal.vue";
import { Button, Input } from "flowbite-vue";
import SearchUsersInput from "@/Components/Chat/SearchUsersInput/SearchUsersBlock.vue";

defineProps({
    isShowed: Boolean,
    onCloseHandler: Function,
});
</script>

<template>
    <Modal :show="isShowed" @close="onCloseHandler">
        <div class="border-b-2 border-gray-100 px-6 py-3">Adding chat form</div>
        <div class="px-6 py-6 flex flex-col gap-3">
            <Input
                label="Chat title"
                placeholder="Enter the chat title"
                required
                type="text"
                @input="chatTitle = $event.target.value"
            />

            <SearchUsersInput @users-selected="setSelectedUsers($event)" />
        </div>
        <div class="bg-gray-100 px-6 py-3">
            <div class="flex justify-end">
                <Button color="dark" @click="createNewChat">Create</Button>
            </div>
        </div>
    </Modal>
</template>

<script>
import createChat from "@/API/Chat/createChat.js";

export default {
    data() {
        return {
            chatTitle: null,
            selectedUsers: [],
        };
    },
    methods: {
        setSelectedUsers(users) {
            this.selectedUsers = users;
        },

        async createNewChat() {
            const result = await createChat(this.chatTitle, this.selectedUsers);
            if (result) {
                location.reload();
            } else {
                alert("Error when creating a chat!");
            }
        },
    },
};
</script>
