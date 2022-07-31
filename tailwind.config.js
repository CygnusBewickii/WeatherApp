/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
      maxWidth: {
          '1/2': '50%',
      },
    extend: {},
  },
  plugins: [
      require("daisyui")
  ],
  daisyui: {
      themes: [
          {
              weather: {
                  "primary": "#38bdf8",
                  "secondary": "#a78bfa",
                  "accent": "#37CDBE",
                  "neutral": "#3D4451",
                  "base-100": "#FFFFFF",
                  "info": "#cffafe",
                  "success": "#36D399",
                  "warning": "#FBBD23",
                  "error": "#F87272",
              }
          }
      ]
  }
}
