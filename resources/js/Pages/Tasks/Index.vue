<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-4 items-center justify-center min-h-screen bg-gray-900">
                        <div class="col-span-12">
                            <div class="overflow-auto lg:overflow-visible">
                                <table class="table text-gray-400 border-separate space-y-6 text-sm w-full">
                                    <thead class="bg-gray-800 text-gray-500">
                                        <tr>
                                            <th class="p-3 text-left">ID</th>
                                            <th class="p-3 text-left">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-gray-800" v-for="task in tasks" :key="task.id">
                                            <td class="p-3">{{ task.id }}</td>
                                            <td class="p-3">{{ task.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
        },
        props: {
            tasks: Array,
        },
    })
</script>