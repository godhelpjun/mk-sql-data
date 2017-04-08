## Beschreibung

Der USE Befehl weist mk-sql-data an, wie das Programm mit speziellen Feldern umzugehen und zu randomisieren hat.

```
   use <FIELDNAME> AS {PRENAME|SURNAME|STREET|ZIPCODE|CITY};
```

Hier wird deklariert, dass mk-sql-data zum Randomisieren Vornamen (prename), Nachnamen (surname), Straßennamen (street), Postleitzahlen (zipcode), Stadtnamen (city) anwenden soll, die vorher mittels [[READ .. FROM - (de)]] eingelesen worden sind.

```
   use <FIELDNAME> AS {UNIQUE};
```

Behandle die Spalte FIELDNAME als eindeutige Zahl.

## Syntax:

```
   use <FIELDNAME> AS {PRENAME|SURNAME|STREET|ZIPCODE|CITY|UNIQUE};
```
== siehe auch 

[[SET .. TO - (de)]]

## Beispiel:

```
   use "ZIP" as zipcode;
   use "NAME" as surname;
   use "PRENAME" as prename;
   use "STREET" as street;
   use "CITY" as city;
   use "ID_ADRESSE" as unique;
```

