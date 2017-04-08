## Beschreibung

Der Befehl FILENAME teilt mk-sql-data mit, in welche SQL-Datei das Programm den generierten SQL-Code schreiben soll. Falls der angegebene Dateipfad nicht existiert, dann versucht mk-sql-data, die benötigten Verzeichnisstrukturen anzulegen.

## Syntax:

```
filename is <FILENAME>;
```

## Beispiel:

```
   filename is "output/random-fk.sql";
```

