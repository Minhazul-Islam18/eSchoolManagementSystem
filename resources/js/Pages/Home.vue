<script setup>
import { computed, reactive, defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { usePage, router } from '@inertiajs/vue3';
// import { useToast } from "vue-toastification";
// const toast = useToast()


const page = usePage()
// const logo = computed(() => page.props.logo)
const form = reactive({
    amount: null,
    id: null
});

const freePack = reactive({
    id: null
});

// function purchase(id, amount) {
//     form.amount = amount;
//     form.id = id;
//     console.log(form);
//     router.get('/bkash/payment', form)
// }

// async function free(id) {
//     try {
//         freePack.id = id;
//         router.get('process-free-package', freePack);
//         // toast('Package purchased');
//     } catch (error) {
//         console.log(error);
//         // toast("error");
//     }

// }

const props = defineProps({
    // pricings: Array | Object,
    school: Array | Object,
    package_purchased: String,
    message: String,
});

</script>

<template>
    <Head>
        <title>Home - RCT ems</title>
        <meta name="keywords" content="RCT Seba, RCT ems, ems, lms">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    </Head>
    <!---- Hero ---->
    <section id="hero-top"
        class="h-screen py-6 md:py-0 md:bg-gradient-to-t from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc] bg-[url('/public/frontend/hero_1.png')] bg-no-repeat bg-contain bg-bottom">
        <div class="flex flex-wrap flex-col sm:flex-row container h-full mx-auto">
            <div class="w-full md:w-5/12 flex flex-col justify-center items-start">
                <h1 class=" font-extrabold text-3xl md:text-5xl leading-12 text-emerald-500 ">শিক্ষা ব্যবস্থাপনা সফটওয়্যার
                </h1>
                <h5
                    class=" font-semibold text-lg md:text-2xl before:block before:absolute before:-inset-1 -skew-y-3  md:transform-none before:bg-pink-500 md:before:bg-transparent my-4 md:my-1 relative inline-block z-10">
                    <span class="relative text-white md:text-slate-900" style="font-family: 'Jost', sans-serif;">Education
                        management
                        system</span>
                </h5>
                <p class="mt-4 mb-3 text-md antialiased">আরসিটিসেবা আপনার প্রতিষ্ঠানের কাজগুলো সহজে, ডিজিটাল উপায়ে ও
                    ঝামেলাহীনভাবে শিক্ষক-শিক্ষার্থী ও
                    অভিভাবকদের মধ্যে সমন্বয় করে.</p>
                <p class="mt-2 mb-3 sm:mb-6 text-md antialiased">
                    আপনার শিক্ষা প্রতিষ্ঠানকে ডিজিটাল ও স্মার্ট করুন আরসিটি ই এম এস-এর মাধ্যমে
                </p>

                <Link href="/app/register" type="button"
                    class=" border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3"
                    style="font-family: 'Jost', sans-serif;">
                Register</Link>
            </div>
            <div :style="{ backgroundImage: `url('/frontend/hero_1.png')` }"
                class="w-full hidden md:block md:w-7/12 md:bg-contain lg:bg-contain xl:bg-cover bg-no-repeat bg-center">
            </div>
        </div>
    </section>
    <!---- End hero---->

    <!-- <section id="pricing-plan" class=" py-10 bg-gradient-to-b from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]"
        style="font-family: 'Jost', sans-serif;">
        <div class="container mx-auto">
            <div
                class="relative z-10 overflow-hidden rounded-sm border border-stroke bg-white p-11 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="w-full overflow-x-auto">
                    <table class="table-auto w-full" v-if="props.pricings.length > 0">
                        <thead>
                            <tr>
                                <th class="w-1/4 min-w-[200px] px-5"></th>

                                <th class="w-1/4 min-w-[200px] px-5" v-for="pricing in  props.pricings " :key="pricing.id">
                                    <form
                                        @submit.prevent="pricing.price > 0 ? purchase(pricing.id, pricing.price) : free(pricing.id)">
                                        <div class="mb-10 text-left"><span
                                                class="mb-3.5 block text-xl font-bold text-black dark:text-white">{{
                                                    pricing.name }}</span>
                                            <h4 class="mb-4"><span
                                                    class="text-[28px] font-bold text-black dark:text-white lg:text-[32px]">
                                                    <sup class="font-xs">৳</sup>
                                                    {{
                                                        pricing.price ?? 0 }}</span><sub class="font-xs">/ Month</sub>
                                            </h4>
                                            <p class="mb-6 text-base font-medium">{{ pricing.additional_features }}</p>
                                            <button v-show="props.school !== null && props.school.package_id == null"
                                                :disabled="form.processing"
                                                class="block w-full rounded-md bg-primary p-3 text-center font-medium text-white transition hover:bg-opacity-90"
                                                type="submit">
                                                {{ pricing.price > 0 ? 'Purchase Now' :
                                                    'Free' }}</button>
                                        </div>

                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-t border-r border-stroke py-5 px-7 dark:border-strokedark border-l">
                                    <h5 class="font-medium text-black dark:text-white">Key Features</h5>
                                </td>
                                <td class="border-t border-r border-stroke py-5 px-7 dark:border-strokedark"
                                    v-for="pricing in  props.pricings" :key="pricing.id">
                                    <h5 class="font-medium text-black dark:text-white text-center">Key Features</h5>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    class=" border-l border-t border-r border-b border-stroke py-5 px-7 dark:border-strokedark">
                                    <p class="font-medium">Allowed students</p>
                                </td>
                                <td class="border-t border-l border-stroke py-5 px-7 dark:border-strokedark border-b border-r"
                                    v-for=" pricing  in  props.pricings " :key="pricing.id">
                                    <p class="text-center font-medium">{{ pricing.allowed_students }}</p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <h1 class="text-xl text-center font-extrabold" v-else>{{ 'Sorry, No plans found!' }}</h1>
                </div>
                <div class="absolute top-0 left-0 -z-1">
                    <span class="absolute top-0 left-0 -z-1">
                        <svg width="213" height="188" viewBox="0 0 213 188" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="75" cy="50" r="138" fill="url(#paint0_linear)"></circle>
                            <defs>
                                <linearGradient id="paint0_linear" x1="75" y1="-88" x2="75" y2="188"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3056D3" stop-opacity="0.15"></stop>
                                    <stop offset="1" stop-color="#C4C4C4" stop-opacity="0"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                    <span class="absolute top-30 left-11 -z-1">
                        <svg width="50" height="109" viewBox="0 0 50 109" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="47.71" cy="107.259" r="1.74121" transform="rotate(180 47.71 107.259)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="91.9355" r="1.74121" transform="rotate(180 47.71 91.9355)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="76.6133" r="1.74121" transform="rotate(180 47.71 76.6133)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="47.0132" r="1.74121" transform="rotate(180 47.71 47.0132)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="16.7158" r="1.74121" transform="rotate(180 47.71 16.7158)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="61.6392" r="1.74121" transform="rotate(180 47.71 61.6392)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="32.0386" r="1.74121" transform="rotate(180 47.71 32.0386)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="47.71" cy="1.74121" r="1.74121" transform="rotate(180 47.71 1.74121)"
                                fill="#3056D3">
                            </circle>
                            <circle cx="32.3877" cy="107.259" r="1.74121" transform="rotate(180 32.3877 107.259)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="91.9355" r="1.74121" transform="rotate(180 32.3877 91.9355)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="76.6133" r="1.74121" transform="rotate(180 32.3877 76.6133)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="47.0132" r="1.74121" transform="rotate(180 32.3877 47.0132)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="16.7158" r="1.74121" transform="rotate(180 32.3877 16.7158)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="61.6392" r="1.74121" transform="rotate(180 32.3877 61.6392)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="32.0386" r="1.74121" transform="rotate(180 32.3877 32.0386)"
                                fill="#3056D3"></circle>
                            <circle cx="32.3877" cy="1.74121" r="1.74121" transform="rotate(180 32.3877 1.74121)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="107.259" r="1.74121" transform="rotate(180 17.0654 107.259)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="91.9355" r="1.74121" transform="rotate(180 17.0654 91.9355)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="76.6133" r="1.74121" transform="rotate(180 17.0654 76.6133)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="47.0132" r="1.74121" transform="rotate(180 17.0654 47.0132)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="16.7158" r="1.74121" transform="rotate(180 17.0654 16.7158)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="61.6392" r="1.74121" transform="rotate(180 17.0654 61.6392)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="32.0386" r="1.74121" transform="rotate(180 17.0654 32.0386)"
                                fill="#3056D3"></circle>
                            <circle cx="17.0654" cy="1.74121" r="1.74121" transform="rotate(180 17.0654 1.74121)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="107.259" r="1.74121" transform="rotate(180 1.74121 107.259)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="91.9355" r="1.74121" transform="rotate(180 1.74121 91.9355)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="76.6133" r="1.74121" transform="rotate(180 1.74121 76.6133)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="47.0132" r="1.74121" transform="rotate(180 1.74121 47.0132)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="16.7158" r="1.74121" transform="rotate(180 1.74121 16.7158)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="61.6392" r="1.74121" transform="rotate(180 1.74121 61.6392)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="32.0386" r="1.74121" transform="rotate(180 1.74121 32.0386)"
                                fill="#3056D3"></circle>
                            <circle cx="1.74121" cy="1.74121" r="1.74121" transform="rotate(180 1.74121 1.74121)"
                                fill="#3056D3"></circle>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </section> -->
</template>
