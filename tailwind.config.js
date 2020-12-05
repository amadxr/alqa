module.exports = {
  purge: [],
  theme: {
    extend: {
      colors: {
        'wall': '#E8E5D1',
        'wall-alt': '#9D9D9C',
        'first-p-color': '#3C3C3B',
        'second-p-color': '#1D1D1B',
        'button-alt': '#515151',
        'button-hover': '#EAE6DF',
        'button-alt-hover': '#847777',
        'alqa-charcoal': '#303030',
      },
      fontFamily: {
        'alqa-special': 'Sometimes Times, serif',
        'alqa': 'Gotham, sans-serif',
      },
      fontSize: {
        'first-p-size': '2.8rem',
        'second-p-size': '1.2rem',
      },
      lineHeight: {
        '11': '2.75rem',
      },
      spacing: {
        'w-wallpaper': '180%',
        'h-wallpaper': '258%',
      },
      margin: {
        '28': '7rem',
      },
      inset: {
        '1/2': '50%',
      },
      width: {
        'card': '590px',
      },
      height: {
        'card': '580px',
      },
      scale: {
        '160': '1.6',
        '400': '4',
        '600': '6',
      },
    },
  },
  variants: {
    fontStyle: ['responsive', 'hover'],
    translate: ['responsive', 'hover'],
    scale: ['hover', 'group-hover'],
    fontWeight: ['responsive', 'hover', 'group-hover'],
    margin: ['hover', 'group-hover'],
  },
  plugins: [],
}
