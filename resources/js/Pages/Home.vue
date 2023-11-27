<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const logo = computed(() => page.props.logo)
</script>
<template>
    <section id="hero-top" class="h-screen py-6 md:py-0 bg-gradient-to-t from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]">
        <div class="flex flex-wrap flex-col sm:flex-row container h-full mx-auto">
            <div class="w-full md:w-5/12 flex flex-col justify-center items-start">
                <h1 class=" font-extrabold text-5xl leading-12 text-emerald-500 ">শিক্ষা ব্যবস্থাপনা সফটওয়্যার</h1>
                <h5 class=" font-semibold text-2xl">Education management system</h5>
                <p class="mt-4 mb-3 text-md antialiased">আরসিটিসেবা আপনার প্রতিষ্ঠানের কাজগুলো সহজে, ডিজিটাল উপায়ে ও
                    ঝামেলাহীনভাবে শিক্ষক-শিক্ষার্থী ও
                    অভিভাবকদের মধ্যে সমন্বয় করে.</p>
                <p class="mt-2 mb-3 sm:mb-6 text-md antialiased">
                    আপনার শিক্ষা প্রতিষ্ঠানকে ডিজিটাল ও স্মার্ট করুন আরসিটি এম এস-এর মাধ্যমে
                </p>

                <Link href="/" type="button"
                    class=" border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3">
                Register</Link>
            </div>
            <div
                class="w-full hidden md:block md:w-7/12 bg-[url('/public/frontend/hero_1.png')] bg-cover bg-no-repeat bg-center">
            </div>
        </div>
    </section>


    <section class="py-10 bg-gradient-to-b from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]">
        <div class="flex flex-wrap flex-col sm:flex-row container h-full mx-auto">
            <div class="w-3/12"></div>
            <div class="w-5/12 flex flex-col justify-center items-start">
                <h1 class=" font-extrabold text-5xl leading-12 text-emerald-500 ">শিক্ষা ব্যবস্থাপনা সফটওয়্যার</h1>
                <h5 class=" font-semibold text-2xl">Education management system</h5>
                <p class="mt-4 mb-3 text-md antialiased">আরসিটিসেবা আপনার প্রতিষ্ঠানের কাজগুলো সহজে, ডিজিটাল উপায়ে ও
                    ঝামেলাহীনভাবে শিক্ষক-শিক্ষার্থী ও
                    অভিভাবকদের মধ্যে সমন্বয় করে.</p>
                <p class="mt-2 mb-3 sm:mb-6 text-md antialiased">
                    আপনার শিক্ষা প্রতিষ্ঠানকে ডিজিটাল ও স্মার্ট করুন আরসিটি এম এস-এর মাধ্যমে
                </p>

                <Link href="/" type="button"
                    class=" border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3">
                Register</Link>
            </div>
            <div class="w-3/12"></div>
        </div>
    </section>
</template>
