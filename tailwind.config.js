import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import preset from "./vendor/filament/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        './vendor/tallstackui/tallstackui/src/**/*.php', 
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    100: "#E9F1E5",
                    200: "#C9DEC2",
                    300: "#A8CAA0",
                    400: "#87B77D",
                    500: "#5C794B", // Base color
                    600: "#4E663F",
                    700: "#3F5232",
                    800: "#313F26",
                    900: "#222B1A",
                },
                secondary: {
                    100: "#EDF5E9",
                    200: "#D2E6C8",
                    300: "#B6D6A7",
                    400: "#9BC786",
                    500: "#81A969", // Base color
                    600: "#6D8F59",
                    700: "#597549",
                    800: "#445B39",
                    900: "#2F4029",
                },
            },
        },
    },

    plugins: [forms],
};
