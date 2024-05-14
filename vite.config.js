import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        topLevelAwait(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: ['toastify-js']
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import 'toastify-js/src/toastify.scss';`,
            },
        },
    },
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
    },
});
