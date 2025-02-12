# Настройка почты в BitrixEnv

## msmtp

### Удачный конфиг для яндекс

```
# /home/bitrix/.msmtprc
account default
logfile /home/bitrix/msmtp_default.log
host smtp.yandex.ru
port 587
from user@example.com
aliases /etc/aliases
keepbcc on
auth on
user user@example.com
password *

tls on
tls_starttls on
tls_certcheck off
```

### Удачный конфиг для Таймвеб

```
account default
logfile /home/bitrix/msmtp_default.log
host smtp.timeweb.ru
port 25
from bitrix@domain
aliases /etc/aliases
keepbcc on
auth on
user bitrix@domain
password *

tls on
```

### Отправка тестового письма из консоли

```
echo "hello" | msmtp -a default user@example.com
```

auth
on
off
LOGIN, PLAIN, CRAM-MD5, DIGEST-MD5, NTLM, GSSAPI, XOAUTH, XOAUTH2

auth [(on|off|method)]
              Enable or disable authentication and optionally choose a method to use. The argument on chooses a method automatically.
              Usually  a  user  name and a password are used for authentication. The user name is specified in the configuration file with the user command.
              There are five different methods to specify the password:
              1. Add the password to the system key ring.  Currently supported key rings are the Gnome key ring and the Mac OS X Keychain.   For  the  Gnome
              key ring, use the command secret-tool (part of Gnome's libsecret) to store passwords: secret-tool store --label=msmtp host mail.freemail.exam‐
              ple service smtp user joe.smith.  On Mac OS X, use the following command: security add-internet-password -s mail.freemail.example -r  smtp  -a
              joe.smith -w.  In both examples, replace mail.freemail.example with the SMTP server name, and joe.smith with your user name.
              2. Store the password in an encrypted files, and use passwordeval to specify a command to decrypt that file, e.g. using GnuPG. See EXAMPLES.
              3.  Store  the password in the configuration file using the password command.  (Usually it is not considered a good idea to store passwords in
              cleartext files.  If you do it anyway, you must make sure that the file can only be read by yourself.)
              4. Store the password in ~/.netrc. This method is probably obsolete.
              5. Type the password into the terminal when it is required.
              It is recommended to use method 1 or 2.
              Multiple authentication methods exist. Most servers support only some of them.  Historically, sophisticated methods were developed to  protect
              passwords  from  being  sent unencrypted to the server, but nowadays everybody needs TLS anyway, so the simple methods suffice since the whole
              session is protected. A suitable authentication method is chosen automatically, and when TLS is disabled for some reason,  only  methods  that
              avoid sending cleartext passwords are considered.
              The following user / password methods are supported:
plain (a simple cleartext method, with base64 encoding, supported by almost all servers),
scram-sha-1 (a method that avoids cleartext passwords),
cram-md5 (an obsolete method that avoids cleartext passwords, but  is  not  considered
              secure  anymore),
digest-md5 (an overcomplicated obsolete method that avoids cleartext passwords, but is not considered secure anymore),
login (a non-standard cleartext method similar to but worse than the plain method),
ntlm (an obscure non-standard method that is now considered bro‐
              ken; it sometimes requires a special domain parameter passed via ntlmdomain).

There are currently three authentication methods that are not based on user / password information and have to be chosen manually:

oauthbearer (an OAuth2 token from the mail provider is used as the password.  See the documentation of your mail provider for details on how to  get  this
              token. The passwordeval command can be used to pass the regularly changing tokens into msmtp from a script or an environment variable),

external (the authentication happens outside of the protocol, typically by sending a TLS client certificate, and the method  merely  confirms  that
              this authentication succeeded), and

gssapi (the Kerberos framework takes care of secure authentication, only a user name is required).

              It depends on the underlying authentication library and its version whether a particular method is supported or not. Use --version to find out
              which methods are supported.
