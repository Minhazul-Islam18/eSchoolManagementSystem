<script setup>
import { computed, reactive, defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { usePage, router } from '@inertiajs/vue3';

// const image = usePage().props.lockedImage;

const props = defineProps({
    image: String,
});

</script>

<template>
    <Head>
        <title>Profile locked - RCT ems</title>
        <meta name="keywords" content="RCT Seba, RCT ems, ems, lms">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    </Head>
    <section class="h-screen bg-gradient-to-tr from-[#b6b6b6] via-[#b6b6b6] via-40% to-[#b6b6b6]"
        style="font-family: 'Jost', sans-serif;">
        <div class="container py-12 mx-auto h-full">
            <div class="flex flex-col sm:flex-row h-full">
                <div class="w-[60%] flex flex-col justify-center items-start gap-y-[14px] sm:gap-y-[20px]">
                    <h2 class=" text-3xl font-extrabold uppercase">You're locked</h2>
                    <h5 class=" text-1xl font-extrabold capitalize">Please update your subscription to continue...</h5>
                </div>
                <div class="w-[40%] bg-center bg-no-repeat bg-cover" :style="{ backgroundImage: `url('${props.image}')` }">
                </div>
            </div>
        </div>
    </section>
</template>
