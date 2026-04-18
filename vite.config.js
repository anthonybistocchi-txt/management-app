import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            // Todas as entradas referenciadas em @vite(...) nas views Blade
            input: [
                'resources/css/app.css',
                'resources/ts/app.ts',
                'resources/ts/components/Layout/SidebarPermissions.ts',
                'resources/ts/pages/auth/login.ts',
                'resources/ts/pages/auth/reset-password.ts',
                'resources/ts/pages/admin/dashboard.ts',
                'resources/ts/pages/admin/reports/in-out.ts',
                'resources/ts/pages/admin/reports/inventory.ts',
                'resources/ts/pages/admin/reports/stock-card.ts',
                'resources/ts/pages/admin/reports/stock-turnover.ts',
                'resources/ts/pages/index/management-categories.ts',
                'resources/ts/pages/index/management-locations.ts',
                'resources/ts/pages/index/management-movements.ts',
                'resources/ts/pages/index/management-products.ts',
                'resources/ts/pages/index/management-providers.ts',
                'resources/ts/pages/index/management-stock-in.ts',
                'resources/ts/pages/index/management-stock-out.ts',
                'resources/ts/pages/index/management-users.ts',
                'resources/ts/pages/index/register-product.ts',
                'resources/ts/pages/index/register-provider.ts',
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
