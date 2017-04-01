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

- Gehen Sie zur ORACLE-WEbseite und suchen Sie nach INSTANTCLIENT [INSTANT CLIENT](https://www.google.de/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0ahUKEwjVvJPVx4PTAhULkSwKHd4QD5QQFgglMAA&url=http%3A%2F%2Fwww.oracle.com%2Ftechnetwork%2Fdatabase%2Ffeatures%2Finstant-client%2Findex-097480.html&usg=AFQjCNG0psq_TG0eboqXY6CNm22mqyg6HQ&sig2=u6AvAYNZLSpVY0uvJR_QfQ)

- zuerst das Basispaket von INSTACLIENT als RPM herunterladen
- dann das SQLPLUS-Zusatzpaket von der ORACLE-Webseite herunterladen
- dann die Pakete installieren
```
alien --scripts -d oracle-instantclient12.2-basic-12.2.0.1.0-1.x86_64.rpm
alien --scripts -d oracle-instantclient12.2-sqlplus-12.2.0.1.0-1.x86_64.rpm
dpkg --install *.deb
```

## Den Pfad zu den ORACLE-Bibliotheken einstellen
```
export DYLD_LIBRARY_PATH=/usr/lib/oracle/12.2/client64/lib
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:$DYLD_LIBRARY_PATH
```

## oci8 für PHP installieren

Unter Debian-Linux geben Sie ein:
```
pecl install oci8-2.0.10
```

## PHP so einstellen, dass es die oci-Bibliothek einbindet
```
vi /etc/php5/cli/php.ini
```

add the line:
```
  extension=oci8.so
```

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
