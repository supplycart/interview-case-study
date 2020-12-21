export const state = () => ({
  isDark: false
})

export const mutations = {
  toggleDark(state) {
    state.isDark = !state.isDark;
  }
}