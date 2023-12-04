<script setup>
import { computed, reactive, defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { usePage, router } from '@inertiajs/vue3';
// import { useToast } from 'vue-toastification';
// import { CheckCircle2, XCircle } from 'lucide-vue-next';

// import { useToast } from "vue-toastification";
// const toast = useToast()


const props = defineProps({
    'pricings': Array,
    'school': Array | Object,
    'message': String,
});

</script>

<template>
    <Head>
        <title>Contact - RCT ems</title>
        <meta name="keywords" content="RCT Seba, RCT ems, ems, lms">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    </Head>
    <section class="min-h-screen bg-gradient-to-tr from-[#b9ecfd] via-[#def5fd] via-40% to-[#f9fafc]"
        style="font-family: 'Jost', sans-serif;">
        <div class="container py-12 mx-auto">
            <h2 class=" text-3xl uppercase mb-4 pb-2 border-b border-emerald-500 font-extrabold">Contact us</h2>
            <div class="flex flex-wrap w-full flex-col gap-2">
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="form-label">Full name</label>
                    <input type="text" name="" class="form-input rounded" placeholder="Your Full name" id="">
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="form-label">E-mail</label>
                    <input type="email" name="" class="form-input rounded" placeholder="Your E-mail address" id="">
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="form-label">Phone number</label>
                    <input type="tel" name="" class="form-input rounded" placeholder="Your Phone number" id="">
                </div>
                <div class="flex flex-col gap-1 w-full">
                    <label for="" class="form-label">Message</label>
                    <textarea name="" class="form-input rounded" id="" cols="30" rows="10"
                        placeholder="Write your message here"></textarea>
                </div>

                <div>
                    <button type="submit"
                        class=" border border-slate-900 after:content-[''] after:w-full after:h-full after:border after:border-slate-900 after:absolute relative after:right-0 after:top-0 hover:after:translate-y-[5px] hover:after:right-[-5px] after:transition-all after:duration-300 cursor-pointer bg-emerald-500 text-white font-semibold hover:bg-emerald-400 transition-all duration-200 z-40 after:z-10 px-7 py-3">Submit</button>
                </div>
            </div>
        </div>
    </section>
</template>
