FROM mariadb:latest

COPY my.cnf /etc/my.cnf
COPY fixtures/init.sql /docker-entrypoint-initdb.d/init.sql
