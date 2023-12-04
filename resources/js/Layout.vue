<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const logo = computed(() => page.props.logo)
// const logo = ref('io');
</script>
<style>
/* Add styles for the mobile sidebar */
#mobile-menu {
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 240px;
    background-color: #2d3748;
    padding-top: 4rem;
    z-index: 999;
}

#mobile-menu a {
    color: #cbd5e0;
    /* Link text color */
}

#mobile-menu a:hover {
    color: #ffffff;
    /* Link text color on hover */
}

#mobile-menu .close-button {
    position: absolute;
    top: 1rem;
    right: 1rem;
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeButton = document.querySelector('#mobile-menu .close-button');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        mobileMenu.style.transform = 'translateX(0)';
    });

    closeButton.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        mobileMenu.style.transform = 'translateX(-100%)';
    });
});
</script>

<template>
    <main>
        <!-- Navbar for larger screens -->
        <nav class="hidden lg:flex bg-sky-500/50 backdrop-blur-2xl border-sky-500 border-b p-4 fixed w-full top-0 z-50">
            <div class="container mx-auto flex justify-between items-center">
                <div>
                    <img :src="'/storage/' + logo" class="w-[40px]" alt="">
                    <!-- <img :src="require('@/storage/')" alt=""> -->
                </div>
                <div class="flex gap-2 flex-wrap items-end justify-end">
                    <Link class="after:content-['|'] after:ml-2 pl-2" href="/">Home</Link>
                    <Link class="after:content-['|'] after:ml-2 pl-2" href="/contact">Contact</Link>
                    <Link class="after:content-['|'] after:ml-2 pl-2" href="/pricings">Pricings</Link>
                </div>
            </div>
        </nav>

        <!-- Mobile Navbar (visible on small screens) -->
        <nav class="lg:hidden bg-blue-500 p-4">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <img :src="'/storage/' + logo" class="w-[60px]" alt="">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile Sidebar (hidden by default) -->
        <div id="mobile-menu" class="hidden">
            <button class="close-button text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="flex flex-col items-center mt-4 space-y-4">
                <img :src="'/storage/' + logo" class="mw-[100%] mx-3" alt="">
                <a href="#" class="text-white">Home</a>
                <a href="#" class="text-white">About</a>
                <a href="#" class="text-white">Services</a>
                <a href="#" class="text-white">Contact</a>
            </div>
        </div>

        <article class="mt-[55px]">
            <slot></slot>
        </article>
        <footer class="py-6 px-6 bg-gradient-to-tr from-slate-800 to-slate-600"
            style="position: sticky;width: 100%;bottom: 0;left: 0;right: 0;z-index: -1;">
            <div class="flex flex-wrap">
                <div class="w-full flex justify-center">
                    <p class="text-white">আরসিটি ইএমএস ২০২৩ | আরসিটি সেবার একটি পণ্য | সর্বসত্ব সংরক্ষিত</p>
                </div>
            </div>
        </footer>
    </main>
</template>
