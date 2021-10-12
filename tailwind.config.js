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
      minWidth: {
        '28': '7rem',
      },
      minHeight: {
        '32': '8rem',
        '1/4vh': '25vh',
        '1/2vh': '50vh',
        '3/4vh': '75vh',
      },
      maxWidth: {
        '2xs': '16rem',
        '3xs': '12rem',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
