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
        extend: {},
    },
    plugins: [],
}

