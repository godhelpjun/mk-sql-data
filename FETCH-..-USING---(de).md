## Beschreibung

Der Befehl FETCH erlaubt es, Relationen zu Inhalten in der Zieldatenbank zu definieren. 

Nehmen wir an, dass eine Tabelle ADDRESS Adressdaten enthält. In ADDRESS findet sich auch ein Feld mit dem Namen id_country welches als Foreign Key auf den Fremdschlüssel in der Tabelle COUNTRIES verweist. COUNTRIES wiederum enthält ebenfalls ein Feld id_country, welches als eindeutiger Schlüssel definiert ist. Um nun mk-sql-code mitzuteilen, dass zwischen den beiden Feldern mit dem Namen id_country, also ADDRESS.id_country und COUNTRIES.id_country eine Relation besteht, benutzen wir das FETCH-Kommando.

Die Verwendung von FETCH bedarf der vorherigen Benutzung des Befehls [[DBPARAMS - (de)]]. mk-sql-data versucht dann, die relationalen Daten in der Datenbank auszulesen mit dem SELECTSTATEMENT.

Es ist möglich, in der FIELDLIST mehr als einen Spaltennamen zu verwenden.

## Syntax:
```
   fetch <FIELDLIST> using <SELECTSTATEMENT>;
```

## Beispiel:

```
   fetch 'ID_COUNTRY' using 'select country_id from COUNTRIES';
   fetch 'ID_MANDANT,ID_BUCHUNGSKREIS' using "select ID_MANDANT,ID_BUCHUNGSKREIS from BUCHUNGSKREIS where xx = 1";
```

