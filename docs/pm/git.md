# Git, Gitflow, Code review

Ветки:
* master
* release
* develop
* hotfix
* feature 1..N

Feature Branch Flow:
```
git checkout master
git checkout -b develop
git checkout -b feature_branch
# work happens on feature branch
git checkout develop
git merge feature_branch
git checkout master
git merge develop
git branch -d feature_branch
```

Hotfix Branch Flow:
```
git checkout master
git checkout -b hotfix_branch
# work is done commits are added to the hotfix_branch
git checkout develop
git merge hotfix_branch
git checkout master
git merge hotfix_branch
```

## Ресурсы
1. [Про Git, Github и Gitflow простыми словами](https://proglib.io/p/git-github-gitflow/)
2. [Gitflow Workflow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow)
3. [Git в реальной жизни](https://blog.regolit.com/2016/10/26/git-in-real-life)
4. [Модель ветвления Gitflow](https://bitworks.software/2019-03-12-gitflow-workflow.html)
5. [GitLab Flow](https://habr.com/ru/company/softmart/blog/316686/)
6. [Branching стратегии в Git](https://bool.dev/blog/detail/git-branching-strategies)