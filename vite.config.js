import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';

export default defineConfig({
    plugins: [vue()],
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'resources/js/app.js'),
                style: resolve(__dirname, 'resources/css/app.css'),
            },
        },
        outDir: 'public/build',
    },
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
        },
    },
    // server: {
        // host: 'confirmationsystem.lh',
        // port: 5173,
        // hmr: {
            // host: 'confirmationsystem.lh',
            // port: 5173,
        // },
    // },
});
