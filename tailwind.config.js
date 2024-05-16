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
            colors: {
                // prefixname: {
                    // **ハイフンは使えません**
                    // colorname: '#000000',
                // },
            },
            screens: {
                'pc': '1280px',
                'tablet': '600px',  // ipad mini 基準->768px
                'phone': '360px',   // iphone 基準->375px
            },
        },
    },
    plugins: [
        plugin(function ({ addUtilities}) {
            addUtilities ({
                // アスペクト比 (1/1=square、16/9=videoは既存)16:9=1.9
                '.aspect-standard': {
                    'aspect-ratio': '4 / 3'
                },
                '.aspect_cinema': {
                    'aspect-ratio': '12 / 5'
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
        require("daisyui"),
    ],
    daisyui: {
        prefix: 'dui-',
        themes: [
            "light",
        ],
    },
}