module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins'],
      },
      minHeight: {
        '1/4vh': '25vh',
        '1/2vh': '50vh',
        '3/4vh': '75vh',
       }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
