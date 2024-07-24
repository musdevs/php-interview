# Отладка

## Запись в лог информации о запросе на стороне PHP

```php
function __dbg_log() {
	$message  = "Received Request at " . time() . "\n";
	$message .= "------------------------------------------------------------------------\n";
	$message .= "\n\$_REQUEST\n";
	$message .= json_encode($_REQUEST, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT) . "\n";
	$message .= "\n\$_SERVER\n";
	$message .= json_encode($_SERVER, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT) . "\n";
	$message .= "\nheaders\n";
	$message .= json_encode(getallheaders(), JSON_PRETTY_PRINT | JSON_FORCE_OBJECT) . "\n";
	$message .= "\n";

	file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/__logger.txt", $message, FILE_APPEND);
}
```

```
Received Request at 1720462489
------------------------------------------------------------------------

$_REQUEST
{}

$_SERVER
{
    "REMOTE_USER": "",
    "PHP_IDE_CONFIG": "serverName=b24-dev-80",
    "XDEBUG_CONFIG": "client_host=172.17.0.1",
    "HTTP_HOST": "b24-dev-80.local:80",
    "HTTP_X_FORWARDED_FOR": "172.20.0.2",
    "HTTP_X_FORWARDED_HOST": "b24-dev-80.local",
    "HTTP_X_FORWARDED_SCHEME": "http",
    "HTTP_X_FORWARDED_PROTO": "http",
    "HTTP_CONNECTION": "close",
    "HTTP_X_REAL_IP": "172.20.0.1",
    "HTTP_X_FORWARDED_SSL": "off",
    "HTTP_X_FORWARDED_PORT": "80",
    "HTTP_X_NGINX_PROXY": "true",
    "HTTP_UPGRADE_INSECURE_REQUESTS": "1",
    "HTTP_USER_AGENT": "Mozilla\/5.0 (X11; Linux x86_64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/125.0.0.0 Safari\/537.36",
    "HTTP_SEC_PURPOSE": "prefetch;prerender",
    "HTTP_PURPOSE": "prefetch",
    "HTTP_ACCEPT": "text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.7",
    "HTTP_ACCEPT_ENCODING": "gzip, deflate",
    "HTTP_ACCEPT_LANGUAGE": "ru,en-US;q=0.9,en;q=0.8",
    "HTTP_COOKIE": "BITRIX_SM_TZ=Europe\/Moscow; BITRIX_SM_LOGIN=admin; BITRIX_SM_SALE_UID=0; XDEBUG_SESSION=PHPSTORM; BITRIX_CONVERSION_CONTEXT_s1=%7B%22ID%22%3A1%2C%22EXPIRE%22%3A1720472340%2C%22UNIQUE%22%3A%5B%22conversion_visit_day%22%5D%7D; PHPSESSID=MwCRYArIrkKQtPEKbD2c6c4lOtF9RKqQ; BITRIX_SM_SOUND_LOGIN_PLAYED=Y",
    "PATH": "\/usr\/local\/sbin:\/usr\/local\/bin:\/usr\/sbin:\/usr\/bin:\/sbin:\/bin",
    "SERVER_SIGNATURE": "<address>Apache\/2.4.59 (Debian) Server at b24-dev-80.local Port 80<\/address>\n",
    "SERVER_SOFTWARE": "Apache\/2.4.59 (Debian)",
    "SERVER_NAME": "b24-dev-80.local",
    "SERVER_ADDR": "172.31.0.2",
    "SERVER_PORT": "80",
    "REMOTE_ADDR": "172.31.0.4",
    "DOCUMENT_ROOT": "\/var\/www\/html",
    "REQUEST_SCHEME": "http",
    "CONTEXT_PREFIX": "",
    "CONTEXT_DOCUMENT_ROOT": "\/var\/www\/html",
    "SERVER_ADMIN": "webmaster@localhost",
    "SCRIPT_FILENAME": "\/var\/www\/html\/index.php",
    "REMOTE_PORT": "47982",
    "GATEWAY_INTERFACE": "CGI\/1.1",
    "SERVER_PROTOCOL": "HTTP\/1.0",
    "REQUEST_METHOD": "GET",
    "QUERY_STRING": "",
    "REQUEST_URI": "\/",
    "SCRIPT_NAME": "\/index.php",
    "PHP_SELF": "\/index.php",
    "REQUEST_TIME_FLOAT": 1720462489.833495,
    "REQUEST_TIME": 1720462489
}

headers
{
    "Host": "b24-dev-80.local:80",
    "X-Forwarded-For": "172.20.0.2",
    "X-Forwarded-Host": "b24-dev-80.local",
    "X-Forwarded-Scheme": "http",
    "X-Forwarded-Proto": "http",
    "Connection": "close",
    "X-Real-IP": "172.20.0.1",
    "X-Forwarded-Ssl": "off",
    "X-Forwarded-Port": "80",
    "X-NginX-Proxy": "true",
    "Upgrade-Insecure-Requests": "1",
    "User-Agent": "Mozilla\/5.0 (X11; Linux x86_64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/125.0.0.0 Safari\/537.36",
    "Sec-Purpose": "prefetch;prerender",
    "Purpose": "prefetch",
    "Accept": "text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.7",
    "Accept-Encoding": "gzip, deflate",
    "Accept-Language": "ru,en-US;q=0.9,en;q=0.8",
    "Cookie": "BITRIX_SM_TZ=Europe\/Moscow; BITRIX_SM_LOGIN=admin; BITRIX_SM_SALE_UID=0; XDEBUG_SESSION=PHPSTORM; BITRIX_CONVERSION_CONTEXT_s1=%7B%22ID%22%3A1%2C%22EXPIRE%22%3A1720472340%2C%22UNIQUE%22%3A%5B%22conversion_visit_day%22%5D%7D; PHPSESSID=MwCRYArIrkKQtPEKbD2c6c4lOtF9RKqQ; BITRIX_SM_SOUND_LOGIN_PLAYED=Y"
}
```
