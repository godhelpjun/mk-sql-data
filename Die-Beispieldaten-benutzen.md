Um die folgenden Beispiele nutzen zu können, sind Vorarbeiten nötig, die hier beschrieben sind [[Vorarbeiten]]

# Beispielskript mk-sql-data-01.cmd

Das Skript läuft mit einer MySQL-Datenbank und generiert relationale Testadaten. 

Benutzen Sie das Programm "mysql", um die SQL-Kommandos auszuführen.

## Mit dem Beispielskript Testdaten generieren
```
./mk-sql-data.php --cfg mk-sql-data-01.cmd
```

## Die Testdaten in die Datenbank importieren
```
mysql -u db2phpsite -pdb2phpsite < output/random-data.sql
```

# Das Beispielskript mk-sql-data-02-ora.cmd

Diese Skript benutzt eine ORACLE-Datenbank, um relationale Daten zu erzeugen. Der CONNECT-String muss eventuell an die Gegebenheiten angepasst werden

```
sqlplus64 /nolog

connect db2phpsite/db2phpsite@192.168.1.65;
```

## Die Datenbank befüllen
```
@ './mk-sql-data-init-oracle.sql';
exit;
```

## Das Beispielskript ausführen
```
./mk-sql-data.php --cfg mk-sql-data-02-ora.cmd
```

## Die erzeugten Testdaten in die Datenbank importieren
```
sqlplus64 /nolog

connect db2phpsite/db2phpsite@192.168.1.65;

@ 'output/random-fk.sql';
```


