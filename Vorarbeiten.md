Um die Beispiele, welche auf Daten in der Datenbank zurückgreifen, nutzen zu können, sind einige Vorarbeiten nötig, um eine Datenbank bzw ein Schema zu erzeugen. Dazu bedarf es eines neuen Benutzers, der die Datenbank / das Schema besitzt. Erst dann werden Sie dazu in der Lage sein, die Beispielskripte nutzen zu können.

# MySQL benutzen

Benutzen Sie das Programm "mysql", um SQL-Kommandos auszuführen.

## Eine Datenbank erzeugen
```
create database db2phpsite;
use db2phpsite;
```

## Einen Benutzer erzeugen
```
CREATE USER 'db2phpsite'@'localhost' IDENTIFIED BY 'db2phpsite'
GRANT ALL ON db2phpsite.* TO 'db2phpsite'@'localhost';
FLUSH PRIVILEGES;
exit
```

## Die Datenbank mit Werten befüllen
```
mysql -u db2phpsite -pdb2phpsite < mk-sql-data-init-mysql.sql
```

# Oracle benutzen

Die CONNECT-Zeichenkette mag unterschiedlich ausfallen - je nach Version und Standort der Datenbank.

## INSTACLIENT und SQLPLUS von ORACLE installieren

[[Install ORACLE INSTANTCLIENT]]

## oci8 für PHP installieren

[[Install ORACLE oci8]]

## Einen neuen Benutzer ( = Schema ) anlegen

Benutzen Sie das Programm "sqlplus", um SQL-Kommandos auszuführen. "sqlplus64 /nolog" startet sqlplus, ohne sich mit einem Schema zu verbinden.
```
sqlplus64 /nolog

CONNECT system/oracle@192.168.1.65/XE

create user db2phpsite identified by "db2phpsite";

grant dba,resource, connect to db2phpsite;

connect db2phpsite/db2phpsite@192.168.1.65;
```

## Die Datenbank mit Werten befüllen
```
@ './mk-sql-data-init-oracle.sql';
exit;
```
