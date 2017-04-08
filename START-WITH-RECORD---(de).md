## Beschreibung

Das Kommando START weist mk-sql-data dazu an, beim Schreiben des SQL-Codes mit der ( ab Null beginnenden ) Datensatznummer <RECORDNUMBER> zu beginnen und nicht mit der Null. Der generierte Code reicht normalerweise von der Nummer 0 bis zur Anzahl an Datensätzen, die mit [[EXPORT .. RECORDS - (de)]] festgelegt worden ist.

## Syntax:

```
  START WITH RECORD <RECORDNUMBER>;  
```

## Beispiel:

```
   start with record 50;
```

