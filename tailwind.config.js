const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    content: [
        "./vendor/wire-elements/modal/resources/views/*.blade.php",
        "./app/**/*.php",
        "./resources/**/*.{php,html,js,jsx,ts,tsx,vue,twig}",
    ],
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
