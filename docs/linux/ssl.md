# SSL

##

CA - Certification authority - центр сертификации или удостоверяющий центр. Его открытый ключ широко известен. Его задача - подтверждать подлинность ключей шифрования с помощью сертификатов

## Cheatsheet

### Вывести информацию о сертификате в файле:

```shell
openssl x509 -text -noout -in /etc/nginx/certs/default/default.crt
```

openssl pkcs12 -export -out marketPlace.p12 -in marketPlaceCert.pem -inkey marketPlaceKey.pem

openssl rsa -in ./marketPlaceKey.pem -check

openssl x509 -text -noout -in  marketPlaceCert.pem

openssl x509 -text -noout -in  marketPlaceKey.pem


### Создать PKCS#12 файл

openssl pkcs12 -export -in mycert.pem -out mycert.p12 -name "MyCert"

openssl pkcs12 -in aaaristarkhov@sber.ru.p12 -out sberid_all_test.pem -clcerts -nodes

openssl pkcs12 -in aaaristarkhov@sber.ru.p12 -out sberid_crt_test.pem -clcerts -nokeys

openssl pkcs12 -in aaaristarkhov@sber.ru.p12 -out sberid_key_test.pem -nocerts -nodes

### Извлечь из PEM-файла

#### Инофрмация о PEM-файле

```
openssl x509 -text -noout -in cert.pem
```

#### Извлечь ключ
```
openssl rsa -in cert.pem -out cert.key
```

#### Извлечь сертификат

```
openssl x509 -in cert.pem -out cert.key -clcerts -nokeys
```
