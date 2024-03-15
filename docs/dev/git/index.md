# Git

## Процесс разработки

### Создание локальной ветки для разработки

```
git checkout -b bugfix/product/TASK-9999-short-descr origin/release/3.7
```

### Передача локальной ветки в удаленный репозиторий

```
git push -u origin bugfix/product/TASK-9999-short-descr
```

## Полезные команды

### Общие

#### Просмотр без постранички

```shell
git --no-pager <subcommand> <options>
```



### Клонирование существующего репозитория
```
git clone <url>
```

### Просмотр удалённых репозиториев

Просмотреть список настроенных удалённых репозиториев с выводом адресов
для чтения и записи, привязанных к репозиторию:
```
git remote -v
```

### Список веток удалённого репозитория

```
git branch -r
```

### Получение изменений из удалённого репозитория

Данная команда связывается с указанным удалённым проектом и забирает
все те данные проекта, которых у вас ещё нет. После того как вы выполнили
команду, у вас должны появиться ссылки на все ветки из этого удалённого
проекта, которые вы можете просмотреть или слить в любой момент.
```
git checkout master
git fetch [remote-name]
```

### Список веток из удаленного репозитория

```shell
git --no-pager branch -r
```

### Забрать определенную ветку

```
git clone --single-branch --branch <branch-name> <url>
```

### Переключиться на удаленную ветку

Сначала нужно получить ветку из удаленного репозитория, а потом создать локальную ветку,
которая будет отслеживать удаленную, и переключиться на нее

```
git fetch
git checkout --track <remote-name>/<branch-name>
```

или так?

```shell
git checkout -b branchName origin/branchName --
```

### Отменить слияние

```
git reset --hard HEAD^
```

### Изменить email в истории коммитов

```
git config --global alias.change-commits '!'"f() { VAR=\$1; OLD=\$2; NEW=\$3; shift 3; git filter-branch --env-filter \"if [[ \\\"\$\`echo \$VAR\`\\\" = '\$OLD' ]]; then export \$VAR='\$NEW'; fi\" \$@; }; f"
git change-commits GIT_AUTHOR_EMAIL new@example.com old@example.com
```

### Отслеживание файлов

#### Перестать отслеживать файл

```shell
git update-index --skip-worktree .env
```

#### Перестать отслеживать измененные файлы

```shell
git ls-files -m ./test | xargs git update-index --skip-worktree
```

#### Продолжить отслеживать файл

```shell
git update-index --no-skip-worktree .env
```

git update-index --assume-unchanged .env

#### Список неотслеживаемых файлов

```shell
git ls-files -v | grep "^S"
S app/Http/Controllers/MyController.php
```

### Разное

Отменить последний коммит. Закомиченные изменения попадут в индекс, а рабочий каталог останется нетронутым
```shell
git reset --soft HEAD~1
```

Очистить индекс
```shell
git reset HEAD
```

Содержимое индекса
```shell
git diff --name-only --cached
```

#### Отменить изменения файла в рабочей директории
```shell
git checkout -- test.txt
```

Двойной дефис (double dashes) "--" здесь нужен, чтобы сказать команде,
что опций нет. Иначе в команде *git checkout test.txt* название файла
test.txt можно было бы интерпретировать как название ветки.

#### Отменить все изменения в рабочей директории
```shell
git checkout -- .
```

### Изменения

### Статус игнорируя изменённые атрибуты файла (chmod)
```
git -c core.fileMode=false status
```

### История

#### История в одну строчку и в стандартный вывод STDOUT

```shell
git --no-pager log --oneline
```

#### Поиск коммитов, в котором появилась строка

```shell
git log -S '@deprecated' -- local/app/Services/User.php
````

#### Первый коммит ветки

```shell
git log master..otherBranch --oneline | tail -1
```

#### Список измененных файлов в диапазоне коммитов в каталоге

```shell
git diff-tree --name-only -r 61f37b513 HEAD src
```

#### Пользовательский формат истории

```shell
git --no-pager log -10 --pretty=format:"%h %cd %s"
e55c67fb1 Thu Feb 10 20:38:41 2022 +0300 comment1
1a6a8cbe7 Thu Feb 10 18:10:45 2022 +0300 comment12
```

| Параметр |    Описание выводимых данных|
|----------|-----------------------------|
| %H       |   Хеш коммита|
| %h       |   Сокращённый хеш коммита|
| %T       |   Хеш дерева|
| %t       |   Сокращённый хеш дерева|
| %P       |   Хеши родительских коммитов|
| %p       |   Сокращённые хеши родительских коммитов|
| %an      |   Имя автора|
| %ae      |   Электронная почта автора|
| %ad      |   Дата автора (формат соответствует параметру `--date=`)|
| %ar      |   Дата автора, относительная (пр. "2 мес. назад")|
| %cn      |   Имя коммитера|
| %ce      |   Электронная почта коммитера|
| %cd      |   Дата коммитера|
| %cr      |   Дата коммитера, относительная|
| %s       |   Комментарий|

#### Список авторов коммитов

```shell
git log --pretty=format:"%ae" | sort -u
```

### Ветки

#### Имя текущей ветки

```shell
git rev-parse --abbrev-ref HEAD
```

#### Поиск веток, содержащих коммит

```shell
git branch -r --contains 434507
```

#### Список отслеживаемых веток

```shell
git branch -vv
* master     d3dbcae22 [origin/master] Pull request #148: Make some
  rc/feature 4e4881f43 [origin/rc/feature: behind 6] Pull request #296: Make other
```



### Манипуляции с коммитами

#### Перенос коммитов из другой ветки (git cherry-pick)

Перенести коммит из одной ветки в другую

```shell
git checkout master
git pull
git checkout -b <новая ветка>
git cherry-pick <sha коммита из другой ветки>
```

#### Склеивание коммитов

Запустить интерактивный rebase для объединения 3 коммитов в один

```
git rebase -i HEAD~3
```

Оставить сообщение из первого

```
pick ab37583 Added feature 1.
s 3ab2b83 Added feature 2.
s bf43de1 Added feature 3.
```

Отправить изменения в удаленный репо:

```shell
git push --force
```

Подробнее [тут](https://htmlacademy.ru/blog/git/how-to-squash-commits-and-why-it-is-needed)

## Ресурсы
1. [Pro Git book (ru)](https://git-scm.com/book/ru/v2)
2.
