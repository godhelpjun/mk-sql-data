## Beschreibung

Der Befehl READ weist mk-sql-data, Daten aus der im Befehl benannten Textdatei auszulesen. Diese Daten können dann vom Befehl [[USE .. AS - (de)]] verwendet werden.

Die meisten der Textdateien bestehen aus einer Textspalte. Die ZIPCODES bestehen jedoch aus zwei Spalten und die TEXT-Datei hat keine Spalten, sondern besteht aus normalem Text.

Es ist möglich, mehr als eine Datei zu laden; die neuen Datensätze werden einfach an die schon eingelesenen Daten angehängt. Mit [[RESET - (de)]] können eingelesene Daten wieder aus dem Speicher entfernt werden.

## Syntax:

```
  read {PRENAMES|SURNAMES|STREETS|ZIPCODES|TEXT} from <TEXTFILENAME>;  
```

## Beispiel:

```
   read prenames from "data/de-prenames.txt";  # Vornamen
   read surnames from "data/de-surnames.txt";  # Nachnamen
   read streets from "data/de-streets.txt";    # Straßemverzeichnis
   read zipcodes from "data/de-zips.txt";      # Postleitzahlen und Städte
   read text from "data/de-text.txt";          # Textdaten
```

