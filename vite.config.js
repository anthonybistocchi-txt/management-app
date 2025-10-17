import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: 'public/build',
        manifest: true,
    },
    plugins: [
        laravel({
            input: [
              'resources/js/login/index.ts',
            ],
            refresh: true,
        }),
    ],
});

