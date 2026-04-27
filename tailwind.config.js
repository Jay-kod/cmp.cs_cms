import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
                '2xl': '8rem',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#1E7A3E', // The deep green used heavily in the brand
                    dark: '#166534', 
                    light: '#22C55E',
                },
                secondary: {
                    DEFAULT: '#EAB308', // The yellow/gold accent
                    hover: '#ca8a04',
                },
                brand: {
                    base: '#f8fafc',
                    dark: '#0f172a',
                    muted: '#64748b'
                }
            },
            boxShadow: {
                'soft': '0 4px 15px rgba(0,0,0,0.05)',
                'card': '0 10px 30px -10px rgba(0,0,0,0.08)',
                'card-hover': '0 20px 40px -15px rgba(0,0,0,0.12)',
            }
        },
    },
    corePlugins: { 
        preflight: false // Keep preflight off during active migration so we don't break Bootstrap forms/tables instantly
    },
    plugins: [forms],
};

