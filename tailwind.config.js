const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            animation: {
                'fade-in': 'fade-in 500ms forwards',
                'fade-out': 'fade-out 500ms forwards',
            },
            keyframes: {
                'fade-in': {
                    '0%': {
                        opacity: 0
                    },
                    '100%': {
                        opacity: 1
                    },
                },
                'fade-out': {
                    '0%': {
                        opacity: 1
                    },
                    '100%': {
                        opacity:0
                    }
                },
            },
            fontFamily: {
                'zen-maru': ['Zen Maru Gothic'],
                'mplus-rounded': ['M PLUS Rounded 1c'],
            },
            colors: {
                admin: {
                    base: '#EAF0CE',            // for background
                    main: '#CCE3CA',            // for main color
                    accent: {
                        type1: '#5D8334',       // mainly for accent button
                        type1hover: '#86B950',
                        type2: '#689D2F',       // mainly for accent background
                        type2hover: '#87C743',
                    },
                    alert: '#B3001B',           // for alert & error
                    text: {
                        main: '#021301',        // for main text (written in layouts/admin)
                        mainhover: '#3F533C',
                        sub: '#282A28',         // for other text
                        subhover: '#5A5E5A'
                    },
                },
            },
            screens: {
                'pc': '1280px',
                'tablet': '600px',  // ipad mini 基準->768px (if you need big-tablet->1024px)
                'phone': '360px',   // iphone 基準->375px (min:320px)
            },
            aspectRatio: {
                'standard': '4 / 3',
                'cinema': '12 / 5',
            },
        },
    },
    plugins: [
        plugin(function ({ addUtilities}) {
            addUtilities ({
                // scroll-bar
                '.hidden-scrollbar': {
                    '-ms-overflow-style': 'none',   // IE, Edge
                    'scrollbar-width': 'none',      // firefox
                    '&::-webkit-scrollbar': {
                        'display': 'none',          // Chrome, Safari
                    },
                },
                // text-align
                '.text-last-justify': {
                    'text-align-last': 'justify',
                },
                // sanmple(button)
                '.btn-green': {
                    'color': '#1CB539',
                    'font-weight': 700,
                    'background-color': '#FFFFFF',
                    'border-width': '2px',
                    'border-color': '#1CB539',
                    'border-radius': '9999px',
                    '&:hover': {
                        'color': 'white',
                        'background-color': '#1CB539',
                        'border-color': '#1CB539',
                    },
                    '&:focus': {
                        'ring-color': '#86efac', //rgb(134 239 172)
                        'outline': '2px solid transparent',
                        'outline-offset': '2px',
                    },
                },
            })
        }),
    ],
}
