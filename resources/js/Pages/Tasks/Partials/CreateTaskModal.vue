<template>
    <v-tailwind-modal v-model="show">
        <template v-slot:title>Enter Task Details</template>
        <form @submit.prevent="form.post('/tasks')">
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
            <div class="flex items-center justify-start w-full">
                <button
                    type="submit"
                    class="
                        focus:outline-none
                        focus:ring-2
                        focus:ring-offset-2
                        focus:ring-indigo-700
                        transition
                        duration-150
                        ease-in-out
                        hover:bg-indigo-600
                        bg-indigo-700
                        rounded
                        text-white
                        px-8
                        py-2
                        text-sm
                    "
                    @click="$emit('modalClose', close)"
                >
                    Submit
                </button>
                <button
                    type="button"
                    class="
                        focus:outline-none
                        focus:ring-2
                        focus:ring-offset-2
                        focus:ring-gray-400
                        ml-3
                        bg-gray-100
                        transition
                        duration-150
                        text-gray-600
                        ease-in-out
                        hover:border-gray-400 hover:bg-gray-300
                        border
                        rounded
                        px-8
                        py-2
                        text-sm
                    "
                    @click="$emit('modalClose')"
                >
                    Cancel
                </button>
            </div>
        </form>
    </v-tailwind-modal>
</template>

<script>
    import VTailwindModal from "@/Shared/VTailwindModal.vue";
    import { useForm } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            VTailwindModal,
        },
        name: "CreateTaskModal",
        inheritAttrs: false,
        props: ['show'],
        setup () {
            const form = useForm({
                name: null,
            })

            return { form }
        },
    };
</script>