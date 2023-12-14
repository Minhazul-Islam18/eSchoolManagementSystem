import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";

// If you use Tailwind
import "./../../vendor/power-components/livewire-powergrid/dist/tailwind.css";

import { createSSRApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import Layout from "./Layout.vue";
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
createInertiaApp({
    progress: {
        // The color of the progress bar...
        color: "#009644",
        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
    id: "app",
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createSSRApp({ render: () => h(App, props) })
            .use(Toast)
            .use(plugin)
            .mount(el);
    },
});
