<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">
                Tasks
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div
                        class="
                            p-4
                            items-center
                            justify-center
                            min-h-screen
                            bg-gray-900
                        "
                    >
                        <div
                            class="
                                mt-3
                                mb-6
                                lg:mb-12
                                mx-auto
                                flex flex-col
                                lg:flex-row
                                items-start
                                lg:items-center
                                justify-between
                                pb-4
                                border-b border-gray-300
                            "
                        >
                            <div>
                                <h4
                                    class="
                                        text-2xl
                                        font-bold
                                        leading-tight
                                        text-gray-500
                                    "
                                >
                                    Task list
                                </h4>
                                <ul
                                    class="
                                        flex flex-col
                                        md:flex-row
                                        items-start
                                        md:items-center
                                        text-gray-600 text-sm
                                        mt-3
                                    "
                                >
                                    <li
                                        class="
                                            flex
                                            items-center
                                            mr-3
                                            mt-3
                                            md:mt-0
                                        "
                                    >
                                        <span
                                            >Tasks that has been created to the
                                            system.</span
                                        >
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-6 lg:mt-0">
                                <button
                                    class="
                                        transition
                                        duration-150
                                        ease-in-out
                                        hover:bg-green-700
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-offset-2
                                        focus:ring-green-700
                                        border
                                        bg-green-900
                                        rounded
                                        text-white
                                        px-4
                                        py-2
                                        text-sm
                                    "
                                    @click="show = true"
                                >
                                    <PlusCircleIcon class="h-5 w-5 text-white inline mr-1"/>
                                    Create Task
                                </button>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <div class="overflow-auto lg:overflow-visible">
                                <table
                                    class="
                                        table
                                        text-gray-400
                                        border-separate
                                        space-y-6
                                        text-sm
                                        w-full
                                    "
                                >
                                    <thead class="bg-gray-800 text-gray-500">
                                        <tr>
                                            <th class="p-3 text-left">ID</th>
                                            <th class="p-3 text-left">Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            class="bg-gray-800"
                                            v-for="task in tasks.data"
                                            :key="task.id"
                                        >
                                            <td class="p-3">{{ task.id }}</td>
                                            <td class="p-3">{{ task.name }}</td>
                                            <td class="p-3 text-right">
                                                <delete-task-button :taskId="task.id" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <pagination class="mt-6" :links="tasks.links" />
                    </div>
                </div>
            </div>
        </div>
        <create-task-modal :show="show" @modalClose="show = false" />
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Pagination";
import CreateTaskModal from "@/Pages/Tasks/Partials/CreateTaskModal.vue";
import { PlusCircleIcon } from '@heroicons/vue/solid';
import DeleteTaskButton from "@/Pages/Tasks/Partials/DeleteTaskButton.vue";

export default defineComponent({
    components: {
        AppLayout,
        Pagination,
        CreateTaskModal,
        PlusCircleIcon,
        DeleteTaskButton,
    },
    props: {
        tasks: Object,
    },
    data: () => ({
        show: false,
    }),
});
</script>