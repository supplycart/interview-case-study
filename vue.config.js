module.exports = {
  chainWebpack: (config) => {
    config.module
      .rule('ts')
      .use('ts-loader')
      .loader('ts-loader')
      .tap((options) => {
        // eslint-disable-next-line no-param-reassign
        options.transpileOnly = false

        return options
      })
  },
}
