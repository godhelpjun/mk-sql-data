## Beschreibung

Der Befehl DBPARAMS konfiguriert den Zugang zur Datenbank und errichtet eine Verbindung zum Datenbankserver. Lediglich [[FETCH .. USING - (de)]] und [[INCREMENT .. DEPENDING ON .. IN TABLE - (de)]] benötigen eine Verbindung zur Datenbank.

Falls nicht alle Eintragungen benannt wurden, dann fragt mk-sql-data über einen Kommandoprompt nach den fehlenden Daten.

## Syntax:
```
  dbparams <localhost>,<schema_name>,<user_name>,<user_password>
```

## Beispiel:
```
  dbparams = "localhost,db2phpsite,db2phpsite,db2phpsite";
  dbparams = "localhost,db2phpsite,,";    # Benutzernamen und Passwort abfragen
```