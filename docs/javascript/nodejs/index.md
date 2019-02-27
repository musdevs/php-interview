# Node.js

Для установки нескольких версий Node.js можно использовать
[nvm](https://github.com/creationix/nvm) (Node Version Manager).
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

```bash
nvm install 9.11.2
```

## Ресурсы
1. [Релизы Node.js](https://nodejs.org/en/download/releases/)