import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => ({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: mode === 'development',
        }),
    ],
    build: {
        manifest: true,           // Laravel needs this
        outDir: 'public/build',   // must be public/build
        emptyOutDir: true,
        assetsDir: 'assets',
    },
    base: mode === 'production' ? '/build/' : '/',
}));
