# КриптоПро ЭЦП Browser plug-in

## Ссылки

- [Страница в руководстве разработчика КриптоПро ЭЦП SDK](https://docs.cryptopro.ru/cades/plugin)
- [Страница из плагина](https://cryptopro.ru/sites/default/files/products/cades/demopage/main.html)
- [Продуктовая страница](https://cryptopro.ru/products/cades/plugin)
- [Скачать плагин](https://cryptopro.ru/products/cades/plugin/get_2_0)
- [Скачать КриптоПро CSP](https://cryptopro.ru/products/csp/downloads)
- [Сайт КриптоПро](https://cryptopro.ru/)

- [Список методов и свойств обьекта cadesplugin](https://docs.cryptopro.ru/cades/plugin/plugin-methods)
- [Github-репозиторий crypto-pro-cadesplugin](https://github.com/bad4iz/crypto-pro-cadesplugin)
- [CAdESCOM: Объекты](https://docs.cryptopro.ru/cades/reference/cadescom/cadescom_class)
- [Методы и свойства объекта Certificate](https://learn.microsoft.com/en-us/windows/win32/seccrypto/certificate)
- [RU - Методы и свойства объекта Certificate](https://learn.microsoft.com/ru-ru/windows/win32/seccrypto/certificate)

## Обзор

### Как определить каталог профиля Google Chrome

```
chrome://version

Profile Path	/home/user/.config/google-chrome/Profile 9
```

### Каталог расширения

```
/.config/google-chrome/Profile 9/Extensions/iifchhfnnmpdbibifmljnfjhpififfog/1.2.13_0
```

## Примеры

### Пример получения списка сертификатов

```javascript
;(function () {
    if (!window.Promise) {
        alert('Этот браузер не поддерживается')
    }

    function getCertificates() {
        return new Promise((resolve) => {
            cadesplugin.async_spawn(function* (args) {

                let store = yield cadesplugin.CreateObjectAsync('CAdESCOM.Store');

                yield store.Open(
                    cadesplugin.CAPICOM_CURRENT_USER_STORE,
                    cadesplugin.CAPICOM_MY_STORE,
                    cadesplugin.CAPICOM_STORE_OPEN_MAXIMUM_ALLOWED
                );

                let certs = yield store.Certificates;
                let certsCount = yield certs.Count;

                const result = [];

                for (let i = 1; i <=certsCount; i++) {
                    let cert = yield certs.Item(1);
                    let subjectName = yield cert.SubjectName;
                    result.push(subjectName)
                }

                resolve(result)
            })
        })
    }

    cadesplugin.then(() => {
        getCertificates()
            .then(function (res) {
                console.log(res)
            })
    })

})();

// выведет
// [
//     "SN=ИВАНОВ, G=ВЛАДИМИР ИВАНОВИЧ, CN=ИВАНОВ ВЛАДИМИР ИВАНОВИЧ, STREET=\",Ленина ул,1,,21\", L=Домодедово г, S=Московская обл, C=RU, ИНН=123456789012, СНИЛС=01234567891, ОГРНИП=123000456000789",
//     "SN=ИВАНОВ, G=ВЛАДИМИР ИВАНОВИЧ, CN=ИВАНОВ ВЛАДИМИР ИВАНОВИЧ, STREET=\",Ленина ул,1,,21\", L=Домодедово г, S=Московская обл, C=RU, ИНН=123456789012, СНИЛС=01234567891, ОГРНИП=123000456000789",
// ]
```
