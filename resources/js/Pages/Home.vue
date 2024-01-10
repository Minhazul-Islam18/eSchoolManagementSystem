<script setup>
import { computed, reactive, defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { usePage, router } from '@inertiajs/vue3';
// import { useToast } from "vue-toastification";
// const toast = useToast()


const page = usePage()
const is_authenticated = computed(() => page.props.is_authenticated)
console.log(is_authenticated);
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

                <a v-if="is_authenticated" type="button"
                    class=" border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3"
                    style="font-family: 'Jost', sans-serif;" href="/app/register">Register</a>
                <a v-else
                    class=" border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3"
                    type="button" style="font-family: 'Jost', sans-serif;" href="/users-redirection">Dashboard</a>
            </div>
            <div :style="{ backgroundImage: `url('/frontend/hero_1.png')` }"
                class="w-full hidden md:block md:w-7/12 md:bg-contain lg:bg-contain xl:bg-cover bg-no-repeat bg-center">
            </div>
        </div>
    </section>
    <!---- End hero---->
</template>
