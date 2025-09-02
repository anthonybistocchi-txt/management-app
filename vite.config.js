import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/ts/app.ts'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      jquery: "jquery/dist/jquery.min.js",
    },
  },
});
