# PhpStorm

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

## Ошибки и решения

### После апгрейда Ubuntu начал падать PhpStorm

[IDE crashes due to "chrome-sandbox is owned by root and has mode" error when IDE is launching the JCEF in a sandbox](https://youtrack.jetbrains.com/issue/IJPL-59368/IDE-crashes-due-to-chrome-sandbox-is-owned-by-root-and-has-mode-error-when-IDE-is-launching-the-JCEF-in-a-sandbox)

Сделал это:

```
Run /ide_installation_path/bin/idea.sh dontReopenProjects (replace idea to any IDE name you used)
to start the IDE, click the IDE setting icon in left bottom "Edit Custom VM Options",
add -Dide.browser.jcef.sandbox.enable=false in a new line and restart the IDE.
```
