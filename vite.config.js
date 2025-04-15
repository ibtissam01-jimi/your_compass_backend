import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from 'tailwindcss';  // Correct Tailwind CSS plugin

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.jsx', 'resources/css/app.css'], // Make sure paths match your file structure
            refresh: true,
        }),
        react(),
        tailwindcss(),  // Ensure this is correctly installed
    ],
});
