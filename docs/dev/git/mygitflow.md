# Мой Git Flow

## Получить все данные из удалённого репозитория, отсутствующие в локальном

```shell
git fetch
```

## Создание локальной ветки, отслеживающей удалённую релизную ветку

```shell
git checkout --track origin/release/1.0
```

## Создание локальной ветки, отслеживающей удалённую релизную ветку

```shell
git checkout -b feature/system/TASK-ID-task-name
```

## Отправка локальной ветки в удалённый репозиторий

```shell
git push -u origin feature/system/TASK-ID-task-name
```
