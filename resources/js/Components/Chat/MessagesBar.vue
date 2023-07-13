<script setup>
import ChatBlock from "@/Components/Chat/ChatBlock.vue";
import Message from "@/Components/Chat/Message.vue";
import { Button, Input } from "flowbite-vue";
import MessagesIcon from "@/Components/Chat/Icons/MessagesIcon.vue";
import Preloader from "@/Components/Preloader.vue";

defineProps({
    user: Object,
    messages: Array,
    selectedChat: Object,
});

defineEmits(["editChat"]);
</script>

<template>
    <div class="flex flex-col w-3/4 rounded shadow-md">
        <div
            class="flex items-center gap-3 border-b-2 pb-3 border-gray-200 bg-white px-4 py-2"
        >
            <div class="w-7 h-7">
                <MessagesIcon />
            </div>
            <p v-if="selectedChat">
                <a href="#" @click="this.$emit('editChat')">
                    {{ selectedChat.title }}
                </a>
            </p>
            <p v-else>Messages</p>
        </div>
        <div v-if="this.showMessagesPreloader" class="flex justify-center mt-5">
            <Preloader />
        </div>

        <!-- Messages block -->
        <ChatBlock
            id="scrollContainer"
            add-class="rounded-b-none shadow-none"
            v-on:scroll="listenScrollEvents"
        >
            <div class="page-block flex flex-col gap-3 mt-5">
                <Message
                    v-for="message of this.messagesState"
                    :add-class="
                        user.id === message.user_id
                            ? 'ml-auto bg-blue-300 text-black'
                            : 'bg-gray-100'
                    "
                    :author="message.author"
                    :date="message.created_at"
                    :text="message.text"
                    :user="user"
                />
            </div>
        </ChatBlock>

        <!-- Message entering block -->
        <div class="h-[100px] bg-white p-4 flex items-center gap-3">
            <Input
                class="w-full"
                placeholder="Enter the message..."
                @keyup="setMessageText"
            />
            <Button color="dark" @click="sendMessage">Send</Button>
        </div>
    </div>
</template>

<script>
import loadMoreMessages from "@/API/Message/loadMoreMessages.js";
import createMessage from "@/API/Message/createMessage.js";

export default {
    mounted() {
        this.scrollToBottom();
    },
    data() {
        return {
            // Chat properties
            step: 0,
            messagesState: this.messages.reverse(),
            showMessagesPreloader: false,

            // Message panel properties
            messageText: null,
        };
    },
    methods: {
        /**
         * Moves messages bar scroll to the bottom of the div
         */
        scrollToBottom() {
            const container = this.$el.querySelector("#scrollContainer");
            container.scrollTop = container.scrollHeight;
        },

        /**
         * Set state of the message text
         */
        setMessageText(e) {
            this.messageText = e.target.value;
        },

        /**
         * Init listeners for the scroll events
         */
        listenScrollEvents() {
            const container = this.$el.querySelector("#scrollContainer");
            if (container.scrollTop === 0) {
                this.showMessagesPreloader = true;
                setTimeout(() => {
                    this.loadMoreMessages();
                }, 500);
            }
        },

        /**
         * Loads more messages
         */
        loadMoreMessages() {
            this.step++;
            loadMoreMessages(this.selectedChat.id, this.step).then(
                (response) => {
                    for (let message of response.data.messages) {
                        this.messagesState.unshift(message);
                    }
                    window.location.hash = "#scrollContainer";
                    this.showMessagesPreloader = false;
                }
            );
        },

        /**
         * Send async request to create a message
         */
        sendMessage() {
            createMessage(
                this.messageText,
                this.user.id,
                this.selectedChat.id
            ).then((response) => {
                if (response.data.success) {
                    this.messagesState = response.data.messages.reverse();
                }
            });
            loadMoreMessages(this.selectedChat.id, this.step);
        },
    },
};
</script>
