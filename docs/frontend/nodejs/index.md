# Node.js

## Ресурсы
1. [Релизы Node.js](https://nodejs.org/en/download/releases/)

Для установки нескольких версий Node.js можно использовать
[nvm](https://github.com/nvm-sh/nvm) (Node Version Manager).
Зачем? Да чтобы установить какие-то старые зависимости.

Например, в package-lock.json зависимость node-sass версии "4.7.2"
```json
"gulp-sass": {
    "version": "3.1.0",
    "resolved": "https://registry.npmjs.org/gulp-sass/-/gulp-sass-3.1.0.tgz",
    "integrity": "sha1-U9xLaKH13f5EJKtMJHZVJpqLdLc=",
    "dev": true,
    "requires": {
        "gulp-util": "3.0.8",
        "lodash.clonedeep": "4.5.0",
        "node-sass": "4.7.2",
        "through2": "2.0.3",
        "vinyl-sourcemaps-apply": "0.2.1"
    }
},
```

Если попытаться установить (npm install), то установка сломается с ошибкой:
```
Cannot download "https://github.com/sass/node-sass/releases/download/v4.7.2/linux-x64-64_binding.node"
```

И, действительно, в [загрузках](https://github.com/sass/node-sass/releases/tag/v4.7.1)
такой версии нет. Максимально близкая [linux-x64-**59**_binding.node](https://github.com/sass/node-sass/releases/download/v4.7.1/linux-x64-59_binding.node)
59 - это внутренняя версия Node.js, которую можно узнать [отсюда](https://nodejs.org/en/download/releases/).
Ей соответствует версия Node.js 9.11.2. Устанавливаем ее:

### Вывести список устаревших пакетов проекта

```bash
nvm install 9.11.2
```

```
npm outdated
Package                        Current    Wanted   Latest  Location                                    Depended by
@types/node                    22.19.1  22.19.13   25.3.2  node_modules/@types/node                    my-project
@vitejs/plugin-vue               6.0.2     6.0.4    6.0.4  node_modules/@vitejs/plugin-vue             my-project
@vue/eslint-config-typescript   14.6.0    14.7.0   14.7.0  node_modules/@vue/eslint-config-typescript  my-project
autoprefixer                   10.4.22   10.4.27  10.4.27  node_modules/autoprefixer                   my-project
axios                           1.13.2    1.13.5   1.13.5  node_modules/axios                          my-project
eslint                          9.39.1    9.39.3   10.0.2  node_modules/eslint                         my-project
eslint-plugin-vue               10.5.1    10.5.1   10.8.0  node_modules/eslint-plugin-vue              my-project
prettier                         3.6.2     3.6.2    3.8.1  node_modules/prettier                       my-project
qs                              6.14.0    6.15.0   6.15.0  node_modules/qs                             my-project
tailwindcss                     3.4.18    3.4.19    4.2.1  node_modules/tailwindcss                    my-project
vite                             7.2.4     7.3.1    7.3.1  node_modules/vite                           my-project
vite-plugin-vue-devtools         8.0.5     8.0.6    8.0.6  node_modules/vite-plugin-vue-devtools       my-project
vue                             3.5.24    3.5.29   3.5.29  node_modules/vue                            my-project
vue-router                       4.6.3     4.6.4    5.0.3  node_modules/vue-router                     my-project
vue-tsc                          3.1.4     3.2.5    3.2.5  node_modules/vue-tsc                        my-project
```
