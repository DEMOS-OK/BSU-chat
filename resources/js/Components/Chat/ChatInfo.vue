<script setup>
import Modal from "@/Components/Modal.vue";
import { Button, Input } from "flowbite-vue";
import RemoveIcon from "@/Components/Chat/Icons/RemoveIcon.vue";
import SearchUsersInput from "@/Components/Chat/SearchUsersInput/SearchUsersBlock.vue";

defineProps({
    isShowed: Boolean,
    onCloseHandler: Function,
    chat: Object,
});
</script>

<template>
    <Modal :show="isShowed" @close="onCloseHandler">
        <div class="border-b-2 border-gray-100 px-6 py-3">Chat Info</div>
        <div class="px-6 py-6 flex flex-col gap-3">
            <!-- Chat title block -->
            <p class="font-bold text-xl">{{ title }}</p>
            <Input
                class="w-full"
                placeholder="Enter new chat title"
                required
                type="text"
                @input="title = $event.target.value"
            />

            <!-- Users block header -->
            <div class="flex items-center justify-between mt-4">
                <p class="font-bold text-xl">Users</p>
                <Button color="dark" @click="addUserMode = !addUserMode">
                    <span v-if="!addUserMode">Add</span>
                    <span v-else>Close</span>
                </Button>
            </div>

            <!-- Added users form -->
            <div
                v-for="user of users"
                class="flex justify-between items-center py-3 px-3 shadow-sm"
            >
                <div>{{ user.name }}</div>
                <div class="w-6 h-6">
                    <a href="#" @click="deleteUserFromChat(user)">
                        <RemoveIcon />
                    </a>
                </div>
            </div>

            <!-- Users search block -->
            <SearchUsersInput
                v-if="addUserMode"
                :except="newUsers"
                @users-selected="newUsers = $event"
            />
        </div>
        <div class="bg-gray-100 px-6 py-3">
            <div class="flex justify-end">
                <Button color="dark" @click="saveChat">Save</Button>
            </div>
        </div>
    </Modal>
</template>

<script>
import updateChat from "@/API/Chat/updateChat.js";
import removeUserFromChat from "@/API/Chat/removeUserFromChat.js";

export default {
    mounted() {
        this.newUsers = this.users.map((u) => u.id);
    },
    data() {
        return {
            addUserMode: false,
            id: this.chat.id,
            title: this.chat.title,
            users: this.chat.users,
            newUsers: [],
        };
    },
    methods: {
        async saveChat() {
            const result = await updateChat(this.id, this.title, this.newUsers);
            if (!result) {
                alert("Error when updating the chat!");
            } else {
                location.reload();
            }
        },

        async deleteUserFromChat(user) {
            const result = await removeUserFromChat(user.id, this.chat.id);
            if (!result) {
                alert("Unknown error");
            }

            this.users = this.users.filter((u) => u.id !== user.id);
            this.newUsers = this.users.map((u) => u.id);
        },
    },
};
</script>
