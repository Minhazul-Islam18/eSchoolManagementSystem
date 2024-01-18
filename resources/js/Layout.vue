<script setup>
import { ref, computed, watch } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
// import { route } from './Ziggy';
import flasher from "@flasher/flasher";
import { User, ChevronDown, LogOut } from 'lucide-vue-next';
import FlashMessage from "./Components/FlashMessage.vue";
const page = usePage()

const logo = computed(() => page.props.logo)
const is_authenticated = computed(() => page.props.is_authenticated)
const user = computed(() => page.props.user)
const user_profile_photo = computed(() => page.props.user_profile_photo)
console.log(page.props.user);

const logout = () => {
    router.post('app/logout');
};
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
    /* background-color: #72a5fa; */
    padding-top: 4rem;
    z-index: 999;
}

#mobile-menu a {
    /* color: #cbd5e0; */
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
                    <a href="/">
                        <img :src="'/storage/' + logo" class="w-[115px]" alt="">
                    </a>
                </div>
                <div class="flex gap-2 flex-wrap items-end justify-end">
                    <Link class=" px-2 py-1" :class="{ 'bg-emerald-500 rounded': $page.url === '/' }" href="/">Home
                    </Link>
                    <Link class="px-2 py-1" :class="{ 'bg-emerald-500 rounded': $page.url === '/contact' }" href="/contact">
                    Contact
                    </Link>
                    <Link class="px-2 py-1" :class="{ 'bg-emerald-500 rounded': $page.url === '/pricings' }"
                        href="/pricings">
                    Pricings</Link>
                    <a v-if="is_authenticated" class="px-2 py-1" href="/users-redirection">Dashboard</a>
                    <a v-else class="px-2 py-1" href="/app/login">Login</a>

                    <div class="relative" v-if="is_authenticated && user">
                        <button id="dropdown-button" v-if="user_profile_photo" data-fc-type="dropdown"
                            data-fc-placement="bottom-end" type="button" class="gap-x-2 nav-link flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover"
                                :src="user.profile_photo_path ?? user.profile_photo_url" :alt="user.name" />
                            <div class="md:flex flex-col hidden">
                                <div class="font-medium text-base text-left text-gray-800 dark:text-gray-200">
                                    {{ user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ user.email }}</div>
                            </div>
                            <ChevronDown class="w-[18px]" />
                        </button>

                        <div id="dropdown-menu"
                            class="hidden absolute z-50 mt-2 bg-white border border-gray-300 rounded-md shadow-lg">
                            <h6 class="py-2 px-5 text-md">Welcome !</h6>
                            <div class=" md:hidden flex flex-col gap-2">
                                <div class=" px-5 font-medium text-sm text-left text-gray-800 dark:text-gray-200">
                                    {{ user.name }}</div>
                                <div class=" px-5 text-sm text-gray-500">{{ user.email }}</div>
                            </div>
                            <a class="flex items-center py-2 px-5 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="/user/profile">
                                <User class="w-[18px] me-2" />
                                <span>My Account</span>
                            </a>
                            <hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700" />
                            <form @submit.prevent="logout">
                                <input type="hidden" name="_token" :value="$page.props.csrfToken" />
                                <button type="submit"
                                    class="flex items-center py-2 px-5 text-sm w-full text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    <LogOut class="w-4 h-4 me-2" />
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
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
        <div id="mobile-menu" class="hidden bg-sky-500/50 backdrop-blur-2xl">
            <button class="close-button text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="flex flex-col items-center mt-4 space-y-4">
                <img :src="'/storage/' + logo" class=" w-[150px] mw-[100%] mx-auto" alt="">
                <Link class="text-white px-2 py-1" :class="{ 'bg-emerald-500 rounded': $page.url === '/' }" href="/">Home
                </Link>
                <Link class="px-2 py-1 text-white" :class="{ 'bg-emerald-500 rounded': $page.url === '/contact' }"
                    href="/contact">
                Contact
                </Link>
                <Link class="px-2 py-1 text-white" :class="{ 'bg-emerald-500 rounded': $page.url === '/pricings' }"
                    href="/pricings">
                Pricings</Link>
                <a v-if="is_authenticated" class="px-2 py-1" href="/users-redirection">Dashboard</a>
                <div class="relative" v-if="is_authenticated && user">
                    <button id="mobile-dropdown-button" v-if="user_profile_photo" data-fc-type="dropdown"
                        data-fc-placement="bottom-end" type="button" class="gap-x-2 nav-link flex items-center">
                        <img class="h-10 w-10 rounded-full object-cover"
                            :src="user.profile_photo_path ?? user.profile_photo_url" :alt="user.name" />
                        <div class="md:flex flex-col hidden">
                            <div class="font-medium text-base text-left text-gray-800 dark:text-gray-200">
                                {{ user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ user.email }}</div>
                        </div>
                        <ChevronDown class="w-[18px]" />
                    </button>

                    <div id="mobile-dropdown-menu"
                        class="hidden absolute z-50 mt-2 bg-white border border-gray-300 rounded-md shadow-lg">
                        <h6 class="py-2 px-5 text-md">Welcome !</h6>
                        <div class=" md:hidden flex flex-col gap-2">
                            <div class=" px-5 font-medium text-sm text-left text-gray-800 dark:text-gray-200">
                                {{ user.name }}</div>
                            <div class=" px-5 text-sm text-gray-500">{{ user.email }}</div>
                        </div>
                        <a class="flex items-center py-2 px-5 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="/user/profile">
                            <User class="w-[18px] me-2" />
                            <span>My Account</span>
                        </a>
                        <hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700" />
                        <form method="POST" action="/logout" x-data>
                            <!-- @csrf -->
                            <button type="submit"
                                class="flex items-center py-2 px-5 text-sm w-full text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="/logout">
                                <LogOut class="w-[18px] me-2" />
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
                <a v-else class="px-2 py-1" href="/app/login">Login</a>
            </div>
        </div>

        <article class="mt-0 sm:mt-[65px]">
            <FlashMessage></FlashMessage>
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
