# Github

## Две учетки Github

[Источник](https://gist.github.com/oanhnn/80a89405ab9023894df7)

### Добавить хосты в ~/.ssh/config

```
Host github.com
    Hostname github.com
    IdentityFile ~/.ssh/github
    IdentitiesOnly yes

Host github-second
    Hostname github.com
    IdentityFile ~/.ssh/github-second
    IdentitiesOnly yes
```

### Обновить путь к репозиторию

```
git remote set-url origin git@github-second:user/myrepo.git
```
