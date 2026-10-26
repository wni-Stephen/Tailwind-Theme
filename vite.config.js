import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import fullReload from 'vite-plugin-full-reload';

import fs from 'fs';
import { homedir } from 'os';
import { resolve } from 'path';

const host = 'wordpress-starter.loc';
const themePath = 'public/app/themes/wordpress-starter'; // adjust to your theme folder

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            buildDirectory: 'build',
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        // Full page reload for PHP changes in theme
        fullReload([`${themePath}/**/*.php`]),
    ],

    build: {
        manifest: 'assets.json',
        chunkSizeWarningLimit: 2000, // Increase threshold (in KB)
        rollupOptions: {
            output: {
                manualChunks: {
                    vue: ['vue'],
                    leaflet: ['leaflet'],
                    plyr: ['plyr'],
                    photoswipe: ['photoswipe'],
                    vendor: [
                        'axios',
                        'gsap',
                    ],
                },
            },
        },
    },

    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },

    server: detectServerConfig(host),
});

function detectServerConfig(host) {
    const keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`);
    const certPath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`);

    const hasHttps = fs.existsSync(keyPath) && fs.existsSync(certPath);

    const serverConfig = {
        host,
        cors: true,
        hmr: {
            host,
            protocol: hasHttps ? 'wss' : 'ws',
        },
        watch: {
            usePolling: true,
        },
    };

    if (hasHttps) {
        console.log(`✅ Using HTTPS for Vite dev server at https://${host}`);
        serverConfig.https = {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certPath),
        };
    } else {
        console.warn(`⚠️ HTTPS certificates not found for ${host}. Using HTTP.`);
    }

    return serverConfig;
}