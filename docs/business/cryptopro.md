#

##

CAdES (CMS Advanced Electronic Signatures) - это стандарт электронной подписи, представляющий собой расширенную версию
стандарта электронной подписи CMS (Cryptographic Message Syntax)

## [Установка КриптоПро ЭЦП Browser plug-in в *nix](https://docs.cryptopro.ru/cades/plugin/plugin-installation-unix)

1. Для работы КриптоПро ЭЦП Browser plug-in требуется установленный КриптоПро CSP версии 4.0 и выше.
Дистрибутив и инструкцию по установке можно получить по [ссылке](http://cryptopro.ru/products/csp/overview).
Для работы КриптоПро ЭЦП Browser plug-in обязательна установка пакетa cprocsp-rdr-gui-gtk и отсутствие установленного пакета cprocsp-rdr-gui.

2. Скачайте и распакуйте архив с КриптоПро ЭЦП Browser plug-in. Архивы можно скачать по [ссылке](https://www.cryptopro.ru/products/cades/plugin/get_2_0).

3. Установите пакеты cprocsp-pki-cades и cprocsp-pki-plugin из архива. При использовании некоторых 64-битных версий КриптоПро CSP для rpm дистрибутивов потребуется указать флаг --nodeps.

```
sudo apt install ./cprocsp-pki-cades-64_2.0.14892-1_amd64.deb
sudo apt install ./cprocsp-pki-plugin-64_2.0.14892-1_amd64.deb
```

4. Дальнейшие настройки различаются в зависимости от используемого браузера.

- Браузер Chrome(Chromium Edge, Chromium Gost): запустите браузер и дождитесь оповещения об установленном расширении
"CryptoPro Extension for CAdES Browser Plug-in". Включите это расширение. Если на Вашем компьютере ранее уже выполнялась
установка расширения CryptoPro Extension for CAdES Browser Plug-in, а потом оно был удалено или вы используете
Chromium Edge, его потребуется установить отдельно. Для этого перейдите по ссылке и установите расширение из
интернет-магазина Chrome. Убедитесь, что расширение включено на странице расширений.

- Браузер Firefox: скачайте расширение по [ссылке](https://www.cryptopro.ru/sites/default/files/products/cades/extensions/firefox_cryptopro_extension_latest.xpi) и установите в браузер самостоятельно.

5. Проверьте корректность установки на [странице проверки плагина](https://www.cryptopro.ru/sites/default/files/products/cades/demopage/cades_bes_sample.html).
Для этого в открывшемся окне подтвердите доступ путем нажатия кнопки "Да".
