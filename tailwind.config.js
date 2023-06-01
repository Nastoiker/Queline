/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.{js,ts}",
        "./resources/**/*.vue",
        "./resources/**/*.svelte",
    ],
    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            'white': '#E9E8ED',
            'gray': '#6D6F73',
            'black': '#303236',
            'green': '#198585',
            'red' : '#BB5656',

        },
        extend: {},
    },
    plugins: [],
}
