# Bitrix Mobile


Проблема: не поддерживается атрибут accept в свежем андроиде

https://caniuse.com/#feat=input-file-accept
https://stackoverflow.com/questions/21523544/html-file-input-control-with-capture-and-accept-attributes-works-wrong
https://stackoverflow.com/questions/1743967/why-do-the-major-browsers-not-support-htmls-accept-attribute-for-input-type-fil
https://www.w3schools.com/tags/att_input_accept.asp
https://www.mediawiki.org/wiki/Manual:MIME_type_detection

## Примеры

### Уведомление в верхней плашке

```
let notifyBar = new MobileApp.UI.NotificationBar({
  message: error,
  useLoader: false,
  align: "center",
  color: "#EF4444",
  autoHideTimeout: 2000,
  hideOnTap: true,
});

notifyBar.show();
```

## Ссылки

- [BitrixMobile - создание кроссплатформенных мобильных приложений](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=80)

- [Разработка решений для мобильного приложения Битрикс24](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=99&LESSON_ID=10277&LESSON_PATH=8771.5378.10277)

- [Добавление меню в мобильном приложении б24](https://snippets.cacher.io/snippet/39a3a36c87f41de34b80)

- [Получение доступа к железу устройства из Битрикс мобильное приложение](https://bazarow.ru/blog-note/7774/)
