# Gitlab

## Доступ к репозиторию по токену

Edit profile - Access tokens - Add new token

Token name: my-project
Select scopes: ead_repository, write_repository

```shell
git remote set-url origin https://oauth2:aaaaa-BBBbbbBB-ffdssaaaasa@my-gitlab.example/my-project.git
```
