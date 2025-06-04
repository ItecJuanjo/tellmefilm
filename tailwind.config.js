const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
          colors: {
            turquesa: '#00C2CB',
            naranja: '#FF6F3F',
            grisoscuro: '#2B2D42',
          },
          fontFamily: {
            titulo: ['Poppins', 'sans-serif'],
            cuerpo: ['Roboto', 'sans-serif'],
          },
        },
      },

    plugins: [require('@tailwindcss/forms')],
};
