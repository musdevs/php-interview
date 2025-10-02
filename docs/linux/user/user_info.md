# Информация о пользователях

## Список пользователей
1. Viewing the /etc/passwd file:
   The most common method is to display the contents of the /etc/passwd file, which contains a line for each user account on the system, including both regular and system users.
```
cat /etc/passwd
```

2. Extracting Usernames Only:

This command uses the colon (:) as a delimiter and extracts the first field, which corresponds to the username.
```
cut -d: -f1 /etc/passwd
```

This command uses the colon (:) as a field separator and prints the first field.
```
awk -F: '{ print $1 }' /etc/passwd
```

3. Using the getent command:
   The getent command can retrieve entries from administrative databases, including user information.
   This command provides a similar output to cat /etc/passwd but can also query other user databases if configured (e.g., LDAP).

```
getent passwd
```

4. Listing Currently Logged-in Users:
   To see users currently logged into the system, the who or users commands can be used.
```
who
```

This command displays information about currently logged-in users, including their terminal, login time, and originating host.
```
users
This command simply lists the usernames of currently logged-in users.
```
