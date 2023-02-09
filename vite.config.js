import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: [
                'Kingdom/**'
            ]
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
});
