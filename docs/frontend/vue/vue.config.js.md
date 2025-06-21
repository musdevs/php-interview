# Настройка vue.config.js

```javascript
module.exports = defineConfig({
  publicPath: '', // все ссылки на ресурсы будут без ведущего обратного слэша / - можно открывать без веб-сервера, просто как файл
  productionSourceMap: false, // отключает создание map-файлов
  filenameHashing: false, // отменяет добавление хэша в файлы дистрибутива
});
```
