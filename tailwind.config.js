const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography') , require('daisyui') ],

    daisyui: {
        styled: true,
        themes: [
          {
            'custom': {
              'primary': '#1E40AF',
              'primary-focus': '#345DE3',
              'primary-content': '#FFFFFF',
              'secondary': '#7E22CE',
              'secondary-focus': '#9B38F2',
              'secondary-content': '#FFFFFF',
              'accent': '#EDE6E1',
              'accent-focus': '#C1B5B5',
              'accent-content': '#000000',
              'neutral': '#3d4451',
              'neutral-focus': '#2a2e37',
              'neutral-content': '#ffffff',
              'base-100': '#ffffff',
              'base-200': '#f9fafb',
              'base-300': '#d1d5db',
              'base-content': '#1f2937',
              'info': '#2094f3',
              'success': '#009485',
              'warning': '#ff9900',
              'error': '#ff5724',
            },
          },
        ],
        base: true,
        utils: true,
        logs: true,
        rtl: false,
      },
};
