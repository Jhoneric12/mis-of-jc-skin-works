import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },

        colors: {
            'primary-green': '#4FBD5E',
            'secondary-green': '#C7F2A4',
            'font-color': '#232323',
            'puti': '#F5FAF0',
            'ultra-puti': '#FFFFFF',
            'semi-black': '#5B5B5B',
            'border-color': '#C1C1C1'
          },
    },

    daisyui: {
        themes: ["light"],
      },

    plugins: [forms, typography,  require('flowbite/plugin'),
                require("daisyui")],
};
