# Chrome

## 307 Internal Redirect

При вызове http://site.domain происходит автоматический редирект на https и выводится ошибка Non-Authoritative-Reason: HSTS. Это словил, когда сходил на реальный сервис по https, а потом в /etc/hosts прописал 127.0.0.1 site.domain, чтобы поотлаживать локально. Решение - удалить настройки домена на вкладке [настроек](chrome://net-internals/#hsts) в разделе *Delete domain security policies*

По информации от:
* [307 Internal Redirect — как отключить в nginx?](https://qna.habr.com/q/611334)
* [Re-Hashed: How to clear HSTS settings in Chrome and Firefox](https://www.thesslstore.com/blog/clear-hsts-settings-chrome-firefox/)
