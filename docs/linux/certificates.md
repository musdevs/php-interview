# Сертификаты

## [Установка публичного сертификата НУЦ Минцифры в Ubuntu](https://www.kobzarev.com/linux/ustanovka-publichnogo-sertifikata-nuts-mintsifry-v-ubuntu/)

### Установка в ОС

Скачиваем корневой и выпускающий сертификаты в папку «Загрузки» на вашем компьютере:

Корневой сертификат

```
wget -c https://gu-st.ru/content/lending/russian_trusted_root_ca_pem.crt
```

Выпускающий сертификат

```
wget -c https://gu-st.ru/content/lending/russian_trusted_sub_ca_pem.crt
```

Создаём папку для хранения сертификатов:

```
sudo mkdir /usr/local/share/ca-certificates/russian-trusted
```

Копируем скачанные сертификаты в созданную папку:

```
sudo cp russian_trusted_root_ca_pem.crt russian_trusted_sub_ca_pem.crt /usr/local/share/ca-certificates/russian-trusted
```

Обновляем системное хранилище сертификатов:

```
sudo update-ca-certificates -v
```

Проверяем хранилище доверенных сертификатов на предмет новых сертификатов:

```
trust list | grep Russian
```

Мы должны получить примерно такой ответ:

```
label: Russian Trusted Root CA
label: Russian Trusted Sub CA
```

Для проверки работы только что установленных сертификатов достаточно достаточно выполнить запрос к сайту Сбера:

```
wget -qS --spider --max-redirect=0 https://www.sberbank.ru
```

Если в ответе присутствует строка HttpOnly; secure, то вы сделали всё верно.

### Установка в Chromium/Vivaldi/Opera

Chromium и основанные на нём браузеры не используют системное хранилище и требуют отдельной установки сертификатов.

Чтобы не лазать по настройкам в поисках нужной страницы, а она может отличаться от браузера к браузеру, достаточно в адресную строку браузера вписать ссылку:

```
chrome://settings/certificates
```

И на открывшейся странице во вкладке Authorities (Центры сертификации) нажать кнопку Import (Импорт) и поочерёдно импортировать оба скачанных сертификата, начиная с корневого.
