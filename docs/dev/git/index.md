# Git

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

### Получение изменений из удалённого репозитория

Данная команда связывается с указанным удалённым проектом и забирает
все те данные проекта, которых у вас ещё нет. После того как вы выполнили
команду, у вас должны появиться ссылки на все ветки из этого удалённого
проекта, которые вы можете просмотреть или слить в любой момент.
```
git fetch [remote-name]
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

### Отменить слияние

```
git reset --hard HEAD^
```

### Изменить email в истории коммитов

```
git config --global alias.change-commits '!'"f() { VAR=\$1; OLD=\$2; NEW=\$3; shift 3; git filter-branch --env-filter \"if [[ \\\"\$\`echo \$VAR\`\\\" = '\$OLD' ]]; then export \$VAR='\$NEW'; fi\" \$@; }; f"
git change-commits GIT_AUTHOR_EMAIL new@example.com old@example.com
```

### Перестать отслеживать файл
```shell
git update-index --assume-unchanged .env
```

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

#### Отменить все изменения в рабочей директории
```shell
git checkout -- .
```

### История

#### История в одну строчку и в стандартный вывод STDOUT
```shell
git --no-pager log --oneline
```

### Ветки

#### Имя текущей ветки

```shell
git rev-parse --abbrev-ref HEAD
```

## Ресурсы
1. [Pro Git book (ru)](https://git-scm.com/book/ru/v2)
2.
