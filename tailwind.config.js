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
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './resources/**/*.jsx',
    ],

    theme: {
        extend: {
          keyframes: {
            fadeIn: {
              '0%': { opacity: 0, transform: 'translateY(10px)' },
              '100%': { opacity: 1, transform: 'translateY(0)' },
            },
            pulseGlow: {
              '0%, 100%': { boxShadow: '0 0 10px rgba(255,255,255,0.2)' },
              '50%': { boxShadow: '0 0 20px rgba(255,255,255,0.5)' },
            },
            shimmer: {
              '0%': { backgroundPosition: '-200% 0' },
              '100%': { backgroundPosition: '200% 0' },
            },
          },
          animation: {
            fadeIn: 'fadeIn 0.6s ease-out',
            pulseGlow: 'pulseGlow 2s infinite ease-in-out',
            shimmer: 'shimmer 3s infinite linear',
          },
        },
      },

    darkMode: 'class', // this is fine

    plugins: [forms, typography],
};
