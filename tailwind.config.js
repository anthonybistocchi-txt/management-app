/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.ts",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                "primary": "#005A9C",
                "secondary": "#4DB8A9",
                "background-light": "#F4F7FA",
                "background-dark": "#101922",
                "text-light": "#333333",
                "text-dark": "#F4F7FA",
                "text-secondary-light": "#6b7280",
                "text-secondary-dark": "#9ca3af",
            },
            fontFamily: {
                "display": ["Manrope", "sans-serif"]
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/container-queries'),
    ],
};