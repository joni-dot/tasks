<template>
    <v-tailwind-modal v-model="show" @confirm="confirm" @cancel="cancel">
        <template v-slot:title>Enter Task Details</template>
        <form @submit.prevent="submit">
            <label
                for="name"
                class="
                    text-gray-800 text-sm
                    font-bold
                    leading-tight
                    tracking-normal
                "
                >Task Name</label
            >
            <input
                id="name"
                name="name"
                class="
                    mb-5
                    mt-2
                    text-gray-600
                    focus:outline-none focus:border focus:border-indigo-700
                    font-normal
                    w-full
                    h-10
                    flex
                    items-center
                    pl-3
                    text-sm
                    border-gray-300
                    rounded
                    border
                "
                placeholder="Name"
                v-model="form.name"
            />
        </form>
    </v-tailwind-modal>
</template>

<script>
    import { reactive } from "vue";
    import { Inertia } from "@inertiajs/inertia";
    import VTailwindModal from "@/Shared/VTailwindModal.vue";

    export default {
        components: {
            VTailwindModal,
        },
        name: "CreateTaskModal",
        inheritAttrs: false,
        props: ['show'],
        data: () => ({
            form: reactive({
                name: null,
            }),
        }),
        methods: {
            confirm() {
                Inertia.post("/tasks", this.form);

                this.$emit('modalClose');
            },
            cancel(close) {
                close();

                this.$emit('modalClose');
            },
        },
    };
</script>