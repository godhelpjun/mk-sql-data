## Beschreibung

Der Befehl READ weist mk-sql-data, Daten aus der im Befehl benannten Textdatei auszulesen. Diese Daten können dann vom Befehl [[USE .. AS - (de)]] als Basis für die Randomisierung verwendet werden.

Die meisten der Textdateien bestehen aus einer Textspalte. Die ZIPCODES bestehen jedoch aus zwei Spalten und die TEXT-Datei hat keine Spalten, sondern besteht aus normalem Text.

Es ist möglich, mehr als eine Datei zu laden; die neuen Datensätze werden einfach an die schon eingelesenen Daten angehängt. Mit [[RESET - (de)]] können eingelesene Daten wieder aus dem Speicher entfernt werden.

### Available data sets

Deutsche Daten:
   data/de-prenames.txt
   data/de-surnames.txt
   data/de-streets.txt
   data/de-zips.txt
   data/de-text.txt 

Englische Daten:
   data/us-prenames.txt
   data/us-surnames.txt
   data/us-streets.txt
   data/us-zips.txt
   data/us-text.txt 

Spanische Daten:
   data/es-prenames.txt
   data/es-surnames.txt
   data/es-streets.txt
   data/es-zips.txt
   data/es-text.txt 


## Syntax:

```
  read {PRENAMES|SURNAMES|STREETS|ZIPCODES|TEXT} from <TEXTFILENAME>;  
```

## Beispiel:

```
   # lade alle verfügbaren deutschen Daten

   read prenames from "data/de-prenames.txt";  # Vornamen
   read surnames from "data/de-surnames.txt";  # Nachnamen
   read streets from "data/de-streets.txt";    # Straßemverzeichnis
   read zipcodes from "data/de-zips.txt";      # Postleitzahlen und Städte
   read text from "data/de-text.txt";          # Textdaten
```

