# Kerberos

[Kerberos Documentation](https://web.mit.edu/kerberos/www/krb5-latest/doc/)

## Docker

### Examle 1

[kerberos-docker](https://github.com/staticmukesh/kerberos-docker)

```dockerfile
FROM alpine:3.7

RUN apk update && \
    apk add krb5-server

COPY configure.sh /var/lib/krb5kdc/

ENTRYPOINT [ "sh", "/var/lib/krb5kdc/configure.sh"]
```

```shell
#! /env/sh

# Deafult values
REALM_NAME="${REALM_NAME-EXAMPLE.COM}"
DOMAIN_NAME="${DOMAIN_NAME-example.com}"
KADMIN_PASS="${KADMIN_PASS-Secure_Password}"
MASTER_PASS="${MASTER_PASS-Master_Password}"

# Copying krb5 conf file
cat > /etc/krb5.conf << EOL
[logging]
    default = FILE:/var/log/krb5libs.log
    kdc = FILE:/var/log/krb5kdc.log
    admin_server = FILE:/var/log/kadmind.log

[libdefaults]
    dns_lookup_realm = false
    ticket_lifetime = 24h
    renew_lifetime = 7d
    forwardable = true
    rdns = false
    default_realm = ${REALM_NAME}

[realms]
    ${REALM_NAME} = {
        kdc = localhost
        admin_server = localhost
    }

[domain_realm]
    .${DOMAIN_NAME} = ${REALM_NAME}
    ${DOMAIN_NAME} = ${REALM_NAME}
EOL

# Creating initial database
kdb5_util -r ${REALM_NAME} create -s << EOL
${MASTER_PASS}
${MASTER_PASS}
EOL

# Creating admin principal
kadmin.local -q "addprinc root/admin@${REALM_NAME}" << EOL
${KADMIN_PASS}
${KADMIN_PASS}
EOL

# Start services
kadmind
krb5kdc

tail -f /var/log/krb5kdc.log
```

### Google AI

```dockerfile
# Dockerfile
FROM alpine:latest
RUN apk add --no-cache krb5 krb5-admin-server krb5-kdc
COPY krb5.conf /etc/krb5.conf
COPY kdc.conf /var/kerberos/krb5kdc/kdc.conf
COPY start-kerberos.sh /start-kerberos.sh
RUN chmod +x /start-kerberos.sh
EXPOSE 88/udp 749/tcp
CMD ["/start-kerberos.sh"]
```

```
# krb5.conf
[libdefaults]
    default_realm = EXAMPLE.COM
    dns_lookup_realm = false
    dns_lookup_kdc = false
[realms]
    EXAMPLE.COM = {
        kdc = kerberos
        admin_server = kerberos
    }
[domain_realm]
    .example.com = EXAMPLE.COM
    example.com = EXAMPLE.COM
```

```
# kdc.conf
[kdcdefaults]
    kdc_ports = 88
    kdc_tcp_ports = 749
[realms]
    EXAMPLE.COM = {
        max_renewable_life = 7d 0h 0m 0s
        master_key_type = aes256-cts
        database_name = /var/kerberos/krb5kdc/principal
        admin_keytab = /var/kerberos/krb5kdc/kadm5.keytab
        acl_file = /var/kerberos/krb5kdc/kadm5.acl
    }
```

```shell
# start-kerberos.sh
#!/bin/sh
kdb5_util create -s -r EXAMPLE.COM -P "admin"
krb5kdc -n
kadmind -n
```

Build and run the Docker container.

```shell
docker build -t kerberos-server .
docker run --name kerberos -d -p 88:88/udp -p 749:749 kerberos-server
```

Access the Kerberos server.

```shell
docker exec -it kerberos kadmin.local -r EXAMPLE.COM
```

Enter the password "admin" when prompted. You can then add principals (users) using the addprinc command.
