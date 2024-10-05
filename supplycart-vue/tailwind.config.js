/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{js,ts,jsx,tsx}'],
  theme: {
      extend: {
          colors: {
              'my-purple': '#818cf8',
              'my-dark-purple': '##6f78d9',
              'my-orange': '#f97316',
              'my-blue': '#3b82f6',
              'my-dark-blue': '#00485c',
              'my-light-blue': '#e0f8ff',
              'my-dark-green': '#074a28',
              'my-light-green': '#ccffe5',
              'my-red': '#EF4444',
              'my-dark-red': '#C70039',
              'my-gray': '#6B7280',
              'my-yellow': '#FFD701',
              'my-green': '#19B59B',
              'my-blue-hover': '#1e3a8a',
              'my-green-hover': '#3CDEBC',
              'tag-bg': '#EEF6FC',
              'my-button-disabled': '#D5DBDB',
              'gold': '#FDDC5C',
              'silver': '#C0C0C0',
              'bronze': '#CD7F32',
              'input-color': '#CCCCCC'
          },
      },
  },
  plugins: [],
}

