/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.ts",
        "./resources/**/*.vue",
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: "#005A9C",
                secondary: "#4DB8A9",
                "background-light": "#F4F7FA",
                "background-dark": "#101922",
                "surface-blue": "#0D2846",
                "text-white": "#b6b6b6ff",
                "text-muted-blue": "#b6b6b6ff", // cinza claro azulado p/ sidebar
            },
            fontFamily: {
                display: ["Manrope", "sans-serif"],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/container-queries"),
    ],
};
