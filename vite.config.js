import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/ts/app.ts',
                'resources/ts/pages/auth/login.ts',
                'resources/ts/pages/auth/reset-password.ts',
                'resources/ts/pages/admin/dashboard.ts',
                'resources/ts/pages/index/management-users.ts',
                'resources/ts/pages/index/management-providers.ts',
                'resources/ts/pages/index/management-products.ts',
                'resources/ts/pages/index/management-stock-in.ts',
                'resources/ts/pages/index/management-stock-out.ts',
                'resources/ts/pages/index/management-movements.ts',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/ts'), // O @ aponta para a pasta TS
        },
    },
});