# Пароли

## Сервисы проверки паролей

### [Kaspersky password checker](https://password.kaspersky.com/ru/)

### [Pwned Passwords](https://haveibeenpwned.com/Passwords)

### [api.pwnedpasswords.com](https://haveibeenpwned.com/API/v2?ref=troyhunt.com#PwnedPasswords)

Для использования нужно вычислить SHA1-хэш:

```shell
echo -n 'Ww@123123' | sha1sum
6f12997dcb1c4764035c31ffd894bc9b91ddf816  -
```

Взять первые 5 символов хэша 6f129 и сделать запрос

https://api.pwnedpasswords.com/range/6f129

В ответе придет список хэшей и количество утечек:

```
97D0D4714605933CDD7C007A83AE4C51A6C:1
97D238366B6EE7B64B97B416F7644BC860E:1
**97DCB1C4764035C31FFD894BC9B91DDF816:21**
989C6BCA1FC2697167E6C96E36D1D0411FB:1
98C4E342F52C4EAAF01F18662B87A3EB5E2:1
```

Получается пароль Ww@123123 утек 21 раз
