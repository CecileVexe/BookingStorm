/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.{blade.php,js}",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],

    safelist: [
        {
            pattern:
                /(bg|hover:bg|text)-(red|blue|green|yellow|pruple|orange)-(50|100|600)/,
        },
    ],

    theme: {
        extend: {},
        fontFamily: {
            roboto: ["Roboto", "sans-serif"],
        },
    },
    plugins: [],
};
