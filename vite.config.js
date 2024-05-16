import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        // topLevelAwait(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        // 明示的に事前バンドルに含めたい依存関係
        // include: ['axios']
        // 事前バンドルから除外する依存関係（各ライブラリのdocs参照）
        // exclude: []
    },
    css: {
        preprocessorOptions: {
            // プリプロセッサファイル
            // scss: {
            //     additionalData: `@import 'variables.scss';`,
            // },
        },
    },
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
    },
});
