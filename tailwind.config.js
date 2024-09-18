/** @type {import('tailwindcss').Config} */
export default {
    content: [
    
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      'node_modules/preline/dist/*.js',
    ],
   darkMode:'class',
    theme: {
        extend: {
            fontFamily: {
              'sans': ['Poppins', 'sans-serif'],
              'poppins': ['Poppins', 'sans-serif'],
            },
          },
    },
    plugins: [
      // require('@tailwindcss/forms'),
      require('preline/plugin'),
    ],
  }