<template>
    <button
        class="
            transition
            duration-150
            ease-in-out
            hover:bg-red-700
            focus:outline-none
            focus:ring-2
            focus:ring-offset-2
            focus:ring-red-700
            border
            bg-red-900
            rounded
            text-white
            px-4
            py-2
            text-sm
        "
        @click="deleteTask()"
    >
        <TrashIcon class="h-5 w-5 text-white inline mr-1" />
        Delete
    </button>
</template>

<script>
import { defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { TrashIcon } from '@heroicons/vue/solid';

export default defineComponent({
    components: {
        Inertia,
        TrashIcon,
    },
    name: "DeleteTaskButton",
    props: ['taskId'],
    methods: {
        deleteTask() {
            Inertia.delete("/tasks/"+this.taskId, {
                _token: this.$page.props.csrf_token,
            });
        },
    },
});
</script>