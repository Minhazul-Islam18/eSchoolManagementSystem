import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require("./vendor/wireui/wireui/tailwind.config.js"),
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/tw-elements/dist/js/**/*.js",
        "./vendor/wireui/wireui/resources/**/*.blade.php",

        "./vendor/wireui/wireui/ts/**/*.ts",

        "./vendor/wireui/wireui/src/View/**/*.php",
    ],

    theme: {
        container: {
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "6rem",
            },
        },
        extend: {
            screens: {
                md: "768px",
                lg: "1024px",
                xl: "1280px",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    corePlugins: {
        aspectRatio: false,
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: "class",
        }),
        forms,
        typography,
        require("flowbite/plugin"),
        require("tw-elements/dist/plugin.cjs"),
        require("@tailwindcss/aspect-ratio"),
    ],
};
