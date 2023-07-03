<script setup>
import { nextTick, ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";

const recovery = ref(false);

const form = useForm({
    code: "",
    recovery_code: "",
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = "";
    } else {
        codeInput.value.focus();
        form.recovery_code = "";
    }
};

const submit = () => {
    form.post(route("two-factor.login"));
};
</script>

<template>
    <Head title="Two-factor Confirmation" />

    <AuthenticationCard>
        <div class="flex justify-center">
            <ApplicationMark class="h-1/4 w-1/4"></ApplicationMark>
        </div>

        <div class="mb-4 text-sm text-gray-600">
            <template v-if="!recovery">
                Please confirm access to your account by entering the
                authentication code provided by your authenticator application.
            </template>

            <template v-else>
                Please confirm access to your account by entering one of your
                emergency recovery codes.
            </template>
        </div>

        <form @submit.prevent="submit">
            <div v-if="!recovery">
                <InputLabel for="code" value="Code" />
                <TextInput
                    id="code"
                    ref="codeInput"
                    v-model="form.code"
                    autocomplete="one-time-code"
                    autofocus
                    class="mt-1 block w-full"
                    inputmode="numeric"
                    type="text"
                />
                <InputError :message="form.errors.code" class="mt-2" />
            </div>

            <div v-else>
                <InputLabel for="recovery_code" value="Recovery Code" />
                <TextInput
                    id="recovery_code"
                    ref="recoveryCodeInput"
                    v-model="form.recovery_code"
                    autocomplete="one-time-code"
                    class="mt-1 block w-full"
                    type="text"
                />
                <InputError :message="form.errors.recovery_code" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button
                    class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                    type="button"
                    @click.prevent="toggleRecovery"
                >
                    <template v-if="!recovery"> Use a recovery code </template>

                    <template v-else> Use an authentication code </template>
                </button>

                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="ml-4"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
