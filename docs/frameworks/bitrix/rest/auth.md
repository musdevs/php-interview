# Авторизация по OAuth 2.0 в Битрикс24

## Получение токена

В [карточке приложения](http://b24-dev-80.local/devops/edit/application/1/) найти
 - Код приложения (client_id): local.65194cb0d83f05.62388267
 - Ключ приложения (client_secret): frAZ2M5dKaZ3VVLb0qy2HjsdMMYykDhzl3HvUpfFJkaHuVmN5q

В браузере перейти на страницу с подставленным client_id=local.65194cb0d83f05.62388267 по адресу:
http://b24-dev-80.local/oauth/authorize/?client_id=local.65194cb0d83f05.62388267&state=JJHgsdgfkdaslg7lbadsfg

Битрикс24 выведет окно для авторизации, в котором вводится логин и пароль.
После успешной авторизации происходит редирект на страницу приложения:
http://localhost:8050/bitrix?code=8d8c196500674ca800674ca4000000010000071ebe2746439137d8e93a3c7c8c30da7c&state=JJHgsdgfkdaslg7lbadsfg&domain=b24-dev-80.local&member_id=82de4a56ef28d75f2a9258f34d6a529a&scope=crm&server_domain=oauth.bitrix.info#/

Из этого адреса нужен авторизационный код: code=8d8c196500674ca800674ca4000000010000071ebe2746439137d8e93a3c7c8c30da7c
Время жизни первого авторизационного кода code - всего 30 секунд. Нужно успеть получить токен в течение этого времени.

Получить токены подставив client_id, client_secret и code:
GET https://oauth.bitrix.info/oauth/token/?grant_type=authorization_code&client_id=local.65194cb0d83f05.62388267&client_secret=frAZ2M5dKaZ3VVLb0qy2HjsdMMYykDhzl3HvUpfFJkaHuVmN5q&code=8d8c196500674ca800674ca4000000010000071ebe2746439137d8e93a3c7c8c30da7c

В ответ приходит:

```json
{
    "access_token": "919a196500674ca800674ca400000001000007d6f8a66ce01a8f1de9e9c40247d205f9",
    "expires": 1696176785,
    "expires_in": 3600,
    "scope": "app",
    "domain": "oauth.bitrix.info",
    "server_endpoint": "https://oauth.bitrix.info/rest/",
    "status": "L",
    "client_endpoint": "http://b24-dev-80.local/rest/",
    "member_id": "82de4a56ef28d75f2a9258f34d6a529a",
    "user_id": 1,
    "refresh_token": "8119416500674ca800674ca4000000010000079fa0ee303443761acf7a6b271c22dd6c"
}
```

Токен access_token валиден 3600 секунд. После этого можно получить новый токен по refresh_token по запросу:

https://oauth.bitrix.info/oauth/token/?
grant_type=refresh_token
&client_id=local.65194cb0d83f05.62388267
&client_secret=frAZ2M5dKaZ3VVLb0qy2HjsdMMYykDhzl3HvUpfFJkaHuVmN5q
&refresh_token=8119416500674ca800674ca4000000010000079fa0ee303443761acf7a6b271c22dd6c

В ответ придут новые access_token и refresh_token, которые нужно сохранить:

```json
{
    "access_token": "61aa196500674ca800674ca400000001000007407371b032e57f428c16d47dda1cf595",
    "expires": 1696180833,
    "expires_in": 3600,
    "scope": "app",
    "domain": "oauth.bitrix.info",
    "server_endpoint": "https://oauth.bitrix.info/rest/",
    "status": "L",
    "client_endpoint": "http://b24-dev-80.local/rest/",
    "member_id": "82de4a56ef28d75f2a9258f34d6a529a",
    "user_id": 1,
    "refresh_token": "5129416500674ca800674ca40000000100000753e05acbcb037e28d3aafe22e209f770"
}
```

## Выполнение запросов

```shell


```

```json
{
    "result": [
        {
            "ID": "6",
            "TITLE": "Ромашка"
        }
    ],
    "total": 1,
    "time": {
        "start": 1696177390.216453,
        "finish": 1696177390.54918,
        "duration": 0.33272695541381836,
        "processing": 0.07731413841247559,
        "date_start": "2023-10-01T19:23:10+03:00",
        "date_finish": "2023-10-01T19:23:10+03:00"
    }
}
```

## Ресурсы

- [Полный протокол OAuth 2.0](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=99&LESSON_ID=2486&LESSON_PATH=8771.5380.5379.2486)
