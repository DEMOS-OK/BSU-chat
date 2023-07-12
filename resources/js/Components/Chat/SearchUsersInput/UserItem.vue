<script setup>
import { ListGroupItem } from "flowbite-vue";

defineProps({
    name: String,
    key: Number,
    selected: Boolean,
});

defineEmits(["itemChanged"]);
</script>

<template>
    <ListGroupItem
        :key="key"
        class="py-3 text-[15px] flex justify-between"
        @click="setSelected"
    >
        <div>
            {{ name }}
        </div>
        <div
            v-if="isSelected"
            class="py-1 px-2 bg-purple-200 rounded shadow-sm"
        >
            Added
        </div>
    </ListGroupItem>
</template>

<script>
export default {
    data() {
        return {
            isSelected: this.selected,
        };
    },
    methods: {
        setSelected() {
            this.isSelected = !this.isSelected;
            this.$emit("itemChanged");
        },
    },
};
</script>
