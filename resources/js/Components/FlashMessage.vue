<script setup>
import { defineProps, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { XCircle } from 'lucide-vue-next';

const page = usePage()
const props = defineProps({
    messages: Object,
    package_purchased: String,
});

watch(() => props.messages, async (value) => {
    await flasher.render(value);
}, { deep: true });

//close flash message on click
const closeFlash = (e) => {
    page.props.flash.message = null;
    page.props.flash.package_purchased = null;
};
</script>

<template>
    <div v-if="$page.props.flash.message || $page.props.flash.package_purchased"
        class="fixed left-0 right-0 z-[999] w-[90vw] mx-auto rounded-md mt-3 py-5 transition-all ease-in-out duration-400 bg-[#fea50098] pl-6 pr-4 flex items-center justify-between backdrop-blur-lg">
        <span class="text-md font-bold" style="font-family: 'Jost', sans-serif;">{{ $page.props.flash.message }}</span>
        <div @click="closeFlash($page.props.flash.message || $page.props.flash.package_purchased)">
            <XCircle class="cursor-pointer" />
        </div>
    </div>
</template>
