## Beschreibung

Der Befehl DBPARAMS konfiguriert den Zugang zur Datenbank und errichtet eine Verbindung zum Datenbankserver. Lediglich [[FETCH .. USING - (de)]] und [[INCREMENT .. DEPENDING ON .. IN TABLE (de)]] benötigen eine Verbindung zur Datenbank.

## Syntax:
```
  dbparams <localhost>,<schema_name>,<user_name>,<user_password>
```

## Beispiel:
```
  dbparams = "localhost,db2phpsite,db2phpsite,db2phpsite";
```