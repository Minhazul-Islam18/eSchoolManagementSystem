import { createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { renderToString } from "@vue/server-renderer";
import { createSSRApp, h } from "vue";
import Layout from "./Layout.vue";

createServer((page) =>
    createInertiaApp({
        id: "app",
        page,
        render: renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
            let page = pages[`./Pages/${name}.vue`];
            page.default.layout = page.default.layout || Layout;
            return page;
        },
        setup({ el, App, props, plugin }) {
            return createSSRApp({
                render: () => h(App, props),
            })
                .use(Toast)
                .use(plugin)
                .mount(el);
        },
    })
);
