<script setup>
import { Input, ListGroup } from "flowbite-vue";
import UserItem from "@/Components/Chat/SearchUsersInput/UserItem.vue";

defineProps({
    except: {
        type: Array,
        required: false,
    },
});

defineEmits(["usersSelected"]);
</script>

<template>
    <Input
        label="User FCs"
        placeholder="Enter the user FCs"
        type="text"
        @input="searchUsers"
    />
    <ListGroup class="w-full mt-2">
        <div v-for="(user, i) of this.users">
            <UserItem
                :key="i"
                :name="user.name"
                :selected="this.selectedUsers.indexOf(user.id) !== -1"
                @item-changed="itemChanged(user)"
            />
        </div>
    </ListGroup>
</template>

<script>
import searchUsersByNameQuery from "@/API/Message/searchUsersByNameQuery.js";

export default {
    data() {
        return {
            users: [],
            selectedUsers: [],
        };
    },
    methods: {
        searchUsers(e) {
            const nameQuery = e.target.value;
            if (!nameQuery.length) {
                this.users = [];
                return;
            }

            searchUsersByNameQuery(nameQuery, this.except ?? []).then(
                (response) => {
                    this.users = response.data.users;
                }
            );
        },

        itemChanged(user) {
            this.selectUser(user);
            this.$emit("usersSelected", this.selectedUsers);
        },

        selectUser(user) {
            // Add to list or delete user from list
            if (!this.selectedUsers.includes(user.id)) {
                this.selectedUsers.push(user.id);
            } else {
                this.selectedUsers.splice(
                    this.selectedUsers.indexOf(user.id),
                    1
                );
            }
        },
    },
};
</script>
