#

## Настройка подсказок для расширений

Для классов и функций PHP-расширений PhpStorm может не находить описаний.
Такое увидел с расширением rdkafka. Шторм подсвечивал такие классы

```php
use RdKafka\Conf;
use RdKafka\Exception;
use RdKafka\Producer;
```

Поэтому подключил репозиторий заглушек:

```shell
cd ~
git clone https://github.com/JetBrains/phpstorm-stubs.git
sudo mv phpstorm-stubs /opt/jetbrains/phpstorm
```

И в Шторме подключил их: `Settings | Languages & Frameworks | PHP | PHP Runtime | Advanced settings | Default stubs path`

И нужно еще проверить чтобы расширение было включено в настройках: `Settings | Languages & Frameworks | PHP | PHP Runtime | PECL | rdkafka`
