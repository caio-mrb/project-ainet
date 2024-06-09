/** @type {import('tailwindcss').Config} */
export default {
    content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary-red': '#be3144',
        'secondary-red': '#d25062',
        'primary-gray': '#d3d6db',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}