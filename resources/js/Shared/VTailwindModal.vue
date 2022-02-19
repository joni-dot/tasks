<template>
    <vue-final-modal
        v-slot="{ params, close }"
        v-bind="$attrs"
        classes="flex justify-center items-center"
        content-class="relative flex flex-col max-h-full mx-4 p-4 border dark:border-gray-800 rounded bg-white dark:bg-gray-900"
    >
        <h2 class="mr-8 text-2xl font-bold text-white mb-3">
            <slot name="title"></slot>
        </h2>
        <div class="flex-grow overflow-y-auto text-white">
            <slot v-bind:params="params"></slot>
        </div>
        <div class="flex-shrink-0 flex justify-end pt-4">
            <button class="bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="$emit('cancel', close)">
                Cancel
            </button>
            <button class="ml-3 bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" @click="$emit('confirm', close)">
                Confirm
            </button>
        </div>
    </vue-final-modal>
</template>

<script>
import { $vfm, VueFinalModal, ModalsContainer } from "vue-final-modal";

export default {
    components: {
        VueFinalModal,
        ModalsContainer,
    },
    name: "VTailwindModal",
    inheritAttrs: false,
};
</script>