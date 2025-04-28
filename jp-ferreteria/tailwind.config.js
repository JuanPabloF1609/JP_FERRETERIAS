// tailwind.config.js
export default {
    // Deshabilita totalmente el dark mode
    darkMode: "false",

    content: [
        "./resources/views//*.blade.php",
        "./resources/js//*.js",
        // …otros paths…
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        // …otros plugins…
    ],
};
