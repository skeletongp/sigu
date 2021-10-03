module.exports = {
    important: true,
    // Active dark mode on class basis
    darkMode: "class",
    i18n: {
        locales: ["es-Es"],
        defaultLocale: "es-ES",
    },

    purge: [
        "./pages/**/*.tsx",
        "./components/**/*.tsx",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            backgroundImage: (theme) => ({
                check: "url('/icons/check.svg')",
                landscape: "url('/images/landscape/2.jpg')",
            }),
        },
    },
    variants: {
        extend: {
            backgroundColor: ["checked", "disabled"],
            borderColor: ["checked"],
            inset: ["checked"],
            zIndex: ["hover", "active"],
            opacity: ['disabled'],
        },
    },
    plugins: [],
    future: {
        purgeLayersByDefault: true,
    },
};
