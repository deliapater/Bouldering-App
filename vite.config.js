import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue(),
  ],
  css: {
    postcss: resolve('./postcss.config.cjs'),
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, './resources/js'),
    },
  }
});
