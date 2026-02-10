import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,       // Required for Laravel to locate assets
        outDir: 'public/build', // Ensure assets go here
        emptyOutDir: true,    // Clean old build files
    },
});
