import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => ({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: mode === 'development',
        }),
    ],
    server: {
        host: 'localhost',    // <-- change this
        port: 5174,           // <-- fixed port
        strictPort: true,     // ensures it doesn't pick random port
        cors: true,
    },
    build: {
        manifest: true,           // Laravel needs this
        outDir: 'public/build',   // must be public/build
        emptyOutDir: true,
        assetsDir: 'assets',
    },
    base: mode === 'production' ? '/build/' : '/',
}));
