<template>
    <vue-final-modal
        v-slot="{ params, close }"
        v-bind="$attrs"
        classes="py-12
                bg-gray-700
                transition
                duration-150
                ease-in-out
                z-10
                absolute
                top-0
                right-0
                bottom-0
                left-0"
        content-class="container mx-auto w-11/12 md:w-2/3 max-w-lg"
    >
        <div
            class="
                relative
                py-8
                px-5
                md:px-10
                bg-white
                shadow-md
                rounded
                border border-gray-400
            "
        >
            <div class="w-full flex justify-start text-gray-600 mb-3">

            </div>
            <h1
                class="
                    text-gray-800
                    font-lg font-bold
                    tracking-normal
                    leading-tight
                    mb-4
                "
            >
                <slot name="title"></slot>
            </h1>
            <slot v-bind:params="params"></slot>
            <button
                class="
                    cursor-pointer
                    absolute
                    top-0
                    right-0
                    mt-4
                    mr-5
                    text-gray-400
                    hover:text-gray-600
                    transition
                    duration-150
                    ease-in-out
                    rounded
                    focus:ring-2 focus:outline-none focus:ring-gray-600
                "
                @click="$emit('cancel', close)"
                aria-label="close modal"
                role="button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-x"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    stroke-width="2.5"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
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