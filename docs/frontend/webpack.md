# Webpack

## Узнать версии Webpack

### Локальная

```shell
npx webpack --version
4.44.2
```

### Актуальная

```shell
npm view webpack version
5.95.0
```

## Интеграция с PHP

[Using a webpack plugin with Vue Client 3](https://stackoverflow.com/questions/53630205/using-a-webpack-plugin-with-vue-client-3)

[Webpack 4 compiler hooks #5](https://github.com/kossnocorp/on-build-webpack/issues/5)

[Injecting webpack chunks to twig files](https://stackoverflow.com/questions/43410331/injecting-webpack-chunks-to-twig-files)

[How to use index.php as the index file with create-react-app](https://agent-hunt.medium.com/how-to-use-index-php-as-the-index-file-with-create-react-app-ff760c910a6a)


```js
// vue.config.js
const path = require('path');

module.exports = {
    outputDir: '../src/install/components/dexika.contract/routes/templates/.default/assets',
    configureWebpack: config => {
        const apiClient = process.env.VUE_APP_API_CLIENT;
        config.resolve.alias = {
            ...config.resolve.alias,
            'api-client': path.resolve(__dirname, `src/api/${apiClient}`)
        };

        config.plugins = [
            ...config.plugins, // important!
            {
                apply: (compiler) => {
                    compiler.hooks.done.tap('My plugin', (stats) => {
                        console.log(stats)
                    });
                }
            }
        ];
    },
    devServer: {
        host: 'frontend.local'
    }
};
```
