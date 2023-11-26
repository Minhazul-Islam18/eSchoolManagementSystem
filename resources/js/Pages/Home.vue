<script setup>
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const logo = computed(() => page.props.logo)
</script>
<template>
    <h1>
        {{ logo }}
        How To Install Vue 3 in Laravel 10 : ZWebCourses
    </h1>
</template>
